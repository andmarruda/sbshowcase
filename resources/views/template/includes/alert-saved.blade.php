@if($saved)
    @include('template.includes.alert-success', ['message' => $success])
@else
    @include('template.includes.alert-danger', ['message' => $error])
@endif