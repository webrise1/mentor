<?php
namespace webrise1\mentor\controllers\admin;
use Yii;
use yii\web\Controller;
use webrise1\mentor\models\TestMentor;
class TestController extends Controller
{

    public function actionIndex()
    {
        echo 12321;die();
        // регистрируем ресурсы:
        \webrise1\mentor\MentorAssetsBundle::register($this->view);
        $datas = TestMentor::find()->all();
        return $this->render('index',[
            'datas' => $datas
        ]);
    }
}