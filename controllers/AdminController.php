<?php

namespace padavvan\confbox\controllers;

use Yii;
use yii\base\Controller;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $confbox = \Yii::$app->confbox;
        if (Yii::$app->request->post('Param')) {
            $params = Yii::$app->request->post('Param');

            foreach ($params as $key => $value) {
                $confbox->set($key, $value);
            }

            $confbox->save();
        }

        return $this->render('index', ['data' => $confbox->getAll()]);
    }
}
