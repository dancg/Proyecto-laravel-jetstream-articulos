<?php

namespace App\Http\Controllers;

use App\Mail\Contacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function pintarFormulario(){
        return view('contacto.form');
    }

    public function procesarFormulario(Request $request){
        $request->validate([
            'nombre'=>['required', 'string', 'min:3'],
            'contenido'=>['required', 'string', 'min:10'],
        ]);
        //Si hemos pasado la validación creamos un objeto Mail con la clase creada anteriormente
        try{
            Mail::to("admin@sitio.org")->send(new Contacto($request->all()));
            return redirect()->route('dashboard')->with('mensaje', 'Correo enviado');
        }catch(\Exception $exception){
            return redirect()->route('dashboard')->with('mensaje', 'No se ha podido enviar el correo, inténtelo más tarde');
        }
    }
}
