<?php

namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\TypeBien;
use App\Models\Commune;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BienController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Affiche la liste des biens.
     */
    public function index()
    {
        $biens = Bien::with(['typeBien', 'commune'])->orderByDesc('created_at')->get();
        return view('biens.index', compact('biens'));
    }

    /**
     * Créer ou mettre à jour un bien.
     */
    public function store(Request $request)
    {
        $bienId = $request->input('bien_id');

        if ($bienId) {
            // Si bien_id existe, on modifie le bien
            $bien = Bien::find($bienId);
            if (!$bien) {
                return $this->createBien($request);
            }
            return $this->updateBien($bien, $request);
        } else {
            return $this->createBien($request);
        }
    }

    /**
     * Met à jour un bien existant.
     */
    private function updateBien($bien, Request $request)
    {
        $data = [
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'superficie' => $request->superficie,
            'nombre_pieces' => $request->nombre_pieces,
            'type_bien_id' => $request->type_bien_id,
            'commune_id' => $request->commune_id,
            'statut' => $request->statut,
        ];

        $bien->update($data);

        return response()->json(['message' => 'Bien mis à jour avec succès', 'bien' => $bien], 200);
    }

    /**
     * Crée un bien.
     */
    private function createBien(Request $request)
    {
        $bien = Bien::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'superficie' => $request->superficie,
            'nombre_pieces' => $request->nombre_pieces,
            'type_bien_id' => $request->type_bien_id,
            'commune_id' => $request->commune_id,
            'statut' => $request->statut,
        ]);

        return response()->json(['message' => 'Bien créé avec succès', 'bien' => $bien], 201);
    }

    /**
     * Supprime un bien.
     */
    public function destroy($id)
    {
        try {
            $bien = Bien::findOrFail($id);
            $bien->delete();

            return response()->json([
                'success' => true,
                'message' => 'Bien supprimé avec succès.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bien introuvable.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du Bien.',
            ], 500);
        }
    }
}
