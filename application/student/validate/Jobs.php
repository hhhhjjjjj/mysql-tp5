<?php


namespace app\admin\validate;

use think\Validate;

class Jobs extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        'pid'=>'require',

    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max' => '名字太长',
        'pidm.require'=>'模型名称不能为空',
    ];



    
}




?>