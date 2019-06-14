<?php


namespace app\student\model;

use think\Model;

class Role extends Model
{

    // 获取分页数据
    public function getPageList(){

        $name=input('name');
        $url_map=[]; 
        $map=[];

        $map['disabled']=0;
        if($name){
            $url_map['name']=$name;
            $map['name']=['like',"%".$name."%"];
        }
        $list=$this->where($map)->paginate(2,false,['query'=>$url_map]);
        return ['list'=>$list,'map'=>$url_map];
    }

    
}




?>