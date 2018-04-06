<?php

namespace App\Http\Controllers\Cabinet;

use App\Dialog;
use App\Goods;
use App\Http\Controllers\Controller;
use Auth;
use Validator;

use App\User;

use Illuminate\Http\Request;

class DialogController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->type === User::INDIVIDUAL_TYPE) {
            $individual = true;

            $dialogs = Dialog::with(['good' => function($query){
                    $query->select(['name', 'id'])->get();
                }, 'entity' => function($query){
                    $query->with('company')->select(['id', 'login', 'image'])->get();
                }])
                ->where(['individual_id' => $user->id, 'is_individual_deleted' => false])
                ->orderBy('updated_at', 'asc')
                ->get();
        } else {
            $individual = false;

            $dialogs = Dialog::with(['messages' => function($query) {
                    $query->orderBy('id', 'desc')->first();
                }, 'good' => function($query){
                    $query->select(['name', 'id'])->get();
                }, 'individual'])
                ->where(['entity_id' => $user->id, 'is_entity_deleted' => false])
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return view('cabinet.messages.index', compact('dialogs', 'individual'));
    }

    public function view($dialog_id)
    {
        $user = Auth::user();

        $dialog = Dialog::where(['entity_id' => $user->id, 'id' => $dialog_id])->orWhere(['individual_id' => $user->id, 'id' => $dialog_id])->first();
        $individual = false;
        if ($user->type === USER::INDIVIDUAL_TYPE){
            $individual = true;
        }

        return view('cabinet.messages.view', compact('dialog', 'individual'));
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $good = Goods::where(['id' => $data['good_id']])->first();
        if ($good and $data['message']){
            $dialog = Dialog::where([
                'individual_id' => $user->id,
                'entity_id' => $good->user->id,
                'good_id' => $good->id
            ])->first();
            if (!$dialog){
                $dialog = new Dialog([
                    'individual_id' => $user->id,
                    'entity_id' => $good->user->id,
                    'good_id' => $good->id,
                    'is_entity_deleted' => false,
                    'is_individual_deleted' => false,
                ]);
                $dialog->save();
            }

            $data = [
                'message' => $data['message'],
                'is_individual' => false,
                'is_read' => false,
                'dialog_id' => $dialog->id,
                'created_at' => date('Y-m-d h:i:s'),
                'updated_at' => date('Y-m-d h:i:s'),
            ];

            if ($user->type === User::INDIVIDUAL_TYPE){
                $data['is_individual'] = true;
            }
            $dialog->messages()->insert($data);

            return redirect()->route('cabinet.dialog.view', ['dialog_id' => $dialog->id]);

        }
    }

    public function createMessage(Request $request, $dialog_id)
    {
        $user = Auth::user();
        $data = [
            'is_individual' => false,
            'is_read' => false,
            'dialog_id' => $dialog_id,
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ];

        if ($user->type === User::INDIVIDUAL_TYPE){
            $data['is_individual'] = true;
        }

        $data = array_merge($data, $request->only(['message']));

        $dialog = Dialog::find($dialog_id);
        if (
            ($data['is_individual'] and $dialog->individual_id === $user->id) or
            (!$data['is_individual'] and $dialog->entity_id === $user->id)
        ) {
            $dialog->messages()->insert($data);
            $dialog->touch();
        }

        session()->flash('msg', 'Сообщение отправлено.');
        return redirect()->back();
    }

}
