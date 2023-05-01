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



class tickeprecioController extends Controller
{
    public function tickedPrecio(Request $req)
    {

        $codigo_barras = '01210309483';
        $descripcion = "Copa galvanizada 3/4";
        $pu = "21,25.00";

        $label = Label::create(Unit::MM(), 43, 25)
            ->charset(Charset::UTF8())
            ->add(Element::textBlock(168, 95, 'Hello!', 'Univers', 8)->box(338, 100, 0)->anchor(Anchor::CENTER()))
            ->add(Element::barcode(10, 10, '123456', 'CODE93')->height(60))
        ;

        (new Printer(new NetworkConnector('ospino/3nStar-LPT005'), CompilerFactory::tspl()))->print($label);




    }
}
