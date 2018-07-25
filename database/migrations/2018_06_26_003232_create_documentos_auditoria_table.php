<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosAuditoriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_auditoria', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idAuditoria')->unsigned();
            $table->string('documento');
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idAuditoria')
            ->references('id')->on('auditoria')
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
        Schema::dropIfExists('documento_auditoria');
    }
}
