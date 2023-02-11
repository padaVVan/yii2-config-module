<?php

class UnitTest extends \yii\codeception\TestCase
{
    /**
     * @var padavvan\confbox\backend\models\Variable
     */
    public $component;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function setUp()
    {
        parent::setUp();

        $this->component = new \padavvan\confbox\components\PhpProvider([
            'dumpFile' => '@confbox-app/data/test.php'
        ]);
    }

    // tests
    public function testCreateWrongVariable()
    {
        $var = $this->component->createVariable('');
        $this->assertFalse($var->validate());
    }

    public function testCreateCorrectVariable()
    {
        $var = $this->component->createVariable('var');
        $this->assertTrue($var->validate());
    }

    public function testSaveVariables()
    {
        $var = $this->component->createVariable('var');
        $this->assertTrue($this->component->addVariable($var));
    }

    public function testLoadVariables()
    {
        $this->component->init();
        $this->assertTrue($this->component->hasVariable('var'));
    }

    public function testSetValue()
    {
        $this->assertTrue($this->component->set('var', 1));
        $this->assertEquals($this->component->get('var'), 1);
    }

    public function testDefaultValidator()
    {
        $var = $this->component->getVariable('var');
        $var->default = 'default value';
        $this->component->set('var', null);

        $this->assertEquals('default value', $this->component->get('var'));
    }

    public function testValidator()
    {
        $var = $this->component->getVariable('var');
        $var->rules = [
            ['value', 'email']
        ];

        $this->component->set('var', 'not email');
        $this->assertFalse($var->validate());

        $this->component->set('var', 'email@domain.com');
        $this->assertTrue($var->validate());
    }

    public function testGetAllVariables()
    {
        $var1 = $this->component->createVariable('var1');
        $this->component->addVariable($var1);

        $vars = $this->component->getAll();
        $this->assertCount(2, $vars);

        $var2 = $this->component->createVariable('var2');
        $this->component->addVariable($var2);

        $vars = $this->component->getAll();
        $this->assertCount(3, $vars);
    }

    public function testRemoveVariable()
    {
        $comp = $this->component;
        $comp->removeVariable('var');
        $this->assertFalse($comp->hasVariable('var'));
    }

    public function testEnd()
    {
        @unlink($this->component->dumpFile);
    }
}
