## About Laravel

provide fastdfs file access interface by PHP

```
/**
     * [fastdfsClientVersion 获取fastdfs客户端版本]
     * @return [string] [description]
     */
    public function fastdfsClientVersion();

    /**
     * [getFileInfo 根据文件名获取文件信息]
     * @param  string $groupName [文件的组名称]
     * @param  string $fileName  [存储服务器上的文件名]
     * @return [array]            []
     */
    public function getFileInfo(string $groupName, string $fileName);

    /**
     * [fileExist 检查文件是否存在]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function fileExist(string $groupName, string $remoteFilename);

    /**
     * [uploadFile 上传文件至存储服务器]
     * @param  string $localFilename      [本地文件名称]
     * @param  string $fileExtName      [文件扩展名，不包含.]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @param  string $groupName      [文件的组名称]
     * @return [bool]                 [file_id for success, false for error]
     */
    public function uploadFile(string $localFilename,string $fileExtName=null,array $metaList=[],string $groupName=null);

    /**
     * [deleteFile 从存储服务器上删除文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function deleteFile(string $groupName, string $remoteFilename);

    /**
     * [setMetadata 设置元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @param  array $meta_list [数组形式的元信息，例如:array('width'=>1024, 'height'=>768)]
     * @return [bool]                 [true or false]
     */
    public function setMetadata(string $groupName, string $remoteFilename,array $metaList);

    /**
     * [getMetadata 获取元信息]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [true or false]
     */
    public function getMetadata(string $groupName, string $remoteFilename);

    /**
     * [downloadFile 从存储服务器上下载文件]
     * @param  string $groupName      [文件的组名称]
     * @param  string $remoteFilename [存储服务器上的文件名]
     * @return [bool]                 [返回文件流true or false]
     */
    public function downloadFile(string $groupName, string $remoteFilename);
    ```
