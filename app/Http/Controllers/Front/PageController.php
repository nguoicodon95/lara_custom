<?php namespace App\Http\Controllers\Front;

use App\Models;
use App\Models\Page;
use App\Models\PageMeta;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PageController extends BaseFrontController
{
    private $_setVariableHome = [ 'home', 'homepage', 'home-page', 'trang-chu' ];
    
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'page';
    }

    public function index(Request $request, Page $object, PageMeta $objectMeta)
    {
        $item = $object->getById($this->_getSetting('default_homepage'));
        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }
        if(in_array($item->slug, $this->_setVariableHome)) {
            $this->_loadFrontMenu($item->id, 'page');
            $this->_loadFrontMenu($item->id, 'product-category', 'danh-muc-san-pham', null);
            $this->_getAllCustomFields($objectMeta, $item->id, 'page');
            return $this->_page_Homepage($item);
        }
        
        // return redirect()->to($item->slug);
    }

    public function _handle(Request $request, Page $object, PageMeta $objectMeta, $slug)
    {
        $item = $object->getBySlug($slug);
        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this page', 'pages/edit/' . $item->id);

        $this->_loadFrontMenu($item->id, 'page');
        $this->_loadFrontMenu($item->id, 'product-category', 'danh-muc-san-pham', null);
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->id, 'page');
        // dd($this->dis['currentObjectCustomFields']);
        
        return $this->_showItem($item);
    }

    private function _showItem(Page $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_page_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-default');
        return $this->_viewFront('page-templates.default', $this->dis);
    }

    /* Template Name: Homepage*/
    private function _page_Homepage(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-homepage');

        $slideshows = json_decode($this->dis['currentObjectCustomFields']['25_slideshow']);
        $slider = [];
        foreach($slideshows as $s) {
            $slider[] = [
                'image' => $s[0]->field_value,
                'link' => $s[1]->field_value
            ] ;
        }
        $this->dis['slideshow'] = $slider;

        /* Get catalog product */

        $product_category = Models\ProductCategory::where('order', '>', 0)->get();
        $pushItem = [];
        
        $offset = 0;
        $limit = 3;
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });
        foreach($product_category as $_getProduct) {
            $getByFields['is_popular'] = ['compare' => '=', 'value' => 1];
            $product = Models\Product::getNoContentByCategory($_getProduct->id, $getByFields, [], ['products.*'], $limit);
            foreach($product as $p) {
                $row = $p->productContent[0];
                $pushItem[$_getProduct->title][] = [
                    'id' => $row->product_id,
                    'product_content_id' => $row->id,
                    'title' => $row->title,
                    'slug' => $row->slug,
                    'status' => $row->status,
                    'thumbnail' => $row->thumbnail,
                    'tags' => $row->tags,
                    'price' => $row->price,
                    'old_price' => $row->old_price,
                    'sku' => $row->product->sku,
                ];
            }
            $pushItem[$_getProduct->title]['slug'] = $_getProduct->slug;
        }
        $this->dis['groups'] =  $pushItem;

        $new_product = Models\Product::getAll(null, ['id' => 'DESC'], 3 );
        $this->dis['new_product'] = (object) $new_product;
        return $this->_viewFront('page-templates.homepage', $this->dis);
    }

    /* Template Name: Contact Us*/
    private function _page_ContactUs(Page $object)
    {
        $this->_setBodyClass($this->bodyClass . ' page-contact');
        return $this->_viewFront('page-templates.contact-us', $this->dis);
    }
}
