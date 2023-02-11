<?php

namespace padavvan\confbox\components;

use padavvan\confbox\models\Variable;

interface ProviderInterface
{
    /**
     * @param string $variableName наименование переменной
     * @return Variable
     */
    public function hasVariable($variableName);

    /**
     * Возвращает значение переменной
     * @param $variableName string
     * @return mixed
     */
    public function get($variableName);

    /**
     * Возвращает переменную
     * @param string $variableName наименование переменной
     * @return Variable
     */
    public function getVariable($variableName);

    /**
     * @return \padavvan\confbox\models\Variable[]
     */
    public function getAll();

    /**
     * @param string $variableName наименование переменной
     * @param mixed $value значение переменной
     * @return bool
     */
    public function set($variableName, $value);

    /**
     * @param Variable $variable
     * @return bool
     */
    public function addVariable(Variable $variable);

    /**
     * @param string $variableName наименование переменной
     * @return bool
     */
    public function removeVariable($variableName);

    /**
     * @param string $variableName наименование переменной
     * @param array $config конфигурация переменной
     * @return Variable
     */
    public function createVariable($variableName, $config);

    /**
     * Сохранение переменных
     * @return bool
     */
    public function save();
}
