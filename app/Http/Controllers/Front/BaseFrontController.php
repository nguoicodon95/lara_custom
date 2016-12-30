<?php namespace App\Http\Controllers\Front;

use Acme;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Front\FrontFoundation\Cart;
use App\Models;

use Request;

abstract class BaseFrontController extends BaseController
{
    //To use cart functions, uncomment this line
    use Cart;

    protected $dis = [], $bodyClass = '';

    public function __construct()
    {
        parent::__construct();
        if ($this->_showConstructionMode()) {
            abort(503);
        }
        $this->_setMetaSEO();
        //To use cart functions, uncomment this line
        $this->_getCart();
        $this->_loadFrontMenu('', 'page');
        $this->_loadFrontMenu('', 'product-category', 'danh-muc-san-pham', null);
    }

    protected function _loadFrontMenu($menuActive = '', $type = 'custom-link', $menu_name = 'main-menu', $menu_class = "nav navbar-nav")
    {
        $menu = new Acme\CmsMenu();
        $menu->args = array(
            'menuName' => $menu_name,
            'menuClass' => $menu_class,
            'container' => '',
            'containerClass' => '',
            'containerId' => '',
            'containerTag' => 'ul',
            'childTag' => 'li',
            'itemHasChildrenClass' => '',
            'subMenuClass' => '',
            'menuActive' => [
                'type' => $type,
                'related_id' => $menuActive,
            ],
            'activeClass' => 'active current-menu-item',
            'isAdminMenu' => false,
        );
        view()->share(str_replace('-', '_',$menu_name), $menu->getNavMenu());
    }

    protected function _setPageTitle($title)
    {
        view()->share([
            'pageTitle' => $title,
        ]);
    }

    protected function _setCurrentEditLink($title, $link)
    {
        view()->share([
            'currentFrontEditLink' => [
                'title' => $title,
                'link' => '/' . $this->adminCpAccess . '/' . $link,
            ],
        ]);
    }

    /**
     * @param Models\Foundation\MetaFunctions $modelObject
     * @param int $rules: $contentId
     **/
    protected function _getAllCustomFields($modelObject, $contentId)
    {
        $this->dis['currentObjectCustomFields'] = $modelObject->getAllContentMeta($contentId);
    }

    protected function _setMetaSEO($keywords = null, $description = null, $image = null)
    {
        $data = [];
        if ($keywords) {
            $data['keywords'] = $keywords;
        } else {
            $data['keywords'] = $this->_getSetting('site_keywords');
        }
        if ($description) {
            $data['description'] = $description;
        } else {
            $data['description'] = $this->_getSetting('site_keywords');
        }
        if ($image) {
            $data['image'] = asset($image);
        } else {
            $data['image'] = asset($this->_getSetting('site_logo'));
        }
        view()->share([
            'metaSEO' => $data,
        ]);
    }
}
