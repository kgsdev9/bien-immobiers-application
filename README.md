 Améliorations possibles :
🔸 Gestion des propriétaires (si certains biens appartiennent à plusieurs propriétaires)
🔸 Gestion des charges (électricité, eau, syndic, etc.)
🔸 Suivi des impayés et alertes automatiques
🔸 Ajout d’un statut "En attente de paiement" pour les paiements

 Contrat::where('locataire_id', $request->locataire_id)

  protected $fillable = [
        'contrat_id', 'mois_id', 'montant', 'date_paiement',
        'modereglement_id', 'reference_paiement'
    ];


 $table->string('name');

    $table->enum('mode_paiement', ['Espèces', 'Virement', 'Mobile Money', 'Chèque']);
 $table->enum('statut', ['Disponible', 'Loué', 'Réservé'])->default('Disponible');

            $table->enum('etat', ['Actif',
*
