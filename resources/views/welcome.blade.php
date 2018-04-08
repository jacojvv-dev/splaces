@extends('layouts.app')

@section('content')



    <router-view></router-view>





@endsection

@section('scripts')
    <script src="{{ asset('js/home.js') }}"></script>
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
@endsection

