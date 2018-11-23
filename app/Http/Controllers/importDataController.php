<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Cabang_Olahraga;
use App\Master_Atlet;
use App\Kontingen;
use App\Wasit;
use Carbon;
class importDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $page = "Import Data";
    public $viewPage = "importData";
    public function index()
    {
        //
        $data['page'] = $this->page;
        return view($this->viewPage.".index",$data);
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
        
        if($request->hasFile('file_data')){
            $path = $request->file('file_data')->getRealPath();
            $data = Excel::load($path, function($reader){})->get();
            if(!empty($data) && $data->count()){
                //jenis data atler
                if($request->jenis_data == "atlet")
                    $dataReturn = $this->generateDataAtlet($data);
                else if($request->jenis_data == "pelatih")
                    $dataReturn = $this->generateDataPelatih($data);
                else if($request->jenis_data == "wasit")
                    $dataReturn = $this->generateDataWasit($data);
            }
        }

        $dataReturn['countInsert'] = count($dataReturn['insert']);
        $dataReturn['countUpdate'] = count($dataReturn['update']);
        $dataReturn['status'] = "state";
        // return $dataReturn;
        return redirect('administrator/importData')->with($dataReturn);
    }
    public function generateDataAtlet($data)
    {
        $dataListCreate= [];
        $dataListUpdate= [];
        $message = "";
        foreach ($data as $key => $value) {
            $tempData['nama_atlet'] = $value->nama;   
            //cabor
            $cabor_id = Cabang_Olahraga::where('nama_cabor',$value->cabor);
            if($cabor_id->get()->count() > 0)
            {
                $cabor_id = $cabor_id->first()->id_cabor; 
            }
            else
            {
                $message.=" Cabang Olahraga <b>".$value->cabor."</b> Pada Anggota Dengan No KTA ".$value->kta." <b>Tidak Terdaftar</b><br>";
                continue;
            }
            $tempData['cabor_id'] = $cabor_id;

            $tempData['no_kartu_tanda_anggota'] = $value->kta;   
            $tempData['jenis_kelamin'] = $value->jk;   
            $tempData['tempat_lahir'] = $value->tempat_lahir;   

            if($value->tgl_lahir !== "" && $value->tgl_lahir !== "-")
            {
                $tgl_lahir = Carbon\Carbon::parse($value->tgl_lahir)->format('Y-m-d');
                $tempData['tgl_lahir'] = $tgl_lahir;  
            }
            else
            {
                $tempData['tgl_lahir'] = NULL;
            }

            $tempData['alamat'] = $value->alamat;   
            $tempData['tinggi'] = $value->tinggi;   
            $tempData['berat'] = $value->berat;   
            $tempData['kabupaten_id'] = "1";   
            $tempData['foto_id'] = "1";   

            if($value->tgl_jadi_atlet !== "" && $value->tgl_jadi_atlet !== "-")
            {
                $tgl_jadi_atlet = Carbon\Carbon::parse($value->tgl_jadi_atlet)->format('Y-m-d');
                $tempData['tgl_jadi_atlet'] = $tgl_jadi_atlet;  
            }
            else
            {
                $tempData['tgl_jadi_atlet'] = NULL;
            } 

            if($value->tgl_pensiun !== "" && $value->tgl_pensiun !== "-")
            {
                $tgl_pensiun = Carbon\Carbon::parse($value->tgl_pensiun)->format('Y-m-d');
                $tempData['tgl_pensiun'] = $tgl_pensiun;  
            }
            else
            {
                $tempData['tgl_pensiun'] = NULL;
            }

            $tempData['status'] = "0";  
            
            $search = Master_Atlet::where('no_kartu_tanda_anggota',$value->kta);
            if($search->get()->count() <= 0)
            {
                array_push($dataListCreate, $tempData); 
            }
            else
            {
                $update = $search->update($tempData);
                array_push($dataListUpdate, $tempData); 
            }
        }
        $queryInsert = Master_Atlet::insert($dataListCreate);
        return ['insert' => $dataListCreate , 'update' => $dataListUpdate ,'message' => $message];
    }

    public function generateDataPelatih($data)
    {
        $dataListCreate= [];
        $dataListUpdate= [];
        $message = "";
        foreach ($data as $key => $value) {
            $tempData['nama_kontingen'] = $value->nama;   
            //cabor
            $cabor_id = Cabang_Olahraga::where('nama_cabor',$value->cabor);
            if($cabor_id->get()->count() > 0)
            {
                $cabor_id = $cabor_id->first()->id_cabor; 
                $tempData['cabor_id'] = $cabor_id;
            }
            else
            {
                $message.=" Cabang Olahraga <b>".$value->cabor."</b> Pada Anggota Dengan No KTA ".$value->kta." <b>Tidak Terdaftar</b><br>";
                continue;
            }
            

            $tempData['no_kartu_tanda_anggota'] = $value->kta;   
            $tempData['jenis_kelamin'] = $value->jk;   
            $tempData['tempat_lahir'] = $value->tempat_lahir;   

            if($value->tgl_lahir !== "" && $value->tgl_lahir !== "-")
            {
                $tgl_lahir = Carbon\Carbon::parse($value->tgl_lahir)->format('Y-m-d');
                $tempData['tgl_lahir'] = $tgl_lahir;  
            }
            else
            {
                $tempData['tgl_lahir'] = NULL;
            }

            $tempData['alamat'] = $value->alamat;               
            $tempData['kabupaten_id'] = "1";   
            $tempData['foto_id'] = "1";   

            
            
            $search = Kontingen::where('no_kartu_tanda_anggota',$value->kta);
            if($search->get()->count() <= 0)
            {
                array_push($dataListCreate, $tempData); 
            }
            else
            {
                $update = $search->update($tempData);
                array_push($dataListUpdate, $tempData); 
            }
        }
        $queryInsert = Kontingen::insert($dataListCreate);
        return ['insert' => $dataListCreate , 'update' => $dataListUpdate ,'message' => $message];
    }

    public function generateDataWasit($data)
    {
        $dataListCreate= [];
        $dataListUpdate= [];
        $message = "";
        foreach ($data as $key => $value) {
            $tempData['nama_wasit'] = $value->nama;   
            //cabor
            $cabor_id = Cabang_Olahraga::where('nama_cabor',$value->cabor);
            if($cabor_id->get()->count() > 0)
            {
                $cabor_id = $cabor_id->first()->id_cabor; 
                $tempData['cabor_id'] = $cabor_id;
            }
            else
            {
                $message.=" Cabang Olahraga <b>".$value->cabor."</b> Pada Anggota Dengan No KTA ".$value->kta." <b>Tidak Terdaftar</b><br>";
                continue;
            }
            

            $tempData['no_kartu_anggota'] = $value->kta;   
            $tempData['jenis_kelamin'] = $value->jk;   
            $tempData['tempat_lahir'] = $value->tempat_lahir;   

            if($value->tgl_lahir !== "" && $value->tgl_lahir !== "-")
            {
                $tgl_lahir = Carbon\Carbon::parse($value->tgl_lahir)->format('Y-m-d');
                $tempData['tgl_lahir'] = $tgl_lahir;  
            }
            else
            {
                $tempData['tgl_lahir'] = NULL;
            }

            $tempData['alamat'] = $value->alamat;               
            $tempData['kabupaten_id'] = "1";   
            // $tempData['foto_id'] = "1";   

            
            
            $search = Wasit::where('no_kartu_anggota',$value->kta);
            if($search->get()->count() <= 0)
            {
                array_push($dataListCreate, $tempData); 
            }
            else
            {
                $update = $search->update($tempData);
                array_push($dataListUpdate, $tempData); 
            }
        }
        $queryInsert = Wasit::insert($dataListCreate);
        return ['insert' => $dataListCreate , 'update' => $dataListUpdate ,'message' => $message];
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
    }
}
