<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SolicitudesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SolicitudesTable Test Case
 */
class SolicitudesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SolicitudesTable
     */
    public $Solicitudes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.solicitudes',
        'app.usuarios',
        'app.grupos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Solicitudes') ? [] : ['className' => SolicitudesTable::class];
        $this->Solicitudes = TableRegistry::getTableLocator()->get('Solicitudes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Solicitudes);

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

    /**
     * Test getIndexValues method
     *
     * @return void
     */
    public function testGetIndexValues()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
