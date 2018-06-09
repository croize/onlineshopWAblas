<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{
  public function exportdata()
  {
    Excel::create('pembelian',function($excel){
      $excel->sheet('pembelian',function ($sheet){
        $sheet->loadView('exportdata');
      });
    })->export('xlsx');
  }
}
