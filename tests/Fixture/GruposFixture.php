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
        'numero' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'semestre' => ['type' => 'tinyinteger', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'año' => ['type' => 'string', 'length' => null, 'null' => false, 'default' => null, 'collate' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cursos_sigla' => ['type' => 'string', 'fixed' => true, 'length' => 7, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'usuarios_id' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'cursos_sigla' => ['type' => 'index', 'columns' => ['cursos_sigla'], 'length' => []],
            'usuarios_id' => ['type' => 'index', 'columns' => ['usuarios_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['numero', 'semestre', 'año', 'cursos_sigla'], 'length' => []],
            'grupos_ibfk_1' => ['type' => 'foreign', 'columns' => ['cursos_sigla'], 'references' => ['cursos', 'sigla'], 'update' => 'cascade', 'delete' => 'noAction', 'length' => []],
            'grupos_ibfk_2' => ['type' => 'foreign', 'columns' => ['usuarios_id'], 'references' => ['usuarios', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
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
                'numero' => 1,
                'semestre' => 1,
                'año' => 'c7c8b558-18b0-4ef8-ae2d-202c949319b0',
                'cursos_sigla' => 'f832d8aa-a237-46d5-a28b-2a42ad93babb',
                'usuarios_id' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
