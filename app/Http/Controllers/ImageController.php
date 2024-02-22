<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use Illuminate\Http\Response;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Log;

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

    public function delete(Request $request, $id)
{
    $user = \Auth::user();
    $image = Image::find($id);
    $comments = Comment::where('image_id', $id)->get();
    $likes = Like::where('image_id', $id)->get();

    if ($user && $image && $image->user->id == $user->id) {

        foreach ($comments as $comment) {
            $comment->delete();
        }

        foreach ($likes as $like) {
            $like->delete();
        }

        Storage::disk('images')->delete($image->image_path);

        $image->delete();

        $message = array('message' => 'La imagen se ha borrado correctamente.');


        $logEntry = new Log();
        $logEntry->user_id = $user->id;
        $logEntry->action = 'Eliminar imagen';
        $logEntry->ip = $request->ip();
        $logEntry->table_name = 'images';
        $logEntry->table_id = $id;
        $logEntry->save();
    } else {
        $message = array('message' => 'La imagen no se ha borrado.');
    }

    return redirect('/')->with($message);
}
    public function edit($id){
        $user = \Auth::user();
        $image = Image::find($id);

        if ($user && $image && $image->user->id == $user->id) {
            return view('image.edit',[
                'image' => $image]);
        } else {
            return redirect('/')->with('','');
        }

    }

    public function update(Request $request)
    {
        // Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image'
        ]);

        $image_id = $request->input('image_id');
        $description = $request->input('description');
        $image_path = $request->file('image_path');

        $image = Image::find($image_id);
        $image->description = $description;

        if ($image_path) {
            // Poner nombre único a la imagen
            $image_path_name = time() . $image_path->getClientOriginalName();
            // Guardar imagen en el disco
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            // Asignar el nombre de la imagen al atributo image_path del objeto
            $image->image_path = $image_path_name;
        }

        $image->update();

        // Registrar la acción en el sistema de logs
        $logEntry = new Log();
        $logEntry->user_id = auth()->id();
        $logEntry->action = 'Actualizar imagen';
        $logEntry->ip = $request->ip();
        $logEntry->table_name = 'images';
        $logEntry->table_id = $image->id;
        $logEntry->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with(['message'=> 'Imagen actualizada con éxito']);
    }

}
