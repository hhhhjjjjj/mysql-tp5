<?php


namespace app\admin\validate;

use think\Validate;

class Power extends Validate
{
    protected $rule =   [
        'name'  => 'require|max:25',
        // 'id'=>'require',
        // 'm'=>'require|max:30',
        // 'a'=>'require',
    ];
    
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max' => '名字太长',
        'name.min' => '名字太短，再加点',
        'm.require'=>'模型名称不能为空',
        'm.max'=>'模型名称不能超过30',
    ];

    // protected $scene = [
    //     'add'  =>  ['name','m','a'],
    // ];

    
}




?>