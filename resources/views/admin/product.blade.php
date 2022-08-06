@extends('template.admin')

@section('page')
<form method="post" id="productForm" action="{{route('product.save')}}" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="{{(!is_null($Product) && (is_null($Copy) || $Copy != 1)) ? $Product->id : ''}}">
    <input type="hidden" id="descriptionText" name="descriptionText" value="{{$Product->description ?? ''}}">
    <input type="hidden" name="image_old" id="image_old" value="{{$Product->image ?? ''}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Produto</a></li>
            <li class="breadcrumb-item active" aria-current="page">Produto</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col">
            <h6>Imagem atual</h6><hr>
            <img src="{{!is_null($Product) ? asset('storage/'.$Product->image) : ''}}" id="img-preview" class="img-thumbnail" alt="Imagem do produto">
        </div>

        <div class="col">
            <label for="image" class="form-label">Imagem do produto</label>
            <input type="file" class="form-control" id="image" name="image" placeholder="Imagem do produto">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="name" class="form-label">Nome do produto</label>
            <input type="text" minlength="6" maxlength="150" class="form-control" id="name" name="name" placeholder="Nome do produto" required value="{{$Product->name ?? ''}}">
        </div>

        <div class="col">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Selecione uma categoria</option>
                @isset($infos['Categories'])
                    @foreach($infos['Categories'] as $Category)
                    <option value="{{$Category->id}}"{{!is_null($Product) && $Product->category_id == $Category->id ? ' selected' : ''}}>{{$Category->name}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="promotion_flag" class="form-label">Mostrar produto em promoção?</label>
            <select class="form-control" id="promotion_flag" name="promotion_flag" required>
                <option value="">Selecione...</option>
                @foreach($promoFlag as $val => $label)
                <option value="{{$val}}"{{!is_null($Product) && $Product->promotion_flag==$val ? ' selected="selected"' : ''}}>{{$label}}</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label for="measure_id" class="form-label">Medidas</label>
            <select class="form-control" id="measure_id" name="measure_id" required>
                <option value="">Selecione...</option>
                @isset($infos['Measures'])
                    @foreach($infos['Measures'] as $Measure)
                    <option value="{{$Measure->id}}"{{!is_null($Product) && $Product->measure_id == $Measure->id ? ' selected' : ''}}>{{$Measure->width.'x'.$Measure->length. 'x'. $Measure->height}}</option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="col">
            <label for="color_id" class="form-label">Cor</label>
            <select class="form-control" id="color_id" name="color_id" required>
                <option value="">Selecione...</option>
                @isset($infos['Colors'])
                    @foreach($infos['Colors'] as $Color)
                    <option value="{{$Color->id}}"{{!is_null($Product) && $Product->color_id == $Color->id ? ' selected' : ''}}>{{$Color->name}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="brand_id" class="form-label">Marca</label>
            <select class="form-control" id="brand_id" name="brand_id" required>
                <option value="">Selecione...</option>
                @isset($infos['Brands'])
                    @foreach($infos['Brands'] as $Brand)
                    <option value="{{$Brand->id}}"{{!is_null($Product) && $Product->brand_id == $Brand->id ? ' selected' : ''}}>{{$Brand->name}}</option>
                    @endforeach
                @endisset
            </select>
        </div>

        <div class="col">
            <label for="type_id" class="form-label">Tipo de produto</label>
            <select class="form-control" id="type_id" name="type_id" required>
                <option value="">Selecione...</option>
                @isset($infos['Types'])
                    @foreach($infos['Types'] as $Type)
                    <option value="{{$Type->id}}"{{!is_null($Product) && $Product->type_id == $Type->id ? ' selected' : ''}}>{{$Type->name}}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="old_price" class="form-label">Preço antigo</label>
            <input type="number" step="0.01" min="0" max="9999999" class="form-control" id="old_price" name="old_price" placeholder="Preço antigo" onblur="javascript: calculatesPercentage();" required value="{{$Product->old_price ?? ''}}">
        </div>

        <div class="col">
            <label for="percentage_discount" class="form-label">Percentual de desconto</label>
            <input type="number" step="0.01" min="0" max="9999999" class="form-control" id="percentage_discount" name="percentage_discount" placeholder="Percentual de desconto" onblur="javascript: calculatesPrice();" required value="{{$Product->percentage_discount ?? ''}}">
        </div>

        <div class="col">
            <label for="price" class="form-label">Preço</label>
            <input type="number" step="0.01" min="0" max="9999999" class="form-control" id="price" name="price" placeholder="Preço" required value="{{$Product->price ?? ''}}">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="installments_limit" class="form-label">Limite de parcelas</label>
            <input type="number" step="1" min="1" max="12" class="form-control" id="installments_limit" name="installments_limit" placeholder="Limite de parcelas" required value="{{$Product->installments_limit ?? ''}}">
        </div>

        <div class="col">
            <label for="quantity" class="form-label">Quantidade disponível para venda</label>
            <input type="number" step="1" min="0" max="9999999" class="form-control" id="quantity" name="quantity" placeholder="Quantidade disponível para venda" required value="{{$Product->quantity ?? ''}}">
        </div>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descrição do produto</label>
        <div id="description" style="min-height:200px;"></div>
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Produto salvo com sucesso!', 'error' => 'Erro ao salvar produto!', 'saved' => session('saved')])
    @endif

    <div class="mb-3" style="margin-top:1rem;">
        @if(is_null($Product) || is_null($Product->deleted_at))
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
        @endif

        <a href="{{route('product.search')}}" role="button" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i> Pesquisar</a>
    </div>
</form>

<script>
    var quillArticle;

    document.addEventListener('DOMContentLoaded', () => {
        quillArticle = new Quill('#description', {
            modules: {
                'syntax': true,
                'toolbar': [
                [ 'bold', 'italic', 'underline', 'strike' ],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'super' }, { 'script': 'sub' }],
                [{ 'header': '1' }, { 'header': '2' }, 'blockquote', 'code-block' ],
                [{ 'list': 'ordered' }, { 'list': 'bullet'}, { 'indent': '-1' }, { 'indent': '+1' }],
                [ {'direction': 'rtl'}, { 'align': [] }],
                [ 'link', 'image', 'video', 'formula' ],
                [ 'clean' ]
                ],
            },
            theme: 'snow'
        });

        textToArticle();

        document.getElementById('image').addEventListener('change', (event) => {
            previewImage(event, 'img-preview');
        });
    });

    const calculatesPercentage = () => {
        let price = document.getElementById('price').value,
            old_price = document.getElementById('old_price').value,
            percentage = document.getElementById('percentage_discount');

        if(price=='' || old_price==''){
            percentage.value = '';
            return;
        }

        percentage.value = (Number(price) / Number(old_price) * 100).toFixed(2);
    };

    const calculatesPrice = () => {
        let price = document.getElementById('price'),
            old_price = document.getElementById('old_price').value,
            percentage = document.getElementById('percentage_discount').value;

        if(percentage=='' || old_price==''){
            price.value = '';
            return;
        }

        price.value = Number(old_price) - (Number(old_price) * Number(percentage) / 100).toFixed(2);
    };

    const textToArticle = () => {
        let at = document.getElementById('descriptionText');
        if(at.value.length > 0){
            let d = quillArticle.clipboard.convert(at.value);
            quillArticle.setContents(d, 'silent');
        }
    };

    const descriptionToText = () => {
        document.getElementById('descriptionText').value = quillArticle.root.innerHTML;
    };

    document.getElementById('productForm').addEventListener('submit', (event) => {
        descriptionToText();
    });
</script>
@endsection