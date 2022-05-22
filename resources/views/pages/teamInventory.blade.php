@extends('layouts.app')

@section('content')
    <team_items :team = "'{{ $team }}'"></team_items>
@endsection