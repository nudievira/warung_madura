<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\Cryptography;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.index');
    }

    public function dataTables(Request $request)
    {
        $response = $this->get('transaksi/data-table/', $request->all(), []);
        $response_body = json_decode($response->getBody());
        // dd($response_body);
        if ($request->ajax()) {

            $data_tables = DataTables::of($response_body->data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $edit = true;
                //     $btn = '
                //     <button href="' . url('transaksi/show/' . Cryptography::encryptString($data->id)) . '"
                // class="btn btn-xs btn-outline-primary mr-2 px-2"><i class="fas fa-eye"></i>
                // Lihat</button>';
                    $btn = '
                    <button class="btn btn-xs btn-outline-primary mr-2 px-2" onclick="modalView('.$data->id.')"><i class="fas fa-eye"></i>
                Lihat</button>
                    <button class="btn btn-xs btn-outline-success mr-2 px-2" onclick="modalView('.$data->id.', '.$edit.')"><i class="fas fa-edit"></i>
                Lihat</button>
                ';

                    return $btn;
                })
                ->addColumn('formatDate', function ($data) {
                    $date = date('d F Y', strtotime($data->tanggal_transaksi));
                    return $date;
                })
                ->rawColumns(['action', 'formatDate'])
                ->make(true);

            return $data_tables;
        }
    }

    public function create()
    {
        $response = $this->get('transaksi/get-item/', [], []);
        $response_body = json_decode($response->getBody());
        $barang = $response_body->data;
        return view('transaksi.create',compact('barang'));
    }

    public function store(Request $request)
    {
        $response = $this->post('transaksi/store', $request->all());
        if ($response->status() == 200) {
            return redirect()->route('transaksi.index')->with('success_message', "Transaksi berhasil disimpan");
        } else {
            return redirect()->back()->with('failed', $response->reason());
        }

    }

    public function show(Request $request)
    {
        $response = $this->get('transaksi/show/' . $request->id, []);
        $response_body = json_decode($response->getBody());
        $input_stock = $response_body->data;
        return $input_stock;
    }

    public function update(Request $request)
    {
        $response = $this->get('transaksi/update', $request->all());
        if ($response->status() == 200) {
            return redirect()->route('transaksi.index')->with('success_message', "Transaksi berhasil disimpan");
        } else {
            return redirect()->back()->with('failed', $response->reason());
        }
    }

    public function indexReport()
    {
        return view('transaksi.indexReport');
    }
    public function dataTablesReport(Request $request)
    {
        $response = $this->get('transaksi/data-table-repot/', $request->all(), []);
        $response_body = json_decode($response->getBody());
        if ($request->ajax()) {
            $data_tables = DataTables::of($response_body->data)
                ->addIndexColumn()
                ->make(true);
            return $data_tables;
        }
    }

}
