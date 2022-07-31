@extends('template.admin')

@section('page')
<form method="post" action="{{route('delivery.save')}}" autocomplete="off">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Entrega</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <label for="width" class="form-label">UF</label>
            <select class="form-control" id="state_id" name="state_id" onchange="javascript: state_select(event);" required>
                <option value="">Selecione...</option>
                @if(!is_null($States))
                    @foreach($States as $state)
                        <option value="{{$state->state_id}}"{{!is_null($selected_state_id) && $state->state_id==$selected_state_id ? ' selected="selected"' : ''}}>{{$state->state_initials}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col">
            <label for="height" class="form-label">Cidade</label>
            <select class="form-control" id="city_id" name="city_id" required>
                <option value="">Selecione...</option>
                @if(!is_null($Cities))
                    @foreach($Cities as $city)
                        <option value="{{$city->city_id}}">{{$city->city_name}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col">
            <label for="price" class="form-label">Preço <small>em R$</small></label>
            <input type="number" required step="0.01" min="0" max="99999" class="form-control" id="price" name="price" placeholder="Preço" required value="">
        </div>

        <div class="col">
            <button type="submit" class="btn btn-primary" style="margin-top:2rem;"><i class="fa-regular fa-floppy-disk"></i> Adicionar</button>
        </div>
    </div>

    <div class="row" style="margin-top:1rem;">
        <div class="col">
            @include('template.includes.alert-error')

            @if(!is_null(session('saved')))
                @include('template.includes.alert-saved', ['success' => 'Configuração de entrega salva com sucesso!', 'error' => 'Erro ao salvar configuração de entrega!', 'saved' => session('saved')])
            @endif
        </div>
    </div>

    <div class="row" style="margin-top:1.5rem;">
        <div class="col">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>País</th>
                        <th>UF</th>
                        <th>Cidade</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</form>

<script>
    const state_select = (event) => {
        let val = event.target.value;
        location.href = '{{route("delivery")}}/'+ val;
    };
</script>
@endsection