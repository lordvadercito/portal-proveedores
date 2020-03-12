<?php

namespace App\Http\Controllers;

use App\Romaneo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $input_name = str_replace(' ', '_', $request->input('nombre'));
        $random = random_int(0, 99);
        $now = Carbon::now()->format('d_m_Y_H_i_s');
        $ext = $file->getClientOriginalExtension();

        //armamos el nombre del archivo
        $nombre = "romaneo_" . $input_name . "_" . $now . "_" . $random . ".$ext";

        //lo almacenamos y obtenemos el path
        $uri = $file->storeAs('romaneos', $nombre);

        Romaneo::create([
            'nombre' => $input_name,
            'uri' => $uri
        ]);

        return redirect('home')->with('success', 'Romaneo subido correctamente');
    }

    public function download($id)
    {
        $romaneo = Romaneo::findOrFail($id);
        $uri = $romaneo->uri;

        return Storage::download($uri);
    }

    public function show($id)
    {
        $romaneo = Romaneo::findOrFail($id);
        $uri = $romaneo->uri;

        return Storage::response($uri);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $romaneo = Romaneo::findOrFail($id);
        $romaneo->delete();

        return redirect('home')->with('success', 'Romaneo borrado correctamente');
    }
}
