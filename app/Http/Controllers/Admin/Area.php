<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/9
 * Time: 16:01
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AreaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ErrorMessageTrait;

/**
 * 区域控制器
 * Class Area
 * @package App\Http\Controllers\Admin
 */
class Area extends Controller{

    use ErrorMessageTrait;

    /**
     * 添加区域
     * @param Request $request
     */
    public function addArea(Request $request){
        $validator=Validator::make($request->all(),[
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
            AreaModel::create($request->all());
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }
    }

    /**
     * 获取全部区域
     * @param Request $request
     */
    public function getAreaList(Request $request){
        $num=$request->num;
        $area=AreaModel::where([]);
        if($area->first()==null){
            $this->errorMessage(204);
        }else{
            $data=$area->paginate($num);
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!",'result'=>$data)
            );
        }
    }

    /**
     * 修改区域
     * @param Request $request
     */
    public function editArea(Request $request){
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
            AreaModel::where('areaId',$request->areaId)->update($request->except('areaId'));
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }
    }

    /**
     * 删除区域
     * @param Request $request
     */
    public function deleteArea(Request $request){
        $areaId=$request->areaId;
        $area=AreaModel::where('areaId',$areaId)->first();
        if($areaId && $area!=null){
            AreaModel::find($areaId)->delete();
            return response()->json(
                array('status'=>1,"errmsg"=>"OK!")
            );
        }else{
            $this->errorMessage(205);
        }
    }
}