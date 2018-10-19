<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PoseeFixture
 *
 */
class PoseeFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'posee';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'permisos_modulo' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'permisos_funcionalidad' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'roles_id' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'estado' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'roles_id' => ['type' => 'index', 'columns' => ['roles_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['permisos_modulo', 'permisos_funcionalidad', 'roles_id'], 'length' => []],
            'posee_ibfk_1' => ['type' => 'foreign', 'columns' => ['permisos_modulo', 'permisos_funcionalidad'], 'references' => ['permisos', '1' => ['modulo', 'funcionalidad']], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'posee_ibfk_2' => ['type' => 'foreign', 'columns' => ['roles_id'], 'references' => ['roles', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'permisos_modulo' => '51dc9691-28fd-4c32-ad14-f66d465133a6',
                'permisos_funcionalidad' => '292f90a7-a28d-49c4-b52c-260294b938b7',
                'roles_id' => 1,
                'estado' => 1
            ],
        ];
        parent::init();
    }
}
