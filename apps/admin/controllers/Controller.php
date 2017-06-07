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
            ['name' => '测试菜单', 'url' => '#', 'items' => [
                ['name' => '测试子菜单', 'url' => '#', 'items' => [
                    ['name' => '测试三级菜单', 'url' => '#'],
                ]],
            ]],
        ];
    }
}
