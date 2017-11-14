<?php

use yii\db\Migration;

/**
 * Handles the creation of table `Authors`.
 */
class m171114_155737_create_authors_table extends Migration
{
    
    private $table = 'Authors';
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
