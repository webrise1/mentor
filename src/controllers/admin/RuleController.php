<?php
namespace webrise1\mentor\controllers\admin;


use webrise1\mentor\models\rbac\URole;
use webrise1\mentor\models\rbac\UserURole;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use webrise1\mentor\models\User;
use Yii;

/**
 * Site controller
 */
class RuleController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        // 'actions' => ['logout', 'index','invite-user','mail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
                if(!URole::checkUserAccess('ADMIN'))
                   $this->redirect('/');
//        if (\Yii::$app->user->identity->backend_status == User::BACKEND_STATUS_MENTOR) {
//            $this->redirect('/mentor/');
//        }

        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


}