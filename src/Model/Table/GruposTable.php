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
            ->lengthBetween('numero', [1,2], 'Incluya solamente 1 o 2 caracteres')
            ->notEmpty('numero', 'Por favor complete este campo.');

        $validator
            ->requirePresence('semestre', 'create')
            ->lengthBetween('semestre', [1,1], 'Incluya solamente 1 caracter')
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
        ->select(['Cursos.sigla','Cursos.nombre','Cursos.id','Grupos.numero','Grupos.semestre','Grupos.año','Grupos.id','Usuarios.id'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.id=cursos_id']
            ]
        ])
        ->join([
        'Usuarios'=>[
                     'table'=>'Usuarios',
                     'type'=>'LEFT',
                     'conditions'=>['Usuarios.id=usuarios_id', 'Usuarios.roles_id=3']
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
    public function seleccionarCurso()
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



        /*Función para obtener los datos de un curso para poder modificarlos*/
        /**
     * Función para obtener directamente desde la base de datos una tupla de grupos
     *
     * @param string|null $curso_sigla Grupo llave foranea cursos_sigla, parte de la llave compuesta.
     * @param string|null $numero Grupo numero, parte de la llave compuesta.
     * @param string|null $semestre Grupo semestre, parte de la llave compuesta.
     * @param string|null $año Grupo año, parte de la llave compuesta.
     * @return true si la operación es exitosa
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function obtenerCursos($id = null){
        $connect = ConnectionManager::get('default');
        $sigla = $connect->execute("select distinct sigla from cursos, grupos where cursos.id = '".$id."'")->fetchAll();
        return $sigla;
    }

    public function obtenerProfesor($id = null){
        $connect = ConnectionManager::get('default');
        $profesor = $connect->execute("select distinct correo from usuarios, grupos where usuarios.id = '".$id."'")->fetchAll();
        return $profesor;
    }

    public function obtenerDatosCurso($id = null){

        $datos=$this->find()
        ->select(['Cursos.sigla'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.id=id']
            ]
        ])
        ->where([
          'cursos_id' => $id])
        ->toList();
        return $datos;
    }

}



