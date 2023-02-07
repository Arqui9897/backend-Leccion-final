<?php

namespace App\Http\Controllers;

use App\Models\peliculas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PeliculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peliculas = peliculas::where('estado', 1)
        ->get();
        return response()->json($peliculas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $validateData=$request->validate([
                'poster_path'=>'nullable|string',
                'overview'=>'nullable|string',
                'release_date'=>'nullable|string',
                'original_title'=>'nullable|string',
                'original_language'=>'nullable|string',
                'genre_ids'=>'nullable|string',
            ]);
            //imagen
            // $img = $request->file('cover_small');
            // $validateData['cover_small'] =  time().'.'.$img->getClientOriginalExtension();
    
    
            $peliculas=peliculas::create([
                'poster_path'=>$validateData['poster_path'],
                'overview'=>$validateData['overview'],
                'release_date'=>$validateData['release_date'],
                'original_title'=>$validateData['original_title'],
                'original_language'=>$validateData['original_language'],
                'genre_ids'=>$validateData['genre_ids'],
                'estado'=>1,
            ]);
    
            // $request->file('cover_small')->storeAs("public/images/musicas/{$musica->id}", $validateData['cover_small']);
    
            return response()->json(['message'=>'pelicula registrada'],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function show(peliculas $peliculas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function edit(peliculas $peliculas)
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, peliculas $peliculas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\peliculas  $peliculas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peliculas=peliculas::find($id);
        if (is_null($peliculas)) {
            return response()->json(['message' => 'pelicula no encontrada'], 404);
        }
        $peliculas->estado=0;
        $peliculas->save();
        return response()->json(['message'=>'pelicula eliminada']);
    }
}
