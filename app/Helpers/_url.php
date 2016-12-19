<?php

if (!function_exists('_getPageLink')) {
    function _getPageLink($page)
    {
        if (!is_string($page)) {
            $page = $page->slug;
        }

        return '/' . $page;
    }
}

if (!function_exists('_getPostLink')) {
    function _getPostLink($post)
    {
        if (!is_string($post)) {
            $post = $post->slug;
        }

        return '/' . trans('url.post') . '/' . $post;
    }
}

if (!function_exists('_getProductLink')) {
    function _getProductLink($slug)
    {
        return route('product.link', $slug);
    }
}

if (!function_exists('_getCategoryLink')) {
    function _getCategoryLink($slug)
    {
        return route('category.link', $slug);
    }
}

if (!function_exists('_getProductCategoryLink')) {
    function _getProductCategoryLink($category)
    {
        if (!is_string($category)) {
            $category = $category->slug;
        }

        return '/' . trans('url.productCategory') . '/' . $category;
    }
}

/*Category link with parent slugs*/
if (!function_exists('_getCategorySlugs')) {
    function _getCategorySlugs($type, $categoryId, $currentLanguageId = null)
    {
        $slug = '';
        switch ($type) {
            case 'productCategory': {
                $category = \App\Models\ProductCategory::getById($categoryId, $currentLanguageId, [], [
                    'product_categories.parent_id',
                    'product_category_contents.slug',
                ]);
            }
                break;
            default: {
                $category = \App\Models\Category::getById($categoryId, $currentLanguageId, [], [
                    'categories.parent_id',
                    'category_contents.slug',
                ]);
            }
                break;
        }
        if ($category) {
            $slug = $category->slug;
            $parentId = $category->parent_id;
            if ($parentId) {
                $parentSlug = _getCategorySlugs($type, $parentId);
                $slug = $parentSlug . '/' . $slug;
            }
        }
        return $slug;
    }
}

if (!function_exists('_getCategoryLinkWithParentSlugs')) {
    function _getCategoryLinkWithParentSlugs($categoryId)
    {
        return '/' . trans('url.category') . '/' . _getCategorySlugs('category', $categoryId);
    }
}

if (!function_exists('_getProductCategoryLinkWithParentSlugs')) {
    function _getProductCategoryLinkWithParentSlugs($categoryId)
    {
        $currentLanguageId = \App\Models\Language::getBy(['language_code' => $currentLanguageCode], null, false, 0, ['id']);
       
        return '/' . trans('url.productCategory') . '/' . _getCategorySlugs('productCategory', $categoryId, $currentLanguageId->id);
    }
}

/*CART*/
if (!function_exists('_getAddToCartLink')) {
    function _getAddToCartLink($productContentId, $quantity = 1)
    {
        return '/' .  '/cart/add-to-cart/' . $productContentId . '/' . $quantity;
    }
}