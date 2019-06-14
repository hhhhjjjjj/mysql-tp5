<?php
namespace app\student\controller;

use think\Loader;
class Keti extends Base{

    public $model;

    public function _initialize(){
        parent::_initialize();
         $this->model=model('power');
    }

    // 课题列表
    public function ketiList(){
        // 接受参数
        $keti_name=input('keti_name');
        $teacher=input('teacher');
        $gonghao=input('gonghao');

        // $map['status']='0';
        $url_map=[]; 
        // $map['ketiS_state']=0;
        $map=[];
        if($keti_name){
            $url_map['keti_name']=$keti_name;
            $map['keti_name']=['like',"%".$keti_name."%"];
        }

        if($teacher){
            $url_map['teacher']=$teacher;
            $map['teacher']=['like',"%".$teacher."%"];
        }

        if($gonghao){
            $url_map['gonghao']=$gonghao;
            $map['gonghao']=['like',"%".$gonghao."%"];
        }
        // 查询数据
       
        $list=db()->table('keti_list')
        ->where($map)
        // ->whereOr('ketiS_state','<>',2)
        // ->whereOr('ketiS_state',0)
        // ->fetchSql(true)
        ->paginate(8,false,['query'=>$url_map]);
        $list_num=db()->table('keti_list')
        ->where($map)
        // ->whereOr('ketiS_state','<>',2)
        // ->fetchSql(true)
        ->select();
        $info['count']=count($list_num);
        $page=$list->render();
        $currentPage=$list->currentPage();
        $this->assign('url_map',$url_map);
        $this->assign('list',$list);
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('currentPage',$currentPage);
        return $this->fetch('list');
    }
    public function choice(){
        $id=session('user_id');
        $list=db()->table('user_study')->where('id',$id)->find();
        $renwu_state=$list['renwu_state'];
        return json(['renwu_state'=>$renwu_state,'status'=>1]);
    }
    public function dochoice(){
        $id=input('id'); 
        $data['state']=1;
        $xuehao=session('user_xuehao');
        $data['xuehao']=$xuehao;
        $ke_id=session('ke_id');
        $bool1=db()->table('keti_list')->where('id',$id)->update($data);
        $info_one=db()->table('keti_list')->where('id',$id)->find();
        $data_sec['state']=0;
        $bool2=db()->table('keti_list')->where('id',$ke_id)->update($data_sec);
        if($bool2){
            session('ke_id',null);
        }
        if($bool1){
            $user_xuehao=session('user_xuehao');
            $info=db()->table('keti_list')->where('id',$id)->find();
            $data_cho['gonghao']=$info['gonghao'];
            $data_cho['keti_name']=$info['keti_name'];
            $data_cho['origin']=$info['origin'];
            $data_cho['teacher']=$info['teacher'];
            $data_cho['detail']=$info['detail'];
            $data_cho['user_xuehao']=$user_xuehao;
            $list=db()->table('addketi')->where('user_xuehao',$user_xuehao)->select();
            $count=count($list);
            if($count==1){
                $data_cho['timer']=time();
                $bool=db()->table('addketi')->where('user_xuehao',$user_xuehao)->update($data_cho);
                $info_ke=db()->table('addketi')->where('user_xuehao',$user_xuehao)->find();
                if($bool){
                    // $data_use['keti']=$info_ke['keti_name'];
                    // $data_use['teacher']=$info_ke['teacher'];
                    // $bool_us=db()->table('user_study')->where('user_xuehao',$user_xuehao)->update($data_use);
                    // if($bool_us){
                         session('ke_id',$info_one['id']);
                         return json(['msg'=>'选择成功','status'=>1]);
                    // }
                   
                }else{
                    return json(['msg'=>'选择失败','status'=>0]);
                }  
            }else{
                $data_cho['timer']=time();
                $bool=db()->table('addketi')->insert($data_cho);
                if($bool){
                    session('ke_id',$info_one['id']);
                    return json(['msg'=>'选择成功','status'=>1]);
                }else{
                    return json(['msg'=>'选择失败','status'=>0]);
                }  
            }
                  
        }else{
            return json(['msg'=>'选择失败','status'=>0]);
        }
        
    }
    public function infoList(){
        $id=$session('user_id');

    }
    public function see(){
        $xuehao=session('user_xuehao');
        //  $info=db()->table('keti_list')
        //     ->alias('a')
        //     ->join('addketi b','a.xuehao=b.user_xuehao')
        //     ->where('a.xuehao',$xuehao)
        //     ->field('*')
        //     ->find();
        $info=db()->table('addketi')->where('user_xuehao',$xuehao)->find();
        return $this->fetch('',['info'=>$info]);
    }
     public function seeketi(){
        $id=input('id');
        $info=db()->table('keti_list')->where('id',$id)->find();
        return $this->fetch('see_keti',['info'=>$info]);
    }
}

?>