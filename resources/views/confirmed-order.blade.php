@extends('template.public')

@section('page')
@include('template.includes.order-details', ['Order' => $Order, 'OrderAddress' => $OrderAddress, 'Products' => $Products, 'PaymentMethod' => $PaymentMethod])
@endsection