@extends('layout')

@section('cabecalho')
    temporadas de {{$serie->nome}}
@endsection

@section('conteudo')



    <ul class="list-group list-group-flush">
        @foreach ($temporadas as $temporada)

            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="/temporadas/{{$temporada->id}}/episodios">
                    Temporada {{$temporada->numero}}
                </a>

                <span class="badge badge-secondary"> 0 / {{$temporada->episodios->count()}} </span>
            </li>

        @endforeach
    </ul>

@endsection
