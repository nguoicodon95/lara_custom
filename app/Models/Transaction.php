<?php

namespace App\Models;

use \Carbon\Carbon;
use App\Models\AbstractModel;

class Transaction extends AbstractModel
{

    protected $table = 'transactions';
    protected $editableFields = [
      'name',
      'email',
      'phone',
      'address',
      'messages',
      'amount',
      'status',
      'note',
      'viewed'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'transaction_id');
    }

    public function updateItem($id, $data, $justUpdateSomeFields = true)
    {
        $data['id'] = $id;
        $result = $this->fastEdit($data, true, $justUpdateSomeFields);
        return $result;
    }

    public function updateItemContent($id, $data)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Xảy ra một số lỗi!',
        ];

        $trans = static::find($id);
        if (!$trans) {
            $result['message'] = 'Không tìm thấy giao dịch nào.';
            $result['response_code'] = 404;
            return $result;
        }

        $data['id'] = $id;

        return $trans->fastEdit($data, false, true);
    }

    public static function deleteItem($id)
    {
        $result = [
            'error' => true,
            'response_code' => 500,
            'message' => 'Xảy ra một số lỗi!',
        ];
        $object = static::find($id);

        if (!$object) {
            $result['message'] = 'Không tìm thấy giao dịch nào.';
            return $result;
        }

        $related = $object;
        if (!count($related)) {
            $related = null;
        }

        if ($object->delete()) {
            $result['error'] = false;
            $result['response_code'] = 200;
            $result['message'] = ['Đã xóa giao dịch!'];
        }

        return $result;
    }

    public function createItem($data)
    {
        $resultCreateItem = $this->updateItem(0, $data);

        /*No error*/
        if (!$resultCreateItem['error']) {
            $post_id = $resultCreateItem['object']->id;
            $resultUpdateItemContent = $this->updateItemContent($post_id, $data);
            if ($resultUpdateItemContent['error']) {
                $this->deleteItem($resultCreateItem['object']->id);
            }
            return $resultUpdateItemContent;
        }
        return $resultCreateItem;
    }

    public static function getById($id, $options = [], $select = [])
    {
        return static::where('id', '=', $id)->with('orders')->first();
    }

    public static function getByCategory($id, $otherFields = [], $order = null, $select = null, $perPage = 0)
    {
        $items = Product::join('product_contents', 'products.id', '=', 'product_contents.product_id')
            ->join('product_categories_products', 'product_categories_products.product_id', '=', 'products.id')
            ->join('product_categories', 'product_categories.id', '=', 'product_categories_products.category_id')
            ->groupBy('products.id')
            ->where([
                'product_categories.id' => $id
            ]);
        foreach ($otherFields as $key => $row) {
            $items = $items->where(function ($q) use ($key, $row) {
                switch ($row['compare']) {
                    case 'LIKE':{
                            $q->where($key, $row['compare'], '%' . $row['value'] . '%');
                        }break;
                    case 'IN':{
                            $q->whereIn($key, (array) $row['value']);
                        }break;
                    case 'NOT_IN':{
                            $q->whereNotIn($key, (array) $row['value']);
                        }break;
                    default:{
                            $q->where($key, $row['compare'], $row['value']);
                        }break;
                }
            });
        }
        if ($order && is_array($order)) {
            foreach ($order as $key => $value) {
                $items = $items->orderBy($key, $value);
            }
        }
        if ($order == 'random') {
            $items = $items->orderBy(\DB::raw('RAND()'));
        }

        if ($select && sizeof($select) > 0) {
            $items = $items->select($select);
        }
        if ($perPage > 0) {
            return $items->paginate($perPage);
        }

        return $items->get();
    }
}
