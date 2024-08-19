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
                            <p><strong>{{__('text.name')}} </strong>: {{ $user->name }}</p>
                            <p><strong>{{__('text.email')}} </strong>: {{ $user->email }}</p>

                            <a href="{{ url('settings/users/' . $user->id . '/roles') }}"
                                class="mt-4 mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                {{__('template.add_edit')}} {{__('template.roles')}}<i class="fas fa-plus"></i>
                            </a>
                            <p><strong>{{__('template.roles')}} </strong>:
                                @forelse ($user->getRoleNames() as $role)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $role }}</span>
                                @empty
                                    -
                                @endforelse
                            </p>

                            <a href="{{ url('settings/users/' . $user->id . '/permissions') }}"
                                class="mt-4 mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                {{__('template.add_edit')}} {{__('template.permissions')}} <i class="fas fa-plus"></i>
                            </a>
                            <p><strong>{{__('template.permissions')}} </strong>:
                                @forelse ($user->getDirectPermissions() as $permission)
                                    <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $permission->name }}</span>
                                @empty
                                    -
                                @endforelse
                            </p>
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





