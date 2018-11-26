<?php
namespace app\home\controller;

/**
 * 前端首页控制器
 */
class Index extends IndexBase
{
    
    // 首页
    public function index()
    {
        
        return $this->fetch('reg');
    }
    
    // 详情
    public function details($id = 0)
    {
        
        $where = [];
        
        !empty((int)$id) && $where['a.id'] = $id;
        
        $data = $this->logicArticle->getArticleInfo($where);
        
        $this->assign('article_info', $data);
        
        $this->assign('category_list', $this->logicArticle->getArticleCategoryList([], true, 'create_time asc', false));
        
        return $this->fetch('details');
    }
}
