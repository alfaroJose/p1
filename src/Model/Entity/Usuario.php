<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $correo
 * @property string $telefono
 * @property string $nombre_usuario
 * @property string $identificacion
 * @property string $tipo_identificacion
 * @property int $roles_id
 *
 * @property \App\Model\Entity\Role $role
 */
class Usuario extends Entity
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
        'nombre' => true,
        'primer_apellido' => true,
        'segundo_apellido' => true,
        'correo' => true,
        'telefono' => true,
        'nombre_usuario' => true,
        'identificacion' => true,
        'tipo_identificacion' => true,
        'roles_id' => true,
        'role' => true
    ];
}
