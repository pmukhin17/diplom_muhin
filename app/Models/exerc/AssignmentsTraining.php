<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class AssignmentsTraining extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_assignments_training';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_assignment_training';

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
    protected $fillable = ['assignment_text'];

    /**
     * Отключает timestamp для Eloquent моделей
     *
     * @var bool
     */
    public $timestamps = false;
}
