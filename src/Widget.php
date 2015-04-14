<?php

namespace metalguardian\dateTimePicker;

use yii\widgets\InputWidget;

/**
 * Class Widget
 * @package metalguardian\dateTimePicker
 */
class Widget extends InputWidget
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        //if ($this->dateFormat === null) {
        //    $this->dateFormat = Yii::$app->formatter->dateFormat;
        //}
    }
}
