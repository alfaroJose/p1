<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\CursosHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\CursosHelper Test Case
 */
class CursosHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\CursosHelper
     */
    public $Cursos;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Cursos = new CursosHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cursos);

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
