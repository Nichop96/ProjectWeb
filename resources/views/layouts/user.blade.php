@extends('layouts.base')

@section('profile-settings')
<a class="dropdown-item">
    <i class="mdi mdi-settings text-primary"></i>
    Settings
</a>
@endsection

@section('profile-name','Name User')

@section('profile-photo')
<img src="{{ asset('images/faces/user.png')}}" alt="profile"/>
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
              <span class="menu-title">Surveys</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.groups.index') }}">
              <i class="mdi mdi-sort-variant menu-icon"></i>
              <span class="menu-title">Groups</span>
            </a>
          </li>
        </ul>
      </nav>
@endsection