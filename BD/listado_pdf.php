<?php
use Silva\Alumno;

require_once __DIR__ . '/vendor/autoload.php';
require_once("./BACKEND/accesoDatos.php");
require_once __DIR__ . './BACKEND/alumno.php';

$accion = $_POST["select"];

$listadoAlumnos = Alumno::listar_bd();


$mpdf = new \Mpdf\Mpdf(['orientation' => 'P', 
                        'pagenumPrefix' => 'Página nro. ',
                        'pagenumSuffix' => ' - ',
                        'nbpgPrefix' => ' de ',
                        'nbpgSuffix' => ' páginas']);

$mpdf->SetHeader('Silva, Lucas Nicolas||{PAGENO}{nbpg}');
                        //alineado izquierda | centro | alineado derecha
$mpdf->SetFooter('|{DATE j-m-Y}|');

$mpdf->SetProtection(array(), 'UserPassword', 'MyPassword');


$grilla = '<table class="table" border="1" align="center">
            <thead>
                <tr>
                    <th>  LEGAJO </th>
                    <th>  APELLIDO     </th>
                    <th>  NOMBRE     </th>
                    <th>  FOTO       </th>
                </tr> 
            </thead>';

foreach($listadoAlumnos as $alumno){
    $grilla .= "<tr>
                    <td>".$alumno->legajo."</td>
                    <td>".$alumno->apellido."</td>
                    <td>".$alumno->nombre."</td>
                    <td><img src='BACKEND/".$alumno->foto."' width='100px' height='100px'/></td>
                </tr>";
}

$grilla .= '</table>';

$mpdf->WriteHTML("<h3>Listado de Alumnos</h3>");
$mpdf->WriteHTML("<br>");

$mpdf->WriteHTML($grilla);

if($accion=="visualizar"){
    $mpdf->Output('alumnos_pdf.pdf', 'I');
}
else{
    $mpdf->Output('alumnos_pdf.pdf', 'D');
}