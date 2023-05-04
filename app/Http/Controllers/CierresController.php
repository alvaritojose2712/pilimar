<?php

namespace App\Http\Controllers;

use App\Models\cierres;
use Illuminate\Http\Request;

class CierresController extends Controller
{
    public function getStatusCierre(Request $req)
    {
        $tipo_accion = cierres::where("fecha",$req->fechaCierre)->where("id_usuario",session("id_usuario"))->first();
        if ($tipo_accion) {
            $tipo_accion = "editar"; 
        }else{
            $tipo_accion = "guardar"; 

        }

        return ["tipo_accionCierre"=>$tipo_accion];
    }
    public function getTotalizarCierre(Request $req)
    {
       /*  cierres::where
        caja_usd
        caja_cop
        caja_bs
        caja_punto */
    }
}
