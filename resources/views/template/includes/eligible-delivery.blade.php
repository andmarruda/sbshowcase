<div class="modal fade" id="eligible_delivery" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cidades elegíveis - Frete Grátis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-floating" style="margin-bottom:2rem;">
                    <input type="text" class="form-control" id="eligible_city_name" placeholder="Cidade" value="">
                    <label for="eligible_city_name">Cidade</label>
                </form>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                @forelse($eligible as $el)
                        <tr>
                            <td>{{$el->city()->first()->city_name}}</td>
                            <td>{{$el->city()->first()->state()->first()->state_name}}</td>
                            <td><b>{{$el->price==0 ? 'Grátis' : 'R$'. number_format($el->price, 2, ',', '.')}}</b></td>
                        </tr>
                @empty
                        <tr>
                            <td colspan="2">Nenhuma cidade elegível</td>
                        </tr>
                @endforelse
                    <tbody>
                </table>
            </div>
        </div>
    </div>
</div>