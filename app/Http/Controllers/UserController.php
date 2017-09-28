<?php

namespace App\Http\Controllers;

use App\Repositories\MemberRepository;
use Dingo\Api\Console\Command\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $member;

    public function __construct(MemberRepository $member)
    {
        $this->member=$member;
    }

    //用户登录
    public function login(Request $request)
    {
        $validator=Validator::make($request->input(),
            [
                'way'=>'required|numeric',
                'uniquecode'=>'required|string',
                'password'=>'required'
            ],[
                'way.required'=>'登录方式必填',
                'way.numeric'=>'请求值必须为数字',
                'uniquecode.required'=>'登录账号必填',
                'password.required'=>'密码必填'
            ]);
        if($validator->passes()){
            $result=$this->member->refreshTokenByLogin($request->input());
            return $result;
        }else{
            return array('status_code'=>500,'message'=>$validator->errors()->first());
        }
    }

    /**注册
     * @param Request $request
     * @return array
     */
    public function register(Request $request)
    {
        $input=$request->input();

        $validator=Validator::make($input,[
            'uniquecode'=>'required|unique:member,uniquecode',
            'password'=>'required',
            'name'=>'required'
        ],[
            'uniquecode.required'=>'账号必须',
            'uniquecode.unique'=>'账号已注册',
            'password.required'=>'密码必须',
            'password.min'=>'密码最少6位',
            'name.required'=>'用户名必须'
        ]);
        if($validator->passes()){
            $input['password']=Crypt::encrypt($input['password']);
            if($this->member->store(store($input))){

                return array('status_code'=>200,'message'=>'添加成功');
            }else{
                return array('status_code'=>500,'message'=>'网络错误请重试');
            }
        }else{
            return array('status_code'=>500,'message'=>$validator->errors()->first());
        }
    }



}
