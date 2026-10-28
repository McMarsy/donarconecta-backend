<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
class AuthController extends Controller {
 public function login(Request $r){$v=$r->validate(['email'=>'required|email','password'=>'required|string']);if(!Auth::attempt($v))throw ValidationException::withMessages(['email'=>'Credenciales incorrectas']);$u=$r->user();if($u->status!=='ACTIVO'){Auth::logout();throw ValidationException::withMessages(['email'=>'Usuario inactivo']);}$r->session()->regenerate();return ['success'=>true,'message'=>'Inicio correcto','user'=>$this->user($u)];}
 public function me(Request $r){return ['user'=>$this->user($r->user())];}
 public function logout(Request $r){Auth::guard('web')->logout();$r->session()->invalidate();$r->session()->regenerateToken();return ['success'=>true];}
 private function user($u){return ['id'=>$u->id,'name'=>$u->name,'email'=>$u->email,'role'=>$u->role?->name,'role_id'=>$u->role_id,'status'=>$u->status];}
 public function forgot(Request $r){$r->validate(['email'=>'required|email']);Password::sendResetLink($r->only('email'));return ['message'=>'Si el correo existe, se enviarán instrucciones de recuperación'];}
 public function reset(Request $r){$r->validate(['token'=>'required','email'=>'required|email','password'=>'required|min:12|confirmed']);$status=Password::reset($r->only('email','password','password_confirmation','token'),function($u,$p){$u->forceFill(['password'=>$p,'remember_token'=>\Illuminate\Support\Str::random(60)])->save();});return $status===Password::PASSWORD_RESET?['success'=>true]:response()->json(['message'=>'Token inválido o vencido'],422);}
}
