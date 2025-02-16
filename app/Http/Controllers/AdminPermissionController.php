<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function createPermissions()
    {
        return view('admin.permission.add');
    }

    public function store(Request $request)
    {
        
        $pemission = Permission::create([
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0,
        ]);

        // Kiểm tra xem module_chilrent có phải là mảng và không null không
        if (is_array($request->module_chilrent)) 
        {
            foreach ($request->module_chilrent as $value) {
                Permission::create([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $pemission->id,
                    'key_code' => $request->module_parent . '_' . $value,
                ]);
            }
        }
    }
}
