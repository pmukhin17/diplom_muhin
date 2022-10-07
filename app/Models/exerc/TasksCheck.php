<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class TasksCheck extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_tasks_check';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_task_check';

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
    protected $fillable = ['task_text'];
}
