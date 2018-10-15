<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ronda Entity
 * @property int $id
 * @property int $numero
 * @property \Cake\I18n\FrozenDate $fecha_inicial
 * @property \Cake\I18n\FrozenDate $fecha_final
 */
class Ronda extends Entity
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
        'fecha_inicial' => true,
        'fecha_final' => true
    ];
}
