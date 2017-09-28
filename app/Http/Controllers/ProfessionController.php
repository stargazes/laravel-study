<?php

namespace App\Http\Controllers;

use App\Repositories\ProfessionRepository;
use App\Model\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProfessionController extends Controller
{
    //
    protected $profession;

    public function __construct(ProfessionRepository $profession)
    {
        $this->profession=$profession;
    }

    /**
     *
     */
    public function profession()
    {
        $pid=Input::get('id');
        $level=Input::get('level','1');

        if(isset($pid)){
            $list=$this->profession->getProfessionByPid($pid);
        }else{
            $list=$this->profession->getProfessionByLevel($level);
        }

        return ['status_code'=>200,'message'=>'成功','list'=>$list];
    }

}
