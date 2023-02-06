<?php
declare(strict_types=1); 

namespace App\Charts;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class salesMonthly extends BaseChart
{
   
    public ?string $name = 'custom_chart_name';
    public ?string $routeName = 'chart_route_name';

    public function handler(Request $request): Chartisan
    {

    $now = Carbon::now();
    $yr = $now->format('Y/m/d');
    $m= $now->format('m');
    $firstDayofMonth=date("Y/m/d", strtotime("-3 month", strtotime($yr)));
    $thisDayofMonth = date("Y/m/d", strtotime("+1 day", strtotime($yr)));
   if($m<4){
    $m1=date("m", strtotime("-1 month", strtotime($yr)));
    $m4 = date("m", strtotime("+0 day", strtotime($yr)));
   }else{
    $m1=date("m", strtotime("-4 month", strtotime($yr)));
    $m4 = date("m", strtotime("+0 day", strtotime($yr)));
   }
  
        $data=[];
        $monthdata=[];
        for ($month = $m1; $month <= $m4; $month++)
        {
          $date = Carbon::create(date('Y'), $month);
          $date_end = $date->copy()->endOfMonth();

            $saledate = DB::table('sales')
            ->select(DB::raw('sum(product_fee) as sale'))
            ->where('created_at', '>=', $date)
            ->where('created_at', '<=', $date_end)
            ->get();

            $sum=0;
            foreach ($saledate as $row)
            {
                $sum=$row->sale;
            }
          array_push($data,$sum);
          array_push($monthdata,$date->format('M'));
        }
        return Chartisan::build()
             ->labels($monthdata)
             ->dataset('Sale',$data)
           ;
    }

}
