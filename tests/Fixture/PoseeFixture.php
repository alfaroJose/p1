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
        'permisos_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'roles_id' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'estado' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_Posee_permisos_id' => ['type' => 'index', 'columns' => ['permisos_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['roles_id', 'permisos_id'], 'length' => []],
            'FK_Posee_permisos_id' => ['type' => 'foreign', 'columns' => ['permisos_id'], 'references' => ['permisos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_Posee_roles_id' => ['type' => 'foreign', 'columns' => ['roles_id'], 'references' => ['roles', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'permisos_id' => 1,
                'roles_id' => 1,
                'estado' => 1
            ],
        ];
        parent::init();
    }
}
