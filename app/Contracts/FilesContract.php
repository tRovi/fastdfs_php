<?php 
namespace App\Contracts;

interface FilesContract
{	
	/**
     * @api {get} /uploadfiles 上传文件
     * @apiName 上传文件接口
     * @apiGroup 文件
     * @apiDescription 上传文件
     * 
     * @apiParam {int} [file]    文件流
     *
     * @apiSuccess {json} data 返回数据
     * @apiSuccess {String} name 名称
     * @apiSuccess {String} url  url
     * 
     * @apiSuccessExample {json} Success-Response:
     *     
     *     {
                "file":[
                            {
                                "name":"14682156004688.gif",
                                "url":"\/uploads\/file\/20161115\/14791992393525.gif"
                            }
                        ]
            }
     *
     * @apiError {String} errcode  错误码
     * @apiError {String} msg  信息
     * @apiError {json} errcode  返回数据
     * 
     * @apiErrorExample {json} Error-Response:
     *      {
     *           "errcode": 100,
     *           "msg":"fail",
     *           "data": ""
     *      }
     */
    public function uploadfiles($jsonen,$rootUrl);

    /**
     * [multiuploadfiles 多图上传]
     * @param  [type] $jsonen [description]
     * @return [type]         [description]
     */
    public function multiuploadfiles($jsonen,$rootUrl);
 
    
}