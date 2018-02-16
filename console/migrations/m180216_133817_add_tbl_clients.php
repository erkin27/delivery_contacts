<?php

use yii\db\Migration;

/**
 * Class m180216_133817_add_tbl_clients
 */
class m180216_133817_add_tbl_clients extends Migration
{
    private $tableName = '{{%client}}';

    /**
     * @inheritdoc
     */

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'login' => $this->string()->unique()->notNull(),
            'password' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'gender' => $this->smallInteger()->notNull()->defaultValue(3),
            'created' => $this->integer()->notNull(),
            'email' => $this->string()->unique()->notNull()
        ]);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
    }
    /*
    public function safeUp()
    {
    }

    public function safeDown()
    {
        echo "m180216_133817_add_tbl_clients cannot be reverted.\n";

        return false;
    }

    */
}
