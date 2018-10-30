<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\SolicitudeHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\SolicitudeHelper Test Case
 */
class SolicitudeHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\SolicitudeHelper
     */
    public $Solicitude;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Solicitude = new SolicitudeHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Solicitude);

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
