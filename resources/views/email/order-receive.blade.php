@extends('email.email-template')

@section('email')
@include('template.includes.order-details', ['Order' => $data['Order'], 'OrderAddress' => $data['OrderAddress'], 'Products' => $data['Products'], 'PaymentMethod' => $data['PaymentMethod']])
@endsection