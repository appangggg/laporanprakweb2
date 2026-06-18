<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; // <--- BARIS INI YANG WAJIB DITAMBAHKAN
use App\Models\Item; // <--- Tambahkan ini juga jika belum ada
use App\Http\Controllers\Api\BaseController; // Sesuaikan jika kamu pakai BaseController
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use Exception;

class ItemController extends BaseController {
    protected ItemService $svc;

    public function __construct(ItemService $svc){
        $this->svc = $svc;
    }

   public function index (Request $request) {
    // Memuat Item beserta relasi category-nya
    $query = Item::with('category'); 

    // ini adalah Logika filter: Jika ada parameter category_id di request
    if ($request->filled('category_id')) { 
        $query->where('category_id', $request->category_id); 
    } 

    // Mengembalikan response sukses
    return $this->success($query->get()); 
}
    public function store(StoreItemRequest $req){
        $item = $this->svc->create($req->validated());
        return $this->success($item, "Item dibuat", 201);
    }

    public function show($id) {
        try {
            $item = $this->svc->find($id);
            return $this->success($item);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 404);
        }
    }

    public function update(UpdateItemRequest $req, $id) {
        $item = $this->svc->update($id, $req->validated());
        return $this->success($item, "Item diperbarui");
    }

    public function destroy($id) {
        $this->svc->delete($id);
        return $this->success(null, "Item dihapus", 204);
    }
}