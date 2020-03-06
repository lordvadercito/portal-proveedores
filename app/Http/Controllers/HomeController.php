<?php

namespace App\Http\Controllers;

use App\Romaneo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $romaneos = Romaneo::all();
        return view('home', compact('romaneos'));
    }

    public function create()
    {
        if (auth()->user()->rol == User::DOWNLOADER) {
            return redirect('home');
        }
        return view('create');
    }

    public function store(Request $request)
    {
        $file = $request->file('file');

        //obtenemos el nombre del archivo
        $nombre = $file->getClientOriginalName();

        //indicamos que queremos guardar un nuevo archivo en el disco local
        \Storage::disk('local')->put($nombre, \File::get($file));

        Romaneo::create([
            'nombre' => $request->input('nombre'),
            'uri' => $nombre
        ]);

        return redirect('home')->with('success','Romaneo subido correctamente');
    }

    public function destroy($id)
    {
        $romaneo = Romaneo::findOrFail($id);
        $romaneo->delete();

        return redirect('home')->with('success','Romaneo borrado correctamente');
    }
}
