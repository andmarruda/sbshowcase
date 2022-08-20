@extends('template.admin')

@section('page')
<form method="post" action="{{route('email.providers.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$EmailProvider->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Provedor de email</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="host" class="form-label">Host</label>
        <input type="text" minlength="3" maxlength="100" class="form-control" id="host" name="host" placeholder="Host" required value="{{$EmailProvider->host ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="port" class="form-label">Porta</label>
        <input type="number" min="1" max="65535" step="1" class="form-control" id="port" name="port" placeholder="Porta" required value="{{$EmailProvider->port ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">Usuário</label>
        <input type="text" minlength="3" class="form-control" id="username" name="username" placeholder="Usuário" required value="{{$EmailProvider->username ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="pass" class="form-label">Senha</label>
        <input type="password" minlength="3" class="form-control" id="pass" name="pass" placeholder="Senha" required value="{{$EmailProvider->pass ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="secure" class="form-label">SMTP Secure</label>
        @php
            $smtpSecure = ['tls' => 'tls', 'ssl' => 'ssl'];
        @endphp
        <select class="form-control" id="secure" name="secure">
            <option value="">Selecione</option>
            @foreach($smtpSecure as $key => $value)
                <option value="{{$key}}" @if(!is_null($EmailProvider) && $EmailProvider->secure == $key) selected @endif>{{$value}}</option>
            @endforeach
        </select>
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Provedor de email salvo com sucesso!', 'error' => 'Erro ao salvar o provedor de email!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($EmailProvider) || is_null($EmailProvider->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($EmailProvider))
        @include('template.includes.disable-enable', ['enabled' => is_null($EmailProvider->deleted_at), 'route' => route('category.delete'), 'id' => $EmailProvider->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar categoria', 'placeholder' => 'Categoria', 'route' => route('category.search'), 'loadRoute' => route('category'), 'ths' => ['#', 'Categoria', 'Ativa?']])
@endsection