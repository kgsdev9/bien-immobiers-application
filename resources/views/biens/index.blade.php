@extends('layouts.app')
@section('title', 'Liste des biens')
@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="bienSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES BIENS
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">GESTION DES BIENS</li>
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
                                        placeholder="Rechercher" x-model="searchTerm" @input="filterUsers">
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end align-items-center gap-3">

                                    <div>
                                        <select x-model="commune_id" @change="filterByBien"
                                            class="form-select form-select-sm" data-live-search="true">
                                            <option value="">Toutes les communes</option>
                                            <template x-for="commune in communes" :key="commune.id">
                                                <option :value="commune.id" x-text="commune.nom">
                                                </option>
                                            </template>
                                        </select>
                                    </div>

                                    <div>
                                        <select x-model="typebien_id" @change="filterByBien"
                                            class="form-select form-select-sm" data-live-search="true">
                                            <option value="">Type de bien</option>
                                            <template x-for="type in typebien" :key="type.id">
                                                <option :value="type.id" x-text="type.nom">
                                                </option>
                                            </template>
                                        </select>
                                    </div>

                                    <button @click="printRapport" class="btn btn-light-primary btn-sm">
                                        <i class="fa fa-print"></i> Imprimer
                                    </button>
                                    <button @click="exportRaport" class="btn btn-light-primary btn-sm">
                                        <i class='fas fa-file-export'></i> Export
                                    </button>
                                    <button @click="showModal = true"
                                        class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm">
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
                                                <th class="min-w-125px">Nom</th>
                                                <th class="min-w-125px">Adresse</th>
                                                <th class="min-w-125px">Superficie</th>
                                                <th class="min-w-125px">Nombre de pièces</th>
                                                <th class="min-w-125px">Type de bien</th>
                                                <th class="min-w-125px">Commune</th>
                                                <th class="min-w-125px">Statut</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="bien in paginatedBiens" :key="bien.id">
                                                <tr>
                                                    <td x-text="bien.nom"></td>
                                                    <td x-text="bien.adresse"></td>
                                                    <td x-text="bien.superficie"></td>
                                                    <td x-text="bien.nombre_pieces"></td>
                                                    <td x-text="bien.type_bien.nom"></td>
                                                    <td x-text="bien.commune.nom"></td>
                                                    <td x-text="bien.status ? bien.status.name : 'Statut non défini'">
                                                    </td>


                                                    <td class="text-end">
                                                        <button @click="openModal(bien)"
                                                            class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="deleteBien(bien.id)"
                                                            class="btn btn-danger btn-sm mx-2">
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
                                                    @click="goToPage(currentPage - 1)">Précedent</button>
                                            </li>
                                            <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
                                                <button class="page-link"
                                                    @click="goToPage(currentPage + 1)">Suivant</button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <template x-if="showModal">
            <div class="modal fade show d-block" tabindex="-1" aria-modal="true" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" x-text="isEdite ? 'Modification du Bien' : 'Création d\'un Bien'">
                            </h5>
                            <button type="button" class="btn-close" @click="hideModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="row">
                                    <!-- Nom -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" id="nom" class="form-control" x-model="formData.nom"
                                            required>
                                    </div>

                                    <!-- Adresse -->
                                    <div class="col-md-6 mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" id="adresse" class="form-control"
                                            x-model="formData.adresse" required>
                                    </div>

                                    <!-- Superficie -->
                                    <div class="col-md-6 mb-3">
                                        <label for="superficie" class="form-label">Superficie (m²)</label>
                                        <input type="number" id="superficie" class="form-control"
                                            x-model="formData.superficie" required>
                                    </div>

                                    <!-- Nombre de pièces -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nombre_pieces" class="form-label">Nombre de pièces</label>
                                        <input type="number" id="nombre_pieces" class="form-control"
                                            x-model="formData.nombre_pieces" required>
                                    </div>

                                    <!-- Type de bien -->
                                    <div class="col-md-6 mb-3">
                                        <label for="type_bien_id" class="form-label">Type de Bien</label>
                                        <select id="type_bien_id" class="form-select" x-model="formData.type_bien_id"
                                            required>
                                            <option value="">Sélectionner un type</option>
                                            @foreach ($listetypesbiens as $typbien)
                                                <option value="{{ $typbien->id }}">
                                                    {{ $typbien->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Commune -->
                                    <div class="col-md-6 mb-3">
                                        <label for="commune_id" class="form-label">Commune</label>
                                        <select id="statut" class="form-select" x-model="formData.commune_id"
                                            required>
                                            <option value="">Choisir une commune</option>
                                            @foreach ($listecommunes as $commune)
                                                <option value="{{ $commune->id }}">
                                                    {{ $commune->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Statut -->
                                    <div class="col-md-6 mb-3">
                                        <label for="statut" class="form-label">Statut</label>
                                        <select id="statut" class="form-select" x-model="formData.statut" required>
                                            <option value="">Choisir un status</option>
                                            @foreach ($statusbien as $status)
                                                <option value="{{ $status->id }}">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-6 mb-3 mt-8">
                                        <label for="submit" class="form-label"></label>
                                        <button type="submit" class="btn btn-primary"
                                            x-text="isEdite ? 'Mettre à jour' : 'Enregistrer'"></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

    </div>


    <script>
        function bienSearch() {
            return {
                searchTerm: '',
                listBiens: @json($listebiens),
                communes: @json($listecommunes),
                typebien: @json($listetypesbiens),
                commune_id: '',
                typebien_id: '',
                filteredBiens: [],
                currentPage: 1,
                biensPerPage: 10,
                totalPages: 0,
                isLoading: false,
                showModal: false,
                isEdite: false,
                formData: {
                    nom: '',
                    adresse: '',
                    superficie: '',
                    nombre_pieces: '',
                    type_bien_id: '',
                    commune_id: '',
                    statut: ''
                },
                currentBien: null,

                // Méthode pour cacher le modal et réinitialiser les données
                hideModal() {
                    this.showModal = false;
                    this.currentBien = null;
                    this.resetForm();
                    this.isEdite = false;
                },

                // Méthode pour ouvrir le modal en mode création ou édition
                openModal(bien = null) {
                    this.isEdite = bien !== null;

                    if (this.isEdite) {
                        this.currentBien = {
                            ...bien
                        };

                        this.formData = {
                            nom: this.currentBien.nom,
                            adresse: this.currentBien.adresse,
                            superficie: this.currentBien.superficie,
                            nombre_pieces: this.currentBien.nombre_pieces,
                            type_bien_id: this.currentBien.type_bien_id,
                            commune_id: this.currentBien.commune_id,
                            statut: this.currentBien.parametre_status_id
                        };
                    } else {
                        this.resetForm();
                    }

                    this.showModal = true;
                },

                // Méthode pour réinitialiser le formulaire
                resetForm() {
                    this.formData = {
                        nom: '',
                        adresse: '',
                        superficie: '',
                        nombre_pieces: '',
                        type_bien_id: '',
                        commune_id: '',
                        statut: ''
                    };
                },

                // Méthode pour filtrer les biens en fonction du terme de recherche
                filterBiens() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredBiens = this.listBiens.filter(bien => {
                        return (
                            bien.nom && bien.nom.toLowerCase().includes(term) ||
                            bien.adresse && bien.adresse.toLowerCase().includes(term) ||
                            bien.superficie && bien.superficie.toString().toLowerCase().includes(term) ||
                            bien.nombre_pieces && bien.nombre_pieces.toString().toLowerCase().includes(term)
                        );
                    });
                    this.totalPages = Math.ceil(this.filteredBiens.length / this.biensPerPage);
                    this.currentPage = 1;
                },

                filterByBien() {
                    // Réinitialiser filteredBiens à la liste complète des biens
                    this.filteredBiens = this.listBiens;

                    // Filtrer par commune si une commune est sélectionnée
                    if (this.commune_id) {
                        this.filteredBiens = this.filteredBiens.filter(bien => bien.commune_id === parseInt(this
                            .commune_id));
                    }

                    // Filtrer par type de bien si un type est sélectionné
                    if (this.typebien_id) {
                        this.filteredBiens = this.filteredBiens.filter(bien => bien.type_bien_id === parseInt(this
                            .typebien_id));
                    }

                    // Optionnel : Appliquer également un filtrage par recherche textuelle (si nécessaire)
                    if (this.searchTerm) {
                        this.filteredBiens = this.filteredBiens.filter(bien => {
                            return (
                                bien.nom && bien.nom.toLowerCase().includes(this.searchTerm.toLowerCase()) ||
                                bien.adresse && bien.adresse.toLowerCase().includes(this.searchTerm
                                .toLowerCase()) ||
                                bien.superficie && bien.superficie.toString().toLowerCase().includes(this
                                    .searchTerm.toLowerCase()) ||
                                bien.nombre_pieces && bien.nombre_pieces.toString().toLowerCase().includes(this
                                    .searchTerm.toLowerCase())
                            );
                        });
                    }

                    // Calculer le nombre de pages en fonction du nombre de biens filtrés
                    this.totalPages = Math.ceil(this.filteredBiens.length / this.biensPerPage);

                    // Réinitialiser la page actuelle à la première page après filtrage
                    this.currentPage = 1;
                },


                // Méthode pour la pagination (aller à une page spécifique)
                goToPage(page) {
                    if (page < 1 || page > this.totalPages) return;
                    this.currentPage = page;
                },

                // Calculer les biens affichés pour la page actuelle
                get paginatedBiens() {
                    let start = (this.currentPage - 1) * this.biensPerPage;
                    let end = start + this.biensPerPage;
                    return this.filteredBiens.slice(start, end);
                },

                // Soumettre le formulaire pour créer/éditer un bien
                async submitForm() {
                    this.isLoading = true;

                    // Validation des champs requis
                    if (!this.formData.nom || !this.formData.adresse || !this.formData.superficie || !this.formData
                        .nombre_pieces) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tous les champs obligatoires doivent être remplis.',
                            showConfirmButton: true
                        });
                        this.isLoading = false;
                        return;
                    }

                    const formData = new FormData();
                    formData.append('nom', this.formData.nom);
                    formData.append('adresse', this.formData.adresse);
                    formData.append('superficie', this.formData.superficie);
                    formData.append('nombre_pieces', this.formData.nombre_pieces);
                    formData.append('type_bien_id', this.formData.type_bien_id);
                    formData.append('commune_id', this.formData.commune_id);
                    formData.append('statut', this.formData.statut);

                    // Si c'est une modification, ajoutez l'ID du bien
                    if (this.currentBien) {
                        formData.append('bien_id', this.currentBien.id);
                    }

                    try {
                        const response = await fetch('{{ route('biens.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const bien = data.bien;

                            if (bien) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bien enregistré avec succès!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                // Mettre à jour la liste des biens en fonction de l'action
                                if (this.isEdite) {
                                    const index = this.listBiens.findIndex(b => b.id === bien.id);
                                    if (index !== -1) this.listBiens[index] = bien;
                                } else {
                                    this.listBiens.push(bien);
                                }

                                // Trier par date de création décroissante
                                this.listBiens.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                                this.filterBiens(); // Refiltrer les biens après ajout/édition
                                this.resetForm(); // Réinitialiser le formulaire
                                this.hideModal(); // Cacher le modal
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

                // Méthode pour supprimer un bien
                async deleteBien(bienId) {
                    try {
                        const url = `{{ route('biens.destroy', ['bien' => '__ID__']) }}`.replace("__ID__", bienId);

                        const response = await fetch(url, {
                            method: "DELETE",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            },
                        });

                        if (response.ok) {
                            const result = await response.json();
                            if (result.success) {
                                Swal.fire({
                                    icon: "success",
                                    title: result.message,
                                    showConfirmButton: false,
                                    timer: 1500,
                                });

                                this.listBiens = this.listBiens.filter(bien => bien.id !== bienId);
                                this.filterBiens(); // Refiltrer les biens après suppression
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: result.message,
                                    showConfirmButton: true,
                                });
                            }
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Erreur lors de la requête.",
                                showConfirmButton: true,
                            });
                        }
                    } catch (error) {
                        console.error("Erreur réseau :", error);
                        Swal.fire({
                            icon: "error",
                            title: "Une erreur réseau s'est produite.",
                            showConfirmButton: true,
                        });
                    }
                },

                init() {
                    this.filterBiens();
                    this.isLoading = false;
                }
            };
        }
    </script>


@endsection
