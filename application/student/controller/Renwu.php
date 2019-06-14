<?php
namespace app\student\controller;
use think\Controller;
class Renwu extends Base
{
    public function info(){
        $id=session('user_id');
        $xuehao=session('user_xuehao');
        $info=db()->table('addketi')->where("user_xuehao",$xuehao)->select();
        $count_in=count($info);
        if($count_in==1){
            $state=$info[0]['state'];
            if($state==1){
                $xuehao=$info[0]['user_xuehao'];
                $list=db()->table('keti_list')->where("xuehao",$xuehao)->find();
                $info=db()->table('user_study')->where("xuehao",$xuehao)->find();
                  $info['origin']=$list['origin'];
                  $info['gonghao']=$list['gonghao'];
                  $info['detail']=$list['detail'];
                  $info['keti_name']=$list['keti_name'];
                  $info['teacher']=$list['teacher'];
                  $info['jiaoyan']=$list['jiaoyan'];
                  $info['states']=1;
                //   dump($info);
                //   exit;
                  $this->assign('info',$info);
            }else{
                $info['states']=0;
                $this->assign('info',$info);
            }
        }else{
            $info['states']=0;
            $this->assign('info',$info);
        }
        
        
      
        $list_ren=db()->table('renwu_list')->where("xuehao",$xuehao)->select();
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
             $info_ren['times']=$list_ren[0]['timer'];
             $info_ren['state_ren']=$list_ren[0]['state'];
             $info_ren['renwu_state']=$info_stu['renwu_state'];
             $info_ren['states']=1;
             $this->assign('info_ren',$info_ren);
        }else{
            $info_ren['states']=0;
            $this->assign('info_ren',$info_ren);
        }
       
        return $this->fetch();
    }
    public function addRenwu(){
        $data=input('post.');
        $xuehao=session('user_xuehao');
        $data['xuehao']=$xuehao;
        $allowtype = array("doc", "docx", "pdf","rar","zip");
        $size = 2097152;
        //1. 判断文件是否可以成功上传到服务器，$_FILES['myfile']['error'] 为0表示上传成功
        // dump($_FILES['file_path']['error']);
        // exit;
    if($_FILES['file_path']['error'] > 0) {    
        echo '上传错误: ';
        switch ($_FILES['file_path']['error']) {
            case 1:  $this->error('上传文件大小超出了PHP配置中的约定值：upload_max_filesize');  
            case 2:  $this->error('上传文件大小超出了表单中的约定值：MAX_FILE_SIZE');  
            case 3:  $this->error('文件只被部分上载'); 
            case 4:  $this->error('没有上传任何文件'); 
            case 6:  $this->error('找不到临时文件夹');
            case 7:  $this->error('文件写入失败');
            default: $this->error('末知错误');
        }
    } 
    //2. 判断上传的文件是否为充许的文件类型,通过文件的后缀名
   
    $hn = explode(".",$_FILES['file_path']['name']);
    $hz=array_pop($hn);
    //3.通过判断文件的后缀方式，来决定文件是否是充许上传的文件类型
    if(!in_array($hz, $allowtype)) {
        $this->error("这个后缀是<b>{$hz}</b>,不是允许的文件格式!");
    }
    //4. 判断上传的文件是否为充许大小
    if($_FILES['file_path']['size'] > $size ) {
        $this->error("超过了充许的2M大小,请重新上传");
    }
         $file = request()->file('file_path');
         
            // 移动到框架应用根目录/public/uploads/ 目录下
            if($file){
                // 移动到相应的目录
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
                if($info){
                    // 保存文件路径到数据库
                    $data_kt['file_path']=$info->getSaveName();
                    $data_kt['file_name']=$_FILES['file_path']['name'];
                    $data_kt['file_size']=intval($_FILES['file_path']['size']/1024).'k';
                    // dump($_FILES['file_path']['name']);
                    // exit;  
                }else{
                    // 上传失败获取错误信息
                    $this->error('上传失败');
                    // echo;
                }
            }

        $list=db()->table('renwu_list')->where("xuehao",$xuehao)->select();
        $find_one=db()->table('addketi')->where("user_xuehao",$xuehao)->find();
        if($find_one['state']==1){
        $count=count($list);
        if($count==1){
            $state=$list[0]['state'];
            if($state==0){
                $data['timer']=time();
                $bool=db()->table('renwu_list')->where("xuehao",$xuehao)->update($data);
                $bool_file=db()->table('renwu_list')->where("xuehao",$xuehao)->update($data_kt);
                if($bool){
                    $data_ren['renwu_state']=1;
                    $bool_ren=db()->table('user_study')->where("xuehao",$xuehao)->update($data_ren);
                    // 
                    // if($bool_ren){
                        $this->success('提交任务书成功');
                    // }   
                }             
            }elseif($state==1){
                $this->error('提交任务书失败,任务书通过审核');
            }
            
        }else{
             $data['timer']=time();
            $bool=db()->table('renwu_list')->insert($data);
            $bool_file=db()->table('renwu_list')->where("xuehao",$xuehao)->update($data_kt);
            if($bool){
                $data_ren['renwu_state']=1;
                $bool_ren=db()->table('user_study')->where("xuehao",$xuehao)->update($data_ren);
                if($bool_ren){
                    $this->success('提交任务书成功');
                } 
            }else{
                $this->error('提交任务书失败');
            }
        }
        }else{
            $this->error('提交任务书失败,您的课题还没通过审核');
        }
    }
    public function see(){
        $xuehao=session('user_xuehao');
         $info=db()->table('renwu_list')
            ->alias('a')
            ->join('keti_list b','a.xuehao=b.xuehao')
            ->join('user_study c','b.xuehao=c.xuehao')
            ->where('a.xuehao',$xuehao)
            ->where('c.state',0)
            ->field('c.xuehao,c.user,c.class,b.keti_name,b.origin,b.detail,a.content,a.wenxian,a.jihua,a.timer,a.state,a.file_path,a.file_name,a.file_size,a.pingjia')
            ->find();
            $hn = explode(".",$info['file_path']);
            $info['houzhui']=array_pop($hn);
        return $this->fetch('',['info'=>$info]);
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