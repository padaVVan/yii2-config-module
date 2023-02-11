<?php

namespace padavvan\confbox\components;

use padavvan\confbox\models\Variable;
use yii\base\Component;

abstract class BaseProvider extends Component implements ProviderInterface
{
    public function __construct($config = [])
    {
        require(dirname(__DIR__) . '/config/main.php');
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $vars = $this->getAll();

        foreach ($vars as $var) {
            \Yii::$app->params[$var->getName()] = $var->getValue();
        }

        parent::init();
    }

    /**
     * Создает экземпляр переменной
     * @param string $variableName имя переменной
     * @param array $config конфигурация
     * @return Variable
     */
    public function createVariable($variableName, $config = [])
    {
        return new Variable($variableName, $config);
    }
}
