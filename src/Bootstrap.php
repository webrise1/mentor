<?php
namespace webrise1\mentor;

use webrise1\mentor\models\rbac\UserURole;
use webrise1\mentor\models\User;
use app\rbac\MentorRule;
use Yii;
use yii\base\BootstrapInterface;
class Bootstrap implements BootstrapInterface{
    //Метод, который вызывается автоматически при каждом запросе
    public function bootstrap($app)
    {





        //Правила маршрутизации
        $app->getUrlManager()->addRules([
            'mentor' => 'mentor/mentor/default/index',
            'mentor/rbac/<controller>/<action>' => 'mentor/rbac/<controller>/<action>',
            'mentor/rbac/<controller>' => 'mentor/rbac/<controller>',
            'mentor/admin/<controller>/<action>' => 'mentor/admin/<controller>/<action>',
            'mentor/admin/<controller>' => 'mentor/admin/<controller>',
            'mentor/<controller>/<action>' => 'mentor/mentor/<controller>/<action>',
            'mentor/<controller>' => 'mentor/mentor/<controller>',
            'mentor/api/<controller>/<action>' => 'mentor/api/<controller>/<action>',
            'mentor/api/<controller>' => 'mentor/api/<controller>',


        ], false);

//        if (Yii::$app->hasModule('mentor') && ($module = Yii::$app->getModule('mentor'))) {
//            $definition=$module->userModel;
//            $class = "qviox\\mentor\\models\\User";
//            Yii::$container->set($class, $definition);
//            $modelName =  $definition;
//            $this->user=$modelName;




        /*
         * Регистрация модуля в приложении
         * (вместо указания в файле frontend/config/main.php
         */
//        $app->setModule('mentor', 'webrise1\mentor\Module');
    }
}