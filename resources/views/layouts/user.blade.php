@extends('layouts.base')

@section('profile-settings')
<a class="dropdown-item" href="{{ route('user.user.edit', ['user' => Auth::id()]) }}">
    <i class="mdi mdi-settings text-primary"></i>
    {{__('indexes.settings')}}
</a>
@endsection

@section('profile-name','Name User')

@section('profile-photo')
<img src="{{ asset('images/faces/user.png')}}" alt="profile"/>
@endsection

@section('flags')
<li><a href="{{ url('locale/en') }}" ><p class="mr-2 mt-3 text-info">ENG</p></a></li>
<li><a href="{{ url('locale/it') }}" ><p class="mr-2 mt-3 text-info">ITA</p></a></li>
@endsection

@section('left-navbar')
<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
                <i class="mdi mdi-chart-pie menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.surveys.index') }}">
                <i class="mdi mdi-comment-question-outline menu-icon"></i>
                <span class="menu-title">{{__('indexes.surveys')}}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('user.groups.index') }}">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">{{__('indexes.groups')}}</span>
            </a>
        </li>
    </ul>
</nav>
@endsection
