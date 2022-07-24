<div class="modal" id="searchModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$modalTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="formModalSearch" action="javascript: jsSearchModal('{{$route}}');" autocomplete="off">
                    @csrf
                    <div class="col-auto">
                        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="{{$placeholder}}" required="">
                    </div>
                    <div class="col-auto">
                        <select class="form-control" id="searchType" name="searchType">
                            <option value="">Todos</option>
                            <option value="1">Somente ativos</option>
                            <option value="0">Somente desativados</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Pesquisar</button>
                    </div>
                </form>

                <div class="alert alert-info">Clique 2x no registro desejado para carregá-lo.</div>

                <table class="table table-bordered table-striped" id="gridSearch" ondblclick="javascript: loadDataForm(event, '{{$loadRoute}}');">
                    <thead>
                        <tr>
                            @foreach($ths as $th)
                            <th>{{$th}}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>