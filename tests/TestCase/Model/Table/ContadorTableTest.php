<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContadorTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContadorTable Test Case
 */
class ContadorTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContadorTable
     */
    public $Contador;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contador'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Contador') ? [] : ['className' => ContadorTable::class];
        $this->Contador = TableRegistry::getTableLocator()->get('Contador', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contador);

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
