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
            ->scalar('cantidad_horas_externa')
            ->allowEmpty('cantidad_horas_externa')
            ->range('cantidad_horas_externa', [0, 20]);                        
        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmpty('fecha');
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
    /*carga el index con todas las solicitudes*/
    public function getIndexValues(){
        $connect = ConnectionManager::get('default');
                        $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)';")->fetchAll();
        return $index;
    }
    /*carga el index con todas las solicitudes Actuales*/
    public function getIndexActualesValues($semestre, $año){
        $connect = ConnectionManager::get('default');
                        $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador', s.usuarios_id
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id 
                                        where g.semestre = '$semestre' and g.año = '$año';")->fetchAll();
        return $index;
    }
    /*obtiene el id de usuario actualmente logueado*/
        public function getIDUsuario($carne)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select id from usuarios where nombre_usuario = '" .$carne."'");
        $result = $result->fetchAll();
        return $result;
    }

    public function getCurso($idSolicitud){
        $connect = ConnectionManager::get('default');
        $curso = $connect->execute("select cursos.sigla, cursos.nombre, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido)  as profesor from grupos, cursos, usuarios as Profesores, usuarios as Estudiantes, solicitudes  where grupos.cursos_id = cursos.id  and Profesores.id = grupos.usuarios_id and solicitudes.usuarios_id = Estudiantes.id and solicitudes.grupos_id = grupos.id and solicitudes.id = '" .$idSolicitud. "' ")->fetchAll();
        return $curso;
    }
    
    public function getIDEstudiante($carne){
        $connet = ConnectionManager::get('default');
        $result = $connet->execute("select id from usuarios where nombre_usuario = '" .$carne. "'")->fetchAll();
        $result = $result->fetchAll();
        return $result;
    }

    /*carga el index con todas las solicitudes del estudiante actualmente logueado*/
    public function getIndexValuesEstudiante($id){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.usuarios_id = '$id' and (s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)');")->fetchAll();
        return $index;
    }
        /*carga el index con solo las solicitudes del estudiante actualmente logueado en el semestre actual*/
    public function getIndexValuesActualesEstudiante($id, $semestre, $año){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.usuarios_id = '$id' and g.semestre = '$semestre' and g.año = '$año';")->fetchAll();
        return $index;
    }
    /*carga el index con todas las solicitudes del profesor actualmente logueado*/
    public function getIndexValuesProfesor($id){
        
        $connect = ConnectionManager::get('default');
        
        $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
                from solicitudes s 
                join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                join grupos g on s.grupos_id = g.id
                join cursos c on g.cursos_id = c.id
                left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                where g.usuarios_id = $id and (s.estado = 'Elegible' or s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)');")->fetchAll();
        return $index;
    }
        /*carga el index con solo las solicitudes del profesor actualmente logueado en semestre actual*/
    public function getIndexValuesActualesProfesor($id, $semestre, $año){
        
        $connect = ConnectionManager::get('default');
        
        $index = $connect->execute("select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
                from solicitudes s 
                join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                join grupos g on s.grupos_id = g.id
                join cursos c on g.cursos_id = c.id
                left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                where g.usuarios_id = $id and g.semestre = '$semestre' and g.año = '$año' and (s.estado = 'Elegible' or s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)');")->fetchAll();
        return $index;
    }
    /*obtiene los datos de la solicitud para la vista*/
    public function getViewValuesUsuario($idSolicitud){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute(
            "select distinct c.sigla, c.nombre, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, s.estado as 'Estados de solicitud', s.id as 'identificador'
        from solicitudes s, cursos c, usuarios as Estudiantes, usuarios as Profesores right outer join grupos g on Profesores.id = g.usuarios_id
        where s.id = '" .$idSolicitud. "' and s.grupos_id = g.id and g.cursos_id = c.id  and s.usuarios_id = Estudiantes.id;")->fetchAll();
        return $index;
    }
    /*Obtiene todos los datos del estudiante según el carné de la persona logueada*/
    public function getStudentInfo($carne)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select * from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll('assoc');
        if($result != null){
            return $result[0];
        }
    }


    //Devuelve algo si el id del profe calza con el id del profe de la solicitud
    public function getIdProfeSolicitud($id){
        $connect = ConnectionManager::get('default');
        $consulta = "select us.id
                    from grupos as gr join solicitudes on grupos_id = gr.id
                                        join usuarios as us on gr.usuarios_id = us.id
                        where solicitudes.id = ".$id.";";
        $resultado =  $connect->execute($consulta)->fetchAll();
        return $resultado[0][0];
    }
    //Obtiene los números de grupo, nombre del curso, sigla y id de los grupos disponibles para solicitar una asistenia de dicho semestre y año en el que el estudiante no haya solicitado asistencia todavía.
    public function getGrupos($id_estudiante, $semestre, $year)
    {
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute("select g.numero, c.nombre, c.sigla, g.id, g.cursos_id
                                    from cursos c, grupos g
                                    where g.año = '$year' and g.semestre = '$semestre' and c.id = g.cursos_id AND 
                                    concat(g.cursos_id, g.numero)  NOT IN(
                                                                    select concat(g.cursos_id, g.numero)
                                                                    from grupos g, solicitudes r
                                                                    where g.id = r.grupos_id and r.usuarios_id = '$id_estudiante')  and
                                    g.id NOT IN(
                                                                    select g.id
                                                                    from grupos g join solicitudes r on g.id = r.grupos_id 
                                                                    where r.estado = 'Aceptada - Profesor' or r.estado = 'Aceptada - Profesor (Inopia)');");
        //El assoc hace que los resultados del array no queden en result[0] sino en result['numero'], result['nombre'], etc.
        $result = $result->fetchAll('assoc'); 
        return $result;
    }

    //Obtiene los grupos que tienen un asistente asignado
    public function getGruposSinAsignar($semestre, $year){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select distinct cur.sigla as sigla, cur.nombre, concat(us.nombre,' ',us.primer_apellido) as profesor,  gru.numero as grupo, gru.año, gru.semestre, gru.id as id
            from solicitudes as sol join grupos as gru on sol.grupos_id = gru.id 
                                    join cursos as cur on cur.id = gru.cursos_id  
                                    join usuarios as us on gru.usuarios_id = us.id
            where sol.estado = 'Elegible' and año = ".$year." and semestre = ".$semestre." and estado = 'Elegible'
                  and gru.id not in (select gru.id
                                     from solicitudes as sol join grupos as gru on gru.id = sol.grupos_id
                                     where sol.estado = 'Aceptada - Profesor' or sol.estado = 'Aceptada - Profesor (Inopia)');");
        //El assoc hace que los resultados del array no queden en result[0] sino en result['numero'], result['nombre'], etc.
        $result = $result->fetchAll('assoc'); 
        return $result;
    }

    //Devuelve el nombre, el id de los estudiantes y id de la solicitud que se hizo para un grupo ($idGrupo)
    public function getEstudiantesGrupoAsistencia($idGrupo){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select Concat(us.Nombre,' ',us.primer_apellido) as nombre, us.id as id, sol.id as sol_id
            from usuarios as us join solicitudes as sol on sol.usuarios_id = us.id
            where sol.estado = 'Elegible' and sol.grupos_id = '".$idGrupo."'");

        $result = $result->fetchAll('assoc'); 
        return $result;    
    }

    /*Requisitos que son Inopia de una determinada solicitud*/            
    public function getRequisitosInopia($idSolicitud){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select r.id, r.nombre, r.tipo, r.categoria, t.condicion, t.solicitudes_id
            from Tiene t join Requisitos r on t.requisitos_id = r.id
            join Solicitudes s on t.solicitudes_id = s.id
            where t.solicitudes_id = '$idSolicitud' and t.condicion = 'Inopia';")->fetchAll('assoc');
        $cant = count($result);

        if ($cant == 0){
            $result = false;           
        }
        return $result; 
    }

    /*Requisitos de categoría Asistente de cada solicitud que no están aprobados*/                      
    public function getRequisitosAsistenteReprobados($idSolicitud){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select r.id, r.nombre, r.tipo, r.categoria, t.condicion, t.solicitudes_id
            from Tiene t join Requisitos r on t.requisitos_id = r.id
            join Solicitudes s on t.solicitudes_id = s.id
            where t.solicitudes_id = '$idSolicitud' and r.categoria = 'Horas Asistente' and t.condicion = 'No';")->fetchAll('assoc');
        $cant = count($result);

        if ($cant == 0){
            $result = false;           
        }
        return $result; 
    }

    //Actualiza el estado de una Solicitud
    public function setEstadoSolicitud($id,$estado){
        $connect = ConnectionManager::get('default');      
        $connect->execute(
            "update Solicitudes
            set estado = '".$estado."'
            where id = ".$id."");
    }

    //Actualiza el estado de una Solicitud para que quede como Rechazada
    public function setSolicitudRechazada($idSolicitud){
        $connect = ConnectionManager::get('default');      
        $connect->execute(
            "update Solicitudes
            set estado = 'Rechazada' 
            where id = ".$idSolicitud.";");
    }

    //Devuelve verdadero o falso si tuvo HA por asistencia
    public function InopiaAsistente($idSolicitud){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select solicitudes_id  
            from requisitos join tiene on requisitos_id = requisitos.id
            where condicion = 'Inopia' and tipo = 'Obligatorio Inopia' and categoria = 'Horas Asistente' 
               and solicitudes_id = ".$idSolicitud.";")->fetchAll('assoc');
        $cant = count($result);

        if ($cant == 0){
            $result = false;           
        }
        else{
            $result = true;
        }
        return $result; 
    }

     //Devuelve verdadero o falso si tuvo HE por asistencia
     public function InopiaEstudiante($idSolicitud){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute(
            "select solicitudes_id  
            from requisitos join tiene on requisitos_id = requisitos.id
            where condicion = 'Inopia' and tipo = 'Obligatorio Inopia' and categoria = 'Horas Estudiante' 
               and solicitudes_id = ".$idSolicitud.";")->fetchAll('assoc');
        $cant = count($result);

        if ($cant == 0){
            $result = false;           
        }
        else{
            $result = true;
        }
        return $result; 
    }

    //Devuelve las horas estudiante que tenga un estudiante asignadas
    public function getHorasEstudiante($idEstudiante,$idGrupo){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute("select sum(acep.cantidad_horas) 
        from aceptados as acep join solicitudes as sol on acep.id = sol.id
        where usuarios_id = ".$idEstudiante." and acep.tipo_horas = 'Estudiante ECCI' or acep.tipo_horas = 'Estudiante Docente';");
        $result = $result->fetchAll(); 

        $result2 = $connect->execute("select sol.cantidad_horas_externa
        from solicitudes as sol
        where asistencia_externa = 'Sí' and usuarios_id = ".$idEstudiante." and grupos_id = ".$idGrupo." and horas_estudiante_externa = 'Sí';");
        $result2 = $result2->fetchAll(); 

        if ($result == null){
            $result[0][0] = 0;
        }
        if ($result2 == null){
            $result2[0][0] = 0;
        }
        $HE = $result[0][0] + $result2[0][0];

        return $HE;  
    }

    //Devuelve las horas asistente que tenga un estudiante asignadas
    public function getHorasAsistente($idEstudiante,$idGrupo){
        $connect = ConnectionManager::get('default');      
        $result = $connect->execute("select sum(acep.cantidad_horas) 
        from aceptados as acep join solicitudes as sol on acep.id = sol.id
        where usuarios_id = ".$idEstudiante." and acep.tipo_horas = 'Asistente';");
        $result = $result->fetchAll(); 

        $result2 = $connect->execute("select sol.cantidad_horas_externa
        from solicitudes as sol
        where asistencia_externa = 'Sí' and usuarios_id = ".$idEstudiante." and grupos_id = ".$idGrupo." and horas_asistente_externa = 'Sí';");
        $result2 = $result2->fetchAll(); 

        if ($result == null){
            $result[0][0] = 0;
        }
        if ($result2 == null){
            $result2[0][0] = 0;
        }
        $HE = $result[0][0] + $result2[0][0];

        return $HE;  
    }

    /*Obtiene el nombre y primer apellido del profesor según el curso, grupo, año y semestre especificado.*/
    public function getTeacher($siglaCurso, $numeroGrupo, $semestre, $year)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select CONCAT(u.nombre,' ',u.primer_apellido) AS name 
                                    from Grupos g, Usuarios u, Cursos c 
                                    where c.sigla = '$siglaCurso' and g.semestre = '$semestre' and g.año = '$year' and g.numero = '$numeroGrupo' and g.usuarios_id = u.id and g.cursos_id = c.id;");
        $result = $result->fetchAll('assoc');
        return $result;
    }
    public function getIDGrupo($siglaCurso, $numeroGrupo, $semestre, $year)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select g.id 
                                    from Grupos g, Cursos c 
                                    where c.sigla = '$siglaCurso' and g.semestre = '$semestre' and g.año = '$year' and g.numero = '$numeroGrupo' and g.cursos_id = c.id;");
        $result = $result->fetchAll('assoc');
        return $result;
    }
    //Obtiene la ronda actual, como solo existe una tupla, no es necesario especificar fechas o parámetros
    public function getRonda()
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select * from Rondas");
        $result = $result->fetchAll('assoc');
        return $result[0];
    }

    public function getContadorHoras()
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select * from contador");
        $result = $result->fetchAll('assoc');
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
        // Devuelva el rol del usuario según el carné
    public function getRol($carne){
        $connect = ConnectionManager::get('default');
        $fila = $connect->execute("select roles_id from Usuarios where nombre_usuario = '" .$carne."'")->fetchAll();
        return $fila[0];
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
        s.cantidad_horas_externa as 'solicitud_cantidad_horas_externa',
        s.horas_asistente as 'solicitud_horas_asistente', s.horas_estudiante as 'solicitud_horas_estudiante',
        s.horas_asistente_externa as 'solicitud_horas_asistente_externas', s.horas_estudiante_externa as 'solicitud_horas_estudiante_externas',
        a.cantidad_horas as 'aceptados_cantidad_horas', a.tipo_horas as 'aceptados_tipo_horas'
        from solicitudes s join usuarios estudiante on s.usuarios_id = estudiante.id
        join grupos g on s.grupos_id = g.id
        join cursos c on g.cursos_id = c.id
        left outer join usuarios profesor on g.usuarios_id = profesor.id
        left outer join aceptados a on a.id = s.id
        where s.id = '".$id."'")->fetchAll('assoc');
        return $result;
    }
    public function getRequisitosSolicitud($id)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select r.id AS 'requisito_id', r.nombre as 'requisito_nombre', r.tipo as 'requisito_tipo', r.categoria as 'requisito_categoria', t.condicion as 'tiene_condicion'
        from requisitos r, tiene t
        where r.id = t.requisitos_id
        and t.solicitudes_id = '".$id."'
        order by (r.tipo)")->fetchAll('assoc');
        return $result;
    }
    public function setCondicionTiene($solicitudes_id, $requisitos_id, $condicion)
    {
        $connet = ConnectionManager::get('default');
        $connet->execute("call actualizar_condicion_tiene ($solicitudes_id, $requisitos_id, '$condicion')");
    }
    public function setAceptados($solicitudes_id, $cantidad_horas, $tipo_horas)
    {
        $connet = ConnectionManager::get('default');
        $connet->execute("call insertar_modificar_aceptados ($solicitudes_id, $cantidad_horas, '$tipo_horas')");
    }
    public function setPromedio($promedio, $grupos_id, $usuarios_id)
    {
        $connet = ConnectionManager::get('default');
        $connet->execute("call actualizar_promedio ($promedio, $grupos_id, $usuarios_id)");
    }

    /*************************************************************************************/
    /*Administrador  CONSULTA y genera Excel del historial de asistencias que ha tenido un determinado estudiante durante toda la carrera 
    Atributos: Curso Sigla Grupo Profesor Carnet Nombre Tipo Horas y Cantidad*/
    public function getHistorialExcelEstudiante($id){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct c.nombre, c.sigla, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, u.nombre_usuario, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, a.tipo_horas, a.cantidad_horas, s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join usuarios u on s.usuarios_id = u.id
                                        join aceptados a on s.id = a.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.usuarios_id = '$id' and (s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)');")->fetchAll('assoc');
        return $index;
    }


    /*Administrador  CONSULTA y genera Excel del historial total de asistencias durante toda la carrera 
    Atributos: Curso Sigla Grupo Profesor Carnet Nombre Tipo Horas y Cantidad*/
    public function getHistorialExcelEstudianteTodo(){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct c.nombre, c.sigla, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, u.nombre_usuario, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, a.tipo_horas, a.cantidad_horas, s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join usuarios u on s.usuarios_id = u.id
                                        join aceptados a on s.id = a.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)';")->fetchAll('assoc');
        return $index;
    }

        /*Saca siglas y Ids de los estudiantes con solicitudes aceptadas para usarlos en la vista donde se selecionara algun estudiante*/
        public function getCarnetId(){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct u.nombre_usuario, s.usuarios_id
                            from solicitudes s
                            join usuarios u on s.usuarios_id = u.id
                            left outer join aceptados a on s.id = a.id
                            where s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)';")->fetchAll('assoc');
        return $index;
    }

/*****************************************************************************************/

    public function getHistorialExcelRonda($id){
        $connect = ConnectionManager::get('default');
            $index = $connect->execute("select distinct c.nombre, c.sigla, g.numero, CONCAT(Profesores.nombre, ' ', Profesores.primer_apellido) as profesor, u.nombre_usuario, CONCAT(Estudiantes.nombre, ' ', Estudiantes.primer_apellido) as estudiante, a.tipo_horas, a.cantidad_horas, s.id as 'identificador'
                                        from solicitudes s 
                                        join usuarios as Estudiantes on s.usuarios_id = Estudiantes.id
                                        join usuarios u on s.usuarios_id = u.id
                                        join aceptados a on s.id = a.id
                                        join grupos g on s.grupos_id = g.id
                                        join cursos c on g.cursos_id = c.id
                                        left outer join usuarios as Profesores on g.usuarios_id = Profesores.id
                                        where s.ronda = '$id' and (s.estado = 'Aceptada - Profesor' or s.estado = 'Aceptada - Profesor (Inopia)');")->fetchAll('assoc');
        return $index;
    }


    public function getRequisitosIncumplidos($id)
    {
        $connect = ConnectionManager::get('default');
        $result = $connect->execute("select r.nombre as requisito_nombre
        from requisitos r, tiene t
        where t.requisitos_id = r.id
        and t.condicion = 'No'
        and t.solicitudes_id = '".$id."'")->fetchAll('assoc');
        return $result;
    }

}