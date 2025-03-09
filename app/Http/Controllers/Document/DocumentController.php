<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Vérifier si des fichiers ont été envoyés
        if ($request->hasFile('documents')) {
            // Parcourir chaque fichier envoyé
            foreach ($request->file('documents') as $document) {
                // Créer un nom unique pour chaque fichier (vous pouvez utiliser un hash ou un identifiant unique)
                $hashedName = Str::uuid() . '.' . $document->getClientOriginalExtension();

                // Sauvegarder chaque fichier dans le répertoire 'cours' avec un nom unique
                $path = $document->storeAs('locataires', $hashedName);

                // Créer un enregistrement dans la base de données pour ce document
                Document::create([
                    'dossier_id' => $request->dossier_id,
                    'document' => $path,
                    'original_name' => $document->getClientOriginalName(),
                ]);
            }

            // Retourner une réponse pour indiquer que les documents ont été ajoutés avec succès
            return response()->json(['message' => 'Documents ajoutés avec succès!'], 200);
        }

        // Si aucun fichier n'est envoyé
        return response()->json(['message' => 'Aucun fichier sélectionné.'], 400);
    }

    public function destroy($id)
    {

        // Trouver le document par son ID
        $document = Document::find($id);

        // Vérifier si le document existe
        if (!$document)
        {
            return response()->json(['success' => false, 'message' => 'Document non trouvé'], 404);
        }
        // Supprimer le fichier du stockage
        if (Storage::exists($document->document)) {
            Storage::delete($document->document); // Supprimer le fichier
        }

        // Supprimer l'entrée dans la base de données
        $document->delete();

        return response()->json(['success' => true, 'message' => 'Document supprimé avec succès']);
    }
}
