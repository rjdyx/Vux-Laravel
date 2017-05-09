<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/9
 * Time: 16:01
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model{

    protected $table='area';

    protected $primaryKey='areaId';

    public $timestamps=false;

    protected $fillable = [
        'areaId','name','description'
    ];

    protected $guarded='';

    protected $hidden=array();

}