<?php

namespace App\Traits;
use Storage;
use Illuminate\Support\Str;

trait CartUpdateModelTrait {
    public function updateCartModelTrait($model, $id, $data) {
        try {
            // Kiểm tra nếu $model là một đối tượng Eloquent hợp lệ
            if (!is_string($model) || !class_exists($model) || !method_exists($model, 'find')) {
                return response()->json([
                    'code' => 400,
                    'message' => 'Model không hợp lệ.',
                ], 400);
            }
    
            // Tìm bản ghi cần cập nhật
            $record = $model::find($id);
    
            // Kiểm tra nếu không tìm thấy bản ghi
            if (!$record) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Không tìm thấy bản ghi cần cập nhật.'
                ], 404);
            }
    
            // Cập nhật các trường trong bảng
            $record->update($data);
    
            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật thành công.',
                'data' => $record
            ], 200);
    
        } catch (\Exception $exception) {
            // Log lỗi nếu có
            \Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
            
            return response()->json([
                'code' => 500,
                'message' => 'Cập nhật thất bại.'
            ], 500);
        }
    }
    
}
