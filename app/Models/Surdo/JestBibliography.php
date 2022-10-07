<?php

namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

class JestBibliography extends Model
{
    protected $table = 'srd_surd_cross_bibliography';

    protected $primaryKey = 'id_jest';

    protected $fillable = ['id_jest', 'id_bibliography'];

    public $timestamps = false;

    public function jest()
    {
        return $this->belongsTo('App\Models\Surdo\Jest', 'id_jest', 'id_jest');
    }

    public function bibliography()
    {
        return $this->belongsTo('App\Models\Surdo\Bibliography', 'id_bibliography', 'id_bibliography');
    }
    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('id_jest', 'like', "$value");
    }
}
