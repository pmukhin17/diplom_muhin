<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class BookPairs extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_pairs';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_pair';

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
    protected $fillable = ['id_workbook', 'id_textbook'];
}
