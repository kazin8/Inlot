<div class="modal fade my-modal" id="changeStatusType" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header no-border">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Изменение статуса заказа</h4>

            </div>
            <div class="modal-body">
                <form class="ChangeStatusItem" autocomplete="off">
                    <div class="row">
                        <div class="col-xs-12">
                            <p>Выберите новый статус заказа</p>
                        </div>
                        <div class="col-xs-12">
                            {{ Form::select('orderStatus', \App\Order::$statusNamesOwner, null, ['class' => 'form-control status-select', 'data-item' => 'select-no-search']) }}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-border">
                <div class="text-left">
                    <button type="button" class="btn btn-orange col-xs-3 change-order-status" data-id="" data-btn="submit" data-dismiss="modal">Изменить статус</button>
                    <button type="button" class="btn btn-link col-xs-3" data-dismiss="modal">Отменить</button>
                </div>
            </div>
        </div>
    </div>
</div>