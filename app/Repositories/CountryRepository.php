<?php

namespace App\Repositories;

use App\Models\Admin\Country;
use App\Repositories\BaseRepository;

/**
 * Class CountryRepository
 * @package App\Repositories
 * @version August 20, 2019, 8:27 pm UTC
*/

class CountryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
      'country_name',
      'area_code',
      'code',
      'national_currency',
      'national_symbol',
      'foreign_currency',
      'foreign_symbol',
      'convert_mount',
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
        return Country::class;
    }

    public function with($relations) {
        if (is_string($relations)) $relations = func_get_args();
        $this->with = $relations;
        return $this;
    }
}
