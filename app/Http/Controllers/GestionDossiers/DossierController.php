<?php

namespace App\Http\Controllers\GestionDossiers;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use App\Models\Locataire;
use Dom\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
class DossierController extends Controller
{


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
        $listedossiers = Dossier::withCount('documents')->get();
        $locataires  = Locataire::all();
        return view('dossiers.index', compact('listedossiers', 'locataires'));
    }

    public function store(Request $request)
    {
        // Vérifier si dossier_id existe dans la requête
        $dossierId = $request->input('dossier_id');

        if ($dossierId) {
            // Si dossier_id existe, on modifie le dossier
            $dossier = Dossier::find($dossierId);

            // Si le dossier n'existe pas, le créer
            if (!$dossier) {
                return $this->createDossier($request);
            }

            // Si le dossier existe, procéder à la mise à jour
            return $this->updateDossier($dossier, $request);
        } else {
            // Si dossier_id est absent, on crée un nouveau dossier
            return $this->createDossier($request);
        }
    }



    public function show($dossierId)
    {
        $dossier = Dossier::with(['documents', 'locataire'])->find($dossierId); // Charger les documents liés
        if (!$dossier) {
            abort(404, 'Dossier non trouvé');
        }

        return view('dossiers.detail', [
            'dossier' => $dossier,
            'documents' => $dossier->documents // Passer les documents associés
        ]);
    }


    private function updateDossier(Dossier $dossier, Request $request)
    {
        // Mise à jour du dossier
        $dossier->update([
            'locataire_id' => $request->locataire_id,
            'codedossier' => $this->generateCodedossier($dossier->locataire->nom), // Regénère le codedossier
        ]);

        return response()->json(['message' => 'Dossier mis à jour avec succès', 'dossier' => $dossier], 200);
    }

    private function createDossier(Request $request)
    {
        // Vérification que le locataire existe
        $locataire = Locataire::find($request->locataire_id);
        if (!$locataire) {
            return response()->json(['message' => 'Locataire non trouvé'], 404);
        }

        // Vérifier si ce locataire a déjà un dossier
        $existingDossier = Dossier::where('locataire_id', $request->locataire_id)->first();
        if ($existingDossier) {
            return response()->json(['message' => 'Ce locataire a déjà un dossier.'], 400);
        }

        // Génération du codedossier basé sur le nom du locataire
        $codedossier = $this->generateCodedossier($locataire->nom);

        // Création d'un nouveau dossier
        $dossier = Dossier::create([
            'locataire_id' => $request->locataire_id,
            'codedossier' => $codedossier,
        ]);

        return response()->json(['message' => 'Dossier créé avec succès', 'dossier' => $dossier], 201);
    }

    private function generateCodedossier($locataireName)
    {
        // Générer un code unique pour le dossier en combinant le nom du locataire et un numéro aléatoire
        $randomNumber = rand(1000, 9999); // Ex : Kahouo-9834
        return $locataireName . '-' . $randomNumber;
    }

    public function destroy($id)
    {
        // Supprimer le dossier
        $dossier = Dossier::find($id);

        if (!$dossier) {
            return response()->json(['message' => 'Dossier non trouvé'], 404);
        }

        $dossier->delete();

        return response()->json(['message' => 'Dossier supprimé avec succès'], 200);
    }





public function export()
{
    // Récupérer tous les documents (ajustez cela selon votre logique)
    $documents = Document::all();

    // Créer un fichier ZIP
    $zip = new ZipArchive();
    $zipFileName = 'documents_export.zip';
    $zipPath = storage_path('app/' . $zipFileName);

    // Ouvrir un fichier ZIP pour ajouter les fichiers
    if ($zip->open($zipPath, ZipArchive::CREATE) !== TRUE) {
        return response()->json(['error' => 'Impossible de créer le fichier ZIP'], 500);
    }

    // Ajouter chaque document au fichier ZIP
    foreach ($documents as $document)
    {
        $filePath = storage_path('app/s3/' . $document->file_name);  // Adaptez ce chemin selon votre logique
        if (file_exists($filePath)) {
            $zip->addFile($filePath, $document->original_name);  // Ajoute le fichier avec son nom d'origine
        }
    }

    // Fermer le fichier ZIP
    $zip->close();

    // Retourner le fichier ZIP en téléchargement
    return response()->download($zipPath)->deleteFileAfterSend(true);
}

}
