<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Solicitude Entity
 *
 * @property int $id
 * @property string $carrera
 * @property float $promedio
 * @property int $cantidad_horas
 * @property string $estado
 * @property string $asistencia_externa
 * @property int $cantidad_horas_externa
 * @property \Cake\I18n\FrozenDate $fecha
 * @property string $justificación
 * @property int $ronda
 * @property int $usuarios_id
 * @property int $grupos_id
 * @property string $horas_asistente
 * @property string $horas_estudiante
 * @property string $horas_asistente_externa
 * @property string $horas_estudiante_externa
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Grupo $grupo
 */
class Solicitude extends Entity
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
        'carrera' => true,
        'promedio' => true,
        'cantidad_horas' => true,
        'estado' => true,
        'asistencia_externa' => true,
        'cantidad_horas_externa' => true,
        'fecha' => true,
        'justificación' => true,
        'ronda' => true,
        'usuarios_id' => true,
        'grupos_id' => true,
        'horas_asistente' => true,
        'horas_estudiante' => true,
        'horas_asistente_externa' => true,
        'horas_estudiante_externa' => true,
        'usuario' => true,
        'grupo' => true
    ];
}
