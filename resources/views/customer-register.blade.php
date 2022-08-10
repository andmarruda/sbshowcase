@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header">
                Novo cliente
            </div>

            <div class="card-body">
                <form method="post" action="index.php" autocomplete="off">
                    <div class="mb-3">
                        <label for="name" class="form-label">* Nome completo</label>
                        <input type="text" class="form-control" id="name" name="name" required="" placeholder="Nome completo">
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">* Gênero</label>
                        <select class="form-control" id="gender" name="gender" required="">
                            <option value="">Selecione...</option>
                            <option value="1">Feminino</option>
                            <option value="2">Masculino</option>
                            <option value="3">Não informar</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nascimento" class="form-label">* Data nascimento<br><small>necessário pra identificar a maioridade, no formato DD/MM/AAAA</small></label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required="" placeholder="Data nascimento">
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">* CPF / CNPJ</label>
                        <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required="" placeholder="CPF / CNPJ">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">* Email</label>
                        <input type="email" class="form-control" id="email" name="email" required="" placeholder="Email">
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="promotional-email" name="promotional-email" checked="">
                        <label class="form-check-label" for="promotional-email">
                            receber emails promocionais
                        </label>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">* Senha<br><small>precisa ter entre 6 e 20 caracteres</small></label>
                        <input type="password" class="form-control" id="password" name="password" required="" placeholder="Senha">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">* Confirmação de senha<br><small>precisa ter entre 6 e 20 caracteres</small></label>
                        <input type="password" class="form-control" id="password-confirm" name="password-confirm" required="" placeholder="Confirmação de senha">
                    </div>

                    <hr>
                    <h5>Endereço Completo</h5>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">* CEP</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code" required="" placeholder="CEP" maxlength="9">
                    </div>

                    <div class="mb-3" id="cep-error" style="display:none;">
                        <div class="alert alert-danger">Por favor preencha um CEP válido!</div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">* Endereço</label>
                        <input type="text" class="form-control" id="address" name="address" required="" placeholder="Endereço">
                    </div>

                    <div class="mb-3">
                        <label for="number" class="form-label">* Número</label>
                        <input type="text" class="form-control" id="number" name="number" required="" placeholder="Número">
                    </div>

                    <div class="mb-3">
                        <label for="complement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="complement" name="complement" required="" placeholder="Complemento">
                    </div>

                    <div class="mb-3">
                        <label for="neighborhood" class="form-label">* Bairro</label>
                        <input type="text" class="form-control" id="neighborhood" name="neighborhood" required="" placeholder="Bairro">
                    </div>

                    <div class="mb-3">
                        <label for="state" class="form-label">* UF</label>
                        <select class="form-control" id="state" name="state">
                            <option value="">Selecione...</option>
                            @forelse($State as $st)
                            <option value="{{ $st->state_id }}">{{ $st->state_name }}</option>
                            @empty
                            <option value="">Nenhum estado cadastrado</option>
                            @endforelse
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">* Cidade</label>
                        <select class="form-control" id="city" name="city" required="">
                            <option value="">Selecione...</option>
                        </select>
                    </div>

                    <div class="mb-3" id="city-error" style="display:none;">
                        <div class="alert alert-danger">Infelizmente não entregamos em sua cidade!</div>
                    </div>

                    <div class="mb-3">
                        * Campos obrigatórios
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <div class="mb-3">
                        <a href="{{route('customer-login')}}">Já tem cadastro? Entrar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const cities = @json($City);
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('state').addEventListener('change', (event) => {
            load_cities(event.target, 'city', cities);
        });

        document.getElementById('zip_code').addEventListener('blur', (event) => {
            cepEvent(event, 'cep-error', 'city-error', {
                state: 'state',
                city: 'city',
                address: 'address',
                neighborhood: 'neighborhood',
                complement: 'complement',
                number: 'number'
            }, cities);
        });
    });
</script>
@endsection