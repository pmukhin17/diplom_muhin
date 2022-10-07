<?php


namespace App\Models\Surdo;


use Illuminate\Database\Eloquent\Model;

class Orientation_body extends Model
{
    protected $table = 'srd_hns_orientation_body';

    protected $primaryKey = 'id_orientation';

    protected $fillable = ['name_orientation', 'pic'];

    public $timestamps = false;

}
