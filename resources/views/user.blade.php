@extends('layout.navbar')

@section('body')
<div class="container mt-3 h-100 pb-3">
    <h3 class="text-center">User Manage Page</h3>
    <div class="pt-3">
        <div class="container row px-5 m-0">
            <div class="col-12">
                <div class="row shadow rounded p-3">
                    <div class="col-12 pb-3">
                        <h5 class="fw-bold fst-italic">Create New User</h5>
                    </div>
                    <div class="col-12 p-4 pt-2">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td class="fw-bold">NickName</td>
                                    <td class="fw-bold">Email</td>
                                    <td class="fw-bold">Team</td>
                                    <td class="fw-bold">Permission</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->getTeam->name}}</td>
                                    <td>
                                        @switch($user->permission)
                                            @case(1)
                                                <span class="text-secondary">Staff</span>
                                                @break
                                            @case(2)
                                                <span class="text-warning">Team Leader</span> 
                                                @break
                                            @case(3)
                                                <span class="text-primary">Team Member</span> 
                                                @break
                                            @default
                                                -
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="operator-icon p-0 mx-2">
                                            <a href="/user/delete/{{$user->id}}">
                                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier"> 
                                                        <path d="M10 12V17" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M14 12V17" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M4 7H20" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#df4343" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                                                    </g>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-secondary">Not get any user data...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row shadow rounded p-3">
                    <div class="col-12 pb-3">
                        <h5 class="fw-bold fst-italic">Create New User</h5>
                    </div>
                    <div class="col-12 p-4 pt-2">
                        <form action="{{ Route('user.create') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="nickname" class="form-label">NickName <span class="text-danger">*</span></label>
                                <input type="input" class="form-control" id="nickname" name="name" value="{{old('name')}}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="email" value="{{old('email')}}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="confirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="confirm" id="confirm" autocomplete="off">
                            </div>
                            <div class="mb-3">
                                <label for="permission" class="form-label">Permission <span class="text-danger">*</span></label>
                                <select name="permission" id="permission" class="form-control">
                                    <option selected disabled class="text-gray">Choose User Permission</option>
                                    <option value="1">Staff</option>
                                    <option value="2">Team Leader</option>
                                    <option value="3">Team Member</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="team" class="form-label">Team</label>
                                <select name="team" id="team" class="form-control">
                                    <option selected disabled class="text-gray">Choose Team</option>
                                    @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
@endsection