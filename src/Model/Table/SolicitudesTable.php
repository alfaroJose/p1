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
        $index = $connect->execute("select cursos.sigla, cursos.nombre, grupos.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, solicitudes.estado as 'Estado de solicitud', solicitudes.id
            from grupos, cursos, usuarios as Profesores, usuarios as Estudiantes, solicitudes
            where grupos.cursos_id = cursos.id  and Profesores.id = grupos.usuarios_id and solicitudes.usuarios_id = Estudiantes.id and solicitudes.grupos_id = grupos.id")->fetchAll();
        return $index;
    }

    public function getIDEstudiante($carne)
    {
        $connet = ConnectionManager::get('default');
        $result = $connect->execute("select id from usuarios where nombre_usuario = '" .$carne."'");
        $result = $result->fetchAll();
        return $result;
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

    public function getStudentInfo($carne)
    {
        $connet = ConnectionManager::get('default');
              //  $result = $connet->execute("Select CONCAT(name,' ',lastname1) AS name from Classes c, users u WHERE c.course_id = "+$courseId+" AND c.class_number = "+$classNumber+" AND c.professor_id = u.identification_number");
        //$result = $connet->execute("select * from Usuarios where nombre_usuario = '$carne'");
        //$result = $result->fetchAll('assoc');
        //return $result;
        $result = $connet->execute("select * from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll();
        return $result[0];
    }

    public function getViewValues($grupo_id, $usuario_id, $solicitudes_id)
    {
        $connect = ConnectionManager::get('default');
        $view = $connect->execute("select cursos.sigla, cursos.nombre, grupos.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido, ' ', Profesores.segundo_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido, ' ', Estudiantes.segundo_apellido) as estudiante
            from grupos, cursos, usuarios as Profesores, usuarios as Estudiantes, solicitudes
            where grupos.cursos_id = cursos.id  and Profesores.id = grupos.usuarios_id and solicitudes.usuarios_id = Estudiantes.id and solicitudes.grupos_id = grupos.id")->fetchAll();
        return $view;
    } 

    public function getSolicitudCompleta($id)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select estudiante.nombre as 'estudiante_nombre', estudiante.primer_apellido as 'estudiante_primer_apellido',
        estudiante.segundo_apellido as 'estudiante_segundo_apellido', estudiante.identificacion as 'estudiante_identificacion',
        estudiante.tipo_identificacion as 'estudiante_tipo_identificacion', estudiante.nombre_usuario as 'estudiante_carne',
        estudiante.telefono as 'estudiante_telefono', estudiante.correo as 'estudiante_correo',
        CONCAT(profesor.nombre, ' ', profesor.primer_apellido, ' ', profesor.segundo_apellido) AS 'profesor_nombre',
        g.numero as 'grupo_numero', c.sigla as 'curso_sigla', c.nombre as 'curso_nombre',
        s.id as 'solicitud_id', s.carrera as 'solicitud_carrera', s.promedio as 'solicitud_promedio',
        s.estado as 'solicitud_estado', s.asistencia_externa as 'solicitud_asistencia_externa',
        s.cantidad_horas_externa as 'solicitud_cantidad_horas_externa', s.justificacion as 'solicitud_justificacion',
        s.horas_asistente as 'solicitud_horas_asistente', s.horas_estudiante as 'solicitud_horas_estudiante',
        s.horas_asistente_externa as 'solicitud_horas_asistente_externas', s.horas_estudiante_externa as 'solicitud_horas_estudiante_externas' 
        from usuarios estudiante, usuarios profesor, solicitudes s, grupos g, cursos c 
        where profesor.id = g.usuarios_id 
        and s.usuarios_id = estudiante.id 
        and g.id = s.grupos_id 
        and c.id = g.cursos_id 
        and s.id = '".$id."'")->fetchAll('assoc');
        return $result;
    }

    public function getRequisitosSolicitud($id)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select r.id AS 'requisito_id', r.nombre as 'requisito_nombre', r.tipo as 'requisito_tipo', r.categoria as 'requisito_categoria', t.condicion as 'tiene_condicion'
        from requisitos r, tiene t
        where r.id = t.requisitos_id
        and t.solicitudes_id = '".$id."'")->fetchAll('assoc');
        return $result;
    }

    public function setCondicionTiene($solicitudes_id, $requisitos_id, $condicion)
    {
        $connet = ConnectionManager::get('default');
        $connet->execute("call asignar_condicion_tiene ($solicitudes_id, $requisitos_id, '$condicion')");
    }

}
