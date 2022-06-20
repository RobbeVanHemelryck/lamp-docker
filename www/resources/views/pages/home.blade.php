@extends('main')

@section('title', 'Home')

@section('content')
<div id="index">
    <div id="groteLOT">
        <div id="midden">
            <p>LIFE OF TALTIKO</p>
        </div>
    </div>
    <div id="content">
        <a href="/{{env('APP_PREFIX')}}moodboek"><div class="navVierkant"><p>moodboek</p></div></a>
        <a href="/{{env('APP_PREFIX')}}minidagboek"><div class="navVierkant"><p>minidagboek</p></div></a>
        <a href="/{{env('APP_PREFIX')}}dagboek"><div class="navVierkant"><p>dagboek</p></div></a>
        <a href="/{{env('APP_PREFIX')}}andere"><div class="navVierkant"><p>andere</p></div></a>
    </div>
</div>
@endsection