<?php
namespace kuainiu\accesslog\components;
use kuainiu\accesslog\models\LogHelper;

class BeforeAction
{
    public static function execute(){
        LogHelper::addAccess();
        return true;
    }
}