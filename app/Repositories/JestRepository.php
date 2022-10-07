<?php

namespace App\Repositories;

use App\Models\Surdo\Jest as Model;
use Illuminate\Support\Collection;

/**
 * Class RecordRepository
 *
 * @package App\Repositories
 */
class JestRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

}