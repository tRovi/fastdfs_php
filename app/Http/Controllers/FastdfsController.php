<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\FastdfsContract;

class FastdfsController extends Controller
{
    //依赖注入
    public function __construct(FilesContract $files){
        $this->fastdfs = $fastdfs;
    }


    /**
     * [fastdfsClientVersion 获取fastdfs客户端版本]
     * @return [string] [description]
     */
    public function fastdfsClientVersion(Request $request){
        try{
            $result = $this->fastdfs->fastdfsClientVersion();
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS fastdfsClientVersion接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [getFileInfo 根据文件名获取文件信息]
     * @param  string $groupName [文件的组名称]
     * @param  string $fileName  [存储服务器上的文件名]
     * @return [array]            []
     */
    public function getFileInfo(Request $request){
        try{
            $result = $this->fastdfs->getFileInfo($request->input('groupName'),$request->input('fileName'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS getFileInfo接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [fileExist 检查文件是否存在]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function fileExist(Request $request){
        try{
            $result = $this->fastdfs->fileExist($request->input('groupName'),$request->input('remoteFilename'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS fileExist接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [uploadFile 上传文件至存储服务器]
     * @param  string $localFilename      [本地文件名称]
     * @param  string $fileExtName      [文件扩展名，不包含.]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @param  string $groupName      [文件的组名称]
     * @return [bool]                 [file_id for success, false for error]
     */
    public function uploadFile(Request $request){
        try{
            $result = $this->fastdfs->uploadFile($request->input('localFilename'),$request->input('fileExtName',null),$request->input('metaList',),$request->input('groupName'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS uploadFile接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [deleteFile 从存储服务器上删除文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function deleteFile(Request $request){
        try{
            $result = $this->fastdfs->deleteFile($request->input('groupName'),$request->input('remoteFilename'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS deleteFile接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [setMetadata 设置元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @return [bool]                 [true or false]
     */
    public function setMetadata(Request $request){
        try{
            $result = $this->fastdfs->setMetadata($request->input('groupName'),$request->input('remoteFilename'),$request->input('metaList'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS setMetadata接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [getMetadata 获取元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function getMetadata(Request $request){
        try{
            $result = $this->fastdfs->getMetadata($request->input('groupName'),$request->input('remoteFilename'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS getMetadata接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }

    /**
     * [downloadFile 从存储服务器上下载文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @param  string $localFilename      [本地文件名称]
     * @return [bool]                 [返回文件流true or false]
     */
    public function downloadFile(Request $request){
        try{
            $result = $this->fastdfs->downloadFile($request->input('groupName'),$request->input('remoteFilename'));
            $res=json_decode($result,true);
            return response()->json($res);
        }catch (\Exception $exception) {
            $err=json_decode($exception->getMessage(),true);
            \Log::info('======FastDFS downloadFile接口======{'.json_encode($request->all()).'}======错误信息：'.json_encode($err));
            return response()->json($err);
        }
    }
}
