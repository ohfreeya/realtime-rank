@extends('layout.navbar')

@section('body')
<div class="container mt-3 h-100 pb-3">
    <h3 class="text-center">Score Manage Page</h3>
    <div class="pt-3">
        <div class="container row px-5 m-0">
            <div class="col-12">
                <div class="row shadow rounded p-3">
                    <div class="col-12 pb-3">
                        <h5 class="fw-bold fst-italic">Team Score</h5>
                    </div>
                    <div class="col-12 p-4 pt-2">
                        <form action="/score/store" method="post">
                            @csrf
                            <div class="pb-3">
                                <label for="team-name" class="form-label">Team Name</label>
                                <select name="team" id="team-name" class="form-control">
                                    <option selected disabled>Choose Team</option>
                                    @foreach($teamList as $team)
                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pb-3">
                                <label for="team-score" class="form-label">Score Control</label>
                                <input type="number" class="form-control team-score" name="score">
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">modify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    function getTeamCurrentScore(){
        var team = $('#team-name').prop('value');
        $.ajax({
            url: "/score/"+team,
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            success: function(res){
                $('.team-score').prop('value',res.score)
            }
        })
    }
</script>
@endsection