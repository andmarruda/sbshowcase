@extends('template.customer')

@section('page')
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Área do cliente</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dados cadastrados</li>
        </ol>
    </nav>

    <form method="post" action="{{route('customer-update-registration-data')}}" autocomplete="off">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">* Nome completo</label>
            <input type="text" class="form-control" id="name" name="name" required="" placeholder="Nome completo" value="{{$Customer->name}}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">* Gênero</label>
            <select class="form-control" id="gender" name="gender" required="">
                <option value="">Selecione...</option>
                @foreach($Genders as $k => $gender)

                @if($k==$Customer->gender)
                <option value="{{$k}}" selected="selected">{{$gender}}</option>
                @else
                <option value="{{$k}}">{{$gender}}</option>
                @endif

                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nascimento" class="form-label">* Data nascimento<br><small>necessário pra identificar a maioridade, no formato DD/MM/AAAA</small></label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required="" placeholder="Data nascimento" value="{{$Customer->birth_date}}">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF / CNPJ</label>
            <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj" required="" placeholder="CPF / CNPJ" value="{{$Customer->cpf_cnpj}}" readonly>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required="" placeholder="Email" value="{{$Customer->email}}" readonly>
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
            <label for="zip_code" class="form-label">* CEP</label>
            <input type="text" class="form-control" id="zip_code" name="zip_code" required="" placeholder="CEP" value="{{$Customer->zip_code}}">
        </div>
        
        <div class="mb-3">
            <label for="address" class="form-label">* Endereço</label>
            <input type="text" class="form-control" id="address" name="address" required="" placeholder="Endereço" value="{{$Customer->address}}">
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">* Número</label>
            <input type="text" class="form-control" id="number" name="number" required="" placeholder="Número" value="{{$Customer->number}}">
        </div>

        <div class="mb-3">
            <label for="complement" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complement" name="complement" required="" placeholder="Complemento" value="{{$Customer->complement}}">
        </div>

        <div class="mb-3">
            <label for="neighborhood" class="form-label">* Bairro</label>
            <input type="text" class="form-control" id="neighborhood" name="neighborhood" required="" placeholder="Bairro" value="{{$Customer->neighborhood}}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">* Celular</label>
            <input type="text" class="form-control" id="phone" name="phone" required="" placeholder="Celular" value="{{$Customer->phone}}">
        </div>

        <div class="mb-3">
            <label for="state" class="form-label">* UF</label>
            <select class="form-control" id="state_id" name="state_id">
                <option value="">Selecione...</option>
                @forelse($State as $st)
                
                @if($st->state_id==$Customer->state_id)
                <option value="{{ $st->state_id }}" selected="selected">{{ $st->state_name }}</option>
                @else
                <option value="{{ $st->state_id }}">{{ $st->state_name }}</option>
                @endif

                @empty
                <option value="">Nenhum estado cadastrado</option>
                @endforelse
            </select>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">* Cidade</label>
            <select class="form-control" id="city_id" name="city_id" required="">
                <option value="">Selecione...</option>
                @forelse($StateCities as $stateCity)
                
                @if($stateCity->city_id==$Customer->city_id)
                <option value="{{ $stateCity->city_id }}" selected="selected">{{ $stateCity->city_name }}</option>
                @else
                <option value="{{ $stateCity->city_id }}">{{ $stateCity->city_name }}</option>
                @endif

                @empty
                <option value="">Nenhuma cidade cadastrada</option>
                @endforelse
            </select>
        </div>

        <div class="mb-3">
            * Campos obrigatórios
        </div>

        <hr>

        @include('template.includes.alert-error')

        @if(!is_null(session('saved')))
            @include('template.includes.alert-saved', ['success' => 'Dados cadastrados alterados com sucesso!', 'error' => 'Erro ao alterar dados cadastrados!', 'saved' => session('saved')])
        @endif

        <div class="mb-3">
            <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        </div>
    </form>
</div>

<script>
    const cities = @json($City);
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('state').addEventListener('change', (event) => {
            load_cities(event.target, 'city', cities);
        });

        document.getElementById('zip_code').addEventListener('blur', (event) => {
            cepEvent(event, 'cep-error', 'city-error', {
                state: 'state_id',
                city: 'city_id',
                address: 'address',
                neighborhood: 'neighborhood',
                complement: 'complement',
                number: 'number'
            }, cities);
        });

        VMasker(document.getElementById('phone')).maskPattern("(99)99999-9999");
        VMasker(document.getElementById('zip_code')).maskPattern("99999-999");
    });
</script>
@endsection