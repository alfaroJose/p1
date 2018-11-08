<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Tiene Entity
 *
 * @property int $solicitudes_id
 * @property int $requisitos_id
 * @property string $condicion
 *
 * @property \App\Model\Entity\Solicitude $solicitude
 * @property \App\Model\Entity\Requisito $requisito
 */
class Tiene extends Entity
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
        'condicion' => true,
        'solicitude' => true,
        'requisito' => true
    ];
}
