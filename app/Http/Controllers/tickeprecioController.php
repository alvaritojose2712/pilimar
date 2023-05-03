<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;


use PhpAidc\LabelPrinter\Enum\Unit;
use PhpAidc\LabelPrinter\Enum\Anchor;
use PhpAidc\LabelPrinter\Enum\Charset;
use PhpAidc\LabelPrinter\Printer;
use PhpAidc\LabelPrinter\Label\Label;
use PhpAidc\LabelPrinter\Label\Element;
use PhpAidc\LabelPrinter\CompilerFactory;
use PhpAidc\LabelPrinter\Connector\NetworkConnector;

class tickeprecioController extends Controller
{
    public function tickedPrecio(Request $req)
    {
        $id = $req->id;
        $inventario = inventario::where("id",$id)->get()->first();

        $descripcion = $inventario->descripcion;
        $codigo_barras = $inventario->codigo_barras;
        $pu = number_format($inventario->precio,2,".",",");


$printer = new Printer(new NetworkConnector('192.168.68.102'));

\var_dump($printer->ask('? VERSION$(0)'));

// "Direct Protocol  10.15.017559   \r\n"

/*         $connector = new WindowsPrintConnector("smb://ospino/4BARCODE_3B-365B");
        //smb://computer/printer
        $printer = new Printer($connector);

        $printer->text("hola mundo");
        $printer->feed();

        $printer->cut();
        $printer->pulse();
        $printer->close();
 */


    }
}
