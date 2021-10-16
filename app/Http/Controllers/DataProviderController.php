<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DataProvider;
use App\Models\Provider;
use Validator;
use Session;
use DB;

class DataProviderController extends Controller
{
    public function editDataProvider(DataProvider $dataprovider, Provider $provider)
    {
        return view('content/edit/edit-data-provider',['dataprovider' => $dataprovider, 'provider' => $provider]);
    }

    public function deleteDataProvider(DataProvider $dataprovider, Provider $provider)
    {
        $dataprovider->delete();
        return redirect()->route('main/show', ['provider' => $provider])->with('pesan', "Hapus data provider $dataprovider->nama_paket berhasil");
    }

    public function storeDataProvider(Request $request)
    {

        $rules = [
            'provider' => 'required',
            'nama_paket' => 'required|min:2',
            'kecepatan' => 'required',
            'harga' => 'required',
        ];

        $messages = [
            'provider.required' => 'Provider wajib diisi',
            'nama_paket.required' => 'Nama Paket wajib diisi',
            'kecepatan.required' => 'kecepatan wajib diisi',
            'harga' => 'Harga wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

    	$prx=$request->provider;
        $q=DB::table('data_providers')
            ->selectRaw('MAX(RIGHT(no_provider,5)) as kd_max')
            ->where('no_provider','LIKE', $prx.'%');
        if($q->count()>0)
        {
            foreach($q->get() as $k)
            {
                $tmp = ((int)$k->kd_max)+1;
                $kd = $prx.sprintf("%06s", $tmp);
            }
        }
        else
        {
            $kd = $prx."000001";
        }

        // dump($q);
        // dump($q->count());
        $dataprovider = new DataProvider;
            $dataprovider->no_provider = $kd;
            $dataprovider->nama_paket = ucwords(strtolower($request->nama_paket));
            $dataprovider->kecepatan = ucwords($request->kecepatan);
            $dataprovider->harga = ucwords(strtolower($request->harga));
            $simpan = $dataprovider->save();

        if($simpan){
            Session::flash('success', "Tambah data {$request['nama_paket']} berhasil");
            return redirect()->route('main/index');
        } else {
            Session::flash('errors', 'Tambah data gagal! Silahkan ulangi lagi');
            return redirect()->route('main/data-provider');
        }
    }

    public function prosesEditDataProvider(Request $request, DataProvider $dataprovider,  Provider $provider)
    {

        $rules = [
            'nama_paket' => 'required|min:2',
            'kecepatan' => 'required',
            'harga' => 'required'
        ];

        $messages = [
            'nama_paket.required' => 'Nama Paket wajib diisi',
            'kecepatan.required' => 'kecepatan wajib diisi',
            'harga' => 'Harga wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        // dump($q);
        // dump($q->count());
        $dataprovider = DataProvider::where('id', $dataprovider->id)->first();
            $dataprovider->nama_paket = ucwords(strtolower($request->nama_paket));
            $dataprovider->kecepatan = ucwords($request->kecepatan);
            $dataprovider->harga = ucwords(strtolower($request->harga));
            $simpan = $dataprovider->save();

        if($simpan){
            Session::flash('pesan', "Update data provider {$request['nama_paket']} berhasil");
            return redirect()->route('main/show', ['provider' => $provider]);
        } else {
            Session::flash('errors', 'Tambah data gagal! Silahkan ulangi lagi');
            return redirect()->route('edit/data_provider',  ['dataprovider' => $dataprovider, 'provider' => $provider]);
        }
    }

}
