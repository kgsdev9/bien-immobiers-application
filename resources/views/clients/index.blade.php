@extends('layouts.app')
@section('title', 'Liste des clients')
@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="userSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES LOCATAIRES
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Locataires</li>
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
                                                <th class="min-w-125px">Code Locataire</th>
                                                <th class="min-w-125px">Nom</th>
                                                <th class="min-w-125px">Prénom</th>
                                                <th class="min-w-125px">Téléphone</th>
                                                <th class="min-w-125px">Email</th>
                                                <th class="min-w-125px">Adresse</th>
                                                <th class="min-w-125px">Profession</th>
                                                <th class="min-w-125px">Pièce d'Identité</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="client in paginatedUsers" :key="client.id">
                                                <tr>
                                                    <td x-text="client.code_locataire"></td>
                                                    <td x-text="client.nom"></td>
                                                    <td x-text="client.prenom"></td>
                                                    <td x-text="client.telephone"></td>
                                                    <td x-text="client.email"></td>
                                                    <td x-text="client.adresse"></td>
                                                    <td x-text="client.profession"></td>
                                                    <td x-text="client.piece_identite"></td>
                                                    <td class="text-end">
                                                        <button @click="openModal(client)"
                                                            class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="deleteClient(client.id)"
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
                            <h5 class="modal-title" x-text="isEdite ? 'Modification' : 'Création'"></h5>
                            <button type="button" class="btn-close" @click="hideModal()"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="submitForm">
                                <div class="row">
                                    <!-- Code Locataire -->
                                    <div class="col-md-6 mb-3">
                                        <label for="code_locataire" class="form-label">Code Locataire</label>
                                        <input type="text" id="code_locataire" class="form-control"
                                            x-model="formData.code_locataire" required>
                                    </div>

                                    <!-- Nom -->
                                    <div class="col-md-6 mb-3">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input type="text" id="nom" class="form-control" x-model="formData.nom"
                                            required>
                                    </div>

                                    <!-- Prénom -->
                                    <div class="col-md-6 mb-3">
                                        <label for="prenom" class="form-label">Prénom</label>
                                        <input type="text" id="prenom" class="form-control"
                                            x-model="formData.prenom" required>
                                    </div>

                                    <!-- Téléphone -->
                                    <div class="col-md-6 mb-3">
                                        <label for="telephone" class="form-label">Téléphone</label>
                                        <input type="text" id="telephone" class="form-control"
                                            x-model="formData.telephone">
                                    </div>

                                    <!-- Email -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control"
                                            x-model="formData.email" required>
                                    </div>

                                    <!-- Adresse -->
                                    <div class="col-md-6 mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" id="adresse" class="form-control"
                                            x-model="formData.adresse">
                                    </div>

                                    <!-- Profession -->
                                    <div class="col-md-6 mb-3">
                                        <label for="profession" class="form-label">Profession</label>
                                        <input type="text" id="profession" class="form-control"
                                            x-model="formData.profession">
                                    </div>

                                    <!-- Pièce d'identité -->
                                    <div class="col-md-6 mb-3">
                                        <label for="piece_identite" class="form-label">Pièce d'Identité</label>
                                        <input type="text" id="piece_identite" class="form-control"
                                            x-model="formData.piece_identite">
                                    </div>

                                    <div class="col-md-6 mb-3 mt-8">
                                        <label for="tcodedevise_id" class="form-label"></label>
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
        function userSearch() {
            return {
                searchTerm: '',
                listelocataires: @json($listelocataires), // Données venant de Laravel
                filteredUsers: [],
                currentPage: 1,
                usersPerPage: 10,
                totalPages: 0,
                isLoading: false,
                showModal: false,
                isEdite: false,
                formData: {
                    code_locataire: '',
                    nom: '',
                    prenom: '',
                    telephone: '',
                    email: '',
                    adresse: '',
                    profession: '',
                    piece_identite: ''
                },
                currentClient: null,

                // Méthode pour cacher le modal et réinitialiser les données
                hideModal() {
                    this.showModal = false;
                    this.currentClient = null;
                    this.resetForm();
                    this.isEdite = false;
                },

                // Méthode pour ouvrir le modal en mode création ou édition
                openModal(client = null) {
                    this.isEdite = client !== null;

                    if (this.isEdite) {
                        this.currentClient = {
                            ...client
                        };

                        this.formData = {
                            code_locataire: this.currentClient.code_locataire,
                            nom: this.currentClient.nom,
                            prenom: this.currentClient.prenom,
                            telephone: this.currentClient.telephone,
                            email: this.currentClient.email,
                            adresse: this.currentClient.adresse,
                            profession: this.currentClient.profession,
                            piece_identite: this.currentClient.piece_identite
                        };
                    } else {
                        this.resetForm();
                    }

                    this.showModal = true;
                },

                // Méthode pour réinitialiser le formulaire
                resetForm() {
                    this.formData = {
                        code_locataire: '',
                        nom: '',
                        prenom: '',
                        telephone: '',
                        email: '',
                        adresse: '',
                        profession: '',
                        piece_identite: ''
                    };
                },

                // Méthode pour filtrer les locataires en fonction du terme de recherche
                filterUsers() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredUsers = this.listelocataires.filter(user => {
                        return (
                            user.nom && user.nom.toLowerCase().includes(term) ||
                            user.prenom && user.prenom.toLowerCase().includes(term) ||
                            user.telephone && user.telephone.toLowerCase().includes(term) ||
                            user.email && user.email.toLowerCase().includes(term)
                        );
                    });
                    this.totalPages = Math.ceil(this.filteredUsers.length / this.usersPerPage);
                    this.currentPage = 1;
                },

                // Méthode pour la pagination (aller à une page spécifique)
                goToPage(page) {
                    if (page < 1 || page > this.totalPages) return;
                    this.currentPage = page;
                },

                // Calculer les locataires affichés pour la page actuelle
                get paginatedUsers() {
                    let start = (this.currentPage - 1) * this.usersPerPage;
                    let end = start + this.usersPerPage;
                    return this.filteredUsers.slice(start, end);
                },

                // Soumettre le formulaire pour créer/éditer un locataire
                async submitForm() {
                    this.isLoading = true;

                    // Validation des champs requis
                    if (!this.formData.nom || !this.formData.prenom || !this.formData.telephone || !this.formData
                        .email) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tous les champs obligatoires doivent être remplis.',
                            showConfirmButton: true
                        });
                        this.isLoading = false;
                        return;
                    }

                    const formData = new FormData();
                    formData.append('code_locataire', this.formData.code_locataire);
                    formData.append('nom', this.formData.nom);
                    formData.append('prenom', this.formData.prenom);
                    formData.append('telephone', this.formData.telephone);
                    formData.append('email', this.formData.email);
                    formData.append('adresse', this.formData.adresse);
                    formData.append('profession', this.formData.profession);
                    formData.append('piece_identite', this.formData.piece_identite);

                    // Si c'est une modification, ajoutez l'ID du client
                    if (this.currentClient) {
                        formData.append('locataire_id', this.currentClient.id);
                    }

                    try {
                        const response = await fetch('{{ route('clients.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const client = data.locataire;


                            if (client) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Client enregistré avec succès!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                // Mettre à jour la liste des locataires en fonction de l'action
                                if (this.isEdite) {
                                    const index = this.listelocataires.findIndex(u => u.id === client.id);
                                    if (index !== -1) this.listelocataires[index] = client;
                                } else {
                                    this.listelocataires.push(client);
                                }


                                // Trier par date de création décroissante
                                this.listelocataires.sort((a, b) => new Date(b.created_at) - new Date(a
                                    .created_at));
                                this.filterUsers(); // Refiltrer les utilisateurs après ajout/édition
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

                // Méthode pour supprimer un locataire
                async deleteClient(clientId) {
                    try {
                        const url = `{{ route('clients.destroy', ['client' => '__ID__']) }}`.replace("__ID__",
                            clientId);

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

                                this.listelocataires = this.listelocataires.filter(client => client.id !== clientId);
                                this.filterUsers(); // Refiltrer les utilisateurs après suppression
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
                    this.filterUsers();
                    this.isLoading = false;
                }
            };
        }
    </script>

@endsection
