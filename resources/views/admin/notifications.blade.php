@extends('template.admin')

@section('page')
<form method="post" action="{{route('email.notifications.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$EmailNotificate->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Email notificados</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="mail_name" class="form-label">Nome do contato</label>
        <input type="text" minlength="3" maxlength="100" class="form-control" id="mail_name" name="mail_name" placeholder="Nome do contato" required value="{{$EmailNotificate->name ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="mail" class="form-label">Email</label>
        <input type="mail" class="form-control" id="mail" name="mail" placeholder="Email" required value="{{$EmailNotificate->email ?? ''}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Email notificado salvo com sucesso!', 'error' => 'Erro ao salvar email notificado!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        @if(is_null($EmailNotificate) || is_null($EmailNotificate->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</button>

        @if(!is_null($EmailNotificate))
        @include('template.includes.disable-enable', ['enabled' => is_null($EmailNotificate->deleted_at), 'route' => route('email.notifications.delete'), 'id' => $EmailNotificate->id, 'token' => csrf_token()])
        @endif
    </div>
</form>

@include('template.includes.search-modal', ['modalTitle' => 'Pesquisar email de contato', 'placeholder' => 'Email de contato', 'route' => route('email.notifications.search'), 'loadRoute' => route('email.notifications'), 'ths' => ['#', 'Nome', 'Ativa?']])
@endsection