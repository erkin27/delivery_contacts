<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m180216_193002_add_user_admin
 */
class m180216_193002_add_user_admin extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => \Yii::$app->getSecurity()->generateRandomString(),
            'password_hash' => \Yii::$app->getSecurity()->generatePasswordHash('123123'),
            'password_reset_token' => \Yii::$app->getSecurity()->generatePasswordHash('token123'),
            'email' => 'admin@delivery_contacts.com',
            'status' => \common\models\User::STATUS_ACTIVE,
            'created_at' => 'datetime with time zone default now()',
            'updated_at' => 'datetime with time zone default now()',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin', 'email' => 'admin@delivery_contacts.com']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_193002_add_user_admin cannot be reverted.\n";

        return false;
    }
    */
}
