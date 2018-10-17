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


    /**
     * Realiza una operación de join en la base de datos con las tablas cursos y grupos
     * y devuelve el resultado en forma de arreglo
     *
     * @return un arreglo con los datos del join
     */
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

    }

    /**
     * Modifica directamente desde la base de datos una tupla de grupos
     *
     * @param string|null $curso_sigla Grupo llave foranea cursos_sigla, parte de la llave compuesta.
     * @param string|null $numero Grupo numero, parte de la llave compuesta.
     * @param string|null $semestre Grupo semestre, parte de la llave compuesta.
     * @param string|null $año Grupo año, parte de la llave compuesta.
     * @return true si la operación es exitosa
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function updateValues(  $curso_sigla = null, $numero = null, $semestre = null, $año = null, $num = null, $sem = null, $a = null){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("UPDATE grupos set numero = $num, semestre = $sem, año = $a WHERE cursos_sigla = '$curso_sigla' and numero = $numero and semestre = $semestre and año = $año");
        return $results;;
    }


    /**
     * Borra directamente desde la base de datos una tupla de grupos
     *
     * @param string|null $numero Grupo numero, parte de la llave compuesta.
     * @param string|null $semestre Grupo semestre, parte de la llave compuesta.
     * @param string|null $año Grupo año, parte de la llave compuesta.
     * @param string|null $curso_sigla Grupo llave foranea cursos_sigla, parte de la llave compuesta.
     * @return true si la operación es exitosa
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function deleteValues( $numero = null, $semestre = null, $año = null, $curso_sigla = null ){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("DELETE FROM grupos WHERE numero = $numero AND semestre = $semestre AND año = '$año' AND cursos_sigla = '$curso_sigla'");
        return $results;
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
    public function obtenerDatosCurso($curso_sigla = null, $numero = null, $semestre = null, $año = null){

        $datos=$this->find()
        ->select(['Cursos.sigla','Cursos.nombre','Grupos.numero','Grupos.semestre','Grupos.año'])
        ->join([
            'Cursos'=>[
                     'table'=>'Cursos',
                     'type'=>'LEFT',
                     'conditions'=>['Cursos.sigla=cursos_sigla']
            ]
        ])
        ->where([
          'cursos_sigla' => $curso_sigla,
          'numero' => $numero,
          'semestre' => $semestre,
       'año' => $año])
        ->toList();
        return $datos;
    }
}
