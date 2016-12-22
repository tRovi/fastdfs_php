<?php 
namespace App\Services;

use App\Contracts\FastdfsContract;
// use Fastdfs;

class FastdfsService Implements FastdfsContract
{
    private $tracker;
    private $storage;

    function __construct(){
        $this->tracker = fastdfs_tracker_get_connection();
        $this->storage = fastdfs_tracker_query_storage_store();
        $this->connect();
    }

    /**
     * [connect 连接]
     * @return [type] [description]
     */
    private function connect(){
        if (!fastdfs_active_test($this->tracker)){
            $err=json_encode(array('fastdfs_active_test errno'=>fastdfs_get_last_error_no(),'msg'=>fastdfs_get_last_error_info()));
            \Log::info('======FastDFS fastdfs_active_test测试日志======{'.json_encode($err).'}======');
            throw new \Exception($err);
        }
        if (!$this->storage){
            $err=json_encode(array('fastdfs_tracker_query_storage_store errno'=>fastdfs_get_last_error_no(),'msg'=>fastdfs_get_last_error_info()));
            \Log::info('======FastDFS fastdfs_tracker_query_storage_store获取上传文件存储服务器信息======{'.json_encode($err).'}======');
            throw new \Exception($err);
        }
        $server = fastdfs_connect_server($this->storage['ip_addr'], $this->storage['port']);
        if (!$server){
            $err=json_encode(array('fastdfs_connect_server errno'=>fastdfs_get_last_error_no(),'msg'=>fastdfs_get_last_error_info()));
            \Log::info('======FastDFS fastdfs_tracker_query_storage_store连接服务器======{'.json_encode($err).'}======');
            throw new \Exception($err);
        }
        if (!fastdfs_active_test($server)){
            $err=json_encode(array('fastdfs_active_test测试日志server errno'=>fastdfs_get_last_error_no(),'msg'=>fastdfs_get_last_error_info()));
            throw new \Exception($err);
        }
        $this->storage['sock'] = $server['sock'];
    }

    /**
     * [fastdfsClientVersion 获取fastdfs客户端版本]
     * @return [string] [description]
     */
    public function fastdfsClientVersion(){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_client_version()));
        return $res;
    }

    /**
     * [getFileInfo 根据文件名获取文件信息]
     * @param  string $groupName [文件的组名称]
     * @param  string $fileName  [存储服务器上的文件名]
     * @return [array]            []
     */
    public function getFileInfo(string $groupName, string $fileName){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_get_file_info($groupName,$fileName)));
        return $res;
    }

    /**
     * [fileExist 检查文件是否存在]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function fileExist(string $groupName, string $remoteFilename){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_file_exist($groupName,$remoteFilename)));
        return $res;
    }

    /**
     * [uploadFile 上传文件至存储服务器]
     * @param  string $localFilename      [本地文件名称]
     * @param  string $fileExtName      [文件扩展名，不包含.]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @param  string $groupName      [文件的组名称]
     * @return [bool]                 [file_id for success, false for error]
     */
    public function uploadFile(string $localFilename,string $fileExtName=null,array $metaList=[],string $groupName=null){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_upload_by_filename($localFilename, $fileExtName, $metaList, $groupName, $this->tracker, $this->storage)));
        return $res;
    }

    /**
     * [deleteFile 从存储服务器上删除文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function deleteFile(string $groupName, string $remoteFilename){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_delete_file($groupName, $remoteFilename)));
        return $res;
    }

    /**
     * [setMetadata 设置元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @return [bool]                 [true or false]
     */
    public function setMetadata(string $groupName, string $remoteFilename,array $metaList){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_set_metadata($groupName,$remoteFilename,$metaList,FDFS_STORAGE_SET_METADATA_FLAG_OVERWRITE)));
        return $res;
    }

    /**
     * [getMetadata 获取元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function getMetadata(string $groupName, string $remoteFilename){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_get_metadata($groupName,$remoteFilename)));
        return $res;
    }

    /**
     * [downloadFile 从存储服务器上下载文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [返回文件流true or false]
     */
    public function downloadFile(string $groupName, string $remoteFilename){
        $res=json_encode(array('errcode'=>'0','msg'=>'ok','data'=>fastdfs_storage_download_file_to_buff($groupName,$remoteFilename)));
        return $res;
    }
}