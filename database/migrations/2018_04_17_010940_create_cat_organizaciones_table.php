<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatOrganizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_organizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idComponente');
            $table->string('nombre',200);
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('idComponente')
            // ->references('id')->on('cat_componente')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_organizacion');
    }
}
