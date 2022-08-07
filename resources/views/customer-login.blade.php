@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                Área do cliente
            </div>

            <div class="card-body">
                <form method="post" action="index.php">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email / CPF / CNPJ</label>
                        <input type="text" class="form-control" id="user" name="user" required="" placeholder="Email / CPF / CNPJ">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" required="" placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <div class="mb-3">
                        <a href="{{route('customer-register')}}">Não tem cadastro? Cadastre-se</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection