<?php

namespace padavvan\confbox\models;

use yii\base\Model;

class Variable extends Model
{
    /**
     * Наименование
     * @var string
     */
    private $_name;

    /**
     * Лэйбл переменной
     * @var string
     */
    public $label;

    /**
     * Группа
     * @var string
     */
    public $group;

    /**
     * Значение
     * @var mixed
     */
    public $value;

    /**
     * Значение по умолчанию
     * @var mixed
     */
    public $default;

    /**
     * Правила валидации
     * @var array
     */
    public $rules = [];

    /**
     * Тип переменной
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $placeholder;

    /**
     * Подсказка
     * @var string
     */
    public $hint;

    /**
     * Данные
     * @var array
     */
    public $data = [];

    /**
     * Тип по цмолчанию
     * @var string
     */
    private $_defaultType = 'string';

    /**
     * @param string $variableName наименование переменной
     * @param array $config конфигурация
     */
    public function __construct($variableName, $config = [])
    {
        parent::__construct($config);
        $this->_name = (string)$variableName;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Возвращает значение переменной
     * @return mixed
     */
    public function getValue()
    {
        switch ($this->type) {
            case 'select':
                return $this->data[$this->value];
            case 'string':
            case 'mail':
            case 'text':
            case 'numeric':
            default:
                return $this->value;
        }
    }

    /**
     * @param string $defaultType
     */
    public function setDefaultType($defaultType)
    {
        $this->_defaultType = $defaultType;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = array_merge(
            [
                ['type', 'default', 'value' => $this->_defaultType],
                ['name', 'required'],
                ['name', 'string', 'min' => 2, 'max' => 20]
            ],
            (array)$this->rules
        );

        if (!empty($this->default)) {
            array_unshift($rules, ['value', 'default', 'value' => $this->default]);
        }

        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ['value' => $this->label];
    }
}
