<?php

namespace App\Http\Controllers\Routes\Cabinet;

use Auth;
use Validator;

use App\Traits\Profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\HintList;
use Mockery\CountValidator\Exception;

class ProfileRouteController extends Controller
{

    /**
     * An instanse of suitable controller.
     *
     * @var \App\Http\Controllers\Cabinet\Entity\ProfileController|
     *      \App\Http\Controllers\Cabinet\Individual\ProfileController
     */
    protected $controller;

    /**
     * Constructor. Set instanse of suitable controller.
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->controller = $this->getController();
    }

    /**
     * Get instanse of suitable controller.
     *
     * @return \App\Http\Controllers\Cabinet\Entity\ProfileController|\App\Http\Controllers\Cabinet\Individual\ProfileController
     * @throws \Mockery\CountValidator\Exception
     */
    public function getController()
    {
        switch (Auth::user()->type) {

            case HintList::getUserTypeByCode('individual') :
                return new \App\Http\Controllers\Cabinet\Individual\ProfileController($this->request);

            case HintList::getUserTypeByCode('entity') :
                return new \App\Http\Controllers\Cabinet\Entity\ProfileController($this->request);

            default :
                return null;

        }
    }

    public function index()
    {
        return $this->controller->index();
    }

    /**
     * Route index method.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return $this->controller->profile();
    }

    /**
     * Route update method.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        return $this->controller->update($request);
    }

}
