<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarios Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuariosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('usuarios');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'roles_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->scalar('id')
            ->maxLength('id', 50)
            ->requirePresence('id', 'create')
            ->notEmpty('id', 'Por favor complete este campo');

        $validator
            ->scalar('nombre')
            ->maxLength('nombre', 50)
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre', 'Por favor complete este campo');

        $validator
            ->scalar('primer_apellido')
            ->maxLength('primer_apellido', 50)
            ->requirePresence('primer_apellido', 'create')
            ->notEmpty('primer_apellido', 'Por favor complete este campo');

        $validator
            ->scalar('segundo_apellido')
            ->maxLength('segundo_apellido', 50)
            ->requirePresence('segundo_apellido', 'create')
            ->notEmpty('segundo_apellido', 'Por favor complete este campo');

        $validator
            ->scalar('correo')
            ->maxLength('correo', 100)
            ->requirePresence('correo', 'create')
            ->notEmpty('correo', 'Por favor complete este campo');

        $validator
            ->scalar('telefono')
            ->minLength('telefono', 8, 'Incluya solamente 8 dígitos')
            ->maxLength('telefono', 8, 'Incluya solamente 8 dígitos')
            ->requirePresence('telefono', 'create')
            ->notEmpty('telefono', 'Por favor complete este campo');

        $validator
            ->scalar('cedula')
            ->lengthBetween('cedula', [9, 15])
            ->requirePresence('cedula', 'create')
            ->notEmpty('cedula', 'Por favor complete este campo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['roles_id'], 'Roles'));

        return $rules;
    }
}   

