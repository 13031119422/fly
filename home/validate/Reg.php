<?php
// +---------------------------------------------------------------------+
// | OneBase    | [ WE CAN DO IT JUST THINK ]                            |
// +---------------------------------------------------------------------+
// | Licensed   | http://www.apache.org/licenses/LICENSE-2.0 )           |
// +---------------------------------------------------------------------+
// | Author     | Bigotry <3162875@qq.com>                               |
// +---------------------------------------------------------------------+
// | Repository | https://gitee.com/Bigotry/OneBase                      |
// +---------------------------------------------------------------------+

namespace app\home\validate;

/**
 * 菜单验证器
 */
class Reg extends AdminBase
{

    // 验证规则
    protected $rule =   [

        'phone'  => 'require',
        'adress'  => 'require',
        //'url'   => 'require|unique:menu'
    ];

    // 验证提示
    protected $message  =   [

        'phone.require'    => '手机不能为空',
        'adress.require'    => '地址不能为空',
    ];

    // 应用场景
    protected $scene = [

        'doReg'  =>  ['name', 'adress'],
        'edit' =>  ['name', 'adress'],
    ];

}