<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Order;

class HomeController extends Controller
{
    //############################# Admin Section
    public function admin() {
        $aDate = Carbon::now()->format('Y-m-01'); //First day of current year
        $bDate = Carbon::now()->format('Y-m-d'); //Current day
        return view("web.admin.home.home", compact('aDate', 'bDate'));
    }

    public function graphics(Request $request) {
        $result = null;
        $dateA = $request->get('dateA');
        $dateB = $request->get('dateB');

        try {
            $orders = Order::whereBetween('created_at', [$dateA.' 00:00:00', $dateB.' 23:59:59'])->whereNotNull('received_date')->with(['table','products'])->get();

            //1.Money earned
            $money_earned = 0.0;
            foreach ($orders as $order) {
                foreach ($order->products as $product) {
                    $money_earned += $product->pivot->subtotal;
                }
            }

            //2.Tables most used
            $top_tables = [];
            foreach ($orders as $order) {
                array_push($top_tables, $order->table->name);
            }
            $top_tables = $this->getTop($top_tables, 3);

            //3.Products most purchased
            $top_products = [];
            foreach ($orders as $order) {
                foreach ($order->products as $product) {
                    array_push($top_products, $product->name);
                }
            }
            $top_products = $this->getTop($top_products, 3);

            //4. Time min, avg and max of orders
            $list_times = [];
            $date_aux_ini = null;
            $date_aux_end = null;
            foreach ($orders as $order) {
                $date_aux_ini = Carbon::createFromDate($order->created_at);
                $date_aux_end = Carbon::createFromDate($order->received_date);
                array_push($list_times, $date_aux_ini->diffInMinutes($date_aux_end));
            }
            $time_min = number_format(min($list_times) / 60, 2);
            $time_avg = number_format((array_sum($list_times) / count($list_times)) / 60, 2);
            $time_max = number_format(max($list_times) / 60, 2);

            //5. Days with most clients
            $top_days_aux = [];
            $day_aux = null;
            foreach ($orders as $order) {
                $date_aux_ini = Carbon::createFromDate($order->created_at)->dayOfWeek;
                switch ($date_aux_ini) {
                    case 0:
                        $day_aux = "Domingo";
                        break;
                    case 1:
                        $day_aux = "Lunes";
                        break;
                    case 2:
                        $day_aux = "Martes";
                        break;
                    case 3:
                        $day_aux = "Miércoles";
                        break;
                    case 4:
                        $day_aux = "Jueves";
                        break;
                    case 5:
                        $day_aux = "Viernes";
                        break;
                    case 6:
                        $day_aux = "Sábado";
                        break;
                }
                array_push($top_days_aux, $day_aux);
            }
            $top_days_aux = array_count_values($top_days_aux);
            $top_days = array(
                'Domingo' => !isset($top_days_aux['Domingo']) ? 0 : $top_days_aux['Domingo'],
                'Lunes' => !isset($top_days_aux['Lunes']) ? 0 : $top_days_aux['Lunes'],
                'Martes' => !isset($top_days_aux['Martes']) ? 0 : $top_days_aux['Martes'],
                'Miércoles' => !isset($top_days_aux['Miércoles']) ? 0 : $top_days_aux['Miércoles'],
                'Jueves' => !isset($top_days_aux['Jueves']) ? 0 : $top_days_aux['Jueves'],
                'Viernes' => !isset($top_days_aux['Viernes']) ? 0 : $top_days_aux['Viernes'],
                'Sábado' => !isset($top_days_aux['Sábado']) ? 0 : $top_days_aux['Sábado'],
            );

            //Return data
            $result = array(
                'success' => true,
                'message' => "Estadísticas actualizadas correctamente",
                'title' => "Estadísticas del " . $this->formatDate($dateA) . " al " . $this->formatDate($dateB),
                'money_earned' => $money_earned,
                'top_tables' => $top_tables,
                'top_products' => $top_products,
                'time' => $time_min.",".$time_avg.",".$time_max,
                'top_days' => $top_days
            );
        } catch (\Exception $e) {
            $result = array(
                'success' => false,
                'message' => "Error al obtener las estadísticas",
            );
        }
        return json_encode($result);
    }

    private function formatDate($date) { //Convert date format from "2022-12-31" to "31 de Diciembre del 2022"
        $result = "";
        $date = explode("-", $date);
        if (count($date) == 3) {
            $result .= $date[2] . " de ";
            if ($date[1] == "01") {
                $result .= "Enero";
            } else if ($date[1] == "02") {
                $result .= "Febrero";
            } else if ($date[1] == "03") {
                $result .= "Marzo";
            } else if ($date[1] == "04") {
                $result .= "Abril";
            } else if ($date[1] == "05") {
                $result .= "Mayo";
            } else if ($date[1] == "06") {
                $result .= "Junio";
            } else if ($date[1] == "07") {
                $result .= "Julio";
            } else if ($date[1] == "08") {
                $result .= "Agosto";
            } else if ($date[1] == "09") {
                $result .= "Septiembre";
            } else if ($date[1] == "10") {
                $result .= "Octubre";
            } else if ($date[1] == "11") {
                $result .= "Noviembre";
            } else if ($date[1] == "12") {
                $result .= "Diciembre";
            }
            $result .= " del " . $date[0];
        }
        return $result;
    }

    private function getTop($array, $len) { //Generate list of most frequents of size=LEN
        $array = array_count_values($array);
        while (count($array) > $len) {
            $min = min($array);
            $array = array_filter($array, function ($item) use($min){
                if ($item > $min) {
                    return $item;
                }
            });
        }
        return $array;
    }


    //############################# Manager Section
    public function manager() {
        return view("web.manager.home.home");
    }

    //############################# Waiter Section
    public function waiter() {
        return view("web.waiter.home.home");
    }
}
