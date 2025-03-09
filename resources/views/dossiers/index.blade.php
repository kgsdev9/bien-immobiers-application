@extends('layouts.app')
@section('title', 'Gestion électronique des dossiers')
@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" id="kt_app_main" x-data="dossierSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="d-flex flex-wrap flex-stack mb-6">
                        <h3 class="fw-bold my-2">
                            Dossiers de locations
                            <span class="fs-6 text-gray-500 fw-semibold ms-1">Electronique</span>
                        </h3>
                        <div class="d-flex my-2">
                            <div class="d-flex align-items-center position-relative me-4">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-3"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <input type="text" class="form-control form-control-sm border-body bg-body w-150px ps-10"
                                    placeholder="Rechercher" x-model="searchTerm" @input="filterDossiers">
                            </div>
                            <button @click="openModal()" class="btn btn-primary btn-sm">
                                Nouveau Dossier
                            </button>
                        </div>
                    </div>

                    <!-- Tableau des Dossiers -->
                    <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                        <template x-for="dossier in paginatedDossiers" :key="dossier.id">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-center text-center flex-column p-8">
                                        <!-- Dropdown Menu for Actions -->
                                        <div class="dropdown position-absolute top-0 end-0 mt-2 me-2">
                                            <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ki-duotone ki-dots-vertical fs-4"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="dropdown-item" href="#" @click="openModal(dossier)">Modifier</a></li>
                                                <li><a class="dropdown-item" href="#" @click="deleteDossier(dossier.id)">Supprimer</a></li>
                                                <li><a class="dropdown-item" href="#" @click="exportDossier(dossier)">Exporter</a></li>
                                            </ul>
                                        </div>

                                        <!-- Nom du dossier et lien vers la page de détails -->
                                        <a :href="'{{ route('dossiers.show', '') }}/' + dossier.id" class="text-gray-800 text-hover-primary d-flex flex-column">
                                            <div class="symbol symbol-75px mb-5">
                                                <img src="{{ asset('folder-document.svg') }}" class="theme-light-show" alt="">
                                                <img src="/keen/demo1/assets/media/svg/files/folder-document-dark.svg" class="theme-dark-show" alt="">
                                            </div>
                                            <div class="fs-5 fw-bold mb-2" x-text="dossier.codedossier"></div>
                                        </a>

                                        <!-- Nombre de documents -->
                                        <div class="fs-7 fw-semibold text-gray-500" x-text="dossier.documents_count + ' fichiers'"></div>

                                        <!-- Ajouter un document -->
                                        <div class="mt-2">
                                            <button @click="openAddDocumentModal(dossier)" class="btn btn-primary btn-sm">Ajouter un document</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
                            class="btn btn-light btn-sm">Précédent</button>
                        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages"
                            class="btn btn-light btn-sm">Suivant</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Modifier Dossier -->
        <template x-if="showModal">
            <div class="modal fade show d-block" tabindex="-1" aria-modal="true" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" x-text="isEditModal ? 'Modifier le Dossier' : 'Créer un Dossier'"></h5>
                            <button type="button" class="btn-close" @click="hideModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label for="locataire_id" class="form-label">Choisir le locataire</label>
                                    <select id="locataire_id" class="form-select" x-model="formData.locataire_id" required>
                                        <option value="">Choisir un locataire</option>
                                        @foreach ($locataires as $locataire)
                                            <option value="{{ $locataire->id }}">
                                                {{ $locataire->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    x-text="isEditModal ? 'Mettre à jour' : 'Enregistrer'"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Modal Ajouter un Document -->
        <template x-if="showAddDocumentModal">
            <div class="modal fade show d-block" tabindex="-1" aria-modal="true" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Ajouter un Document</h5>
                            <button type="button" class="btn-close" @click="hideAddDocumentModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="addDocument">
                                <div class="mb-3">
                                    <label for="document" class="form-label">Choisir un fichier</label>
                                    <!-- Assurez-vous que vous utilisez multiple pour permettre la sélection de plusieurs fichiers -->
                                    <input type="file" id="documents" class="form-control" @change="handleFileChange"
                                        multiple required />


                                </div>
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </div>

    <script>
        function dossierSearch() {
            return {
                searchTerm: '',
                dossiers: @json($listedossiers),
                filteredDossiers: [],
                showModal: false,
                showAddDocumentModal: false,
                isEditModal: false,
                formData: {
                    locataire_id: '',
                },
                documents: [],
                currentDossier: null,
                currentPage: 1,
                dossiersPerPage: 10,
                totalPages: 0,

                hideModal() {
                    this.showModal = false;
                    this.resetForm();
                    this.isEditModal = false;
                    this.currentDossier = null;
                },

                hideAddDocumentModal() {
                    this.showAddDocumentModal = false;
                },

                handleFileChange(event) {
                    // Récupérer les fichiers sélectionnés
                    this.documents = Array.from(event.target.files); // Convertir FileList en tableau
                },


                openModal(dossier = null) {
                    this.isEditModal = dossier !== null;
                    if (this.isEditModal) {
                        this.currentDossier = {
                            ...dossier
                        };
                        this.formData.locataire_id = this.currentDossier.locataire_id;
                    } else {
                        this.resetForm();
                    }
                    this.showModal = true;
                },

                openAddDocumentModal(dossier) {
                    this.currentDossier = dossier;
                    this.showAddDocumentModal = true;
                },

                resetForm() {
                    this.formData = {
                        locataire_id: ''
                    };
                },

                async submitForm() {
                    this.isLoading = true;

                    if (!this.formData.locataire_id || this.formData.locataire_id.trim() === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Le nom du locataire est requis.',
                            showConfirmButton: true
                        });
                        this.isLoading = false;
                        return;
                    }

                    const formData = new FormData();
                    formData.append('locataire_id', this.formData.locataire_id);
                    formData.append('dossier_id', this.currentDossier ? this.currentDossier.id : null);

                    try {
                        const response = await fetch('{{ route('dossiers.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const dossier = data.dossier;

                            if (dossier) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dossier enregistré avec succès !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                if (this.isEdite) {
                                    const index = this.dossiers.findIndex(d => d.id === dossier.id);
                                    if (index !== -1) {
                                        this.dossiers[index] = dossier;
                                    }
                                } else {
                                    this.dossiers.push(dossier);
                                    this.dossiers.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                                }

                                this.filterDossiers();
                                this.resetForm();
                                this.hideModal();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Dossier non valide.',
                                    showConfirmButton: true
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur lors de l\'enregistrement.',
                                showConfirmButton: true
                            });
                        }
                    } catch (error) {
                        console.error('Erreur réseau :', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Une erreur est survenue.',
                            showConfirmButton: true
                        });
                    } finally {
                        this.isLoading = false;
                    }
                },


                async addDocument() {
                    // Vérifier que des fichiers ont été sélectionnés
                    if (this.documents.length === 0) {
                        alert("Veuillez sélectionner des documents à ajouter.");
                        return;
                    }
                    const formData = new FormData();
                    this.documents.forEach(file => formData.append('documents[]', file));
                    formData.append('dossier_id', this.currentDossier.id);

                    try {
                        // Effectuer la requête POST pour envoyer les fichiers
                        const response = await fetch('{{ route('documents.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // Assurez-vous que le token CSRF est inclus
                            },
                            body: formData,
                        });

                        if (response.ok) {

                            Swal.fire({
                                icon: "success",
                                title: response.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            this.hideAddDocumentModal();
                            window.location.href = '{{ route('dossiers.index') }}';
                        } else {
                            alert("Erreur lors de l'ajout des documents.");
                        }
                    } catch (error) {
                        console.error('Error adding documents:', error);
                    }
                },



                get paginatedDossiers() {
                    let start = (this.currentPage - 1) * this.dossiersPerPage;
                    let end = start + this.dossiersPerPage;
                    return this.filteredDossiers.slice(start, end);
                },

                filterDossiers() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredDossiers = this.dossiers.filter(dossier => {
                        return dossier.codedossier && dossier.codedossier.toLowerCase().includes(term);
                    });
                    this.totalPages = Math.ceil(this.filteredDossiers.length / this.dossiersPerPage);
                    this.currentPage = 1;
                },

                goToPage(page) {
                    if (page < 1 || page > this.totalPages) return;
                    this.currentPage = page;
                },

                init() {
                    this.filterDossiers();
                }
            };
        }
    </script>
@endsection
