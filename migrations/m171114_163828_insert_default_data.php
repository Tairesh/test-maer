<?php

use yii\db\Migration;

/**
 * Class m171114_163828_insert_default_data
 */
class m171114_163828_insert_default_data extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->batchInsert('Authors', ['name'], [
            ["CrazyNews"],
            ["Чук и Гек"],
            ["CatFuns"],
            ["CarDriver"],
            ["BestPics"],
            ["ЗОЖ"],
            ["Вася Пупкин"],
            ["Готовим со вкусом"],
            ["Шахтёрская Правда"],
            ["FunScience"],
        ]);
        $this->batchInsert('Languages', ['name'], [
            ["Русский"],
            ["English"],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('TRUNCATE TABLE "Authors" RESTART IDENTITY CASCADE');
        $this->execute('TRUNCATE TABLE "Languages" RESTART IDENTITY CASCADE');
    }
}
