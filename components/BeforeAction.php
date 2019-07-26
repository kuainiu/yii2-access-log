<?php
namespace neek\acclog\components;
use neek\acclog\models\LogHelper;

class BeforeAction
{
    public static function execute(){
        LogHelper::addAccess();
        return true;
    }
}