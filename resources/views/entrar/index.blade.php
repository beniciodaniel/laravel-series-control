@extends('layout')

@section('cabecalho')
    Entrar
@endsection

@section('conteudo')


    @include('erros', ['errors' => $errors])

    <form method="post">
        @csrf

        <div class="form-group">
            <label for="email">e-mail</label>
            <input type="email" name="email" id="email" required class="form-control">
        </div>

        <div class="form-group">
            <label for="password">senha</label>
            <input type="password" name="password" id="password" required min="1" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">
            entrar
        </button>

        <a href="/registrar" class="btn btn-secondary mt-3">
            registrar-se
        </a>
    </form>



@endsection