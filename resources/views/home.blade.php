@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($romaneos->isEmpty())
                            <h4 class="text-center text-muted">No hay romaneos cargados</h4>
                        @else
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha de subida</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($romaneos as $romaneo)
                                    <tr>
                                        <th scope="row">{{ $romaneo->id }}</th>
                                        <td>{{ $romaneo->nombre }}</td>
                                        <td>{{ $romaneo->created_at->format('d-m-Y') }}</td>
                                        <td><a href="{{ $romaneo->uri }}"
                                               download="{{$romaneo->nombre}}_{{$romaneo->created_at->format('d-m-Y')}}.pdf">Descargar</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if(auth()->user()->rol == \App\User::UPLOADER)
                                <a href="{{ url('/crear') }}" role="button" class="btn btn-primary">Subir Nuevo</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
