@extends('layouts.app')

@section('content')
    <home-component post-route="{{ route('BuyOrder') }}" />
@endsection