<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Contador Model
 *
 * @method \App\Model\Entity\Contador get($primaryKey, $options = [])
 * @method \App\Model\Entity\Contador newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Contador[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Contador|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contador|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Contador patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Contador[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Contador findOrCreate($search, callable $callback = null, $options = [])
 */
class ContadorTable extends Table
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

        $this->setTable('contador');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->integer('horas_asistente')
            ->requirePresence('horas_asistente', 'create')
            ->notEmpty('horas_asistente');

        $validator
            ->integer('horas_estudiante_ecci')
            ->requirePresence('horas_estudiante_ecci', 'create')
            ->notEmpty('horas_estudiante_ecci');

        $validator
            ->integer('horas_estudiante_docente')
            ->requirePresence('horas_estudiante_docente', 'create')
            ->notEmpty('horas_estudiante_docente');

        return $validator;
    }

    public function getContador(){
        $connect = ConnectionManager::get('default');
        $fila = $connect->execute("select * from contador")->fetchAll();
        return $fila[0];
    }
}
