<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class kelasController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index(){
		$data['result'] = \App\Kelas::all();
		return view('kelas/index')->with($data);
	}
	
	public function create()
	{
		return view('kelas/form');
	}
	
	public function store(Request $request)
	{
		$rules = [
			'nama_kelas'	=> 'required|max:100',
			'jurusan'		=> 'required|max:100'
		];
		$this->validate($request, $rules);

		$input = $request->all();
		$status = \App\Kelas::create($input);
		
		if ($status) return redirect('/')->with('success', 'Data Berhasil Dimasukan');
		else return redirect('/')->with('error', 'Data Gagal Ditambahkan');
	}

	public function edit($id)
	{
		$data['result'] = \App\Kelas::where('id_kelas', $id)->first();
		return view('kelas/form')->with($data);
	}

	public function update(Request $request, $id)
	{
		$rules = [
			'nama_kelas'	=> 'required|max:100',
			'jurusan'		=> 'required|max:100'
		];
		$this->validate($request, $rules);

		$input = $request->all();
		$result = \App\Kelas::where('id_kelas', $id)->first();
		$status = $result->update($input);
		
		if ($status) return redirect('/')->with('success', 'Data Berhasil Diubah');
		else return redirect('/')->with('error', 'Data Gagal Diubah');
	}

	public function destroy(Request $request, $id)
	{
		$result = \App\Kelas::where('id_kelas', $id)->first();
		$status = $result->delete();
		
		if ($status) return redirect('/')->with('success', 'Data Berhasil Dihapus');
		else return redirect('/')->with('error', 'Data Gagal Dihapus');
	}		
}

	