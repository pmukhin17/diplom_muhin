<?php


namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;

class FuzzySearch extends Model
{
    protected $table = 'srd_surd_configuration_comparison';

    protected $primaryKey = 'id';

    protected $fillable = ['id_conf_parent', 'id_conf_child','result'];

    public $timestamps = false;

    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('id_conf_parent', 'like', "$value");
    }

}
