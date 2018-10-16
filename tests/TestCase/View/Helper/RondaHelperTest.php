<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\RondaHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\RondaHelper Test Case
 */
class RondaHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\RondaHelper
     */
    public $Ronda;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Ronda = new RondaHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ronda);

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
