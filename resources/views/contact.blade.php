@extends('layouts/app')


@section('content')

    <h1>this is contact page</h1>

    <ul>
    @if(count($people))
        @foreach($people as $person)
        <li>{{$person}}</li>
        @endforeach
    @endif
    </ul>
@stop
