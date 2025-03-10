<?php

namespace App\Http\Controllers\Contrat;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Contrat;
use App\Models\Locataire;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupère tous les contrats avec les relations
        $contrats = Contrat::with(['locataire', 'bien'])->get();
        $locataires = Locataire::all();
        $biens = Bien::all();
        return view('contrats.index', compact('contrats', 'locataires', 'biens'));
    }


    public function generateCodeContrat()
    {
        // Générer un code unique basé sur une chaîne aléatoire et un timestamp
        $newCodeContrat = 'CONTRAT-' . strtoupper(Str::random(5)) . '-' . time();

        // Vérifier si un contrat existe déjà avec ce codecontrat
        $existingContract = Contrat::where('codecontrat', $newCodeContrat)->first();

        // Si un contrat existe déjà avec ce code, recommencer le processus jusqu'à ce que le code soit unique
        while ($existingContract) {
            // Générer un autre code unique si celui-ci existe déjà
            $newCodeContrat = 'CONTRAT-' . strtoupper(Str::random(5)) . '-' . time();
            $existingContract = Contrat::where('codecontrat', $newCodeContrat)->first();
        }

        // Retourner le code généré
        return $newCodeContrat;
    }


    public function store(Request $request)
    {
        $contratId = $request->input('contrat_id');
        $locataireId = $request->input('locataire_id');
        $bienId = $request->input('bien_id');

        // Vérifier si le locataire a déjà un contrat actif
        $existingContrat = Contrat::where('locataire_id', $locataireId)
            // ->whereNull('date_fin')  // Assurer que le contrat n'est pas encore terminé
        ->first();
        if ($existingContrat)
        {
            return response()->json(['message' => 'Le locataire ne peut pas louer plusieurs appartements à la fois'], 400);
        }

        // Vérifier si le bien est déjà attribué à un autre contrat actif
        $existingBienContrat = Contrat::where('bien_id', $bienId)
            // ->whereNull('date_fin')  // Le contrat n'est pas encore terminé
            ->first();

        if ($existingBienContrat) {
            return response()->json(['message' => 'Le bien est déjà sous location et ne peut pas être attribué à un autre locataire'], 400);
        }

        if ($contratId) {
            // Si l'ID du contrat existe, on met à jour le contrat
            $contrat = Contrat::find($contratId);

            if (!$contrat) {
                // Si le contrat n'existe pas, on crée un nouveau contrat
                return $this->createContrat($request);
            }

            // Vérifier si le bien est déjà attribué à un autre contrat
            if ($contrat->bien_id != $bienId && $contrat->bien) {
                return response()->json(['message' => 'Le bien est déjà attribué et ne peut pas être modifié'], 400);
            }

            // Sinon, mettre à jour le contrat
            return $this->updateContrat($contrat, $request);
        } else {
            // Si l'ID n'est pas fourni, créer un nouveau contrat
            return $this->createContrat($request);
        }
    }



    /**
     * Update the specified contrat
     */
    private function updateContrat($contrat, Request $request)
    {
        // Vérifier si le bien a déjà été attribué et empêcher de le changer
        if ($contrat->bien_id != $request->bien_id && $contrat->bien)
        {
            return response()->json(['message' => 'Le bien est déjà attribué et ne peut pas être modifié'], 400);
        }

        $contrat->update([
            'locataire_id' => $request->locataire_id,
            'bien_id' => $request->bien_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant_loyer' => $request->montant_loyer,
            'caution' => $request->caution,
            'document' => $request->document ?? 'rien',
        ]);

        $contrat->load('locataire', 'bien');
        return response()->json(['message' => 'Contrat mis à jour avec succès', 'contrat' => $contrat], 200);
    }


    /**
     * Create a new contrat
     */
    private function createContrat(Request $request)
    {
        // Vérifier si le locataire a déjà un contrat actif
        $existingContrat = Contrat::where('locataire_id', $request->locataire_id)
            // ->whereNull('date_fin')  // Assurer que le contrat n'est pas encore terminé
            ->first();

        if ($existingContrat)
        {
            return response()->json(['message' => 'Le locataire ne peut pas louer plusieurs appartements à la fois'], 400);
        }

        // Création d'un nouveau contrat
        $contrat = Contrat::create([
            'locataire_id' => $request->locataire_id,
            'codecontrat' => $this->generateCodeContrat(),
            'bien_id' => $request->bien_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant_loyer' => $request->montant_loyer,
            'caution' => $request->caution,
            'document' => $request->document ?? 'rien',
        ]);

        $contrat->load('locataire', 'bien');
        return response()->json(['message' => 'Contrat créé avec succès', 'contrat' => $contrat], 201);
    }


    /**
     * Delete a contrat
     */
    public function destroy(Contrat $contrat)
    {
        $contrat->delete();

        return response()->json(['message' => 'Contrat supprimé avec succès'], 200);
    }
}
