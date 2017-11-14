<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Languages`.
 */
class m171114_160432_create_languages_table extends Migration
{
    
    private $table = 'Languages';
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
        $this->createIndex('Name'.$this->table, $this->table, ['name'], true);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropIndex('Name'.$this->table, $this->table);
        $this->dropTable($this->table);
    }
}
