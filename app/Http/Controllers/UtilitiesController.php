<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    public function index()
    {
        return view('administracion/utilities', ['title' => 'Utilidades']);
    }

    public function clearCache()
    {
        $status = exec('php artisan cache:clear');
        if ($status == "Cache cleared successfully.") {
            return redirect()->back()->with('utilityOK', 'Cache limpiada correctamente.');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al limpiar la cache.');
        }
    }

    public function clearView()
    {
        $status = exec('php artisan view:clear');
        if ($status == "Compiled views cleared!") {
            return redirect()->back()->with('utilityOK', 'Se limpiaron las vistas compiladas.');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al generar las vistas.');
        }

    }

    public function doDumpAutoload()
    {
        $status = exec('composer dump-autoload');
        if ($status == "") {
            return redirect()->back()->with('utilitydOK', 'Recarga de clases completada');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al recargar las clases.');
        }
    }

    public function generateEvent_listener()
    {
        $status = exec('php artisan event:generate');
        if ($status == "Events and listeners generated successfully!") {
            return redirect()->back()->with('utilityOK', 'Eventos recargados correctamente');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al generar los eventos.');
        }
    }

    public function generateBackupNow(){
        $status = exec('php artisan backup:run');
        if ($status=="Backup completed!") {
            return redirect()->back()->with('utilityOK', 'Copia de seguridad creada correctamente');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al generar la copia de seguridad.');
        }
    }

    public function generateCleanNow(){
        $status = exec('php artisan backup:run');
        if ($status=="Backup completed!") {
            return redirect()->back()->with('utilityOK', 'Limpieza completada');
        } else {
            return redirect()->back()->with('utilityKO', 'Fallo al generar limpieza.');
        }
    }


}
