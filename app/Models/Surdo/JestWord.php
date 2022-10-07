<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

class JestWord extends Model
{
    protected $table = 'srd_surd_cross_words';

    protected $primaryKey = 'id_word';

    protected $fillable = ['id_word', 'id_jest'];

    public $timestamps = false;

    public function jest()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest', 'id_jest');
    }

    public function word()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_word', 'id_jest');
    }
}
