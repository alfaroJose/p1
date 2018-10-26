<?php
namespace App\Model\Table;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
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
            'foreignKey' => 'roles_id',
            'joinType' => 'INNER'
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
            ->integer('id')
            ->allowEmpty('id', 'create');
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
            ->allowEmpty('segundo_apellido');
        $validator
            ->scalar('correo')
            ->maxLength('correo', 100)
            ->requirePresence('correo', 'create')
            ->notEmpty('correo', 'Por favor complete este campo')
            ->add('correo', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->scalar('telefono')
            ->minLength('telefono', 8, 'Incluya al menos 8 dígitos')
            ->maxLength('telefono', 20, 'Incluya máximo 20 dígitos')
            ->requirePresence('telefono', 'create')
            ->notEmpty('telefono', 'Por favor complete este campo');
        $validator
            ->scalar('nombre_usuario')
            ->maxLength('nombre_usuario', 50)
            ->requirePresence('nombre_usuario', 'create')
            ->notEmpty('nombre_usuario', 'Por favor complete este campo')
            ->add('nombre_usuario', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->scalar('identificacion')            
            ->maxLength('identificacion', 15, 'Incluya máximo 15 caracteres')
            ->requirePresence('identificacion', 'create')
            ->notEmpty('identificacion', 'Por favor complete este campo')
            ->add('identificacion', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);
        $validator
            ->scalar('tipo_identificacion')
            ->maxLength('tipo_identificacion', 17)
            ->requirePresence('tipo_identificacion', 'create')
            ->notEmpty('tipo_identificacion', 'Por favor complete este campo');
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
        $rules->add($rules->isUnique(['correo']));
        $rules->add($rules->isUnique(['nombre_usuario']));
        $rules->add($rules->isUnique(['identificacion']));
        $rules->add($rules->existsIn(['roles_id'], 'Roles'));
        return $rules;
    }
    // Devuelva el id del usuario según el carné
    public function getUser($carne){
        $connect = ConnectionManager::get('default');
        $fila = $connect->execute("select id from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll();
        return $fila[0];
    }
    // Devuelva el rol del usuario según el carné
    public function getRol($carne){
        $connect = ConnectionManager::get('default');
        $fila = $connect->execute("select roles_id from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll();
        return $fila[0];
    }
}