<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrat_id')->constrained('contrats')->onDelete('cascade');
            $table->date('mois_paye');
            $table->decimal('montant', 10, 2);
            $table->dateTime('date_paiement');
            $table->enum('mode_paiement', ['Espèces', 'Virement', 'Mobile Money', 'Chèque']);
            $table->string('reference_paiement', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paiements');
    }
}
