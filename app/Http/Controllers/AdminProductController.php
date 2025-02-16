<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Storage;
use DB;

class AdminProductController extends Controller
{
    use StorageImageTrait, DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }
    // index
    public function index()
    {
        $products = $this->product->latest()->paginate(5);//thêm latest thể xem sản phẩm vừa thêm lên đầu
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $htmlOption = $this->getCategory($parentId = ''); // Không cần truyền parentId
        return view('admin.product.add', compact('htmlOption'));
    }
    // dữ liệu chung
    public function getCategory($parentId = null)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption; 
    }

    //hình ảnh
    public function store(ProductAddRequest $request)
    {
        try {
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
            }

            $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
            $userId = $user->id; // Lấy ID của người dùng đã đăng nhập

            DB::beginTransaction();

            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => $userId, // Sử dụng $userId thay vì auth()->id()
                'category_id' => $request->category_id
            ];

            $dataUploadFeatureImage = $this->storageTraitUpLoad($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            // Thêm vào Product_image
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUpLoadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            // Thêm tag product
            $tagIds = [];
            if (!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagIds);

            DB::commit();

            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công.');
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' Line: ' .  $exception->getLine());
            return redirect()->route('product.create')->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    //edit update delete
    public function edit($id)
    {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id); // Không cần truyền parentId
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }
    public function update(Request $request, $id)
    {
        try {
            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
            }

            $user = auth()->user(); // Lấy thông tin người dùng đã đăng nhập
            $userId = $user->id; // Lấy ID của người dùng đã đăng nhập

            DB::beginTransaction();

            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => $userId, // Sử dụng $userId thay vì auth()->id()
                'category_id' => $request->category_id
            ];
            
            $dataUploadFeatureImage = $this->storageTraitUpLoad($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            //thêm vào Product_image
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUpLoadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }
    
            //thêm tag product
            $tagIds = [];
            if (!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
                
            }
            $product->tags()->sync($tagIds);
            
            DB::commit();

            return redirect()->route('product.index');
        } catch(\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . ' --- Line: ' .  $exception->getLine());
        }
        return redirect()->route('categories.index');
    }
    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->product); 
    }
}
