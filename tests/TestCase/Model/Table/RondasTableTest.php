<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RondasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RondasTable Test Case
 */
class RondasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RondasTable
     */
    public $Rondas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rondas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Rondas') ? [] : ['className' => RondasTable::class];
        $this->Rondas = TableRegistry::getTableLocator()->get('Rondas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rondas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
