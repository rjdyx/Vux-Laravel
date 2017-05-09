<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/8
 * Time: 15:08
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\GoodsClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ErrorMessageTrait;

/**
 * 普通商品控制器（注意：后面必须补充管理员验证）
 * Class Goods
 * @package App\Http\Controllers\Admin
 */
class Goods extends Controller{

    use ErrorMessageTrait;

    /**
     * 添加普通商品分类
     * @param Request $request
     * areaId 区域ID name 名称 description 描述
     */
    public function addGoodsClass(Request $request){
        $validator=Validator::make($request->all(),[
            'areaId'=>'required|int',
            'name'=>'required|string',
            'description'=>'required|string'
        ]);
        //验证失败
        if($validator->fails()){
            return response()->json(
                array('status'=>0,'errmsg'=>array('code'=>201,'content'=>$validator->errors()->first()))
            );
        }
        //验证成功
        else{
            GoodsClassModel::create($request->all()); //新增
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }
    }

    /**
     * 获取某个区域全部普通商品分类
     * @param Request $request
     * areaId 区域ID（可选），不传时代表获取全部区域的普通商品分类 num每页的数量
     */
    public function getGoodsClassList(Request $request){
        $num=$request->num;
        if($request->areaId){
            $classes=GoodsClassModel::where('areaId',$request->areaId);
            if($classes->first()==null){
                $this->errorMessage(202);
            }else{
                $data=$classes->paginate($num);
                return response()->json(
                    array('status'=>1,"errmsg"=>"OK!",'result'=>$data)
                );
            }
        }else{
            $classes=GoodsClassModel::where([]);
            if($classes->first()==null){
                $this->errorMessage(202);
            }else{
                $data=$classes->paginate($num);
                return response()->json(
                    array('status'=>1,"errmsg"=>"OK!",'result'=>$data)
                );
            }
        }
    }

    /**
     * 修改普通商品分类
     * @param Request $request
     */
    public function editGoodsClass(Request $request){
        $validator=Validator::make($request->all(),[
            'classId'=>'required|int',
            'areaId'=>'required|int',
            'name'=>'required|string',
            'description'=>'required|string'
        ]);
        //验证失败
        if($validator->fails()){
            return response()->json(
                array('status'=>0,'errmsg'=>array('code'=>201,'content'=>$validator->errors()->first()))
            );
        }
        //验证成功
        else{
            GoodsClassModel::find($request->classId)->update($request->except('classId')); //更新
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }
    }

    /**
     * 删除普通商品分类
     * @param Request $request
     */
    public function deleteGoodsClass(Request $request){
        $classId=$request->classId;
        $class=GoodsClassModel::where('classId',$classId)->first();
        if($classId && $class!=null){
            GoodsClassModel::find($classId)->delete();
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }else{
            $this->errorMessage(203);
        }
    }

    /**
     * 获取某个分类下的普通商品
     * @param Request $request
     */
    public function getClassGoods(Request $request){

    }
}