<?php

namespace App\Http\Controllers\Loyer;

use App\Http\Controllers\Controller;
use App\Models\Contrat;
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
        $listepayment = Paiement::all();
        $contrats = Contrat::with(['locataire', 'bien.commune'])->get();
        return view('paiements.loyers.index', compact('listepayment', 'contrats'));
    }

    public function store(Request $request)
    {
        // Vérifier si le paiement existe déjà avec la référence
        $paiementId = $request->input('paiement_id');

        if ($paiementId)
        {
            // Si paiement_id existe, on modifie le paiement
            $paiement = Paiement::find($paiementId);

            // Si le paiement n'existe pas, on le crée
            if (!$paiement)
            {
                return $this->createPaiement($request);
            }

            // Si le paiement existe, on procède à la mise à jour
            return $this->updatePaiement($paiement, $request);
        } else
        {
            // Si paiement_id est absent, on crée un nouveau paiement
            return $this->createPaiement($request);
        }
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

    private function createPaiement(Request $request)
    {
        // Création d'un nouveau paiement
        $paiement = Paiement::create([
            'contrat_id' => $request->contrat_id,
            'mois_paye' => $request->mois_paye,
            'montant' => $request->montant,
            'date_paiement' => $request->date_paiement,
            'mode_paiement' => $request->mode_paiement,
            'reference_paiement' => $request->reference_paiement,
        ]);

        // Création automatique de la quittance
        $quittance = Quittance::create([
            'paiement_id' => $paiement->id,
            'date_emission' => now(),
            'document' => 'Quittance pour paiement ' . $paiement->reference_paiement,
        ]);

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
