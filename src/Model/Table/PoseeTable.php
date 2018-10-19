<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posee Model
 *
 * @property \App\Model\Table\RolesTable|\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \App\Model\Entity\Posee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Posee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Posee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Posee|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Posee|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Posee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Posee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Posee findOrCreate($search, callable $callback = null, $options = [])
 */
class PoseeTable extends Table
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

        $this->setTable('posee');
        $this->setDisplayField('permisos_modulo');
        $this->setPrimaryKey(['permisos_modulo', 'permisos_funcionalidad', 'roles_id']);

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
            ->scalar('permisos_modulo')
            ->maxLength('permisos_modulo', 50)
            ->allowEmpty('permisos_modulo', 'create');

        $validator
            ->scalar('permisos_funcionalidad')
            ->maxLength('permisos_funcionalidad', 50)
            ->allowEmpty('permisos_funcionalidad', 'create');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

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
