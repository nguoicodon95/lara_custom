<?php namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCategoryMeta;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductCategoryController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'product-category';
    }

    public function _handle(Request $request, ProductCategory $object, ProductCategoryMeta $objectMeta)
    {
        $segments = $request->segments();
        $slug = end($segments);

        $item = $object->getBySlug($slug);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this product category', 'product-categories/edit/' . $item->id);

        $this->_loadFrontMenu($item->id, 'product-category');
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $getByFields['products.status'] = ['compare' => '=', 'value' => 1];
        $child = $item->child()->get();
        $products = $products_in_subcate = $product_in_cate = [];
        if(!empty($child)) {
            foreach($child as $sub_cate) {
                $products_in_subcate[] = Product::getNoContentByCategory($sub_cate->id, $getByFields, [], null, 0);
            }
        }
        $product_in_cate[] = Product::getNoContentByCategory($item->id, $getByFields, [], null, 0);
        $products = collect($products_in_subcate)->merge($product_in_cate);
        foreach($products as $product) {
            foreach($product->sortByDesc('id') as $p) {
                $ps[] = $p;
            }
        }
        $all_product = _unique_multidim_array($ps, 'id');
        // $this->dis['all_product'] = $all_product;

        /*Create pagination*/
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $total = new Collection($all_product);
        $perPage = 20;
        $currentPageSearchResults = $total->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $this->dis['all_product'] = new LengthAwarePaginator($currentPageSearchResults, count($total), $perPage);

        /* RETURN ĐATA */
        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->content_id);

        return $this->_showItem($item);
    }

    private function _showItem($item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_productCategory_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(ProductCategory $object)
    {
        $this->_setBodyClass($this->bodyClass . ' product-category-default');

        return $this->_viewFront('product-category-templates.default', $this->dis);
    }
}
