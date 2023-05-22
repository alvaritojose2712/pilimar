<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string("identificacion",30)->unique();
            
            $table->string("nombre");
            $table->string("correo")->nullable();
            $table->text("direccion")->nullable();
            $table->string("telefono")->nullable();

            $table->string("estado")->nullable();
            $table->string("ciudad")->nullable();
            $table->timestamps();
        });
         DB::table("clientes")->insert([
            [
                "identificacion"=>"CF",
                "nombre"=>"CF",
                "correo"=>"CF",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
            [
                "identificacion"=>"ARAELZ",
                "nombre"=>"ARAELZ",
                "correo"=>"ARAELZ",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],

            [
                "identificacion"=>"ARAMCAL",
                "nombre"=>"ARAMCAL",
                "correo"=>"ARAMCAL",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
            [
                "identificacion"=>"ARAAGS",
                "nombre"=>"ARAAGS",
                "correo"=>"ARAAGS",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
            [
                "identificacion"=>"ARASMAN",
                "nombre"=>"ARASMAN",
                "correo"=>"ARASMAN",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
            [
                "identificacion"=>"ARABZAL",
                "nombre"=>"ARABZAL",
                "correo"=>"ARABZAL",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
            [
                "identificacion"=>"ARASFDO",
                "nombre"=>"ARASFDO",
                "correo"=>"ARASFDO",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ],
       
        ]);


         /*    $arrinsert = [];
        
        $con = new Mysqli("localhost","root","","administrativo2");
        
        $sql = $con->query("SELECT * FROM clientes");
            
        $i = 1;
        while($row = $sql->fetch_assoc()){
            array_push($arrinsert,[
                "identificacion"=>$row['id'],
                "nombre"=>$row['nombre'],
                "correo"=>"CF",
                "direccion"=>"CF",
                "telefono"=>"CF",
                "estado"=>"CF",
                "ciudad"=>"CF",
            ]);
            if ($i==1094) {
                DB::table("clientes")->insert($arrinsert);
                $arrinsert = [];
            }
            
            $i++;
                
        } */

        
            // [
            //     "identificacion"=>"26767116",
            //     "nombre"=>"Alvaro Ospino",
            //     "correo"=>"alvaroospino79",
            //     "direccion"=>"Mantecal",
            //     "telefono"=>"02409940793",
            //     "estado"=>"Apure",
            //     "ciudad"=>"Mantecal",
            // ],
            // [
            //     "identificacion"=>"12345678",
            //     "nombre"=>"Pedro Puerta",
            //     "correo"=>"pedropuerta79",
            //     "direccion"=>"Bruzual",
            //     "telefono"=>"02409940480",
            //     "estado"=>"Apure",
            //     "ciudad"=>"Bruzual",
            // ],
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
