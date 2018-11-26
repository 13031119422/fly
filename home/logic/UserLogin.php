<?php

namespace app\home\logic;

/**
 * 会员登录逻辑
 */
class UserLogin extends HomeBase
{

	 /**
     * 会员登录
     */
    public function doLogin($username = '', $password = '',$captcha='')
    {
        //$username = 'aaa';
        //$password = '111111';

        $user = $this->logicUser->getUserInfo(['username' => $username]);
        //dump($user);

        if(!captcha_check($captcha))
        {
            return ['code' => 0,'message' => '验证码不正确'];
        }
        if(!$user)
        {
            return ['code' => 0,'message' => '该用户不存在'];
        }elseif (!empty($user['password']) && data_md5_key($password)!= $user['password'])
        {
            return ['code' => 0,'message' => '密码不正确'];
        }else
        {
            //$this->logicUser->setUserValue(['id' => $user['id']], TIME_UT_NAME, TIME_NOW);
            session('user_info', $user);
            return ['code' => 1,'message' => '登录成功！'];

        }
    }

    /**
     * 注销当前用户
     */
    public function logout()
    {

        clear_login_session();

        return [RESULT_SUCCESS, '注销成功', url('login/index')];
    }
	
}

