@extends('layout')
@section('content')
@section('title')
{{ __('user.profile') }}
@endsection
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session()->get('success') }}
</div>
@endif
<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                @if (!empty(Auth::user()->image))
                <img src="{{'storage/'. Auth::user()->image}}" alt="" />
                @else
                <img src="{{'uploads/default_image.png'}}" alt="" />
                @endif
            </div>
        </div>
        <div class="col-md-5">
            <div class="profile-head">
                <h5>
                    {{Auth::user()->name}}
                </h5>
                <h6>
                    {{Auth::user()->role->name}}
                </h6>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                </ul>
            </div>
        </div>
        <div class="col-md-3">
            <a href="#" class="btn btn-outline-secondary" name="btnAddMore" data-toggle="modal"
                data-target="#edit-profile">{{__('link.edit_profile')}}</a>
            <a href="{{route('change-password')}}" class="btn btn-outline-secondary"
                name="btnAddMore">{{__('user.change_password')}}</a>

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{__('user.username')}}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{Auth::user()->username}}</p>
                        </div>
                    </div>
                    @if (!is_null(Auth::user()->phone))
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{__('user.phone')}}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{Auth::user()->phone}}</p>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{__('user.dob')}}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{Auth::user()->dob}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('user.department')}}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{Auth::user()->department->name}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('user.worked_at') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{Auth::user()->worked_at}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ __('user.work_status') }}</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                @if (Auth::user()->work_status == config('common.IS_WORK'))
                                {{__('user.is_work')}}
                                @else
                                {{__('user.quit')}}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('modals/editProfile')
@endsection