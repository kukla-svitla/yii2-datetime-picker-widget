<?php

namespace metalguardian\dateTimePicker;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\widgets\InputWidget;

/**
 * Class Widget
 * @package metalguardian\dateTimePicker
 */
class Widget extends InputWidget
{
    /** date picker mode */
    const MODE_DATE = 1;
    /** time picker mode */
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
     * @var array the languages supported by widget
     */
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

    /**
     * @var array the array of the default widget params
     */
    protected $defaults = [
        'scrollMonth' => false,
        'scrollInput' => false,
        'dayOfWeekStart' => 1,
        'format' => 'Y-m-d H:i:00',
        'formatDate' => 'Y-m-d',
        'formatTime' => 'H:i:00',
        'lang' => 'en',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->mode === static::MODE_DATE) {
            $this->defaults['timepicker'] = false;
            $this->defaults['format'] = $this->defaults['formatDate'];
        } elseif ($this->mode === static::MODE_TIME) {
            $this->defaults['datepicker'] = false;
            $this->defaults['format'] = $this->defaults['formatTime'];
        }

        // set defaults
        $this->clientOptions = ArrayHelper::merge(
            $this->defaults,
            $this->clientOptions
        );

        if ($this->language && $this->isAcceptedLanguage($this->language)) {
            $this->clientOptions['lang'] = $this->language;
        } elseif ($this->isAcceptedLanguage(Yii::$app->language)) {
            $this->clientOptions['lang'] = Yii::$app->language;
        }
    }

    /**
     * Renders the widget.
     */
    public function run()
    {
        if ($this->hasModel()) {
            $input = Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            $input = Html::textInput($this->name, $this->value, $this->options);
        }

        echo $input;

        $this->registerJs();
    }

    /**
     * @param string $language the language ID
     * @return bool is accepted language
     */
    protected function isAcceptedLanguage($language)
    {
        return in_array($language, $this->languages, true);
    }

    public function registerJs($position = View::POS_READY, $key = null)
    {
        $id = $this->options['id'];

        $view = $this->getView();
        Asset::register($view);

        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#{$id}').datetimepicker({$options});";
        $view->registerJs($js, $position, $key);
    }
}
