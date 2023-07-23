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
                                                <a data-bs-toggle="modal" data-bs-target="#listEdit" href="#">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier"> 
                                                            <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#8b9bda" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                                            <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#8b9bda" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> 
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                            <div class="operator-icon p-0 mx-2">
                                                <a onclick="" href="#">
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
<!-- List Edit Modal -->
<div class="modal fade" id="listEdit" tabindex="-1" aria-labelledby="listEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="listEditLabel">Edit List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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