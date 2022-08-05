@extends('template.admin')

@section('page')
<form method="post" action="{{route('users.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$User->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Usuário</li>
        </ol>
    </nav>

    @if($_SESSION['sbshowcase']['isConfig'])
    <div class="alert alert-info">
        <h3 class="alert-heading">MUITO BEM!</h3>
        <p>Bem vindo ao SBShowcase! Esperamos que goste de nosso projeto opensource!</p>
        <hr>
        <p class="mb-0">Como esse é um login somente para configuração, crie um novo usuário, isso aumentará a segurança de seus dados.</p>
    </div>
    @endif

    <div class="mb-3">
        <label for="name" class="form-label">Nome do usuário</label>
        <input type="text" minlength="3" maxlength="255" class="form-control" id="name" name="name" placeholder="Nome do usuário" required value="{{$User->name ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" minlength="3" maxlength="255" class="form-control" id="email" name="email" placeholder="Email" required value="{{$User->email ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" minlength="8" class="form-control" id="password" name="password" placeholder="Senha" required value="">
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirmação da senha</label>
        <input type="password" minlength="8" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmação da senha" required value="">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Usuário salvo com sucesso!', 'error' => 'Erro ao salvar usuário!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($User) || is_null($User->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        @if(!isset($_SESSION['sbshowcase']['isConfig']) || !$_SESSION['sbshowcase']['isConfig'])
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>
        @endif

        @if(!is_null($User))
        @include('template.includes.disable-enable', ['enabled' => is_null($User->deleted_at), 'route' => route('users.delete'), 'id' => $User->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar usuário', 'placeholder' => 'Usuário', 'route' => route('users.search'), 'loadRoute' => route('users'), 'ths' => ['#', 'Nome', 'Ativa?']])
@endsection