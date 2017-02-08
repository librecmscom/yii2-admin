<?php

namespace yuncms\admin\migrations;

use yii\db\Migration;

class M131219085941Create_admin_menu_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_menu}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'parent' => $this->integer(),
            'route' => $this->string(),
            'icon' => $this->string(30),
            'visible' => $this->boolean()->defaultValue(true),
            //排序
            'sort' => $this->smallInteger()->defaultValue(0),
            'data' => $this->text()
        ], $tableOptions);
        $this->addForeignKey('{{%admin_menu_ibfk_1}}', '{{%admin_menu}}', 'parent', '{{%admin_menu}}', 'id', 'SET NULL', 'CASCADE');


        $this->batchInsert('{{%admin_menu}}', ['id', 'name', 'parent', 'route', 'icon', 'sort', 'data'], [
            //一级主菜单
            [1, '控制台', NULL, '/site/index', 'fa-home', NULL, NULL],
            [2, '核心设置', NULL, NULL, 'fa-cog', NULL, NULL],
            [3, '数据管理', NULL, NULL, 'fa-wrench', NULL, NULL],
            [4, '运营中心', NULL, NULL, 'fa-bar-chart-o', NULL, NULL],
            [5, '用户管理', NULL, NULL, 'fa-user', NULL, NULL],
            [6, '网站管理', NULL, NULL, 'fa-bars', NULL, NULL],
            [7, '财务管理', NULL, NULL, 'fa-cny', NULL, NULL],
            [8, '模块管理', NULL, NULL, 'fa-th', NULL, NULL],
            [9, '模板管理', NULL, NULL, 'fa-laptop', NULL, NULL],

            //核心设置子菜单
            [21, '站点设置', 2, '/site/setting', 'fa-gears', NULL, NULL],
            [22, '用户管理', 2, '/user/user/index', 'fa-user', NULL, NULL],
            [23, '安全设置', 2, '/site/security', 'fa-sun-o', NULL, NULL],
            [24, '角色管理', 2, '/admin/role/index', 'fa-group', NULL, NULL],
            [25, '权限管理', 2, '/admin/permission/index', 'fa-certificate', NULL, NULL],
            [26, '路由管理', 2, '/admin/route/index', 'fa-cloud', NULL, NULL],
            [27, '规则管理', 2, '/admin/rule/index', 'fa-key', NULL, NULL],
            [28, '菜单管理', 2, '/admin/menu/index', 'fa-wrench', NULL, NULL],
            [30, '附件设置', 2, '/attachment/setting', 'fa-cog', NULL, NULL],

            [40, '地区管理', 3, '/area/index', 'fa-globe', NULL, NULL],
            [41, 'Url规则管理', 3, '/url-rule/index', 'fa-exclamation-triangle', NULL, NULL],
            [42, '单页管理', 3, '/page/index', 'fa-edit', NULL, NULL],


            [43, '敏感词管理', 3, '/admin/ban-word/index', 'fa-exclamation-triangle', NULL, NULL],
        ]);

        //隐藏的子菜单[隐藏的子菜单不设置id字段，使用自增]//从10000开始
        $this->batchInsert('{{%admin_menu}}', ['id', 'name', 'parent', 'route', 'visible', 'sort'], [
            [10000, '用户查看', 22, '/admin/view', 0, NULL],
        ]);
        $this->batchInsert('{{%admin_menu}}', ['name', 'parent', 'route', 'visible', 'sort'], [
            ['更新用户', 22, '/user/user/update', 0, NULL], ['授权设置', 22, '/admin/assignment/view', 0, NULL],
            ['角色查看', 24, '/admin/role/view', 0, NULL], ['创建角色', 24, '/admin/role/create', 0, NULL], ['更新角色', 24, '/admin/role/update', 0, NULL],
            ['权限查看', 25, '/admin/permission/view', 0, NULL], ['创建权限', 25, '/admin/permission/create', 0, NULL], ['更新权限', 25, '/admin/permission/update', 0, NULL],
            ['路由查看', 26, '/admin/route/view', 0, NULL], ['创建路由', 26, '/admin/route/create', 0, NULL],
            ['规则查看', 27, '/admin/rule/view', 0, NULL], ['创建规则', 27, '/admin/rule/create', 0, NULL], ['更新规则', 27, '/admin/rule/update', 0, NULL],
            ['菜单查看', 28, '/admin/menu/view', 0, NULL], ['创建菜单', 28, '/admin/menu/create', 0, NULL], ['更新菜单', 28, '/admin/menu/update', 0, NULL],
            ['创建地区', 40, '/area/create', 0, NULL], ['更新地区', 40, '/area/update', 0, NULL],
            ['创建URL规则', 41, '/url-rule/create', 0, NULL], ['更新URL规则', 41, '/url-rule/update', 0, NULL],
            ['创建单页', 42, '/page/create', 0, NULL], ['更新单页', 42, '/page/update', 0, NULL],

            ['敏感词查看', 43, '/admin/ban-word/view', 0, NULL], ['创建敏感词', 43, '/admin/ban-word/create', 0, NULL], ['更新敏感词', 43, '/admin/ban-word/update', 0, NULL],
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%admin_menu}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
