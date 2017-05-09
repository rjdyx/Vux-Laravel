<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/8
 * Time: 15:16
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 普通商品分类模型
 * Class GoodsClass
 * @package App\Models
 */
class GoodsClassModel extends Model{

    protected $table='goods_class';

    protected $primaryKey='classId';

    public $timestamps=false;

    protected $fillable = [
        'classId', 'areaId', 'name','description'
    ];

    protected $guarded='';

    protected $hidden=array();
    
}