@extends('layout.navbar')

@section('body')
<div class="container mt-3 h-100">
    <h3>Profile Page</h3>
    <div class="pt-3">
        <div class="change-team">
            <div class="row container px-5">
                <div class="col-12">
                    <h5>Change Team</h5>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <form action="/team/modify" method="post">
                                @csrf
                                <select class="form-select" aria-label="Default select example" name="team">
                                    <option selected disabled>Chose the other team</option>
                                    @foreach($teamList as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
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