@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-file"></i>{{__('template.new_record')}}</h3>
                            <br>
                            <h5 class="mb-2"><i class="fa fa-edit"></i>{{__('template.provide_information_for_registration')}}</h5>
                            <a href="{{ route('users.index') }}" class="btn btn-primary"><i
                                    class="fa fa-arrow-left nav-icon"></i>{{__('text.go_back')}}</a>

                        </div>
                        <div class="card-body">
                           
                            <form action="{{ route('users.update',$user->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="name">{{__('text.name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name"  value="{{ $user->name }}" placeholder="{{__('text.name')}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{__('text.email')}}</label>
                                    <input type="text" class="form-control" id="email" name="email"  value="{{ $user->email }}" placeholder="{{__('text.email')}}" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">{{__('text.password')}}</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="{{__('text.password')}}">
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">{{__('text.password_confirmation')}}</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  placeholder="{{__('text.password_confirmation')}}">
                                </div>
         
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">{{__('template.submit')}}</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
@endpush







