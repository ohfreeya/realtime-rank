@extends('layout.navbar')

@section('body')
<div class="container mt-3 h-100 pb-3">
    <h3 class="text-center">Profile Page</h3>
    <div class="pt-3">
        <div class="change-team">
            <div class="row container px-5 m-0">
                <div class="col-12">
                    <div class="row shadow rounded p-3">
                        <div class="col-12 pb-3">
                            <h5 class="fw-bold fst-italic">Change NickName</h5>
                        </div>
                        <div class="col-12 p-4 pt-2">
                            <form action="/profile/name/modify" method="POST">
                                @csrf
                                <label for="email" class="form-label">Email</label>
                                <input type="input" class="form-control" id="email" disabled value="{{$user->email}}">
                                <label for="nickname" class="form-label pt-3">NickName</label>
                                <input type="input" class="form-control" name="nickname" id="nickname" value="{{ $user->name ?? ""}}">
                                <div class="pt-3">
                                    <button type="submit" class="btn btn-primary">modify</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row shadow rounded p-3 mt-3">
                        <div class="col-12 pb-3">
                            <h5 class="fw-bold fst-italic">Change Team</h5>
                        </div>
                        <div class="col-12 p-4 pt-2">
                            <form action="/team/modify" method="post">
                                @csrf
                                <select class="form-select" aria-label="Default select example" name="team">
                                    <option selected disabled>Chose the other team</option>
                                    @foreach($teamList as $key => $value)
                                        <option value="{{ $key }}" {{$user->team_id == $key ? "selected disabled" : ""}}>{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="pt-3">
                                    <button type="submit" class="btn btn-primary">modify</button>
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