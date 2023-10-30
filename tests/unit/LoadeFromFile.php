<?php

declare(strict_types=1);

class LoadFromFileTest extends \yii\codeception\TestCase
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
            'dumpFile' => '@confbox-app/data/exist-data.php'
        ]);
    }

    // tests
    public function testLoadVariable()
    {
        $var = $this->component->createVariable('test-var');
        $this->assertTrue($var->validate());
    }
}
