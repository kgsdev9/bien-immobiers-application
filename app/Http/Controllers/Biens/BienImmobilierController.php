<?php

namespace App\Http\Controllers\Biens;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Commune;
use App\Models\TypeBien;
use Illuminate\Http\Request;

class BienImmobilierController extends Controller
{
    public function index()
    {
        $listebiens = Bien::with(['commune', 'typeBien'])->get();
        $listecommunes = Commune::orderByDesc('created_at')->get();
        $listetypesbiens = TypeBien::orderByDesc('created_at')->get();
        return view('biens.index', compact('listebiens', 'listecommunes', 'listetypesbiens'));
    }

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

        $bien->load('commune', 'typeBien');
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

        $bien->load('commune', 'typeBien');

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
