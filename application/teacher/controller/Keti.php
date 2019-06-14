<?php
namespace app\teacher\controller;
use think\Controller;
class Keti extends Base
{
    public function addketi(){
        if(request()->isPost()){
            $data=input('post.');      
            $data['gonghao']=session('teacher_gonghao');
            $data['teacher']=session('teacher_name');
            $data['timer']=time();
            $bool=db()->table('keti_list')->insert($data);
            if($bool){
                $this->success('添加课题成功');
            }else{
                $this->error('添加课题失败');
            }
        }else{
        $gonghao=session('teacher_gonghao');
        // $list=db()->table('keti_list')->where('gonghao',$gonghao)->select();
        $count=db()->table('keti_list')
        ->where('gonghao',$gonghao)->count();
        $list=db()->table('keti_list')
        ->where('gonghao',$gonghao)
        // ->fetchSql(true)
        ->paginate(5,false,[]);
        $info['count']=$count;
        $page=$list->render();
        $currentPage=$list->currentPage();
        // $list['count']=count($list_con);
        $this->assign('list',$list);
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('currentPage',$currentPage);
        // dump($list);
        // exit;
        return $this->fetch('keti/add_keti');
        }
    }
    public function ketiList(){
        $keti_name=input('keti_name');
        $teacher=input('teacher');
        $gonghao=input('gonghao');

        // $map['status']=0||2;
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
        $list=db()->table('keti_list')
        ->where($map)
        // ->whereOr('ketiS_state',1)
        // ->fetchSql(true)
        ->paginate(8,false,['query'=>$url_map]);
        // dump($list);
        // // 渲染页面
        $list_con=db()->table('keti_list')
        ->where($map)
        // ->whereOr('ketiS_state',1)
        ->select();
        $info['count']=count($list_con);
        $page=$list->render();
        $currentPage=$list->currentPage();
        $this->assign('url_map',$url_map);
        $this->assign('info',$info);
        $this->assign('list',$list);
        $this->assign('page',$page);
        $this->assign('currentPage',$currentPage);
        return $this->fetch('keti_list');
    }
    public function see(){
        $id=input('id');
        $info=db()->table('keti_list')->where('id',$id)->find();
        return $this->fetch('',['info'=>$info]);
    }
    public function edit(){
        if(request()->isPost()){
            $data=input('post.');
            $id=$data['id'];
            $bool=db()->table('keti_list')->where('id',$id)->update($data);
            if($bool){
                return json(['msg'=>'修改成功','status'=>1]);
            }else{
                return  json(['msg'=>'修改失败','status'=>0]);
            }

        }else{
             $id=input('id');
            $info=db()->table('keti_list')->where('id',$id)->find();
            return $this->fetch('',['info'=>$info]);
        }
       
    }
    public function del(){
        $id=input('id');
        $bool=db()->table('keti_list')->where('id',$id)->delete();
        if($bool){
             return json(['msg'=>'删除成功','status'=>1]);
        }else{
             return json(['msg'=>'删除失败','status'=>0]);
        }
    }
    public function shenhelist(){
        $gonghao=session('teacher_gonghao');
        // $list=db()->table('addketi')->where('gonghao',$gonghao)->select();
        $list=db()->table('addketi')
        ->where('gonghao',$gonghao)
        // ->fetchSql(true)
        ->paginate(5,false,[]);
        $list_con=db()->table('addketi')
        ->where('gonghao',$gonghao)->select();
        $info['count']=count($list_con);
        $page=$list->render();
        $currentPage=$list->currentPage();
        return $this->fetch('shenhe_list',['list'=>$list,'info'=>$info,'page'=>$page,'currentPage'=>$currentPage]);
    }
    public function shenhe(){
        if(request()->isPost()){
            $data['advice']=input('advice');
            $data['state']=input('shenhe');
            $user_xuehao=input('user_xuehao');
            $bool=db()->table('addketi')->where('user_xuehao',$user_xuehao)->update($data);
            if($bool){
                if($data['state']==1){
                     $user_xuehao=input('user_xuehao');
                     $info=db()->table('addketi')->where('user_xuehao',$user_xuehao)->find();
                     $list['teacher']=$info['teacher'];
                     $list['jiaoyan']=$info['jiaoyan'];
                     $list['gonghao']=$info['gonghao'];
                     $list['keti_name']=$info['keti_name'];
                     $list['origin']=$info['origin'];
                     $list['detail']=$info['detail'];
                     $list['timer']=time();
                     $list['state']=1;
                     $list['ketiS_state']=1;
                     $list['xuehao']=$info['user_xuehao'];
                     $list_kk=db()->table('keti_list')->where('xuehao',$user_xuehao)->select();
                     $count=count($list_kk);
                    
                     if($count==1){
                         $bool=db()->table('keti_list')->where('xuehao',$user_xuehao)->update($list);
                        //  if($bool){
                             return json(['msg'=>'提交成功','status'=>1]);
                        //  }else{
                            //  return json(['msg'=>'提交失败','status'=>0]);
                        //  }
                     }else{
                        $bool=db()->table('keti_list')->insert($list);
                        if($bool){
                             return json(['msg'=>'提交成功','status'=>1]);
                         }else{
                             return json(['msg'=>'提交失败','status'=>0]);
                         }
                     }
                }else{
                    $user_xuehao=input('user_xuehao');
                    //  $info=db()->table('addketi')->where('user_xuehao',$user_xuehao)->find();
                    //  $list['teacher']=$info['teacher'];
                    //  $list['jiaoyan']=$info['jiaoyan'];
                    //  $list['gonghao']=$info['gonghao'];
                    //  $list['keti_name']=$info['keti_name'];
                    //  $list['origin']=$info['origin'];
                    //  $list['detail']=$info['detail'];
                    // //  $list['advice']=$info['advice'];
                    //  $list['state']=0;
                    //  $list['ketiS_state']=$data['state'];
                    //  $list['xuehao']=$info['user_xuehao'];
                    //  $list_kk=db()->table('keti_list')->where('xuehao',$user_xuehao)->select();
                    //  $count=count($list_kk);
                    
                    //  if($count==1){
                    //      $bool=db()->table('keti_list')->where('xuehao',$user_xuehao)->update($list);
                    //     //  if($bool){
                    //          return json(['msg'=>'提交成功','status'=>1]);
                    //     //  }else{
                    //         //  return json(['msg'=>'提交失败','status'=>0]);
                    //     //  }
                    //  }else{
                    //     $bool=db()->table('keti_list')->insert($list);
                    //     if($bool){
                    //          return json(['msg'=>'提交成功','status'=>1]);
                    //      }else{
                    //          return json(['msg'=>'提交失败','status'=>0]);
                    //      }
                    //  }
                    $list_kk=db()->table('keti_list')->where('xuehao',$user_xuehao)->select();
                     $count=count($list_kk);
                    
                     if($count==1){
                         $bool=db()->table('keti_list')->where('xuehao',$user_xuehao)->delete();
                         if($bool){
                             return json(['msg'=>'提交成功','status'=>1]);
                         }else{
                             return json(['msg'=>'提交失败','status'=>0]);
                         }
                     }else{
                             return json(['msg'=>'提交成功','status'=>1]);
                     }

                }
                
            }else{
                return json(['msg'=>'提交失败','status'=>0]);
            }
        }else{
             $xuehao=input('xuehao');
            //  dump($xuehao);
            //  exit;
            $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
            $id=input('id');
            $data=db()->table('addketi')->where('id',$id)->find();
            $info['keti_name']=$data['keti_name'];
            $info['gonghao']=$data['gonghao'];
            $info['origin']=$data['origin'];
            $info['teacher']=$data['teacher'];
            $info['detail']=$data['detail'];
            $info['state']=$data['state'];
            $info['advice']=$data['advice'];
            return $this->fetch('',['info'=>$info]);
        }
       

    }
    public function seeUser(){
         $id=input('id');
         $xuehao=input('xuehao');
         $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
        $data=db()->table('keti_list')->where('id',$id)->find();
         $info['keti_name']=$data['keti_name'];
            $info['gonghao']=$data['gonghao'];
            $info['origin']=$data['origin'];
            $info['teacher']=$data['teacher'];
            $info['detail']=$data['detail'];
        return $this->fetch('',['info'=>$info]);
    }
}
?>