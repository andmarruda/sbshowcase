<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <ul class="list-inline" style="margin-top:1rem;">
                @foreach($PaymentMethod as $pm)
                <li class="list-inline-item"><img src="{{asset($pm->icon)}}" alt="{{$pm->name}}"></li>
                @endforeach
            </ul>

            <ul class="list-unstyled">
                <li><b>CNPJ:</b> {{$general->company_doc}}</li>
                <li><b>Razão Social:</b> {{$general->company_name}}</li>
            </ul>
        </div>
    </div>
</div>