<?php

namespace yiiunit\picker;

use metalguardian\dateTimePicker\Asset;
use yii\web\AssetBundle;
use yiiunit\TestCase;

class AssetTest extends TestCase
{
    public function testRegister()
    {
        $view = $this->getView();
        $this->assertEmpty($view->assetBundles);
        Asset::register($view);
        $this->assertEquals(2, count($view->assetBundles));
        $this->assertArrayHasKey('yii\\web\\JqueryAsset', $view->assetBundles);
        $this->assertTrue($view->assetBundles['metalguardian\dateTimePicker\Asset'] instanceof AssetBundle);
        $content = $view->renderFile('@yiiunit/views/rawlayout.php');
        $this->assertContains('jquery.datetimepicker.css', $content);
        $this->assertContains('jquery.js', $content);
        $this->assertContains('jquery.datetimepicker.js', $content);
    }
}
