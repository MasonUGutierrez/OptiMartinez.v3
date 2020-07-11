<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultaServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('consulta-servicio'))
        {
            $this->down();
        }
        else{
            Schema::create('consulta-servicio', function (Blueprint $table) {
                $table->bigIncrements('id_consulta_servicio');
                $table->unsignedInteger('id_consulta');
                $table->unsignedInteger('id_servicio');
                $table->unsignedInteger('precio');
                $table->boolean('estado');
                
                // $table->primary('id_consulta_servicio');
                $table->foreign('id_consulta')
                    ->references('id_consulta')->on('consulta')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->foreign('id_servicio')
                    ->references('id_servicio')->on('servicio')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consulta-servicio');
    }
}
