@extends('email.email-template')

@section('email')
<p>Um novo pedido foi adicionado no sistema. Para conferir acesse o painel administrativo. <a href="{{route('admin')}}" target="_blank">clique aqui para acessar o painel administrativo.</a></p>
<p>Lembrando que esse é somente um aviso de um novo pedido inserido no sistema. Sempre confirme os dados e informações pertinentes no painel administrativo e nunca confie 100% em emails.</p>
@endsection