<?php

namespace App\Repositories;

use App\Models\General\Departament;
use App\Repositories\BaseRepository;

/**
 * Class DepartamentRepository
 * @package App\Repositories
 * @version August 20, 2019, 8:30 pm UTC
*/

class DepartamentRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'departament',
        'id_country',
        'status'
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
        return Departament::class;
    }

    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();

        $this->with = $relations;

        return $this;
    }

}
