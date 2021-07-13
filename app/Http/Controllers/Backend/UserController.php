<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{
    private $param;

    public function index(Request $request)
    {
        $this->param['title'] = 'User';
        $this->param['pageTitle'] = 'User';
        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('user.create');
        
        try {
            $keyword = $request->get('keyword');
            $getUsers = User::orderBy('name', 'ASC');

            if ($keyword) {
                $getUsers->where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%");
            }

            $this->param['user'] = $getUsers->paginate(10);
            
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }
                
        return \view('backend.user.list-user', $this->param);
    }

    public function create()
    {
        $this->param['pageInfo'] = 'Manage User / Tambah Data';
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('user.index');

        return \view('backend.user.tambah-user', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users',
        ],
        [
            'required' => ':attribute tidak boleh kosong.',
            'email' => 'Masukan email yang valid.',
            'unique' => ':attribute telah terdaftar'
        ],
        [
            'nama' => 'Nama',
            'username' => 'Username',
            'email' => 'Alamat email',
        ]);
        try{
            $newUser = new User;
    
            $newUser->nama = $request->get('nama');
            $newUser->username = $request->get('username');
            $newUser->email = $request->get('email');
            $newUser->password = \Hash::make($request->get('username'));

            $newUser->save();

            return redirect()->route('user.index')->withStatus('Data berhasil ditambahkan.');
        }
        catch(\Exception $e){
            return redirect()->back()->withStatus('Terjadi kesalahan. : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withStatus('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $this->param['pageInfo'] = 'Manage User / Edit Data';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('user.index');
            $this->param['user'] = User::find($id);

            return \view('backend.user.edit-user', $this->param);
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $isUnique = $user->email == $request->email ? '' : '|unique:users,email';
        $isUniqueUsername = $user->username == $request->username ? '' : '|unique:users,username';
        $validatedData = $request->validate([
            'nama' => 'required',
            'username' => 'required|'.$isUniqueUsername,
            'email' => 'required|email'.$isUnique,
        ],
        [
            'nama.required' => ':attribute tidak boleh kosong.',
            'username.required' => ':attribute tidak boleh kosong.',
            'email.required' => ':attribute tidak boleh kosong.'
        ],
        [
           'nama' => 'Nama',
           'username' => 'Username',
           'email' => 'Email' 
        ]);
        try{

            $user->nama = $request->get('nama');
            $user->email = $request->get('email');
            $user->username = $request->get('username');
            // $user->akses = $request->get('akses');
            $user->save();

            return redirect()->route('user.index')->withStatus('Data berhasil diperbarui.');
        }
        catch(\Exception $e){
            return redirect()->back()->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $member = User::findOrFail($id);

            $member->delete();

            return redirect()->route('user.index')->withStatus('Data berhasil dihapus.');
        }
        catch(\Exception $e){
            return redirect()->route('user.index')->withError('Terjadi kesalahan : '. $e->getMessage());
        }
        catch(\Illuminate\Database\QueryException $e){
            return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : '. $e->getMessage());
        }
        
    }
}
