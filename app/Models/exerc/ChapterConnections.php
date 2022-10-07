<?php

namespace App\Models\exerc;

use Illuminate\Database\Eloquent\Model;

class ChapterConnections extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exerc_chapters_connections';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_chapter_connection';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';
}
