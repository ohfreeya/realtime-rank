@extends('layout.navbar')
@section('body')
<div class="container mt-3">
    <h3>Dashboard Page</h3>
    <div class="table-show shadow p-3 mb-5 bg-body rounded ">
        <table class="table table-striped">
            <thead>
                <tr class="fw-bold">
                    <td>team</td>
                    <td>score</td>
                </tr>
            </thead>
            <tbody class="rank-data"> 
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ Route('dashboard')}}",
            method: 'GET',
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}",
                "Accept": "application/json"
            },
        })
        getData();
    })
    function getData(){
        var getting = {
            url:'/api/rank/data',
            method: 'GET',
            headers: {
                "Authorization": 'Bearer '+localStorage.getItem('token'),
            },
            dataType:'json',
            success:function(res) {
                res.forEach( e => {
                    $('.'+e.team+'-t').text( e.team );
                    $('.'+e.team+'-s').text( e.score );
                })
                // $.ajax(getting);
            },
            error:function(res){
                $.ajax($getting);
            }
        }
        $.ajax({
            url: "/api/rank/team/list",
            method: 'GET',
            headers: {
                "Authorization": 'Bearer '+localStorage.getItem('token'),
            },
            success: function(res){
                res.forEach(element => {
                    $(".rank-data").append(`
                        <tr>
                            <td class="`+ element +`-t"></td>
                            <td class="`+ element +`-s"></td>
                        </tr>
                    `)
                });
                $.ajax(getting);
            }
        })
    }
</script>
@endsection