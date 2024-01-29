<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function config(){

        return view('user.config');
    }

    public function update(Request $request){

        // Conseguir usuario identificado
        $user = Auth::user();
        $id = $user->id;

        // Validación de los datos del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);

        // Recoger datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        // Subir imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            // Poner nombre único
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Guardarla en la carpeta storage (disk 'users')
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // Setear el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }

        // Asignar nuevos valores al usuario y ejecutar consulta
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        $user->update();

        return redirect()->route('config')->with(['message' => 'Usuario actualizado correctamente']);
    }


    public function getImage($filename){

        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

}