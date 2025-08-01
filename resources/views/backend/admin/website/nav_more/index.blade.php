
@extends('backend.layouts.master')
@section('title', __('nav_more'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <div class="header-top d-flex justify-content-between align-items-center">
                        <h3 class="section-title">{{ __('nav_more') }}</h3>
                        @can('nav-more.create')
                        <div class="oftions-content-right mb-12">
                            <a href="{{ route('nav-more.create') }}" class="d-flex align-items-center btn sg-btn-primary gap-2">
                                <i class="las la-plus"></i>
                                <span>{{__('add_nav_more') }}</span>
                            </a>
                        </div>
                        @endcan
                    </div>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="default-list-table table-responsive yajra-dataTable">
                                    {{ $dataTable->table() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.common.delete-script')
@endsection
@push('js')
    {{ $dataTable->scripts() }}
@endpush

