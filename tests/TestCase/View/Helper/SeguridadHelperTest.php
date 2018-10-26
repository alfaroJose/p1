<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\SeguridadHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SeguridadHelper Test Case
 */
class SeguridadHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\SeguridadHelper
     */
    public $Seguridad;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Seguridad = new SeguridadHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Seguridad);

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
