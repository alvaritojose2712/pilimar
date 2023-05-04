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

            $table->decimal("efectivo_actual",10,2)->default(0);
            $table->decimal("efectivo_actual_cop",10,2)->default(0);
            $table->decimal("efectivo_actual_bs",10,2)->default(0);

            $table->decimal("puntodeventa_actual_bs",10,2)->default(0);

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

        DB::table("cierres")->insert([
            [
                "debito" =>0,
                "efectivo" =>0,
                "transferencia" =>0,
                "dejar_dolar" =>0,
                "dejar_peso" =>0,
                "dejar_bss" =>0,
                "efectivo_guardado" =>0,
                "efectivo_guardado_cop" =>0,
                "efectivo_guardado_bs" =>0,
                "efectivo_actual" =>0,
                "efectivo_actual_cop" =>0,
                "efectivo_actual_bs" =>0,
                "puntodeventa_actual_bs" =>0,
                "tasa" =>0,
                "nota" =>0,
                "fecha" =>"2023-01-01",
                "id_usuario" =>1,
                "numventas" =>0,
                "precio" =>0,
                "precio_base" =>0,
                "ganancia" =>0,
                "porcentaje" =>0,
                "desc_total" =>0,
                "push" =>0,
            ],
        ]);
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
