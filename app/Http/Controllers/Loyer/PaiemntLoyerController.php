<?php

namespace App\Http\Controllers\Loyer;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
use App\Models\ModeReglement;
use App\Models\Mois;
use App\Models\Paiement;
use App\Models\Quittance;
use Illuminate\Http\Request;

class PaiemntLoyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listepayment = Paiement::with(['contrat.locataire', 'mois', 'modereglement'])->get();
        $listemois = Mois::all();
        $listemodereglement = ModeReglement::all();

        $contrats = Contrat::with(['locataire', 'bien.commune'])->get();
        return view('paiements.loyers.index', compact('listepayment', 'contrats', 'listemois', 'listemodereglement'));
    }

    public function store(Request $request)
    {
        // Vérifier si un paiement existe déjà pour ce contrat et ce mois
        $existingPaiement = Paiement::where('contrat_id', $request->contrat_id)
            ->where('mois_id', $request->mois_id)
            ->first();

        // Si un paiement existe déjà pour ce contrat et ce mois
        if ($existingPaiement) {
            return response()->json([
                'message' => 'Le paiement pour ce mois a déjà été effectué sous ce contrat.',
                'paiement_existe' => true, // Indication qu'un paiement existe déjà
            ], 400);
        }

        // Si paiement_id est fourni, on met à jour le paiement existant
        $paiementId = $request->input('paiement_id');
        if ($paiementId) {
            // Trouver le paiement à mettre à jour
            $paiement = Paiement::find($paiementId);

            // Si le paiement n'existe pas, on crée un nouveau paiement
            if (!$paiement) {
                return $this->createPaiement($request);
            }

            // Sinon, on procède à la mise à jour
            return $this->updatePaiement($paiement, $request);
        }

        // Sinon, si paiement_id n'existe pas, on crée un nouveau paiement
        return $this->createPaiement($request);
    }


    private function updatePaiement(Paiement $paiement, Request $request)
    {
        // Mise à jour du paiement
        $paiement->update([
            'contrat_id' => $request->contrat_id,
            'mois_paye' => $request->mois_paye,
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'mode_paiement' => $request->mode_paiement,
            'reference_paiement' => $request->reference_paiement,
        ]);

        // Mise à jour de la quittance associée
        $quittance = $paiement->quittance;
        $quittance->update([
            'date_emission' => now(),
            'document' => 'Quittance mise à jour pour paiement ' . $paiement->reference_paiement,
        ]);

        return response()->json([
            'message' => 'Paiement et quittance mis à jour avec succès.',
            'paiement' => $paiement,
            'quittance' => $quittance
        ], 200);
    }


    private function generateUniqueReference()
    {
        // Récupérer le dernier paiement avec une référence commençant par "AG-"
        $lastPayment = Paiement::where('reference_paiement', 'like', 'AG-%')
            ->orderBy('reference_paiement', 'desc')
            ->first();

        // Extraire le dernier numéro à partir de la référence (exemple : "AG-98087")
        if ($lastPayment) {
            $lastReference = $lastPayment->reference_paiement;
            $lastNumber = (int) substr($lastReference, 3);  // On récupère tout après "AG-"
            $newNumber = $lastNumber + 1;  // Incrémenter de 1
        } else {
            // Si aucun paiement n'existe, on commence avec 98001
            $newNumber = 98001;
        }

        // Générer la nouvelle référence avec le numéro incrémenté
        return 'AG-' . $newNumber;
    }



    private function createPaiement(Request $request)
    {
        // Vérification si un paiement existe déjà pour ce contrat et ce mois
        $existingPaiement = Paiement::where('contrat_id', $request->contrat_id)
            ->where('mois_id', $request->mois_id)
            ->first();



        if ($existingPaiement) {
            // Si un paiement existe déjà pour ce contrat et ce mois, renvoyer une erreur
            return response()->json([
                'message' => 'Un paiement a déjà été effectué pour ce mois sous ce contrat.',
            ], 400);
        }

        // Vérification et génération de la référence de paiement si elle n'est pas fournie
        $reference_paiement = $this->generateUniqueReference();

        // Création d'un nouveau paiement
        $paiement = Paiement::create([
            'contrat_id' => $request->contrat_id,
            'mois_id' => $request->mois_id, // Utilisation de mois_id au lieu de mois_paye
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'modereglement_id' => $request->modereglement_id, // Utilisation de modereglement_id au lieu de mode_paiement
            'reference_paiement' => $reference_paiement, // Référence du paiement
        ]);

        // Création automatique de la quittance
        $quittance = Quittance::create([
            'paiement_id' => $paiement->id,
            'referencepaiement' => $reference_paiement,
            'date_emission' => now(),
            'document' => 'Quittance pour paiement ' . $paiement->reference_paiement,
        ]);

        $paiement->load('contrat.locataire', 'mois', 'modereglement');
        
        return response()->json([
            'message' => 'Paiement créé avec succès, quittance générée.',
            'paiement' => $paiement,
            'quittance' => $quittance
        ], 201);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // Rechercher le paiement
            $paiement = Paiement::findOrFail($id);

            // Supprimer la quittance associée
            $paiement->quittance()->delete();

            // Supprimer le paiement
            $paiement->delete();

            return response()->json([
                'success' => true,
                'message' => 'Paiement et quittance supprimés avec succès.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Paiement introuvable.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du paiement.',
            ], 500);
        }
    }
}
