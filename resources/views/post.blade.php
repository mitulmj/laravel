@extends('layouts/app')

@section('content')
<h1>This is post page {{$id}} {{$name}}</h1>
@stop


@section('footer')
<script>
    alert("name :{{$name}}")
</script>
@stop
