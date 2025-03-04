@extends('layouts.app')

@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="communeSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">

            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES COMMUNES
                        </h1>
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

                                    <input type="text" class="form-control form-control-solid w-250px ps-13 form-control-sm"
                                        placeholder="Rechercher" x-model="searchTerm" @input="filterCommunes">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button @click="showModal = true" class="btn btn-light btn-active-light-primary btn-sm">
                                        <i class='fa fa-add'></i> Création
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
                                                <th class="min-w-125px">Libellé Commune</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="commune in filteredCommunes" :key="commune.id">
                                                <tr>
                                                    <td x-text="commune.nom"></td>
                                                    <td class="text-end">
                                                        <button @click="openModal(commune)" class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button @click="deleteCommune(commune.id)" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </template>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pour création et modification -->
        <template x-if="showModal">
            <div class="modal fade show d-block" tabindex="-1" aria-modal="true" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" x-text="isEdite ? 'Modification' : 'Création'"></h5>
                            <button type="button" class="btn-close" @click="hideModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nom de la Commune</label>
                                    <input type="text" id="name" class="form-control" x-model="formData.name" required>
                                </div>
                                <button type="submit" class="btn btn-primary" x-text="isEdite ? 'Mettre à jour' : 'Enregistrer'"></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        function communeSearch() {
            return {
                searchTerm: '',
                communes: @json($communes),
                filteredCommunes: [],
                currentCommune: null,
                showModal: false,
                isEdite: false,
                formData: {
                    name: '',
                },

                hideModal() {
                    this.showModal = false;
                    this.currentCommune = null;
                    this.resetForm();
                    this.isEdite = false;
                },

                openModal(commune = null) {
                    this.isEdite = commune !== null;
                    if (this.isEdite) {
                        this.currentCommune = { ...commune };
                        this.formData = { name: this.currentCommune.nom };
                    } else {
                        this.resetForm();
                    }
                    this.showModal = true;
                },

                resetForm() {
                    this.formData = { name: '' };
                },

                async submitForm() {
                    this.isLoading = true;

                    if (!this.formData.name || this.formData.name.trim() === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Le nom de la commune est requis.',
                            showConfirmButton: true
                        });
                        this.isLoading = false;
                        return;
                    }

                    const formData = new FormData();
                    formData.append('name', this.formData.name);
                    formData.append('commune_id', this.currentCommune ? this.currentCommune.id : null);

                    try {
                        const response = await fetch('{{ route('communes.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const commune = data.commune;

                            if (commune) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Commune enregistrée avec succès !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                if (this.isEdite) {
                                    const index = this.communes.findIndex(c => c.id === commune.id);
                                    if (index !== -1) {
                                        this.communes[index] = commune;
                                    }
                                } else {
                                    this.communes.push(commune);
                                    this.communes.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                                }

                                this.filterCommunes();
                                this.resetForm();
                                this.hideModal();
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

                deleteCommune(communeId) {
                    // Code pour supprimer une commune
                },

                filterCommunes() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredCommunes = this.communes.filter(commune =>
                        commune.nom.toLowerCase().includes(term)
                    );
                },

                init() {
                    this.filterCommunes();
                    this.isLoading = false;
                }
            };
        }
    </script>
@endsection
