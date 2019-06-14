<?php
namespace app\teacher\controller;
use think\Controller;
class Renwu extends Base
{
    public function renwu(){
        $gonghao=session('teacher_gonghao');
        // $list_ren=db()->table('renwu_list')->where('gonghao',$gonghao)->select();
        $list=db()->table('keti_list')
            ->alias('a')
            ->join('user_study b','a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->field('a.id,a.keti_name,a.origin,a.teacher,a.jiaoyan,a.detail,a.renwuS_state,a.gonghao,a.xuehao,b.renwu_state')
            ->paginate(5,false,[]);
        $list_num=db()->table('keti_list')
            ->alias('a')
            ->join('user_study b','a.xuehao=b.xuehao')
            ->where('a.gonghao',$gonghao)
            ->field('a.id,a.keti_name,a.origin,a.teacher,a.jiaoyan,a.detail,a.renwuS_state,a.gonghao,a.xuehao,b.renwu_state')
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
            $user_xuehao=input('user_xuehao');
            $data_se['renwuS_state']=$data['state'];
            $bool1=db()->table('renwu_list')->where('xuehao',$user_xuehao)->update($data);
            $bool2=db()->table('keti_list')->where('xuehao',$user_xuehao)->update($data_se);
            if($bool1&&$bool2){
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
            // $id=input('id');
            $data=db()->table('renwu_list')->where('xuehao',$xuehao)->find();
            $info['content']=$data['content'];
            $info['wenxian']=$data['wenxian'];
            $info['jihua']=$data['jihua'];
            // $info['file_path']=$data['file_path'];
            $info['timer']=$data['timer'];
            $info['state']=$data['state'];
            $info['keti_name']=$info_keti['keti_name'];
            $info['origin']=$info_keti['origin'];
            $info['detail']=$info_keti['detail'];
            $info['pingjia']=$data['pingjia'];
            $hn = explode(".",$data['file_path']);
            $info['houzhui']=array_pop($hn);
            $info['file_name']=$data['file_name'];
            $info['file_size']=$data['file_size'];
            return $this->fetch('',['info'=>$info]);
        }
       

    }        
    public function xiazai(){
    $xuehao=input('xuehao');
    $file_n=db()->table('renwu_list')->where('xuehao',$xuehao)->find();
    if(!$file_n){
        return "暂无下载入口";
    }
        $file=$file_n['file_path'];
//         str_replace为了严谨点嘛，不要也可以
        $file_lj=str_replace("//","/",ROOT_PATH . 'public' . DS . 'uploads'."\\");
        $files=$file_lj.$file;
        // dump($files);
        // exit;
        if(!file_exists($files)){
            return "文件不存在";
        }else{
            // 打开文件
            $file1=fopen($files,"r");
            Header("Content-type:application/octet-stream");
            Header("Accept-Ranges:bytes");
            Header("Accept-Length:" . filesize($files));
            Header("Content-Disposition:attachment;filename=" . $file_n['file_name']);
            echo fread($file1,filesize($files));
            fclose($file1);
        }
//       
    }

}
?>