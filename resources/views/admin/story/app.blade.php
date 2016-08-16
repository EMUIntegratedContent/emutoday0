@extends('admin.layouts.adminlte')
@section('title','StoryApp')
@section('style-vendor')
    @parent
@endsection
@section('style-plugin')
    @parent
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="/themes/admin-lte/plugins/iCheck/all.css">
{{-- <link rel="stylesheet" href="/themes/plugins/eonasdan-bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"> --}}

    @endsection
    @section('style-app')
        @parent
        @endsection
        @section('scripthead')
                    {{-- @include('admin.layouts.scriptshead') --}}
        @parent
    @endsection
@section('content')
    <div id="vue-story-app">
        <div id="vue-story-app">
            <story-app stypes="{{$stypes}}" cuser="{{$currentUser}}" role="{{$currentUser->roles->first()->name}}">
            </story-app>
        </div><!-- /.vue-story-app -->
            {{-- <story-app stypes="{{$stypes}}">
            </story-app> --}}
    </div><!-- /.vue-story-app -->

@endsection
@section('footer-vendor')
    @parent
    {{-- <script src="/js/admintools.js"></script> --}}
@endsection

@section('footer-plugin')
    @parent

    @endsection

    @section('footer-app')
    @parent
      <script type="text/javascript" src="/js/vue-story-app.js"></script>
    @endsection
@section('footer-script')
        @parent

        <script>


        </script>
    @endsection
