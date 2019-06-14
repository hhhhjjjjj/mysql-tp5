<?php
namespace app\teacher\controller;

use think\Controller;
 use think\Db;
use think\Request;
// use think\Db;
// use traits\
// @
class Index extends Base
{
    public function index()
    {
        $data['time']=time();
        $this->assign('data',$data);
        return $this->fetch('');
    }
    public function loginout()
    {
        session('teacher_id',null);
        session('teacher_gonghao',null);
        session('teacher_name',null);
        $this->success('退出成功','student/index/login');
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
    public function see(){   
            $id=input('id');
            // dump($id);
            // exit;
            $info=db()->table('gonggao_list')->where('id',$id)->find();
            return $this->fetch('',['info'=>$info]);
    }
//  c:\program files\graphicsmagick-1.3.30-q16;C:\Windows\system32;C:\Windows;C:\Windows\System32\Wbem;C:\Windows\System32\WindowsPowerShell\v1.0\;C:\Program Files\Intel\WiFi\bin\;C:\Program Files\Common Files\Intel\WirelessCommon\;C:\Program Files\nodejs\;C:\Program Files (x86)\Microsoft VS Code\bin;C:\phpStudy\PHPTutorial\php\php-5.6.27-nts
}

