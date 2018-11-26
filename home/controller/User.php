<?php
namespace app\home\controller;
use think\Session;

/**
 * 前端会员页
 */
class User extends HomeBase
{
    
    // 首页
    public function index()
    {

        $captcha = captcha('login',config('captcha'));
        //return config('captcha');
        $web_info['title'] = '用户登录';
        $this->assign('web_info',$web_info);
        return $this->fetch('login');
    }

    // 用户信息显示设置
    public function userSet()
    {

        //获取用户信息
        $info = $this->logicUser->getUserInfo(['id' => session('user_info.id')]);
        $this->assign('info',$info);

        return $this->fetch('user_set');
    }

    // 处理提交的用户信息设置
    public function baseInfoSet()
    {
        if(IS_POST)
        {
            //判断昵称是否已存在

            if($this->logicUser->getUserInfo(['nickname' => $this->param['nickname'],'id' => ['neq', session('user_info.id')]]))
            {
                return json(['code' => 0, 'message' => '该昵称已注册']);
            }

            $result = $this->logicUser->baseInfoSet($this->param);
            return json($result);

        }
    }

    // 处理提交的用户头像
    public function userPhotoSet()
    {
        if(IS_POST)
        {
            $result = $this->logicUser->baseInfoSet($this->param);
            return json($result);

        }
    }

    // 重置密码
    public function resetPass()
    {
        if(IS_POST)
        {

            if(strlen($this->param['password'] < '6'))
            {
                return json(['code' => 0,'message' => '请输入6位以上的密码']);
            }



            $result = $this->logicUser->editPassword($this->param);
            return json($result);

        }
    }

    /**
     * 注销登录
     */
    public function logout()
    {

        $this->jump($this->logicUserLogin->logout());
    }


    public function test()
    {
        $this->param['username'] = 'aaa';
        $this->param['nickname'] = 'aaa';
        $this->param['password'] = 'aaa';
        //$this->param['repass'] = 'aaa';
        echo 'aaa';
        $result = $this->logicUser->userReg($this->param);
        dump($result);

    }


}
