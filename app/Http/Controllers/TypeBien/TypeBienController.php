<?php

namespace App\Http\Controllers\TypeBien;

use App\Http\Controllers\Controller;
use App\Models\TypeBien;
use Illuminate\Http\Request;

class TypeBienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listeypebiens = TypeBien::all();
        return view('typebiens.index', compact('listeypebiens'));
    }


    public function store(Request $request)
    {
        // Vérifier si id existe dans la requête
        $typeBienId = $request->input('typebien_id');

        if ($typeBienId) {
            // Si typebien_id existe, on modifie le TypeBien
            $typeBien = TypeBien::find($typeBienId);

            // Si le TypeBien n'existe pas, le créer
            if (!$typeBien) {
                // Créer un nouveau TypeBien
                return $this->createTypeBien($request);
            }

            // Si le TypeBien existe, procéder à la mise à jour
            return $this->updateTypeBien($typeBien, $request);
        } else {
            // Si typebien_id est absent, on crée un nouveau TypeBien
            return $this->createTypeBien($request);
        }
    }

    private function updateTypeBien(TypeBien $typeBien, Request $request)
    {
        $typeBien->update([
            'nom' => $request->name,
        ]);
        return response()->json(['message' => 'Type de bien mis à jour avec succès', 'typebien' => $typeBien], 200);
    }

    private function createTypeBien(Request $request)
    {
        // Création d'un nouveau TypeBien
        $typeBien = TypeBien::create([
            'nom' => $request->name,
        ]);

        return response()->json(['message' => 'Type de bien créé avec succès', 'typebien' => $typeBien], 201);
    }

    public function destroy($id)
    {
        $typeBien = TypeBien::findOrFail($id);
        $typeBien->delete();

        return response()->json(['message' => 'Type de bien supprimé avec succès']);
    }

}
