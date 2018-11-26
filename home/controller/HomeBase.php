<?php
namespace app\home\controller;

use app\common\controller\ControllerBase;

/**
 * 前台基类控制器
 */
class HomeBase extends ControllerBase
{

    // 页面标题
    protected $title            =   '';

    /**
     * 构造方法
     */
    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();

        // 初始化前台信息
        $this->initBaseInfo();

    }


    /**
     * 初始化基础数据
     */
    final private function initBaseInfo()
    {
        //判断用户是否登录
        if(session('user_info.id') < 1)
        {
            $this->jump(RESULT_ERROR,'请登录', url('login/index'));
        }

        // 设置登录用户信息
        if(session('user_info.id') > 0)
        {
            $this->assign('user_info', session('user_info'));
        }
    }





}
