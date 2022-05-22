@extends('layouts.app')

@section('content')
    <add_item_form :categories = "{{ $categories }}"></add_item_form>
@endsection