<?php

namespace App\Traits;
use Storage;
use Illuminate\Support\Str;

trait CartDeleteModelTrait {
    public function deleteCartModelTrait($id, $model) {
        try {
            $record = $model->find($id);
            
            if (!$record) {
                return response()->json([ 
                    'code' => 404,
                    'message' => 'Không tìm thấy bản ghi cần xóa.'
                ], 404);
            }

            $record->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Xóa thành công.'
            ], 200);

        } catch (\Exception $exception) {
            \Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Xóa thất bại.'
            ], 500);
        }
    }
}
