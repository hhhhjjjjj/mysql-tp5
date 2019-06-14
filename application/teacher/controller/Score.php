<?php
namespace app\teacher\controller;
use think\Controller;
class Score extends Base
{
    public function zhiscore(){
        $gonghao=session('teacher_gonghao');
        // $map['gonghao']=$gonghao;
        // $map['state']=1;
        $list=db()->table('user_study')
            ->alias('a')
            ->join('keti_list b','a.xuehao=b.xuehao')
            // ->join('score_list c','b.xuehao=c.xuehao')
            ->where('b.gonghao',$gonghao)
            ->where('a.state',0)
            ->field('*')
            ->paginate(5,false,[]);
        $list_num=db()->table('user_study')
            ->alias('a')
            ->join('keti_list b','a.xuehao=b.xuehao')
            // ->join('score_list c','b.xuehao=c.xuehao')
            ->where('b.gonghao',$gonghao)
            ->where('a.state',0)
            ->field('*')
            ->select();
         $info['count']=count($list_num);
         $page=$list->render();
        $currentPage=$list->currentPage();     
            // $list=db()->table('keti_list')->where('gonghao',$gonghao)->select();
        return $this->fetch('list',['list'=>$list,'info'=>$info,'page'=>$page,'currentPage'=>$currentPage]);
    }
    public function chengji(){
        if(request()->isPost()){
            $data=input('post.');
            $xuehao=$data['xuehao'];
            $data['gonghao_zhidao']=session('teacher_gonghao');
            $data['zhidao_time']=time();
            $list=db()->table('score_list')->where('xuehao',$xuehao)->select();
            $count=count($list);
            if($count==1){
                $data['zhidaoT_state']=1;
                $bool=db()->table('score_list')->where('xuehao',$xuehao)->update($data);
                if($bool){
                    $data_sc['luru_state']=1;
                    $bool_sc=db()->table('keti_list')->where('xuehao',$xuehao)->update($data_sc);
                    return json(['msg'=>'提交成功','status'=>1]);
                }else{
                    return json(['msg'=>'提交失败','status'=>0]);
                }
            }else{
                $data['zhidaoT_state']=1;
                $bool=db()->table('score_list')->insert($data);
                if($bool){
                     $data_sc['luru_state']=1;
                    $bool_sc=db()->table('keti_list')->where('xuehao',$xuehao)->update($data_sc);
                    return json(['msg'=>'提交成功','status'=>1]);
                }else{
                    return json(['msg'=>'提交失败','status'=>0]);
                }
            }
            
        }else{
            $xuehao=input('xuehao');
            $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
            $data['xuehao']=$info['xuehao'];
            $data['user']=$info['user'];
            $data['class']=$info['class'];
            $info_kk=db()->table('keti_list')->where('xuehao',$xuehao)->find();
            $data['keti_name']=$info_kk['keti_name'];
            $data['origin']=$info_kk['origin'];
            $info_cc=db()->table('score_list')->where('xuehao',$xuehao)->find();
            $data['zhidao_pingjia']=$info_cc['zhidao_pingjia'];
            $data['zhidao_score']=$info_cc['zhidao_score'];
            return $this->fetch('',['data'=>$data]);
        }
       
    }
    
}
?>