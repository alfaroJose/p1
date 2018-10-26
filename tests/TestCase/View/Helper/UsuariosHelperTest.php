<?php
namespace App\Test\TestCase\View\Helper;

use App\View\Helper\UsuariosHelper;
use Cake\TestSuite\TestCase;
use Cake\View\View;

/**
 * App\View\Helper\UsuariosHelper Test Case
 */
class UsuariosHelperTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\View\Helper\UsuariosHelper
     */
    public $Usuarios;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $view = new View();
        $this->Usuarios = new UsuariosHelper($view);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Usuarios);

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
