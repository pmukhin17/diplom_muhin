<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

class Analog extends Model
{
    protected $table = 'srd_surd_cross_analogs';

    protected $primaryKey = 'id_jest';

    protected $fillable = ['id_jest', 'id_jest_analog'];

    public $timestamps = false;

    public function jest()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest', 'id_jest');
    }

    public function analog()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest_analog', 'id_jest');
    }
}
