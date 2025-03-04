<?php

namespace App\Http\Controllers\Commune;

use App\Http\Controllers\Controller;
use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function index()
    {
        // Récupère toutes les communes
        $communes = Commune::all();
        return view('communes.index', compact('communes'));
    }

    public function store(Request $request)
    {
        $communeId = $request->input('commune_id');

        // Vérifier si l'ID de la commune existe dans la requête
        if ($communeId)
        {
            // Si l'ID existe, on met à jour la commune
            $commune = Commune::find($communeId);

            if (!$commune)
            {
                // Si la commune n'existe pas, on crée une nouvelle commune
                return $this->createCommune($request);
            }

            // Sinon, mettre à jour la commune
            return $this->updateCommune($commune, $request);
        } else
        {
            // Si l'ID n'est pas fourni, créer une nouvelle commune
            return $this->createCommune($request);
        }
    }

    private function updateCommune($commune, Request $request)
    {
        $commune->update([
            'nom' => $request->name,
        ]);

        return response()->json(['message' => 'Commune mise à jour avec succès', 'commune' => $commune], 200);
    }

    private function createCommune(Request $request)
    {
        // Création d'une nouvelle commune
        $commune = Commune::create([
            'nom' => $request->name,
        ]);

        return response()->json(['message' => 'Commune créée avec succès', 'commune' => $commune], 201);
    }

    public function destroy(Commune $commune)
    {
        $commune->delete();

        return response()->json(['message' => 'Commune supprimée avec succès'], 200);
    }
}
