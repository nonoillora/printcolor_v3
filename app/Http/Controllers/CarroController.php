<?php

namespace App\Http\Controllers;

use App\LineaPedido;
use App\Producto;
use App\TypePriceProduct;
use Illuminate\Http\Request;
use HelperProduct;
use Session;
use App\PriceProduct;
use HelperConfig;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(HelperProduct $hp)
    {
        $this->helperProduct = $hp;
    }

    public function getIndex()
    {
        return view('cart/miCarrito', ['title' => 'Mi Compra', 'cart' => Cart::content()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $options = array();
        $qty = 1;
        if (!$request->get('idTypeProduct')) {
            $price = $request->get('precioDocumentoOnline');
            $description = new \stdClass();
            $description->count = 1;
        } else {
            $description = PriceProduct::find($request->get('idTypeProduct'));
            $price = $description->price;
        }


        if ($request->has("acabado")) {
            if ($request->get("acabado") == 'brillo') {
                $options["Acabado"] = "Brillo";
            } else {
                $options["Acabado"] = "Mate";
            }
        }
        if ($request->has("urgencia")) {
            if ($request->get("urgencia") == "free") {
                $options["Urgencia"] = "Normal (Gratis)";
            } else {
                $options["Urgencia"] = "Lo antes posible (+4.95)";
                $price = $price + floatval(4.95);
            }
        }

        if ($request->has("diseno")) {
            if ($request->get("diseno") == "no") {
                $options["Diseño"] = "No requiere";
            } else if ($request->get("diseno") == "si_unacara") {
                $options["Diseño"] = "Diseño de una cara (+12,00&euro;)";
                $price = $price + floatval(12.00);
            } else {
                $options["Diseño"] = "Diseño de las 2 caras (+20.00&euro;)";
                $price = $price + floatval(20.00);
            }
        }
        if ($request->has("kit_tornilleria")) {
            if ($request->get("kit_tornilleria") == "si") {
                $options["Kit de Tornilleria"] = "Si (+18,00 €)";
                $price = $price + floatval(18.00);
            } else {
                $options["Urgencia"] = "No";
            }
        }

        if ($request->has("sujeccion")) {
            if ($request->get("sujeccion") == "si") {
                $options["Sujeccion"] = "Si (+6,00 €)";
                $price = $price + floatval(6.00);
            } else {
                $options["Sujeccion"] = "No";
            }
        }

        if ($request->has("forma_alfombrilla")) {
            if ($request->get("forma_alfombrilla") == "circular") {
                $options["Forma Alfombrilla"] = "Circular";
            } else if ($request->get("forma_alfombrilla") == "corazon") {
                $options["Forma Alfombrilla"] = "Corazón";
            } else {
                $options["Forma Alfombrilla"] = "Rectangular (por defecto)";
            }
        }

        if ($request->has("numeracion")) {
            switch ($request->get("numeracion")) {
                case 250:
                    $options["Numeracion"] = "Si, 250 números (+10 €)";
                    $price = $price + floatval(10.00);
                    break;
                case 500:
                    $options["Numeracion"] = "Si, 500 números (+15€)";
                    $price = $price + floatval(15.00);
                    break;
                case 1000:
                    $options["Numeracion"] = "Si, 1000 números (+30€)";
                    $price = $price + floatval(30.00);
                    break;
                case 2000:
                    $options["Numeracion"] = "Si, 2000 números (+40€)";
                    $price = $price + floatval(40.00);
                    break;
                case 2500:
                    $options["Numeracion"] = "Si, 2500 números (+45€)";
                    $price = $price + floatval(45.00);
                    break;
                case 5000:
                    $options["Numeración"] = "Si, 5000 números (+50€)";
                    $price = $price + floatval(50.00);
                    break;
                case 'no':
                    $options["Numeracion"] = "No";
                    break;
            }
        }

        if ($request->has("retoque_fotografico")) {
            if ($request->get("retoque_fotografico") == "si") {
                $options["Retoque fotografico"] = "Si (+6,00 €)";
                $price = $price + floatval(6.00);
            } else {
                $options["Retoque fotografico"] = "No";
            }
        }
        if ($request->has("cantidad")) {
            if ($request->get("cantidad") > 0) {
                $options["Cantidad"] = $request->get("cantidad");
                $price = $price * $request->has("cantidad");
                $qty = $request->get("cantidad");
            }
        }
        if ($request->has("refuerzo")) {
            if ($request->get("refuerzo") == 'hasta400cm') {
                $options["Refuerzo"] = "Hasta 400 cm. (+19,00 €)";
                $price = $price + floatval(19.00);
            } else {
                $options["Refuerzo"] = "No";
            }
        }

        if ($request->has("ojales")) {
            switch ($request->get("ojales")) {
                case '100cm':
                    $options["Ojales"] = "Si, cada 100 cm. (+5,00 €)";
                    $price = $price + floatval(5.00);
                    break;
                case '50cm':
                    $options["Numeracion"] = "Si, cada 50 cm. (+10,00 €)";
                    $price = $price + floatval(10.00);
                    break;
                case 'no':
                    $options["Ojales"] = "No";
                    break;
            }
        }
        if ($request->has("plegado")) {
            switch ($request->get("plegado")) {
                case 'estucado_brillo':
                    $options["Plegado"] = "Estucado Brillo 125gr . (+9,90€)";
                    $price = $price + floatval(9.90);
                    break;
                case 'diptico':
                    $options["Plegado"] = "Si (Díptico) (+9,00€)";
                    $price = $price + floatval(9.00);
                    break;
                case 'triptico':
                    $options["Plegado"] = "Si (Tríptico) (+9,00€)";
                    $price = $price + floatval(9.00);
                    break;
                case '90':
                    $options["Plegado"] = "90 gr. (Gratis)";
                    break;
                case 'no':
                    $options["Plegado"] = "No";
                    break;
            }
        }

        if ($request->has("talonarios")) {
            if ($request->get("talonarios") == '50uds') {
                $options["Refuerzo"] = "Tacos de 50 uds (Gratis)";
            } else {
                $options["Refuerzo"] = "Tacos de 25 uds (+10.00 €)";
                $price = $price + floatval(10.00);
            }
        }
        if ($request->has("posicion")) {
            switch ($request->get("posicion")) {
                case 'centrada':
                    $options["Posición"] = "Centrada (por defecto)";
                    break;
                case 'derecha_asa':
                    $options["Plegado"] = "A la derecha del asa";
                    break;
                case 'izquierda_asa':
                    $options["Plegado"] = "A la izquierda del asa";
                    break;
            }
        }
        if ($request->has("color_papel")) {
            switch ($request->get("color_papel")) {
                case 'mezcla':
                    $options["Color"] = "Colores mezclados (por defecto)";
                    break;
                case 'rosa':
                    $options["Color"] = "Rosa";
                    break;
                case 'amarillo':
                    $options["Color"] = "Amarillo";
                    break;
                case 'naranja':
                    $options["Color"] = "Naranja";
                    break;
                case 'verde':
                    $options["Color"] = "Verde";
                    break;
            }
        }

        if ($request->has("tipo_impresion")) {
            if ($request->get("tipo_impresion") == "b/n") {
                $options["Tipo Impresion"] = 'B/N - ' . HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_BLACK_WHITE') . '€ / página';
            } else {
                $options["Tipo Impresion"] = 'Color - ' . HelperConfig::getConfig('_PRICE_IMPRESS_TYPE_COLOR') . '€ / página';
            }
        }

        if ($request->has("numPaginas")) {
            $options["Num. Paginas"] = $request->get("numPaginas");
        }
        if ($request->has("doblecara")) {
            if ($request->get("doblecara") == "si") {
                $options["Doble Cara"] = "Si";
            } else {
                $options["Doble Cara"] = "No";
            }

        }
        if ($request->has("encuadernado")) {
            switch ($request->get("encuadernado")) {
                case 'no_encuadernado':
                    $options["Encuadernado"] = 'No';
                    break;
                case 'hojas_grapadas':
                    $options["Encuadernado"] = 'Hojas grapadas (Gratis)';
                    break;
                case 'si_encuadernado':
                    $options["Encuadernado"] = 'Sí, en espiral(+ 1,50€/libro)';
                    break;
            }

        }
        if ($request->has("numEjemplares")) {
            $options["Num. Ejemplares"] = $request->get("numEjemplares");

        }
        if ($request->has("tipo_envio")) {
            if ($request->get("tipo_envio") == "envio") {
                $options["Tipo Envio"] = "Enviadlo a mi domicilio (+ 4,95 € ) - (Envío peninsular)";
            } else {
                $options["Tipo Envio"] = "Recojo en vuestra oficina (Gratis)";
            }
        }


        $name = Producto::find($request->get('idProducto'));
        $descriptionData = array('producto' => $name->name, 'Cantidad seleccionada' => $description->count, 'Tipo Acabado' => $request->tipoAcabado);

        $dataLinea = array('idProduct' => $request->get('idProducto'), 'description' => serialize($descriptionData), 'price' => $price, 'qty' => $qty, 'options' => serialize($options), 'session_id' => Session::getId());
        $linea = new LineaPedido($dataLinea);
        $status = $linea->save();

        if ($status) {
            Cart::add(['id' => $linea->id, 'name' => $descriptionData, 'qty' => $qty, 'price' => $price, 'weight' => 0, 'options' => $options]);
            return redirect()->back()->with('productAddedSuccessfully', 'Producto añadido a su cesta');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function quitarProducto($id)
    {
        $rowId = $id;
        Cart::remove($rowId);
        return redirect()->back()->with('itemRemove', 'Producto Eliminado');
    }

    public
    function destroyCart()
    {
        Cart::destroy();
        return redirect()->back()->with('cartDestroy', 'Cesta Vac&iacute;a');
    }
}
