<?php


namespace App\Models\Surdo;


use Illuminate\Database\Eloquent\Model;

class Orientation_hand extends Model
{
    protected $table = 'srd_hns_orientation_hand';

    protected $primaryKey = 'id_orientation';

    protected $fillable = ['name_orientation', 'pic'];

    public $timestamps = false;

}
