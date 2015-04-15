<?php

namespace yiiunit\picker;

use metalguardian\dateTimePicker\Widget;
use yii\web\View;
use yiiunit\models\Post;
use yiiunit\TestCase;

class PickerTest extends TestCase
{

    public function testModel()
    {
        $model = new Post();
        $model->posted = '2015-05-01 10:20:00';
        $out = Widget::widget([
            'model' => $model,
            'attribute' => 'posted',
        ]);
        $expected = '<input type="text" id="post-posted" name="Post[posted]" value="2015-05-01 10:20:00">';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testNameAndValue()
    {
        $out = Widget::widget([
            'id' => 'test-calendar',
            'name' => 'specific-name',
            'value' => '2015-05-01 10:20:00',
        ]);
        $expected = '<input type="text" id="test-calendar" name="specific-name" value="2015-05-01 10:20:00">';

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testLanguage()
    {
        $model = new Post();
        $model->posted = '2015-05-01 10:20:00';
        $out = Widget::widget([
            'model' => $model,
            'attribute' => 'posted',
            'language' => 'ru',
        ]);
        $expected = '<input type="text" id="post-posted" name="Post[posted]" value="2015-05-01 10:20:00">';

        $this->assertEqualsWithoutLE($expected, $out);

        \Yii::$app->language = 'ru';
        $out = Widget::widget([
            'model' => $model,
            'attribute' => 'posted',
        ]);

        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testMode()
    {
        $model = new Post();
        $model->posted = '2015-05-01 10:20:00';
        $out = Widget::widget([
            'model' => $model,
            'attribute' => 'posted',
            'language' => 'ru',
            'mode' => Widget::MODE_DATE,
        ]);
        $expected = '<input type="text" id="post-posted" name="Post[posted]" value="2015-05-01 10:20:00">';

        $this->assertEqualsWithoutLE($expected, $out);

        $out = Widget::widget([
            'model' => $model,
            'attribute' => 'posted',
            'language' => 'ru',
            'mode' => Widget::MODE_TIME,
        ]);
        $this->assertEqualsWithoutLE($expected, $out);
    }

    public function testDateTimePickerRegisterPluginScriptMethod()
    {
        $model = new Post();
        $model->posted = '2015-05-01 10:20:00';
        $widget = Widget::begin([
            'model' => $model,
            'attribute' => 'posted',
            'language' => 'ru',
            'mode' => Widget::MODE_DATE,
        ]);

        $view = $this->getView();
        $widget->setView($view);
        $widget->registerJs(View::POS_READY, 'datetime-widget');

        $test = <<<JS
jQuery('#post-posted').datetimepicker({"scrollMonth":false,"scrollInput":false,"dayOfWeekStart":1,"format":"Y-m-d H:i:s","formatDate":"Y-m-d","formatTime":"H:i:s","lang":"ru","timepicker":false,"datepicker":true});
JS;
        $this->assertEquals($test, $view->js[View::POS_READY]['datetime-widget']);
    }
}
