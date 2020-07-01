<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin\Main;


class CreateMenuRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Main::$rules;
    }
    public function attributes()
    {
      return [
        'main_name'   => 'Menú',
        'section'     => 'Sección',
        'path'        => 'Trayecto',
        'icon'        => 'Icono',
        'note'        => 'Nota',
        'modified_by' => 'Modificado por'

        ];
    }

}
