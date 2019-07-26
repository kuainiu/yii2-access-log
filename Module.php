<?php

namespace neek\acclog;
use neek\acclog\components\BeforeAction;

use Yii;

class Module extends \yii\base\Module
{
    
    public $includeIndex;

    public function init()
    {
        parent::init();
    }
    public function beforeAction($action)
    {
        if (BeforeAction::execute()){
            return true;
        }
        else{
            return false;
        }
    }
}