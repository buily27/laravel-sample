<div class="modal fade" id="edit-profile" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('user.edit') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id='edit-user-{{ Auth::user()->id }}' action="{{ route('user.update-profile') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('user.phone') }}</label>
                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1"
                            placeholder="{{ __('form.input_phone') }}" value="{{ Auth::user()->phone }}">
                        @error('phone')
                            <p class="text-red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('user.dob') }}</label>
                        <input type="text" name="dob" class="form-control" id="exampleInputEmail1"
                            placeholder="{{ __('form.input_dob') }}" value="{{ Auth::user()->dob }}">
                        @error('dob')
                            <p class="text-red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">{{ __('user.image') }}</label>
                        <input type="file" name='image' class="form-control-file" id="exampleInputFile">
                        <input type="hidden" name='old_image' value="{{ Auth::user()->image }}">
                        @error('image')
                            <p class="text-red">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            @if (!empty(Auth::user()->image))
                                <label>{{ __('form.old_image') }}</label>
                                <img class="img-fluid mb-3" src="{{ asset('storage/' . Auth::user()->image) }}">
                            @endif
                        </div>
                        <div class="col-6">
                            <label id='new_image'></label>
                            <img class="img-fluid mb-3" src="" id="preview-image">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    {{ __('form.cancel') }}
                </button>
                <button type="button" class="btn btn-primary"
                    onclick="event.preventDefault();document.getElementById('edit-user-{{ Auth::user()->id }}').submit()">{{ __('link.edit') }}</button>
            </div>
        </div>
    </div>
</div>
@section('previewImage')
    <script src="js/previewImage.js"></script>
    @if (count($errors) > 0)
        <script type="text/javascript">
            $('#edit-profile').modal('show');
        </script>
    @endif
@endsection
