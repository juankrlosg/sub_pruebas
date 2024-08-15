<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\sectors;
use App\Models\Servicio;
use App\Models\ServicioUsuario;
use function Doctrine\Common\Cache\Psr6\get;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\VarDumper\Cloner\Data;
use Acamposm\Ping\Ping;
use Acamposm\Ping\PingCommandBuilder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function start()
    {
        try {
            DB::connection()->getPdo();



// Create an instance of PingCommand
            //$command = (new PingCommandBuilder('192.168.10.1'));

// Pass the PingCommand instance to Ping and run...
            //$ping = (new Ping($command))->run();

            $fecha=date("Y").'-'.(date("m")-1).'-'.date("d");
            $servicios = ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->join('users','servicio_usuario.id_usuario','=','users.id_user')
                ->join('persona','users.id_persona','=','persona.id_persona')
                ->select('servicio_usuario.id_servicio','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
                ->get();
            $total_servicios=$servicios->sum((int)'costo');
            $numero_de_clientes=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->join('users','servicio_usuario.id_usuario','=','users.id_user')
                ->join('persona','users.id_persona','=','persona.id_persona')
                ->get();
            $nuevos_clientes=ServicioUsuario::where('fecha','>',$fecha)->get();
            $sectores=sectors::get();
            $usuarios_sector=[];
            foreach ($sectores as $sector){
                $users=ServicioUsuario::where('id_sector',$sector->id_sector)
                    ->get();
                $sector->users=$users;
                array_push($usuarios_sector,sizeof($users));
            }
            $usuarios_sector=implode(",",$usuarios_sector);

            $años=ServicioUsuario::select('fecha')->get();

            $year = DB::table('servicio_usuario')->selectRaw('substr(fecha,1,4) as fecha')->pluck('fecha')->unique();
            $meses=new Collection();
            //$meses->push(new Collection(['numero'=>'01','nombre'=>'Enero']));
            //$meses->put('numero_meses',['01','02','03','04','05','06','07','08','09','10','11','12']);
            //$meses->put('nombre_meses',['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']);
            $nombres=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
            $numeros=['01','02','03','04','05','06','07','08','09','10','11','12'];




            $year_actual=$fecha=date("Y");
            $year_grafica=[$year_actual,"".($year_actual-1)."","".($year_actual-2).""];

            foreach ($year_grafica as $year){
                $datos=[];
                foreach ($numeros as $mes){
                    $data=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                        ->whereYear('fecha',$year)
                        ->whereMonth('fecha',$mes)
                        ->select('servicio.costo')
                        ->get();

                    $subtotal=0;
                    foreach ($data as $ganados){
                        $subtotal+=intval($ganados->costo);
                    }
                    //$subtotal=$data->sum((int)'costo');
                    array_push($datos,$subtotal);
                }
                $meses->push(new Collection(['datos'=>$datos]));
            }
            $datos_grafica=$meses->pluck('datos')->toArray();

            $este_mes = ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->join('users','servicio_usuario.id_usuario','=','users.id_user')
                ->join('persona','users.id_persona','=','persona.id_persona')
                ->select('servicio_usuario.id_servicio','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
                ->whereMonth('fecha',date("m"))
                ->get()->sum((int)'costo');

            // Si hoy es lunes, nos daría el lunes pasado.
            if (date("D")=="Mon"){
                $week_start = date("Y-m-d");
            } else {
                $week_start = date("Y-m-d", strtotime('last Monday', time()));
            }
            $week_end = date("Y-m-d", strtotime('next Sunday', time()));
            $week_end = date("Y-m-d",strtotime($week_end."+ 4 days"));

            $prueba=DB::select("SELECT SUM(servicio.costo) as total from servicio INNER JOIN servicio_usuario on servicio_usuario.id_servicio = servicio.id_servicio WHERE servicio_usuario.id_servicio_usuario in (SELECT servicio_usuario.id_servicio_usuario FROM servicio_usuario WHERE DATE_FORMAT(servicio_usuario.fecha,'%m-%d') >= DATE_FORMAT('".$week_start."','%m-%d')) AND DATE_FORMAT(servicio_usuario.fecha, '%m-%d') <= DATE_FORMAT('".$week_end."','%m-%d')");
            $esta_semana=$prueba[0]->total;

            /*$hoy=ServicioUsuario::select("id_servicio_usuario")
                ->where(DB::raw("(DATE_FORMAT(fecha,'%m-%d'))"),">=","(DATE_FORMAT('2022-12-05','%m-%d'))")
                ->get()->pluck('id_servicio_usuario')->toArray();*/

            $hoy=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->where(DB::raw("(DATE_FORMAT(fecha,'%m-%d'))"),"(DATE_FORMAT('".date('Y-m-d')."','%m-%d'))")
                ->select("servicio.costo")
                ->get()->sum('costo');

            //SELECT servicio.costo, servicio_usuario.fecha from servicio INNER JOIN servicio_usuario on servicio_usuario.id_servicio = servicio.id_servicio WHERE servicio_usuario.id_servicio_usuario in (SELECT servicio_usuario.id_servicio_usuario FROM servicio_usuario WHERE (MONTH(servicio_usuario.fecha) >= 10 AND DAY(servicio_usuario.fecha) >= 10)) AND DATE_FORMAT(servicio_usuario.fecha, '%m-%d') <= DATE_FORMAT('2022-10-16','%m-%d');
            //SELECT servicio.costo, servicio_usuario.fecha from servicio INNER JOIN servicio_usuario on servicio_usuario.id_servicio = servicio.id_servicio WHERE servicio_usuario.id_servicio_usuario in (SELECT servicio_usuario.id_servicio_usuario FROM servicio_usuario WHERE DATE_FORMAT(servicio_usuario.fecha,'%m-%d') >= DATE_FORMAT('2022-10-10','%m-%d')) AND DATE_FORMAT(servicio_usuario.fecha, '%m-%d') <= DATE_FORMAT('2022-10-16','%m-%d');

            $dias_mes=date('t');

            $servicios_por_dia=new Collection();



            for ($i=1; $i<($dias_mes+1); $i++){
                $dia=$i<10?"0".$i:$i;
                $servicios_por_dia->$dia=ServicioUsuario::whereDay('fecha',$dia)
                    ->select('id_servicio')
                    ->get();
            }

            $al_dia=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->join('users','servicio_usuario.id_usuario','=','users.id_user')
                ->join('persona','users.id_persona','=','persona.id_persona')
                ->whereDay('fecha','>',date('d')-4)
                ->select('servicio_usuario.id_servicio','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
                ->get();
            $con_retraso=ServicioUsuario::join('servicio','servicio_usuario.id_servicio','=','servicio.id_servicio')
                ->join('users','servicio_usuario.id_usuario','=','users.id_user')
                ->join('persona','users.id_persona','=','persona.id_persona')
                ->whereDay('fecha','<=',date('d')-5)
                ->select('servicio_usuario.id_servicio','persona.nombre','persona.ap','persona.am','servicio_usuario.IP','servicio.descripcion','servicio.costo')
                ->get();

            if (Auth::user()){
                $auth=Persona::join('users','persona.id_persona','=','users.id_persona')
                    ->join('tipo_usuario','users.id_tipo','=','tipo_usuario.id_tipo_usuario')
                    ->where('persona.id_persona',Auth::id())
                    ->get()->toArray();
            }
            else
                $auth=array([
                    0,
                    'nombre'=>'-',
                    'ap'=>'-',
                    'am'=>'-',
                    'descripcion'=>'Invitado'
                ]);
            //dd($auth);


            //return view('template',compact('sectores', 'numero_de_clientes', 'nuevos_clientes', 'servicios', 'total_servicios', 'años_grafica', 'datos_grafica','este_mes','esta_semana','hoy', 'al_dia', 'con_retraso','auth'));
            return view('general.inicio',compact('usuarios_sector','sectores', 'numero_de_clientes', 'nuevos_clientes', 'servicios', 'total_servicios', 'year_grafica', 'datos_grafica','este_mes','esta_semana','hoy', 'al_dia', 'con_retraso','auth'));


        } catch (\Exception $e) {
            return view('errors.db');
        }
    }

    public function cobertura(){
        return view('cobertura.mapa');
    }
    public function aps(){
        return view('cobertura.aps');
    }

    public function login(){
        return view('general.login');
    }
    public function contacto(){
        return view('general.contacto');
    }
}
