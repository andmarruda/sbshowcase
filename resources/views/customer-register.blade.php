@extends('template.public')

@section('page')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                Novo cliente
            </div>

            <div class="card-body">
                <form method="post" action="{{route('create-customer')}}" autocomplete="off">
                    @csrf

                    @include('template.includes.alert-error')

                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">* Nome completo</label>
                            <input type="text" class="form-control" id="name" name="name" required="" placeholder="Nome completo" value="{{old('name')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="gender" class="form-label">* Gênero</label>
                            <select class="form-control" id="gender" name="gender" required="">
                                <option value="">Selecione...</option>
                                @foreach($Genders as $k => $gender)
                                    @if((old('gender') ?? '') == $k)
                                    <option value="{{$k}}" selected="selected">{{$gender}}</option>
                                    @else
                                    <option value="{{$k}}">{{$gender}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="birthdate" class="form-label">* Data nascimento <small>necessário pra identificar a maioridade</small></label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" required="" minlength="5" maxlength="100" placeholder="Data nascimento" value="{{old('birthdate')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="cpf_cnpj" class="form-label">* CPF / CNPJ <small>Somente números</small></label>
                            <input type="number" min="1" max="99999999999999" step="1" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required="" placeholder="CPF / CNPJ" value="{{old('cpf_cnpj')}}">
                        </div>

                        <div class="col">
                            <label for="email" class="form-label">* Email</label>
                            <input type="email" class="form-control" id="email" name="email" required="" placeholder="Email" value="{{old('email')}}">
                        </div>
                    </div>

                    <div class="mb-3" id="cpf-cnpj-error" style="display:none;">
                        <div class="alert alert-danger">O CPF/CNPJ não é válido! Por favor preencha um CPF/CNPJ válido!</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="promotional-email" name="promotional-email" checked="">
                                <label class="form-check-label" for="promotional-email">
                                    receber emails promocionais
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="form-label">* Senha<br><small>precisa ter entre 8 e 20 caracteres</small></label>
                            <input type="password" class="form-control" id="password" name="password" required="" minlength="8" maxlength="20" placeholder="Senha">
                        </div>

                        <div class="col">
                            <label for="email" class="form-label">* Confirmação de senha<br><small>precisa ter entre 8 e 20 caracteres</small></label>
                            <input type="password" class="form-control" id="password_confirmation" minlength="8" maxlength="20" name="password_confirmation" required="" placeholder="Confirmação de senha">
                        </div>
                    </div>

                    <hr>
                    <h5>Endereço Completo</h5>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="phone" class="form-label">* Celular</label>
                            <input type="text" class="form-control" id="phone" name="phone" required="" placeholder="Celular" value="{{old('phone')}}">
                        </div>
                        <div class="col">
                            <label for="zip_code" class="form-label">* CEP</label>
                            <input type="text" class="form-control" id="zip_code" name="zip_code" required="" placeholder="CEP" maxlength="9" value="{{old('zip_code')}}">
                        </div>
                    </div>

                    <div class="mb-3" id="cep-error" style="display:none;">
                        <div class="alert alert-danger">Por favor preencha um CEP válido!</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label for="address" class="form-label">* Endereço</label>
                            <input type="text" class="form-control" id="address" name="address" required="" placeholder="Endereço" value="{{old('address')}}">
                        </div>

                        <div class="col-md-4">
                            <label for="number" class="form-label">* Número</label>
                            <input type="text" class="form-control" id="number" name="number" required="" placeholder="Número" value="{{old('number')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="complement" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="complement" name="complement" placeholder="Complemento" value="{{old('complement')}}">
                        </div>

                        <div class="col">
                            <label for="neighborhood" class="form-label">* Bairro</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required="" placeholder="Bairro" value="{{old('neighborhood')}}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
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

                        <div class="col">
                            <label for="city" class="form-label">* Cidade</label>
                            <select class="form-control" id="city" name="city" required="">
                                <option value="">Selecione...</option>
                            </select>
                        </div>
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

        document.getElementById('cpf_cnpj').addEventListener('blur', (event) => {
            checkCpfCnpj(event.target, 'cpf-cnpj-error');
        });

        VMasker(document.getElementById('phone')).maskPattern("(99)99999-9999");
        VMasker(document.getElementById('zip_code')).maskPattern("99999-999");

        @if(old('state'))
        document.getElementById('state').value = "{{old('state')}}";
        load_cities(document.getElementById('state'), 'city', cities);
        document.getElementById('city').value = "{{old('city')}}";
        @endif
    });
</script>
@endsection