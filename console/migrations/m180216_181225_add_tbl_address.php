<?php

use yii\db\Migration;

/**
 * Class m180216_181225_add_tbl_adress
 */
class m180216_181225_add_tbl_address extends Migration
{
    private $tableName = '{{%address}}';
    private $refTableName = '{{%client}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'index' => $this->string()->notNull(),
            'country' => $this->string(2)->notNull(),
            'city' => $this->string()->notNull(),
            'street' => $this->string()->notNull(),
            'house' => $this->integer()->notNull(),
            'float' => $this->integer()
        ]);

        $this->addForeignKey('fk-address-client_id', $this->tableName, 'client_id',
            $this->refTableName,'id', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
            $this->dropForeignKey('fk-address-client_id', $this->tableName);
            $this->dropTable($this->tableName);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180216_181225_add_tbl_adress cannot be reverted.\n";

        return false;
    }
    */
}
