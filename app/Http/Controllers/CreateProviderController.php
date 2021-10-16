<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Provider;
use App\Models\DataProvider;
use Validator;
use Session;
use DB;

class CreateProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        return view('content/menu', ['providers' => $providers]);
    }

    public function show(Provider $provider)
    {
        // $dataproviders = DataProvider::all();
        $dataproviders = DB::table('data_providers')->where('no_provider','LIKE',$provider->no_provider.'%')->get();
        return view('content/show_content/show-detail',['provider' => $provider, 'dataproviders' => $dataproviders]);
    }

    public function editProvider(Provider $provider)
    {
        return view('/content/edit/edit-provider', ['provider' => $provider]);
    }

    public function deleteProvider(Provider $provider)
    {

        $query = DB::table('data_providers')
            ->where('no_provider','LIKE',$provider->no_provider.'%')->delete();

        if ($provider->file) {
            Storage::delete($provider->file);
        }

        $provider->delete();
        return redirect()->route('main/index')->with('success', "Hapus provider $provider->nama_provider dan data provider $provider->no_provider berhasil");
    }

    public function dataProvider()
    {
        $providers = Provider::pluck('no_provider', 'nama_provider');
        return view('content/data-provider', ['providers' => $providers]);
    }

    public function provider()
    {
        return view('content/buatprovider');
    }

    public function createProvider(Request $request)
    {

        $rules = [
            'nama_provider' => 'required|min:3',
            'jenis_provider' => 'required|min:3',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required',
        ];

        $messages = [
            'nama_provider.required' => 'Nama Provider wajib diisi',
            'jenis_provider.required' => 'Jenis Provider wajib diisi',
            'image.required' => 'File wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $substr_prov = substr($request->nama_provider, 0, 3);
        $no_provider = strtoupper($substr_prov);

        $query = DB::table('providers')->where('no_provider','=',$no_provider)->count();
        // dump($query);
        if($query == 1)
        {
            Session::flash('error', 'Nama Provider '.$request->nama_provider.' Sudah Ada, Hanya Dapat Mengubah atau Menghapus Data');
            return redirect()->route('main/provider');
        }

        $file = $request->file('image');
        $nama_file = time()."_".$file->getClientOriginalName();
        $storeAs_image = $file->storeAs('images', $nama_file);

        $provider = new Provider;
            $provider->no_provider = $no_provider;
            $provider->nama_provider = ucwords(strtolower($request->nama_provider));
            $provider->jenis_provider = ucwords(strtolower($request->jenis_provider));
            $provider->tanggal = $request->tanggal;
            $provider->file = $storeAs_image;
            $simpan = $provider->save();

        if($simpan){
            Session::flash('success', "Tambah data {$request['nama_provider']} berhasil");
            return redirect()->route('main/index');
        } else {
            Session::flash('errors', 'Tambah data gagal! Silahkan ulangi lagi');
            return redirect()->route('main/provider');
        }
    }

    public function prosesEditProvider(Request $request, Provider $provider)
    {
        $rules = [
            'jenis_provider' => 'required|min:5',
            'image' => 'file|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'required',
        ];

        $messages = [
            'jenis_provider.required' => 'Jenis Provider wajib diisi',
            'tanggal.required' => 'Tanggal wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        if (empty($request->image)){
            $provider = Provider::where('id', $provider->id)->first();
                $provider->jenis_provider = $request->jenis_provider;
                $simpan = $provider->save();
        }
        else{
            if ($provider->file) {
                Storage::delete($provider->file);
            }

            $file = $request->file('image');
            $nama_file = time()."_".$file->getClientOriginalName();
            $storeAs_image = $file->storeAs('images', $nama_file);

            $provider = Provider::where('id', $provider->id)->first();
                $provider->jenis_provider = $request->jenis_provider;
                $provider->tanggal = $request->tanggal;
                $provider->file = $storeAs_image;
                $simpan = $provider->save();
        }

        if($simpan){
            Session::flash('success', "Ubah data {$provider['nama_provider']} berhasil");
            return redirect()->route('main/index');
        } else {
            Session::flash('error', 'Tambah data gagal! Silahkan ulangi lagi');
            return redirect()->route('edit/provider');
        }
    }
}
