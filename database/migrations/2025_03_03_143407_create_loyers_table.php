<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loyers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contrat_id');
            $table->date('mois');
            $table->decimal('montant_paye', 10, 2);
            $table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade');
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
        Schema::dropIfExists('loyers');
    }
}
