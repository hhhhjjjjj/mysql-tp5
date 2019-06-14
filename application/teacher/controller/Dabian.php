<?php
namespace app\teacher\controller;
use think\Controller;
class Dabian extends Base
{
    public function dabian(){
        $gonghao=session('teacher_gonghao');
        // $list=db()->table('renwu_list')->where('gonghao',$gonghao)->select();
        $list=db()->table('keti_list')
            ->alias('a')
            ->join('user_study b','a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->field('a.id,a.keti_name,a.origin,a.teacher,a.jiaoyan,a.detail,a.dabianS_state,a.gonghao,a.xuehao,b.dabian_state')
            ->paginate(5,false,[]);
        $list_num=db()->table('keti_list')
            ->alias('a')
            ->join('user_study b','a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->field('a.id,a.keti_name,a.origin,a.teacher,a.jiaoyan,a.detail,a.dabianS_state,a.gonghao,a.xuehao,b.dabian_state')
            ->select();
        $info['count']=count($list_num);
        $page=$list->render();
        $currentPage=$list->currentPage();    
        return $this->fetch('',['list'=>$list,'info'=>$info,'page'=>$page,'currentPage'=>$currentPage]);
    }
    public function shenhe(){
        if(request()->isPost()){
            $data['state']=input('shenhe');
            $data['pingjia']=input('pingjia');
            $data['dabian_time']=input('dabian_time');
            // $data=input('post.');
            // dump($data);
            // exit;
            $user_xuehao=input('user_xuehao');
            $data_se['dabianS_state']=$data['state'];
            $bool1=db()->table('dabian_list')->where('xuehao',$user_xuehao)->update($data);
            if($bool1){
                $bool2=db()->table('keti_list')->where('xuehao',$user_xuehao)->update($data_se);
                if($bool2){
                    return json(['msg'=>'提交成功','status'=>1]);
                }else{
                     return json(['msg'=>'提交失败','status'=>0]);
                }             
            }else{
                return json(['msg'=>'提交失败','status'=>0]);
            }
        }else{
             $xuehao=input('xuehao');
            //  dump($xuehao);
            //  exit;
            $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
            $info_keti=db()->table('keti_list')->where('xuehao',$xuehao)->find();
            // $id=input('id');
            $data=db()->table('dabian_list')->where('xuehao',$xuehao)->find();
             $info['keti_name']=$info_keti['keti_name'];
                $info['origin']=$info_keti['origin'];
                $info['detail']=$info_keti['detail'];
            if($data){
                $info['liyou']=$data['liyou'];
                // $info['fenxi']=$data['fenxi'];
                $info['dabian_time']=$data['dabian_time'];
                $info['pingjia']=$data['pingjia'];
                // $info['file_path']=$data['file_path'];
                $info['timer']=$data['timer'];
                $info['state']=$data['state'];
               
                $info['pingjia']=$data['pingjia'];
            }else{
                 $info['liyou']=$data['liyou'];
                // $info['fenxi']=$data['fenxi'];
                $info['dabian_time']=$data['dabian_time'];
                $info['pingjia']=$data['pingjia'];
                // $info['file_path']=$data['file_path'];
                $info['timer']=0;
                 $info['state']=$data['state'];
               
                $info['pingjia']=$data['pingjia'];
            }
            return $this->fetch('',['info'=>$info]);
        }
       

    }
    public function anpai(){
       $gonghao=session('teacher_gonghao');
        // $list=db()->table('renwu_list')->where('gonghao',$gonghao)->select();
        $list=db()->table('dabian_list')
            ->alias('a')
            ->join('keti_list b','a.gonghao=b.gonghao&&a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->where('a.state',1)
            ->field('a.id,a.xuehao,a.liyou,a.dabian_time,a.timer,a.state,a.gonghao,b.keti_name,b.origin,b.teacher,b.jiaoyan,b.detail')
            ->paginate(5,false,[]);
        $list_num=db()->table('dabian_list')
            ->alias('a')
            ->join('keti_list b','a.gonghao=b.gonghao&&a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->where('a.state',1)
            ->field('a.id,a.xuehao,a.liyou,a.dabian_time,a.timer,a.state,a.gonghao,b.keti_name,b.origin,b.teacher,b.jiaoyan,b.detail')
            ->select();
        $info['count']=count($list_num);
        $page=$list->render();
        $currentPage=$list->currentPage(); 
        return $this->fetch('',['list'=>$list,'info'=>$info,'page'=>$page,'currentPage'=>$currentPage]); 
    }
    public function shijian(){
         if(request()->isPost()){
            $data['state']=input('shenhe');
            // $data['pingjia']=input('pingjia');
            $data['dabian_time']=input('dabian_time');
            // $data=input('post.');
            
            $user_xuehao=input('user_xuehao');
            $bool=db()->table('dabian_list')->where('xuehao',$user_xuehao)->update($data);
            // dump($bool);
            // exit;
            if($bool){
                return json(['msg'=>'提交成功','status'=>1]);               
            }else{
                return json(['msg'=>'提交失败','status'=>0]);
            }
        }else{
             $xuehao=input('xuehao');
            //  dump($xuehao);
            //  exit;
            $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
            $info_keti=db()->table('keti_list')->where('xuehao',$xuehao)->find();
            $id=input('id');
            $data=db()->table('dabian_list')->where('id',$id)->find();
            $info['liyou']=$data['liyou'];
            // $info['fenxi']=$data['fenxi'];
            $info['dabian_time']=$data['dabian_time'];
             $info['pingjia']=$data['pingjia'];
            // $info['file_path']=$data['file_path'];
            $info['timer']=$data['timer'];
            $info['state']=$data['state'];
            $info['keti_name']=$info_keti['keti_name'];
            $info['origin']=$info_keti['origin'];
            $info['detail']=$info_keti['detail'];
            return $this->fetch('',['info'=>$info]);
        }
    }
}
?>