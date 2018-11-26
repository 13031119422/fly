<?php

namespace app\home\logic;

/**
 * 会员逻辑
 */
class Reg extends HomeBase
{

	 /**
     * 会员注册
     */
    public function userAdd($data = [])
    {
        
        $result = $this->modelUser->setInfo($data);
        
        $result && action_log('注册', '注册会员，username：' . $data['username']);
        
        return $result ? [RESULT_SUCCESS, '注册成功'] : [RESULT_ERROR, $this->modelMember->getError()];
    }
	
}

