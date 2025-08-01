@extends('backend.layouts.master')
@section('title', __('highlighted_feature'))
@section('content')
    <section class="oftions">
        <div class="container-fluid">
            <div class="row">
                @include('backend.admin.website.sidebar_component')
                <div class="col-xxl-9 col-lg-8 col-md-8">
                    <h3 class="section-title">{{ __('add_new_highlighted_feature') }}</h3>
                    <div class="default-tab-list default-tab-list-v2  bg-white redious-border p-20 p-sm-30">
                        <form action="{{ route('highlighted-feature.store') }}" method="POST" class="form" enctype="multipart/form-data">
                            @csrf
                            <div class="row gx-20 add-coupon">
                                <input type="hidden" value="{{ $lang }}" name="lang">
                                <input type="hidden" class="is_modal" value="0"/>
                                <div class="col-lg-12 input_file_div mb-4">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">{{__('logo') }}(100*100)</label>
                                        <label for="logo" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{__('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" id="logo"
                                               name="logo" accept=".svg,.png">
                                        <div class="nk-block-des text-danger">
                                            <p class="logo_error error">{{ $errors->first('logo') }}</p>
                                        </div>
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80',[]) }}"
                                                 alt="favicon">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="mini_title" class="form-label">{{ __('short_title') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="mini_title" name="mini_title">
                                        <div class="nk-block-des text-danger">
                                            <p class="mini_title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('title') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="title" name="title">
                                        <div class="nk-block-des text-danger">
                                            <p class="title_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="description" class="form-label">{{ __('description') }}</label>
                                        <textarea class="form-control" id="description"
                                                  name="description"></textarea>
                                        <div class="nk-block-des text-danger">
                                            <p class="description_error error">{{ $errors->first('lang') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 input_file_div mb-4">
                                    <div class="mb-3">
                                        <label class="form-label mb-1">{{__('image') }}(500*540)</label>
                                        <label for="image" class="file-upload-text">
                                            <p></p>
                                            <span class="file-btn">{{__('choose_file') }}</span>
                                        </label>
                                        <input class="d-none file_picker" type="file" id="image"
                                               name="image" accept=".jpg,.png">
                                        <div class="nk-block-des text-danger">
                                            <p class="image_error error">{{ $errors->first('image') }}</p>
                                        </div>
                                    </div>
                                    <div class="selected-files d-flex flex-wrap gap-20">
                                        <div class="selected-files-item">
                                            <img class="selected-img" src="{{ getFileLink('80x80',[]) }}"
                                                 alt="favicon">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="lable" class="form-label">{{ __('lable') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="lable" name="lable">
                                        <div class="nk-block-des text-danger">
                                            <p class="lable_error error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="link" class="form-label">{{ __('link') }}</label>
                                        <input type="text" class="form-control rounded-2 ai_content_name" id="link" name="link">
                                        <div class="nk-block-des text-danger">
                                            <p class="link_error error"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="d-flex justify-content-end align-items-center mt-30">
                                    <button type="submit" class="btn sg-btn-primary">{{__('submit') }}</button>
                                    @include('backend.common.loading-btn',['class' => 'btn sg-btn-primary'])
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('backend.admin.website.component.new_menu')
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->

    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
@endpush
@push('js')

@endpush
