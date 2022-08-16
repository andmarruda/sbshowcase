<div class="col-md-2">
    <img src="{{asset($Product['product']->getImage())}}" class="img-fluid rounded-start" alt="{{$Product['product']->name}}">
</div>
<div class="col-md-10">
    <div class="card-body">
        <h5 style="margin-bottom:0;">{{$Product['product']->name}}</h5>
        <small class="card-text">Em <a href="{{route('product-list', ['id' => $Product['product']->category->id, 'name' => str_replace(' ', '-', $Product['product']->category->name)])}}" title="{{$Product['product']->category->name}}">{{$Product['product']->category->name}}</a></small>
        <div class="d-flex justify-content-end align-items-center" style="margin-top:2rem;">
            <div style="text-align:center; margin-right:3rem;">
                <div class="input-group" style="width:auto;">
                    <button class="btn btn-outline-secondary" data-type="minus" type="button">-</button>
                    <input type="number" autocomplete="off" class="textfield" id="input-quantity-{{$Product['product']->id}}" data-url="{{route('cart-change', ['product_id' => $Product['product']->id, 'quantity' => -99])}}" data-id="{{$Product['product']->id}}" step="1" min="0" max="{{$Product['product']->quantity}}" value="{{$Product['quantity']}}" style="text-align: center; width:80px;">
                    <button class="btn btn-outline-secondary" data-type="plus" type="button">+</button>
                </div>

                <a href="javascript: removeFromCart('{{route('cart-remove', ['product_id' => $Product['product']->id])}}');" id="remove_product_{{$Product['product']->id}}" class="btn btn-outline-danger btn-sm" style="margin-top:0.5rem;">Remover item</a>
            </div>
            <div>
                <p class="price card-text">Preço unitário<br>R${{number_format($Product['product']->price, 2, ',', '.')}}</p>
                <p class="price" style="font-weight: bold; margin-bottom:0;">Subtotal<br>R${{number_format(($Product['quantity'] * $Product['product']->price), 2, ',', '.')}}</p>
                <small class="card-text">Em até {{$Product['product']->installments_limit}}x de R${{number_format((($Product['quantity'] * $Product['product']->price) / $Product['product']->installments_limit), 2, ',', '.')}}</small>
            </div>
        </div>
    </div>
</div>