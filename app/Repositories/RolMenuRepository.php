<?php

namespace App\Repositories;

use App\Models\General\Rol_Main;
use App\Repositories\BaseRepository;

/**
 * Class RolMenuRepository
 * @package App\Repositories
 * @version December 2, 2019, 3:42 pm UTC
*/

class RolMenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id_role',
        'id_main',
        'note',
        'status_system',
        'status_user',
        'modified_by'
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
        return Rol_Main::class;
    }
    public function with($relations) {
       if (is_string($relations)) $relations = func_get_args();

       $this->with = $relations;

       return $this;
   }

}
