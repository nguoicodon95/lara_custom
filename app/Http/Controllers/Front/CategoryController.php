<?php namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\CategoryMeta;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryController extends BaseFrontController
{
    public function __construct()
    {
        parent::__construct();
        $this->bodyClass = 'category';
        $this->dis['show_blog'] = false;
    }

    public function _handle(Request $request, Category $object, CategoryMeta $objectMeta)
    {
        $segments = $request->segments();
        $slug = end($segments);
        $item = $object->getBySlug($slug);

        $getByFields_pr['is_popular'] = ['compare' => '=', 'value' => 1];
        $getByFields_pr['status'] = ['compare' => '=', 'value' => 1];
        $popular_pr = Product::searchBy($getByFields_pr, ['id' => 'desc'], true, 5);
        $pr_ar = [];
        foreach($popular_pr as $row) {
            $pr_ar[] = [
                'title' => $row->productContent->title,
                'slug' => $row->productContent->slug,
                'description' => $row->productContent->description,
                'thumbnail' => $row->productContent->thumbnail,
                'price' => $row->productContent->price,
                'old_price' => $row->productContent->old_price,
            ];
        }

        $this->dis['pr_popular'] = $pr_ar;


        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this category', 'categories/edit/' . $item->id . '/');

        $this->_loadFrontMenu($item->id, 'category');
        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        /* GET POSTS IN CATEGORY WHERE STATUS ACTIVE */
        $getByFields['posts.status'] = ['compare' => '=', 'value' => 1];
        $relatedPosts = Post::getNoContentByCategory($item->id, $getByFields, ['id' => 'desc'], ['posts.*'], 0);
        // $this->dis['relatedPosts'] = $relatedPosts;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $total = new Collection($relatedPosts);
        $perPage = 12;
        $currentPageSearchResults = $total->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $this->dis['relatedPosts'] = new LengthAwarePaginator($currentPageSearchResults, count($total), $perPage);

        $this->dis['object'] = $item;
        $this->_getAllCustomFields($objectMeta, $item->content_id);

        return $this->_showItem($item);
    }

    private function _showItem(Category $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_category_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Category $object)
    {
        $this->_setBodyClass($this->bodyClass . ' category-default');
        return $this->_viewFront('category-templates.default', $this->dis);
    }
}
