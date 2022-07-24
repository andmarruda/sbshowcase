<div class="modal" id="disableModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$modalTitle}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{$message}}</p>
                <form class="row g-3" id="formDisableReg" action="javascript: jsDisableModal('{{$route}}');" autocomplete="off">
                    <input type="hidden" id="id" name="id" value="{{$id ?? ''}}">
                    @csrf
                    <div class="col-auto">
                        <button type="submit" class="btn btn-danger mb-3">Desativar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>