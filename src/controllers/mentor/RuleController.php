<?php
namespace webrise1\mentor\controllers\mentor;

use webrise1\mentor\models\rbac\URole;
use webrise1\mentor\models\rbac\UserURole;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use webrise1\mentor\models\User;

/**
 * Site controller
 */
class RuleController extends Controller
{
    public $layout="@webrise1/mentor/views/mentor/layouts/main";
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [                   
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {

        if(!URole::checkUserAccess('MENTOR'))
               $this->redirect('/');
//        if (\Yii::$app->user->isGuest) {
//            $this->redirect('/');
//        }
//
//        $status = \Yii::$app->user->identity->backend_status;
//        if ($status < User::BACKEND_STATUS_ADMINISTRATOR) {
//            $this->redirect('/');
//        }

        return parent::beforeAction($action);
    }


}