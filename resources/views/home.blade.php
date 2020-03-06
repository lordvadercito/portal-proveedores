@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
            <div id="message" class="alert alert-success">
                <p class="text-center"><b>{{ $message }}</b></p>
            </div>
        @endif
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($romaneos as $romaneo)
                                    <tr>
                                        <th scope="row">{{ $romaneo->id }}</th>
                                        <td>{{ $romaneo->nombre }}</td>
                                        <td>{{ $romaneo->created_at->format('d-m-Y') }}</td>
                                        <td><a role="button" class="btn btn-link" href="{{ $romaneo->uri }}"
                                               download="{{$romaneo->nombre}}_{{$romaneo->created_at->format('d-m-Y')}}.pdf">Descargar</a>
                                        </td>
                                        @if(auth()->user()->rol == \App\User::UPLOADER)
                                            <td>
                                                <button type="button" class="btn btn-link" style="color: red;"
                                                        data-toggle="modal" data-target="#deleteModal">
                                                    Eliminar
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                 aria-labelledby="deleteModal"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar romaneo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-center">¿Está seguro que desea eliminar este romaneo?</h5>
                                            <p class="text-center"><b>Nombre: </b>{{ $romaneo->nombre }}</p>
                                            <p class="text-center"><b>Subido
                                                    el: </b>{{ $romaneo->created_at->format('d-m-Y H:i:s')}}</p>
                                        </div>
                                        <form action="{{ url("/{$romaneo->id}/eliminar") }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
