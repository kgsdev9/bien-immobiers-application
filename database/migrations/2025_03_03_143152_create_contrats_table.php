<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->string('codecontrat')->unique();
            $table->foreignId('locataire_id')->constrained('locataires')->onDelete('cascade');
            $table->foreignId('bien_id')->constrained('biens')->onDelete('cascade');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->decimal('montant_loyer', 30, 2);
            $table->decimal('caution', 30, 2);
            $table->foreignId('parametre_status_id')->nullable()->constrained('parametre_status_contrats')->onDelete('cascade');
            $table->string('document', 255)->nullable();
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
        Schema::dropIfExists('contrats');
    }
}
