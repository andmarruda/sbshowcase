@extends('template.customer')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Área do cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dados cadastrados</li>
        </ol>
    </nav>

    <form method="post" action="{{route('users.change-password')}}" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome completo</label>
            <input type="text" class="form-control" id="name" name="name" required="" placeholder="Nome completo">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gênero</label>
            <select class="form-control" id="gender" name="gender" required="">
                <option value="">Selecione...</option>
                <option value="1">Feminino</option>
                <option value="2">Masculino</option>
                <option value="3">Não informar</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="nascimento" class="form-label">Data nascimento<br><small>necessário pra identificar a maioridade, no formato DD/MM/AAAA</small></label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" required="" placeholder="Data nascimento">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF / CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required="" placeholder="CPF / CNPJ" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required="" placeholder="Email" readonly>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="promotional-email" name="promotional-email" checked="">
            <label class="form-check-label" for="promotional-email">
                receber emails promocionais
            </label>
        </div>

        <hr>
        <h5>Endereço Completo</h5>

        <div class="mb-3">
            <label for="zip_code" class="form-label">CEP</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" required="" placeholder="CEP">
        </div>
        
        <div class="mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="address" name="address" required="" placeholder="Endereço">
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Número</label>
            <input type="text" class="form-control" id="number" name="number" required="" placeholder="Número">
        </div>

        <div class="mb-3">
            <label for="complement" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complement" name="complement" required="" placeholder="Complemento">
        </div>

        <div class="mb-3">
            <label for="neighborhood" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required="" placeholder="Bairro">
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="city" name="city" required="" placeholder="Cidade">
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">UF</label>
            <input type="text" class="form-control" id="state" name="state" required="" placeholder="UF">
        </div>

        <hr>

        @include('template.includes.alert-error')

        @if(!is_null(session('saved')))
            @include('template.includes.alert-saved', ['success' => 'Senha alterada com sucesso!', 'error' => 'Erro ao alterar a senha!', 'saved' => session('saved')])
        @endif

        <div class="mb-3">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        </div>
    </form>
</div>
@endsection