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
                            <h3 class="card-title">{{ __('template.permissions_record') }}</h3>
                            <br>
                            <h5 class="mb-1">{{ __('template.below_is_the_recorded_information') }}</h5>

                            <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="fa fa-plus nav-icon"></i> {{ __('template.new_record') }} </a>
                           
                          
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                            
                                <table id="table1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('text.name') }}</th>
                                            <th>{{ __('text.created_at') }}</th>
                                            <th>{{ __('text.actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissions as $item)
                                            <tr class="bg-white">
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                    {{ $item->name }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                                                    {{ $item->created_at->format('Y-m-d H:i') }}
                                                </td>
                                                

                                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                            
                                                    <a href="{{ route('permissions.edit', $item) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    <a href="{{ route('permissions.show', $item) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <a href="#" x-data=""
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion{{ $item->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                                @include('configuracoes.permissoes.partials.modal-delete')
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('text.name') }}</th>
                                            <th>{{ __('text.created_at') }}</th>
                                            <th>{{ __('text.actions') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')


@endpush
