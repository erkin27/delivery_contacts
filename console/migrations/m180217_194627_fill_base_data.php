<?php

use yii\db\Migration;

/**
 * Class m180217_194627_fill_base_data
 */
class m180217_194627_fill_base_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i<60; $i++) {
            $this->insert("{{%client}}", [
                'login' => $faker->format('firstName'),
                'password' => $faker->format('numberBetween', ['min' => 1000000, 'max' => 10000000]),
                'name' => $faker->format('firstName'),
                'surname' => $faker->format('lastName'),
                'gender' => rand(1, 3),
                'created' => $faker->format('iso8601'),
                'email' => $faker->format('email'),
            ]);
        }

        $clientIds = $this->getDb()->createCommand("Select id from {{%client}}")->queryColumn();

        foreach ($clientIds as $clientId) {
            for ($i = 0; $i<20; $i++) {
                $this->insert("{{%address}}", [
                    'client_id' => $clientId,
                    'index' => ''. $faker->format('postcode'),
                    'country' => $faker->format('stateAbbr'),
                    'city' => $faker->format('city'),
                    'street' => $faker->format('streetName'),
                    'house' => $faker->format('buildingNumber'),
                    'float' => rand(1, 200),
                ]);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $this->truncateTable('{{%address}}');
        $this->truncateTable('{{%client}}');
        $this->execute("SET FOREIGN_KEY_CHECKS=1;");
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180217_194627_fill_base_data cannot be reverted.\n";

        return false;
    }
    */
}
