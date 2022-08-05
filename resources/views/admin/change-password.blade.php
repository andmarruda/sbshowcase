@extends('template.admin')

@section('page')
<form method="post" action="{{route('users.change-password')}}" autocomplete="off">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alterar senha</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="oldPassword" class="form-label">Senha antiga</label>
        <input type="password" minlength="8" class="form-control" id="oldPassword" name="oldPassword" placeholder="Senha antiga" required value="">
    </div>

    <div class="mb-3">
        <label for="newPassword" class="form-label">Nova senha</label>
        <input type="password" minlength="8" class="form-control" id="newPassword" name="newPassword" placeholder="Nova senha" required value="">
    </div>

    <div class="mb-3">
        <label for="newPassword_confirmation" class="form-label">Confirmação da nova senha</label>
        <input type="password" minlength="8" class="form-control" id="newPassword_confirmation" name="newPassword_confirmation" placeholder="Confirmação da nova senha" required value="">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Senha alterada com sucesso!', 'error' => 'Erro ao alterar a senha!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>
@endsection