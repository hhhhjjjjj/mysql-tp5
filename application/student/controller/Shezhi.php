<?php
namespace app\student\controller;
use think\Controller;
class Shezhi extends Base
{
    public function fixed(){
         if(request()->isPost()){
            $xuehao=session('user_xuehao');
            $data=input('post.');
            $psd=$data['psd_now'];
            $pwd=md5(md5($psd).'ASFEFASDFE!@$#!$%43');
            $info=db()->table('user_study')->where("password",$pwd)->where("xuehao",$xuehao)->find();
            if(!$info){
                $this->error('现在密码输入错误，请重新输入');
            }else{
                $psd_new=$data['psd_new1'];
                $pwd_new['password']=md5(md5($psd_new).'ASFEFASDFE!@$#!$%43');
                $xuehao=session('user_xuehao');
                $bool=db()->table('user_study')->where("xuehao",$xuehao)->update($pwd_new);
                if($bool){
                    $this->success('密码修改成功');
                }else{
                    $this->error('密码修改失败');
                }
            }   

         }else{
            return $this->fetch('shezhi/fixed');
         }
    }
    public function msg(){
        $xuehao=session('user_xuehao');
        $info=db()->table('user_study')->where("xuehao",$xuehao)->find();
        $this->assign('info',$info);
        return $this->fetch('shezhi/msg');
    }
}
?>