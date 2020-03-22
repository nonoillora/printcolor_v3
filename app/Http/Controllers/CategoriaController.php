<?php

namespace App\Http\Controllers;

use App\Category;
use App\Producto;
use Illuminate\Http\Request;
use DB;
use Storage;
use Cart;
use Illuminate\Http\File;
use Auth;
use Carbon\Carbon;

class CategoriaController extends Controller
{
    public function getCategory(Request $request)
    {
        $category = DB::table('categories')->select('name', 'category_is_active')->where('id', $request->id)->first();
        if (!isset($category) || $category->category_is_active == 0) {
            abort('404');
        }
        $categorias = DB::table('categories')->select('*')->get();
        $products = DB::table('productos')->select('*')->where(['idCategoria' => $request->id, 'product_is_active' => 1])->get();
        if (!isset($category) && $products->isEmpty()) {
            abort('404');
        }
        if (isset($products) && count($products) == 1) {
            return redirect('producto/' . $products->first()->id . '/' . str_slug($products->first()->name, '-'));
        } else {
            return view('category', ['id' => $request->id,
                'name' => $category->name,
                'productos' => $products,
                'title' => $category->name,
                'cart' => Cart::content(),
                'categorias' => $categorias]);
        }
    }

    public function getCover($image)
    {
        $url = storage_path() . '/app/public/categoria/' . $image;
        if (Storage::disk('public')->exists('categoria/' . $image)) {
            return response()->download($url);
        }
    }

    public function getNuevaCategoria()
    {
        return view('administracion/categorias/nueva_categoria', ['title' => 'Nueva Categor&iacute;a']);
    }

    public function getTodasCategoria()
    {
        return view('administracion/categorias/todas', ['title' => 'Categor&iacute;a', 'categories' => DB::table('categories')->select('name', 'image')->where('category_is_active', 1)->paginate(10)]);
    }

    public function saveNewCat(Request $request)
    {
        $mycover = Storage::putFile('public/categoria', new File($request->file('cover')));
        $cat = New Category(['name' => $request->get('nombre'), 'name_xs' => $request->get('nombreBreve'), 'image' => str_replace('public/categoria/', '', $mycover)]);
        $status = $cat->save();
        return back()->with('successNewCategory', 'Nueva categor&iacute;a creada');

    }

    public function saveeditcat(Request $request)
    {
        if (!empty($request->file('cover'))) {
            $mycover = Storage::putFile('public/categoria', new File($request->file('cover')));
        }
        $cat = Category::find($request->get('id'));
        $cat->name = $request->get('nombre');
        $cat->name_xs = $request->get('nombreBreve');
        if (isset($mycover)) {
            $cat->image = str_replace('public/categoria/', '', $mycover);
        }
        $status = $cat->save();
        if ($status) {
            return back()->with('successEditCategory', 'Categor&iacute;a actualizada correctamente');

        } else {
            return back()->withErrors();

        }

    }


    public function getEditarCategoria()
    {
        return view('administracion/categorias/editar_categoria',
            [
                'title' => 'Editar Categor&iacute;as',
                'categories' => DB::table('categories')->select('name', 'image', 'id')->paginate(17)
            ]);
    }

    public function getEditarCategoriaWithId($id)
    {
        $categoria = DB::table('categories')->select('*')->where(['id' => $id])->first();

        return view('administracion/categorias/editar_categoria_id',
            [
                'title' => 'Editar ' . $categoria->name,
                'categoria' => $categoria
            ]);
    }

    public function removeImageFromCategory($id, $image)
    {
        $successDeleteFile = Storage::delete('public/categoria/' . $image);
        if ($successDeleteFile) {
            $category = Category::find($id);
            $category->image = '';
            $status = $category->save();
            if ($status) {
                return redirect()->back()->with('successDeleteImageCategory', 'Se ha eliminado correctamente la imagen');
            } else {
                return redirect()->back()->withErrors();
            }
        } else {
            return redirect()->back()->withErrors();
        }
    }

    public function removeCategory($id = null)
    {
        if (!is_null($id)) {
            $category = Category::find($id);
            $category->category_is_active = 0;
            $category->deleted_by_user_id = Auth::id();
            $category->deleted_at = Carbon::now('Europe/Madrid');
            $statusCategory = $category->save();
            $productos = Producto::where('idCategoria', $id)->get();
            $totalProduct = count($productos);
            $counterStatusProduct = 0;
            foreach ($productos as $producto) {
                $producto->product_is_active = 0;
                $producto->deleted_by_user_id = Auth::id();
                $producto->deleted_at = Carbon::now('Europe/Madrid');
                $status = $producto->save();
                if ($status) {
                    $counterStatusProduct++;
                }
            }
            if ($statusCategory && $counterStatusProduct == $totalProduct) {
                return redirect()->back()->with(['successCategory' => 'Categoría borrado satisfactoriamente']);
            } else {
                return redirect()->back()->with(['failCategory' => 'Fallo al borrar la categoría']);
            }
        } else {
            return view('administracion/categorias/eliminar_categoria', ['title' => 'Borrar Categorías',
                'categories' => DB::table('categories')->select('name', 'image', 'id')->where('category_is_active', 1)->paginate(17)]);
        }
    }
}
