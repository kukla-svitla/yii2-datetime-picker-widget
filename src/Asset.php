<?php
/**
 * Created by PhpStorm.
 * User: metal
 * Date: 14.04.15
 * Time: 16:42
 */

namespace metalguardian\dateTimePicker;


use yii\web\AssetBundle;

/**
 * Class Asset
 * @package metalguardian\dateTimePicker
 */
class Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/bower/datetimepicker';

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
