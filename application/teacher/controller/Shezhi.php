<?php
namespace app\teacher\controller;
use think\Controller;
class Shezhi extends Base
{
    public function fixed(){
         if(request()->isPost()){
             $gonghao=session('teacher_gonghao');
            $data=input('post.');
            $psd=$data['psd_now'];
            $pwd=md5(md5($psd).'ASFEFASDFE!@$#!$%43');
            $info=db()->table('teacher_study')->where("gonghao",$gonghao)->where("psd",$pwd)->find();
        if(!$info){
            $this->error('现在密码输入错误，请重新输入');
        }else{
            $psd_new=$data['psd_new1'];
            $pwd_new['psd']=md5(md5($psd_new).'ASFEFASDFE!@$#!$%43');
            $gonghao=session('teacher_gonghao');
            $bool=db()->table('teacher_study')->where("gonghao",$gonghao)->update($pwd_new);
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
        $gonghao=session('teacher_gonghao');
        $info=db()->table('teacher_study')->where("gonghao",$gonghao)->find();
        $this->assign('info',$info);
        return $this->fetch('');
    }
}
?>