<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Rondas Model
 *
 * @method \App\Model\Entity\Ronda get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ronda newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ronda[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ronda|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ronda|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ronda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ronda[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ronda findOrCreate($search, callable $callback = null, $options = [])
 */
class RondasTable extends Table
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

        $this->setTable('rondas');
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
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('numero');

        $validator
            ->date('fecha_inicial')
            ->requirePresence('fecha_inicial', 'create')
            ->notEmpty('fecha_inicial');

        $validator
            ->date('fecha_final')
            ->requirePresence('fecha_final', 'create')
            ->notEmpty('fecha_final');

        return $validator;
    }

    // Devuelva la fila de la tabla de rondas
    public function getFila(){
        $connect = ConnectionManager::get('default');
        $fila = $connect->execute("select * from rondas")->fetchAll();
        return $fila[0];
    }
}
