@extends('template.admin')

@section('page')
<form method="post" action="{{route('users.save')}}" autocomplete="off">
    <input type="hidden" name="id" id="id" value="{{$User->id ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ol>
    </nav>
</form>
@endsection