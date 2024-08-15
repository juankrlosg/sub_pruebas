<?php

namespace App\Http\Controllers;

use App\Models\Estados;
use App\Models\PaymentToken;
use App\Models\Persona;
use App\Models\Servicio;
use App\Models\ServicioUsuario;
use App\Models\TipoPaquete;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use function Symfony\Component\String\toString;

class SuscriptoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pago_ok($cadena){

        $monto = base64_decode($cadena);
        $date=Carbon::now('America/Mexico_City')->format('d-m-Y h:i:s');
        $token_data=$date.' '.$monto;
        $token_date=base64_encode($date);
        $token=base64_encode($token_data);

        return redirect(\url('/suscriptores/token_payment/'.$cadena.'/'.$token.'/'.$token_date));
    }

    public function token_payment($cadena,$token,$token_date){
        $token_data=base64_decode($token);
        $date=base64_decode($token_date);

        $today=Carbon::parse(Carbon::now('America/Mexico_City')->format('d-m-Y h:i:s'));
        $array_token=explode(' ',$token_data);
        $monto=base64_decode($cadena);
        $string_date=$array_token[0].' '.$array_token[1];
        try{
            $date=Carbon::createFromFormat('d-m-Y h:i:s',$string_date);

        }
        catch (InvalidFormatException $e){
            $date=null;
        }
        if (sizeof($array_token)==3 and $date!=null) {
            $diference=$today->diffInHours($date);
            $payment=PaymentToken::where('token', $token)->get();
            if (($array_token[0] . ' ' . $array_token[1] == $date AND $array_token[2] == $monto) OR $diference == 0) {
                if (!count($payment) > 0) {
                    $payment_data = PaymentToken::create(array(
                        'token' => $token,
                        'date' => Carbon::today()->format('Y-m-d'),
                        'amount' => $monto,
                    ));
                    return view('suscriptores.payment.ok', compact('payment_data'));

                } else {
                    $payment=$payment[0];
                    return view('suscriptores.payment.used', compact('payment', 'cadena', 'token', 'token_date'));
                }
            }
            else{
                return view('suscriptores.payment.error',compact('monto'));
            }
        }
        else{
            return view('suscriptores.payment.error',compact('monto'));
        }
    }

    public function get_proof($cadena,$id,$name,$token,$token_date){
        if(count(PaymentToken::where('id', $id)->where('owner',$name)->get())>0){
            $data=PaymentToken::where('id', $id)->where('owner',$name)->get()[0];
            $data->qr= QrCode::size(150)->style('round')->generate(route('validate_proof',[$cadena,$token,$token_date]));
            if (file_put_contents('qr-code-payments.svg',$data->qr))
                return $data;
            else
                return "error svg";
        }
        else return "error";
    }

    public function save_owner($name, $id){
        if (PaymentToken::where('id',$id)->update(['owner'=>$name]))
            return PaymentToken::where('id',$id)->get()[0];
        else
            return "error";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            "id_servicio" => "required",
            "name" => "required",
            "app" => "required",
            "apm" => "required",
            "localidad" => "required",
            "referencia" => "required",
            "telefono" => "required",
            "email" => "required"
        ]);
        if(!$validator->fails()){
            $persona=Persona::create(array(
                'nombre' => $request->get('name'),
                'ap' => $request->get('app'),
                'am' => $request->get('apm'),
                'telefono' => $request->get('telefono'),
                'id_localidad' => $request->get('localidad'),
                'referencia' => $request->get('referencia')
            ));
            $pass=$this->randomPassword();
            $user=User::create(array(
                'id_persona' => $persona->id_persona,
                'id_tipo' => 0,
                'email' => $request->get('email'),
                'password' => Hash::make($pass)
            ));
            $serv=ServicioUsuario::create(array(
                'id_servicio' => $request->get('id_servicio'),
                'id_usuario' => $user->id_user,
                'fecha' => date("Y-m-d H:i:s"),
                'id_estatus' => 3
            ));

            $orden=ServicioUsuario::join('servicio', 'servicio.id_servicio','=','servicio_usuario.id_servicio')
                ->join('users','users.id_user','=','servicio_usuario.id_usuario')
                ->join('persona','persona.id_persona','=','users.id_persona')
                ->join('localidades','localidades.id','=','persona.id_localidad')
                ->join('municipios','municipios.id','=','localidades.municipio_id')
                ->join('estados','estados.id','=','municipios.estado_id')
                ->select('persona.nombre as nom','persona.ap','persona.am','persona.telefono','localidades.nombre as nom_loc','municipios.nombre as nom_mun','estados.nombre as nom_est','persona.referencia','users.email','servicio_usuario.fecha','servicio.descripcion','servicio.nombre','servicio.up','servicio.down','servicio.costo','servicio.imagen')
                ->where('persona.id_persona',$persona->id_persona)
                ->get();
            $orden[0]->pass=$pass;
            $orden=$orden[0];

            return view('suscriptores.orden',compact('orden'));
        }
        else{
            Session::put('errors',$validator->errors());
            return back();
        }


    }
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data=User::join('servicio_usuario','users.id_user','=','servicio_usuario.id_usuario')
            ->join('persona','persona.id_persona','=','users.id_persona')
            ->select('users.id_user','persona.id_persona')
            ->where('servicio_usuario.id_servicio_usuario',$id)
            ->get();
        ServicioUsuario::destroy($id);
        User::destroy($data[0]->id_user);
        Persona::destroy($data[0]->id_persona);
        return back();
    }

    public function precontrato($id){

        $paquete=Servicio::join('tipo_paquete','tipo_paquete.id_tipo_paquete','=','servicio.id_tipo_paquete')
            ->where('servicio.id_servicio',$id)
            ->get();

        $paquetes=TipoPaquete::orderBy('id_tipo_paquete')->get();
        foreach ($paquetes as $paq){
            $paq->planes=Servicio::where('id_tipo_paquete',$paq->id_tipo_paquete)->where('id_servicio','<>',$id)->get();
        }

        $estados=Estados::where('activo',1)->orderBy('nombre')->get();
        return view('suscriptores.nuevo',compact('paquete','estados', 'paquetes'));
    }

    public function edit_data($id){
        $data_agreement=$orden=ServicioUsuario::join('servicio', 'servicio.id_servicio','=','servicio_usuario.id_servicio')
            ->join('users','users.id_user','=','servicio_usuario.id_usuario')
            ->join('persona','persona.id_persona','=','users.id_persona')
            ->join('localidades','localidades.id','=','persona.id_localidad')
            ->join('municipios','municipios.id','=','localidades.municipio_id')
            ->join('estados','estados.id','=','municipios.estado_id')
            //->select('persona.nombre as nom','persona.ap','persona.am','persona.telefono','localidades.nombre as nom_loc','municipios.nombre as nom_mun','estados.nombre as nom_est','persona.referencia','users.email','servicio_usuario.fecha','servicio.descripcion','servicio.nombre','servicio.up','servicio.down','servicio.costo','servicio.imagen')
            ->select('persona.nombre as nom','persona.ap','persona.am','persona.telefono','localidades.nombre as nom_loc','municipios.nombre as nom_mun','estados.nombre as nom_est','persona.referencia','persona.referencia','users.email','servicio_usuario.ip','servicio_usuario.señal','servicio_usuario.coordenada','servicio_usuario.fecha','servicio.id_servicio','servicio.nombre','servicio.up','servicio.down','servicio.costo','servicio.imagen')
            ->where('servicio_usuario.id_servicio_usuario',$id)
            ->get()[0];
        return view('suscriptores.editar',compact('data_agreement'));
        dd($data_agreement);
    }

    public function getImg($email, $pass){
        $img = new TextToImage;

        $text = 'Bienvenido a programacion.net.nEl portal de programacion en castellano.';
        $img->createImage($text);
    }

    public function getPhoneNum($data){
        if(  preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
        {
            $result = $matches[1] . ' - ' .$matches[2] . ' - ' . $matches[3];
            return $result;
        }
    }

    public function print_agreement($id){

        $data_agreement=$orden=ServicioUsuario::join('servicio', 'servicio.id_servicio','=','servicio_usuario.id_servicio')
            ->join('users','users.id_user','=','servicio_usuario.id_usuario')
            ->join('persona','persona.id_persona','=','users.id_persona')
            ->join('localidades','localidades.id','=','persona.id_localidad')
            ->join('municipios','municipios.id','=','localidades.municipio_id')
            ->join('estados','estados.id','=','municipios.estado_id')
            //->select('persona.nombre as nom','persona.ap','persona.am','persona.telefono','localidades.nombre as nom_loc','municipios.nombre as nom_mun','estados.nombre as nom_est','persona.referencia','users.email','servicio_usuario.fecha','servicio.descripcion','servicio.nombre','servicio.up','servicio.down','servicio.costo','servicio.imagen')
            ->select('persona.nombre as nom','persona.ap','persona.am','persona.telefono','localidades.nombre as nom_loc','municipios.nombre as nom_mun','estados.nombre as nom_est','persona.referencia','persona.referencia','users.email','servicio_usuario.ip','servicio_usuario.señal','servicio_usuario.coordenada','servicio_usuario.fecha','servicio.id_servicio','servicio.nombre','servicio.up','servicio.down','servicio.costo','servicio.imagen')
            ->where('servicio_usuario.id_servicio_usuario',$id)
            ->get()[0];
        //dd($data_agreement);

        $pdf = new PDF('P','mm',array(216,279));

        $pdf->SetStyle("p","courier","N",12,"10,100,250",15);
        $pdf->SetStyle("h1","times","N",11,"0,0,0");
        $pdf->SetStyle("regular","times","N",11,"0,0,0");
        $pdf->SetStyle("regular_min","times","N",7,"0,0,0",0);
        $pdf->SetStyle("strong","times","B",11,"0,0,0");
        $pdf->SetStyle("strong_min","times","B",7,"0,0,0");
        $pdf->SetStyle("blue","times","B",11,"0,0,148");
        $pdf->SetStyle("a","times","BU",9,"0,0,255");
        $pdf->SetStyle("pers","times","I",0,"255,0,0");
        $pdf->SetStyle("place","arial","U",0,"153,0,0");
        $pdf->SetStyle("vb","times","B",0,"102,153,153");

        $pdf->SetMargins(20,20);
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false, 20);
        $pdf->SetXY(20,34);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(172,5,"Folio: ".date("Y")."-A-".str_replace('.','-',$data_agreement->ip),0,1,'R');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(125,5,utf8_decode("Nombre: ".$data_agreement->ap.' '.$data_agreement->am.' '.$data_agreement->nom),0,0,'L');
        $pdf->Cell(17,5,"Fecha: ",0,0,'L');
        $pdf->Cell(30,5,Carbon::parse($data_agreement->fecha)->format('d / m / Y'),0,1,'R');
        $pdf->Cell(125,5,utf8_decode("Dirección: ".$data_agreement->nom_loc.', '.$data_agreement->nom_mun.', '.$data_agreement->nom_est),0,0,'L');
        $pdf->Cell(19,5,utf8_decode("Teléfono: "),0,0,'L');
        $pdf->Cell(28,5,utf8_decode($this->getPhoneNum($data_agreement->telefono)),0,1,'R');
        $pdf->Ln(2);
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(31,5,"Tipo de contrato: ",0,0,'L');
        $pdf->SetFont('Times','',11);
        $pdf->Cell(20,5,utf8_decode(" 1 Año   [   ] "),0,0,'R');
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(30,5,"Tipo de paquete: ",0,0,'L');
        $pdf->SetFont('Times','I',8);
        $pdf->Cell(20,5,"Internet",0,0,'L');
        $pdf->SetFont('Times','',8);
        $pdf->Cell(20,5,"5Mb [    ]",0,0,'L');
        $pdf->Cell(20,5,"10Mb [    ]",0,0,'L');
        $pdf->Cell(20,5,"15Mb [    ]",0,0,'L');
        $pdf->Cell(11,5,"Otro [   ]",0,1,'L');

        $x=0;
        if($data_agreement->id_servicio==1)
            $x=128;
        elseif ($data_agreement->id_servicio==2)
            $x=149;
        elseif ($data_agreement->id_servicio==3)
            $x=169;
        else
            $x=188;

        $pdf->Image('assets/images/tache.png',64,51,5,5);
        $pdf->Image('assets/images/tache.png',$x,51,5,5);


        $pdf->SetFont('Times','',11);
        $pdf->Cell(51,5,utf8_decode(" 2 Años [   ] "),0,0,'R');
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(30,5,"",0,0,'L');
        $pdf->SetFont('Times','',8);
        $pdf->Cell(20,5,"Antena [    ]",0,0,'L');
        $pdf->Cell(20,5,"F.O. [    ]",0,0,'L');
        $pdf->Cell(20,5,"Potencia:   ".$data_agreement->señal,0,0,'L');
        $pdf->Cell(20,5,"dB/dBm",0,0,'L');
        $pdf->Cell(11,5,"",0,1,'L');


        $pdf->SetFont('Times','B',11);
        $pdf->Cell(31,5,"Mensualidad:",0,0,'L');
        $pdf->SetFont('Times','',11);
        $pdf->Cell(20,5,utf8_decode("$  ".$data_agreement->costo ." . 00"),0,0,'C');
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(30,5,"",0,0,'L');
        $pdf->SetFont('Times','',8);
        $pdf->Cell(20,5,"Coordenada:",0,0,'L');
        $pdf->Cell(20,5,$data_agreement->coordenada,0,0,'L');
        $pdf->Cell(20,5,"Router: ",0,0,'L');
        $pdf->Cell(31,5,utf8_decode("Contraseña:"),0,1,'L');
        $pdf->Ln(3);

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(172,5,"Obligaciones",0,1,'C');
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(172,5,"Por parte del suscriptor:",0,1,'L');

        $pdf->SetFont('Times','',11);
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular>El Cliente <strong>tendrá de tolerancia 4 días</strong> para pagar su mensualidad <strong>en caso contrario el servicio será suspendido</strong> hasta que realice el pago.</regular>"));
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular>Deberá <strong>resguardar</strong> el equipo inalámbrico, en caso de anomalías deberá contactar a la empresa.</regular>"));
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular>Deberá <strong>entregar</strong> el equipo inalámbrico al término del contrato, siempre y cuando ya no requiera el servicio.</regular>"));
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular><strong>No debe</strong> resetear o restaurar a los valores de fábrica de su modem inalámbrico. La reconfiguración y reparación de daños intencionales a la instalación del servicio tiene un <strong>costo adicional del $250.00</strong></regular>"));
        $pdf->Ln();

        $pdf->SetFont('Times','B',11);
        $pdf->Cell(172,5,"Por parte de la empresa:",0,1,'L');

        $pdf->SetFont('Times','',11);
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular>Deberá sustituir el equipo del cliente en caso de que presente fallas por descargas de corriente eléctrica con un costo adicional para el suscriptor de $750.00 pesos, por lo cual se le recomienda al <strong>SUSCRIPTOR</strong>  que <strong>en lluvias fuertes desconecte los dispositivos</strong>. En caso de alguna otro falla la empresa se hará cargo de los gastos.</regular>"));
        //$pdf->MultiCellBlt(17,5,chr(149),utf8_decode(""),0,'',0);
        $pdf->WriteTagBlt(172,5,chr(149),utf8_decode("<regular>Deberá dar solución a las situaciones que provoquen la <strong>interrupción del servicio</strong> de internet en un periodo <strong>no mayor a 72 horas</strong>, de lo contrario, se realizará el <strong>descuento correspondiente</strong> a los días de afectación del servicio.</regular>"));
        $pdf->Ln();
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(172,5,"Observaciones:",0,1,'L');

        $pdf->SetFont('Times','',11);
        $pdf->MultiCellBlt(172,5,chr(149),utf8_decode("El rendimiento del equipo podría verse disminuido en días nublados o lluviosos."));

        $pdf->Ln(20);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(86, 5, "FENIX NETWORKS S.A.",0,0,'C');
        $pdf->Cell(86, 5, "SUSCRIPTOR",0,1,'C');

        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(32,183,93,183);
        $pdf->Line(119,183,180,183);

        $pdf->Image('assets/images/FirmaFN.png',40,168,40);

        $pdf->Ln();
        $pdf->WriteTag(172,5,utf8_decode("<strong>Instrucciones de pago:</strong> <regular>Los pagos deberán realizarse de acuerdo con la fecha señalada en su contrato, <strong>un atraso en los pagos causará suspensión del servicio</strong>, el pago se realizará mediante una transferencia electrónica o deposito en <strong>(SANTANDER), (OXXO), (TELÉGRAFOS), (CHEDRAUI), (SORIANA).</strong></regular>"));
        $pdf->Ln(8);

        $pdf->Image('assets/images/santander.png',38,208,22);
        $pdf->Image('assets/images/coppel.png',95,212,22);
        $pdf->Image('assets/images/stp.png',160,212,10);

        $pdf->Cell(57,5,"5579 1003 8168 7308",0,0,'C',0,0);
        $pdf->Cell(58,5,"4169 1604 3666 9304",0,0,'C',0,0);
        $pdf->Cell(57,5,"5387 5606 2236 9861",0,0,'C',0,0);
        $pdf->Ln(3);
        $pdf->Cell(115,5,"",0,0,'C',0,0);
        $pdf->SetFont('Times','B',7);
        $pdf->Cell(57,5,utf8_decode("SOLO TRASFERENCIA ELECTRÓNICA"),0,1,'C',0,0);
        $pdf->Ln(3);

        $pdf->WriteTag(172,5,utf8_decode("<regular>Una vez realizado el depósito <strong>deberá enviar una foto de su comprobante de pago</strong> al WhatsApp <blue>7228352010</blue> <strong>con su nombre completo escrito</strong> para comprobar su pago, <strong>si el comprobante no es enviado causará suspensión del servicio.</strong></regular>"));
        $pdf->Ln(4);

        $pdf->Cell(172,5,utf8_decode("Horario de atención a clientes"),0,1,'R');
        $pdf->Cell(86,5,utf8_decode("WhatsApp: 7228352010, 7225547216"),0,0,'L');
        $pdf->Cell(86,5,utf8_decode("Lunes a Sábado"),0,1,'R');
        $pdf->SetTextColor(0,0,148);
        $pdf->Write(5,utf8_decode("https://www.fenix-networks.com.mx"),"https://www.fenix-networks.com.mx");
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(112,5,utf8_decode("9:00 am a 6:00 pm"),0,1,'R');

        $pdf->AddPage('P','Letter');

        $pdf->Ln(3);
        $pdf->Cell(172,5,"CLAUSULAS DEL CONTRATO",0,1,'C');

        $pdf->Ln(5);
        $this_y=$pdf->GetY();
        $pdf->SetFont('Times','','7');
        $pdf->WriteTag(85,3,utf8_decode('<regular_min>Los que suscribimos libre y voluntariamente, convenimos en celebrar el presente contrato de acuerdo con los términos y condiciones que más adelante se detallan:</regular_min>'),0,'J');
        $pdf->Ln();
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA PRIMERA: OBJETO. - FENIX NETWORKS S.A.</strong_min> se obliga única y exclusivamente a proporcionar <strong_min>AL SUSCRIPTOR</strong_min> el Servicio de acceso a la red de INTERNET vía inalámbrica. La calidad y disponibilidad del servicio estará en función de las condiciones técnicas y meteorológicas prevalecientes en la zona de cobertura. <strong_min>FENIX NETWORKS S.A.</strong_min> no será responsable de los daños y perjuicios que pueda sufrir <strong_min>EL SUSCRIPTOR:</strong_min> por el uso de programas o información enviados, recibidos o utilizados a través de la red; por intercepción o manipulación de la información recibida o enviada a través de la red; por presencia de virus, por el uso de equipos de computación o líneas telefónicas y en general por todo daño o perjuicio ajeno a su obligación de dar acceso <strong_min>AL SUSCRIPTOR</strong_min> a la red de INTERNET.</regular_min>"));
        $pdf->Ln();
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA SEGUNDA: RESPONSABILIDADES DEL SUSCRIPTOR. - EL SUSCRIPTOR</strong_min> será responsable sobre la información que solicite, reciba y transmita. En consecuencia, <strong_min>EL SUSCRIPTOR</strong_min> no deberá recibir, utilizar o enviar, a través de la red, información o programas que requieran autorización previa de su propietario. <strong_min>EL SUSCRIPTOR</strong_min> no deberá transmitir noticias o mensajes cuyo texto sea contrario a la seguridad del Estado, a la concordia internacional, a la paz, al orden público, a las buenas costumbres, a las leyes de la República y a la decencia del lenguaje; o que perjudique a los intereses culturales o económicos de la nación, causen escándalo o ataquen en cualquier forma al Gobierno, a la vida privada, o que tenga por objeto la comisión de algún delito u obstruyan la acción de la justicia. <strong_min>EL SUSCRIPTOR</strong_min> no deberá permitir que personas que no hayan suscrito el correspondiente contrato, por cualquier medio o de cualquier forma, utilicen, directa o indirectamente, los servicios prestados por <strong_min>FENIX NETWORKS S.A.</strong_min> En consecuencia, <strong_min>EL SUSCRIPTOR</strong_min> será responsable ante <strong_min>FENIX NETWORKS S.A.</strong_min> por el uso del servicio prestado por <strong_min>FENIX NETWORKS S.A.</strong_min> por parte de terceros, en cuyo caso deberá pagar la factura que por este motivo emita <strong_min>FENIX NETWORKS S.A.</strong_min> en su contra. En caso de cualquier controversia entre <strong_min>EL SUSCRIPTOR</strong_min> y proveedores de información o programas a través de la red, <strong_min>EL SUSCRIPTOR</strong_min> deberá mantener indemne a <strong_min>FENIX NETWORKS S.A.</strong_min> de cualquier efecto que dicha controversia pueda ocasionar a la misma. <strong_min>EL SUSCRIPTOR</strong_min> deberá brindar todas las facilidades a <strong_min>FENIX NETWORKS S.A.</strong_min> con el objeto de instalar e inspeccionar en cualquier tiempo los equipos y programas de computación a través de los cuales <strong_min>EL SUSCRIPTOR</strong_min> recibe el servicio prestado por <strong_min>FENIX NETWORKS S.A.</strong_min> Los derechos y obligaciones que se estipulan en este contrato son personales, por lo que <strong_min>EL SUSCRIPTOR</strong_min> no podrá cederlos o traspasarlos sin la previa autorización por escrito de <strong_min>FENIX NETWORKS S.A.</strong_min> Los servicios de adecuación de infraestructura, de instalación y otros de carácter computacional que preste <strong_min>FENIX NETWORKS S.A.</strong_min>, así como el costo de los materiales y mano de obra, serán facturados independientemente. <strong_min>EL SUSCRIPTOR</strong_min> declara bajo protesta de decir la verdad, con la firma de este contrato, que es sujeto jurídico para el arrendamiento del equipo proporcionado y que cumplirá con las obligaciones directas o indirectas y de cualquier naturaleza que fueren y que se derivaren del uso de este. En caso de hurto, robo, pérdida o daño del equipo, <strong_min>FENIX NETWORKS S.A.</strong_min> continuará facturando <strong_min>AL SUSCRIPTOR</strong_min> por el servicio, siendo obligación del <strong_min>SUSCRIPTOR</strong_min> reponer inmediatamente el equipo de computación y en general todos los equipos e instalaciones que permitan que <strong_min>FENIX NETWORKS S.A.</strong_min> continúe prestando el servicio <strong_min>AL SUSCRIPTOR. EL SUSCRIPTOR</strong_min> se obliga a realizar todos los pagos de las cantidades que correspondan y que consten en la respectiva factura. <strong_min>CLAUSULA TERCERA: PAGOS. - EL SUSCRIPTOR</strong_min> pagará a <strong_min>FENIX NETWORKS</strong_min> por el servicio prestado, las cantidades que correspondan conforme a las tarifas establecidas, las cuales podrán variar de tiempo en tiempo según lo determine <strong_min>FENIX NETWORKS S.A.</strong_min> con previo aviso de al menos un mes de anterioridad a dichos cambios. El presente contrato ampara el acceso a internet de equipo (s) de cómputo. La modificación de esta condición sin previo aviso a <strong_min>FENIX NETWORKS S.A.</strong_min> podrá ser motivo de cancelación del servicio y rescisión del presente sin que <strong_min>EL SUSCRIPTOR</strong_min> pueda reclamar indemnización o contraprestación alguna. <strong_min>EL SUSCRIPTOR</strong_min> se obliga a pagar a <strong_min>FENIX NETWORKS S.A.</strong_min> los valores que consten en la respectiva factura. El sistema de pago para cubrir las cantidades amparadas en cada factura deberá ser efectuado en el lugar que <strong_min>FENIX NETWORKS S.A.</strong_min> le indique y durante los primeros 4 días del mes correspondiente a la prestación del servicio. Si <strong_min>EL SUSCRIPTOR</strong_min> no hiciere lo señalado anteriormente, <strong_min>FENIX NETWORKS S.A.</strong_min> tendrá derecho a rescindir el presente contrato, y, además, en caso de existir deudas pendientes por parte <strong_min>DEL SUSCRIPTOR</strong_min>, <strong_min>FENIX NETWORKS S.A.</strong_min> podrá proceder al cobro de dichos valores conforme lo prevé este contrato. De acuerdo con la cláusula anterior, <strong_min>EL SUSCRIPTOR</strong_min> expresamente declara y acepta, sin reservas de ninguna naturaleza y renunciando a cualquier excepción que pudiere favorecerle en juicio, que las obligaciones de pago del servicio prestado por <strong_min>FENIX NETWORKS S.A.</strong_min>, consecuentemente, <strong_min>EL SUSCRIPTOR</strong_min> renuncia expresamente al trámite ejecutivo para cualquier litigio derivado del incumplimiento de sus obligaciones contractuales</regular_min>"));


        $pdf->SetXY(111,$this_y);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min>con <strong_min>FENIX NETWORKS S.A.</strong_min>, liberando a <strong_min>FENIX NETWORKS S.A.</strong_min> del trámite de notificación previa en caso de cesión de sus derechos, cualquier título, y aprobándola desde ahora en todas sus partes. En caso de que <strong_min>EL SUSCRIPTOR</strong_min> o cubra a <strong_min>FENIX NETWORKS S.A.</strong_min> la totalidad de la cantidad constante en la factura de cada mes, se procederá a disminuir velocidad de navegación, contando con una prórroga de cuatro días, a partir del cuarto de cada mes y en caso de no cubrir el monto estipulado, se procederá a la suspensión del servicio sin que afecte en la continuidad del cobrode este.</regular_min>"));
        //$pdf->Ln();
        $pdf->SetX(111);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA CUARTA: SUSPENSIÓN Y TERMINACIÓN, - FENIX NETWORKS</strong_min> podrá suspender el servicio cuando <strong_min>EL SUSCRIPTOR</strong_min> no pague los valores adeudados a <strong_min>FENIX NETWORKS S.A.</strong_min> dentro del plazo que tiene que hacerlo y que consta en la factura correspondiente. <strong_min>FENIX NETWORKS S.A.</strong_min> podrá dar por terminado el presente contrato en los siguientes casos: Cuando <strong_min>EL SUSCRIPTOR</strong_min> no pague las cantidades adeudadas, en el plazo de 30 días siguientes a la fecha de la suspensión del servicio. Cuando <strong_min>EL SUSCRIPTOR</strong_min> ceda, transfiera o negocie de cualquier forma los derechos derivados del presente contrato. Por incumplimiento por parte <strong_min>DEL SUSCRIPTOR</strong_min> de cualquiera de las obligaciones a su cargo contenidas en este contrato. <strong_min>EL SUSCRIPTOR</strong_min> se obliga a <strong_min>ENTREGAR EL EQUIPO DE ACCESO A INTERNET (ANTENA Y MODEM) a FENIX NETWORKS S.A.</strong_min> al finalizar su contrato.</regular_min>"));
        $pdf->SetX(111);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA QUINTA: PLAZO. - 5.1.-</strong_min>El presente contrato será de plazo máximo indefinido, a partir de la suscripción de este. En caso de que <strong_min>EL SUSCRIPTOR</strong_min> deseare darlo por terminado, deberá notificar a <strong_min>FENIX NETWORKS S.A.</strong_min> con 30 días de anticipación y además deberá pagar a <strong_min>FENIX NETWORKS S.A.</strong_min> cualquier valor pendiente de pago por cualquier concepto, y además el valor correspondiente a desactivación y desinstalación del equipo proporcionado en resguardo. <strong_min>5.2.-</strong_min>Sin perjuicio de lo convenido en el numeral anterior, <strong_min>EL SUSCRIPTOR</strong_min> expresamente conviene con <strong_min>FENIX NETWORKS S.A.</strong_min>, en forma libre y voluntaria, que el presente contrato tendrá una duración mínima de 12 MESES contados desde la fecha de su suscripción, sin que <strong_min>EL SUSCRIPTOR</strong_min> pueda darlo por terminado unilateralmente antes del plazo mínimo convenido. En caso de que <strong_min>EL SUSCRIPTOR</strong_min>, por cualquier causa incumpliere con el plazo mínimo convenido, <strong_min>EL SUSCRIPTOR</strong_min> deberá pagar a <strong_min>FENIX NETWORKS S.A.</strong_min>, además de todas las obligaciones pendientes de pago por cualquier otro concepto, una penalización equivalente a $300.00 pesos por cada uno de los meses que faltaren para completar el plazo mínimo convenido.</regular_min>"));
        $pdf->SetX(111);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA SEXTA: DECLARACIONES:</strong_min> En el caso de que <strong_min>EL SUSCRIPTOR</strong_min> sea parte actora o demandada en cualquier juicio, litigio o controversia con los proveedores de información, o con cualquier otra persona natural o jurídica que tenga relación con las redes de información, declara que mantendrá indemne de tales juicios o litigios a <strong_min>FENIX NETWORKS S.A. El SUSCRIPTOR</strong_min> declara que respetará y acatará todas las normas sobre derechos de propiedad o derechos de autor, especialmente los que rigen los programas de ordenador y bases de datos vigentes en México y en todos los países enlazados por el servicio de Internet <strong_min>El SUSCRIPTOR</strong_min> declara que renuncia a cualquier acción en contra de <strong_min>FENIX NETWORKS S.A.</strong_min>, por cualquier circunstancia que dé origen a un reclamo por daños y perjuicios en su contra o de terceros, originados por el uso de cualquiera de los servicios que brinda <strong_min>FENIX NETWORKS S.A.</strong_min></regular_min>"));
        $pdf->SetX(111);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>CLAUSULA SÉPTIMA: NOTIFICACIONES Y DOMICILIOS. - 7.1.-</strong_min>Las partes señalan como domicilios convencionales los siguientes: <strong_min>EL SUSCRIPTOR</strong_min> en: ".strtoupper($data_agreement->nom_loc.', '.$data_agreement->nom_mun.', '.$data_agreement->nom_est).", <strong_min>FENIX NETWORKS S.A.</strong_min> en: CALLE GUATEMALA S/N, COLONIA LAS AMÉRICAS, ZACATEPEC, CP: 51400, TEJUPILCO, EDO. MEX. 7.2.-Cualquier cambio de domicilio deberá ser notificado por <strong_min>EL SUSCRIPTOR</strong_min> a <strong_min>FENIX NETWORKS S.A.</strong_min> con anterioridad a que éste ocurra para el traslado del equipo y determinar si se cuenta con la cobertura del servicio en el nuevo domicilio. En caso de incumplimiento de esta obligación, <strong_min>FENIX NETWORKS S.A.</strong_min> podrá dar por terminado el presente contrato, sin perjuicio de que cualquier notificación causará efectos en el domicilio anterior.</regular_min>"));
        $pdf->SetX(111);
        $pdf->WriteTag(85,3,utf8_decode("<regular_min><strong_min>ACEPTACIÓN: EL SUSCRIPTOR</strong_min> acepta y se obliga en los términos de todas y cada una de las cláusulas y condiciones que anteceden. La aceptación de <strong_min>FENIX NETWORKS S.A.</strong_min> estará dada por el servicio que provea <strong_min>AL SUSCRIPTOR</strong_min> a través de su red o Internet, aceptación que tendrá como respaldo la carta de aceptación del servicio contratado, debidamente firmada por <strong_min>EL SUSCRIPTOR.</strong_min> Para constancia y fiel cumplimiento de lo expuesto, las partes firman por duplicado:</regular_min>"));


        $pdf->Ln(12);
        $pdf->SetX(111);
        $pdf->SetFont('Times','B',7);
        $pdf->Cell(44, 5, "FENIX NETWORKS S.A.",0,0,'C');
        $pdf->Cell(44, 5, "SUSCRIPTOR",0,1,'C');

        $pdf->SetDrawColor(0,0,0);
        $pdf->Line(112,238,150,238);
        $pdf->Line(156,238,194,238);

        $pdf->Image('assets/images/FirmaFN.png',115,227,30);

        $pdf->SetTitle("Contrato ".$data_agreement->nom_loc.', '.$data_agreement->nom_mun.', '.$data_agreement->nom_est);
        $pdf->AliasNbPages();
        $pdf->Output('D','Contrato '.$data_agreement->nom.' '.$data_agreement->ap.' '.$data_agreement->am);
        exit();
    }
}



class PDF extends \FPDF
{
    protected $wLine; // Maximum width of the line
    protected $hLine; // Height of the line
    protected $Text; // Text to display
    protected $border;
    protected $align; // Justification of the text
    protected $fill;
    protected $Padding;
    protected $lPadding;
    protected $tPadding;
    protected $bPadding;
    protected $rPadding;
    protected $TagStyle; // Style for each tag
    protected $Indent;
    protected $Bullet; // Bullet character
    protected $Space; // Minimum space between words
    protected $PileStyle;
    protected $Line2Print; // Line to display
    protected $NextLineBegin; // Buffer between lines
    protected $TagName;
    protected $Delta; // Maximum width minus width
    protected $StringLength;
    protected $LineLength;
    protected $wTextLine; // Width minus paddings
    protected $nbSpace; // Number of spaces in the line
    protected $Xini; // Initial position
    protected $href; // Current URL
    protected $TagHref; // URL for a cell
    protected $LastLine;

    function Header(){
        $this->Image('assets/images/LOGO-PNG-SIN-FONDO.png',20,10,20);
        $this->Image('assets/images/wifi.png',172,12,20);
        $this->SetY(17);
        $this->SetFont('Arial','B',12);
        $this->Cell(172,3,utf8_decode('Contrato de Renta de Equipo Inalámbrico'),0,1,'C');
    }

    function Footer(){
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times','',11);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
    function TextWithDirection($x, $y, $txt, $direction='R')
    {
        if ($direction=='R')
            $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',1,0,0,1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        elseif ($direction=='L')
            $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',-1,0,0,-1,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        elseif ($direction=='U')
            $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,1,-1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        elseif ($direction=='D')
            $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',0,-1,1,0,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        else
            $s=sprintf('BT %.2F %.2F Td (%s) Tj ET',$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }

    function toSpanish($text){
        if (strtolower($text)=='jan') return 'Enero';
        elseif (strtolower($text)=='feb') return 'Febrero';
        elseif (strtolower($text)=='mar') return 'Marzo';
        elseif (strtolower($text)=='apr') return 'Abril';
        elseif (strtolower($text)=='may') return 'Mayo';
        elseif (strtolower($text)=='jun') return 'Junio';
        elseif (strtolower($text)=='jul') return 'Julio';
        elseif (strtolower($text)=='aug') return 'Agosto';
        elseif (strtolower($text)=='sep') return 'Septiembre';
        elseif (strtolower($text)=='oct') return 'Octubre';
        elseif (strtolower($text)=='nov') return 'Noviembre';
        elseif (strtolower($text)=='dec') return 'Diciembre';
    }

    function MultiCellBlt($w, $h, $blt, $txt, $border=0, $align='J', $fill=false)
    {
        //Get bullet width including margins
        $blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;

        //Save x
        $bak_x = $this->x;

        //Output bullet
        $this->SetX(23);
        $this->Cell($blt_width,$h,$blt,0,'',$fill);

        //Output text
        $this->MultiCell($w-$blt_width-3,$h,$txt,$border,$align,$fill);

        //Restore x
        $this->x = $bak_x;
    }


    function WriteTagBlt($w, $h, $blt, $txt, $border=0, $align="J", $fill=false, $padding=0)
    {
        //Get bullet width including margins
        $blt_width = $this->GetStringWidth($blt)+$this->cMargin*2;

        //Save x
        $bak_x = $this->x;

        //Output bullet
        $this->SetX(23);
        $this->Cell($blt_width,$h,$blt,0,'');

        $this->WriteTag($w-$blt_width-3,$h,$txt,0,'J',0,0);
        //Restore x
    }



    function WriteTag($w, $h, $txt, $border=0, $align="J", $fill=false, $padding=0)
    {
        $this->wLine=$w;
        $this->hLine=$h;
        $this->Text=trim($txt);
        $this->Text=preg_replace("/\n|\r|\t/","",$this->Text);
        $this->border=$border;
        $this->align=$align;
        $this->fill=$fill;
        $this->Padding=$padding;

        $this->Xini=$this->GetX();
        $this->href="";
        $this->PileStyle=array();
        $this->TagHref=array();
        $this->LastLine=false;
        $this->NextLineBegin=array();

        $this->SetSpace();
        $this->Padding();
        $this->LineLength();
        $this->BorderTop();

        while($this->Text!="")
        {
            $this->MakeLine();
            $this->PrintLine();
        }

        $this->BorderBottom();
    }


    function SetStyle($tag, $family, $style, $size, $color, $indent=-1, $bullet='')
    {
        $tag=trim($tag);
        $this->TagStyle[$tag]['family']=trim($family);
        $this->TagStyle[$tag]['style']=trim($style);
        $this->TagStyle[$tag]['size']=trim($size);
        $this->TagStyle[$tag]['color']=trim($color);
        $this->TagStyle[$tag]['indent']=$indent;
        $this->TagStyle[$tag]['bullet']=$bullet;
    }


    // Private Functions

    function SetSpace() // Minimal space between words
    {
        $tag=$this->Parser($this->Text);
        $this->FindStyle($tag[2],0);
        $this->DoStyle(0);
        $this->Space=$this->GetStringWidth(" ");
    }


    function Padding()
    {
        if(preg_match("/^.+,/",$this->Padding)) {
            $tab=explode(",",$this->Padding);
            $this->lPadding=$tab[0];
            $this->tPadding=$tab[1];
            if(isset($tab[2]))
                $this->bPadding=$tab[2];
            else
                $this->bPadding=$this->tPadding;
            if(isset($tab[3]))
                $this->rPadding=$tab[3];
            else
                $this->rPadding=$this->lPadding;
        }
        else
        {
            $this->lPadding=$this->Padding;
            $this->tPadding=$this->Padding;
            $this->bPadding=$this->Padding;
            $this->rPadding=$this->Padding;
        }
        if($this->tPadding<$this->LineWidth)
            $this->tPadding=$this->LineWidth;
    }


    function LineLength()
    {
        if($this->wLine==0)
            $this->wLine=$this->w - $this->Xini - $this->rMargin;

        $this->wTextLine = $this->wLine - $this->lPadding - $this->rPadding;
    }


    function BorderTop()
    {
        $border=0;
        if($this->border==1)
            $border="TLR";
        $this->Cell($this->wLine,$this->tPadding,"",$border,0,'C',$this->fill);
        $y=$this->GetY()+$this->tPadding;
        $this->SetXY($this->Xini,$y);
    }


    function BorderBottom()
    {
        $border=0;
        if($this->border==1)
            $border="BLR";
        $this->Cell($this->wLine,$this->bPadding,"",$border,0,'C',$this->fill);
    }


    function DoStyle($ind) // Applies a style
    {
        if(!isset($this->TagStyle[$ind]))
            return;

        $this->SetFont($this->TagStyle[$ind]['family'],
            $this->TagStyle[$ind]['style'],
            $this->TagStyle[$ind]['size']);

        $tab=explode(",",$this->TagStyle[$ind]['color']);
        if(count($tab)==1)
            $this->SetTextColor($tab[0]);
        else
            $this->SetTextColor($tab[0],$tab[1],$tab[2]);
    }


    function FindStyle($tag, $ind) // Inheritance from parent elements
    {
        $tag=trim($tag);

        // Family
        if($this->TagStyle[$tag]['family']!="")
            $family=$this->TagStyle[$tag]['family'];
        else
        {
            foreach($this->PileStyle as $val)
            {
                $val=trim($val);
                if($this->TagStyle[$val]['family']!="") {
                    $family=$this->TagStyle[$val]['family'];
                    break;
                }
            }
        }

        // Style
        $style="";
        $style1=strtoupper($this->TagStyle[$tag]['style']);
        if($style1!="N")
        {
            $bold=false;
            $italic=false;
            $underline=false;
            foreach($this->PileStyle as $val)
            {
                $val=trim($val);
                $style1=strtoupper($this->TagStyle[$val]['style']);
                if($style1=="N")
                    break;
                else
                {
                    if(strpos($style1,"B")!==false)
                        $bold=true;
                    if(strpos($style1,"I")!==false)
                        $italic=true;
                    if(strpos($style1,"U")!==false)
                        $underline=true;
                }
            }
            if($bold)
                $style.="B";
            if($italic)
                $style.="I";
            if($underline)
                $style.="U";
        }

        // Size
        if($this->TagStyle[$tag]['size']!=0)
            $size=$this->TagStyle[$tag]['size'];
        else
        {
            foreach($this->PileStyle as $val)
            {
                $val=trim($val);
                if($this->TagStyle[$val]['size']!=0) {
                    $size=$this->TagStyle[$val]['size'];
                    break;
                }
            }
        }

        // Color
        if($this->TagStyle[$tag]['color']!="")
            $color=$this->TagStyle[$tag]['color'];
        else
        {
            foreach($this->PileStyle as $val)
            {
                $val=trim($val);
                if($this->TagStyle[$val]['color']!="") {
                    $color=$this->TagStyle[$val]['color'];
                    break;
                }
            }
        }

        // Result
        $this->TagStyle[$ind]['family']=$family;
        $this->TagStyle[$ind]['style']=$style;
        $this->TagStyle[$ind]['size']=$size;
        $this->TagStyle[$ind]['color']=$color;
        $this->TagStyle[$ind]['indent']=$this->TagStyle[$tag]['indent'];
    }


    function Parser($text)
    {
        $tab=array();
        // Closing tag
        if(preg_match("|^(</([^>]+)>)|",$text,$regs)) {
            $tab[1]="c";
            $tab[2]=trim($regs[2]);
        }
        // Opening tag
        else if(preg_match("|^(<([^>]+)>)|",$text,$regs)) {
            $regs[2]=preg_replace("/^a/","a ",$regs[2]);
            $tab[1]="o";
            $tab[2]=trim($regs[2]);

            // Presence of attributes
            if(preg_match("/(.+) (.+)='(.+)'/",$regs[2])) {
                $tab1=preg_split("/ +/",$regs[2]);
                $tab[2]=trim($tab1[0]);
                foreach($tab1 as $i=>$couple)
                {
                    if($i>0) {
                        $tab2=explode("=",$couple);
                        $tab2[0]=trim($tab2[0]);
                        $tab2[1]=trim($tab2[1]);
                        $end=strlen($tab2[1])-2;
                        $tab[$tab2[0]]=substr($tab2[1],1,$end);
                    }
                }
            }
        }
        // Space
        else if(preg_match("/^( )/",$text,$regs)) {
            $tab[1]="s";
            $tab[2]=' ';
        }
        // Text
        else if(preg_match("/^([^< ]+)/",$text,$regs)) {
            $tab[1]="t";
            $tab[2]=trim($regs[1]);
        }

        $begin=strlen($regs[1]);
        $end=strlen($text);
        $text=substr($text, $begin, $end);
        $tab[0]=$text;

        return $tab;
    }


    function MakeLine()
    {
        $this->Text.=" ";
        $this->LineLength=array();
        $this->TagHref=array();
        $Length=0;
        $this->nbSpace=0;

        $i=$this->BeginLine();
        $this->TagName=array();

        if($i==0) {
            $Length=$this->StringLength[0];
            $this->TagName[0]=1;
            $this->TagHref[0]=$this->href;
        }

        while($Length<=$this->wTextLine)
        {
            $tab=$this->Parser($this->Text);
            $this->Text=$tab[0];
            if($this->Text=="") {
                $this->LastLine=true;
                break;
            }

            if($tab[1]=="o") {
                array_unshift($this->PileStyle,$tab[2]);
                $this->FindStyle($this->PileStyle[0],$i+1);

                $this->DoStyle($i+1);
                $this->TagName[$i+1]=1;
                if($this->TagStyle[$tab[2]]['indent']!=-1) {
                    $Length+=$this->TagStyle[$tab[2]]['indent'];
                    $this->Indent=$this->TagStyle[$tab[2]]['indent'];
                    $this->Bullet=$this->TagStyle[$tab[2]]['bullet'];
                }
                if($tab[2]=="a")
                    $this->href=$tab['href'];
            }

            if($tab[1]=="c") {
                array_shift($this->PileStyle);
                if(isset($this->PileStyle[0]))
                {
                    $this->FindStyle($this->PileStyle[0],$i+1);
                    $this->DoStyle($i+1);
                }
                $this->TagName[$i+1]=1;
                if($this->TagStyle[$tab[2]]['indent']!=-1) {
                    $this->LastLine=true;
                    $this->Text=trim($this->Text);
                    break;
                }
                if($tab[2]=="a")
                    $this->href="";
            }

            if($tab[1]=="s") {
                $i++;
                $Length+=$this->Space;
                $this->Line2Print[$i]="";
                if($this->href!="")
                    $this->TagHref[$i]=$this->href;
            }

            if($tab[1]=="t") {
                $i++;
                $this->StringLength[$i]=$this->GetStringWidth($tab[2]);
                $Length+=$this->StringLength[$i];
                $this->LineLength[$i]=$Length;
                $this->Line2Print[$i]=$tab[2];
                if($this->href!="")
                    $this->TagHref[$i]=$this->href;
            }

        }

        trim($this->Text);
        if($Length>$this->wTextLine || $this->LastLine==true)
            $this->EndLine();
    }


    function BeginLine()
    {
        $this->Line2Print=array();
        $this->StringLength=array();

        if(isset($this->PileStyle[0]))
        {
            $this->FindStyle($this->PileStyle[0],0);
            $this->DoStyle(0);
        }

        if(count($this->NextLineBegin)>0) {
            $this->Line2Print[0]=$this->NextLineBegin['text'];
            $this->StringLength[0]=$this->NextLineBegin['length'];
            $this->NextLineBegin=array();
            $i=0;
        }
        else {
            preg_match("/^(( *(<([^>]+)>)* *)*)(.*)/",$this->Text,$regs);
            $regs[1]=str_replace(" ", "", $regs[1]);
            $this->Text=$regs[1].$regs[5];
            $i=-1;
        }

        return $i;
    }


    function EndLine()
    {
        if(end($this->Line2Print)!="" && $this->LastLine==false) {
            $this->NextLineBegin['text']=array_pop($this->Line2Print);
            $this->NextLineBegin['length']=end($this->StringLength);
            array_pop($this->LineLength);
        }

        while(end($this->Line2Print)==="")
            array_pop($this->Line2Print);

        $this->Delta=$this->wTextLine-end($this->LineLength);

        $this->nbSpace=0;
        for($i=0; $i<count($this->Line2Print); $i++) {
            if($this->Line2Print[$i]=="")
                $this->nbSpace++;
        }
    }


    function PrintLine()
    {
        $border=0;
        if($this->border==1)
            $border="LR";
        $this->Cell($this->wLine,$this->hLine,"",$border,0,'C',$this->fill);
        $y=$this->GetY();
        $this->SetXY($this->Xini+$this->lPadding,$y);

        if($this->Indent>0) {
            if($this->Bullet!='')
                $this->SetTextColor(0);
            $this->Cell($this->Indent,$this->hLine,$this->Bullet);
            $this->Indent=-1;
            $this->Bullet='';
        }

        $space=$this->LineAlign();
        $this->DoStyle(0);
        for($i=0; $i<count($this->Line2Print); $i++)
        {
            if(isset($this->TagName[$i]))
                $this->DoStyle($i);
            if(isset($this->TagHref[$i]))
                $href=$this->TagHref[$i];
            else
                $href='';
            if($this->Line2Print[$i]=="")
                $this->Cell($space,$this->hLine,"         ",0,0,'C',false,$href);
            else
                $this->Cell($this->StringLength[$i],$this->hLine,$this->Line2Print[$i],0,0,'C',false,$href);
        }

        $this->LineBreak();
        if($this->LastLine && $this->Text!="")
            $this->EndParagraph();
        $this->LastLine=false;
    }


    function LineAlign()
    {
        $space=$this->Space;
        if($this->align=="J") {
            if($this->nbSpace!=0)
                $space=$this->Space + ($this->Delta/$this->nbSpace);
            if($this->LastLine)
                $space=$this->Space;
        }

        if($this->align=="R")
            $this->Cell($this->Delta,$this->hLine);

        if($this->align=="C")
            $this->Cell($this->Delta/2,$this->hLine);

        return $space;
    }


    function LineBreak()
    {
        $x=$this->Xini;
        $y=$this->GetY()+$this->hLine;
        $this->SetXY($x,$y);
    }


    function EndParagraph()
    {
        $border=0;
        if($this->border==1)
            $border="LR";
        $this->Cell($this->wLine,$this->hLine/2,"",$border,0,'C',$this->fill);
        $x=$this->Xini;
        $y=$this->GetY()+$this->hLine/2;
        $this->SetXY($x,$y);
    }


}



class TextToImage {
    private $img;

    /**
     * Create image from text
     * @param string text to convert into image
     * @param int font size of text
     * @param int width of the image
     * @param int height of the image
     */
    function createImage($text, $fontSize = 20, $imgWidth = 400, $imgHeight = 80){

        //text font path
        $font = 'fonts/the_unseen.ttf';

        //create the image
        $this->img = imagecreatetruecolor($imgWidth, $imgHeight);

        //create some colors
        $white = imagecolorallocate($this->img, 255, 255, 255);
        $grey = imagecolorallocate($this->img, 128, 128, 128);
        $black = imagecolorallocate($this->img, 0, 0, 0);
        imagefilledrectangle($this->img, 0, 0, $imgWidth - 1, $imgHeight - 1, $white);

        //break lines
        $splitText = explode ( "n" , $text );
        $lines = count($splitText);

        foreach($splitText as $txt){
            $textBox = imagettfbbox($fontSize,$angle,$font,$txt);
            $textWidth = abs(max($textBox[2], $textBox[4]));
            $textHeight = abs(max($textBox[5], $textBox[7]));
            $x = (imagesx($this->img) - $textWidth)/2;
            $y = ((imagesy($this->img) + $textHeight)/2)-($lines-2)*$textHeight;
            $lines = $lines-1;

            //add some shadow to the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $grey, $font, $txt);

            //add the text
            imagettftext($this->img, $fontSize, $angle, $x, $y, $black, $font, $txt);
        }
        return true;
    }

    /**
     * Display image
     */
    function showImage(){
        header('Content-Type: image/png');
        return imagepng($this->img);
    }

    /**
     * Save image as png format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsPng($fileName = 'text-image', $location = ''){
        $fileName = $fileName.".png";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagepng($this->img, $fileName);
    }

    /**
     * Save image as jpg format
     * @param string file name to save
     * @param string location to save image file
     */
    function saveAsJpg($fileName = 'text-image', $location = ''){
        $fileName = $fileName.".jpg";
        $fileName = !empty($location)?$location.$fileName:$fileName;
        return imagejpeg($this->img, $fileName);
    }


}
