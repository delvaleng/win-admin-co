<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\General\Rol_Main;

class CreateRolMenuRequest extends FormRequest
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
        return Rol_Main::$rules;
    }

    public function attributes()
  {
    return [
        'id_role'     => 'Rol',
        'id_main'     => 'Menú',
        'note'        => 'Nota',
        'modified_by' => 'Modificado por'

      ];
  }

}
