<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biens', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->text('adresse');
            $table->decimal('superficie', 10, 2);
            $table->string('nombre_pieces')->nullable();
            $table->foreignId('type_bien_id')->constrained('type_biens')->onDelete('cascade');
            $table->foreignId('commune_id')->constrained('communes')->onDelete('cascade');
            $table->foreignId('parametre_status_id')->nullable()->constrained('parametre_status_biens')->onDelete('cascade');
            $table->foreignId('proprietaire_id')->nullable()->constrained('proprietaires')->onDelete('cascade');
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
        Schema::dropIfExists('biens');
    }
}
