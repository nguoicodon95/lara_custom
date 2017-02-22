<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductContent;
use App\Models\Page;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends BaseFrontController
{
    public function searchlable (Request $request) {
        $q = $request->q;
        if(!$q) return redirect('/');
        $this->dis['products'] = ProductContent::SearchByKeyword($q)->get();
        $this->dis['posts'] = Post::SearchByKeyword($q)->get();
        return $this->_viewFront('search.index', $this->dis);
    }
}
