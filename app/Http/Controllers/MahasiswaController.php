<?php

namespace App\Http\Controllers;
use App\Models\Mahasiswa;
use App\Models\Kelas;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $mahasiswas = Mahasiswa::all(); 
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        // return view('mahasiswa.index', compact('mahasiswas'));
        // with('i', (request()->input('page', 1) - 1) * 5);
        
        if($request->has('search')){ // Pemilihan jika ingin melakukan pencarian nama
            $mahasiswas = Mahasiswa::where('nama', 'like', "%".$request->search."%")->with('kelas')->paginate(5);
        } else { // Pemilihan jika tidak melakukan pencarian nama
            //fungsi eloquent menampilkan data menggunakan pagination
            $mahasiswas = Mahasiswa::paginate(5); // Pagination menampilkan 5 data
        }
        return view('mahasiswa.index', compact('mahasiswas'));

        // $mahasiswa = Mahasiswa::with('kelas')->get();   
        // $
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create', ['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            ]);
            
        // Mahasiswa::create($request->all());
        //fungsi eloquent untuk mengambil data kelas dari relation
        $kelas = Kelas::find($request->get('Kelas'));

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->no_hp = $request->get('No_Handphone');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save(); 
        
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all();
        return view('mahasiswa.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            ]);
            
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::find($request->get('Kelas'));

        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->no_hp = $request->get('No_Handphone');

        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->update(); 

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $Nim)
    {
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
