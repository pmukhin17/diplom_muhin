<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class Workbooks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_workbooks';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_workbook';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    //
    /**
     * @var array
     */
    protected $fillable = ['workbook_name'];
}
