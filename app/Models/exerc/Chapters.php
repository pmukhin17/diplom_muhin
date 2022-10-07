<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class Chapters extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_chapters';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_chapter';

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
    protected $fillable = ['chapter_name'];
}
