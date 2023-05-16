<?php
    require_once "method.php";
    require_once "header.php";

    //buat cara menangkap data dari forntend
    // if (isset($datas['action'])) {
        //     $action = $datas['action'];
        //     $peduliDiri = new PeduliDiri();
        //     if ($datas['action'] == 'daftar') {
            //         $peduliDiri->daftar($peduliDiri->clean($datas['nik']), $datas['nama']);
            //     } elseif ($datas['action'] == 'login') {
    //         $peduliDiri->login($peduliDiri->clean($datas['nik']), $datas['nama']);
    //     } elseif ($datas['action'] == 'getCatatan') {
    //         $peduliDiri->getData($datas['nik']);
    //     } elseif ($datas['action'] == 'login') {
        //         $peduliDiri->IsiCatatanPerjalanan($datas['nik'], $datas['nama'], $datas['jam'], $datas['lokasi'], $datas['suhu']);
        //     }
        // }
    $datas = json_decode(file_get_contents('php://input'), true);

    if(isset($datas['nik'])) {
        $nik = $datas['nik'];
    }
    if(isset($datas['nama'])) {
        $nama = $datas['nama'];
    }
    if(isset($datas['dgmr'])) {
        $dgmr = $datas['dgmr'];
    }
    
    if(isset($datas['action'])) {
        $aksi = $datas['action'];
    }

    if($aksi) {
        $peduliDiri = new PeduliDiri();
        if($aksi == 'daftar') {
            $peduliDiri->daftar($nik, $nama); 
        } elseif ($aksi == 'login') {
            $peduliDiri->login($nik, $nama);
        } elseif ($aksi == 'getCatatan') {
            $peduliDiri->simpandata($nik, $nama, $dgmr);
        } elseif ($aksi == 'isiCatatan') {
            $peduliDiri->isiCatatan($nik, $nama, $datas['makanan'], $datas['alasan'], $datas['sejak'], $datas['cerita'], $datas['hobi'], $datas['pacar'], $datas['seseorang'], $datas['apakah']);
        } else {
            $peduliDiri->tampil();
        }
    }

    // var_dump($_REQUEST);

    // echo $_REQUEST['nik'];

    // $rMethod = $_SERVER['REQUEST_METHOD'];
    
    // echo $rMethod;
?>