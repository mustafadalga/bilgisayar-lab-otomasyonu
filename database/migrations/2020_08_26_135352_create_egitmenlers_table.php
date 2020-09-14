<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEgitmenlersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('egitmenler', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('user_id');
            $table->string('adi');
            $table->string('profil_resim')->nullable();
            $table->mediumText('hakkinda')->nullable();
            $table->string('email')->unique();
            $table->string('telefon')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->mediumText('egitim')->nullable();
            $table->string('slug');
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
        Schema::dropIfExists('egitmenler');
    }
}
