<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Str;

class StrController extends Controller{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],            
        ];
    }

    public function actionIndex(){
        $model = new Str();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            return $this->render('view', ['model' => $model]);
        }else{
            return $this->render('index', ['model' => $model]);
        }
    }
}
?>
