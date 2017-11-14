<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Language;
use app\models\Author;
use app\models\RandomPost;

/**
 * Generates random posts
 */
class GeneratorController extends Controller
{
    
    /**
     * Generates and saves random posts
     * @param $count integer posts to generate
     */
    public function actionIndex($count = 10000)
    {
//        RandomPost::deleteAll();
        $languages = Language::find()->select('id')->column();
        $authors = Author::find()->select('id')->column();
        
        $timeStart = microtime(true);
        
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $model = RandomPost::generate($languages[array_rand($languages)], $authors[array_rand($authors)]);
            // collect data for batch insert
            $attributes = $model->attributes;
            unset($attributes['id']);
            $data[] = $attributes;
        }
        
        $timeGenerated = microtime(true);
        echo "$count random posts generated at ".($timeGenerated-$timeStart).' sec.'.PHP_EOL;
        
        $command = Yii::$app->db->createCommand();
        $command->batchInsert(RandomPost::tableName(), ['languageId', 'authorId', 'dateCreated', 'title', 'text', 'likesCount'], $data);
        $inserted = $command->execute();
        
        $timeInserted = microtime(true);
        echo "$inserted random posts saved at ".($timeInserted-$timeGenerated).' sec.'.PHP_EOL;
    }
    
}
