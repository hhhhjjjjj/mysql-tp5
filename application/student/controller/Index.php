<?php
namespace app\student\controller;
use think\Controller;
class Index extends Base
{

    public function index()
    {
        $xuehao=session('user_xuehao');
        $info=db()->table('user_study')->where('xuehao',$xuehao)->find();
        $info_kk=db()->table('addketi')->where('user_xuehao',$xuehao)->find();
        // $info_hh=db()->table('keti_list')->where('xuehao',$xuehao)->find();
        $this->assign('info',$info);     
        if($info_kk){
            $info_kk['state']=1;
            $info_kk['state_cho']=$info_kk['state'];
            $this->assign('info_kk',$info_kk);
        }else{
            $info_kk['state']=0;
            $info_kk['state_cho']=0;
            $this->assign('info_kk',$info_kk);
        }
        // if($info_hh){
        //     $info_hh['state']=1;
        //     $this->assign('info_hh',$info_hh);
        // }else{
        //      $info_hh['state']=0;
        //     $this->assign('info_hh',$info_hh);
        // }
        return $this->fetch();
        
    }

    public function login(){
        return $this->fetch();
    }

    public function doLogin(){
        //接受用户传过来的用户名和密码
        $name=input('username');
        $pwd=input('password');
        $shenfen=input('shenfen');
        // dump($shenfen);
        // exit;
        if($shenfen){
            if($shenfen=='S'){
                
            
            // dump($name);
            // dump($pwd);
            // 查询数据库，对比用户名和密码
            $info=db()->table('user_study')->where("xuehao=:username",['username'=>$name])->find();
            if(!$info){
                $this->error('用户名不存在');
            }

            // if($info['state']==0){
            //     $this->error('您已注销，不要再来了！');
            // }

            $new_pwd=md5(md5($pwd).'ASFEFASDFE!@$#!$%43');
        
            // 验证密码
            if($new_pwd!=$info['password']){
                $this->error('密码错误，请重新登录');
            }
            // $this->validate($data,['captcha|验证码'=>'require|captcha']);
            $captcha=input("post.code");
                if(!captcha_check($captcha)){
                $this->error('验证码错误，请重新登录');
                    exit;
                };

            // 登录成功 获取用户权限

            // 查询角色对应的权限
            // $role_info=db()->table('role')->where('id',$info['role_id'])->find();
            // $user_power_list=explode(',',$role_info['powers']);
            // session('power_list',$user_power_list);

            //记录登录状态 使用 session
            session('user_id',$info['id']);
            session('user_xuehao',$info['xuehao']);
            session('user_name',$info['user']);
            // session('job_id',$info['job_id']); // 职位ID 
            // session('department_id',$info['department_id']); // 部门ID
            session('time',time());
            
            $this->success('登录成功！','index/index');
            }elseif($shenfen=='T'){
                $info=db()->table('teacher_study')->where("gonghao=:username",['username'=>$name])->find();
                if(!$info){
                    $this->error('用户名不存在');
                }
                $new_pwd=md5(md5($pwd).'ASFEFASDFE!@$#!$%43');
                if($new_pwd!=$info['psd']){
                    $this->error('密码错误，请重新登录');
                }
                $captcha=input("post.code");
                if(!captcha_check($captcha)){
                $this->error('验证码错误，请重新登录');
                    exit;
                };
                session('teacher_id',$info['id']);
            session('teacher_gonghao',$info['gonghao']);
            session('teacher_name',$info['name']);
            // $this->redirect('teacher/index/index');
            $this->success('登录成功！','teacher/index/index');
            

            }elseif($shenfen=='A'){
                $info=db()->table('admin_list')->where("admintor_num=:username",['username'=>$name])->find();
                if(!$info){
                    $this->error('用户名不存在');
                }
                $new_pwd=md5(md5($pwd).'ASFEFASDFE!@$#!$%43');
                if($new_pwd!=$info['psd']){
                    $this->error('密码错误，请重新登录');
                }
                $captcha=input("post.code");
                if(!captcha_check($captcha)){
                $this->error('验证码错误，请重新登录');
                    exit;
                };
                session('admintor_id',$info['id']);
            session('admintor_gonghao',$info['admintor_num']);
            session('admintor_name',$info['name']);
            // $this->redirect('teacher/index/index');
            $this->success('登录成功！','admin/index/index');
            }
        }else{
            $this->error('登录失败，请选择身份！');
        }
        
    }
    
    public function register(){       
        return $this->fetch('index/register');
    }
    public function doregister(){
         $captcha=input("post.code");
            if(!captcha_check($captcha)){
               $this->error('验证码错误，请重新注册');
                exit;
            };
        $data=input('post.');
        $list['xuehao']=$data['xuehao'];
        $list['user']=$data['user'];
        $data['password']=md5(md5($data['password']).'ASFEFASDFE!@$#!$%43');
        $list['password']=$data['password'];
        $list['class']=$data['class'];
        $bool=db()->table('user_study')->insert($list);
        if($bool){
            $this->success('注册成功','index/login');
        }else{
            $this->error('注册失败');
        }

    }
    public function gonggaoList(){
        $title=input('title');
        $admin_name=input('admin_name');
        $map=[];
        // $map['status']='0';
        $url_map=[]; 
        if($title){
            $url_map['title']=$title;
            $map['title']=['like',"%".$title."%"];
        }
        if($admin_name){
            $url_map['admin_name']=$admin_name;
            $map['admin_name']=['like',"%".$admin_name."%"];
        }

        $list=db()->table('gonggao_list')
        ->where($map)
        // ->fetchSql(true)
        ->paginate(5,false,['query'=>$url_map]);//分页 
        $list_con=db()->table('gonggao_list')
        ->where($map)->select();
        $info['count']=count($list_con);
        $page=$list->render();
        $currentPage=$list->currentPage();
        $this->assign('url_map',$url_map);
        $this->assign('list',$list);
        $this->assign('info',$info);
        $this->assign('page',$page);
        $this->assign('currentPage',$currentPage);
        return $this->fetch('',[],['__UPLOADS__'=>'uploads']);
        // return $this->fetch('',[]);
    }
    // 添加课题
    public function add(){

        if(request()->isPost()){
            $data=input('post.');
            // dump($data);
            // exit;
            $data['timer']=time();
            $user_xuehao=session('user_xuehao');
            $data['user_xuehao']=$user_xuehao;
            
            // 添加数据
            $info=db()->table('user_study')->where('xuehao',$user_xuehao)->find();
            if(($info['state']==0)&&($info['renwu_state']==0)){
                 $list=db()->table('addketi')->where('user_xuehao',$user_xuehao)->select();
                    $count = count($list);
                    if($list){
                        $state=$list[0]['state'];
                        if(($count==1)&&($state==0)){
                            $this->error('添加失败,您的课题正在审核');
                        }elseif(($count==1)&&($state==1)){
                            $this->error('添加失败,您的课题已经通过审核');
                        }
                    }else{
                        $bool=db()->table('addketi')->insert($data);
                        if($bool){
                            $this->success('添加成功');
                        }else{
                            $this->error('添加失败');
                        }
                    }   
            }elseif(($info['state']==0)&&($info['renwu_state']==1)){
                   $this->error('添加失败,您已经提交任务书'); 
            }   
        }else{
            $user_xuehao=session('user_xuehao');
            $info=db()->table('addketi')->where('user_xuehao',$user_xuehao)->where('timer','<>',0)->find();
            if($info){
                $info['state_aa']=1;
                $this->assign('info',$info);
            }else{
                $info['state_aa']=0;
                $this->assign('info',$info);
            }            
            return $this->fetch('');
        }
    }

    // 
    public function logout(){
        session('user_id',null);
        session('user_xuehao',null);
        session('user_name',null);
        session('time',null);
        $this->success('退出成功','index/login');
    }
     public function see(){   
            $id=input('id');
            // dump($id);
            // exit;
            $info=db()->table('gonggao_list')->where('id',$id)->find();
            return $this->fetch('',['info'=>$info]);
    }

}
