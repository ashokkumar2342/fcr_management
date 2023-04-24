<?php

namespace App\Http\Controllers\Admin;

use App\Helper\MyFuncs;
use App\Http\Controllers\Controller;
use App\Model\BlocksMc;
use App\Model\GramPanchayat;

use App\Model\District;
use App\Model\Gender;
use App\Model\State;
use App\Model\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use PDF;

class ReportController extends Controller
{
   public function index()
   { 
     try {
          $categorys=DB::select(DB::raw("select * from `categorys` Order By `category_name`"));
          $departments=DB::select(DB::raw("select * from `department` Order By `department_name`"));
          $officers=DB::select(DB::raw("select * from `officers` Order By `officer_name`"));
          $taskstatus=DB::select(DB::raw("select * from `task_status` Order By `id`"));
          return view('admin.report.index',compact('categorys' , 'departments' ,'officers' ,'taskstatus'));
        } catch (Exception $e) {
            
        }
     
   }
   public function reportResult(Request $request)
   { 
     try {
        $path=Storage_path('fonts/');
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir']; 
        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata']; 
         $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
        __DIR__ . $path,
        ]),
        'fontdata' => $fontData + [
        'frutiger' => [
        'R' => 'FreeSans.ttf',
        'I' => 'FreeSansOblique.ttf',
        ]
        ],
        'default_font' => 'freesans',
        'pagenumPrefix' => '',
        'pagenumSuffix' => '',
        'nbpgPrefix' => ' कुल ',
        'nbpgSuffix' => ' पृष्ठों का पृष्ठ'
         ]); 
        // $voProfileLists=DB::select(DB::raw("select `vsd`.`id`, `vil`.`name` as `vil_name`, `shg`.`group_name` as `shg_name`,
        // `shg`.`shg_code`, `vsd`.`joining_date`, `smd_1`.`member_name` as `member_1`,
        // `smd_2`.`member_name` as `member_2`, `des_1`.`designation_name` as `designation_1`, `des_2`.`designation_name` as `designation_2`,
        // `smd_1`.`mobile_no` as `mobile_1`, `smd_2`.`mobile_no` as `mobile_2` 
        // from `vo_shg_detail` `vsd`
        // inner join `selfhelpgroups` `shg` on `shg`.`id` = `vsd`.`shg_id`
        // inner join `villages` `vil` on `vil`.`id` = `shg`.`village_id`
        // left join `shg_member_detail` `smd_1` on `smd_1`.`id` = `vsd`.`shg_member_detail_id_1`
        // left join `shg_member_detail` `smd_2` on `smd_2`.`id` = `vsd`.`shg_member_detail_id_2`
        // left join `designation_ec` `des_1` on `des_1`.`id` = `vsd`.`designation_memeber_1`
        // left join `designation_ec` `des_2` on `des_2`.`id` = `vsd`.`designation_memeber_2`
        // where `vsd`.`vo_id` = 1
        // order by `vil`.`name`, `shg`.`group_name` ;"));
        // $html = view('admin.report.vo_pdf',compact('voProfileLists')); 
        // $mpdf->WriteHTML($html); 
        // $mpdf->Output();
            
          return view('admin.report.vo_report',compact('States'));
        } catch (Exception $e) {
            
        }
     
   }

   
}
