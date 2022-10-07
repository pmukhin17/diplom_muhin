<?php


namespace App\Models\Surdo;

use Illuminate\Database\Eloquent\Model;



class JestConcept extends Model
{
    protected $table = 'tez_cross_jest_to_concept';

    protected $primaryKey = 'id_jest';

    protected $fillable = ['id_jest', 'synset_id'];

    public $timestamps = false;

    public function scopeSearch($query, $value)
    {
        return ($value === null) ? $query : $query->where('id_jest', 'like', "$value");
    }


}
