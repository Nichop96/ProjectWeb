@extends('layouts.base')

@section('profile-settings')
<a class="dropdown-item">
    <i class="mdi mdi-settings text-primary"></i>
    Settings
</a>
@endsection

@section('profile-name','Name User')

@section('profile-photo')
<img src="{{ asset('images/faces/face5.jpg')}}" alt="profile"/>
@endsection

@section('left-navbar')
<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.surveys.index') }}">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Surveys</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">History</span>             
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.groups.index') }}">
              <i class="mdi mdi-view-headline menu-icon"></i>
              <span class="menu-title">Groups</span>
            </a>
          </li>
        </ul>
      </nav>
@endsection