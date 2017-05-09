<?php
/**
 * Created by PhpStorm.
 * User: Tan
 * Date: 2017/5/9
 * Time: 18:54
 */
namespace App;

trait ErrorMessageTrait{
    /**
     * JSON格式的错误信息（包括错误码和错误内容）
     * @param $code
     */
    public function errorMessage($code){
        switch ($code){
            case 202: $content='没有分类';break;
            case 203: $content='classId错误';break;
            case 204: $content='没有区域';break;
            case 205: $content='areaId错误';break;
        }
        echo json_encode(array('status'=>0,'errmsg'=>array('code'=>$code,'content'=>$content)));
        exit(0);
    }
}