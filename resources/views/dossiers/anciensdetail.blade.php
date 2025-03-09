@extends('layouts.app')

@section('content')
    <div class="app-main flex-column flex-row-fluid">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Visualisation du dossier de <span
                                x-text="dossier.locataire ? dossier.locataire.nom : 'Locataire inconnu'"></span>
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Visualisation</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-content flex-column-fluid" x-data="detailDossier({{ json_encode($dossier) }}, {{ json_encode($documents) }})" x-init="init()">
                <div class="app-container container-xxl">

                    <div class="d-flex flex-column flex-lg-row">
                        <div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
                            <div class="card">

                                <div class="card-header pt-10">
                                    <div class="d-flex align-items-center">
                                        <!--begin::Icon-->
                                        <div class="symbol symbol-circle me-5">
                                            <div
                                                class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                                <i class="ki-duotone ki-abstract-47 fs-2x text-primary"><span
                                                        class="path1"></span><span class="path2"></span></i>
                                            </div>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Title-->
                                        <div class="d-flex flex-column">
                                            <h2 class="mb-1">File Manager</h2>
                                            <div class="text-muted fw-bold">
                                                <a href="#">Keenthemes</a> <span class="mx-3">|</span> <a
                                                    href="#">File Manager</a> <span class="mx-3">|</span> 2.6 GB
                                                <span class="mx-3">|</span> 758 items
                                            </div>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>


                                {{-- <div class="card-header">
                                    <h3 class="card-title">Dossier : <span x-text="dossier.codedossier"></span></h3>
                                </div>
                                <div class="card-body">
                                    <h5>Informations du locataire :</h5>
                                    <p><strong>Nom :</strong> <span x-text="dossier.locataire?.nom ?? 'N/A'"></span></p>
                                    <p><strong>Email :</strong> <span x-text="dossier.locataire?.email ?? 'N/A'"></span></p>
                                    <p><strong>Téléphone :</strong> <span x-text="dossier.locataire?.telephone ?? 'N/A'"></span></p>

                                    <h5 class="mt-4">Documents associés :</h5>
                                    <ul>
                                        <template x-for="document in documents" :key="document.id">
                                            <li>
                                                <a :href="'/s3/' + document.document" target="_blank" x-text="document.original_name"></a>
                                            </li>
                                        </template>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>

                        <div class="flex-lg-row-auto w-100 w-lg-300px">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Actions</h5>
                                    <a :href="'/dossiers/' + dossier.id + '/edit'" class="btn btn-warning">Modifier</a>
                                    <form :action="'/dossiers/' + dossier.id" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function detailDossier(dossier, documents) {
            return {
                dossier: dossier,
                documents: documents,
                init() {
                    console.log("Dossier chargé :", this.dossier);
                    console.log("Documents :", this.documents);
                },
            };
        }
    </script>
@endpush
