@extends('email.email-template')

@section('email')
@include('template.includes.order-details', ['Order' => $Order, 'OrderAddress' => $OrderAddress, 'Products' => $Products, 'PaymentMethod' => $PaymentMethod])
@endsection