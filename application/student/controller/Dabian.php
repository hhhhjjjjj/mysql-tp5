<?php
namespace app\student\controller;
use think\Controller;
class Dabian extends Base
{
    public function Dabian(){
        if(request()->isPost()){
             $data=input('post.');
        $xuehao=session('user_xuehao');
        $data['xuehao']=$xuehao;
        // dump($data);
        // exit;
        //  $file = request()->file('file_path');
        //     // 移动到框架应用根目录/public/uploads/ 目录下
        //     if($file){
        //         // 移动到相应的目录
        //         $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        //         if($info){
        //             // 保存文件路径到数据库
        //             $data_kt['file_path']=$info->getSaveName();
                    
                    
        //         }else{
        //             // 上传失败获取错误信息
        //             $this->error('上传失败');
        //             // echo ;
        //         }
        //     }

        $list=db()->table('dabian_list')->where("xuehao",$xuehao)->select();
        $find_one=db()->table('sheji_list')->where("xuehao",$xuehao)->find();
        if($find_one['state']==1){
        $count=count($list);
        if($count==1){
            $state=$list[0]['state'];
            if($state==0){
                $data['timer']=time();
                $bool=db()->table('dabian_list')->where("xuehao",$xuehao)->update($data);
                if($bool){
                    $data_ren['dabian_state']=1;
                    $data_ss=db()->table('user_study')->where("xuehao",$xuehao)->find();
                // dump($data_ss);
                // exit;
                    if($data_ss['dabian_state']==1){
                        $this->error('提交答辩申请失败,你已经提交过答辩申请');
                    }else{
                        $bool_ren=db()->table('user_study')->where("xuehao",$xuehao)->update($data_ren);
                        // $bool_file=db()->table('sheji_list')->where("xuehao",$xuehao)->update($data_kt);
                        if($bool_ren){
                            $this->success('提交答辩申请成功');
                        }else{
                            $this->error('提交答辩申请失败');
                        }   
                    }
                }             
            }elseif($state==1){
                $this->error('提交答辩申请失败,答辩申请通过审核');
            }
            
        }else{
             $data['timer']=time();
            $bool=db()->table('dabian_list')->insert($data);
            if($bool){
                $data_ren['dabian_state']=1;
                 $data_ss=db()->table('user_study')->where("xuehao",$xuehao)->find();
                // dump($data_ss);
                // exit;
                 if($data_ss['dabian_state']==1){
                     $this->error('提交毕业设计失败,你已经提交过毕业设计');
                 }else{
                    $bool_ren=db()->table('user_study')->where("xuehao",$xuehao)->update($data_ren);
                    if($bool_ren){
                        $this->success('提交答辩申请成功');
                    }else{
                        $this->error('提交答辩申请失败');
                    } 
                 }
            }else{
                $this->error('提交答辩申请失败');
            }
        }
        }else{
            $this->error('提交答辩申请失败,您的毕业设计还没通过审核');
        }

        }else{
            $xuehao=session('user_xuehao');
             $list_ren=db()->table('dabian_list')->where("xuehao",$xuehao)->select();
        $count=count($list_ren);
        if($count==1){
             $xuehao_sec=$list_ren[0]['xuehao'];
             $info_ren=db()->table('addketi')->where("user_xuehao",$xuehao_sec)->find();
            //  $keti_name=$info_ren['keti'];
            //  $info_keti=db()->table('keti_list')->where("keti_name",$keti_name)->find();
            //  $info_ren['gonghao']=$info_keti['gonghao'];
            //  $info_ren['origin']=$info_keti['origin'];
             $info_stu=db()->table('user_study')->where("xuehao",$xuehao_sec)->find();
            $info_ren['user']=session('user_name');
             $info_ren['state']=$list_ren[0]['state'];
             $info_ren['states']=1;
             $info_ren['times']=$list_ren[0]['timer'];
             $info_ren['dabian_state']=$info_stu['dabian_state'];
            //  dump($info_ren);
            //  exit;
             $this->assign('info_ren',$info_ren);
        }else{
             $info_kke=db()->table('keti_list')->where("xuehao",$xuehao)->find();
            $info_ren['gonghao']=$info_kke['gonghao'];
            $info_ren['states']=0;
            $this->assign('info_ren',$info_ren);
        }
        return $this->fetch();
            
             
        }  
    }
    public function anpai(){
        $xuehao=session('user_xuehao');
        $list_ren=db()->table('dabian_list')->where("xuehao",$xuehao)->select();
        $count=count($list_ren);
        if($count==1){
            $da_state=$list_ren[0]['state'];
            
            if($da_state==1){
                $dabian_time=$list_ren[0]['dabian_time'];
                if(!empty($dabian_time)){
                    $xuehao_sec=$list_ren[0]['xuehao'];
             $info_ren=db()->table('addketi')->where("user_xuehao",$xuehao_sec)->find();
            //  $keti_name=$info_ren['keti'];
            //  $info_keti=db()->table('keti_list')->where("keti_name",$keti_name)->find();
            //  $info_ren['gonghao']=$info_keti['gonghao'];
            //  $info_ren['origin']=$info_keti['origin'];
            $info_ren['user']=session('user_name');
             $info_ren['states']=$list_ren[0]['state'];
             $info_ren['times']=$list_ren[0]['timer'];
             $info_ren['dabian_time']=$list_ren[0]['dabian_time'];
            //  dump($info_ren);
            //  exit;
             $this->assign('info_ren',$info_ren);
                }else{
                    $info_ren['states']=0;
                    $this->assign('info_ren',$info_ren);
                }
            }else{
                $info_ren['states']=0;
                $this->assign('info_ren',$info_ren);
            }
             
        }else{
            $info_ren['states']=0;
            $this->assign('info_ren',$info_ren);
        }
        return $this->fetch('dabian/anpai');
            
    }
    public function chengji(){
        $xuehao=session('user_xuehao');
        $info=db()->table('user_study')->where("xuehao",$xuehao)->find();
         $this->assign('info',$info);
           $list=db()->table('score_list')
            ->alias('a')
            ->join('teacher_study b','a.gonghao_zhidao=b.gonghao')
            ->where('a.xuehao',$xuehao)
            ->field('*')
            ->find();
            if($list){
                $list['status']=1;
                $this->assign('list',$list);
            }else{
                $list['status']=0;
                $this->assign('list',$list);
            }
            
             $dabian=db()->table('score_list')
            ->alias('a')
            ->join('admin_list b','a.gonghao_dabian=b.admintor_num')
            ->where('a.xuehao',$xuehao)
            ->field('*')
            ->find();
            if($dabian){
                $dabian['status']=1;
                $this->assign('dabian',$dabian);
            }else{
                $dabian['status']=0;
                $this->assign('dabian',$dabian);
            }
            $final=db()->table('score_list')
            ->where('xuehao',$xuehao)
            ->find();
            if($final){
                if(($final['zhidaoT_state']==1)&&($final['dabianT_state']==1)){
                    $final['state']=1;
                    $final['score']=$final['zhidao_score']*0.4+$final['dabian_score']*0.6;
                    $final['time']=time();
                    $final['status']=1;
                    $this->assign('final',$final);
                }else{
                    $final['status']=0;
                    $this->assign('final',$final);
                }
            }else{
                    $final['status']=0;
                    $this->assign('final',$final);
            }
             
         return $this->fetch('dabian/chengji');

    }
    public function zhidaosee(){
        $xuehao=session('user_xuehao');
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
    public function dabiansee(){
         $xuehao=session('user_xuehao');
        $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
        $data['xuehao']=$info['xuehao'];
        $data['user']=$info['user'];
        $data['class']=$info['class'];
        $info_kk=db()->table('keti_list')->where('xuehao',$xuehao)->find();
        $data['keti_name']=$info_kk['keti_name'];
        $data['origin']=$info_kk['origin'];
        $info_cc=db()->table('score_list')->where('xuehao',$xuehao)->find();
        $data['dabian_pingjia']=$info_cc['dabian_pingjia'];
        $data['dabian_score']=$info_cc['dabian_score'];
        return $this->fetch('',['data'=>$data]);
    }
    public function see(){
        $xuehao=session('user_xuehao');
         $info=db()->table('dabian_list')
            ->alias('a')
            ->join('keti_list b','a.xuehao=b.xuehao')
            ->join('user_study c','b.xuehao=c.xuehao')
            ->where('a.xuehao',$xuehao)
            ->where('c.state',0)
            ->field('c.xuehao,c.user,c.class,b.keti_name,b.origin,b.detail,a.liyou,a.timer,a.state,a.pingjia')
            ->find();
        return $this->fetch('',['info'=>$info]);
    }
}
?>