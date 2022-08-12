<div class="modal fade" id="eligible_delivery" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cidades elegíveis - Frete Grátis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                            <td>{{$el->city_id}}</td>
                            <td></td>
                            <td></td>
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