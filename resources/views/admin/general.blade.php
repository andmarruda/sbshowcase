@extends('template.admin')

@section('page')
<form method="post" action="{{route('general.save')}}" autocomplete="off" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="{{$General->id}}">
    @csrf

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Configurações</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gerais</li>
        </ol>
    </nav>

    <div class="mb-3">
        <label for="brand" class="form-label">Marca</label>
        <input type="text" minlength="5" maxlength="100" class="form-control" id="brand" name="brand" placeholder="Marca" required value="{{$General->brand}}">
    </div>

    <div class="mb-3">
        <h6>Logo atual</h6><hr>
        <img src="{{asset($General->getBrandImage())}}" class="img-thumbnail" id="img-brand-preview" alt="Logomarca atual">
    </div>

    <div class="mb-3">
        <label for="brand_image" class="form-label">Logo</label>
        <input type="file" class="form-control" id="brand_image" name="brand_image" placeholder="Logo">
    </div>

    <div class="mb-3">
        <label for="prefer_email" class="form-label">Email principal</label>
        <input type="email" minlength="10" maxlength="200" class="form-control" id="prefer_email" name="prefer_email" placeholder="Email principal" required value="{{$General->prefer_email ?? ''}}">
    </div>

    <div class="mb-3">
        <label for="slogan" class="form-label">Slogan</label>
        <input type="text" minlength="50" maxlength="200" class="form-control" id="slogan" name="slogan" placeholder="Slogan" required value="{{$General->slogan}}">
    </div>

    <div class="mb-3">
        <label for="section" class="form-label">Categoria do site</label>
        <input type="text" minlength="5" maxlength="100" class="form-control" id="section" name="section" placeholder="Categoria do site" required value="{{$General->section}}">
    </div>

    <div class="mb-3">
        <label for="google_analytics" class="form-label">Google Analytics</label>
        <input type="text" maxlength="255" class="form-control" id="google_analytics" name="google_analytics" placeholder="Google Analytics" value="{{$General->google_analytics}}">
    </div>

    <div class="mb-3">
        <label for="google_optimize_script" class="form-label">Google optimize</label>
        <input type="text" maxlength="255" class="form-control" id="google_optimize_script" name="google_optimize_script" placeholder="Google optimize" value="{{$General->google_optimize_script}}">
    </div>

    <div class="mb-3">
        <h6>Icone de destaque 1 atual</h6><hr>
        <img src="{{asset($General->getHighlightImage1())}}" class="img-thumbnail" id="img-preview-highlight1" alt="Logomarca atual">
    </div>

    <div class="mb-3">
        <label for="highlight_img_1" class="form-label">Icone destaque 1<br><small>"Recomendado 30 pixels x 30 pixels"</small></label>
        <input type="file" class="form-control" id="highlight_img_1" name="highlight_img_1" placeholder="Icone destaque 1">
    </div>

    <div class="mb-3">
        Caso queira utilizar outros icones utilize a biblioteca aberta do <a href="https://www.iconfinder.com/" target="_blank">https://www.iconfinder.com/</a>.<br>
        Não esqueça de filtrar por icones gratuítos. Utilizar png com fundo transparente.
    </div>

    <div class="mb-3">
        <label for="highlight_text_1" class="form-label">Texto destaque 1</label>
        <input type="text" minlength="15" maxlength="50" class="form-control" id="highlight_text_1" name="highlight_text_1" placeholder="Texto destaque 1" required value="{{$General->highlight_text_1}}">
    </div>

    <div class="mb-3">
        <h6>Icone de destaque 2 atual</h6><hr>
        <img src="{{asset($General->getHighlightImage2())}}" class="img-thumbnail" id="img-preview-highlight2" alt="Logomarca atual">
    </div>

    <div class="mb-3">
        <label for="highlight_img_2" class="form-label">Icone destaque 2<br><small>"Recomendado 30 pixels x 30 pixels"</small></label>
        <input type="file" class="form-control" id="highlight_img_2" name="highlight_img_2" placeholder="Icone destaque 2">
    </div>

    <div class="mb-3">
        Caso queira utilizar outros icones utilize a biblioteca aberta do <a href="https://www.iconfinder.com/" target="_blank">https://www.iconfinder.com/</a>.<br>
        Não esqueça de filtrar por icones gratuítos. Utilizar png com fundo transparente.
    </div>

    <div class="mb-3">
        <label for="highlight_text_2" class="form-label">Texto destaque 2</label>
        <input type="text" minlength="15" maxlength="50" class="form-control" id="highlight_text_2" name="highlight_text_2" placeholder="Texto destaque 2" required value="{{$General->highlight_text_2}}">
    </div>

    <div class="mb-3">
        <label for="blog_url" class="form-label">URL Blog</label>
        <input type="text" minlength="15" maxlength="200" class="form-control" id="blog_url" name="blog_url" placeholder="URL Blog" value="{{$General->blog_url}}">
    </div>

    <div class="mb-3">
        <label for="company_name" class="form-label">Razão Social</label>
        <input type="text" minlength="15" maxlength="50" class="form-control" id="company_name" name="company_name" placeholder="Razão social" value="{{$General->company_name}}">
    </div>

    <div class="mb-3">
        <label for="company_doc" class="form-label">CNPJ</label>
        <input type="number" step="1" minlength="15" maxlength="16" class="form-control" id="company_doc" name="company_doc" placeholder="CNPJ" value="{{$General->company_doc}}">
    </div>

    <div class="mb-3">
        <label for="whatsapp_number" class="form-label">Whatsapp</label>
        <input type="text" minlength="14" maxlength="16" class="form-control" id="whatsapp_number" name="whatsapp_number" placeholder="Whatsapp" value="{{$General->whatsapp_number}}">
    </div>

    @include('template.includes.alert-error')

    @if(!is_null(session('saved')))
        @include('template.includes.alert-saved', ['success' => 'Configurações gerais salvas com sucesso!', 'error' => 'Erro ao salvar as configurações gerais!', 'saved' => session('saved')])
    @endif

    <div class="mb-3">
        <button type="submit" class="btn btn-primary"><i class="fa-regular fa-floppy-disk"></i> Salvar</button>
    </div>
</form>

<script>
    let previews = [
        {'input': 'brand_image', 'preview': 'img-brand-preview'},
        {'input': 'highlight_img_1', 'preview': 'img-preview-highlight1'},
        {'input': 'highlight_img_2', 'preview': 'img-preview-highlight2'}
    ];

    document.addEventListener('DOMContentLoaded', () => {
        for(let prev of previews){
            document.getElementById(prev.input).addEventListener('change', (event) => {
                previewImage(event, prev.preview);
            });
        }
    });
</script>
@endsection