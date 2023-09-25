<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $param;
    private $menu;

    public function __construct()
    {
        $this->param['title'] = 'User';
        $this->param['pageTitle'] = 'User';
        $this->param['pageIcon'] = 'users';
        $this->menu = 'Master User';
    }

    public function index(Request $request)
    {
        if ($this->hasPermission($this->menu)) {
            $this->param['btnRight']['text'] = 'Tambah';
            $this->param['btnRight']['link'] = route('user.create');
    
            try {
                $keyword = $request->get('keyword');
                $getUsers = User::select('users.*', 'r.name AS role_name')
                                ->join('model_has_roles AS m', 'm.model_id', 'users.id')
                                ->join('roles AS r', 'r.id', 'm.role_id')
                                ->orderBy('users.name', 'ASC');
    
                if ($keyword) {
                    $getUsers->where('users.name', 'LIKE', "%$keyword%")->orWhere('users.email', 'LIKE', "%$keyword%")->orWhere('r.name', 'LIKE', "%$keyword%");
                }
    
                $this->param['user'] = $getUsers->paginate(10);
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withStatus('Terjadi Kesalahan');
            }
    
            return \view('backend.user.list-user', $this->param);
        }
        else
            return view('error_page.forbidden');
    }

    public function create()
    {
        if ($this->hasPermission($this->menu)) {
            $this->param['role'] = DB::table('roles')->select('id', 'name')->orderBy('name')->get();
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('user.index');
    
            return \view('backend.user.tambah-user', $this->param);
        }
        else
            return view('error_page.forbidden');
    }

    public function store(Request $request)
    {
        if ($this->hasPermission($this->menu)) {
            $validatedData = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users',
                    'role' => 'not_in:0',
                ],
                [
                    'required' => ':attribute tidak boleh kosong.',
                    'email' => 'Masukan email yang valid.',
                    'unique' => ':attribute telah terdaftar',
                    'not_in' => ':attribute harus dipilih'
                ],
                [
                    'name' => 'Nama',
                    'email' => 'Email',
                    'role' => 'Role'
                ]
            );
            try {
                $newUser = new User;
    
                $newUser->name = $request->get('name');
                $newUser->email = $request->get('email');
                $newUser->password = \Hash::make($request->get('email'));
                $newUser->role = $request->get('role');
    
                $newUser->save();

                $newUser->assignRole($request->role);
    
                return redirect()->route('user.index')->withStatus('Data berhasil ditambahkan.');
            } catch (\Exception $e) {
                return redirect()->route('user.index')->withError('Terjadi kesalahan. : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }

    public function edit($id)
    {
        if ($this->hasPermission($this->menu)) {
            try {
                $this->param['role'] = DB::table('roles')->select('id', 'name')->orderBy('name')->get();
                $this->param['btnRight']['text'] = 'Lihat Data';
                $this->param['btnRight']['link'] = route('user.index');
                $this->param['user'] = User::select('users.*', 'r.name AS role_name')
                                        ->join('model_has_roles AS m', 'm.model_id', 'users.id')
                                        ->join('roles AS r', 'r.id', 'm.role_id')
                                        ->where('users.id', $id)
                                        ->first();

                return \view('backend.user.edit-user', $this->param);
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }

    public function update(Request $request, $id)
    {
        if ($this->hasPermission($this->menu)) {
            $user = User::find($id);

            $isUnique = $user->email == $request->email ? '' : '|unique:users';
            $validatedData = $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email' . $isUnique,
                    'role' => 'not_in:0',
                ],
                [
                    'name.required' => ':attribute tidak boleh kosong.',
                    'email.required' => ':attribute tidak boleh kosong.',
                    'not_in' => ':attribute harus dipilih',
                ],
                [
                    'name' => 'Nama',
                    'email' => 'Email',
                    'role' => 'Role'
                ]
            );
            try {
                $user->name = $request->get('name');
                $user->email = $request->get('email');
                $user->save();

                $user->syncRoles($request->get('role'));

                return redirect()->route('user.index')->withStatus('Data berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }

    public function destroy($id)
    {
        if ($this->hasPermission($this->menu)) {
            try {
                $user = User::findOrFail($id);

                DB::table('model_has_roles')->where('model_id', $user->id)->delete();

                $user->delete();
                
                return redirect()->route('user.index')->withStatus('Data berhasil dihapus.');
            } catch (\Exception $e) {
                return redirect()->route('user.index')->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }

    public function gantiPassword($id)
    {
        if ($this->hasPermission($this->menu)) {
            try {
                $this->param['user'] = User::find($id);

                return \view('backend.user.ganti-password', $this->param);
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }

    public function savePassword(Request $request, $id)
    {
        if ($this->hasPermission($this->menu)) {
            $user = User::find($id);

            $validatedData = $request->validate(
                [
                    'old_password' => 'required',
                    'new_password' => 'required',
                    'confirm_password' => 'required|same:new_password',
                ],
                [
                    'old_password.required' => ':attribute tidak boleh kosong.',
                    'new_password.required' => ':attribute tidak boleh kosong.',
                    'confirm_password.required' => ':attribute tidak boleh kosong.',
                    'confirm_password.same' => ':attribute tidak sesuai dengan password baru.',
                ],
                [
                    'old_password' => 'Password lama',
                    'new_password' => 'Password baru',
                    'confirm_password' => 'Konfirmasi password baru',
                ]
            );
            try {

                if (\Hash::check($request->get('old_password'), $user->password)) {
                    $user->password = \Hash::make($request->get('new_password'));
                    $user->save();
                } else {
                    return redirect()->back()->withError('Password lama tidak sesuai.');
                }

                return redirect()->back()->withStatus('Password berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->withError('Terjadi kesalahan : ' . $e->getMessage());
            } catch (\Illuminate\Database\QueryException $e) {
                return redirect()->back()->withError('Terjadi kesalahan pada database : ' . $e->getMessage());
            }
        }
        else
            return view('error_page.forbidden');
    }
}
