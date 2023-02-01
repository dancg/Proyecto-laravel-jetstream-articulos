<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function index1()
    {
        $articles = Article::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
        return view('dashboard', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:articles,nombre'],
            'descripcion' => ['required', 'string', 'min:10'],
            'precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'stock' => ['required', 'numeric', 'min:1'],
            'imagen' => ['required', 'image', 'max:2048']
        ]);
        //Guardamos la imagen en el disco
        $img = $request->imagen->store('fotos');

        //Creamos el registro en la base de datos
        Article::create([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $img,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->route('dashboard')->with('mensaje', 'Artículo Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'unique:articles,nombre,' . $article->id],
            'descripcion' => ['required', 'string', 'min:10'],
            'precio' => ['required', 'numeric', 'min:1', 'max:999.99'],
            'stock' => ['required', 'numeric', 'min:1'],
            'imagen' => ['nullable', 'image', 'max:2048']
        ]);
        //Si se ha subido una imagen se guarda en fotos, si no mantenemos la antigua
        $img = ($request->imagen) ? $request->imagen->store('fotos') : $article->imagen;
        $img1 = $article->imagen;

        //Creamos el registro en la base de datos
        $article->update([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'imagen' => $img,
            'user_id' => auth()->user()->id
        ]);

        //Comprobamos si hemos subido una imagen nueva para borrar la vieja
        if ($request->imagen) {
            Storage::delete($img1);
        }

        return redirect()->route('dashboard')->with('mensaje', 'Artículo Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //Primero borramos la imagen
        Storage::delete($article->imagen);
        //Despúes borramos el artículo
        $article->delete();
        return redirect()->route('dashboard')->with('mensaje', 'Artículo Borrado');
    }
}
