<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class TasksBlocks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_tasks_blocks';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_task_block';

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
    protected $fillable = ['block_name'];
}
