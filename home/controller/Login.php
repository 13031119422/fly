<?php
namespace app\home\controller;

/**
 * 前端首页控制器
 */
class Login extends IndexBase
{
    
    // 首页
    public function index()
    {
        /*if($hasUser = $this->logicUser->getUserInfo(['username' => 'admin2']))
        {
            echo 'you';
        }else{
            echo 'wu';
        }
        dump($hasUser);*/


        $captcha = captcha('login',config('captcha'));
        //return config('captcha');
        $web_info['title'] = '用户登录';
        $this->assign('web_info',$web_info);
        return $this->fetch('login');
    }


    /**
     * 登录处理
     */
    public function doLogin()
    {

        $result = $this->logicUserLogin->doLogin($this->param['username'],$this->param['password'],$this->param['verify']);
        return json($result);
        //session();
    }

    // 注册
    public function doReg()
    {

        //echo '{"code":1,"message":"成功了"}';
        /*dump($this->param);
        return json(['code' => 0,'message' => '该用户名已经被注册']);*/
        //dump($this->param);

        if(IS_POST)
        {

            if($this->logicUser->getUserInfo(['username' => $this->param['username']]))
            {

                return json(['code' => 0,'message' => '该用户名已注册']);
            }

            //判断昵称是否已存在
            if($this->logicUser->getUserInfo(['nickname' => $this->param['nickname']]))
            {
                return json(['code' => 0,'message' => '该昵称已注册']);
            }

            //判断两次输入的密码是否一致
            if($this->param['password']!= $this->param['repass'])
            {
                return json(['code' => 0,'message' => '两次输入的密码不一致']);
            }

            unset($this->param['repass']);
            
            $result = $this->logicUser->userReg($this->param);
            return json($result);

        }

        //IS_POST && $this->jump($this->logicReg->userAdd($this->param));
        //return json(['code' => 1,'message' => '成功']);
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
