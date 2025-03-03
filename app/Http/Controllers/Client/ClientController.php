<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Commune;
use App\Models\Locataire;
use App\Models\TClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listelocataires = Locataire::orderByDesc('created_at')->get();
        return view('clients.index', compact('listelocataires'));
    }

    public function store(Request $request)
    {
        $locataireId = $request->input('locataire_id');

        if ($locataireId) {
            // Si locataire_id existe, on modifie le locataire
            $locataire = Locataire::find($locataireId);

            // Si le locataire n'existe pas, le créer
            if (!$locataire) {
                return $this->createLocataire($request);
            }

            // Si le locataire existe, procéder à la mise à jour
            return $this->updateLocataire($locataire, $request);
        } else {
            // Si locataire_id est absent, on crée un nouveau locataire
            return $this->createLocataire($request);
        }
    }

    private function updateLocataire($locataire, Request $request)
    {

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'profession' => $request->profession,
            'piece_identite' => $request->piece_identite,
        ];

        $locataire->update($data);

        return response()->json(['message' => 'Locataire mis à jour avec succès', 'locataire' => $locataire], 200);
    }

    /**
     * Générer un code locataire unique.
     */
    public function generateLocataireCode()
    {
        $prefix = 'LOC-';

        // Générer un code unique
        $randomPart = str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);

        $existingCode = Locataire::where('code_locataire', $prefix . $randomPart)->first();

        if ($existingCode) {
            return $this->generateLocataireCode();
        }

        return $prefix . $randomPart;
    }

    private function createLocataire(Request $request)
    {
        $email = $request->email;

        if ($email && Locataire::where('email', $email)->exists()) {
            $email = $this->generateUniqueEmail($email);
        }

        $locataire = Locataire::create([
            'code_locataire' => $this->generateLocataireCode(),
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'email' => $email,
            'adresse' => $request->adresse,
            'profession' => $request->profession,
            'piece_identite' => $request->piece_identite,
        ]);

        return response()->json(['message' => 'Locataire créé avec succès', 'locataire' => $locataire], 201);
    }

    /**
     * Générer un email unique en ajoutant un suffixe incrémental.
     */
    private function generateUniqueEmail($email)
    {
        $originalEmail = $email;
        $i = 1;

        [$localPart, $domain] = explode('@', $email);

        while (Locataire::where('email', $email)->exists()) {
            $email = "{$localPart}_{$i}@{$domain}";
            $i++;
        }

        return $email;
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
            $locataire = Locataire::findOrFail($id);
            $locataire->delete();

            return response()->json([
                'success' => true,
                'message' => 'Locataire supprimé avec succès.',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Locataire introuvable.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression du Locataire.',
            ], 500);
        }
    }
}
