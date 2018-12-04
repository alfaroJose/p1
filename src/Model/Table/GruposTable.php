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
 * @property \App\Model\Table\CursosTable|\Cake\ORM\Association\BelongsTo $Cursos
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

        $this->belongsTo('Cursos', [
            'foreignKey' => 'cursos_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        $validator
            ->requirePresence('semestre', 'create')
            ->notEmpty('semestre');

        $validator
            ->scalar('año')
            ->requirePresence('año', 'create')
            ->notEmpty('año');

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
        $rules->add($rules->isUnique(
        ['numero', 'semestre', 'año', 'cursos_id', 'usuarios_id'],
        'Este grupo ya ha sido agregado'));

        return $rules;
    }

    /**
     * Función que devuelve los datos necesarios para listar los grupos asociados a
     * cada curso existente
     *
     * @return un arreglo de arreglos con la información de cada grupo
     */
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
     * Función que devuelve una lista con todas las siglas de los cursos existentes en
     * la base de datos mediante un select de cake.
     *
     * @return un arreglo con las siglas de los cursos
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
     * Función que devuelve los nombres de los usuarios con permisos de profesor
     * en la base de datos mediante un select de cake.
     *
     * @return \Cake\ORM\RulesChecker
     */
    public function seleccionarProfesores()
    {
            $users = TableRegistry::get('Usuarios');
            $profesores = $users->find()
            ->select(['nombre'])
            ->where(['roles_id =' => 3])
            ->toList();
        return $profesores;
    }

    /**
     * Función para obtener la sigla de un curso en especifico mediante un select
     * directo en la base de datos.
     *
     * @param string|null $id Grupo curso_id.
     * @return un arreglo con la sigla del curso en especifico.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function obtenerCursos($id = null){
        $connect = ConnectionManager::get('default');
        $sigla = $connect->execute("select distinct sigla from cursos, grupos where cursos.id = '".$id."'")->fetchAll();
        return $sigla;
    }

    /**
     * Función para obtener el id de un curso en especifico identificada por su sigla
     * mediante un select directo en la base de datos.
     *
     * @param string|null $sigla Curso sigla.
     * @return el id del curso en especifico.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function obtenerCursoId($sigla = null){
        $connect = ConnectionManager::get('default');
        $sigla = $connect->execute("select distinct c.id from cursos c where c.sigla = '".$sigla."'")->fetchAll();
        return $sigla[0][0];
    }

    /**
     * Funcion para obtener todos los ids y siglas de los cursos existentes            
     * identificada por su sigla mediante un select directo en la base de datos.
     *
     * @return un arreglo de arreglos con los ids y siglas de cada curso.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function obtenerTodosCursos(){
        $connect = ConnectionManager::get('default');
        $sigla = $connect->execute("select distinct sigla, id from cursos")->fetchAll();
        return $sigla;
    }

    /**
     * Función para obtener el correo de un profesor en especifico identificado por su id
     * mediante un select directo en la base de datos.
     *
     * @param string|null $id Usuario id.
     * @return un arreglo con el correo del profesor.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function obtenerProfesor($id = null){
        $connect = ConnectionManager::get('default');
        $profesor = $connect->execute("select distinct correo from usuarios, grupos where usuarios.id = '".$id."'")->fetchAll();
        return $profesor;
    }

    /**
     * Función para obtener la sigla de un curso en especifico mediante un select
     * de cake.
     *
     * @param string|null $id Grupo curso_id.
     * @return un arreglo con la sigla del curso en especifico.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
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

    /**
     * Función para obtener los nombres de todos los profesores
     * mediante un select directo en la base de datos.
     *
     * @param string|null $id Usuario id.
     * @return un arreglo con los nombres de los profesores.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function seleccionarProfesoresNombres(){
        $connect = ConnectionManager::get('default');
        $profesor = $connect->execute("select CONCAT(Usuarios.nombre, ' ', Usuarios.primer_apellido), id from Usuarios where Usuarios.roles_id = 3")->fetchAll();
        return $profesor;
    }

    /**
     * Función que llama a un procedimiento almacenado que permiter agregar un grupo
     * directamente a la base de datos mediante una conecxión directa a ella.
     *
     * @param string|null $number Grupo number.
     * @param string|null $semester Grupo semester.
     * @param string|null $year Grupo year.
     * @param string|null $id Grupo curso_id.
     * @param string|null $profId Grupo profesor_id.
     * @return true si la inserción es exitosa.
     */
    public function addClass($number, $semester, $year, $id, $profId)
    {
        $return = false;
        $connect = ConnectionManager::get('default');
        //Verifica que no esté en la tabla
        $inTable = count($connect->execute("select * from Grupos where cursos_id = '$id' and numero = '$number' and semestre = '$semester' and año = '$year'"));
        if ($inTable == 0) {
            if ($profId == ""){ //En caso de que el grupo no tenga profesor asignado
                $connect->execute("call insertar_grupo('$number', '$semester', '$year', '$id', NULL)");
            }else{
                $connect->execute("call insertar_grupo('$number', '$semester', '$year', '$id', '$profId')");
            }
            $return = true;
        }else{
            if ($profId == ""){ //En caso de que el grupo no tenga profesor asignado
                $connect->execute("update Grupos set usuarios_id = NULL where numero = '$number' and semestre = '$semester' and año = '$year' and cursos_id = '$id'");
            }else{
                $connect->execute("update Grupos set usuarios_id = '$profId' where numero = '$number' and semestre = '$semester' and año = '$year' and cursos_id = '$id'");
            }
            $return = true;
        }
        return $return;
    }


    /**
     * Función que revisa si existe un curso en la base de datos
     *
     * @param string|null $number Grupo number.
     * @param string|null $semester Grupo semester.
     * @param string|null $year Grupo year.
     * @return true si existe el grupo, false de manera contraria.
     */
    public function existeCurso($sigla){
        $return = false;
        $connect = ConnectionManager::get('default');
        $inTable = count($connect->execute("select * from Cursos where sigla = '$sigla'"));
        if($inTable != 0){
            $return = true;
        } 
        return $return;
    }

    /**
     * Función que revisa si existe un grupo en la base de datos
     *
     * @param string|null $number Grupo number.
     * @param string|null $semester Grupo semester.
     * @param string|null $year Grupo year.
     * @return true si existe el grupo, false de manera contraria.
     */
    public function existeGrupo($semester, $year, $number){
        $return = false;
        $connect = ConnectionManager::get('default');
        $inTable = count($connect->execute("select * from Grupos where numero = '$number' and semestre = '$semester' and año = '$year'"));
        if($inTable != 0){
            $return = true;
        } 
        return $return;
    }

    /**
     * Función que revisa si existen solicitudes asociadas a un grupo mediante una consulta directa
     * a la base de datos.
     *
     * @param string|null $grupoId Grupo id.
     * @return true si existe el grupo, false de manera contraria.
     */
    public function existenSolicitudes($grupoId){
        $existen = false;
        $connect = ConnectionManager::get('default');
        $inTable = count($connect->execute("select * from Solicitudes where grupos_id = '$grupoId'"));
        if($inTable != 0){
            $existen = true;
        } 
        return $existen;
    }
}