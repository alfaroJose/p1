<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\ContadorHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\ContadorHelper Test Case
 */
class ContadorHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\ContadorHelper
     */
    public $Contador;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Contador = new ContadorHelper($view);
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
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
