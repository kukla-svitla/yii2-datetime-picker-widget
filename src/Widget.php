<?php

namespace metalguardian\dateTimePicker;

use Yii;
use yii\base\InvalidParamException;
use yii\helpers\FormatConverter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Class Widget
 * @package metalguardian\dateTimePicker
 */
class Widget extends InputWidget
{
    const MODE_DATE = 1;
    const MODE_TIME = 2;

    /**
     * @var int the mode of the picker: time or date picker. default datetime picker
     */
    public $mode;

    /**
     * @var string the language ID (e.g. 'fr', 'de', 'en-GB') for the language to be used by the datetime picker.
     * If this property is empty, then the current application language will be used.
     */
    public $language;

    /**
     * @var array the options for the datetime picker widget.
     * Please refer to the corresponding [jQuery date-time picker page](http://xdsoft.net/jqplugins/datetimepicker/)
     * for possible options.
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    protected $languages = [
        'ar',
        'az',
        'bg',
        'bs',
        'ca',
        'ch',
        'cs',
        'da',
        'de',
        'el',
        'en',
        'en-GB',
        'es',
        'et',
        'eu',
        'fa',
        'fi',
        'fr',
        'gl',
        'he',
        'hr',
        'hu',
        'id',
        'it',
        'ja',
        'ko',
        'kr',
        'lt',
        'lv',
        'mk',
        'mn',
        'nl',
        'no',
        'pl',
        'pt',
        'pt-BR',
        'ro',
        'ru',
        'se',
        'sk',
        'sl',
        'sq',
        'sr',
        'sr-YU',
        'sv',
        'th',
        'tr',
        'uk',
        'vi',
        'zh',
        'zh-TW',
    ];

    protected $fallbackLanguage = 'en';

    /**
     * Renders the widget.
     */
    public function run()
    {
        echo $this->renderWidget() . "\n";

        $containerID = $this->options['id'];

        $language = $this->language ? $this->language : Yii::$app->language;
        if ($this->isAcceptedLanguage($language)) {
            $this->clientOptions['lang'] = $language;
        } else {
            $this->clientOptions['lang'] = $this->fallbackLanguage;
        }

        $timePicker = true;
        $datePicker = true;
        if ($this->mode === static::MODE_DATE) {
            $timePicker = false;
        } elseif ($this->mode === static::MODE_TIME) {
            $datePicker = false;
        }
        $this->clientOptions['timepicker'] = $timePicker;
        $this->clientOptions['datepicker'] = $datePicker;

        $view = $this->getView();
        Asset::register($view);

        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#{$containerID}').datetimepicker({$options});";
        $view->registerJs($js);
    }

    /**
     * Renders the DateTimePicker widget.
     * @return string the rendering result.
     */
    protected function renderWidget()
    {
        // get formatted date value
        if ($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }
        $options = $this->options;

        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $options);
        } else {
            $input = Html::textInput($this->name, $value, $options);
        }

        return $input;
    }

    /**
     * @param string $language the language ID
     * @return bool is accepted language
     */
    protected function isAcceptedLanguage($language)
    {
        return in_array($language, $this->languages, true);
    }
}
