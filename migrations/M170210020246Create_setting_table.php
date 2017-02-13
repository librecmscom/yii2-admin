<?php

namespace yuncms\admin\migrations;

use yii\db\Migration;

class M170210020246Create_setting_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'type' => $this->string(255)->notNull(),
            'section' => $this->string(255)->notNull(),
            'key' => $this->string(255)->notNull(),
            'value' => $this->text(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);

        $this->createIndex('setting_unique_key_group', '{{%setting}}', ['section', 'key'], true);
    }

    public function down()
    {
        $this->dropTable('{{%setting}}');
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
