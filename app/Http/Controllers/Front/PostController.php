<?php namespace App\Http\Controllers\Front;

use App\Models\Post;
use App\Models\PostMeta;
use Illuminate\Http\Request;

class PostController extends BaseFrontController
{
    public function __construct()
    {
        $this->showSidebar = true;

        parent::__construct();
        $this->bodyClass = 'post';
    }

    public function _handle(Request $request, Post $object, PostMeta $objectMeta, $slug)
    {
        $item = $object->getBySlug($slug);

        if (!$item) {
            return $this->_showErrorPage(404, 'Page not found');
        }

        $this->_setCurrentEditLink('Edit this post', 'posts/edit/' . $item->id );

        $relatedCategoryIds = $item->category()->getRelatedIds();

        if($relatedCategoryIds) {
            $relatedCategoryIds = $relatedCategoryIds->toArray();
        }

        $this->_loadFrontMenu($relatedCategoryIds, 'category');

        $this->_setPageTitle($item->title);
        $this->_setMetaSEO($item->tags, $item->description, $item->thumbnail);

        $this->dis['object'] = $item;

        $getByFields['posts.status'] = ['compare' => '=', 'value' => 1];
        $getByFields['posts.id'] = ['compare' => '!=', 'value' => $item->id];
        $post_in_category = [];
        foreach ($relatedCategoryIds as $k => $v) {
            $post_in_category[] = $item->getNoContentByCategory($v, $getByFields, ['posts.id' => 'desc'], ['posts.*'], 0);
        }
        $post_same_category = collect($post_in_category)->collapse();

        $this->dis['post_same_category'] = _unique_multidim_array($post_same_category, 'id');

        $this->_getAllCustomFields($objectMeta, $item->content_id);

        return $this->_showItem($item);
    }

    private function _showItem(Post $item)
    {
        $page_template = $item->page_template;
        if (trim($page_template) != '') {
            $function = '_post_' . str_replace(' ', '', trim($page_template));
            if (method_exists($this, $function)) {
                return $this->{$function}($item);
            }
        }
        return $this->_defaultItem($item);
    }

    private function _defaultItem(Post $object)
    {
        $this->_setBodyClass($this->bodyClass . ' post-default');
        return $this->_viewFront('post-templates.default', $this->dis);
    }
}
