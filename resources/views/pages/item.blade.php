@extends('layouts.app')

@section('content')
    <item :item = "{{ json_encode($item) }}"></item>
@endsection