@extends('layouts.app')
@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="contratSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">

            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES CONTRATS
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
                                        placeholder="Rechercher" x-model="searchTerm" @input="filterContrats">
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
                                                <th class="min-w-125px">Locataire</th>
                                                <th class="min-w-125px">Bien</th>
                                                <th class="min-w-125px">Date Début</th>
                                                <th class="min-w-125px">Date Fin</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="contrat in filteredContrats" :key="contrat.id">
                                                <tr>
                                                    <td x-text="contrat.locataire.nom"></td>
                                                    <td x-text="contrat.bien.nom"></td>
                                                    <td x-text="contrat.date_debut"></td>
                                                    <td x-text="contrat.date_fin"></td>
                                                    <td class="text-end">
                                                        <button @click="openModal(contrat)" class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <button @click="deleteContrat(contrat.id)" class="btn btn-danger btn-sm">
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
                                    <label for="locataire_id" class="form-label">Locataire</label>
                                    <select id="locataire_id" class="form-control" x-model="formData.locataire_id" required>
                                        <option value="">Choisir un locataire</option>
                                        <template x-for="locataire in locataires" :key="locataire.id">
                                            <option :value="locataire.id" x-text="locataire.nom"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bien_id" class="form-label">Bien</label>
                                    <select id="bien_id" class="form-control" x-model="formData.bien_id" required>
                                        <option value="">Choisir un bien</option>
                                        <template x-for="bien in biens" :key="bien.id">
                                            <option :value="bien.id" x-text="bien.nom"></option>
                                        </template>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="date_debut" class="form-label">Date Début</label>
                                    <input type="date" id="date_debut" class="form-control" x-model="formData.date_debut" required>
                                </div>
                                <div class="mb-3">
                                    <label for="date_fin" class="form-label">Date Fin</label>
                                    <input type="date" id="date_fin" class="form-control" x-model="formData.date_fin" required>
                                </div>
                                <div class="mb-3">
                                    <label for="montant_loyer" class="form-label">Montant Loyers</label>
                                    <input type="number" step="0.01" id="montant_loyer" class="form-control" x-model="formData.montant_loyer" required>
                                </div>
                                <div class="mb-3">
                                    <label for="caution" class="form-label">Caution</label>
                                    <input type="number" step="0.01" id="caution" class="form-control" x-model="formData.caution" required>
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
        function contratSearch() {
            return {
                searchTerm: '',
                contrats: @json($contrats),
                filteredContrats: [],
                locataires: @json($locataires),
                biens: @json($biens),
                currentContrat: null,
                showModal: false,
                isEdite: false,
                formData: {
                    locataire_id: '',
                    bien_id: '',
                    date_debut: '',
                    date_fin: '',
                    montant_loyer: '',
                    caution: ''
                },

                hideModal() {
                    this.showModal = false;
                    this.currentContrat = null;
                    this.resetForm();
                    this.isEdite = false;
                },

                openModal(contrat = null) {
                    this.isEdite = contrat !== null;
                    if (this.isEdite) {
                        this.currentContrat = { ...contrat };
                        this.formData = { ...this.currentContrat };
                    } else {
                        this.resetForm();
                    }
                    this.showModal = true;
                },

                resetForm() {
                    this.formData = {
                        locataire_id: '',
                        bien_id: '',
                        date_debut: '',
                        date_fin: '',
                        montant_loyer: '',
                        caution: ''
                    };
                },

                async submitForm() {
                    this.isLoading = true;

                    if (!this.formData.locataire_id || !this.formData.bien_id || !this.formData.date_debut || !this.formData.date_fin || !this.formData.montant_loyer || !this.formData.caution) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tous les champs sont requis.',
                            showConfirmButton: true
                        });
                        this.isLoading = false;
                        return;
                    }

                    const formData = new FormData();
                    formData.append('locataire_id', this.formData.locataire_id);
                    formData.append('bien_id', this.formData.bien_id);
                    formData.append('date_debut', this.formData.date_debut);
                    formData.append('date_fin', this.formData.date_fin);
                    formData.append('montant_loyer', this.formData.montant_loyer);
                    formData.append('caution', this.formData.caution);
                    formData.append('contrat_id', this.currentContrat ? this.currentContrat.id : null);

                    try {
                        const response = await fetch('{{ route('contrat.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const contrat = data.contrat;

                            if (contrat) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Contrat enregistré avec succès !',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                if (this.isEdite) {
                                    const index = this.contrats.findIndex(c => c.id === contrat.id);
                                    if (index !== -1) {
                                        this.contrats[index] = contrat;
                                    }
                                } else {
                                    this.contrats.push(contrat);
                                    this.contrats.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                                }

                                this.filterContrats();
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

                deleteContrat(contratId) {
                    // Code pour supprimer un contrat
                },

                filterContrats() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredContrats = this.contrats.filter(contrat =>
                        contrat.locataire.nom.toLowerCase().includes(term) ||
                        contrat.bien.nom.toLowerCase().includes(term)
                    );
                },

                init() {
                    this.filterContrats();
                    this.isLoading = false;
                }
            };
        }
    </script>
@endsection
