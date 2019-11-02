@extends('layout')

@section('cabecalho')
    adicionar série
@endsection

@section('conteudo')

    @include('erros', ['errors' => $errors])

    <form method="post">
        @csrf

        <div class="row">
            <div class="col col-8">
                <label for="nome" class="text-muted">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome">
            </div>

            <div class="col col-2">
                <label for="qtd_temporadas" class="text-muted">Nº temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
            </div>

            <div class="col col-2">
                <label for="ep_por_temporada" class="text-muted">Ep. por temporada</label>
                <input type="number" class="form-control" name="ep_por_temporada" id="ep_por_temporada">
            </div>

        </div>

        <button class="btn btn-primary mt-2">Adicionar</button>

    </form>
@endsection

