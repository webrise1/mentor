<?php
namespace webrise1\mentor;
use Yii;
use webrise1\packagemanager\RBAC as RbacMain;
class RBAC{

    public static function getRbacTree(){
        return RbacMain::prepareRbacTree(self::RBAC_TREE,self::PREFIX,self::PREFIX_DESCRIPTION);
    }

}