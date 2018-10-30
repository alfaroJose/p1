<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PoseeTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PoseeTable Test Case
 */
class PoseeTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PoseeTable
     */
    public $Posee;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.posee',
        'app.permisos',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Posee') ? [] : ['className' => PoseeTable::class];
        $this->Posee = TableRegistry::getTableLocator()->get('Posee', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Posee);

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
