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
            $table->foreignId('mois_id')->constrained('mois')->onDelete('cascade');
            $table->foreignId('modereglement_id')->constrained('mode_reglements')->onDelete('cascade');
            $table->decimal('montant', 30, 2);
            $table->dateTime('date_paiement');
            $table->string('reference_paiement')->unique();
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
