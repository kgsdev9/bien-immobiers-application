<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
