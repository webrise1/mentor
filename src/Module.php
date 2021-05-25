<?php
namespace webrise1\mentor;
use yii\base\Module as BaseModule;
class Module extends BaseModule
{
    public $controllerNamespace = 'webrise1\mentor\controllers';

    public $userTable;
    public $uploads;
    public $adminEmails;
    public $userAttributes=[
        'name'=>'name',
        'surname'=>'surname',
    ];
}