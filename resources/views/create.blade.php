@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ url('/subir') }}" accept-charset="UTF-8" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8 offset-2">
                <div class="form-group">
                    <label for="nombre">Nombre del archivo (sin espacios)</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del archivo">
                </div>
                <div class="form-group">
                    <label for="documento">Cargue el archivo</label>
                    <input type="file" class="form-control-file" id="documento" name="file" accept=".pdf">
                </div>
                <button type="submit" class="btn btn-primary">Subir</button>
            </div>
        </div>
    </form>
@endsection
