<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class Textbooks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_textbooks';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_textbook';

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
    protected $fillable = ['textbook_name'];
}
