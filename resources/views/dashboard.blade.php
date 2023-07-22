@extends('layout.navbar')
@section('body')
<div class="container mt-3 h-100">
    <h3>Dashboard Page</h3>
    <div class="table-show shadow p-3 mb-5 bg-body rounded">
        <table class="table table-striped text-center">
            <thead>
                <tr class="fw-bold">
                    <td class="w-50">team</td>
                    <td class="w-50">score</td>
                </tr>
            </thead>
            <tbody class="rank-data"> 
                <tr class="rank-wait-data">
                    <td colspan="2"> loading...</td>
                </tr>
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
                $('.rank-data').css("height", $('.rank-wait-data').height())
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
                $('.rank-data').css("height", $('.rank-wait-data').height()*res.length)
                $('.rank-wait-data').remove();
                res.forEach( (e,i) => {
                    var elementToMove = $('.'+e.team+'-b');
                    var targetIndex = i;
                    elementToMove.animate(
                        {
                            top: targetIndex * elementToMove.height(),
                            "z-index": 9
                        },
                        500
                    );
                    $('.'+e.team+'-s').text(e.score).animate({ opacity: 1 }, 100);
                    $('.'+e.team+'-t').text(e.team).animate({ opacity: 0.7 }, 100);
                })
                $.ajax(getting);
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
                        <tr class="`+element+`-b">
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