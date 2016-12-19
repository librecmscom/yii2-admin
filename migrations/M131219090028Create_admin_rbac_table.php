<?php

namespace yuncms\admin\migrations;

use yii\db\Migration;

class M131219090028Create_admin_rbac_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_auth_rule}}', [
            'name' => $this->string(64)->notNull()->unique(),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%admin_auth_item}}', [
            'name' => $this->string(64)->notNull()->unique(),
            'type' => $this->integer()->notNull(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);
        $this->createIndex('idx-auth_item-type', '{{%admin_auth_item}}', 'type');
        $this->addForeignKey('{{%admin_auth_item_ibfk_1}}', '{{%admin_auth_item}}', 'rule_name', '{{%admin_auth_rule}}', 'name', 'SET NULL', 'CASCADE');

        $this->createTable('{{%admin_auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('', '{{%admin_auth_item_child}}', ['parent', 'child']);
        $this->addForeignKey('{{%admin_auth_item_child_ibfk_1}}', '{{%admin_auth_item_child}}', 'parent', '{{%admin_auth_item}}', 'name', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%admin_auth_item_child_ibfk_2}}', '{{%admin_auth_item_child}}', 'child', '{{%admin_auth_item}}', 'name', 'CASCADE', 'CASCADE');

        $this->createTable('{{%admin_auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->string(64)->notNull(),
            'created_at' => $this->integer(),
        ], $tableOptions);
        $this->addPrimaryKey('', '{{%admin_auth_assignment}}', ['item_name', 'user_id']);
        $this->addForeignKey('{{%admin_auth_assignment_ibfk_1}}', '{{%admin_auth_assignment}}', 'item_name', '{{%admin_auth_item}}', 'name', 'CASCADE', 'CASCADE');


    }

    public function down()
    {
        $this->dropTable('{{%admin_auth_assignment}}');
        $this->dropTable('{{%admin_auth_item_child}}');
        $this->dropTable('{{%admin_auth_item}}');
        $this->dropTable('{{%admin_auth_rule}}');
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
