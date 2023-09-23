<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Role';
        $this->param['pageTitle'] = 'Role';
        $this->param['pageIcon'] = 'store';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $this->param['btnRight']['text'] = 'Tambah';
        $this->param['btnRight']['link'] = route('role.create');
        $this->param['data'] = RoleModel::when($keyword, function($q, $keyword){
                return $q->where('name', 'like', '%' . $keyword . '%');
            })
            ->paginate(10);

        return view('backend.role.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('role.index');
        $this->param['dataPermissions'] = DB::table('permissions')
            ->get();

        return view('backend.role.add', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arrayIdPermission = array();
        DB::beginTransaction();
        try{
            $dataInserted = new RoleModel();
            $dataInserted->name = $request->name;
            $dataInserted->guard_name = 'web';
            $dataInserted->created_at = now();
            $dataInserted->save();
            $id = $dataInserted->id;

            foreach($request->id_permissions as $key => $item){
                array_push($arrayIdPermission, [
                    'permission_id' => $item,
                    'role_id' => $id
                ]);
            }

            DB::table('role_has_permissions')
                ->insert($arrayIdPermission);
            DB::commit();

            return redirect()->route('role.index')->withStatus('Berhasil menambahkan role.');
        } catch(Exception $e){
            DB::rollBack();
            dd($e);
            return redirect()->route('role.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            dd($e);
            return redirect()->route('role.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->param['data'] = RoleModel::find($id);
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('role.index');
        $this->param['dataPermissions'] = DB::table('permissions')
            ->get();
        $this->param['selected'] = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->join('permissions', 'role_has_permissions.permission_id', 'permissions.id')
            ->get();
        return view('backend.role.detail', $this->param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->param['data'] = RoleModel::find($id);
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('role.index');
        $this->param['dataPermissions'] = DB::table('permissions')
            ->get();
        $selected = DB::table('role_has_permissions')
            ->where('role_id', $id)
            ->get();
        $arraySelected = array();
        foreach($selected as $item){
            array_push($arraySelected, $item->permission_id);
        }
        $this->param['dataPermissionsSelected'] = $arraySelected;
        return view('backend.role.edit', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $updated = RoleModel::find($id);
            $updated->name = $request->name;
            $fieldToInsert = array();
            
            if(isset($request->fieldToDelete)){
                foreach($request->fieldToDelete as $item){
                    DB::table('role_has_permissions')
                        ->where('permission_id', $item)
                        ->where('role_id', $id)
                        ->delete();
                }
            }
            if(isset($request->fieldToInsert)){
                foreach($request->fieldToInsert as $item){
                    array_push($fieldToInsert, [
                        'role_id' => $id,
                        'permission_id' => $item
                    ]);
                }
                DB::table('role_has_permissions')
                    ->insert($fieldToInsert);
            }
            
            DB::commit();
            return redirect()->route('role.index')->withStatus('Berhasil mengubah data.');
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('role.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('role.index')->withError('Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $deleted = RoleModel::find($id);
            $deleted->delete();
            DB::table('role_has_permissions')
                ->where('role_id', $id)
                ->delete();
            
            DB::commit();
            return redirect()->route('role.index')->withStatus("Berhasil menghapus data");
        } catch(Exception $e){
            DB::rollBack();
            return redirect()->route('role.index')->withError("Terjadi kesalahan. " . $e->getMessage());
        } catch(QueryException $e){
            DB::rollBack();
            return redirect()->route('role.index')->withError("Terjadi kesalahan. " . $e->getMessage());
        }
    }
}
