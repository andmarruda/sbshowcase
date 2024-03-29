<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Request;
use App\Models\General;

use function PHPSTORM_META\map;

class GeneralController extends Controller
{
    /**
     * Require validate's messages
     * @var array
     */
    private array $requestMessages = [
        'brand.required'                => 'O campo marca é obrigatório',
        'brand.min'                     => 'O campo marca deve ter no mínimo 5 caracteres',
        'brand.max'                     => 'O campo marca deve ter no máximo 100 caracteres',
        'slogan.required'               => 'O campo slogan é obrigatório',
        'slogan.min'                    => 'O campo slogan deve ter no mínimo 50 caracteres',
        'slogan.max'                    => 'O campo slogan deve ter no máximo 200 caracteres',
        'section.required'              => 'O campo categoria do site é obrigatório',
        'section.min'                   => 'O campo categoria do site deve ter no mínimo 15 caracteres',
        'section.max'                   => 'O campo categoria do site deve ter no máximo 100 caracteres',
        'highlight_text_1.required'     => 'O campo texto destacado 1 é obrigatório',
        'highlight_text_1.min'          => 'O campo texto destacado 1 deve ter no mínimo 15 caracteres',
        'highlight_text_1.max'          => 'O campo texto destacado 1 deve ter no máximo 50 caracteres',
        'highlight_text_2.required'     => 'O campo texto destacado 1 é obrigatório',
        'highlight_text_2.min'          => 'O campo texto destacado 1 deve ter no mínimo 15 caracteres',
        'highlight_text_2.max'          => 'O campo texto destacado 1 deve ter no máximo 50 caracteres',
        'brand_image'                   => 'O campo imagem da marca é obrigatório', 
        'highlight_img_1'               => 'O campo imagem da marca é obrigatório', 
        'highlight_img_2'               => 'O campo imagem da marca é obrigatório',
        'prefer_email.required'         => 'O campo email principal é obrigatório',
        'prefer_email.min'              => 'O campo email principal deve conter no mínimo 10 caracteres',
        'prefer_email.max'              => 'O campo email principal deve conter no máximo 200 caracteres'
    ];

    /**
     * Returns the view of general form inside the admin
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function adminView() : \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return view('admin.general', ['General' => General::find(1)]);
    }

    /**
     * Convert uploaded file to webp
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           \Illuminate\Http\UploadedFile $file
     * @param           ?string $oldImage=NULL
     * @return          string
     */
    public function convertToWebp(\Illuminate\Http\UploadedFile $file, ?string $oldImage=NULL) : string
    {
        $ic = new ImageController($file, $oldImage);
        if(!is_null($oldImage))
            $ic->deleteOldFile();

        return $ic->name;
    }

    /**
     * Saves the change into general
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           Request $r
     * @return          \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function saveGeneral(Request $r) : \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $filetypes = implode(',', ImageController::ALLOWED_EXTENSION);
        $this->requestMessages['brand_image.mimes'] = "O campo imagem da marca deve ser do tipo: $filetypes";
        $this->requestMessages['highlight_img_1.mimes'] = "O campo imagem de destaque 1 deve ser do tipo: $filetypes";
        $this->requestMessages['highlight_img_2.mimes'] = "O campo imagem de destaque 2 deve ser do tipo: $filetypes";
        $this->requestMessages['brand_image.max'] = 'O campo imagem da marca deve conter no máximo: '. ImageController::byteToMb(). 'mb';
        $this->requestMessages['highlight_img_1.max'] = 'O campo imagem de destaque 1 deve conter no máximo: '. ImageController::byteToMb(). 'mb';
        $this->requestMessages['highlight_img_1.max'] = 'O campo imagem de destaque 2 deve conter no máximo: '. ImageController::byteToMb(). 'mb';

        $r->validate([
            'brand'             => 'required|min:5|max:100',
            'slogan'            => 'required|min:50|max:200',
            'section'           => 'required|min:5|max:100',
            'highlight_text_1'  => 'required|min:15|max:50',
            'highlight_text_2'  => 'required|min:15|max:50',
            'brand_image'       => 'nullable|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE,
            'highlight_img_1'   => 'nullable|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE,
            'highlight_img_2'   => 'nullable|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE,
            'prefer_email'      => 'required|min:15|max:200'
        ], $this->requestMessages);

        $general = General::find(1);
        $brand_filepath = $general->brand_image;
        $high1_filepath = $general->highlight_img_1;
        $high2_filepath = $general->highlight_img_2;

        if($r->hasFile('brand_image') && $r->file('brand_image')->isValid())
            $brand_filepath = $this->convertToWebp($r->file('brand_image'), public_path($general->getBrandImage()));

        if($r->hasFile('highlight_img_1') && $r->file('highlight_img_1')->isValid())
            $high1_filepath = $this->convertToWebp($r->file('highlight_img_1'), public_path($general->getHighlightImage1()));

        if($r->hasFile('highlight_img_2') && $r->file('highlight_img_2')->isValid())
            $high2_filepath = $this->convertToWebp($r->file('highlight_img_2'), public_path($general->getHighlightImage2()));

        $general->fill([
            'brand'                     => $r->input('brand'),
            'brand_image'               => $brand_filepath, 
            'slogan'                    => $r->input('slogan'),
            'section'                   => $r->input('section'), 
            'google_analytics'          => $r->input('google_analytics'), 
            'google_optimize_script'    => $r->input('google_optimize_script'), 
            'highlight_img_1'           => $high1_filepath, 
            'highlight_text_1'          => $r->input('highlight_text_1'), 
            'highlight_img_2'           => $high2_filepath, 
            'highlight_text_2'          => $r->input('highlight_text_2'), 
            'company_name'              => $r->input('company_name'), 
            'company_doc'               => $r->input('company_doc'), 
            'blog_url'                  => $r->input('blog_url'),
            'whatsapp_number'           => $r->input('whatsapp_number'),
            'prefer_email'              => $r->input('prefer_email')
        ]);
        $saved = $general->save();
        return redirect()->route('general')->with('saved', $saved);
    }
}
