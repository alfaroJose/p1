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


    /*Función para obtener los datos de un curso desde tabla grupos y cursos*/
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

<<<<<<< HEAD
=======
    
    /*Función para modificar cursos*/
>>>>>>> d08227a0e08ab592a9ccaec1b6a297dd2dc50dc0
    public function actualizarTodo($vectorCambios, $vectorCondiciones/*$cursosigla = null, $numero = null, $semestre = null, $año = null*//*['Grupos.numero','Grupos.semestre','Grupos.año'], ['Cursos.sigla','Grupos.numero','Grupos.semestre','Grupos.año']*//*$fields"vector", $conditions*/)
    {
        /*$query = $this->query();
        $query->update()
            ->set($fields)
            ->where($conditions);
        $statement = $query->execute();
        $statement->closeCursor();

        return $statement->rowCount();*/

        $dato = explode(",", $vectorCambios);
        $condicion = explode(",", $vectorCondiciones);
        //$query = $this->query();
        //$query->update()
            $query->set('Grupos.numero',$dato[0]/*,'Grupos.semestre'=>$semestre,'Grupos.año'=>$año*/)
            //debug($query);
            /*$query->set('Grupos.semestre',$dato[1])
            $query->set('Grupos.año',$dato[2])*/
        ->where([
          'cursos_sigla' => $condicion[0],//$curso_sigla,
          'numero' => $condicion[1],//$numero,
          'semestre' => $condicion[2],//$semestre,
          'año' => $condicion[3]]);//$año])

        /*$statement = $query->execute();
        $statement->closeCursor();

        return $statement->rowCount();*/
    }



    public function deleteValues($curso_sigla = null, $numero = null, $semestre = null, $año = null){
        $connection = ConnectionManager::get('default');
        $results = $connection->execute("DELETE FROM grupos WHERE numero = $numero AND semestre = $semestre AND año = '$año' AND cursos_sigla = '$curso_sigla'");
        return $results;;
    }
    //https://book.cakephp.org/3.0/en/orm/database-basics.html

    /*public function editValues($id = null, $numero = null, $semestre = null, $año = null){
        //$index=$this->find();
        $connection = ConnectionManager::get('default');
        /*$results = $connection->execute("UPDATE FROM grupos WHERE curso_sigla = '$id' AND numero = $numero AND semestre = $semestre AND año = '$año'");*/
        /*debug($index);
        die();
        
        $results = $connection->execute("UPDATE grupos set numero = '$numero', semestre = '$semestre', año = $año WHERE cursos_sigla = '$id' and numero = '$numero' and semestre = '$semestre' and año = '$año'");
        debug($results);

        die(); 
        //return $index;
    }*/

    /*Función para obtener los datos de un curso para poder modificarlos*/
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
        /*debug($index);
        die();*/

    }
}
