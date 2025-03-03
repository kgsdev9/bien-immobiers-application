<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocatairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locataires', function (Blueprint $table) {
            $table->id();
            $table->string('code_locataire', 50)->unique();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone', 20)->unique();
            $table->string('email', 100)->unique();
            $table->text('adresse');
            $table->string('profession', 100);
            $table->string('piece_identite', 255);
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
        Schema::dropIfExists('locataires');
    }
}
