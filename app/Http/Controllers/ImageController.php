<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Http\Response;

class ImageController extends Controller{

    public function __construct(){

        $this->middleware('auth');
    }

    public function create(){


        return view('image.create');

    }

    public function save(Request $request){

        // Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        // Recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        // Asignar valores al nuevo objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;

        // Manejo y almacenamiento de la imagen cargada
        if ($image_path) {
            // Poner nombre único a la imagen
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Guardar imagen en el disco
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            // Asignar el nombre de la imagen al atributo image_path del objeto
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('home')->with(['message' => 'Imagen subida correctamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);

        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail',[
            'image'=> $image
        ]);
    }

}
