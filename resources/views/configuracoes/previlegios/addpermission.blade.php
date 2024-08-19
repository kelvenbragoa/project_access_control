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
                            <h3 class="card-title">{{ __('template.roles_record') }}</h3>
                            <br>
                            <h5 class="mb-1">{{ __('template.below_is_the_recorded_information') }}</h5>
                            <a href="{{route('roles.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left nav-icon"></i>{{__('text.go_back')}}</a>

                        </div>
                        <div class="card-body">
                            <p><strong>{{__('template.roles')}}:</strong> {{ $role->name }}</p>

                    <form action="{{ url('settings/roles/' . $role->id . '/rolepermission') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="grid grid-cols-4 gap-4">
                            @foreach ($permissions as $permission)
                                <div class="col">
                                    <label for="name" value="">{{ $permission->name }}</label>
                                    <input type="checkbox" name="permission[]" value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolepermissions) ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    {{-- <x-text-input id="name" name="permission[]" value="{{$permission->name}}" type="checkbox" :checked="in_array($permission->id, $rolepermissions) ? 'true' : 'false'" /> --}}
                                </div>
                            @endforeach
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


