@extends('layouts.app')

@section('subtitle', 'Permissions')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Permissions')

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
                        <a href="{{route('permissions.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left nav-icon"></i>Voltar</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('permissions.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            @include('configuracoes.permissoes.partials.form')
                            <!-- /.card-body -->
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
    
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')

@endpush



