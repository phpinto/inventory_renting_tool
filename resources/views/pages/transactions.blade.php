@extends('layouts.app')

@section('content')
    <transactions :id = "{{ $id }}" :user_full_name = "'{{ $user->first_name }} {{ $user->last_name }}'"></transactions>
@endsection