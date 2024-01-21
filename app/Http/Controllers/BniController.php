<?php

namespace App\Http\Controllers;

use stdClass;
use DataTables;
use App\Models\RefBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BniController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $files =  json_decode(Storage::disk('public')->get('responseBni.json'), false);
            $arr = collect();
            $nomor_rekening_lelang = RefBank::lelangPerSatker()->first()->nomor_rekening;
            foreach ($files as $file) {
                if (substr($file, 0, 1) !== 'S' and substr($file, 27, 10) == $nomor_rekening_lelang) {
                    $object = new stdClass();
                    $object = [
                        'no' => substr($file,27,10),
                        'tgl' => substr($file,0,8),
                        'file' => $file,
                    ];
                    $arr->push($object);
                }
            }
            $arr = json_decode($arr, false);

            return DataTables::of($arr)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $proses = '<a href='.route('bni.index').'/'.$row->file.' class="btn btn-primary btn-sm">Proses</a>';
                        $button = $proses;
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('bni');

    }

    public function proses($file)
    {
        $contents = Storage::disk('sftp_bni')->get($file);

        $lines = explode("\n", $contents);
        $col0 = collect();
        $col1 = collect();
        $col2 = collect();
        $cols = collect();
        foreach ($lines as $line) {
            $report = explode(':', $line);
            if (isset($report[1]) && isset($report[2])) {
                if ($report[1] === '25') {
                    $object = new stdClass();
                    if(strlen($report[2])==8) {
                        $object = '00'.$report[2];
                    } elseif(strlen($report[2])==9) {
                        $object = '0'.$report[2];
                    } else {
                        $object = $report[2];
                    }
                    $col0->push($object);
                }
                if ($report[1] === '61') {
                    $object = new stdClass();
                    $object = $report[2];
                    $col1->push($object);
                }
                if ($report[1] === '86') {
                    $object = new stdClass();
                    $object = $report[2];
                    $col2->push($object);
                }
            }
        }
        $i = 0;
        foreach($col1 as $item) {
            $object = new stdClass();
            $object = $col0[0].'//'.substr($item, 0, 6).'//'.substr($item, 6, 2).'//'.substr($item, 8, strlen($item)-14).'//'.$col2[$i];
            $object = explode('//', $object);
            $cols->push($object);
            $i++;
        }

        foreach ($cols as $col) {
            RekeningKoran::create([
                'kode_satker' => auth()->user()->kode_satker,
                'nomor_rekening' => $col[0],
                'nama_bank' => 'BNI',
                'tanggal' => substr($col[1],4,2),
                'bulan' => substr($col[1],2,2),
                'tahun' => substr($col[1],0,2),
                'tipe' => $col[2],
                'nominal' =>$col[3],
                'keterangan' => $col[4],
            ]);
        }

        // dd($contents);

        return redirect()->route('rekening-koran.index');

    }
}
