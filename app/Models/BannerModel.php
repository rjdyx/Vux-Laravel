<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/9
 * Time: 13:47
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model{

    protected $table='banner';

    protected $primaryKey='bannerId';

    public $timestamps=false;

    protected $fillable = [
        'bannerId', 'areaId', 'name','url','img_url'
    ];

    protected $guarded='';

    protected $hidden=array();

}