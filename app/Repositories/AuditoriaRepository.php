<?php

namespace App\Repositories;

use App\Models\Auditoria;
use App\Repositories\BaseRepository;

/**
 * Class IndicadorServicioRepository
 * @package App\Repositories
 * @version September 28, 2019, 4:15 pm UTC
*/

class AuditoriaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'id_role',
        // 'num_conductores',
        // 'num_vehiculos',
        // 'num_conductores_capac',
        // 'num_comparendos',
        // 'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Auditoria::class;
    }
    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }
}
