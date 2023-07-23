@extends('layout.base')
@section('nav')
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="/dashboard">Rank</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ $currentPage == 'dashboard' ? "active" : '' }}" href="/dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $currentPage == 'profile' ? "active" : '' }}" href="/profile">Profile</a>
          </li>
          @if($isStaff)
            <li class="nav-item">
              <a class="nav-link {{ $currentPage == 'teams' ? "active" : '' }}" href="/teams">Teams Manage</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ $currentPage == 'user' ? "active" : '' }}" href="/user">User Manage</a>
            </li>
          @endif
          <li class="nav-item float-end">
            <a class="nav-link" href="/logout">Logout</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
@endsection