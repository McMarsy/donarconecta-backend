<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class DonarConectaSeeder extends Seeder {
 public function run():void {
  $names=['Administrador','Encargado de donaciones','Encargado de inventario','Encargado de entregas','Supervisor','Donante','Beneficiario'];
  foreach($names as $n)DB::table('roles')->updateOrInsert(['name'=>$n],['updated_at'=>now(),'created_at'=>now()]);
  if(app()->environment('local'))DB::table('users')->updateOrInsert(['email'=>'admin@donarconecta.test'],['name'=>'Administrador de pruebas','password'=>Hash::make('Demo123!'),'role_id'=>DB::table('roles')->where('name','Administrador')->value('id'),'status'=>'ACTIVO','updated_at'=>now(),'created_at'=>now()]);
  foreach(['Alimentos','Ropa','Medicinas'] as $n)DB::table('tipos_donacion')->updateOrInsert(['nombre'=>$n],['descripcion'=>'Categoría de ejemplo','updated_at'=>now(),'created_at'=>now()]);
 }
}
