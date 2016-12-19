<?php

namespace yuncms\admin\migrations;

use yii\db\Migration;

class M161219085802Create_admin_user extends Migration
{
    public function up()
    {
        //添加默认超级管理员帐户 密码是 123456
        $this->insert('{{%admin}}', [
            'id' => 1,
            'username' => 'admin',
            'email' => 'xutongle@gmail.com',
            'auth_key' => '0B8C1dRH1XxKhO15h_9JzaN0OAY9WprZ',
            'password_hash' => '$2y$13$BzPeMPVIFLkiZXwkjJ/HZu0o6Mk0EUQdePC0ufnpzJCzIb4sOrUKK',
            'status' => true,
            'last_login_at' => time(),
            'created_at' => time(),
            'updated_at' => time(),
        ]);
    }

    public function down()
    {
        $this->delete();
        echo "M161219085802Create_admin_user cannot be reverted.\n";

        return false;
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
