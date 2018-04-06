<?php

namespace App\Http\Controllers\Cabinet\Goods;

use App\Goods;
use App\GoodsGallery;
use App\HintList;
use App\Plugins\FileManager;
use Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\Common\Goods\GoodsController as BaseGoodsController;
use App\Http\Requests;
use Mockery\CountValidator\Exception;
use App\Plugins\Pagination;
use Response;

class GoodsController extends BaseGoodsController
{

    const FULL_LIST_CODE = 'full_list';
    const ON_SALE_LIST_CODE = 'on_sale_list';
    const DRAFT_LIST_CODE = 'draft_list';
    const DELETED_LIST_CODE = 'deleted_list';

    private $perPage = 30;

    /**
     * View the page with full list of goods.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fullList()
    {
        $builder = Auth::user()->goods()->all();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $goods = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $fullListActive = $goodsListActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.full_list', compact('goods', 'fullListActive', 'goodsListActive', 'paginationBlock'));
    }

    /**
     * View the page with list of goods on sale.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function onSaleList()
    {
        $builder = Auth::user()->goods()->onSale();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $goods = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $fullListActive = $goodsListActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.on_sale_list', compact('goods', 'fullListActive', 'goodsListActive', 'paginationBlock'));
    }

    /**
     * View the page with draft list of goods.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function draftList()
    {
        $builder = Auth::user()->goods()->draft();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $goods = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $fullListActive = $goodsListActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.draft_list', compact('goods', 'fullListActive', 'goodsListActive', 'paginationBlock'));
    }

    /**
     * View the page with list of deleted goods.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deletedList()
    {
        $builder = Auth::user()->goods()->deleted();
        $pagination = new Pagination(clone $builder->getQuery(), 1, $this->perPage);
        $goods = $builder->orderBy('created_at', 'desc')->pagination(1, $this->perPage)->get();
        $fullListActive = $goodsListActive = true;
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return view('cabinet.goods.deleted_list', compact('goods', 'fullListActive', 'goodsListActive', 'paginationBlock'));
    }

    public function pagination(Request $request)
    {
        $builder = $this->getDataForList($request->listCode);
        $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
        $goods = $builder->orderBy('created_at', 'desc')->pagination($pagination->getPage(), $this->perPage)->get();
        $paginationBlock = $pagination->view($this->paginationAction)->render();

        return Response::json([
            'view' => view('cabinet.goods.partials.' . $request->listCode, compact('goods'))->render(),
            'pagination' => $paginationBlock
        ]);
    }

    /**
     * Activate the goods and view the partial (list).
     *
     * @param Request $request
     * @param Goods $goods
     * @return \Illuminate\Contracts\Routing\ResponseFactory|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\View\View|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function activateAndViewPartials(Request $request, Goods $goods)
    {
        if ($this->activate($goods)) {
            $builder = $this->getDataForList($request->listCode);
            $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
            $goods = $builder->orderBy('created_at', 'desc')
                ->pagination(1, $pagination->getPage() * $this->perPage)
                ->get();
            $paginationBlock = $pagination->view($this->paginationAction)->render();

            return Response::json([
                'view' => view('cabinet.goods.partials.' . $request->listCode, compact('goods'))->render(),
                'pagination' => $paginationBlock
            ]);
        }

        return response(['status' => 'failed', 'message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Disactivate the goods and view the partial (list).
     *
     * @param Request $request
     * @param Goods $goods
     * @return \Illuminate\Contracts\Routing\ResponseFactory|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\View\View|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function disactivateAndViewPartials(Request $request, Goods $goods)
    {
        if ($this->disactivate($goods)) {
            $builder = $this->getDataForList($request->listCode);
            $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
            $goods = $builder->orderBy('created_at', 'desc')
                ->pagination(1, $pagination->getPage() * $this->perPage)
                ->get();
            $paginationBlock = $pagination->view($this->paginationAction)->render();

            return Response::json([
                'view' => view('cabinet.goods.partials.' . $request->listCode, compact('goods'))->render(),
                'pagination' => $paginationBlock
            ]);
        }

        return response(['status' => 'failed', 'message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Destroy the goods and view the partial (list).
     *
     * @param Request $request
     * @param Goods $goods
     * @return \IlluminateContracts\Routing\ResponseFactory|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\View\View|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function destroyAndViewPartials(Request $request, Goods $goods)
    {
        if ($this->destroy($goods)) {
            $builder = $this->getDataForList($request->listCode);
            $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
            $goods = $builder->orderBy('created_at', 'desc')
                ->pagination(1, $pagination->getPage() * $this->perPage)
                ->get();
            $paginationBlock = $pagination->view($this->paginationAction)->render();

            return Response::json([
                'view' => view('cabinet.goods.partials.' . $request->listCode, compact('goods'))->render(),
                'pagination' => $paginationBlock
            ]);
        }

        return response(['status' => 'failed', 'message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Restore the goods and view the partial (list).
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|
     *         \Illuminate\Contracts\View\Factory|
     *         \Illuminate\View\View|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function restoreAndViewPartials(Request $request, $id)
    {
        if ($this->restore($id)) {
            $builder = $this->getDataForList($request->listCode);
            $pagination = new Pagination(clone $builder->getQuery(), $request->page, $this->perPage);
            $goods = $builder->orderBy('created_at', 'desc')
                ->pagination(1, $pagination->getPage() * $this->perPage)
                ->get();
            $paginationBlock = $pagination->view($this->paginationAction)->render();

            return Response::json([
                'view' => view('cabinet.goods.partials.' . $request->listCode, compact('goods'))->render(),
                'pagination' => $paginationBlock
            ]);
        }

        return response(['status' => 'failed', 'message' => 'Произошла необратимая ошибка'], 500);
    }

    /**
     * Get the data of goods for one of lists.
     *
     * @param $listCode
     * @return mixed
     * @throws \Mockery\CountValidator\Exception
     */
    public function getDataForList($listCode)
    {
        switch ($listCode) {
            case self::FULL_LIST_CODE :
                $builder = Auth::user()->goods()->all();
                break;

            case self::ON_SALE_LIST_CODE :
                $builder = Auth::user()->goods()->onSale();
                break;

            case self::DRAFT_LIST_CODE :
                $builder = Auth::user()->goods()->draft();
                break;

            case self::DELETED_LIST_CODE :
                $builder = Auth::user()->goods()->deleted();
                break;

            default :
                throw new Exception('No such code for lists as ' . $listCode);
        }

        return $builder;
    }

    /**
     * Get either product's region id if it's not null or
     * user's region id if it's null or
     * default value if user's region id is null.
     *
     * @param Goods $goods
     * @return mixed
     */
    public function getCurrentRegionId(Goods $goods)
    {
        return $goods->region_id ?:
            (Auth::user()->address ?
                Auth::user()->address->region_id :
                HintList::getDefaultLocation('region'));
    }

    /**
     * Get either product's city id if it's not null or
     * user's city id if it's null or
     * default value if user's city id is null.
     *
     * @param Goods $goods
     * @return mixed
     */
    public function getCurrentCityId(Goods $goods)
    {
        return $goods->city_id ?:
            (Auth::user()->address ?
                Auth::user()->address->city_id :
                HintList::getDefaultLocation('city'));
    }

    /**
     * Get either product's address if it's not null or
     * user's address if it's null or
     * null
     *
     * @param Goods $goods
     * @return null
     */
    public function getCurrentAddress(Goods $goods)
    {
        return $goods->address ?: (Auth::user()->address ? Auth::user()->address->address : null);
    }

    public function getGoodsGallery(Goods $goods)
    {
        $gallery = $goods->gallery;
        if (count($gallery)) {
            foreach ($gallery as $galleryItem) {
                $preview[] = FileManager::getFileName($galleryItem->filename, $goods->imagesDir);
                $previewConfig[] = ['url' => route('goodsGallery.delete', ['goods' => $goods->id]), 'key' => $galleryItem->filename];
            }
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteGallery(Goods $goods, Request $request)
    {
        FileManager::deleteFile($request->key, $goods->imagesDir);
        GoodsGallery::where('filename', $request->key)->where('goods_id', $goods->id)->delete();

        return $this->getGoodsGallery($goods);
    }

    public function getGoodsImage(Goods $goods)
    {
        if ($goods->getFullImagePathEmpty()) {
            $preview[] = $goods->getFullImagePathEmpty();
            $previewConfig[] = ['url' => route('goodsImage.delete', ['goods' => $goods->id]), 'key' => $goods->image];
        }

        return json_encode([isset($preview) ? $preview : [], isset($previewConfig) ? $previewConfig : []]);
    }

    public function deleteImage(Goods $goods, Request $request)
    {
        $goods->image = null;
        $goods->save();

        return $this->getGoodsImage($goods);
    }

}
