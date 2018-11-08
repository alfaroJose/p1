<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TieneTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TieneTable Test Case
 */
class TieneTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TieneTable
     */
    public $Tiene;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tiene',
        'app.solicitudes',
        'app.requisitos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Tiene') ? [] : ['className' => TieneTable::class];
        $this->Tiene = TableRegistry::getTableLocator()->get('Tiene', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tiene);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
