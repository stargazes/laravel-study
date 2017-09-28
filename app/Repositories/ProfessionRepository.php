<?php
/**
 * Created by PhpStorm.
 * User: lyh
 * Date: 2017/8/1
 * Time: 13:50
 */
namespace app\Repositories;
use App\Model\Profession;
use App\Repositories\BaseRepository;



class ProfessionRepository  {

    use BaseRepository;

    protected  $profession;

    public function __construct(Profession $profession)
    {
       $this->profession=$profession;
    }

    /**
     * @param $level
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProfessionBylevel($level)
    {
        $list=$this->profession->where('level',$level)->get();
        return $list;
    }

    /**
     * @param $pid
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getProfessionByPid($pid)
    {
        $list=$this->profession->where('pid',$pid)->get();
        return $list;
    }



}