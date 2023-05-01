<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpAidc\LabelPrinter\Enum\Unit;
use PhpAidc\LabelPrinter\Enum\Anchor;
use PhpAidc\LabelPrinter\Enum\Charset;
use PhpAidc\LabelPrinter\Printer;
use PhpAidc\LabelPrinter\Label\Label;
use PhpAidc\LabelPrinter\Label\Element;
use PhpAidc\LabelPrinter\CompilerFactory;
use PhpAidc\LabelPrinter\Connector\NetworkConnector;

use App\Models\inventario;


class tickeprecioController extends Controller
{
    public function tickedPrecio(Request $req)
    {
        $id = $req->id;
        $inventario = inventario::where("id",$id)->get()->first();

        $descripcion = $inventario->descripcion;
        $codigo_barras = $inventario->codigo_barras;
        $pu = number_format($inventario->precio,2,".",",");

        return $pu;

       /*  $label = Label::create(Unit::MM(), 43, 25)
            ->charset(Charset::UTF8())
            ->add(Element::textBlock(168, 95, 'Hello!', 'Univers', 8)->box(338, 100, 0)->anchor(Anchor::CENTER()))
            ->add(Element::barcode(10, 10, '123456', 'CODE93')->height(60))
        ;

        (new Printer(new NetworkConnector('smb://ospino/4BARCODE_3B-365B'), CompilerFactory::tspl()))->print($label);
 */

 $printer = new Printer(new NetworkConnector('ospino/4BARCODE_3B-365B'));

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
