<?php

namespace App\Repositories;

use App\Models\Admin\Main;
use App\Repositories\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories
 * @version December 2, 2019, 3:34 pm UTC
*/

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      'main_name',
  	  'section',
  	  'path',
  	  'icon',
  	  'orden',
  	  'status',
  	  'user_id',
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
        return Main::class;
    }


}
