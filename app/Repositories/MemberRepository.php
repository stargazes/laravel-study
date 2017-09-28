<?php
/**
 * Created by PhpStorm.
 * User: lyh
 * Date: 2017/8/1
 * Time: 13:50
 */
namespace app\Repositories;
use App\Model\Member;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redis;


class MemberRepository  {

    use BaseRepository;

    protected  $model;
    protected  $status_code=500;
    protected  $message;

    public function __construct(Member $member)
    {
        $this->model=$member;
    }

    /**获取用户信息
     * @param $uid
     * @return mixed
     */
    public function getById($uid)
    {
        return $this->model->where('uid',$uid)->first();
    }

    //登录验证

    /**
     * @param $input
     * @return array
     */
    public function refreshTokenByLogin($input)
    {
        $userInfo=$this->model->where('uniquecode',$input['uniquecode'])->first();
        if($userInfo){
            if(Crypt::decrypt($userInfo->password) != $input['password'] ){
                $this->message='密码错误';
            }else{

                //刷新token
                $userToken=md5($input['uniquecode'].time());


                Redis::set ($userInfo['uid'],$userToken);

                $this->status_code=200;
                $this->message='登录成功';
            }
        }else{
            $this->message='账号有误';
        }
        return ['status_code'=>$this->status_code,'message'=>$this->message];
    }

}