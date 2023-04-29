<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres', function (Blueprint $table) {
            $table->increments('id');
            
            $table->decimal("debito",10,2); 
            $table->decimal("efectivo",10,2); 
            $table->decimal("transferencia",10,2); 

            $table->decimal("dejar_dolar",10,2); 
            $table->decimal("dejar_peso",10,2); 
            $table->decimal("dejar_bss",10,2);


            $table->decimal("efectivo_guardado",10,2);
            $table->decimal("efectivo_guardado_cop",10,2);
            $table->decimal("efectivo_guardado_bs",10,2);

            $table->decimal("tasa",10,2); 
            
            $table->text("nota")->nullable();
            
            $table->date("fecha");
            
            $table->integer("id_usuario")->unsigned();
            $table->foreign('id_usuario')->references('id')->on('usuarios');

            
            
            $table->integer("numventas")->default(0); 

            $table->decimal("precio",10,2)->default(0);
            $table->decimal("precio_base",10,2)->default(0);
            $table->decimal("ganancia",10,2)->default(0);
            $table->decimal("porcentaje",10,2)->default(0);
            $table->decimal("desc_total",10,2)->default(0);
            
            $table->boolean("push")->default(0);

            $table->unique(["fecha","id_usuario"]);

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
        Schema::dropIfExists('cierres');
    }
}
