@extends('layouts.app')

@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="typeBienSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">

            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES TYPES DE BIENS
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Types de biens</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="app-content flex-column-fluid">
                <div class="app-container container-xxl">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class='fas fa-search position-absolute ms-5'></i>
                                    <input type="text"
                                        class="form-control form-control-solid w-250px ps-13 form-control-sm"
                                        placeholder="Rechercher" x-model="searchTerm" @input="filterTypeBiens">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button @click="printTypeBiens" class="btn btn-light-primary btn-sm">
                                        <i class="fa fa-print"></i> Imprimer
                                    </button>
                                    <button @click="exportTypeBiens" class="btn btn-light-primary btn-sm">
                                        <i class='fas fa-file-export'></i> Export
                                    </button>
                                    <button class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm"
                                        @click="showModal = true">
                                        <i class='fa fa-add'></i>
                                        Création
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body py-4">
                            <div class="table-responsive">
                                <template x-if="isLoading">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!isLoading">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                        <thead>
                                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-125px">Libellé Type de Bien</th>
                                                <th class="min-w-125px">Date de création</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="typeBien in paginatedTypeBiens" :key="typeBien.id">
                                                <tr>
                                                    <td x-text="typeBien.libelle"></td>
                                                    <td x-text="new Date(typeBien.created_at).toLocaleDateString('fr-FR')">
                                                    </td>
                                                    <td class="text-end">
                                                        <button @click="openModal(typeBien)"
                                                            class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="deleteTypeBien(typeBien.id)"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </template>
                            </div>

                            <div class="row mt-4">
                                <div class="col-sm-12 col-md-7 offset-md-5 d-flex justify-content-end">
                                    <nav>
                                        <ul class="pagination">
                                            <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
                                                <button class="page-link"
                                                    @click="goToPage(currentPage - 1)">Précédent</button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link"
                                                    @click="goToPage(currentPage + 1)">Suivant</button>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <template x-if="showModal">
            <div class="modal fade show d-block" tabindex="-1" aria-modal="true" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" x-text="isEdit ? 'Modification' : 'Création'"></h5>
                            <button type="button" class="btn-close" @click="hideModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Libellé Type de Bien</label>
                                    <input type="text" id="name" class="form-control" x-model="formData.libelle"
                                        required>
                                </div>

                                <button type="submit" class="btn btn-primary"
                                    x-text="isEdit ? 'Mettre à jour' : 'Enregistrer'"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function typeBienSearch() {
            return {
                searchTerm: '',
                typeBiens: @json($listeypebiens),
                filteredTypeBiens: [],
                showModal: false,
                isEdit: false,
                formData: {
                    libelle: '',
                },
                currentTypeBien: null,
                isLoading: false, // Initialisation de la variable isLoading
                currentPage: 1, // Initialisation de la variable currentPage
                totalPages: 1, // Tu peux ajuster cela plus tard en fonction du nombre total de pages de tes types de biens

                hideModal() {
                    this.showModal = false;
                    this.currentTypeBien = null;
                    this.resetForm();
                    this.isEdit = false;
                },

                openModal(typeBien = null) {
                    this.isEdit = typeBien !== null;
                    if (this.isEdit) {
                        this.currentTypeBien = {
                            ...typeBien
                        };
                        this.formData = {
                            libelle: this.currentTypeBien.libelle
                        };
                    } else {
                        this.resetForm();
                    }
                    this.showModal = true;
                },

                resetForm() {
                    this.formData = {
                        libelle: ''
                    };
                },

                async submitForm() {
                    if (!this.formData.libelle || this.formData.libelle.trim() === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Le libellé est requis.',
                            showConfirmButton: true
                        });
                        return;
                    }

                    const formData = new FormData();
                    formData.append('libelle', this.formData.libelle);

                    try {
                        this.isLoading = true; // On met isLoading à true pendant l'envoi
                        const response = await fetch('{{ route('typebiens.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const typeBien = data.typeBien;

                            Swal.fire({
                                icon: 'success',
                                title: 'Type de bien enregistré avec succès!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            if (this.isEdit) {
                                const index = this.typeBiens.findIndex(t => t.id === typeBien.id);
                                if (index !== -1) {
                                    this.typeBiens[index] = typeBien;
                                }
                            } else {
                                this.typeBiens.push(typeBien);
                                this.typeBiens.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                            }

                            this.filterTypeBiens();
                            this.resetForm();
                            this.hideModal();
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
                        this.isLoading = false; // On remet isLoading à false après l'envoi
                    }
                },

                get paginatedTypeBiens() {
                    let start = (this.currentPage - 1) * 10;
                    let end = start + 10;
                    return this.filteredTypeBiens.slice(start, end);
                },

                filterTypeBiens() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredTypeBiens = this.typeBiens.filter(typeBien => {
                        return typeBien.libelle && typeBien.libelle.toLowerCase().includes(term);
                    });
                },

                goToPage(page) {
                    this.currentPage = page;
                },

                init() {
                    this.filterTypeBiens();
                }
            };
        }
    </script>
@endsection
