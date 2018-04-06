<?php

namespace App\Http\Controllers;

use App\HelpCategory;
use App\HelpPage;
use App\Http\Controllers\Common\Goods\GoodsController as BaseGoodsController;
use App\Page;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    protected function getMenu($category = null, $slug = null){
        $cats = HelpCategory::where(['active' => true])->get()->toArray();
        $elements = HelpPage::where(['active' => true])->get()->toArray();
        $data = [];

        foreach ($cats as $key => $cat){
            if ($category == $cat['slug']){
                $data[$key]['select'] = true;
            }
            $data[$key]['elements'] = [];
            foreach ($elements as $num => $element){
                if ($element['pid'] == $cat['id']){
                    $tmp = [];
                    if ($slug == $element['slug']){
                        $tmp['select'] = true;
                    }
                    $tmp = array_merge($tmp, $element);
                    array_push($data[$key]['elements'], $tmp);
                    unset($elements[$num]);
                }
            }

        }
        return $data;
    }

    /**
     * Show the help page.
     *
     * @param Request $request
     * @param string $category
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, $category = null, $slug = null)
    {
        $data = $this->getMenu($category, $slug);
        dd($data);
        /*if ($category){
            $data = HelpCategory::bySlug($category)->first();
        }*/
        return view('pages', compact('data'));
    }

    public function page(Request $request, $slug)
    {

    }
}
