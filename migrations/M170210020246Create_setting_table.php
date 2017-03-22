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
            'group' => $this->string(255)->notNull(),
            'key' => $this->string(255)->notNull(),
            'value' => $this->text()
        ], $tableOptions);

        $this->createIndex('setting_unique_key_group', '{{%setting}}', ['group', 'key'], true);

        $this->batchInsert('{{%setting}}',['type','group','key','value'],[
            ['string','site','url','http://www.yuncms.net'],
            ['string','site','name','YUNCMS'],
            ['string','site','title','YUNCMS内容管理系统'],
            ['string','site','keywords','YUNCMS,CMS'],
            ['string','site','description','YUNCMS内容管理系统是一个PHP软件'],
            ['string','site','copyright','Copyright © 20011-2017 by yuncms. All Rights Reserved.'],
            ['string','site','close','0'],
            ['string','site','closeReason',''],
            ['string','site','analysisCode',''],
        ]);
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
