<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatComponentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_componente', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idPrograma')->unsigned();
            $table->string('nombre',200);
            // $table->string('imagen',200)->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idPrograma')
            ->references('id')->on('cat_programa')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_componente');
    }
}
