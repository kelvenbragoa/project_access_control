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
                            <h3 class="card-title">{{ __('template.permissions_record') }}</h3>
                            <br>
                            <h5 class="mb-1">{{ __('template.below_is_the_recorded_information') }}</h5>
                            <a href="{{route('permissions.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left nav-icon"></i>{{ __('text.go_back') }}</a>

                        </div>
                        <div class="card-body">
                           
                            <form action="{{ route('permissions.update',$permission->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                @include('configuracoes.permissoes.partials.form')

         
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">{{ __('template.submit') }}</button>
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




