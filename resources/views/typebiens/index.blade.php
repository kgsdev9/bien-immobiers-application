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
                    </div>
                </div>
            </div>

            <div class="app-content flex-column-fluid">
                <div class="app-container container-xxl">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end align-items-center gap-3">
                                    <button @click="showModal = true" class="btn btn-light btn-active-light-primary btn-sm">
                                        <i class="fa fa-add"></i> Création
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
                                                <th class="min-w-125px">Nom Type Bien</th>
                                                <th class="min-w-125px">Date de création</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="typeBien in paginatedTypeBiens" :key="typeBien.id">
                                                <tr>
                                                    <td x-text="typeBien.nom"></td>
                                                    <td x-text="new Date(typeBien.created_at).toLocaleDateString('fr-FR')"></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                    <label for="name" class="form-label">Nom Type Bien</label>
                                    <input type="text" id="name" class="form-control" x-model="formData.name" required>
                                </div>
                                <button type="submit" class="btn btn-primary"
                                    x-text="isEdite ? 'Mettre à jour' : 'Enregistrer'"></button>
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
                currentPage: 1,
                typeBiensPerPage: 10,
                totalPages: 0,
                isLoading: true,
                showModal: false,
                isEdite: false,
                formData: { name: '' },
                currentTypeBien: null,

                hideModal() {
                    this.showModal = false;
                    this.resetForm();
                    this.isEdite = false;
                },

                openModal(typeBien = null) {
                    this.isEdite = typeBien !== null;
                    if (this.isEdite) {
                        this.currentTypeBien = { ...typeBien };
                        this.formData = { name: this.currentTypeBien.nom };
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
                    const formData = new FormData();
                    formData.append('name', this.formData.name);
                    formData.append('typebien_id', this.currentTypeBien ? this.currentTypeBien.id : null);

                    try {
                        const response = await fetch('{{ route('typebiens.store') }}', {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const typeBien = data.typebien;

                            if (typeBien) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Type de bien enregistré avec succès !',
                                    showConfirmButton: false,
                                    timer: 1500,
                                });

                                if (this.isEdite) {
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
                            }
                        } else {
                            Swal.fire({ icon: 'error', title: 'Erreur lors de l\'enregistrement.', showConfirmButton: true });
                        }
                    } catch (error) {
                        console.error('Erreur réseau :', error);
                        Swal.fire({ icon: 'error', title: 'Une erreur est survenue.', showConfirmButton: true });
                    } finally {
                        this.isLoading = false;
                    }
                },

                get paginatedTypeBiens() {
                    let start = (this.currentPage - 1) * this.typeBiensPerPage;
                    let end = start + this.typeBiensPerPage;
                    return this.filteredTypeBiens.slice(start, end);
                },

                filterTypeBiens() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredTypeBiens = this.typeBiens.filter(t => t.nom && t.nom.toLowerCase().includes(term));
                    this.totalPages = Math.ceil(this.filteredTypeBiens.length / this.typeBiensPerPage);
                    this.currentPage = 1;
                },

                async deleteTypeBien(id) {
                    try {
                        const response = await fetch(`{{ route('typebiens.destroy', '__ID__') }}`.replace('__ID__', id), {
                            method: 'DELETE',
                            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        });

                        if (response.ok) {
                            const result = await response.json();
                            Swal.fire({ icon: 'success', title: result.message, showConfirmButton: false, timer: 1500 });

                            this.typeBiens = this.typeBiens.filter(t => t.id !== id);
                            this.filterTypeBiens();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Erreur lors de la requête.', showConfirmButton: true });
                        }
                    } catch (error) {
                        console.error("Erreur réseau :", error);
                        Swal.fire({ icon: "error", title: "Une erreur réseau s'est produite.", showConfirmButton: true });
                    }
                },

                init() {
                    this.filterTypeBiens();
                    this.isLoading = false;
                },
            };
        }
    </script>
@endsection
