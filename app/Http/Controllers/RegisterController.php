<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        //Mostramos la vista desde las views
        return view('autentications.crear-cuenta');
    }
    public function store(REQUEST $request)
    {
        //Modificar el request cuando ya es ultima opcion para realizar alguna validacion en un campo especifico
        $request->request->add(['username' => Str::slug($request->username)]);
        //Validacion para formualario 
        $this->validate($request,
        [
            'name' => 'required|min:4|max:30',
            'username' => 'required|unique:users|min:5|max:15',
            'email' => 'required|unique:users|email|max:30',
            'password' => 'required|confirmed|min:6',

        ]); 

        //Usando el metodo User vamos a crear nuevo usuario con el helper create para almacenar en base de datos
        //son la propiedad create que es similar en php puro como Insert into 
        User::create([
            'name' => $request->name,
            //El helper str::slug nos va a convertir una cadena de caracteres a un ulr, es decir si un usuario ingresa "gustavo 123" el helper guardara en la base de datos gustavo-123
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => $request->password,
            //Nota en el gestor workbench los password los encripta en automatico pero si en algun otro gestor los password se almacenan directo podemos usar el modelo que ya tiene laravel y quedaria 'password' => hash::make($request->password)
        ]);

        //Autenticar al usuario creado, utilizamos el helper attempt para intentar autenticar al usuario  
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Redireccionar a paginas con el helper redirect y route para especificar la ruta 
        return redirect()->route('posts.index');
    }
}
