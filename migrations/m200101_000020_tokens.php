<?php

use yii\db\Migration;

/**
 * Class m200101_000002_tokens
 * This migration enables the token component
 */
class m200101_000020_tokens extends Migration
{
    //Not use {{%table_name}}
    protected $usersTableName = 'users';
    protected $tokensTableName = 'tokens';


    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%'.$this->tokensTableName.'}}', [
            'id' => $this->bigPrimaryKey()->unsigned(),
            'code' => $this->string()->unique()->notNull(),
            'type' => $this->string()->notNull(),
            'user_id' => $this->bigInteger()->unsigned()->notNull(),
            'behavior' => $this->string()->notNull(),
            'remaining_uses' => $this->tinyInteger()->unsigned()->defaultValue(1),
            'expiration_at' => $this->timestamp()->notNull(),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex(
            'idx-'.$this->tokensTableName.'-search',
            '{{%'.$this->tokensTableName.'}}',
            ['code', 'type']
        );

        $this->addForeignKey(
            'fk-'.$this->tokensTableName.'-user_id',
            '{{%'.$this->tokensTableName.'}}',
            'user_id',
            $this->usersTableName,
            'id',
            'CASCADE'
        );

    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-'.$this->tokensTableName.'-user_id', $this->tokensTableName);
        $this->dropIndex('idx-'.$this->tokensTableName.'-search', '{{%'.$this->tokensTableName.'}}');
        $this->dropTable('{{%tokens}}');
    }
}
