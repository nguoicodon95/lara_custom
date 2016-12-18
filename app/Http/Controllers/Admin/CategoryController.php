<?php

namespace App\Http\Controllers\Admin;

use Acme;
use App\Http\Controllers\Admin\AdminFoundation\CategoryWithSubText;
use App\Http\Controllers\Admin\AdminFoundation\CustomFields;
use App\Models;
use App\Models\Category;
use App\Models\CategoryMeta;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class CategoryController extends BaseAdminController
{
    use CategoryWithSubText;
    use CustomFields;

    public $bodyClass = 'category-controller', $routeLink = 'categories', $routeEditPostLink = 'posts';
    public function __construct()
    {
        parent::__construct();

        $this->_setPageTitle('Categories', 'manage categories for post');
        $this->_setBodyClass($this->bodyClass);

        $this->_loadAdminMenu($this->routeLink);
    }

    public function getIndex(Request $request, Category $object)
    {
        $this->_setBodyClass($this->bodyClass . ' categories-list-page');

        return $this->_viewAdmin('categories.index');
    }

    public function postIndex(Request $request, Category $object)
    {
        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];

        /*Group actions*/
        if ($request->get('customActionType', null) == 'group_action') {
            \DB::beginTransaction();

            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Group action did not completed. Some error occurred.";
            $ids = (array) $request->get('id', []);
            $result = $object->updateMultiple($ids, [
                'status' => $request->get('customActionValue', 0),
            ], true);
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Group action has been completed.";
                \DB::commit();
            } else {
                \DB::rollBack();
            }
        }

        /*
         * Sortable data
         */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:
                {
                    $orderBy = 'id';
                }
                break;
            case 2:
                {
                    $orderBy = 'title';
                }
                break;
            case 3:
                {
                    $orderBy = 'page_template';
                }
                break;
            case 4:
                {
                    $orderBy = 'status';
                }
                break;
            case 5:
                {
                    $orderBy = 'order';
                }
                break;
            default:
                {
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('global_title', null) != null) {
            $getByFields['global_title'] = ['compare' => 'LIKE', 'value' => $request->get('global_title')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $this->_recursiveGetCategoriesDataTable($this->_recursiveGetCategories($object, 0, $orderBy, $orderType), 0, $this->routeLink);

        $iTotalRecords = $object->count();

        $sEcho = intval($request->get('sEcho'));

        $records["data"] = $items;

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function postFastEdit(Request $request, Category $object)
    {
        $data = [
            'id' => $request->get('args_0', null),
            'title' => $request->get('args_1', null),
            'order' => $request->get('args_2', null),
        ];

        $result = $object->fastEdit($data, false, true);
        return response()->json($result, $result['response_code']);
    }

    public function getViewPosts(Request $request, Category $object, Post $postObject, $id)
    {
        $item = $object->find($id);
        /*No page with this id*/
        if (!$item) {
            $this->_setFlashMessage('Danh mục không tồn tại.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }
        $this->dis['object'] = $item;
        $this->_setBodyClass($this->bodyClass . ' categories-related-posts-page');
        return $this->_viewAdmin('categories.related-posts', $this->dis);
    }

    public function postViewPosts(Request $request, Category $object, Post $postObject, $id)
    {
        $item = $object->find($id);
        /*No page with this id*/
        if (!$item) {
            $this->_setFlashMessage('Danh mục không tồn tại.', 'error');
            $this->_showFlashMessages();
            return redirect()->back();
        }

        /**
         * Paging
         **/
        $offset = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $paged = ($offset + $limit) / $limit;
        Paginator::currentPageResolver(function () use ($paged) {
            return $paged;
        });

        $records = [];
        $records["data"] = [];

        /*Group actions*/
        if ($request->get('customActionType', null) == 'group_action') {
            $records["customActionStatus"] = "danger";
            $records["customActionMessage"] = "Hành động nhóm đã không hoàn thành. xảy ra một số lỗi.";
            $ids = (array) $request->get('id', []);
            $customActionValue = $request->get('customActionValue', 0);
            switch ($customActionValue) {
                case 'set_as_popular':{
                        $result = $postObject->updateMultiple($ids, [
                            'is_popular' => 1,
                        ], true);
                    }break;
                case 'unset_as_popular':{
                        $result = $postObject->updateMultiple($ids, [
                            'is_popular' => 0,
                        ], true);
                    }break;
                default:{
                        $result = $postObject->updateMultiple($ids, [
                            'status' => $customActionValue,
                        ], true);
                    }break;
            }
            if (!$result['error']) {
                $records["customActionStatus"] = "success";
                $records["customActionMessage"] = "Hành động nhóm đã hoàn thành.";
            }
        }

        /*
         * Sortable data
         */
        $orderBy = $request->get('order')[0]['column'];
        switch ($orderBy) {
            case 1:{
                    $orderBy = 'id';
                }
                break;
            case 2:{
                    $orderBy = 'title';
                }
                break;
            case 3:{
                    $orderBy = 'status';
                }
                break;
            case 4:{
                    $orderBy = 'order';
                }
                break;
            case 5:{
                    $orderBy = 'created_by';
                }
                break;
            default:{
                    $orderBy = 'created_at';
                }
                break;
        }
        $orderType = $request->get('order')[0]['dir'];

        $getByFields = [];
        if ($request->get('global_title', null) != null) {
            $getByFields['title'] = ['compare' => 'LIKE', 'value' => $request->get('global_title')];
        }
        if ($request->get('status', null) != null) {
            $getByFields['status'] = ['compare' => '=', 'value' => $request->get('status')];
        }

        $items = $postObject->getNoContentByCategory($id, $getByFields, [$orderBy => $orderType], ['posts.*'], $limit);
        $iTotalRecords = $items->total();

        $sEcho = intval($request->get('sEcho'));

        foreach ($items as $key => $row) {
            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }
            $popular = '';
            if ($row->is_popular != 0) {
                $popular = '<span class="label label-success label-sm">Popular</span>';
            }

            /*Edit link*/
            $link = asset($this->adminCpAccess . '/' . $this->routeEditPostLink . '/edit/' . $row->id);
            $removeLink = asset($this->adminCpAccess . '/' . $this->routeEditPostLink . '/delete/' . $row->id);

            $records["data"][] = array(
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                $row->title,
                $status,
                $row->order,
                $popular,
                $row->created_at->toDateTimeString(),
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>' .
                '<button type="button" data-ajax="' . $removeLink . '" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>',
            );
        }

        $records["sEcho"] = $sEcho;
        $records["iTotalRecords"] = $iTotalRecords;
        $records["iTotalDisplayRecords"] = $iTotalRecords;

        return response()->json($records);
    }

    public function getEdit(Request $request, Category $object, $id)
    {
        if(!$id) {
            $this->_setPageTitle('Create category');
            $oldInputs = old();
            if ($oldInputs) {
                $oldObject = new \stdClass();
                foreach ($oldInputs as $key => $row) {
                    $oldObject->$key = $row;
                }
                $this->dis['object'] = $oldObject;
            }
        }

        if (!$id == 0) {
            $item = $object->find($id);
            /*No page with this id*/
            if (!$item) {
                $this->_setFlashMessage('Item not exists.', 'error');
                $this->_showFlashMessages();
                return redirect()->back();
            }
            $item = $object->getById($id, [
                'global_status' => null,
            ]);
            /*Create new if not exists*/
            if (!$item) {
                $item = new Category;
                $item->created_by = $this->loggedInAdminUser->id;
                $item->id = $id;
                $item->save();
                $item = $object->getById($id, $language, [
                    'global_status' => null,
                ]);
            }
            $this->dis['object'] = $item;
            $this->_setPageTitle('Edit category', $item->title);

            $args = array(
                'user_type' => $this->loggedInAdminUser->adminUserRole->id,
                'category_id' => $id,
                'category_template' => $item->page_template,
                'user' => $this->loggedInAdminUser->id,
                'model_name' => 'Category',
            );
            $customFieldBoxes = new Acme\CmsCustomField();
            $customFieldBoxes = $customFieldBoxes->getCustomFieldsBoxes($item->content_id, $args, 'category');
            $this->dis['customFieldBoxes'] = $customFieldBoxes;

            $categories = $this->_recursiveGetCategoriesSelectSrc($object, 0, 'title', 'asc', 0, $item->parent_id, [$id]);
        } else {
            $categories = $this->_recursiveGetCategoriesSelectSrc($object, 0, 'title', 'asc', 0, 0, []);
        }

        $this->dis['categoriesHtmlSrc'] = $categories;

        return $this->_viewAdmin('categories.edit', $this->dis);
    }

    public function postEdit(Request $request, Category $object, CategoryMeta $objectMeta, $id)
    {
        $data = $request->all();
        if (!$data['slug']) {
            $data['slug'] = str_slug($data['title']);
        }
        \DB::beginTransaction();

        if ($id == 0) {
            $data['created_by'] = $this->loggedInAdminUser->id;
            $result = $object->createItem($data);
        } else {
            $result = $object->updateItemContent($id, $data);
        }

        if ($result['error']) {
            \DB::rollBack();
            $this->_setFlashMessage($result['message'], 'error');
            $this->_showFlashMessages();

            if ($id == 0) {
                return redirect()->back()->withInput();
            }

            return redirect()->back();
        }

        \DB::commit();

        $this->_setFlashMessage($result['message'], 'success');
        $this->_showFlashMessages();

        /*Save completed*/
        $customFields = json_decode($request->get('custom_fields'));
        $this->_saveContentMeta($result['object']->id, $customFields, $objectMeta);

        if ($id == 0 && !$result['error']) {
            return redirect()->to(asset($this->adminCpAccess . '/' . $this->routeLink . '/edit/' . $result['object']->id));
        }
        return redirect()->back();
    }

    public function deleteDelete(Request $request, Category $object, $id)
    {
        $result = $object->deleteItem($id);
        return response()->json($result, $result['response_code']);
    }
}