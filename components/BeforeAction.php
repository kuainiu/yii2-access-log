<?php
namespace kuainiu\access_log\components;
use kuainiu\access_log\models\LogHelper;

class BeforeAction
{
    public static function execute(){
        LogHelper::addAccess();
        return true;
    }
}