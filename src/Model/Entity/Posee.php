<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Posee Entity
 *
 * @property int $permisos_id
 * @property int $roles_id
 * @property int $estado
 *
 * @property \App\Model\Entity\Permiso $permiso
 * @property \App\Model\Entity\Role $role
 */
class Posee extends Entity
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
        'estado' => true,
        'permiso' => true,
        'role' => true
    ];
}
