<?php

namespace App\Http\Controllers;


use Qiniu\auth as Qauth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;


define("Access_Key","pcZBUCqUSIulhuic_FVja8S3Jd2NigELvZipVLUm");    //七牛的AccKey
define("Secret_Key","MDebou0IRUt3hfT5xL6nbdF56h1KnOzqWX8VRnIK");    //七牛的SecKey

class Qiniu extends Controller
{

    /**
     * 上传文件
     * @param $prefix 七牛空间链接前缀
     * @param $temp 文件临时路径
     * @param $filename 文件名
     * @param $bucket 七牛空间名
     * @return mixed 返回信息
     */
    public static function Create($prefix,$temp,$filename,$bucket)
    {
        if(!$temp) {$result["status"]=0; $result["errmsg"]["code"]=100;$result["errmsg"]["content"]="File is empty!";}
        else{
            $auth=new Qauth(Access_Key,Secret_Key);
            $uptoken=$auth->uploadToken($bucket,null,3600);                //获取上传凭证
            $uploadMgr=new UploadManager();                                //创建上传管理类
            list($res,$error)=$uploadMgr->putFile($uptoken,$filename,$temp);
            if($error!==null) {$result["status"]=0; $result["errmsg"]["code"]=101;$result["errmsg"]["content"]="Upload Fail!";}
            else{
                $url=$prefix."/".$res['key'];
                $result["status"]=1;
                $result["errmsg"]="OK!";
                $result["url"]=$url;
            }
        }
        return $result;
    }

    /**
     * 更新文件
     * @param $prefix 七牛空间链接前缀
     * @param $old_url 要删除旧的文件的url
     * @param $temp 要上传新的文件的临时路径
     * @param $bucket 七牛空间名
     * @param $filename 新文件名
     * @return mixed 返回信息
     */
    public static function Update($prefix,$old_url,$temp,$bucket,$filename)
    {
        if(!$temp) {$result["status"]=0; $result["errmsg"]["code"]=100;$result["errmsg"]["content"]="File is empty!";}
        else{
            $auth=new Qauth(Access_Key,Secret_Key);
            $bucketMgr=new BucketManager($auth);                      //获取空间管理权力
            $del_key=substr(strrchr($old_url,'/'),1);            //获取url中的key值
            $del_res=$bucketMgr->delete($bucket,$del_key);   //根据key值删除资源
            if($del_res!==null) {$result["status"]=0;$result["errmsg"]["code"]=103;$result["errmsg"]["delete"]="Delete Fail!";}

            $uptoken=$auth->uploadToken($bucket,null,3600);  //获取上传凭证
            $uploadMgr = new UploadManager();                         //创建上传管理类
            list($res,$error)=$uploadMgr->putFile($uptoken,$filename,$temp);

            if($error!==null) {$result["status"]=0; $result["errmsg"]["code"]=103;$result["errmsg"]["upload"]="Upload Fail!";}
            else{
                $url=$prefix."/".$res['key'];
                $result["status"]=1;
                $result["errmsg"]="OK!";
                $result["url"]=$url;
            }
        }
        return $result;
    }

    /**
     * 删除文件
     * @param $url  要删除的文件url地址
     * @param $bucket 要删除的文件所在的bucket
     * @return mixed  返回信息
     */
    public static function Delete($url,$bucket)
    {
        $auth=new Qauth(Access_Key,Secret_Key);
        $bucketMgr=new BucketManager($auth);                     //获取空间管理权力
        $del_key=substr(strrchr($url,'/'),1);                    //获取url中的key值
        $del_res=$bucketMgr->delete($bucket,$del_key);           //根据key值删除资源
        if($del_res!==null) {$result["status"]=0;$result["errmsg"]["code"]=102;$result["errmsg"]["content"]="Delete Fail!";}
        else {$result["status"]=1;$result["errmsg"]="OK!";}
        return $result;
    }

}
