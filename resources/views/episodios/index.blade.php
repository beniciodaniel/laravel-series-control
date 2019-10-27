@extends('layout')

@section('cabecalho')
    episódios
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    <form action="/temporadas/{{$temporadaId}}/episodios/assistidos" method="POST">
        @csrf
        <ul class="list-group list-group-flush">
            @foreach($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between">
                    <span>Episódio {{$episodio->numero}}</span>
                    <input type="checkbox"
                           name="episodios[]"
                           value="{{$episodio->id}}"
                        {{ $episodio->assistido ? 'checked' : ''}}>
                </li>
            @endforeach
        </ul>

        <div class="d-flex justify-content-end">
            <button class="btn btn-primary mt-2 mb-2">salvar</button>
        </div>
    </form>



@endsection
