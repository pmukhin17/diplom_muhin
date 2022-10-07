<?php


namespace App\Models\Surdo;


use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    protected $table = 'srd_hns_face';

    protected $primaryKey = 'id_face';

    protected $fillable = ['name_face', 'pic'];

    public $timestamps = false;

}
