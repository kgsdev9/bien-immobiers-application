@extends('layouts.app')
@section('title', 'Paiement Loyers')
@section('content')
    <div class="app-main flex-column flex-row-fluid mt-4" x-data="paiementSearch()" x-init="init()">
        <div class="d-flex flex-column flex-column-fluid">
            <div class="app-toolbar py-3 py-lg-6">
                <div class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            GESTION DES LOYERS
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Accueil</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-500 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">Loyers</li>
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
                                        <select x-model="selectedCategory" @change="filterByCategory"
                                            class="form-select form-select-sm" data-live-search="true">
                                            <option value="">Liste des locataires</option>
                                            <template x-for="category in categories" :key="category.id">
                                                <option :value="category.id" x-text="category.libellecategorieproduct">
                                                </option>
                                            </template>
                                        </select>
                                    </div>


                                    <div>
                                        <select x-model="selectedCategory" @change="filterByCategory"
                                            class="form-select form-select-sm" data-live-search="true">
                                            <option value="">Liste des mode reglement</option>
                                            <template x-for="category in categories" :key="category.id">
                                                <option :value="category.id" x-text="category.libellecategorieproduct">
                                                </option>
                                            </template>
                                        </select>
                                    </div>

                                    <button @click="printRapport" class="btn btn-light-primary btn-sm">
                                        <i class="fa fa-print"></i> Imprimer
                                    </button>
                                    <button @click="exportRaport" class="btn btn-light-primary btn-sm">
                                        <i class='fas fa-file-export'></i> Exporter
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
                                                <th class="min-w-125px">Contrat ID</th>
                                                <th class="min-w-125px">Mois Payé</th>
                                                <th class="min-w-125px">Montant (CFA)</th>
                                                <th class="min-w-125px">Date de Paiement</th>
                                                <th class="min-w-125px">Mode de Paiement</th>
                                                <th class="min-w-125px">Référence Paiement</th>
                                                <th class="text-end min-w-100px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-gray-600 fw-semibold">
                                            <template x-for="paiement in paginatedPaiements" :key="paiement.id">
                                                <tr>
                                                    <!-- Affichage du contrat_id -->
                                                    <td
                                                        x-text="paiement.contrat.locataire.nom + ' ' + paiement.contrat.locataire.prenom">
                                                    </td>

                                                    <!-- Affichage du mois payé, ici on affiche le nom du mois si disponible -->
                                                    <td x-text="paiement.mois.name"></td>
                                                    <!-- Assurez-vous que le champ est bien 'nom' ou modifiez-le en fonction de votre base de données -->

                                                    <!-- Affichage du montant -->
                                                    <td x-text="formatMontant(paiement.montant)"></td>

                                                    <!-- Affichage de la date de paiement -->
                                                    <td x-text="paiement.date_paiement"></td>

                                                    <!-- Affichage du mode de paiement -->
                                                    <td x-text="paiement.modereglement.name"></td>
                                                    <!-- Assurez-vous que 'nom' est le bon champ -->

                                                    <!-- Affichage de la référence de paiement -->
                                                    <td x-text="paiement.reference_paiement"></td>

                                                    <td class="text-end">
                                                        <button @click="openModal(paiement)"
                                                            class="btn btn-primary btn-sm mx-2">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button @click="deletePaiement(paiement.id)"
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
                                    <!-- Sélectionner un locataire avec dropdown personnalisé -->
                                    <div class="col-md-6 mb-3">
                                        <label for="contrat" class="form-label">Sélectionner un Locataire</label>
                                        <div class="custom-select-container">
                                            <div class="dropdown">
                                                <button class="btn btn-light dropdown-toggle w-100" type="button"
                                                    id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <template x-if="selectedLocataire.nom">
                                                        <div class="d-flex align-items-center">
                                                            <img x-bind:src="selectedLocataire.avatar || 'https://via.placeholder.com/40'"
                                                                alt="Avatar" class="rounded-circle me-2" width="40"
                                                                height="40" />
                                                            <div>
                                                                <strong x-text="selectedLocataire.nom"></strong>
                                                                <br />
                                                                <span class="text-muted"
                                                                    x-text="selectedLocataire.email"></span>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <span
                                                        x-text="selectedLocataire.nom ? '' : 'Aucun locataire sélectionné'"></span>
                                                </button>

                                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton">
                                                    <!-- Champ de recherche -->
                                                    <li class="px-2 py-1">
                                                        <input type="text" class="form-control"
                                                            placeholder="Rechercher..." x-model="searchQuery" />
                                                    </li>

                                                    <!-- Liste des locataires filtrée -->
                                                    <template x-for="contrat in filteredContrats()" :key="contrat.id">
                                                        <li class="dropdown-item d-flex align-items-center"
                                                            @click="updateContractInfo(contrat.id, contrat.locataire)"
                                                            style="cursor: pointer;">
                                                            <img src="https://via.placeholder.com/40" alt="Avatar"
                                                                class="rounded-circle me-2" width="40"
                                                                height="40" />
                                                            <div>
                                                                <strong x-text="contrat.locataire.nom"></strong>
                                                                <br />
                                                                <span class="text-muted"
                                                                    x-text="contrat.locataire.email"></span>
                                                            </div>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Affichage du Locataire et du Bien (dynamique) -->
                                    <div class="col-md-6 mb-3">
                                        <label for="locataire" class="form-label">Loyer à payer</label>
                                        <input type="text" id="locataire" class="form-control"
                                            x-model="formData.prixloyer" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="bien" class="form-label">Bien</label>
                                        <input type="text" id="bien" class="form-control"
                                            x-model="formData.bien_nom" disabled>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="commune" class="form-label">Commune Du bien </label>
                                        <input type="text" id="commune" class="form-control"
                                            x-model="formData.commune" disabled readonly>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="mois_id" class="form-label">Mois de paiements</label>
                                        <select id="mois_id" class="form-control" x-model="formData.mois_id" required>
                                            <option value="">Choisir un mois</option>
                                            @foreach ($listemois as $mois)
                                                <option value="{{ $mois->id }}">
                                                    {{ $mois->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="modereglement_id" class="form-label">Mode de reglement</label>
                                        <select id="modereglement_id" class="form-control"
                                            x-model="formData.modereglement_id" required>
                                            <option value="">Choisir un mode de reglement</option>
                                            @foreach ($listemodereglement as $modereglement)
                                                <option value="{{ $modereglement->id }}">
                                                    {{ $modereglement->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="date_paiement" class="form-label">Date de paiement</label>
                                        <input type="date" id="date_paiement" class="form-control"
                                            x-model="formData.date_paiement">
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
        function paiementSearch() {
            return {
                searchTerm: '',
                listePaiements: @json($listepayment),
                contrats: @json($contrats),
                filteredPaiements: [],
                currentPage: 1,
                paiementsPerPage: 10,
                totalPages: 0,
                isLoading: false,
                showModal: false,
                isEdite: false,
                formData: {
                    contrat_id: '',
                    mois_id: '',
                    montant: '',
                    date_paiement: '',
                    modereglement_id: '',
                    reference_paiement: '',
                    locataire_nom: '',
                    bien_nom: '',
                    prixloyer: '',
                    commune: '',
                },

                selectedLocataire: {
                    id: '',
                    nom: '',
                    email: '',
                    // avatar: 'https://via.placeholder.com/40'
                },
                searchQuery: '',
                currentPaiement: null,


                // Fonction pour formater les montants avec des séparateurs de milliers
                formatMontant(montant) {
                    // Vérifier si le montant est valide
                    if (isNaN(montant)) return montant;

                    // Convertir le montant en nombre et utiliser `toLocaleString` pour le formater
                    return parseFloat(montant).toLocaleString('fr-FR', {
                        style: 'decimal',
                        minimumFractionDigits: 0, // Pour afficher toujours deux décimales (ex. 1 000,00)
                        maximumFractionDigits: 0, // Limiter à deux décimales
                    });
                },


                hideModal() {
                    this.showModal = false;
                    this.currentPaiement = null;
                    this.resetForm();
                    this.isEdite = false;
                },

                filteredContrats() {
                    if (this.searchQuery.trim() === '') {
                        return this.contrats;
                    }
                    return this.contrats.filter(contrat =>
                        contrat.locataire.nom.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        contrat.locataire.email.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                updateContractInfo(contratId, locatiare) {
                    this.formData.contrat_id = contratId;

                    const selectedContract = this.contrats.find(contract => contract.id === this.formData.contrat_id);
                    if (selectedContract) {

                        this.selectedLocataire = {
                            nom: locatiare.nom || '',
                            email: locatiare.email || '',

                        };

                        this.formData.locataire_nom = selectedContract.locataire ? selectedContract.locataire.nom :
                            '';

                        this.formData.prixloyer = selectedContract.montant_loyer ? selectedContract.montant_loyer :
                            '';

                        this.formData.bien_nom = selectedContract.bien ? selectedContract.bien.nom : '';
                        this.formData.commune = selectedContract.bien ? selectedContract.bien.commune.nom : '';
                    } else {
                        this.formData.locataire_nom = '';
                        this.formData.bien_nom = '';
                    }
                },
                openModal(paiement = null) {
                    this.isEdite = paiement !== null;

                    if (this.isEdite) {
                        this.currentPaiement = {
                            ...paiement
                        };
                        // Mise à jour des données du formulaire
                        this.formData = {
                            contrat_id: this.currentPaiement.contrat_id,
                            mois_id: this.currentPaiement
                                .mois_id, // Utilisation de mois_id pour s'assurer que c'est le bon mois
                            montant: this.currentPaiement.montant,
                            date_paiement: this.currentPaiement.date_paiement,
                            modereglement_id: this.currentPaiement.modereglement_id,
                            reference_paiement: this.currentPaiement.reference_paiement,
                            // Ajouter des informations supplémentaires comme le locataire, bien, etc.
                            locataire_nom: this.currentPaiement.contrat.locataire.nom,
                            bien_nom: this.currentPaiement.contrat.bien.nom,
                            //     .nom, // Assurez-vous que `contrat` contient la relation avec `bien`
                            prixloyer: this.currentPaiement.contrat
                                .montant_loyer, // Assurez-vous que `contrat` contient la propriété `loyer`
                            commune: this.currentPaiement.contrat.bien
                                .commune.nom, // Assurez-vous que `contrat` contient la propriété `commune`
                        };

                        this.selectedLocataire = {
                            id: this.currentPaiement.contrat.locataire.id,
                            nom: this.currentPaiement.contrat.locataire.nom,
                            email: this.currentPaiement.contrat.locataire.email,
                            avatar: this.currentPaiement.contrat.locataire.avatar, // Si disponible
                        };
                    } else {
                        this.resetForm();
                    }

                    this.showModal = true;
                },


                resetForm() {
                    this.formData = {
                        contrat_id: '',
                        mois_id: '',
                        montant: '',
                        date_paiement: '',
                        modereglement_id: '',
                        reference_paiement: '',
                        locataire_nom: '',
                        bien_nom: '',
                        prixloyer: '',
                        commune: '',
                    };

                    this.selectedLocataire = {
                        id: '',
                        nom: '',
                        email: '',
                        // avatar: 'https://via.placeholder.com/40'
                    };
                },

                filterPaiements() {
                    const term = this.searchTerm.toLowerCase();
                    this.filteredPaiements = this.listePaiements.filter(paiement => {
                        return (
                            paiement.mois_paye && paiement.mois_paye.toLowerCase().includes(term) ||
                            paiement.montant && paiement.montant.toString().toLowerCase().includes(
                                term) ||
                            paiement.mode_paiement && paiement.mode_paiement.toLowerCase().includes(
                                term) ||
                            paiement.reference_paiement && paiement.reference_paiement.toLowerCase()
                            .includes(
                                term)
                        );
                    });
                    this.totalPages = Math.ceil(this.filteredPaiements.length / this.paiementsPerPage);
                    this.currentPage = 1;
                },

                goToPage(page) {
                    if (page < 1 || page > this.totalPages) return;
                    this.currentPage = page;
                },

                get paginatedPaiements() {
                    let start = (this.currentPage - 1) * this.paiementsPerPage;
                    let end = start + this.paiementsPerPage;
                    return this.filteredPaiements.slice(start, end);
                },

                async submitForm() {
                    this.isLoading = true;
                    const formData = new FormData();
                    formData.append('contrat_id', this.formData.contrat_id);
                    formData.append('mois_id', this.formData.mois_id);
                    formData.append('montant', this.formData.prixloyer);
                    formData.append('date_paiement', this.formData.date_paiement);
                    formData.append('modereglement_id', this.formData.modereglement_id);

                    if (this.currentPaiement) {
                        formData.append('paiement_id', this.currentPaiement.id);
                    }

                    try {
                        const response = await fetch('{{ route('paiements.store') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: formData,
                        });

                        if (response.ok) {
                            const data = await response.json();
                            const paiement = data.paiement;

                            if (paiement) {
                                // Si le paiement a été effectué avec succès
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Paiement enregistré avec succès!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });

                                if (this.isEdite) {
                                    const index = this.listePaiements.findIndex(p => p.id === paiement.id);
                                    if (index !== -1) this.listePaiements[index] = paiement;
                                } else {
                                    this.listePaiements.push(paiement);
                                }

                                this.listePaiements.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
                                this.filterPaiements();
                                this.resetForm();
                                this.hideModal();
                            }
                        } else {
                            // Si le paiement existe déjà
                            const data = await response.json();
                            if (data.paiement_existe) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Le paiement pour ce mois a déjà été effectué sous ce contrat.',
                                    showConfirmButton: true
                                });
                            } else {
                                // Si une autre erreur se produit
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur lors de l\'enregistrement.',
                                    showConfirmButton: true
                                });
                            }
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


                async deletePaiement(paiementId) {
                    try {
                        const url = `{{ route('paiements.destroy', ['paiement' => '__ID__']) }}`.replace(
                            "__ID__",
                            paiementId);

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

                                this.listePaiements = this.listePaiements.filter(paiement => paiement.id !==
                                    paiementId);
                                this.filterPaiements();
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
                    this.filterPaiements();
                    this.isLoading = false;
                }
            };
        }
    </script>


@endsection
