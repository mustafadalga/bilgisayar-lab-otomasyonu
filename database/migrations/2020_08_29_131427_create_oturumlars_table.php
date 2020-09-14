<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOturumlarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oturumlar', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('lab_id');
            $table->smallInteger('egitmen_id');
            $table->smallInteger('gun');
            $table->smallInteger('saat');
            $table->string('ders');
            $table->string('derskod');
            $table->string('egitmen');
            $table->timestamps();
            $table->unique(['lab_id','gun','saat']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oturumlar');
    }
}
