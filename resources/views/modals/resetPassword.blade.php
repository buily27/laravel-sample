
<form id="reset{{$user->id}}" action="{{route('reset_password',$user->id)}}" method="GET">
    @csrf
    <div class="modal fade" id="modal-reset-{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{__('form.reset_password')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">{{__('user.reset').$user->name}}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        {{__('form.cancel')}}
                    </button>
                    <button type="button" class="btn btn-danger"
                        onclick="event.preventDefault();document.getElementById('reset{{$user->id}}').submit()">{{__('link.reset_password')}}</button>
                </div>
            </div>
        </div>
    </div>
</form>
