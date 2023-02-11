<?php

namespace padavvan\confbox\components;

use padavvan\confbox\models\Variable;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\VarDumper;

class PhpProvider extends BaseProvider
{
    /**
     * Хранилище переменных
     * @var string
     */
    public $dumpFile = "@confbox-app/data/store.php";

    /**
     * Переменные
     * @var Variable[]
     */
    protected $variables = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->dumpFile = Yii::getAlias($this->dumpFile);
        $this->load();
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getAll()
    {
        return $this->variables;
    }

    /**
     * @inheritdoc
     */
    public function hasVariable($variableName)
    {
        return isset($this->variables[$variableName]);
    }

    /**
     * @inheritdoc
     */
    public function get($variableName)
    {
        $var = $this->getVariable($variableName);

        if ($var) {
            return $var->getValue();
        }
    }

    /**
     * @inheritdoc
     */
    public function getVariable($variableName)
    {
        return $this->hasVariable($variableName) ? $this->variables[$variableName] : null;
    }

    /**
     * @inheritdoc
     */
    public function set($variableName, $value)
    {
        $var = $this->getVariable($variableName);
        $var->value = $value;

        return $this->save();
    }

    /**
     * Загрузка и инициализация переменных
     */
    protected function load()
    {
        $this->variables = [];

        $variables = $this->loadFromFile($this->dumpFile);

        foreach ($variables as $name => $config) {
            $this->variables[$name] = $this->createVariable($name, $config);
        }
    }

    /**
     * Загрузка переменных из PHP файла
     *
     * @param string $file
     * @return array
     * @see saveToFile()
     */
    protected function loadFromFile($file)
    {
        if (is_file($file)) {
            return require($file);
        } else {
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $paramsToSave = [];
        $validate = 1;
        foreach ($this->variables as $name => $variable) {
            $variable->validate();

            $validate *= !$variable->hasErrors();
            $paramsToSave[$name] = $variable->attributes;
        }
        if ($validate) {
            return $this->saveToFile($paramsToSave, $this->dumpFile);
        }
        return false;
    }

    /**
     * Сохранение переменных в PHP файл
     *
     * @param array $data
     * @param string $file
     * @see loadFromFile()
     */
    protected function saveToFile($data, $file)
    {
        return (bool)file_put_contents($file, "<?php\nreturn " . VarDumper::export($data) . ";\n", LOCK_EX);
    }

    /**
     * @inheritdoc
     */
    public function addVariable(Variable $variable)
    {
        $this->variables[$variable->name] = $variable;
        return $this->save();
    }

    /**
     * @inheritdoc
     */
    public function removeVariable($variableName)
    {
        if ($this->hasVariable($variableName)) {
            unset($this->variables[$variableName]);
        }

        return $this->save() && $this->load();
    }
}
