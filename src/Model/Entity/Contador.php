<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Contador Entity
 *
 * @property int $id
 * @property int $horas_asistente
 * @property int $horas_estudiante_ecci
 * @property int $horas_estudiante_docente
 */
class Contador extends Entity
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
        'horas_asistente' => true,
        'horas_estudiante_ecci' => true,
        'horas_estudiante_docente' => true
    ];
}
