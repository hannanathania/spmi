<?php

namespace App\Http\Controllers;

use App\Models\ModelSPMI;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class ControllerSPMI extends Controller
{
    public function index(Request $request)
    {
        // Query dasar untuk mengambil data ModelSPMI
        $spmi = ModelSPMI::query();
        $data = $this->ambilData();
    
        // Check if search input is provided and not empty
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = strtolower($request->search); // Convert input to lowercase
    
            if (is_numeric($searchTerm)) {
                $spmi->whereRaw('LOWER(kodept) LIKE ?', ['%' . $searchTerm . '%']);
            } else {
                $spmi->whereRaw('LOWER(ptspmi) LIKE ?', ['%' . $searchTerm . '%']);
            }
        }
    
        // Paginasi setelah pencarian sudah difilter
        $spmiPaginated = $spmi->paginate(10)->appends(request()->query());
    
        // Hitung total berdasarkan data yang dipaginasi
        $total_baris = $this->calculate();
    
        // Kembalikan view dengan data yang sudah diatur
        return view('index', [
            'spmi' => $spmiPaginated,
            'data' => $data,
            'total_baris' => $total_baris
        ]);
    }
    
    
    
    public function ambilData(){
        $spmi = ModelSPMI::all();
        $result = []; 
    
        foreach ($spmi as $item) {
            $row = [
                'pt' => $item->ptspmi,
                'kode_pt' => $item->kodept,
                'kebijakan1' => [
                    'valid' => ($item->val1 == 1) ? 1 : 0,
                    'ver' => ($item->ver1 == 1) ? 1 : 0,
                    'unggah' => ($item->ul1!=null || $item->ul1!='') ? 1 : 0,
                ],
                'kebijakan2' => [
                    'valid' => ($item->val2 == 1) ? 1 : 0,
                    'ver' => ($item->ver2 == 1) ? 1 : 0,
                    'unggah' => ($item->ul2!=null || $item->ul2!='') ? 1 : 0,
                ],
                'kebijakan3' => [
                    'valid' => ($item->val3 == 1) ? 1 : 0,
                    'ver' => ($item->ver3 == 1) ? 1 : 0,
                    'unggah' => ($item->ul3!=null || $item->ul3!='') ? 1 : 0,
                ],
                'kebijakan4' => [
                    'valid' => ($item->val4 == 1) ? 1 : 0,
                    'ver' => ($item->ver4 == 1) ? 1 : 0,
                    'unggah' => ($item->ul4!=null || $item->ul4!='') ? 1 : 0,
                ],
                'kebijakan5' => [
                    'valid' => ($item->val5 == 1) ? 1 : 0,
                    'ver' => ($item->ver5 == 1) ? 1 : 0,
                    'unggah' => ($item->ul5!=null || $item->ul5!='') ? 1 : 0,
                ],
                'kebijakan6' => [
                    'valid' => ($item->val6 == 1) ? 1 : 0,
                    'ver' => ($item->ver6 == 1) ? 1 : 0,
                    'unggah' => ($item->ul6!=null || $item->ul6!='') ? 1 : 0,
                ],
                
                'standar1' => [
                    'valid' => ($item->s1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s1 && $item->s1 <= 3) ? 1 : 0,
                    'unggah' => ($item->s1 >= 1) ? 1 : 0,
                ],

                'standar2' => [
                    'valid' => ($item->s2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s2 && $item->s2 <= 3) ? 1 : 0,
                    'unggah' => ($item->s2 >= 1) ? 1 : 0,
                ],

                'standar3' => [
                    'valid' => ($item->s3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->s3 && $item->s3 <= 3) ? 1 : 0,
                    'unggah' => ($item->s1 >= 3) ? 1 : 0,
                ],
                
                'lain1' => [
                    'valid' => ($item->l1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l1 && $item->l1 <= 3) ? 1 : 0,
                    'unggah' => ($item->l1 >= 1) ? 1 : 0,
                ],
                'lain2' => [
                    'valid' => ($item->l2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l2 && $item->l2 <= 3) ? 1 : 0,
                    'unggah' => ($item->l2 >= 1) ? 1 : 0,
                ],
                'lain3' => [
                    'valid' => ($item->l3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l3 && $item->l3 <= 3) ? 1 : 0,
                    'unggah' => ($item->l3 >= 1) ? 1 : 0,
                ],
                'lain4' => [
                    'valid' => ($item->l4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l4 && $item->l4 <= 3) ? 1 : 0,
                    'unggah' => ($item->l4 >= 1) ? 1 : 0,
                ],
                'lain5' => [
                    'valid' => ($item->l5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l5 && $item->l5 <= 3) ? 1 : 0,
                    'unggah' => ($item->l5 >= 1) ? 1 : 0,
                ],
                'lain6' => [
                    'valid' => ($item->l6 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l6 && $item->l6 <= 3) ? 1 : 0,
                    'unggah' => ($item->l6 >= 1) ? 1 : 0,
                ],
                'lain7' => [
                    'valid' => ($item->l7 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->l7 && $item->l7 <= 3) ? 1 : 0,
                    'unggah' => ($item->l7 >= 1) ? 1 : 0,
                ],

                'audit1' => [
                    'valid' => ($item->ami1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami1 && $item->ami1 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami1 >= 1) ? 1 : 0,
                ],
                'audit2' => [
                    'valid' => ($item->ami2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami2 && $item->ami2 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami2 >= 1) ? 1 : 0,
                ],
                'audit3' => [
                    'valid' => ($item->ami3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->ami3 && $item->ami3 <= 3) ? 1 : 0,
                    'unggah' => ($item->ami3 >= 1) ? 1 : 0,
                ],

                'pengendalian1' => [
                    'valid' => ($item->k1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k1 && $item->k1 <= 3) ? 1 : 0,
                    'unggah' => ($item->k1 >= 1) ? 1 : 0,
                ],
                'pengendalian2' => [
                    'valid' => ($item->k2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k2 && $item->k2 <= 3) ? 1 : 0,
                    'unggah' => ($item->k2 >= 1) ? 1 : 0,
                ],
                'pengendalian3' => [
                    'valid' => ($item->k3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k3 && $item->k3 <= 3) ? 1 : 0,
                    'unggah' => ($item->k3 >= 1) ? 1 : 0,
                ],
                'pengendalian4' => [
                    'valid' => ($item->k4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k4 && $item->k4 <= 3) ? 1 : 0,
                    'unggah' => ($item->k4 >= 1) ? 1 : 0,
                ],
                'pengendalian5' => [
                    'valid' => ($item->k5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k5 && $item->k5 <= 3) ? 1 : 0,
                    'unggah' => ($item->k5 >= 1) ? 1 : 0,
                ],
                'pengendalian6' => [
                    'valid' => ($item->k6 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k6 && $item->k6 <= 3) ? 1 : 0,
                    'unggah' => ($item->k6 >= 1) ? 1 : 0,
                ],
                'pengendalian7' => [
                    'valid' => ($item->k7 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k7 && $item->k7 <= 3) ? 1 : 0,
                    'unggah' => ($item->k7 >= 1) ? 1 : 0,
                ],
                'pengendalian8' => [
                    'valid' => ($item->k8 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k8 && $item->k8 <= 3) ? 1 : 0,
                    'unggah' => ($item->k8 >= 1) ? 1 : 0,
                ],
                'pengendalian9' => [
                    'valid' => ($item->k9 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k9 && $item->k9 <= 3) ? 1 : 0,
                    'unggah' => ($item->k9 >= 1) ? 1 : 0,
                ],
                'pengendalian10' => [
                    'valid' => ($item->k10 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->k10 && $item->k10 <= 3) ? 1 : 0,
                    'unggah' => ($item->k10 >= 1) ? 1 : 0,
                ],

                'peningkatan1' => [
                    'valid' => ($item->t1 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t1 && $item->t1 <= 3) ? 1 : 0,
                    'unggah' => ($item->t1 >= 1) ? 1 : 0,
                ],
                'peningkatan2' => [
                    'valid' => ($item->t2 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t2 && $item->t2 <= 3) ? 1 : 0,
                    'unggah' => ($item->t2 >= 1) ? 1 : 0,
                ],
                'peningkatan3' => [
                    'valid' => ($item->t3 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t3 && $item->t3 <= 3) ? 1 : 0,
                    'unggah' => ($item->t3 >= 1) ? 1 : 0,
                ],
                'peningkatan4' => [
                    'valid' => ($item->t4 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t4 && $item->t4 <= 3) ? 1 : 0,
                    'unggah' => ($item->t4 >= 1) ? 1 : 0,
                ],
                'peningkatan5' => [
                    'valid' => ($item->t5 == 3) ? 1 : 0,
                    'ver' => (2 <= $item->t5 && $item->t5 <= 3) ? 1 : 0,
                    'unggah' => ($item->t5 >= 1) ? 1 : 0,
                ],
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
        $i=0;

        // Calculate totals by iterating over each item
        foreach ($data as $item) {
            $pt = $item['pt']; // Ambil nama PT
            $kode_pt = $item['kode_pt'];
            $totalValid = 0;
            $totalVerif = 0;
            $totalUnggah = 0;
    
            $totalValid_seharusnya = 0;
            $totalVerif_seharusnya = 0;
            $totalUnggah_seharusnya = 0;

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

            $i+=1;
            $presentase_valid = round(($totalValid / $totalValid_seharusnya) * 100, 2); 
            $presentase_verif = round(($totalVerif / $totalVerif_seharusnya) * 100, 2); 
            $presentase_unggah = round(($totalUnggah / $totalUnggah_seharusnya) * 100, 2); 
            

            $data['totals'] = [
                'kode_pt' => $kode_pt,
                'pt' => $pt,
                'valid' => $totalValid,
                'ver' => $totalVerif,
                'unggah' => $totalUnggah,
                'valid_seharusnya' => $totalValid_seharusnya,
                'verif_seharusnya' =>$totalVerif_seharusnya,
                'unggah_seharusnya'=>$totalUnggah_seharusnya,
                'presentase_valid' => $presentase_valid,
                'presentase_verif' => $presentase_verif,
                'presentase_unggah' => $presentase_unggah
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
        $data = $this->ambilData();

        // Initialize totals
        $totalValid = 0;
        $totalVerif = 0;
        $totalUnggah = 0;

        $totalValid_seharusnya = 0;
        $totalVerif_seharusnya = 0;
        $totalUnggah_seharusnya = 0;
    
        // Calculate totals by iterating over each item
        foreach ($data as $item) {
            foreach ($item as $key => $fields) {

                if ($key === "kode_pt" ) {
                    continue;
                }
                

                if ($key === "pt") {
                    continue;
                }

                $totalValid  += $fields['valid'];
                $totalVerif  += $fields['ver'];
                $totalUnggah += $fields['unggah'];

                $totalValid_seharusnya += 1;
                $totalVerif_seharusnya += 1;
                $totalUnggah_seharusnya += 1;


            }

            $presentase_valid = ($totalValid/$totalValid_seharusnya)*100;
            $presentase_verif = ($totalVerif/$totalVerif_seharusnya)*100;
            $presentase_unggah = ($totalUnggah/$totalUnggah_seharusnya)*100;

            $data['totals'] = [
                'valid' => $totalValid,
                'ver' => $totalVerif,
                'unggah' => $totalUnggah,
                'valid_seharusnya' => $totalValid_seharusnya,
                'verif_seharusnya' =>$totalVerif_seharusnya,
                'unggah_seharusnya'=>$totalUnggah_seharusnya,
                'presentase_valid' => $presentase_valid,
                'presentase_verif' => $presentase_verif,
                'presentase_unggah' => $presentase_unggah
            ];


        }
    
        // Return the result with totals included as JSON
        // return response()->json($data['totals']);
        return $data['totals'];
    }
    
}