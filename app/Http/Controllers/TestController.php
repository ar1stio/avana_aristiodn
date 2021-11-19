<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TestImport;

class TestController extends Controller
{
    public function findstring()
    {
        $compact['page_name']       = 'Test 1';
       
        return view('test.find-string', compact('compact'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processstring(Request $request)
    {
        $compact['page_name']       = 'Test 2';
        $messages = [
            'abjad.required'          => 'Field :attribute harus terisi',
            'idx.required'          => 'Field :attribute harus terisi',
        ];

        $fields   = [
            'abjad'           => 'abjad',
            'idx'           => 'idx',
        ];

        // Apply the validator rules
        $validator  = \Validator::make($request->all(), [
            'abjad'       => 'required',
            'idx'         => 'required',            
        ], $messages, $fields);

        // When the user doesn't obey the rules
        if($validator->fails())
        {
            // Redirect back when the rules is not true
            return back()->withErrors($validator)
                         ->withInput();
        }

        $str = $request->abjad;
        //"a b c (d (e f g h i (j) k l) m) n o";
        $idx = $request->idx;
        $datafound = explode(" ",$str);
        // var_dump($datafound);
        $resultstring = '';
        $countopen = 0;
        $countclose = 0;
        $charresult = '';
        foreach($datafound as $f => $found){	
            $resultstring = $resultstring . " " . $found;
        
            $cekopen = count(explode("(",$found));
            if ($cekopen > 1){
                $countopen++;        	
            }
            $cekclose = count(explode(")",$found));
            if ($cekclose > 1){
                $countclose++;        	
            }
                    
            if ($countopen > 0){		        
                if ($countopen == $countclose ){ 
                    $charresult = $found;
                    break;
                }
            }
        }

        $compact['hasil']       = $resultstring;
        $compact['jumlah']      = strpos($resultstring,$charresult);
       
        return view('test.process-string', compact('compact'));      
    }
    
    public function validasidata()
    {
        $compact['page_name']       = 'Test 2';
       
        return view('test.validasi-data', compact('compact'));
    }    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function processexcel(Request $request){
        $messages = [
            'importfile.required'          => 'Field :attribute harus terisi',
        ];

        $fields   = [
            'importfile'           => 'importfile',
        ];

        // Apply the validator rules
        $validator  = \Validator::make($request->all(), [
            'importfile'       => 'required',
        ], $messages, $fields);

        // When the user doesn't obey the rules
        if($validator->fails())
        {
            // Redirect back when the rules is not true
            return back()->withErrors($validator)
                         ->withInput();
        }

        $file = $request->file('importfile');
        
        $data = Excel::toCollection(new TestImport, $file);
        // $data = Excel::toCollection(collect([]), $request->file('csv_file'));
        // var_dump($data);
        // echo json_encode($data);
        
        $classarr= [];
        $arrtitile = isset($data[0][0])?$data[0][0]:array();
        $datanew = $data[0];
        unset($datanew[0]);
        $jmlcol = count($arrtitile);

        $messageserror = '';

        if ($jmlcol>0 && count($datanew)>0){
            //klasifikasi data
            foreach($arrtitile as $t => $title){
                $classarr[$t]['name'] = $title;
                $arrdata = array();
                foreach ($datanew as $key => $value) {
                    $arrdata[] = isset($value[$t])?$value[$t]:'';
                }
                $classarr[$t]['data'] = $arrdata;
            }

            //pengencekan data        
            $arrcek = array();
            foreach($classarr as $c => $cls){
                $pgrtitle = explode("#",$cls['name']);
                $btgtitle = explode("*",$cls['name']);
                //cek pagar title
                if ($pgrtitle[0]==''){
                    foreach($cls['data'] as $dt => $dtklas){
                        if ($dtklas == trim($dtklas) && strpos($dtklas, ' ') !== false) {
                            if (isset($arrcek[$dt])){
                                $arrcek[$dt] = $arrcek[$dt] . ", " . str_replace('#','' , $cls['name'])." should not contain any space ";
                            }else{
                                $arrcek[$dt] = str_replace('#','' , $cls['name'])." should not contain any space ";
                            }
                        }
                    }
                }
                //cek bintang title
                if (isset($btgtitle[1])){
                    if($btgtitle[1]==''){
                        foreach($cls['data'] as $dt => $dtklas){
                            if ($dtklas == '' || $dtklas == null) {
                                if (isset($arrcek[$dt])){
                                    $arrcek[$dt] = $arrcek[$dt] . ", " . "Missing value in " .  str_replace('*','' , $cls['name']);
                                }else{
                                    $arrcek[$dt] = "Missing value in " . str_replace('*','' , $cls['name']);
                                }
                            }
                        }
                    }
                }
            }
        }

        $compact['hasil'] = $arrcek;
       
        return view('test.process-excel', compact('compact'));               
    }
        
}
