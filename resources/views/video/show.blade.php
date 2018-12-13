@extends('shared.template')

@section('content')
       <h1>{{$video->title}}</h1>
       <video width="400" controls>
           <source src="{{$video->location}}" type="video/{{$video->extension}}">
           Your browser does not support HTML5 video.
       </video>
@endsection