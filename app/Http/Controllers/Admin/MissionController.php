<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Mission\UpdateRequest;
use App\Http\Requests\Admin\Mission\StoreRequest;
use App\Models\Mission;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $missions = Mission::orderBy('created_at', 'DESC')->get();
        return view('admin.modules.mission.index', ['missions' => $missions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.modules.mission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $ngayNhapVao = Carbon::parse($request->day);
        $ngayHienTai = Carbon::now();

        if ($ngayNhapVao->gt($ngayHienTai)) {
            $mission = new Mission();
            $mission->name = $request->name;
            $mission->day = $request->day;
            $mission->save();
    
            return redirect()->route('admin.mission.index')->with('success', 'Tạo mới nhiệm vụ thành công.');
        } else {
        return redirect()->route('admin.mission.index')->with(['error' => 'Ngày nhập vào phải lớn hơn ngày hiện tại']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mission = Mission::find($id);
        if ($mission == null) {
            abort(404);
        }
        return view('admin.modules.mission.edit', ['mission' => $mission, 'id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $mission = Mission::find($id);
        if ($mission == null) {
            abort(404);
        }
        
        $mission->name = $request->name;
        $mission->day = $request->day;
        $mission->save();

        return redirect()->route('admin.mission.index')->with('success', 'Cập nhật nhiệm vụ thành công.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mission = Mission::find($id);
        if ($mission == null) {
            abort(404);
        }

        $mission->delete();
        return redirect()->route('admin.mission.index')->with('success', 'Xóa nhiệm vụ thành công.');
    }
}
