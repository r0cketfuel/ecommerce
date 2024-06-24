@extends("admin.layout.master")

@php
    $title = "Dashboard";
@endphp

@section("title", $title)

@section("css")
    <link rel="stylesheet"	href="{{  config('constants.framework_css') }}widget.css">
@endsection

@section("js")
    <script defer src="{{ config('constants.framework_js') }}counter.js"></script>
@endsection

@section("body")
    <div class="widget-grid">
        @foreach ($widgets as $widget)
            <div class="dashboard-widget" data-type="{{ $widget['color'] }}">
                <div class="widget-content">
                    <div class="widget-title">{{ $widget['title'] }}</div>
                    <div class="widget-value">
                        <span class="counter" data-from="0" data-to="{{ $widget['value'] }}">
                            {{ $widget['value'] }}
                        </span>
                    </div>
                    <div class="widget-link">
                        <a href="{{ $widget['link']['url'] }}">{{ $widget['link']['title'] }}</a>
                    </div>
                    <div class="widget-icon">{!! $widget['icon'] !!}</div>
                    <div class="widget-note">{{ $widget['extra'] }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection