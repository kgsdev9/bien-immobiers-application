@extends('layouts.app')
@section('title', 'Detail dossier')
@section('content')
    <div class="app-main flex-column flex-row-fluid" x-data="detailDossier({{ json_encode($dossier) }}, {{ json_encode($documents) }})" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Visualisation du dossier de <span
                                x-text="dossier.locataire ? dossier.locataire.nom : 'Locataire inconnu'"></span></h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted"><a href="#"
                                    class="text-muted text-hover-primary">Accueil</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-500 w-5px h-2px"></span></li>
                            <li class="breadcrumb-item text-muted">Visualisation</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <!-- Card for title and navigation -->
                    <div class="card card-flush pb-0 bgi-position-y-center bgi-no-repeat mb-10"
                        style="background-size: auto calc(100% + 10rem); background-position-x: 100%; background-image: url('/keen/demo4/assets/media/illustrations/sketchy-1/4.png')">
                        <!--begin::Card header-->
                        <div class="card-header pt-10">
                            <div class="d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="symbol symbol-circle me-5">
                                    <div
                                        class="symbol-label bg-transparent text-primary border border-secondary border-dashed">
                                        <i class="ki-duotone ki-abstract-47 fs-2x text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>
                                <!--end::Icon-->
                                <!--begin::Title-->
                                <div class="d-flex flex-column">
                                    <h2 class="mb-1" x-text="dossier.locataire?.nom ?? 'N/A'"></h2>
                                    <div class="text-muted fw-bold">
                                        <a href="#">Keenthemes</a>
                                        <span class="mx-3">|</span>
                                        <a href="#">File Manager</a>
                                        <span class="mx-3">|</span>
                                        2.6 GB
                                        <span class="mx-3">|</span>
                                        758 items
                                    </div>
                                </div>
                                <!--end::Title-->
                            </div>
                        </div>

                        <div class="card-body pb-0">

                        </div>

                    </div>


                    <div class="card card-flush">
                        <div class="card-header pt-8">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-1 position-absolute ms-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="text" class="form-control form-control-solid w-250px ps-15"
                                        placeholder="Rechercher un document" x-model="searchQuery" x-debounce="500ms">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-flex btn-primary">

                                        Télecharger des fichiers
                                    </button>
                                    &nbsp;
                                    <button type="button" class="btn btn-primary btn-sm ">
                                        Exporter
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table for documents -->
                        <div class="card-body">
                            <div class="d-flex flex-stack">
                                <div class="badge badge-lg badge-light-primary">
                                    <div class="d-flex align-items-center flex-wrap">
                                        <i class="ki-duotone ki-abstract-32 fs-2 text-primary me-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <a href="#">Gestion </a>
                                        <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                        <a href="#">electronique</a>
                                        <i class="ki-duotone ki-right fs-2 text-primary mx-1"></i>
                                        <a href="#">documents</a>
                                    </div>
                                </div>
                                <div class="badge badge-lg badge-primary">
                                    <span x-text="filteredDocuments.length + ' fichiers'"></span>
                                </div>
                            </div>

                            <!-- Document Table -->
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <thead>
                                        <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                            <th>Libelle document</th>
                                            <th>Date création</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template x-for="document in filteredDocuments" :key="document.id">
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-files fs-2x text-primary me-4"></i>
                                                        <a :href="document.url" class="text-gray-800 text-hover-primary"
                                                            x-text="document.original_name"></a>
                                                    </div>
                                                </td>

                                                <td x-text="document.created_at"></td>
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-end">
                                                        <button @click="viewDocument(document.document)"
                                                            class="btn btn-sm btn-icon btn-light btn-active-light-primary"
                                                            title="Visualiser le document">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-eye"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8 3c-4.418 0-8 3-8 6s3.582 6 8 6 8-3 8-6-3.582-6-8-6zm0 10a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-7a3 3 0 1 0 0 6 3 3 0 0 0 0-6z" />
                                                            </svg>
                                                        </button>

                                                        &nbsp &nbsp;
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-light btn-active-light-danger"
                                                            title="Supprimer le document" @click="confirmDelete()">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
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
                searchQuery: '',
                init() {
                    console.log("Dossier chargé :", this.dossier);
                    console.log("Documents :", this.documents);
                },
                get filteredDocuments() {
                    if (!this.searchQuery) {
                        return this.documents;
                    }
                    return this.documents.filter(doc =>
                        doc.original_name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                viewDocument(documentPath) {
                    const url = '/s3/' + documentPath; // URL du document
                    window.open(url, '_blank', 'width=800,height=600'); // Ouvre le document dans une nouvelle fenêtre
                }
            };
        }
    </script>
@endpush
