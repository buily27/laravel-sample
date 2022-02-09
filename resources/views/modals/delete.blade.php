<div class="modal fade" id="modal-delete-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{__('form.delete_confirm')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">{{__('user.confirm')}}</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{__('form.cancel')}}
                </button>
                <button type="button" class="btn btn-danger"
                    onclick="event.preventDefault();document.getElementById('delete_form_{{$user->id}}').submit()">{{__('link.delete')}}</button>
            </div>
        </div>
    </div>
</div>