<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TieneFixture
 *
 */
class TieneFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'tiene';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'solicitudes_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'requisitos_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'condicion' => ['type' => 'string', 'length' => 6, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'FK_Tiene_requisitos_id' => ['type' => 'index', 'columns' => ['requisitos_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['solicitudes_id', 'requisitos_id'], 'length' => []],
            'UQ_Tiene_solicitudes_id_requisitos_id' => ['type' => 'unique', 'columns' => ['solicitudes_id', 'requisitos_id'], 'length' => []],
            'FK_Tiene_requisitos_id' => ['type' => 'foreign', 'columns' => ['requisitos_id'], 'references' => ['requisitos', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'FK_Tiene_solicitudes_id' => ['type' => 'foreign', 'columns' => ['solicitudes_id'], 'references' => ['solicitudes', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'solicitudes_id' => 1,
                'requisitos_id' => 1,
                'condicion' => 'Lore'
            ],
        ];
        parent::init();
    }
}
