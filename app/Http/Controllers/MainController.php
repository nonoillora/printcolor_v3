<?php

namespace App\Http\Controllers;

use App\Contacto;
use App\Http\Requests\ContactoRequest;
use App\Mail\NuevoMensajeContacto;
use App\SupportFunctions\HelperNotificationsAdmin;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Storage;
use Cart;
use Mail;

class MainController extends Controller
{
    public function index()
    {
        return view('index', ['categorias' => DB::table('categories')->select('*')->where([['category_is_active', '=', 1], ['name', '<>', 'ofertas']])->get(), 'title' => 'Impresi&oacute;n r&aacute;pida y segura', 'cart' => Cart::content()]);
    }


    public function getFAQ()
    {

        return view('faq', ['title' => 'Preguntas Frecuentes', 'cart' => Cart::content()]);
    }

    public function getNosotros()
    {
        return view('nosotros', ['title' => 'Conocenos', 'cart' => Cart::content()]);
    }

    public function getOfertas()
    {
        return view('ofertas', ['title' => 'Ofertas', 'offers' => DB::table('productos')->select('id', 'name', 'cover')->where(['product_is_active' => 1, 'is_offer' => 1])->paginate(10), 'cart' => Cart::content()]);
    }

    public function getCookies()
    {
        return view('cookies', ['title' => 'Cookies', 'cart' => Cart::content()]);
    }

    public function getBanner()
    {
        $url = storage_path() . '/app/public/prueba_1.jpg';
        if (Storage::disk('public')->exists('prueba_1.jpg')) {
            return response()->download($url);
        }
    }

    public function saveMessage(ContactoRequest $request)
    {
        $contacto = new Contacto($request->all());
        $status = $contacto->save();
        if ($status) {
            Mail::to('printcolor@printcolorillora.com')->send(new NuevoMensajeContacto($contacto));
            return redirect()->back()->with('messageOK', '');
        } else {
            return redirect()->back()->with('errorMessage', '');
        }
    }

    public function getPlantillas()
    {
        return view('plantillas', ['title' => 'Plantillas', 'cart' => Cart::content()]);
    }

    public function getSubirFicheros()
    {
        return view('subidaFicherosExterna', ['title' => 'Subida De Ficheros', 'cart' => Cart::content()]);
    }

    public function getAdmin()
    {
        return view('administracion/indexAdmin', [
            'title' => 'Administración',
            'newMessages'=>HelperNotificationsAdmin::getMessages(),
            'newOrders'=> HelperNotificationsAdmin::getOrders(),
            'newBudgets'=>HelperNotificationsAdmin::getBudget(),
            'pedidos' => DB::table('pedidos')->select('numIdentificacionPedido','totalPedido','idPedido')->offset(10)->take(10)->orderBy('idPedido','DESC')->get()]);
    }

}