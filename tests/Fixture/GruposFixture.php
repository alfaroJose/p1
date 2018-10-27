<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GruposFixture
 *
 */
class GruposFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'numero' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'semestre' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'año' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cursos_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'usuarios_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'FK_Grupos_cursos_id' => ['type' => 'index', 'columns' => ['cursos_id'], 'length' => []],
            'FK_Grupos_usuarios_id' => ['type' => 'index', 'columns' => ['usuarios_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'UQ_Grupos_numero_semestre_año_cursos_id' => ['type' => 'unique', 'columns' => ['numero', 'semestre', 'año', 'cursos_id'], 'length' => []],
            'FK_Grupos_cursos_id' => ['type' => 'foreign', 'columns' => ['cursos_id'], 'references' => ['cursos', 'id'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'FK_Grupos_usuarios_id' => ['type' => 'foreign', 'columns' => ['usuarios_id'], 'references' => ['usuarios', 'id'], 'update' => 'cascade', 'delete' => 'setNull', 'length' => []],
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
                'id' => 1,
                'numero' => 1,
                'semestre' => 1,
                'año' => 'Lorem ipsum dolor sit amet',
                'cursos_id' => 1,
                'usuarios_id' => 1
            ],
        ];
        parent::init();
    }
}
