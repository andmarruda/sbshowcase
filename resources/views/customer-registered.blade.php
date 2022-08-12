@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                Cliente registrado com sucesso!
            </div>

            <div class="card-body">
                @if(!is_null(session('saved')))
                    Parabéns e seja bem vindo {{session('name')}} ao nosso sistema!<br>
                    Para acessar o painel do cliente clique <a href="{{ route('customer-area') }}">aqui</a>
                @else
                    Ocorreu um erro ao registrar o cliente, tente novamente mais tarde.
                @endif
            </div>
        </div>
    </div>
</div>
@endsection