<?php

namespace App\Http\Controllers;

use App\Model\Demand_list;
use App\User;
use App\Model\Member;
use Illuminate\Http\Request;
use App\Repositories\MemberRepository;

class TestController extends Controller
{
    //
    protected $members;


    public function __construct(MemberRepository $member)
    {
        $this->members=$member;
    }

    public function index()
    {
        //$member = Member::where('uid','1')->first(['name','uid']);
//        $member=Member::find('2')->demands()->get(['uid','describe']);
        $member=$this->members->getById('1')->demands;

        return array('status_code'=>200,'message'=>'success','arr'=>$member);
    }
}
