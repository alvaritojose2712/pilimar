<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\fallas;
use App\Models\movimientos_caja;
use App\Models\sucursal;
use App\Models\moneda;
use App\Models\factura;

use App\Models\inventario;
use App\Models\categorias;
use App\Models\proveedores;
use App\Models\pedidos;

use Illuminate\Support\Facades\Cache;

use Http;
use Response;

ini_set('max_execution_time', 300);
class sendCentral extends Controller
{
    
    public function path()
    {
        //return "http://127.0.0.1:8001";
        return "https://arabitonline.com";
    }
    public function setSocketUrlDB(Request $req)
    {
        return "127.0.0.1";
    }
    public function getDataEspecifica($type,$url)
    {
        $sucursal = sucursal::all()->first();
        $arr = [];
        switch ($type) {
            case 'inventariSucursalFromCentral':
                
                $arr = [
                    //"categorias" => categorias::all(),
                    //"proveedores" => proveedores::all(),
                    "inventario" => inventario::all(),
                ];

                break;
            case 'fallaspanelcentroacopio':
                $arr = ["fallas"=> fallas::all()];
                
                break;
            case 'estadisticaspanelcentroacopio':
                $arr = [];
                break;
            case 'gastospanelcentroacopio':
                $arr = [];
                break;
            case 'cierrespanelcentroacopio':
                $arr = [];
                break;
            case 'diadeventapanelcentroacopio':
                $arr = (new PedidosController)->getDiaVentaFun((new PedidosController)->today());
                break;
        }
        $arr["sucursal"] = $sucursal;


        $response = Http::post($this->path()."/".$url, $arr);
    
        if ($response->ok()) {
            $res = $response->json();
            return $res;        
        }else{
            return "Error: ".$response->body();
        } 
        return $arr;
    }
    public function setInventarioFromSucursal()
    {
        return $this->getDataEspecifica("inventariSucursalFromCentral","setInventarioFromSucursal");
    }

    public function setNuevaTareaCentral(Request $req)
    {
        $type = $req->type;
        $response = Http::post($this->path()."/setNuevaTareaCentral",["type"=>$type]);

        if ($response->ok()) {
            $res = $response->json();
            return $res;
        }else{
            return "Error: ".$response->body();

        }
    }
    public function index()
    {
        return view("central.index");
    }
    // public function update($new_version)
    // {}
    //     $runproduction = "npm run production";        
    //     // $phpArtisan = "php artisan key:generate && php artisan view:cache && php artisan route:cache && php artisan config:cache";

    //     $pull = shell_exec("cd C:\sinapsisfacturacion && git stash && git pull https://github.com/alvaritojose2712/sinapsisfacturacion.git && composer install --optimize-autoloader --no-dev");

    //     if (!str_contains($pull, "Already up to date")) {
    //         echo "Éxito al Pull. Building...";
    //         exec("cd C:\sinapsisfacturacion && ".$runproduction." && ".$phpArtisan,$output, $retval);

    //         if (!$retval) {
    //             echo "Éxito al Build. Actualizado...";

    //             sucursal::update(["app_version",$new_version]);
    //         }
    //     }else{
    //         echo "Pull al día. No requiere actualizar <br>";
    //         echo "<pre>$pull</pre>";

    //     }
    // }


    //req
    public function setPedidoInCentralFromMaster($id,$type="add")
    {
        $response = Http::post($this->path()."/setPedidoInCentralFromMasters",["type"=>$type,"pedidos"=>$this->pedidosExportadosFun($id)]);

        return $response->body();

    }
    public function getip()
    {
        return getHostByName(getHostName());
    }
    public function getmastermachine()
    {
        return ["192.168.0.103:8001","192.168.0.102:8001","127.0.0.1:8001"];
    }
    public function changeExportStatus($pathcentral,$id)
    {
        $response = Http::post($this->path()."/changeExtraidoEstadoPed",["id"=>$id]);
    }
    public function setnewtasainsucursal(Request $req)
    {
        $tipo = $req->tipo;
        $valor = $req->valor;
        $id_sucursal = $req->id_sucursal;
        
        
        
        $response = Http::post($this->path()."/setnewtasainsucursal",[
            "tipo"=>$tipo,
            "valor"=>$valor,
            "id_sucursal"=>$id_sucursal,
        ]);
        if ($response->ok()) {
            $res = $response->json();
            return $res;
        }else{
            return "Error: ".$response->body();
        }
    }
    public function getInventarioSucursalFromCentral(Request $req)
    {
        /* $id = $req->id;
        $type = $req->type;
        $response = Http::post($this->path()."/getInventarioSucursalFromCentral",[
            "id"=>$id,
            "type"=>$type,
        ]);
        if ($response->ok()) {
            $res = $response->json();
            return $res;
        }else{
            return "Error: ".$response->body();
        } */
    }
    public function getSucursales()
    {
        $response = Http::get($this->path()."/getSucursales");
        if ($response->ok()) {
            $res = $response->json();
            return $res;
        }else{
            return "Error: ".$response->body();
        } 

    }
    public function getInventarioFromSucursal(Request $req)
    {
        $sucursal = sucursal::all()->first();
        $response = Http::post($this->path()."/getInventarioFromSucursal",[
            "sucursal"=>$sucursal,
        ]);
        
        if ($response->ok()) {
            $res = $response->json();
            if ($res) {
                if (isset($res["estado"])) {
                    return $res;
                }else{
                    $arr_convert = [];
                    foreach ($res as $key => $e) {
                        $find = inventario::with(["categoria","proveedor"])->where("id",$e["id_pro_sucursal_fixed"])->first();
                        if ($find) {
                            $find["type"] = "original";
                            array_push($arr_convert,$find);
    
                        }
                        $e["type"] = "replace";
                        array_push($arr_convert,$e);
                    }
                    return $arr_convert;
                }
            }else{
                return $response;
            }
        }else{
            
            return "Error de Local Centro de Acopio: ".$response->body();
        } 

    }
    public function changeEstatusProductoProceced($ids,$id_sucursal)
    {
        $response = Http::post($this->path()."/changeEstatusProductoProceced",[
            "ids"=>$ids,
            "id_sucursal"=>$id_sucursal,
        ]);
        
        if ($response->ok()) {
            if ($response->json()) {
                
                return $response->json();
            }else{
                return $response;
            }
        }else{
            
            return "Error de Local Centro de Acopio: ".$response->body();
        } 
    }
    public function setCambiosInventarioSucursal(Request $req)
    {
         $response = Http::post($this->path()."/setCambiosInventarioSucursal",[
            "productos"=>$req->productos,
            "sucursal"=>$req->sucursal,
        ]);
        
        if ($response->ok()) {
            if ($response->json()) {
                
                return $response->json();
            }else{
                return $response;
            }
        }else{
            
            return "Error de Local Centro de Acopio: ".$response->body();
        } 
    }
    public function reqpedidos(Request $req)
    {   
        try {
            $sucursal = sucursal::all()->first();

            $response = Http::post($this->path().'/respedidos',["codigo"=>$sucursal->codigo]);

            if ($response->ok()) {
                $res = $response->json();
                if ($res["pedido"]) {
                    return $res["pedido"];
                }else{
                    return "Not [pedido] ".var_dump($res);
                }
            }else{
                return "Error: ".$response->body();

            }
            
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
        }
    }

    //res
    public function pedidosExportadosFun($id)
    {
        return pedidos::with(["cliente","items"=>function($q){
            $q->with(["producto"=>function($q){
                $q->with(["proveedor","categoria"]);
            }]);
        }])
        ->where("id",$id)
        ->orderBy("id","desc")
        ->get()
        ->map(function($q){
            $q->base = $q->items->map(function($q){
                return $q->producto->precio_base*$q->cantidad;
            })->sum();
            $q->venta = $q->items->sum("monto");
            return $q;

        });
    }
    /* public function respedidos(Request $req)
    {
        

        if ($ped) {
            return Response::json([
                "msj"=>"Tenemos algo :D",
                "pedido"=>$ped,
                "estado"=>true
            ]);
        }else{
            return Response::json([
                "msj"=>"No hay pedidos pendientes :(",
                "estado"=>false
            ]);
        }
    } */
    public function resinventario(Request $req)
    {
        //return "exportinventario";
        return [
            "inventario"=>inventario::all(),
            "categorias" => categorias::all(),
            "proveedores" => proveedores::all(), 
        ];
    }


    

    public function updateApp()
    {   
        try {
            
            $sucursal = sucursal::all()->first();
            $actually_version = $sucursal["app_version"];

            $getVersion = Http::get($this->path."/getVersionRemote");

            if ($getVersion->ok()) {

                $server_version = $getVersion->json();
                if ($actually_version!=$server_version) {
                    $this->update($server_version);
                }else if($actually_version==$server_version){
                    return "Sistema al día :)";
                }else{
                    return "Upps.. :("."V-Actual=".$actually_version." V-Remote".$server_version;

                };
            }
        } catch (\Exception $e) {
            return "Error: ".$e->getMessage();
        }

    }
    

    public function getInventarioCentral()
    {
        try {
            $sucursal = sucursal::all()->first();
            $response = Http::post($this->path.'/getInventario', [
                "sucursal_code"=>$sucursal->codigo,

            ]);
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }
        
    }

    public function setGastos()
    {
        try {
            $sucursal = sucursal::all()->first();
            $movimientos_caja = movimientos_caja::all();

            if (!$movimientos_caja->count()) {
                return Response::json(["msj"=>"Nada que enviar","estado"=>false]);
            }


            $response = Http::post($this->path.'/setGastos', [
                "sucursal_code"=>$sucursal->codigo,
                "movimientos_caja"=>$movimientos_caja
            ]);

            //ids_ok => id de movimiento 

            if ($response->ok()) {
                $res = $response->json();
                if ($res["estado"]) {
                    return $res["msj"];
                }
            }else{
                return $response->body();
            }   
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }
    }
    public function setFacturasCentral()
    {
        try {
            $sucursal = sucursal::all()->first();
            $facturas = factura::with(["proveedor","items"=>function($q){
                $q->with("producto");
            }])
            ->where("push",0)->get();


            if (!$facturas->count()) {
                return Response::json(["msj"=>"Nada que enviar","estado"=>false]);
            }


            $response = Http::post($this->path.'/setConfirmFacturas', [
                "sucursal_code"=>$sucursal->codigo,
                "facturas"=>$facturas
            ]);

            //ids_ok => id de movimiento 

            if ($response->ok()) {
                $res = $response->json();
                if (isset($res["estado"])) {
                    if ($res["estado"]) {
                        factura::where("push",0)->update(["push"=>1]);
                        return $res["msj"];
                    }

                }else{

                    return $response;
                }
            }else{
                return $response->body();
            }   
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }
    }
    public function setCentralData()
    {
        try {
            $sucursal = sucursal::all()->first();
            $fallas = fallas::all();

            if (!$fallas->count()) {
                return Response::json(["msj"=>"Nada que enviar","estado"=>false]);
            }


            $response = Http::post($this->path.'/setFalla', [
                "sucursal_code"=>$sucursal->codigo,
                "fallas"=>$fallas
            ]);

            //ids_ok => id de productos 

            if ($response->ok()) {
                $res = $response->json();
                // code...

                if ($res["estado"]) {

                    return $res["msj"];
                }
            }else{
                
                return $response;
            }            
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }


    }

    public function setVentas()
    {
        try {
            $PedidosController = new PedidosController; 
            $sucursal = sucursal::all()->first();
            $fecha = $PedidosController->today();
            $bs = $PedidosController->get_moneda()["bs"];

            $cierre_fun = $PedidosController->cerrarFun($fecha,0,0,0);

                  // 1 Transferencia
                   // 2 Debito 
                   // 3 Efectivo 
                   // 4 Credito  
                   // 5 Otros
                   // 6 vuelto

            $ventas = [
                "debito"=> $cierre_fun[2],
                "efectivo"=>$cierre_fun[3],
                "transferencia"=> $cierre_fun[1],
                "biopago"=> $cierre_fun[5],
                "tasa"=>$bs,
                "fecha"=>$cierre_fun["fecha"],
                "num_ventas"=>$cierre_fun["numventas"],
            ];


            $response = Http::post($this->path.'/setVentas', [
                "sucursal_code"=>$sucursal->codigo,
                "ventas"=>$ventas
            ]);

            //ids_ok => id de movimiento 

            if ($response->ok()) {
                $res = $response->json();
                if ($res["estado"]) {
                   return $res["msj"];
                }
            }else{
                return $response->body();
            }            
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }

    }
   

   

    public function sendInventario()
    {
        try {
            $inventario = InventarioController::all(); 
            


            $response = Http::post($this->path.'/sendInventario', [
                "sucursal_code"=>$sucursal->codigo,
                "inventario"=>$inventario
            ]);

            //ids_ok => id de movimiento 

            if ($response->ok()) {
                $res = $response->json();
                if ($res["estado"]) {
                   return $res["msj"];
                }
            }else{
                return $response->body();
            }            
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
            
        }
    }
    public function updatetasasfromCentral()
    {
        try {
            $sucursal = sucursal::all()->first();

            $response = Http::post($this->path().'/getMonedaSucursal',["codigo"=>$sucursal->codigo]);

            if ($response->ok()) {
                $res = $response->json();
                foreach ($res as $key => $e) {
                    moneda::updateOrCreate(["tipo"=>$e["tipo"]], [
                        "tipo"=>$e["tipo"],
                        "valor"=>$e["valor"]
                    ]);
                }
        
                Cache::forget('bs');
                Cache::forget('cop');
                
            }else{
                return "Error: ".$response->body();

            }
            
        } catch (\Exception $e) {
            return Response::json(["estado"=>false,"msj"=>"Error de sucursal: ".$e->getMessage()]);
        }
    }

}
