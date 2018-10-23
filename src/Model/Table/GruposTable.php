<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

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
            ->requirePresence('numero', 'create')
            ->lengthBetween('numero', [1,2])
            ->notEmpty('numero', 'Por favor complete este campo.');

        $validator
            ->requirePresence('semestre', 'create')
            ->lengthBetween('semestre', [1,1])
            ->notEmpty('semestre', 'Por favor complete este campo.');

        $validator
            ->scalar('año')
            ->requirePresence('año', 'create')
            ->notEmpty('año', 'Por favor complete este campo.');

        $validator
            ->scalar('cursos_sigla')
            ->maxLength('cursos_sigla', 7, 'Incluya solamente 7 caracteres')
            ->requirePresence('cursos_sigla', 'create')
            ->notEmpty('cursos_sigla', 'Por favor complete este campo.');

        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        return $validator;
    }

    public function getIndexValues(){

        $index=$this->find()
        ->select(['Cursos.sigla','Cursos.nombre','Grupos.numero','Grupos.semestre','Grupos.año','Grupos.id'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.id=cursos_id']
            ]
        ])
        ->toList();
        return $index;
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

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function seleccionarCursos()
    {
        $cursos=$this->find()
        ->select(['Cursos.sigla'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.id=cursos_id']
            ]
        ])
        ->toList();
        return $cursos;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function seleccionarProfesores()
    {
        $profesores=$this->find()
        ->select(['Usuarios.nombre', 'Usuarios.primer_apellido'])
        ->join([
            'Usuarios'=>[
                     'table'=>'Usuarios',
                     'type'=>'LEFT',
                     'conditions'=>['Usuarios.id=usuarios_id', 'Usuarios.roles_id=3']
            ]
        ])
        ->toList();
        return $profesores;
    }
}