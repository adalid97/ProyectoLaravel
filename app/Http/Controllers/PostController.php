<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $injectionController;

    public function __construct(InjectionController $injectionController)
    {
        $this->injectionController = $injectionController;
    }

    public function show($id)
    {
        $mensaje = $this->injectionController->showMessage();
        return "Showing post " . $id . "</br>" . $mensaje;
    }

    public function mostrarTodosLosDatos()
    {
        $posts = Post::all();

        return view('blog.datos', compact('posts'));
    }

    public function mostrarUnSoloDato($id)
    {
        $post = Post::find($id);
        return $post->toJson();
    }

    public function sinoSeEncuentraMuestraError($id)
    {
        $post = Post::findOrFail($id);
        return $post->toJson();
    }

    public function update(Request $request, $id)
    {
        $data = [
            'title' => $request->title,
            'body' => $request->body,
        ];
        $post = Post::findOrFail($id);
        $post->update($data);
        return $post->toJson();
    }

    public function eliminarDato($id)
    {
        Post::destroy($id);
        return "Eliminado correctamente";
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        // Store post
        $post = Post::create($request->except('csrf'));
        return redirect(url('/'));
    }

    public function create()
    {
        return view('blog.nuevoPost');
    }
}
