<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Test
 */
class TestController extends Controller
{
    
    public function actionIndex()
    {
        $word = \app\models\RandomPost::generate(1, 1);
        var_dump($word->attributes);
    }
    
}
