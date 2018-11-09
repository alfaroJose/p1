<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tiene Model
 *
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\BelongsTo $Solicitudes
 * @property \App\Model\Table\RequisitosTable|\Cake\ORM\Association\BelongsTo $Requisitos
 *
 * @method \App\Model\Entity\Tiene get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tiene newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Tiene[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tiene|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tiene|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tiene patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tiene[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tiene findOrCreate($search, callable $callback = null, $options = [])
 */
class TieneTable extends Table
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

        $this->setTable('tiene');
        $this->setDisplayField('solicitudes_id');
        $this->setPrimaryKey(['solicitudes_id', 'requisitos_id']);

        $this->belongsTo('Solicitudes', [
            'foreignKey' => 'solicitudes_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Requisitos', [
            'foreignKey' => 'requisitos_id',
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
            ->scalar('condicion')
            ->maxLength('condicion', 6)
            ->allowEmpty('condicion');

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
        $rules->add($rules->existsIn(['solicitudes_id'], 'Solicitudes'));
        $rules->add($rules->existsIn(['requisitos_id'], 'Requisitos'));

        return $rules;
    }
}
