<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void {
  Schema::create('roles',function(Blueprint $t){$t->id();$t->string('name')->unique();$t->timestamps();});
  Schema::table('users',function(Blueprint $t){$t->foreignId('role_id')->nullable()->constrained('roles')->restrictOnDelete();$t->string('status')->default('ACTIVO');});
  Schema::create('donantes',function(Blueprint $t){$t->id();$t->string('tipo_donante');$t->string('nombre');$t->string('apellido')->nullable();$t->string('empresa')->nullable();$t->string('telefono')->nullable();$t->string('email')->nullable();$t->text('direccion')->nullable();$t->string('estado')->default('ACTIVO');$t->timestamps();});
  Schema::create('tipos_donacion',function(Blueprint $t){$t->id();$t->string('nombre')->unique();$t->text('descripcion')->nullable();$t->timestamps();});
  Schema::create('donaciones',function(Blueprint $t){$t->id();$t->foreignId('donante_id')->constrained('donantes')->restrictOnDelete();$t->foreignId('tipo_donacion_id')->constrained('tipos_donacion')->restrictOnDelete();$t->unsignedInteger('cantidad');$t->date('fecha_recepcion');$t->string('estado')->default('RECIBIDA');$t->text('observaciones')->nullable();$t->timestamps();});
  Schema::create('inventario',function(Blueprint $t){$t->id();$t->foreignId('donacion_id')->unique()->constrained('donaciones')->restrictOnDelete();$t->string('recurso');$t->unsignedInteger('existencia')->default(0);$t->string('ubicacion')->default('Bodega central');$t->timestamps();});
  Schema::create('beneficiarios',function(Blueprint $t){$t->id();$t->string('nombre');$t->string('telefono')->nullable();$t->text('direccion')->nullable();$t->text('necesidad')->nullable();$t->string('estado')->default('ACTIVO');$t->timestamps();});
  Schema::create('solicitudes',function(Blueprint $t){$t->id();$t->foreignId('beneficiario_id')->constrained('beneficiarios')->restrictOnDelete();$t->string('tipo_necesidad');$t->date('fecha');$t->text('descripcion')->nullable();$t->string('estado')->default('PENDIENTE');$t->timestamps();});
  Schema::create('asignaciones',function(Blueprint $t){$t->id();$t->foreignId('beneficiario_id')->constrained('beneficiarios')->restrictOnDelete();$t->foreignId('inventario_id')->constrained('inventario')->restrictOnDelete();$t->foreignId('solicitud_id')->nullable()->constrained('solicitudes')->restrictOnDelete();$t->unsignedInteger('cantidad');$t->string('estado')->default('PENDIENTE');$t->timestamps();});
  Schema::create('entregas',function(Blueprint $t){$t->id();$t->foreignId('asignacion_id')->constrained('asignaciones')->restrictOnDelete();$t->unsignedInteger('cantidad');$t->date('fecha');$t->foreignId('responsable_id')->constrained('users')->restrictOnDelete();$t->text('observaciones')->nullable();$t->timestamps();});
  Schema::create('evidencias',function(Blueprint $t){$t->id();$t->foreignId('entrega_id')->constrained('entregas')->cascadeOnDelete();$t->string('archivo');$t->string('nombre_original');$t->string('mime');$t->unsignedBigInteger('bytes');$t->timestamps();});
  Schema::create('movimientos_inventario',function(Blueprint $t){$t->id();$t->foreignId('inventario_id')->constrained('inventario')->restrictOnDelete();$t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();$t->string('tipo');$t->unsignedInteger('cantidad');$t->timestamps();});
  Schema::create('bitacora',function(Blueprint $t){$t->id();$t->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();$t->string('usuario');$t->string('accion');$t->string('registro');$t->timestamps();});
 }
 public function down():void {foreach(['bitacora','movimientos_inventario','evidencias','entregas','asignaciones','solicitudes','beneficiarios','inventario','donaciones','tipos_donacion','donantes'] as $table)Schema::dropIfExists($table);Schema::table('users',function(Blueprint $t){$t->dropConstrainedForeignId('role_id');$t->dropColumn('status');});Schema::dropIfExists('roles');}
};
