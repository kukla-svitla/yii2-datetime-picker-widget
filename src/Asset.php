<?php

namespace svitla\dateTimePicker;

use yii\web\AssetBundle;

/**
 * Class Asset
 * @package svitla\dateTimePicker
 */
class Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@bower/datetimepicker';

    /**
     * @inheritdoc
     */
    public $css = [
        'jquery.datetimepicker.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'build/jquery.datetimepicker.full.js',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
