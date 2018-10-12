<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Grupos Model
 *
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 *
 * @method \App\Model\Entity\Grupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grupo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Grupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grupo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grupo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grupo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grupo findOrCreate($search, callable $callback = null, $options = [])
 */
class GruposTable extends Table
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

        $this->setTable('grupos');
        $this->setDisplayField('numero');
        $this->setPrimaryKey(['numero', 'semestre', 'año', 'cursos_sigla']);

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuarios_id'
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
            ->allowEmpty('numero', 'create');

        $validator
            ->allowEmpty('semestre', 'create');

        $validator
            ->scalar('año')
            ->allowEmpty('año', 'create');

        $validator
            ->scalar('cursos_sigla')
            ->maxLength('cursos_sigla', 7)
            ->allowEmpty('cursos_sigla', 'create');

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
        $rules->add($rules->existsIn(['usuarios_id'], 'Usuarios'));

        return $rules;
    }



    public function getIndexValues(){

        $index=$this->find()
        ->select(['Cursos.sigla','Cursos.nombre','Grupos.numero','Grupos.semestre','Grupos.año'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.sigla=cursos_sigla']
            ]
        ])
        ->toList();
        return $index;
        /*debug($index);
        die();*/

    }

    public function deleteValues($curso_sigla = null, $numero = null, $semestre = null, $año = null){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("DELETE FROM grupos WHERE curso_sigla = '$curso_sigla' AND numero = $numero AND semestre = $semestre AND año = '$año'");
    }
    //https://book.cakephp.org/3.0/en/orm/database-basics.html

    public function viewValues($id = null, $numero = null, $semestre = null, $año = null){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("UPDATE FROM grupos WHERE curso_sigla = '$id' AND numero = $numero AND semestre = $semestre AND año = '$año'");
    }
}
