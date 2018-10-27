<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\GruposHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\GruposHelper Test Case
 */
class GruposHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\GruposHelper
     */
    public $Grupos;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Grupos = new GruposHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Grupos);

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
