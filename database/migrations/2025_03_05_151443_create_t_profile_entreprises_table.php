<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTProfileEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_profile_entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('siteweb')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('fax')->nullable();
            $table->string('numerodecompte')->nullable();
            $table->string('adresse')->nullable();
            $table->string('capital')->nullable();
            $table->string('type_entreprise')->nullable();
            $table->string('logo')->nullable();
            $table->string('numero_tva')->nullable();
            $table->string('telephone')->nullable();
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
        Schema::dropIfExists('t_profile_entreprises');
    }
}
