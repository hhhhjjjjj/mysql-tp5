<?php
namespace app\teacher\controller;
use think\Controller;
class Base extends Controller
{

    public function _initialize()
    {
        // $action_list=['login','logout','dologin'];
        // $model=request()->module();
        // $action= request()->action();
        // $controller=request()->controller();
        // if(!session('user_id') &&  $controller !='index' && !in_array($action,$action_list)  ){
        //     $this->error('请先登录','index/login');
        // }

        // //1、查询用户访问的方法 有没有在权限列表 （查询权限表）
        // $map['m']=strtolower($model);
        // $map['c']=strtolower($controller);
        // $map['a']=strtolower($action);
        // $info=db()->table('power')->where($map)->find();
        // if($info){ //需要权限验证
        //     //当前用户的所有权限
        //     $user_power_list=session('power_list');
        //     // 3、判断当前的方法有没有在用户权限列表
        //     if(!in_array($info['id'], $user_power_list)){
        //         // $this->error('您没有访问改方法的权限');
        //         echo "权限不足！，不能访问该方法";exit();
        //     }
        // }

    }

}

