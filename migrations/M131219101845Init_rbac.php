<?php

namespace yuncms\admin\migrations;

use yii\db\Migration;

class M131219101845Init_rbac extends Migration
{
    public function up()
    {
        //添加规则
        $this->insert('{{%admin_auth_rule}}', ['name' => 'RouteRule', 'data' => 'O:28:"yuncms\admin\components\RouteRule":3:{s:4:"name";s:9:"RouteRule";s:9:"createdAt";i:1470972120;s:9:"updatedAt";i:1470972120;}', 'created_at' => time(), 'updated_at' => time()]);
        $this->insert('{{%admin_auth_rule}}', ['name' => 'GuestRule', 'data' => 'O:28:"yuncms\admin\components\GuestRule":3:{s:4:"name";s:9:"GuestRule";s:9:"createdAt";i:1470972196;s:9:"updatedAt";i:1470972196;}', 'created_at' => time(), 'updated_at' => time()]);

        //添加角色
        $this->batchInsert('{{%admin_auth_item}}', ['name', 'type', 'description', 'rule_name', 'created_at', 'updated_at'], [
            ['Super Administrator', 1, '超级管理员对系统有不受限制的完全访问权。', 'RouteRule', time(), time()],
            ['Administrator', 1, '防止管理员进行有意或无意的系统范围的更改，但是可以执行大部分管理操作。', 'RouteRule', time(), time()],
        ]);

        //添加路由
        $this->batchInsert('{{%admin_auth_item}}', ['name', 'type', 'created_at', 'updated_at'], [
            ['/*', 2, time(), time()],
            ['/site/*', 2, time(), time()],
            ['/site/index', 2, time(), time()],
            ['/admin/security/logout', 2, time(), time()],

        ]);

        //给超级管理员组授权
        $this->insert('{{%admin_auth_item_child}}', ['parent' => 'Super Administrator', 'child' => '/*']);

        //给超级管理员授权
        $this->insert('{{%admin_auth_assignment}}', ['item_name' => 'Super Administrator', 'user_id' => 1, 'created_at' => time()]);
    }

    public function down()
    {
        $this->delete('{{%admin_auth_rule}}', ['name' => 'RouteRule']);
        $this->delete('{{%admin_auth_rule}}', ['name' => 'RouteRule']);
        $this->delete('{{%admin_auth_item}}', ['name' => 'Super Administrator']);
        $this->delete('{{%admin_auth_item}}', ['name' => 'Administrator']);
        $this->delete('{{%admin_auth_item}}', ['name' => '/*']);
        $this->delete('{{%admin_auth_item}}', ['name' => '/site/*']);
        $this->delete('{{%admin_auth_item}}', ['name' => '/site/index']);
        $this->delete('{{%admin_auth_item}}', ['name' => '/admin/security/logout']);
        $this->delete('{{%admin_auth_item_child}}', ['parent' => 'Super Administrator', 'child' => '/*']);
        $this->delete('{{%admin_auth_assignment}}', ['item_name' => 'Super Administrator', 'user_id' => 1]);
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
