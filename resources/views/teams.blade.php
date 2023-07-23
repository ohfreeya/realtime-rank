@extends('layout.navbar')

@section('body')
<div class="container mt-3 h-100 pb-3">
    <h3 class="text-center">Team Manage Page</h3>
    <div class="pt-3">
        <div class="change-team">
            <div class="row container px-5 m-0">
                <div class="col-12">
                    <div class="row shadow rounded p-3">
                        <div class="col-12 pb-3">
                            <h5 class="fw-bold fst-italic">Teams List</h5>
                        </div>
                        <div class="col-12 p-4 pt-2">
                            <ul class="list-group list-group-flush">
                                @forelse($teamsList as $key => $value)
                                <li class="list-group-item">
                                    <span class="float-start">{{ $value }}</span>
                                    <div class="list-operator float-end">
                                        <div class="row">
                                            <div class="operator-icon p-0 mx-2">
                                                <a href="/team/delete/{{$key}}">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier"> 
                                                            <path d="M10 12V17" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </li>
                                @empty
                                <li class="list-group-item">No any team.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <div class="row shadow rounded p-3 mt-3">
                        <div class="col-12 pb-3">
                            <h5 class="fw-bold fst-italic">Create Teams</h5>
                        </div>
                        <div class="col-12 p-4 pt-2">
                            <form action="/team/create" method="post">
                                @csrf
                                <label for="team-name" class="form-label">Team Name</label>
                                <input type="text" id="team-name" class="form-control" name="name" autocomplete="off">
                                <div class="pt-3">
                                    <button type="submit" class="btn btn-primary">create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function editTeam (id) {

    }
</script>
@endsection