<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sustance;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use App\Models\Training;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{

    /**
     * Método para crear PDF una vista
     */
    public function crearPDF($dateTo, $dateFrom, $guide, $dog){
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->guide = $guide;
        $this->dog_id = $dog;
        $sustancias = Sustance::all();
        $ordenes = Order::all();
        $tipos = Type::all();

        $totalesDiarios = $this->calcularDiarios();
        $totalesObediencia = $this->calcularObediencia();
        $totalesBusqueda = $this->calcularBusqueda();

        $pdf = PDF::loadView('informePDF', compact('totalesDiarios', 'totalesObediencia', 'totalesBusqueda',
        'sustancias', 'tipos', 'ordenes'));

        return $pdf->stream('informe.pdf');
    }

    //Variables para calcular entrenamientos
    public $guide;
    public $dog_id;
    public $dateFrom;
    public $dateTo;

    /**
     * Método para calcular los valores del informe para los entrenamientos Diarios
     */
    private function calcularDiarios(){

        //Inicializo arrays con los tipos de entrenamientos diarios
        $entrenamientos = $this->separarTipos();
        //Creo array inicializado a 0
        $totales = array('Paseo' => 0, 'Carrera' => 0);
        //Recorro arrays e inicializo con valores
        foreach($entrenamientos as $clave =>$entreno){

            $tiempoTotal = null;
            $kmTotales = null;

            foreach($entreno as $valor){

                $duracion = $valor->daily->duration;
                $km = $valor->daily->meters;

                $tiempoTotal += $duracion;
                $kmTotales += $km;
                
            }
            //Asigno valores calculados
            $total = array('tiempoTotal' => $tiempoTotal, 'kmTotales' => $kmTotales);
            //Asigno los valores obtenidos
            $totales[$clave] = $total;
        } 

        return $totales;
    }

    /**
     * Método para separar los entrenamientos diarios por tipo
     */
    private function separarTipos(){

        //Inicializo variables
        $guide = $this->guide;
        $dog_id = $this->dog_id;
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $entrenamientosPaseo = array();
        $entrenamientosCarrera = array();

        //Array con todos los entrenamientos que cumplen condiciones
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', "=", '1')
        ->where('worker_id', '=', $guide)
        ->where('dog_id', '=', $dog_id)
        ->whereBetween('date', [$dateFrom, $dateTo])
        ->get();

        //Recorro array donde extraigo tipo y lo añado al array correspondiente
        foreach($entrenamientos as $entreno){
            $tipo = $entreno->daily->type_id;
            switch($tipo){
                case 1:
                    array_push($entrenamientosPaseo, $entreno);
                    break;
                case 2:
                    array_push($entrenamientosCarrera, $entreno);
                    break;
            }
        }
        $arrayEntrenos = [
            'Paseo' => $entrenamientosPaseo,
            'Carrera' => $entrenamientosCarrera
        ];
        return $arrayEntrenos;
    }

    /**
     * Método para calcular los valores del informe para los entrenamientos Obediencia
     */
    private function calcularObediencia(){

        //Inicializo arrays con las ordenes de entrenamientos obediencia
        $entrenamientos = $this->separarOrdenes();
        //Creo array inicializado a 0
        $totales = array('Sit' => 0, 'Platz' => 0, 'Fuus' => 0, 'Quieto' => 0, 'Laser' => 0,
        'Izquierda' => 0, 'Derecha' => 0, 'Sigue' => 0, 'Foco' => 0);
        //Recorro arrays e inicializo con valores
        foreach($entrenamientos as $clave =>$entreno){

            $aciertos = null;
            $fallos = null;
            $tiempoTotal = null;
            $totalSeries = null;

            foreach($entreno as $valor){

                $positivos = $valor->obedience->positives;
                $negativos = $valor->obedience->negatives;
                $duracion = $valor->obedience->duration;
                $series = $valor->series;

                $aciertos += $positivos;
                $fallos += $negativos;
                $tiempoTotal += $duracion;
                $totalSeries += $series;
                
            }
            //Controlo que no se pueda dividir por 0
            if($totalSeries == 0) $totalSeries = 1;
            //Asigno valores calculados
            $total = array('aciertos' => round((($aciertos * 100)/$totalSeries), 2) . '%',
            'fallos' => round((($fallos * 100)/$totalSeries), 2) . '%',
            'tiempo' => $tiempoTotal);
            //Asigno los valores obtenidos
            $totales[$clave] = $total;
        } 

        return $totales;
    }

    /**
     * Método para separar los entrenamientos por ordenes
     */
    private function separarOrdenes(){

        //Inicializo variables
        $guide = $this->guide;
        $dog_id = $this->dog_id;
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $entrenamientoSit = array();
        $entrenamientoPlatz = array();
        $entrenamientoFuss = array();
        $entrenamientoQuieto = array();
        $entrenamientoLaser = array();
        $entrenamientoIzquierda = array();
        $entrenamientoDerecha = array();
        $entrenamientoSigue = array();
        $entrenamientoFoco = array();

        //Array con todos los entrenamientos que cumplen condiciones
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', "=", '2')
        ->where('worker_id', '=', $guide)
        ->where('dog_id', '=', $dog_id)
        ->whereBetween('date', [$dateFrom, $dateTo])
        ->get();
        
        foreach($entrenamientos as $entreno){

            $orden = $entreno->obedience->order_id;

            switch($orden){
                case 1:
                    array_push($entrenamientoSit, $entreno);
                    break;
                case 2:
                    array_push($entrenamientoPlatz, $entreno);
                    break;
                case 3:
                    array_push($entrenamientoFuss, $entreno);
                    break;
                case 4:
                    array_push($entrenamientoQuieto, $entreno);
                    break;
                case 5:
                    array_push($entrenamientoLaser, $entreno);
                    break;
                case 6:
                    array_push($entrenamientoIzquierda, $entreno);
                    break;
                case 7:
                    array_push($entrenamientoDerecha, $entreno);
                    break;
                case 8:
                    array_push($entrenamientoSigue, $entreno);
                    break;
                case 9:
                    array_push($entrenamientoFoco, $entreno);
                    break;

            }
        }
        $arrayEntrenos = [
            'Sit' => $entrenamientoSit,
            'Platz' => $entrenamientoPlatz,
            'Fuus' => $entrenamientoFuss,
            'Quieto' => $entrenamientoQuieto,
            'Laser' => $entrenamientoLaser,
            'Izquierda' => $entrenamientoIzquierda,
            'Derecha' => $entrenamientoDerecha,
            'Sigue' => $entrenamientoSigue,
            'Foco' => $entrenamientoFoco
        ];

        return $arrayEntrenos;
    }

     /**
     * Método para calcular los valores del informe para los entrenamientos Busqueda
     */
    private function calcularBusqueda(){

        //Inicializo arrays con las ordenes de entrenamientos busqueda
        $entrenamientos = $this->separarSustancias();
        //Creo array inicializado a 0
        $totales = array('Goma2' => 0, 'Pg2' => 0, 'Pg3' => 0, 'Pentrita' => 0, 'Tritila' => 0,
        'Clorato' => 0, 'Nitrato' => 0, 'Amonal' => 0, 'Kom' => 0, 'Olor Personal' => 0);
        //Recorro arrays e inicializo con valores
        foreach($entrenamientos as $clave =>$entreno){

            $aciertos = null;
            $fallos = null;
            $tiempoTotal = null;
            $totalSeries = null;

            foreach($entreno as $valor){

                $positivos = $valor->detection->positives;
                $negativos = $valor->detection->negatives;
                $duracion = $valor->detection->search_time;
                $series = $valor->series;

                $aciertos += $positivos;
                $fallos += $negativos;
                $tiempoTotal += $duracion;
                $totalSeries += $series;
                
            }
            //Controlo que no se pueda dividir por 0
            if($totalSeries == 0) $totalSeries = 1;
            //Asigno valores calculados
            $total = array('aciertos' => round((($aciertos * 100)/$totalSeries), 2) . '%',
            'fallos' => round((($fallos * 100)/$totalSeries), 2) . '%',
            'tiempo' => $tiempoTotal);
            //Asigno valores obtenidos
            $totales[$clave] = $total;
        } 

        return $totales;
    }

    /**
     * Método para separar los entrenamientos por sustancias
     */
    private function separarSustancias(){
        
        //Inicializo variables
        $guide = $this->guide;
        $dog_id = $this->dog_id;
        $dateFrom = $this->dateFrom;
        $dateTo = $this->dateTo;
        $entrenamientoGoma2 = array();
        $entrenamientoPg2 = array();
        $entrenamientoPg3 = array();
        $entrenamientoPentrita = array();
        $entrenamientoTritila = array();
        $entrenamientoClorato = array();
        $entrenamientoNitrato = array();
        $entrenamientoAmonal = array();
        $entrenamientoKom = array();
        $entrenamientoPersonas = array();

        //Array con todos los entrenamientos que cumplen condiciones
        $entrenamientos = Training::latest('id')
        ->where('user_id', '=', Auth::id())
        ->where('technique_id', "=", '3')
        ->where('worker_id', '=', $guide)
        ->where('dog_id', '=', $dog_id)
        ->whereBetween('date', [$dateFrom, $dateTo])
        ->get();

        foreach($entrenamientos as $entreno){

            $orden = $entreno->detection->sustance_id;

            switch($orden){
                case 1:
                    array_push($entrenamientoGoma2, $entreno);
                    break;
                case 2:
                    array_push($entrenamientoPg2, $entreno);
                    break;
                case 3:
                    array_push($entrenamientoPg3, $entreno);
                    break;
                case 4:
                    array_push($entrenamientoPentrita, $entreno);
                    break;
                case 5:
                    array_push($entrenamientoTritila, $entreno);
                    break;
                case 6:
                    array_push($entrenamientoClorato, $entreno);
                    break;
                case 7:
                    array_push($entrenamientoNitrato, $entreno);
                    break;
                case 8:
                    array_push($entrenamientoAmonal, $entreno);
                    break;
                case 9:
                    array_push($entrenamientoKom, $entreno);
                    break;
                case 10:
                    array_push($entrenamientoPersonas, $entreno);
                    break;

            }
        }
        $arrayEntrenos = [
            'Goma2' => $entrenamientoGoma2,
            'Pg2' => $entrenamientoPg2,
            'Pg3' => $entrenamientoPg3,
            'Pentrita' => $entrenamientoPentrita,
            'Tritila' => $entrenamientoTritila,
            'Clorato' => $entrenamientoClorato,
            'Nitrato' => $entrenamientoNitrato,
            'Amonal' => $entrenamientoAmonal,
            'Kom' => $entrenamientoKom,
            'Olor Personal' => $entrenamientoPersonas
        ];

        return $arrayEntrenos;
    }
}
