@extends("layouts.app")

@section('styles')
<style>
    ol {
        margin-left: 17.5px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <h1 class="text-center" style="font-weight: 700; font-size: 54px;">{{ __('Privacy Policy') }}</h1>
    <div class="mb-3">{!! __('privacy.paragraph_1') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_2') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_3') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_4') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_5') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_6') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_7') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_8') !!}</div>
    <div class="mb-3">{!! __('privacy.paragraph_9') !!}</div>
</div>
@endsection

@section('scripts')
@endsection
