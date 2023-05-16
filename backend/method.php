<?php
    class PeduliDiri {

        public $filename = "./output/user.txt";
        // public
        // private
        public function daftar($nik, $nama) {

            //check dulu apakah
            $file_handle = fopen($this->filename , 'r');
            $status = "";
            while (!feof($file_handle)) {
                $pisah = explode(" | ", fgets($file_handle));
                if ($pisah[0] == $nik) {
                    //nik nya sama, tidak boleh daftar lagi
                    header('Content-Type: application/json');
                    $status = "NIK Sudah Terdaftar";
                    $data = [
                        'status' => $status
                    ];
                    echo json_encode($data);
                    return;
                }
            }

            $text = $nik . " | " . $nama . "\n";
            $file_handle = fopen($this->filename , 'a+');
            fwrite($file_handle, $text);
            $status = "Berhasil Mendaftar";
            header('Content-Type: application/json');
            $data = [
                'status' => $status,
                'nik' => $nik,
                'nama' => $nama
            ];
            echo json_encode($data);
        }

        function tampil(){
            $filene = './output/dataform.txt';
            $foto = './output/img.txt';
            $filecon = file_get_contents($filene);
            $filecn = file_get_contents($foto);

            $data = $filecn . "<br>" . $filecon;
            echo $data;
        }

        
        function simpandata($nik, $nama, $dgmr) {
            //menggabungkan variable ke teks
            $text = "<img src='". $dgmr. "'>" . "\n";
            
            $filen = "./output/img.txt";
            //simpan data teks ke file perjalanan
            $file_handle = fopen($filen, 'a+');
            fwrite($file_handle, $text);
            header('Content-Type: application/json');
            $data = [
                'status' => 'success'
            ];
            echo json_encode($data);
        }


        

        // public function login($nik, $nama) {
        //     $credential = $nik . " | " . $nama;
        //     header('Contein-Type: application/json');
            

        //     //cara 2
        //     $file = file($this->filename, FILE_IGNORE_NEW_LINES);
        //     if(stripos(json_encode($file), $credential) !== false) {
        //         $data = [
        //             'status' => 'success',
        //             'nik' => $nik,
        //             'nama' => $nama
        //         ];
        //         echo json_encode($data);
        //     } else {
        //         echo json_encode('error');
        //     }
        // }

        public function IsiCatatan($nik , $nama , $makanan , $alasan , $sejak , $cerita , $hobi , $pacar , $seseorang , $apakah) {

            //fungsi untuk simpan data
            function saveData($filename, $nik , $nama , $makanan , $alasan , $sejak , $cerita , $hobi , $pacar , $seseorang , $apakah) {
                
                //menggabungkan variable ke teks
                $text = $nik . " <br>" . $nama . " <br>" . $makanan . " <br>" . $alasan . " <br>" . $sejak . " <br>" . $cerita . " <br>" . $hobi . " <br>" . $pacar . " <br>" . $seseorang . " <br>" . $apakah . "<br><br>";

                //simpan data teks ke file perjalanan
                $file_handle = fopen($filename, 'a+');
                fwrite($file_handle, $text);
                header('Content-Type: application/json');
                $data = [
                    'status' => 'success'
                ];
                echo json_encode($data);
            }
            
            $filename = "./output/dataform.txt";
            
            saveData($filename, $nik , $nama , $makanan , $alasan , $sejak , $cerita , $hobi , $pacar , $seseorang , $apakah);
            
        }
        public function getData($nik) {
            $file_handle = fopen('./output/data-' . $nik . '.txt', 'r');
            $datas = array();
            while (!feof($file_handle)) {
                $pisah = explode(" | ", fgets($file_handle));
                if ($pisah[0] != '') {
                    $clearDataEnd = str_replace("\r", "", $pisah[3]);
                    $clearDataFinal = str_replace("\n", "", $clearDataEnd);
                    $datas[] = [
                        'tanggal' => $pisah[0],
                        'waktu' => $pisah[1],
                        'lokasi' => $pisah[2],
                        'suhu' => $clearDataFinal
                    ];
                }
            }
            fclose($file_handle);
            echo json_encode($datas);
            return;
        }

        public function getDataSort($nik, $sort) {
            $file_handle = fopen('./output/data-' . $nik . '.txt', 'r');
            $datas = array();
            while (!feof($file_handle)) {
                $pisah = explode(" | ", fgets($file_handle));
                if ($pisah[0] != '') {
                    $clearDataEnd = str_replace("\r", "", $pisah[3]);
                    $clearDataFinal = str_replace("\n", "", $clearDataEnd);
                    $datas[] = [
                        'tanggal' => $pisah[0],
                        'waktu' => $pisah[1],
                        'lokasi' => $pisah[2],
                        'suhu' => $clearDataFinal
                    ];
                }
            }
            fclose($file_handle);

            usort($datas, function($a, $b) use($sort) {
                return $a[$sort] <=> $b[$sort];
            });

            echo json_encode($datas);
            return;
        }
    }
?>