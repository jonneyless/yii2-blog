<?php
namespace admin\controllers;

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
    public function getMenus()
    {
        return [
            ['name' => '首页', 'url' => ['site/index'], 'icon' => 'tachometer'],
            ['name' => '发布', 'url' => '#', 'icon' => 'pencil', 'items' => [
                ['name' => '日志', 'url' => ['post/create']],
                ['name' => '消息', 'url' => ['message/create']],
            ]],
            ['name' => '管理', 'url' => '#', 'icon' => 'tasks', 'items' => [
                ['name' => '日志', 'url' => 'post/index'],
                ['name' => '消息', 'url' => 'message/index'],
                ['name' => '反馈', 'url' => 'feedback/index'],
            ]],
            ['name' => '系统', 'url' => ['config/index'], 'icon' => 'cog'],
        ];
    }
}
