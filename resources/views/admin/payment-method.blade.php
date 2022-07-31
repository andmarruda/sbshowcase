@extends('template.admin')

@section('page')
<form method="post" action="{{route('payment-methods.save')}}" autocomplete="off">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Formas de pagamento</li>
        </ol>
    </nav>

    <div class="alert alert-info">Para desativar a forma de pagamento basta colocar 0 no número de parcelas.</div>

    <h5>Tipo de pagamento | Número de parcelas</h5><hr>

    @foreach($PaymentMethod as $pm)
    <div class="input-group mb-3">
        <span class="input-group-text"><img src="{{asset($pm->icon)}}" alt="{{$pm->name}}"></span>
        <input type="number" min="0" max="500" step="1" class="form-control" name="payment_method[{{$pm->id}}]" id="payment_method_{{$pm->id}}" placeholder="Número de parcelas" value="{{$pm->installments ?? ''}}">
    </div>
    @endforeach

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Formas de pagamento salvas com sucesso!', 'error' => 'Erro ao salvar Formas de pagamento!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>
@endsection