<?php
return [
 'resources' => [
  'roles' => ['table'=>'roles','fields'=>['name'],'read'=>['Administrador','Supervisor'],'write'=>[]],
  'users' => ['table'=>'users','fields'=>['name','email','password','role_id','status'],'read'=>['Administrador'],'write'=>['Administrador']],
  'donantes' => ['table'=>'donantes','fields'=>['tipo_donante','nombre','apellido','empresa','telefono','email','direccion','estado'],'read'=>['Administrador','Encargado de donaciones','Supervisor'],'write'=>['Administrador','Encargado de donaciones']],
  'tipos-donacion' => ['table'=>'tipos_donacion','fields'=>['nombre','descripcion'],'read'=>['Administrador','Encargado de donaciones','Supervisor'],'write'=>['Administrador','Encargado de donaciones']],
  'donaciones' => ['table'=>'donaciones','fields'=>['donante_id','tipo_donacion_id','cantidad','fecha_recepcion','estado','observaciones'],'read'=>['Administrador','Encargado de donaciones','Supervisor'],'write'=>['Administrador','Encargado de donaciones']],
  'inventario' => ['table'=>'inventario','fields'=>['recurso','donacion_id','existencia','ubicacion'],'read'=>['Administrador','Encargado de inventario','Encargado de donaciones','Supervisor'],'write'=>[]],
  'beneficiarios' => ['table'=>'beneficiarios','fields'=>['nombre','telefono','direccion','necesidad','estado'],'read'=>['Administrador','Encargado de donaciones','Encargado de entregas','Supervisor'],'write'=>['Administrador','Encargado de donaciones','Encargado de entregas']],
  'solicitudes' => ['table'=>'solicitudes','fields'=>['beneficiario_id','tipo_necesidad','fecha','descripcion','estado'],'read'=>['Administrador','Encargado de donaciones','Encargado de entregas','Supervisor'],'write'=>['Administrador','Encargado de donaciones','Encargado de entregas']],
  'asignaciones' => ['table'=>'asignaciones','fields'=>['beneficiario_id','inventario_id','solicitud_id','cantidad','estado'],'read'=>['Administrador','Encargado de donaciones','Encargado de inventario','Encargado de entregas','Supervisor'],'write'=>['Administrador','Encargado de donaciones','Encargado de inventario','Encargado de entregas']],
  'entregas' => ['table'=>'entregas','fields'=>['asignacion_id','cantidad','fecha','responsable_id','observaciones'],'read'=>['Administrador','Encargado de entregas','Supervisor'],'write'=>['Administrador','Encargado de entregas']],
  'bitacora' => ['table'=>'bitacora','fields'=>['user_id','usuario','accion','registro'],'read'=>['Administrador','Supervisor'],'write'=>[]],
 ],
];
