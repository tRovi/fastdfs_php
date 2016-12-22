<?php 
namespace App\Services;

use App\Contracts\FilesContract;

class FilesService Implements FilesContract
{
    /**
     * 单图上传
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadfiles($jsonen,$urlRoot){
        $file=$jsonen;
        if($file -> isValid()){
        	$dateymd=date('Ymd');
            $time=time();
            $rand=rand(1000,9999);
            $uploadpath='uploads/file/'.$dateymd.'/';
            if(!file_exists($uploadpath)){
                mkdir($uploadpath);
                chmod($uploadpath,0777);
            }
            $clientName = $file -> getClientOriginalName();
            $extension = $file -> getClientOriginalExtension();
            $newName = $time.$rand.'.'.$extension;
            $path=$uploadpath.$newName;
            try{
                $file->move($uploadpath,$newName);
            }catch (\Exception $exception) {
                $err=json_encode(array('errcode'=>'100','msg'=>'系统内部错误'));
                throw new \Exception($err);
            }
            $data['file']=array();
            $subdata['name']=$clientName;
            // $subdata['size']=$mimeTye;
            $subdata['url']=$urlRoot.'/'.$path;
            $data['file'][]=$subdata;
            $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>$data));
            return $res;
        }
    }
    
    /**
     * [multiuploadfiles 多图上传]
     * @param  [type] $jsonen [description]
     * @return [type]         [description]
     */
    public function multiuploadfiles($jsonen,$urlRoot){
        $data['file']=array();
        $files=$jsonen;
        foreach($files as $file) {
            if($file -> isValid()){
                $dateymd=date('Ymd');
                $time=time();
                $rand=rand(1000,9999);
                $uploadpath='uploads/file/'.$dateymd.'/';
                if(!file_exists($uploadpath)){
                    mkdir($uploadpath);
                    chmod($uploadpath,0777);
                }
                $clientName = $file -> getClientOriginalName();
                $extension = $file -> getClientOriginalExtension();
                $newName = $time.$rand.'.'.$extension;
                $path=$uploadpath.$newName;
                try{
                    $file->move($uploadpath,$newName);
                }catch (\Exception $exception) {
                    $err=json_encode(array('errcode'=>'100','msg'=>'系统内部错误'));
                    throw new \Exception($err);
                }
                $subdata['name']=$clientName;
                $subdata['url']=$urlRoot.'/'.$path;
                array_push($data['file'],$subdata);
            }
        }
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>$data));
        return $res;
    }
}