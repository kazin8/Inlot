<div class="modal fade my-modal" id="callSeller" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Написать продавцу</h4>
                <div class="from">
                    <p>{{ $order->goods->name }}</p>
                </div>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('cabinet.dialog.create'), 'class'=>'"modal-form', 'autocomplete' => 'off']) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12 col-md-12 col-sm-12 validation-right">
                                {{ Form::textarea('message', '', ['class'=>'form-control', 'rows' => '5', 'placeholder' => 'Ваш вопрос', 'required' => 'required']) }}
                            </div>
                        </div>
                    </div>
                    {{ Form::hidden('good_id', $order->goods->id) }}
            </div>
            <div class="modal-footer no-border">
                <div class="text-left">
                    <button type="button" class="btn btn-orange" data-btn="submit">Отправить</button>
                    <button type="button" class="btn btn-link" data-dismiss="modal">Отмена</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>