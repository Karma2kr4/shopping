<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddSettingRequest;
use App\Models\Setting;
use App\Traits\DeleteModelTrait;

class AdminSettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        
    }
    // index
    public function index()
    {
        $settings = $this->setting->latest()->paginate(5);//thêm latest thể xem sản phẩm vừa thêm lên đầu
        return view('admin.setting.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(AddSettingRequest $request)
    {
        $this->setting->create([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ]);
        return redirect()->route('settings.index');
    }

    //edit update delete
    public function edit($id)
    {
        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update($id, Request $request)
    {
        $this->setting->find($id)->update([
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ]);
        return redirect()->route('settings.index');
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->setting);
    }
}
