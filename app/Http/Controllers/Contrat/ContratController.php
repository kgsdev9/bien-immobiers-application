<?php

namespace App\Http\Controllers\Contrat;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Contrat;
use App\Models\Locataire;
use Illuminate\Http\Request;

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


    public function store(Request $request)
    {
        $contratId = $request->input('contrat_id');

        // Vérifier si l'ID du contrat existe dans la requête
        if ($contratId)
        {
            // Si l'ID existe, on met à jour le contrat
            $contrat = Contrat::find($contratId);

            if (!$contrat)
            {
                // Si le contrat n'existe pas, on crée un nouveau contrat
                return $this->createContrat($request);
            }

            // Sinon, mettre à jour le contrat
            return $this->updateContrat($contrat, $request);
        }
        else
        {
            // Si l'ID n'est pas fourni, créer un nouveau contrat
            return $this->createContrat($request);
        }
    }

    /**
     * Update the specified contrat
     */
    private function updateContrat($contrat, Request $request)
    {
        $contrat->update([
            'locataire_id' => $request->locataire_id,
            'bien_id' => $request->bien_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant_loyer' => $request->montant_loyer,
            'caution' => $request->caution,
            // 'etat' => $request->etat,
            'document' => $request->document ?? 'rien',
        ]);

        return response()->json(['message' => 'Contrat mis à jour avec succès', 'contrat' => $contrat], 200);
    }

    /**
     * Create a new contrat
     */
    private function createContrat(Request $request)
    {
        // Création d'un nouveau contrat
        $contrat = Contrat::create([
            'locataire_id' => $request->locataire_id,
            'bien_id' => $request->bien_id,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant_loyer' => $request->montant_loyer,
            'caution' => $request->caution,
            // 'etat' => $request->etat,
            'document' => $request->document ?? 'rien',
        ]);

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
