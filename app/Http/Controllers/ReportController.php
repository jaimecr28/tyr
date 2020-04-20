<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
use App\Enterprise;
use App\Sector;
use App\Sensor;
use App\Measurement;

// teste PDF

use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ReportController extends Controller
{
    public function Index(){

        $empresas = Enterprise::all();
        $setores = Sector::all();

        return view('report.detalhado', compact('empresas', 'setores'));

    }
    public function Sensors($empresa_id,$sector_id){

       $sensores = Sensor::where('enterprise_id', $empresa_id)->where('sector_id', $sector_id)->get();

       if(count($sensores)>0){

            $data = json_encode($sensores);
        
            return response()->json($data, 200);
       }else {

            $data = json_encode($sensores);
        
            return response()->json($data, 404);
           
       }
    }
    public function detalhado(Request $request){


        if ($request->tipo_relatorio == "1") {
            // relatorio detalhado 
            $e = Enterprise::find($request->empresa_select);
            $setor = Sector::find($request->setor_select);
            $sensor = Sensor::with('type_sensor')->find($request->sensor_select);

            $nomeArquivo = $sensor->name."-".$request->periodo_mes.$request->periodo_ano;

            $medidas = Measurement::whereMonth('datetime', $request->periodo_mes)
                                ->whereYear('datetime' ,$request->periodo_ano)
                                ->where('sensor_id',$request->sensor_select)
                                ->with('warning')
                                ->get();
                    
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("relatorioDetalhado.xlsx");

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C1', $e->name)
                ->setCellValue('C2', $e->adress.''.$e->adress_number)
                ->setCellValue('C3', $e->adress_district.' - '.$e->adress_city)
                ->setCellValue('C4', 'CNPJ: '.$e->cnpj)
                ->setCellValue('B5', $sensor->name)
                ->setCellValue('D5', $setor->name)
                ->setCellValue('B6', $sensor->brand_freeze)
                ->setCellValue('D6', $sensor->model_freeze)
                ->setCellValue('B7', $sensor->id)
                ->setCellValue('D7', $request->periodo_mes."/".$request->periodo_ano)
                ->setCellValue('B8', $sensor->type_sensor->name)
                ->setCellValue('D8', 'de '.$sensor->type_sensor->min_temp.'°C até '.$sensor->type_sensor->max_temp.'°C')
                ;
            if (count($medidas)) {
                $index = 11;
                foreach ($medidas as $medida) {
                    $data = strtotime($medida->datetime);
                    $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A'.$index, date('d/m/Y', $data))
                    ->setCellValue('B'.$index, date('H:i', $data))
                    ->setCellValue('C'.$index, $medida->temperature);

                    if ($medida->warning_id) {
                        $spreadsheet->setActiveSheetIndex(0)->setCellValue('D'.$index, $medida->warning->justification);
                    }
                    $index++;
                }
            }
            $spreadsheet->getActiveSheet()->setTitle($nomeArquivo);

            $writer = new Xlsx($spreadsheet);

            // //Redirect output to a client’s web browser (Xlsx)
             header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
             header('Content-Disposition: attachment;filename="relatorioDet.xlsx"');
             header('Cache-Control: max-age=0');
             // If you're serving to IE 9, then the following may be needed
             header('Cache-Control: max-age=1');

             // If you're serving to IE over SSL, then the following may be needed
             header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
             header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
             header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
             header('Pragma: public'); // HTTP/1.0

             $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

             $writer->save('php://output');


        } else {
            //relatorio anvisa
            $e = Enterprise::find($request->empresa_select);
            $setor = Sector::find($request->setor_select);
            $sensor = Sensor::with('type_sensor')->find($request->sensor_select);

            $nomeArquivo = $request->periodo_mes.$request->periodo_ano;

            // variaveis para buscar os dias do mes
            $periodoStr = $request->periodo_ano.'-'.$request->periodo_mes.'-01';
            $periodoDate = strtotime($periodoStr);
            $diasMes = date('t',$periodoDate);
            $mesAno = date('Y-m', $periodoDate);

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
            $spreadsheet = $reader->load("relatorioAnvisa.xlsx");

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('C1', $e->name)
                ->setCellValue('C2', $e->adress.''.$e->adress_number)
                ->setCellValue('C3', $e->adress_district.' - '.$e->adress_city)
                ->setCellValue('C4', 'CNPJ: '.$e->cnpj)
                ->setCellValue('B5', $sensor->name)
                ->setCellValue('E5', $setor->name)
                ->setCellValue('B6', $sensor->brand_freeze)
                ->setCellValue('E6', $sensor->model_freeze)
                ->setCellValue('B7', $sensor->id)
                ->setCellValue('E7', $request->periodo_mes."/".$request->periodo_ano)
                ->setCellValue('B8', $sensor->type_sensor->name)
                ->setCellValue('E8', 'de '.$sensor->type_sensor->min_temp.'°C até '.$sensor->type_sensor->max_temp.'°C')
                ;
            $j = 11;
                for ($i=1; $i <= $diasMes; $i++) {
                    $dia = $mesAno.'-'.$i;
                    for ($k=0; $k <=1 ; $k++) { 

                        
                        $medidaMax = Measurement::whereDate('datetime',$dia)
                                                ->where('afternoon',$k)
                                                ->max('temperature');
                                                
                        $medidaMin = Measurement::whereDate('datetime',$dia)
                                                ->where('afternoon',$k)
                                                ->min('temperature');

                        $medidaAvg = Measurement::whereDate('datetime',$dia)
                                                ->where('afternoon',$k)
                                                ->avg('temperature');

                        $medidaAlert = Measurement::whereDate('datetime',$dia)
                                                ->where('afternoon',$k)
                                                ->where('warning_id','!=',null)
                                                ->with('warning')
                                                ->first();
                        

                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue('A'.$j, date('d/m/Y', strtotime($dia)))
                            ->setCellValue('C'.$j, $medidaMax)
                            ->setCellValue('D'.$j, $medidaMin)
                            ->setCellValue('E'.$j, $medidaAvg)
                            ;
                        if ($medidaAlert) {
                            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F'.$j, $medidaAlert->warning->justification);
                        }
                        if ($k) {
                            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$j, 'Vespertino');
                            
                        } else {
                            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B'.$j, 'Matutino');
                        }
                        $j++;
                    }
                }

            $spreadsheet->getActiveSheet()->setTitle($nomeArquivo);
            //$writer = new Xlsx($spreadsheet);

            // Redirect output to a client’s web browser (Xlsx)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="relatorioDet.xlsx"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0

            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
                


        }
        
        
    }
    public function anvisa(Request $request){
        
        
    }
}
