<?php

namespace App\Http\Controllers;

use App\Mail\EnviarPresupuesto;
use App\Presupuesto;
use App\PriceProduct;
use Illuminate\Http\Request;
use DB;
use HelperProduct;
use Cart;
use App\Category;
use Storage;
use Illuminate\Http\File;
use App\Producto;
use App\TypePriceProduct;
use Mail;
use Carbon\Carbon;
use Auth;

class ProductoController extends Controller
{
    protected $helperProduct;

    function __construct(HelperProduct $hp)
    {
        $this->helperProduct = $hp;
    }

    public function getProducto(Request $request)
    {
        $categorias = DB::table('categories')->select('*')->get();
        $product = DB::table('productos')->select('*')->where('id', $request->id)->first();
        if (!isset($product) || $product == [] || $product == null || $product->product_is_active == 0) {
            abort('404');
        } else {
            $category = DB::table('categories')->select('name', 'id')->where('id', $product->idCategoria)->first();
            if ($this->helperProduct->esPresupuesto($product->idCategoria)) {
                return view('productos/presupuesto', ['id' => $request->id,
                    'categoria' => $category,
                    'producto' => $product,
                    'title' => $product->name,
                    'cart' => Cart::content(),
                    'categorias' => $categorias]);
            } else {
                $typePrice = DB::table('type_price_products')->select('nameTypePrice', 'id')->where(['idProduct' => $product->id])->get();
                if ($product->id == 37) {
                    /*$prices = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where('productos.id', '=', $product->id)
                        ->orderBy(DB::raw('LENGTH(type_price_products.id),count'), 'asc')
                        ->orderBy('type_price_products.id', 'asc')
                        ->get();*/
                    $prices1 = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where([['productos.id', '=', $product->id], ['count', 'not like', '%Laminado%']])
                        ->orderBy(DB::raw('ABS(price_products.count)'), 'asc')
                        ->orderBy(DB::raw('LENGTH(type_price_products.id)'), 'asc')
                        ->get();
                    $prices2 = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where([['productos.id', '=', $product->id], ['count', 'like', '%Laminado%']])
                        ->orderBy(DB::raw('ABS(price_products.count)'), 'asc')
                        ->orderBy(DB::raw('LENGTH(type_price_products.id)'), 'asc')
                        ->get();

                    $typePrice1 = DB::table('type_price_products')->select('nameTypePrice', 'id')->where([['idProduct', '=', $product->id]])->get();
                    $typePrice2 = DB::table('type_price_products')->select('nameTypePrice', 'id')->where([['idProduct', '=', $product->id]])->get();
                } else if ($product->id == 7) {
                    $typePrice1 = DB::table('type_price_products')->select('nameTypePrice', 'id')->where([['idProduct', '=', $product->id], ['nameTypePrice', 'like', '%1 Cara']])->get();
                    $typePrice2 = DB::table('type_price_products')->select('nameTypePrice', 'id')->where([['idProduct', '=', $product->id], ['nameTypePrice', 'like', '%2 Caras']])->get();

                    $prices1 = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where([['productos.id', '=', $product->id], ['nameTypePrice', 'like', '%1 Cara']])
                        ->orderBy(DB::raw('ABS(price_products.count)'), 'asc')
                        ->get();
                    //dd($prices1);
                    $prices2 = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where([['productos.id', '=', $product->id], ['nameTypePrice', 'like', '%2 Caras']])
                        ->orderBy(DB::raw('ABS(price_products.count)'), 'asc')
                        ->orderBy('type_price_products.id', 'asc')
                        ->get();
                } else if ($product->id == 22) {
                    $prices = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where('productos.id', '=', $product->id)
                        ->groupBy('price', 'nameTypePrice')
                        ->orderBy(DB::raw('ABS(count)'), 'asc')
                        ->orderBy('type_price_products.id', 'asc')
                        ->get();
                } else {
                    $prices = DB::Table('price_products')
                        ->select('price', 'count', 'idTypePriceProduct', 'nameTypePrice', 'price_products.id')
                        ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
                        ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
                        ->where('productos.id', '=', $product->id)
                        ->groupBy('price', 'nameTypePrice')
                        ->orderBy(DB::raw('LENGTH(price_products.count),ABS(count)'), 'asc')
                        ->orderBy('type_price_products.id', 'asc')
                        ->get();
                }


                $uds = [];
                $uds1 = [];
                $uds2 = [];

                if ($product->id == 7 || $product->id == 37) {
                    $tipoSelect1 = [];
                    $y = 0;
                    foreach ($typePrice1 as $type) {
                        if ($y == 0) {
                            $tipoSelect1[] = 'Medidas (cm)';
                            $y++;
                        }
                        $tipoSelect1[] = $type->nameTypePrice;
                    }

                    $x = 0;
                    $i = 0;
                    foreach ($prices1 as $price) {
                        if ($i == 0) {
                            $uds1[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->count, 'type' => 'info'];
                            $i++;
                        }
                        $uds1[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->price, 'type' => 'precio', 'count' => $price->count, 'idPriceProduct' => $price->id];
                        $i++;
                        if ($i % count($tipoSelect1) == 0) {
                            $x++;
                            $i = 0;
                        }
                    }
                    $tipoSelect2 = [];
                    $y = 0;
                    foreach ($typePrice2 as $type) {
                        if ($y == 0) {
                            $tipoSelect2[] = 'Medidas (cm)';
                            $y++;
                        }
                        $tipoSelect2[] = $type->nameTypePrice;
                    }
                    $x = 0;
                    $i = 0;
                    foreach ($prices2 as $price) {
                        if ($i == 0) {
                            $uds2[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->count, 'type' => 'info'];
                            $i++;
                        }
                        $uds2[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->price, 'type' => 'precio', 'count' => $price->count, 'idPriceProduct' => $price->id];
                        $i++;
                        if ($i % count($tipoSelect2) == 0) {
                            $x++;
                            $i = 0;
                        }
                    }
                } else {

                    $tipoSelect = [];
                    $y = 0;
                    foreach ($typePrice as $type) {
                        if ($y == 0) {
                            if (strpos($type->nameTypePrice, 'cm') != false || strpos($type->nameTypePrice, 'mm') != false) {
                                if (strpos($type->nameTypePrice, 'mm') != false) {
                                    $tipoSelect[] = 'Medidas (mm)';
                                } else {
                                    $tipoSelect[] = 'Medidas (cm)';
                                }
                            } else {
                                $tipoSelect[] = 'Cantidad';
                            }
                            $y++;
                        }
                        $tipoSelect[] = $type->nameTypePrice;
                    }

                    $x = 0;
                    $i = 0;
                    foreach ($prices as $price) {
                        if ($i == 0) {
                            $uds[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->count, 'type' => 'info'];
                            $i++;
                        }
                        $uds[$x][$i] = ['name' => $price->nameTypePrice, 'price' => $price->price, 'type' => 'precio', 'count' => $price->count, 'idPriceProduct' => $price->id];
                        $i++;
                        if ($i % count($tipoSelect) == 0) {
                            $x++;
                            $i = 0;
                        }
                    }
                }

                if (HelperProduct::esOferta($product->id)) {
                    return view('ofertas/ofertas_index', ['id' => $request->id,
                        'categoria' => $category,
                        'producto' => $product,
                        'typePrice' => $typePrice,
                        'uds' => $uds,
                        'keys' => $tipoSelect,
                        'title' => $product->name,
                        'cart' => Cart::content(),
                        'categorias' => $categorias]);
                }


                switch ($product->id) {
                    case 23:
                    case 72:
                    case 76:
                    case 77:
                    case 79:
                    case 45:
                    case 46:
                    case 47:
                    case 43:
                    case 24:
                    case 64:
                    case 65:
                    case 66:
                    case 67:
                    case 68:
                    case 69:
                    case 70:
                        return view('productos/presupuesto', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias]);
                        break;
                    case 4:/*es presupuesto */
                        return view('productos/tarjetaPlasticaPresupuesto', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias]);
                        break;
                    case 39:
                        return view('productos/documentoOnline', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias]);
                        break;
                    case 31:
                        return view('productos/viniloCortePresupuesto', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias]);
                        break;
                    case 7:
                    case 37:
                        return view('productos/product_normal', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias,
                            'typePrice' => $typePrice,
                            'uds1' => $uds1,
                            'uds2' => $uds2,
                            'keys1' => $tipoSelect1,
                            'keys2' => $tipoSelect2]);
                        break;
                    default:
                        return view('productos/product_normal', ['id' => $request->id,
                            'categoria' => $category,
                            'producto' => $product,
                            'title' => $product->name,
                            'cart' => Cart::content(),
                            'categorias' => $categorias,
                            'typePrice' => $typePrice,
                            'uds' => $uds,
                            'keys' => $tipoSelect]);
                        break;
                }
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion/productos/todas', ['title' => 'Productos', 'products' => DB::table('productos')->select('name', 'cover')->where('product_is_active', 1)->paginate(10)]);
    }

    public function indexOfertas()
    {
        return view('administracion/offers/listadoOfertas', ['title' => 'Ofertas', 'products' => DB::table('productos')->select('id', 'name', 'cover')->where(['product_is_active' => 1, 'is_offer' => 1])->paginate(10)]);
    }

    public function getNuevoProducto()
    {
        $categorias = Category::pluck('name', 'id');
        return view('administracion/productos/nuevo_producto', [
            'title' => 'Nueva Producto',
            'categories' => $categorias,
        ]);

    }

    public function getNuevaOferta()
    {
        return view('administracion/offers/nueva_oferta', [
            'title' => 'Nueva oferta',
            'oferta' => DB::table('categories')->select('id')->where(['name' => 'Ofertas', 'category_is_active' => 1])->first()->id
        ]);

    }

    public function getBorrarProducto($id = null)
    {
        if ($id != null) {
            $product = Producto::find($id);
            $product->product_is_active = 0;
            $product->deleted_by_user_id = Auth::id();
            $product->deleted_at = Carbon::now('Europe/Madrid');
            $status = $product->save();
            if ($status) {
                return redirect()->back()->with(['successProduct' => 'Producto borrado satisfactoriamente']);
            } else {
                return redirect()->back()->with(['failProduct' => 'Fallo al borrar el producto']);
            }
        } else {
            return view('administracion/productos/eliminar_producto', ['title' => 'Borrar Productos',
                'products' => DB::table('productos')->select('name', 'cover', 'id')->where('product_is_active', 1)->paginate(17)]);
        }
    }


    public function getBorrarOferta($id = null)
    {
        if ($id != null) {
            $product = Producto::find($id);
            $product->product_is_active = 0;
            $product->deleted_by_user_id = Auth::id();
            $product->deleted_at = Carbon::now('Europe/Madrid');
            $status = $product->save();
            if ($status) {
                return redirect()->back()->with(['successOffer' => 'Oferta borrada satisfactoriamente']);
            } else {
                return redirect()->back()->with(['failOffer' => 'Fallo al borrar la oferta']);
            }
        } else {
            return view('administracion/offers/eliminar_oferta', ['title' => 'Eliminar Ofertas',
                'products' => DB::table('productos')->select('name', 'cover', 'id')->where(['product_is_active' => 1, 'is_offer' => 1])->paginate(17)]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newpresupuesto(Request $request)
    {
        /*------ tarjeta plastica presupuesto -------------*/
        if ($request->has('cantidad')) {
            $data["Cantidad"] = $request->get('cantidad');
        }

        if ($request->has('caras')) {
            if ($request->get('caras') == "1") {
                $data["Num. Caras"] = "1";
            } else {
                $data["Num. Caras"] = "2";
            }
        }

        if ($request->has('numeracion')) {
            if ($request->get('numeracion') == "si") {
                $data["Numeración"] = "Si";
            } else {
                $data["Numeración"] = "No";
            }
        }

        if ($request->has('fotografia')) {
            if ($request->get('fotografia') == "si") {
                $data["Fotografía"] = "Si";
            } else {
                $data["Fotografía"] = "No";
            }
        }

        if ($request->has('full_name')) {
            if ($request->get('full_name') == "si") {
                $data["Nombre Completo"] = "Si";
            } else {
                $data["Nombre Completo"] = "No";
            }
        }

        if ($request->has('codBarras')) {
            if ($request->get('codBarras') == "si") {
                $data["Cod. Barras"] = "Si";
            } else {
                $data["Cod. Barras"] = "No";
            }
        }

        if ($request->has('coercitividad')) {
            switch ($request->get('coercitividad')) {
                case "no":
                    $data["Banda Magnética"] = "No";
                    break;
                case "alta":
                    $data["Banda Magnética"] = "Alta Coercitividad";
                    break;
                case "baja":
                    $data["Banda Magnética"] = "Baja Coercitividad";
                    break;

            }
        }
        /*--------------------------------------------*/
        /*------ vinilo corte presupuesto -------------*/
        $data = "";

        if ($request->has('medidas')) {
            $data["Medidas"] = $request->get('medidas');
        }

        if ($request->has('tipo')) {
            if ($request->get('tipo')) {
                $data["Tipo"] = "Exterior";
            } else {
                $data["tipo"] = "Interior";
            }
        }

        /*--------------------------------------------*/

        if (is_string($data)) {
            $dataPresupuesto = $request->all();
        } else {
            $data = serialize($data);
            $dataPresupuesto = ['nombre' => $request->get('nombre'), 'telefono' => $request->get('telefono'), 'email' => $request->get('email'), 'comentario' => $request->get('comentario'),
                'idProducto' => $request->get('idProducto'), 'empresa' => $request->get('empresa'), 'provincia' => $request->get('provincia'), 'dataAboutIt' => $data];
        }

        $presupuesto = new Presupuesto($dataPresupuesto);
        $status = $presupuesto->save();
        $infoProducto = DB::table('productos')->select('name')->where('id', '=', $request->get('idProducto'))->first();
        Mail::to('printcolor@printcolorillora.com')->send(new EnviarPresupuesto($presupuesto, $infoProducto->name));
        if ($status) {
            return redirect()->back()->with('presupuestoOK', '');
        } else {
            return redirect()->back()->withErrors();
        }
    }

    public function saveNewProduct(Request $request)
    {
        $mycover = Storage::putFile('public/productos', new File($request->file('cover')));
        $myimage = Storage::putFile('public/productos', new File($request->file('inside')));
        $prod = New Producto([
            'idCategoria' => $request->get('idCategoria'),
            'name' => $request->get('nombre'),
            'cover' => str_replace('public/productos/', '', $mycover),
            'image' => str_replace('public/productos/', '', $myimage),
            'description' => $request->get('descripcion'),
            'footer_image' => $request->get('footer_image'),
            'is_offer' => 0
        ]);
        $status = $prod->save();
        if ($status) {
            return back()->with('successNewProduct', 'Nuevo producto creado');
        } else {
            return back()->withErrors();
        }
    }

    public function saveNewOffer(Request $request)
    {
        $mycover = Storage::putFile('public/ofertas', new File($request->file('cover')));
        $prod = New Producto([
            'idCategoria' => $request->get('idCategoria'),
            'name' => $request->get('nombre'),
            'cover' => str_replace('public/ofertas/', '', $mycover),
            'is_offer' => 1,
            'description' => $request->get('descripcion'),
        ]);
        $status = $prod->save();
        if ($status) {
            return back()->with('successNewOferta', 'Nueva oferta creada');
        } else {
            return back()->withErrors();
        }
    }


    public
    function saveeditprod(Request $request)
    {
        $prod = Producto::find($request->get('id'));
        $prod->name = $request->get('nombre');
        $prod->footer_image = $request->get('footer_image');;
        $prod->description = $request->get('description');
        if (empty($prod->cover) && $request->hasFile('cover')) {
            $mycover = Storage::putFile('public/productos', new File($request->file('cover')));
            $prod->cover = str_replace('public/productos/', '', $mycover);
        }
        if (empty($prod->image) && $request->hasFile('myimage')) {
            $myimage = Storage::putFile('public/productos', new File($request->file('myimage')));
            $prod->image = str_replace('public/productos/', '', $myimage);
        }
        $status = $prod->save();
        if ($status) {
            return back()->with('successEditProduct', 'Producto actualizado correctamente');

        } else {
            return back()->withErrors();

        }

    }

    public
    function saveeditofer(Request $request)
    {
        $prod = Producto::find($request->get('id'));
        $prod->name = $request->get('nombre');
        $prod->footer_image = $request->get('footer_image');;
        $prod->description = $request->get('description');
        if (empty($prod->cover) && $request->hasFile('cover')) {
            $mycover = Storage::putFile('public/ofertas', new File($request->file('cover')));
            $prod->cover = str_replace('public/ofertas/', '', $mycover);
        }
        $status = $prod->save();
        if ($status) {
            return back()->with('successEditOfer', 'Oferta actualizada correctamente');

        } else {
            return back()->withErrors();

        }

    }

    public
    function getEditarProducto()
    {
        return view('administracion/productos/editar_producto',
            [
                'title' => 'Editar Productos',
                'productsWithoutImage' => DB::table('productos')->select('*')->where(['image' => '', 'product_is_active' => 1, 'is_offer' => 0])->orWhere(['cover' => ''])->where(['product_is_active' => 1, 'is_offer' => 0])->get(),
                'products' => DB::table('productos')->select('name', 'cover', 'id')->where(['product_is_active' => 1, 'is_offer' => '0'])->paginate(17)
            ]);
    }

    public
    function getEditarProductWithId($id)
    {
        if (DB::table('productos')->select('*')->where(['id' => $id])->first()->product_is_active == 0) {
            return abort('404');
        }
        $producto = DB::table('productos')->select('*')->where(['id' => $id])->first();
        $typePrice = DB::table('type_price_products')->select('nameTypePrice', 'id')->where(['idProduct' => $id])->get();
        $prices = DB::Table('price_products')
            ->select('price', 'count', 'idTypePriceProduct', 'price_products.id')
            ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
            ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
            ->where(['productos.id' => $id])->orderBy(DB::raw('ABS(count)'), 'asc')->get();
        $tipoSelect = [];
        $totalItems = 0;

        foreach ($typePrice as $type) {
            $tipoSelect[$type->id] = $type->nameTypePrice;
            $sameType = [];
            foreach ($prices as $price) {
                if ($price->idTypePriceProduct == $type->id) {
                    array_push($sameType, $price);
                }
            }
            $type->prices = $sameType;
            $totalItems += count($type->prices);

        }

        return view('administracion/productos/editar_producto_id',
            [
                'tipoSelect' => $tipoSelect,
                'typePrice' => $typePrice,
                'title' => 'Editar ' . $producto->name,
                'producto' => $producto,
                'totalItems' => $totalItems
            ]);
    }

    public
    function getEditarOferta($id)
    {
        if (DB::table('productos')->select('*')->where(['id' => $id, 'is_offer' => 1])->first()->product_is_active == 0) {
            return abort('404');
        }
        $producto = DB::table('productos')->select('*')->where(['id' => $id, 'is_offer' => 1])->first();
        $typePrice = DB::table('type_price_products')->select('nameTypePrice', 'id')->where(['idProduct' => $id])->get();
        $prices = DB::Table('price_products')
            ->select('price', 'count', 'idTypePriceProduct', 'price_products.id')
            ->join('type_price_products', 'price_products.idTypePriceProduct', '=', 'type_price_products.id')
            ->join('productos', 'type_price_products.idProduct', '=', 'productos.id')
            ->where(['productos.id' => $id, 'is_offer' => 1])->orderBy(DB::raw('ABS(count)'), 'asc')->get();
        $tipoSelect = [];
        foreach ($typePrice as $type) {
            $tipoSelect[$type->id] = $type->nameTypePrice;
            $sameType = [];
            foreach ($prices as $price) {
                if ($price->idTypePriceProduct == $type->id) {
                    array_push($sameType, $price);
                }
            }
            $type->prices = $sameType;
        }
        return view('administracion/offers/editar_oferta_id',
            [
                'tipoSelect' => $tipoSelect,
                'typePrice' => $typePrice,
                'title' => 'Editar ' . $producto->name,
                'producto' => $producto
            ]);
    }

    public
    function removeImageFromProduct($type, $id, $image)
    {
        $successDeleteFile = Storage::delete('public/productos/' . $image);
        if ($successDeleteFile) {
            $product = Producto::find($id);
            if ($type == 'cover') {
                $product->cover = '';
            } else {
                $product->image = '';
            }
            $status = $product->save();
            if ($status) {
                return redirect()->back()->with('successDeleteImageProduct', 'Se ha eliminado correctamente la imagen');
            } else {
                return redirect()->back()->withErrors();
            }
        } else {
            return redirect()->back()->withErrors();
        }
    }

    public
    function removeImageFromOffer($id, $image)
    {
        $successDeleteFile = Storage::delete('public/ofertas/' . $image);
        if ($successDeleteFile) {
            $product = Producto::find($id);
            $product->cover = '';
            $status = $product->save();
            if ($status) {
                return redirect()->back()->with('successDeleteImageOffer', 'Se ha eliminado correctamente la imagen');
            } else {
                return redirect()->back()->withErrors();
            }
        } else {
            return redirect()->back()->withErrors();
        }
    }

    public function deletePrice(Request $request)
    {
        $status = PriceProduct::destroy($request->get('idPrice'));
        if ($status == 1) {
            return response()->json(['exist' => true]);
        } else {
            return response()->json(['exist' => false]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function addNewPrice(Request $request)
    {
        $dataPrice = $request->get('price');
        $dataCount = $request->get('count');
        $dataType = $request->get('typePriceProduct');
        $price = new PriceProduct(['idTypePriceProduct' => $dataType, 'price' => $dataPrice, 'count' => $dataCount]);
        $status = $price->save();
        if ($status) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function addNewTypePriceProduct(Request $request)
    {
        $nameTypePrice = $request->get('nameTypePrice');
        $idProduct = $request->get('idProduct');
        $type = new TypePriceProduct(['nameTypePrice' => $nameTypePrice, 'idProduct' => $idProduct]);
        $status = $type->save();
        if ($status) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function editPriceProduct(Request $request)
    {
        $price = PriceProduct::find($request->get('idPriceProduct'));
        $price->count = $request->get('count');
        $price->price = $request->get('price');
        $price->idTypePriceProduct = $request->get('idTypePriceProduct');
        $status = $price->save();
        if ($status) {
            return response()->json(['exist' => true]);
        } else {
            return response()->json(['exist' => false]);
        }

    }

    public
    function editNameTypePriceProduct(Request $request)
    {
        $type = TypePriceProduct::find($request->get('idTypeProductPrice'));
        $type->nameTypePrice = $request->get('name');
        $status = $type->save();
        if ($status) {
            return response()->json(['exist' => true]);
        } else {
            return response()->json(['exist' => false]);
        }

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
    function destroy($id)
    {
        //
    }

    public
    function deleteTypePriceProduct(Request $request)
    {
        $id = $request->get('idTypeProductPrice');
        $prices = DB::table('price_products')->select('id')->where('idTypePriceProduct', $id)->get();
        $toDelete = [];
        foreach ($prices as $price) {
            array_push($toDelete, $price->id);
        }
        $total = PriceProduct::destroy($toDelete);
        if ($total == count($prices) || count($prices) == 0) {
            $status = TypePriceProduct::destroy($id);
            if ($status == 1) {
                return response()->json(['exist' => true]);
            } else {
                return response()->json(['exist' => false]);
            }
        } else {
            return response()->json(['info' => 'algo salio mal']);
        }
    }
}
