<?php

namespace App\Http\Controllers;

use App\Models\AvailablePaymentFlag;
use Illuminate\Http\Request;

class AvailablePaymentFlagController extends Controller
{
    /**
     * Request validate errors strings
     * @var array
     */
    private array $errors = [
        'description.required' => 'O campo descrição da forma de pagamento é obrigatório',
        'description.max' => 'O campo descrição da forma de pagamento deve ter no máximo 50 caracteres'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.available-payment-flag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filetypes = implode(',', ImageController::ALLOWED_EXTENSION);
        $this->errors['image.required'] = "A imagem é obrigatória.";
        $this->errors['image.mimes'] = "O campo imagem do produto deve ser do tipo: $filetypes";
        $this->errors['image.max'] = 'O campo imagem do produto deve conter no máximo: '. ImageController::byteToMb(). 'mb';

        $request->validate([
            'description' => 'required|max:50',
            'image' => 'required|mimes:'. $filetypes. '|max:'. ImageController::ALLOWED_SIZE
        ], $this->errors);

        $ic = new ImageController($request->file('image'));
        $af = new AvailablePaymentFlag();
        $saved = $af->create([
            'file' => $ic->name,
            'description' => $request->input('description')
        ]);
        return redirect()->route('payment-footer.create')->with('saved', $saved);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AvailablePaymentFlag  $availablePaymentFlag
     * @return \Illuminate\Http\Response
     */
    public function show(AvailablePaymentFlag $availablePaymentFlag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AvailablePaymentFlag  $availablePaymentFlag
     * @return \Illuminate\Http\Response
     */
    public function edit(AvailablePaymentFlag $availablePaymentFlag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AvailablePaymentFlag  $availablePaymentFlag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AvailablePaymentFlag $availablePaymentFlag)
    {
        //
    }
}
