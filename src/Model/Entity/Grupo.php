<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Grupo Entity
 *
 * @property int $numero
 * @property int $semestre
 * @property string $año
 * @property string $cursos_sigla
 * @property string $usuarios_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 */
class Grupo extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'numero' => true,
        'semestre' => true,
        'año' => true,
        'curso_sigla' => true,
        'usuarios_id' => true,
        'usuario' => true

    ];
}
