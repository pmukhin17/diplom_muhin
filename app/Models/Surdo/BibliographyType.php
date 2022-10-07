<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

class BibliographyType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'srd_surd_bibliography_type';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_bibliography_type';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['bibliography_type'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;
}
