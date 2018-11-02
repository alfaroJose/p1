<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Solicitudes Model
 *
 * @property \App\Model\Table\UsuariosTable|\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\GruposTable|\Cake\ORM\Association\BelongsTo $Grupos
 *
 * @method \App\Model\Entity\Solicitude get($primaryKey, $options = [])
 * @method \App\Model\Entity\Solicitude newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Solicitude[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitude|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitude patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitudesTable extends Table
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

        $this->setTable('solicitudes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuarios_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Grupos', [
            'foreignKey' => 'grupos_id',
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('carrera')
            ->maxLength('carrera', 100)
            ->requirePresence('carrera', 'create')
            ->notEmpty('carrera');

        $validator
            ->decimal('promedio')
            ->allowEmpty('promedio')
            ->lessThanOrEqual('promedio', 10, 'El valor máximo del promedio ponderado es 10')
            ->greaterThanOrEqual('promedio', 0, 'El valor mínimo del promedio ponderado es 0');

        $validator
            ->allowEmpty('cantidad_horas');

        $validator
            ->scalar('estado')
            ->maxLength('estado', 30)
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->scalar('asistencia_externa')
            ->maxLength('asistencia_externa', 2)
            ->requirePresence('asistencia_externa', 'create')
            ->notEmpty('asistencia_externa');

        $validator
            ->allowEmpty('cantidad_horas_externa');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');

        $validator
            ->scalar('justificación')
            ->maxLength('justificación', 1000)
            ->allowEmpty('justificación');

        $validator
            ->requirePresence('ronda', 'create')
            ->notEmpty('ronda');

        $validator
            ->scalar('horas_asistente')
            ->maxLength('horas_asistente', 2)
            ->requirePresence('horas_asistente', 'create')
            ->notEmpty('horas_asistente');

        $validator
            ->scalar('horas_estudiante')
            ->maxLength('horas_estudiante', 2)
            ->requirePresence('horas_estudiante', 'create')
            ->notEmpty('horas_estudiante');

        $validator
            ->scalar('horas_asistente_externa')
            ->maxLength('horas_asistente_externa', 2)
            ->requirePresence('horas_asistente_externa', 'create')
            ->notEmpty('horas_asistente_externa');

        $validator
            ->scalar('horas_estudiante_externa')
            ->maxLength('horas_estudiante_externa', 2)
            ->requirePresence('horas_estudiante_externa', 'create')
            ->notEmpty('horas_estudiante_externa');

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
        $rules->add($rules->existsIn(['grupos_id'], 'Grupos'));

        return $rules;
    }

    public function getIndexValues(){
        $connect = ConnectionManager::get('default');
        $index = $connect->execute("select cursos.sigla, cursos.nombre, grupos.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, solicitudes.estado as 'Estado de solicitud'
            from grupos, cursos, usuarios as Profesores, usuarios as Estudiantes, solicitudes
            where grupos.cursos_id = cursos.id  and Profesores.id = grupos.usuarios_id and solicitudes.usuarios_id = Estudiantes.id and solicitudes.grupos_id = grupos.id")->fetchAll();
        return $index;
    }

    /*Obtiene el id del estudiante según el carné*/
    public function getIDEstudiante($carne)
    {
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("select id from usuarios where nombre_usuario = '" .$carne."'");
        $result = $result->fetchAll('assoc');
        return $result[0]['id'];
    }

        public function getIndexValuesEstudiante($id){
        /*$connect = ConnectionManager::get('default');
        $index = $connect->execute("select distinct cursos.sigla, cursos.nombre, grupos.numero, Profesores.nombre as profesor, Profesores.primer_apellido, Estudiantes.nombre as estudiante, Estudiantes.primer_apellido, solicitudes.estado as 'Estado de solicitud'
            from grupos, cursos, usuarios as Estudiantes, solicitudes
            where grupos.cursos_id = cursos.id  and Profesores.id = grupos.usuarios_id and solicitudes.usuarios_id = Estudiantes.id and solicitudes.grupos_id = grupos.id")->fetchAll();
        return $index;*/
        $connect = ConnectionManager::get('default');
        $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, Profesores.nombre, Profesores.primer_apellido, Estudiantes.nombre as estudiante, Estudiantes.primer_apellido, s.estado as 'Estados de solicitud'
            from solicitudes s, grupos g, cursos c, usuarios as Estudiantes, usuarios as Profesores 
            where s.usuarios_id = '" .$id. "' and s.grupos_id = g.id and g.cursos_id = c.id and Profesores.id = g.usuarios_id and s.usuarios_id = Estudiantes.id;")->fetchAll();
        return $index;
    }

    /*Obtiene todos los datos del estudiante según el carné de la persona logueada*/
    public function getStudentInfo($carne)
    {
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("select * from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll();
        return $result[0];
    }

    //Obtiene los números de grupo, nombre del curso, sigla y id de los grupos disponibles para solicitar una asistenia de dicho semestre y año en el que el estudiante no haya solicitado asistencia todavía.
    public function getGrupos($id_estudiante, $semestre, $year)
    {
        $connet = ConnectionManager::get('default');      
        $result = $connet->execute("select g.numero, c.nombre, c.sigla, g.id, g.cursos_id
                                    from cursos c, grupos g
                                    where g.año = '$year' and g.semestre = '$semestre' and c.id = g.cursos_id AND 
                                    concat(g.cursos_id, g.numero)  NOT IN(
                                                                    select concat(g.cursos_id, g.numero)
                                                                    from grupos g, solicitudes r
                                                                    where g.id = r.grupos_id and r.usuarios_id = '$id_estudiante')");

        //El assoc hace que los resultados del array no queden en result[0] sino en result['numero'], result['nombre'], etc.
        $result = $result->fetchAll('assoc'); 
        return $result;
    }


    /*Obtiene el nombre y primer apellido del profesor según el grupo específicado.*/
    public function getProfesor($curso, $classNumber)
    {
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("Select CONCAT(name,' ',lastname1) AS name from Classes c, users u WHERE c.course_id = '$courseId' AND c.class_number = '$classNumber' AND c.professor_id = u.identification_number");
        $result = $result->fetchAll('assoc');
        return $result;

    }
}

