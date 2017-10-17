<?php

namespace admin\controllers;

use admin\assets\AppAsset;
use Yii;

/**
 * 控制器基类
 *
 * @inheritdoc
 */
class Controller extends \ijony\admin\controllers\Controller
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        AppAsset::register($this->view);
    }

    /**
     * @inheritdoc
     */
    public function getMenus()
    {
        return [
            ['name' => '仪表盘', 'url' => ['site/index'], 'icon' => 'tachometer', 'active' => $this->checkRoute('site/index')],
            ['name' => '发布', 'url' => '#', 'icon' => 'pencil', 'items' => [
                ['name' => '日志', 'url' => ['post/create'], 'active' => $this->checkRoute('post/create')],
                ['name' => '消息', 'url' => ['message/create'], 'active' => $this->checkRoute('message/create')],
            ]],
            ['name' => '管理', 'url' => '#', 'icon' => 'tasks', 'items' => [
                ['name' => '日志', 'url' => ['post/index'], 'active' => $this->checkRoute('post/index')],
                ['name' => '消息', 'url' => ['message/index'], 'active' => $this->checkRoute('message/index')],
                ['name' => '反馈', 'url' => ['feedback/index'], 'active' => $this->checkRoute('feedback/index')],
                ['name' => '分类', 'url' => ['category/index'], 'active' => $this->checkRoute('category/index')],
                ['name' => '标签', 'url' => ['tag/index'], 'active' => $this->checkRoute('tag/index')],
            ]],
            ['name' => '系统', 'url' => ['config/index'], 'icon' => 'cog', 'active' => $this->checkRoute('config/index')],
        ];
    }

    public function checkRoute($route)
    {
        return $this->id . '/' . $this->action->id == $route;
        return $this->id . '/' . $this->action->id == $route;
    }
}
