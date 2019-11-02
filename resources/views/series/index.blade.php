@extends('layout')

@section('cabecalho')
    séries
@endsection

@section('conteudo')

    @include('mensagem', ['mensagem' => $mensagem])

    @auth
{{--    <a href="/series/create" class="btn btn-dark mb-2">Adicionar</a>--}}
    <a href="{{route('series.create')}}" class="btn btn-dark mb-2">Adicionar</a>
    @endauth

    <ul class="list-group list-group-flush">
        @foreach ($series as $serie)

            <li class="list-group-item d-flex justify-content-between align-items-center">

{{--                nome deentro do span pra ajudar a sumir quando o editar tiver online--}}
                <span id="nome-serie-{{$serie->id}}"> {{$serie->nome}} </span>

{{--                input pra editar escondido--}}
                <div  class="input-group w-50" id="input-nome-serie-{{$serie->id}}" hidden>
                    <input type="text" class="form-control" value="{{$serie->nome}}">
                    <div class="input-group-append">
                        <button class="btn btn-primary btn-sm"      onclick="editarSerie({{$serie->id}})">
                            <i class="material-icons"> check </i>
                        </button>
{{--                        tem que ter o Token pra usar no JavaScript--}}
                        @csrf
                    </div>
                </div>


                <span class="d-flex">
{{--                    botao editar--}}
                    @auth
                    <button class="btn btn-dark btn-sm mr-1"        onclick="toggleInput({{$serie->id}})">
                        <i class="material-icons"> edit </i>
                    </button>
                    @endauth

{{--                    botao launch--}}
                    <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm mr-1">
                        <i class="material-icons">
                            launch
                        </i>
                    </a>

                    @auth
{{--                    botao de delete dentro de um FORM p/ nao ter DOM CRAWLER apagando os dados sozinho--}}
                    <form method="post" action="/series/{{$serie->id}}" onsubmit="confirm('Tem certeza que deseja excluir {{addslashes($serie->nome)}}')">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="material-icons">
                                delete_forever
                            </i>
                        </button>
                    </form>
                    @endauth

                </span>

            </li>

        @endforeach
    </ul>

    <script>
        function toggleInput(serieId) {
            const nomeSerie = document.getElementById(`nome-serie-${serieId}`);
            const inputEditar = document.getElementById(`input-nome-serie-${serieId}`);

            if (inputEditar.hidden) {
                inputEditar.removeAttribute('hidden');
                nomeSerie.hidden = true;
            } else {
                inputEditar.hidden = true;
                nomeSerie.removeAttribute('hidden');
            }
        }



        // pegar o valor do input e enviar para o Laravel como se fosse formulario, mas pelo JavaScript
        function editarSerie(serieId) {
            //criando um form
            let formData = new FormData();

            const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
            const token = document.querySelector('input[name="_token"]').value;
            // alert(token);

            formData.append('nome', nome);
            formData.append('_token', token);

            // agora precisa enviar para uma rota do Laravel
            const url = `/series/${serieId}/editaNome`;

            //fazer uma requisição para url
            fetch(url, {
                body: formData,
                method: 'POST'
            }).then( () => {
                toggleInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome;
            });

        }

    </script>

@endsection
