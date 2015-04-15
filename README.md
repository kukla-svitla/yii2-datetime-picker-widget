Yii2 date and time picker
========================================================================

This yii2 extension is a wrapper for the powerful [jQuery date-time picker](https://github.com/xdan/datetimepicker)

[![Latest Stable Version](https://poser.pugx.org/metalguardian/yii2-datetime-picker-widget/v/stable.svg)](https://packagist.org/packages/metalguardian/yii2-datetime-picker-widget)
[![Total Downloads](https://poser.pugx.org/metalguardian/yii2-datetime-picker-widget/downloads.svg)](https://packagist.org/packages/metalguardian/yii2-datetime-picker-widget)
[![Latest Unstable Version](https://poser.pugx.org/metalguardian/yii2-datetime-picker-widget/v/unstable.svg)](https://packagist.org/packages/metalguardian/yii2-datetime-picker-widget)
[![License](https://poser.pugx.org/metalguardian/yii2-datetime-picker-widget/license.svg)](https://packagist.org/packages/metalguardian/yii2-datetime-picker-widget)

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MetalGuardian/yii2-datetime-picker-widget/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MetalGuardian/yii2-datetime-picker-widget/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/MetalGuardian/yii2-datetime-picker-widget/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/MetalGuardian/yii2-datetime-picker-widget/?branch=master)
[![Build Status](https://travis-ci.org/MetalGuardian/yii2-datetime-picker-widget.svg?branch=master)](https://travis-ci.org/MetalGuardian/yii2-datetime-picker-widget)
[![Code Climate](https://codeclimate.com/github/MetalGuardian/yii2-datetime-picker-widget/badges/gpa.svg)](https://codeclimate.com/github/MetalGuardian/yii2-datetime-picker-widget)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist metalguardian/yii2-datetime-picker-widget "*"
```

or add

```
"metalguardian/yii2-datetime-picker-widget": "*"
```

to the require section of your `composer.json` file.


Usage
-----

This widget renders a input control with datetime picker.

You can use is like a separate widget or with `ActiveField` instance.

```php

<?= \metalguardian\dateTimePicker\Widget::widget([

    // you need specify model and attribute

    'model' => $model,
    'attribute' => 'posted',

    // or name of the input and value (if needed)

    //'value' => '2016/01/22 18:26',
    //'name' => 'specific-name',

    'mode' => \metalguardian\dateTimePicker\Widget::MODE_DATE,
    // for only date picker
    // or \metalguardian\dateTimePicker\Widget::MODE_TIME for time picker
    // default is datetime picker

    'language' => 'ru',
    'options' => [ // html options of the input
        'class' => 'my-class',
    ],
    'clientOptions' => [
        'theme' => 'dark',
        'minDate' => '05.12.2013',
        'formatDate' => 'd.m.Y',
    ]
]) ?>

<?= $form->field($model, 'start_time')->widget(\metalguardian\dateTimePicker\Widget::className(), [
    'language' => 'ru',
    'mode' => \metalguardian\dateTimePicker\Widget::MODE_TIME,
    'options' => [
        'class' => 'my-class',
    ],
    'clientOptions' => [
        'theme' => 'dark',
        'minDate' => '05.12.2013',
        'formatDate' => 'd.m.Y',
    ]
]) ?>
```

License
-------

**yii2-datetime-picker-widget** is released under the MIT License. See the bundled `LICENSE` for details.
