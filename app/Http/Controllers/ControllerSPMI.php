<?php

namespace App\Http\Controllers;

use App\Models\ModelSPMI;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ControllerSPMI extends Controller
{
    public function index(Request $request)
    {
        // Hitung total berdasarkan data yang dipaginasi
        $data = $this->calculate();
        $total_semua = $this->calculateAll();
        $api_pt = $this->get_api_pt();

        $countAkreditasi = [
            'Unggul' => 0,
            'A' => 0,
            'Baik Sekali' => 0,
            'Baik' => 0,
            'B' => 0,
            'Tidak tersedia' => 0,
        ];
        
        foreach ($api_pt as $pt) {
            if (isset($countAkreditasi[$pt['akreditasi']])) {
                $countAkreditasi[$pt['akreditasi']]++;
            }
        }
        
        // Kembalikan view dengan data yang sudah diatur
        return view('index', [
            'data' => $data,
            'total_semua'=>$total_semua,
            'countAkreditasi'=>$countAkreditasi
        ]);
    }

    public function spmi_pt()
    {
        // Hitung total berdasarkan data yang dipaginasi
        $data = $this->calculate();
        $total_semua = $this->calculateAll();
    
        // Kembalikan view dengan data yang sudah diatur
        return view('spmi_pt', [
            'data' => $data,
            'total_semua'=>$total_semua
        ]);
    }

    public function spmi_ppep()
    {
        // Hitung total berdasarkan data yang dipaginasi
        $data = $this->calculate();
        $total_semua = $this->calculateAll();
    
        // Kembalikan view dengan data yang sudah diatur
        return view('spmi_ppep', [
            'data' => $data,
            'total_semua'=>$total_semua
        ]);
    }

    public function klaster() {
        // Query dasar untuk mengambil data ModelSPMI
        $data = $this->calculate();
        $data_total = $this->calculateAll();

        // Kembalikan view dengan data yang sudah diatur
        return view('klasterisasi', [
            'data'=>$data,
            'data_total'=>$data_total
        ]);
    }  

    public function show($pt)
    {
        $items = $this->calculate(); // This function retrieves all items as an array or collection.
        
        // Find the specific item based on the pt code
        $itemDetails = collect($items)->firstWhere('pt', $pt);
    
        // Pass the item to the view
        return view('table', [
            'item' => $itemDetails
        ]);
    }

    public function show_pt(){
        $items = $this->get_api_pt();
        return view('direktori_pt',[
            'data' => $items
        ]);
    }

    public function ambilData(){
        $spmi = ModelSPMI::where('tutup', '=', null)
        ->whereNotIn('kodept', ['041103', '041129', '041131'])
        ->get();

        $result = []; 
    
        foreach ($spmi as $item) {
            $row = [
                'pt' => $item->ptspmi,
                'kode_pt' => $item->kodept,
                //Pengaturan pengelolaan SPMI Institusi
                'kebijakan1' => [
                    'valid' => ($item->val1 == 1) ? 1 : 0,
                    'ver' => ($item->ver1 == 1) ? 1 : 0,
                    'unggah' => ($item->ul1!=null || $item->ul1!='') ? 1 : 0,
                ],
                //Pengaturan organisasi pengelola SPMI Institusi  
                'kebijakan2' => [
                    'valid' => ($item->val2 == 1) ? 1 : 0,
                    'ver' => ($item->ver2 == 1) ? 1 : 0,
                    'unggah' => ($item->ul2!=null || $item->ul2!='') ? 1 : 0,
                ],
                //Pengaturan terkait pelaksanaan standar dalam SPMI Institusi
                'kebijakan3' => [
                    'valid' => ($item->val3 == 1) ? 1 : 0,
                    'ver' => ($item->ver3 == 1) ? 1 : 0,
                    'unggah' => ($item->ul3!=null || $item->ul3!='') ? 1 : 0,
                ],
                //Pengaturan terkait evaluasi pelaksanaan standar
                'kebijakan4' => [
                    'valid' => ($item->val4 == 1) ? 1 : 0,
                    'ver' => ($item->ver4 == 1) ? 1 : 0,
                    'unggah' => ($item->ul4!=null || $item->ul4!='') ? 1 : 0,
                ],
                //Pengaturan terkait pengendalian pelaksanaan standar
                'kebijakan5' => [
                    'valid' => ($item->val5 == 1) ? 1 : 0,
                    'ver' => ($item->ver5 == 1) ? 1 : 0,
                    'unggah' => ($item->ul5!=null || $item->ul5!='') ? 1 : 0,
                ],
                //Pengaturan terkait peningkatan standar dalam SPMI Institusi
                'kebijakan6' => [
                    'valid' => ($item->val6 == 1) ? 1 : 0,
                    'ver' => ($item->ver6 == 1) ? 1 : 0,
                    'unggah' => ($item->ul6!=null || $item->ul6!='') ? 1 : 0,
                ],
                //Standar di aspek pendidikan
                'standar1' => [
                    'valid' => ($item->s1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s1 && $item->s1 <= 3) ? 1 : 0,
                    'unggah' => ($item->s1 >= 1) ? 1 : 0,
                ],
                //	Standar di aspek penelitian
                'standar2' => [
                    'valid' => ($item->s2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s2 && $item->s2 <= 3) ? 1 : 0,
                    'unggah' => ($item->s2 >= 1) ? 1 : 0,
                ],
                //Standar di aspek pengabdian pada masyarakat
                'standar3' => [
                    'valid' => ($item->s3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s3 && $item->s3 <= 3) ? 1 : 0,
                    'unggah' => ($item->s3 >= 1) ? 1 : 0,
                ],
                //aspek pengelolaan organisasi
                'lain1' => [
                    'valid' => ($item->l1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l1 && $item->l1 <= 3) ? 1 : 0,
                    'unggah' => ($item->l1 >= 1) ? 1 : 0,
                ],
                //aspek kemahasiswaan
                'lain2' => [
                    'valid' => ($item->l2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l2 && $item->l2 <= 3) ? 1 : 0,
                    'unggah' => ($item->l2 >= 1) ? 1 : 0,
                ],
                //aspek sumber daya manusia
                'lain3' => [
                    'valid' => ($item->l3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l3 && $item->l3 <= 3) ? 1 : 0,
                    'unggah' => ($item->l3 >= 1) ? 1 : 0,
                ],
                //aspek sarana prasarana
                'lain4' => [
                    'valid' => ($item->l4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l4 && $item->l4 <= 3) ? 1 : 0,
                    'unggah' => ($item->l4 >= 1) ? 1 : 0,
                ],
                //aspek kerjasama
                'lain5' => [
                    'valid' => ($item->l5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l5 && $item->l5 <= 3) ? 1 : 0,
                    'unggah' => ($item->l5 >= 1) ? 1 : 0,
                ],
                //aspek keuangan
                'lain6' => [
                    'valid' => ($item->l6 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l6 && $item->l6 <= 3) ? 1 : 0,
                    'unggah' => ($item->l6 >= 1) ? 1 : 0,
                ],
                //aspek kesejahteraan
                'lain7' => [
                    'valid' => ($item->l7 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l7 && $item->l7 <= 3) ? 1 : 0,
                    'unggah' => ($item->l7 >= 1) ? 1 : 0,
                ],
                //Praktik Baik Atau Mekanisme
                'audit1' => [
                    'valid' => ($item->ami1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami1 && $item->ami1 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami1 >= 1) ? 1 : 0,
                ],
                //Temuan
                'audit2' => [
                    'valid' => ($item->ami2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami2 && $item->ami2 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami2 >= 1) ? 1 : 0,
                ],
                //Rekomendasi Peningkatan Mutu
                'audit3' => [
                    'valid' => ($item->ami3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami3 && $item->ami3 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami3 >= 1) ? 1 : 0,
                ],
                //aspek pengelolaan organisasi
                'pengendalian1' => [
                    'valid' => ($item->k1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k1 && $item->k1 <= 3) ? 1 : 0,
                    'unggah' => ($item->k1 >= 1) ? 1 : 0,
                ],
                //aspek kerjasama
                'pengendalian2' => [
                    'valid' => ($item->k2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k2 && $item->k2 <= 3) ? 1 : 0,
                    'unggah' => ($item->k2 >= 1) ? 1 : 0,
                ],
                //Standar di aspek pengabdian pada masyarakat
                'pengendalian3' => [
                    'valid' => ($item->k3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k3 && $item->k3 <= 3) ? 1 : 0,
                    'unggah' => ($item->k3 >= 1) ? 1 : 0,
                ],
                //aspek kesejahteraan
                'pengendalian4' => [
                    'valid' => ($item->k4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k4 && $item->k4 <= 3) ? 1 : 0,
                    'unggah' => ($item->k4 >= 1) ? 1 : 0,
                ],
                //aspek keuangan
                'pengendalian5' => [
                    'valid' => ($item->k5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k5 && $item->k5 <= 3) ? 1 : 0,
                    'unggah' => ($item->k5 >= 1) ? 1 : 0,
                ],
                //aspek sarana prasarana
                'pengendalian6' => [
                    'valid' => ($item->k6 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k6 && $item->k6 <= 3) ? 1 : 0,
                    'unggah' => ($item->k6 >= 1) ? 1 : 0,
                ],
                //aspek sumber daya manusia
                'pengendalian7' => [
                    'valid' => ($item->k7 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k7 && $item->k7 <= 3) ? 1 : 0,
                    'unggah' => ($item->k7 >= 1) ? 1 : 0,
                ],
                //Standar di aspek pendidikan
                'pengendalian8' => [
                    'valid' => ($item->k8 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k8 && $item->k8 <= 3) ? 1 : 0,
                    'unggah' => ($item->k8 >= 1) ? 1 : 0,
                ],
                //Standar di aspek penelitian
                'pengendalian9' => [
                    'valid' => ($item->k9 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k9 && $item->k9 <= 3) ? 1 : 0,
                    'unggah' => ($item->k9 >= 1) ? 1 : 0,
                ],
                //aspek kemahasiswaan
                'pengendalian10' => [
                    'valid' => ($item->k10 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k10 && $item->k10 <= 3) ? 1 : 0,
                    'unggah' => ($item->k10 >= 1) ? 1 : 0,
                ],
                //Pengaturan pengelolaan SPMI Institusi
                'peningkatan1' => [
                    'valid' => ($item->t1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t1 && $item->t1 <= 3) ? 1 : 0,
                    'unggah' => ($item->t1 >= 1) ? 1 : 0,
                ],
                //Pengaturan organisasi pengelola SPMI Institusi
                'peningkatan2' => [
                    'valid' => ($item->t2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t2 && $item->t2 <= 3) ? 1 : 0,
                    'unggah' => ($item->t2 >= 1) ? 1 : 0,
                ],
                //Pengaturan terkait pelaksanaan standar dalam SPMI Institusi
                'peningkatan3' => [
                    'valid' => ($item->t3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t3 && $item->t3 <= 3) ? 1 : 0,
                    'unggah' => ($item->t3 >= 1) ? 1 : 0,
                ],
                //Pengaturan terkait evaluasi pelaksanaan standar
                'peningkatan4' => [
                    'valid' => ($item->t4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t4 && $item->t4 <= 3) ? 1 : 0,
                    'unggah' => ($item->t4 >= 1) ? 1 : 0,
                ],
                //Pengaturan terkait pengendalian pelaksanaan standar
                'peningkatan5' => [
                    'valid' => ($item->t5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t5 && $item->t5 <= 3) ? 1 : 0,
                    'unggah' => ($item->t5 >= 1) ? 1 : 0,
                ],
                //Pengaturan terkait peningkatan standar dalam SPMI Institusi
                'peningkatan6' => [
                    'valid' => ($item->t6 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t6 && $item->t6 <= 3) ? 1 : 0,
                    'unggah' => ($item->t6 >= 1) ? 1 : 0,
                ]
            ];
    
            $result[] = $row;
        }
    
        return $result;
    }
    
    public function calculate()
    {
        // Retrieve data
        $data = $this->ambilData();
        // $akreditasi = $this->get_api_pt(); 

        // Calculate totals by iterating over each item
        foreach ($data as $item) {
            $pt = $item['pt']; // Ambil nama PT
            $kode_pt = $item['kode_pt'];
            $totalValid = 0;
            $totalVerif = 0;
            $totalUnggah = 0;
            $klaster = '';
    
            $totalValid_seharusnya = 0;
            $totalVerif_seharusnya = 0;
            $totalUnggah_seharusnya = 0;

            $totalKebijakan_unggah = 0;
            $totalKebijakan_verif = 0;
            $totalKebijakan_valid = 0;
            for ($i = 1; $i <= 6; $i++) {
                $totalKebijakan_unggah += $item["kebijakan{$i}"]['unggah'];
                $totalKebijakan_verif += $item["kebijakan{$i}"]['ver'];
                $totalKebijakan_valid += $item["kebijakan{$i}"]['valid'];
            }
            
            $totalStandar_unggah = 0;
            $totalStandar_verif = 0;
            $totalStandar_valid = 0;
            for ($i = 1; $i <= 3; $i++) {
                $totalStandar_unggah += $item["standar{$i}"]['unggah'];
                $totalStandar_verif += $item["standar{$i}"]['ver'];
                $totalStandar_valid += $item["standar{$i}"]['valid'];
            }
            for ($i = 1; $i <= 7; $i++) {
                $totalStandar_unggah += $item["lain{$i}"]['unggah'];
                $totalStandar_verif += $item["lain{$i}"]['ver'];
                $totalStandar_valid += $item["lain{$i}"]['valid'];
            }

            $totalAmi_unggah = 0;
            $totalAmi_verif = 0;
            $totalAmi_valid = 0;
            for ($i = 1; $i <= 3; $i++) {
                $totalAmi_unggah += $item["audit{$i}"]['unggah'];
                $totalAmi_verif += $item["audit{$i}"]['ver'];
                $totalAmi_valid += $item["audit{$i}"]['valid'];
            }
            
            $totalPengendalian_unggah = 0;
            $totalPengendalian_verif = 0;
            $totalPengendalian_valid = 0;
            for ($i = 1; $i <= 10; $i++) {
                $totalPengendalian_unggah += $item["pengendalian{$i}"]['unggah'];
                $totalPengendalian_verif += $item["pengendalian{$i}"]['ver'];
                $totalPengendalian_valid += $item["pengendalian{$i}"]['valid'];
            }
            
            $totalPeningkatan_unggah = 0;
            $totalPeningkatan_verif = 0;
            $totalPeningkatan_valid = 0;
            for ($i = 1; $i <= 6; $i++) {
                $totalPeningkatan_unggah += $item["peningkatan{$i}"]['unggah'];
                $totalPeningkatan_verif += $item["peningkatan{$i}"]['ver'];
                $totalPeningkatan_valid += $item["peningkatan{$i}"]['valid'];
            }

            foreach ($item as $key => $fields) {

                if ($key === "kode_pt" ) {
                    continue;
                }
                
                if ($key === "pt" ) {
                    continue;
                }

                $totalValid  += $fields['valid'];
                $totalVerif  += $fields['ver'];
                $totalUnggah += $fields['unggah'];

                $totalValid_seharusnya += 1;
                $totalVerif_seharusnya += 1;
                $totalUnggah_seharusnya += 1;
            }

            $presentase_valid = round(($totalValid / $totalValid_seharusnya) * 100, 2); 
            $presentase_verif = round(($totalVerif / $totalVerif_seharusnya) * 100, 2); 
            $presentase_unggah = round(($totalUnggah / $totalUnggah_seharusnya) * 100, 2); 
            
            if ($presentase_valid < 50) {
                $klaster = 'merah';
            } else if ($presentase_valid > 80){
                $klaster = 'hijau';
            } else if ($presentase_valid > 49 || $presentase_valid < 81){
                $klaster = 'kuning';
            }
        
            $data['totals'] = [
                'kode_pt' => $kode_pt,
                'pt' => $pt,
                'kebijakan_unggah' => $totalKebijakan_unggah,
                'kebijakan_verif' => $totalKebijakan_verif,
                'kebijakan_valid' => $totalKebijakan_valid,
                'standar_unggah' => $totalStandar_unggah,
                'standar_verif' => $totalStandar_verif,
                'standar_valid' => $totalStandar_valid,
                'ami_unggah' => $totalAmi_unggah,
                'ami_verif' => $totalAmi_verif,
                'ami_valid' => $totalAmi_valid,
                'pengendalian_unggah' => $totalPengendalian_unggah,
                'pengendalian_verif' => $totalPengendalian_verif,
                'pengendalian_valid' => $totalPengendalian_valid,
                'peningkatan_unggah' => $totalPeningkatan_unggah,
                'peningkatan_verif' => $totalPeningkatan_verif,
                'peningkatan_valid' => $totalPeningkatan_valid,
                'valid' => $totalValid,
                'ver' => $totalVerif,
                'unggah' => $totalUnggah,
                'valid_seharusnya' => $totalValid_seharusnya,
                'verif_seharusnya' =>$totalVerif_seharusnya,
                'unggah_seharusnya'=>$totalUnggah_seharusnya,
                'presentase_valid' => $presentase_valid,
                'presentase_verif' => $presentase_verif,
                'presentase_unggah' => $presentase_unggah,
                'klaster' => $klaster,
                // 'akreditasi' => $akreditasi_pt,
                // 'kota_kab' => $kota_kab
            ];

            $result[] = $data['totals'];
        }
    
        // Return the result with totals included as JSON
        // return response()->json($result);
        return $result;
    }

    public function calculateAll()
    {
        // Retrieve data
        $data = $this->calculate();
        $row = [];

        $belum_valid = 0;
        $sebagian_valid = 0;
        $semua_valid = 0;

        $belum_ver = 0;
        $sebagian_ver = 0;
        $semua_ver = 0;

        $belum_unggah = 0;
        $sebagian_unggah = 0;
        $semua_unggah = 0;

        // Template untuk data awal
        $template = [
            'belum_unggah' => 0,
            'semua_unggah' => 0,
            'belum_verif' => 0,
            'semua_verif' => 0,
            'belum_valid' => 0,
            'semua_valid' => 0,
        ];

        // Membuat array berdasarkan template
        $ami = $template;
        $standar = $template;
        $pengendalian = $template;
        $peningkatan = $template;
        $kebijakan =$template;

        $klaster_hijau = 0;
        $klaster_kuning = 0;
        $klaster_merah = 0;

        $list_kategori = ['unggah', 'verif', 'valid'];

        foreach ($data as $item) {
            foreach ($list_kategori as $kategori) {
                if ($item["kebijakan_$kategori"] < 6) {
                    $kebijakan["belum_$kategori"] += 1;
                } else {
                    $kebijakan["semua_$kategori"] += 1;
                }
            }

            foreach ($list_kategori as $kategori) {
                if ($item["standar_$kategori"] < 10) {
                    $standar["belum_$kategori"] += 1;
                } else {
                    $standar["semua_$kategori"] += 1;
                }
            }

            foreach ($list_kategori as $kategori) {
                if ($item["ami_$kategori"] < 3) {
                    $ami["belum_$kategori"] += 1;
                } else {
                    $ami["semua_$kategori"] += 1;
                }
            }

            foreach ($list_kategori as $kategori) {
                if ($item["peningkatan_$kategori"] < 6) {
                    $peningkatan["belum_$kategori"] += 1;
                } else {
                    $peningkatan["semua_$kategori"] += 1;
                }
            }

            foreach ($list_kategori as $kategori) {
                if ($item["pengendalian_$kategori"] < 10) {
                    $pengendalian["belum_$kategori"] += 1;
                } else {
                    $pengendalian["semua_$kategori"] += 1;
                }
            }

            if ($item['valid'] == 0){
                $belum_valid +=1;
            } else if ($item['valid'] < 35 ){
                $sebagian_valid +=1;
            } else {
                $semua_valid +=1;
            } 
            
            if ($item['ver'] == 0){
                $belum_ver +=1;
            } else if ($item['ver'] < 35 ){
                $sebagian_ver +=1;
            } else {
                $semua_ver+=1;
            }  

            if ($item['unggah'] == 0){
                $belum_unggah +=1;
            } else if ($item['unggah'] < 35 ){
                $sebagian_unggah +=1;
            } else {
                $semua_unggah +=1;
            }  

            if ($item['klaster'] == 'hijau'){
                $klaster_hijau +=1;
            } else if ($item['klaster'] == 'kuning' ){
                $klaster_kuning +=1;
            } else {
                $klaster_merah +=1;
            } 
            
        }

        return [
            'kebijakan' => $kebijakan,
            'ami' => $ami,
            'standar' => $standar,
            'pengendalian' => $pengendalian,
            'peningkatan' => $peningkatan,
            'belum_valid' => $belum_valid, 
            'sebagian_valid' =>$sebagian_valid, 
            'semua_valid' =>$semua_valid,
            'belum_ver'=> $belum_ver,
            'sebagian_ver'=>$sebagian_ver,
            'semua_ver'=>$semua_ver,
            'belum_unggah'=>$belum_unggah,
            'sebagian_unggah'=>$sebagian_unggah,
            'semua_unggah'=>$semua_unggah,
            'klaster_hijau' =>$klaster_hijau,
            'klaster_kuning' =>$klaster_kuning,
            'klaster_merah' =>$klaster_merah
        ];
    }

    public function get_api_pt()
    {
        $url_login = 'https://pddikti.lldikti4.id/api/login';
        $username = 'magang@lldikti4.id';
        $password = 'm@g@ng@lldikti4.id';
        $spmi = ModelSPMI::where('tutup', '=', null)
        ->whereNotIn('kodept', ['041103', '041129', '041131'])
        ->select('kodept')
        ->get();
    
        $data_login = [
            'email' => $username,
            'password' => $password,
        ];
    
        $curl = curl_init();
    
        curl_setopt_array($curl, [
        CURLOPT_URL => $url_login,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_login,
        ]);
    
        $response = curl_exec($curl);
    
    
        if (curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        exit;
        }
    
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        if ($httpCode !== 200) {
            echo 'Error: API responded with HTTP code ' . $httpCode;
        exit;
        }
    
        $data_response = json_decode($response, true);
    
        // Ambil token autentikasi dari responsenya
        $token = $data_response['access_token'];
        // URL endpoint untuk mengambil data dari API
        $url_data = 'https://pddikti.lldikti4.id/api/getsatuanpendidikan';
    
        // Data yang akan dikirim dalam request untuk mengambil data
        $data_request = [
            'kodept' => false,
            'stat_sp' => false
        ];
    
        // Inisialisasi curl
        $curl = curl_init();
    
        // Set URL endpoint API dan opsi lainnya, termasuk header Authorization dengan token autentikasi
        curl_setopt_array($curl, [
        CURLOPT_URL => $url_data,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $token,
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data_request,
        ]);
    
        // Eksekusi request untuk mengambil data dan simpan responsenya
        $response = curl_exec($curl);
    
        // Jika terjadi error saat melakukan request, tampilkan pesan error
        if (curl_errno($curl)) {
            echo 'Error: ' . curl_error($curl);
        exit;
        }
    
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
        if ($httpCode !== 200) {
            echo 'Error: API responded with HTTP code ' . $httpCode;
        exit;
        }

        $result = [];
        // Parse data responsenya menjadi array asosiatif
        $data_response = json_decode($response, true);
        
        // Cek apakah JSON berhasil di-decode
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Invalid JSON response'];
        }
        
        foreach ($data_response as $data) {
            // Pastikan 'npsn' dan 'kota_kab' ada dalam data
            if (!isset($data['npsn']) || !isset($data['kota_kab'])) {
                continue; // Skip jika data tidak lengkap
            }
        
            // Ambil prefiks 2 digit pertama dari 'npsn'
            $npsn_prefix = substr($data['npsn'], 0, 3);
        
            // Tentukan bentuk dan jenis pendidikan_pt
            $bentuk = 'Tidak diketahui';
            $pendidikan_pt = 'Tidak diketahui';
        
            switch ($npsn_prefix) {
                case '043':
                    $bentuk = 'Sekolah Tinggi';
                    $pendidikan_pt = 'Akademik';
                    break;
                case '041':
                    $bentuk = 'Universitas';
                    $pendidikan_pt = 'Akademik';
                    break;
                case '044':
                    $bentuk = 'Akademi';
                    $pendidikan_pt = 'Vokasi';
                    break;
                case '045':
                    $bentuk = 'Politeknik';
                    $pendidikan_pt = 'Vokasi';
                    break;
                case '042':
                    $bentuk = 'Institut';
                    $pendidikan_pt = 'Akademik';
                    break;
                case '046':
                    $bentuk = 'Akademi Komunitas';
                    $pendidikan_pt = 'Vokasi';
                    break;
            }
        
            foreach ($spmi as $item) {
                // Cek apakah 'kode_pt' ada dan cocok dengan 'npsn'
                if (isset($item['kodept']) && $data['npsn'] == $item['kodept']) {
                    $akreditasi = $data['akreditasi']['nm_akred'] ?? 'Tidak tersedia';
        
                    // Menambahkan data ke array result
                    $result[] = [
                        'npsn' => $data['npsn'],
                        'nm_lemb' => $data['nm_lemb'],
                        'akreditasi' => $akreditasi,
                        'kota_kab' => $data['kota_kab'],
                        'bentuk' => $bentuk, // Menambahkan bentuk
                        'pendidikan_pt' => $pendidikan_pt // Menambahkan jenis pendidikan
                    ];
        
                    break; // Berhenti setelah menemukan data yang cocok
                }
            }
        }
        
        
        // Cek apakah hasilnya kosong
        if (empty($result)) {
            return ['message' => 'No matching data found'];
        }
        
        return $result;
        
    }

    public function data_sebaran_pts()
    {
        // Contoh data: ganti dengan query dari database atau data sebenarnya
        $data = $this->get_api_pt();

        // Menghitung jumlah institusi per kota
        $result = [];
        foreach ($data as $item) {
            $kota_kab = $item['kota_kab'];
            if (!isset($result[$kota_kab])) {
                $result[$kota_kab] = ['kota_kab' => $kota_kab, 'jumlah_institusi' => 0];
            }
            $result[$kota_kab]['jumlah_institusi']++;
        }

        // Format ulang hasil menjadi array numerik
        $response = array_values($result);

        // Mengembalikan data sebagai JSON
        return response()->json($response);
    }

    public function sebaran_pts(){
        $data = $this->get_api_pt();
        return view('sebaran_pts', ['data'=>$data]);
    }
}