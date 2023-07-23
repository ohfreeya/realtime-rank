@extends('layout.navbar')
@section('body')
<div class="container mt-3 h-100 pb-3">
    <h3 class="text-center">Dashboard Page</h3>
    <div class="table-show shadow p-3 mb-5 bg-body rounded">
        <table class="table text-center">
            <thead>
                <tr class="fw-bold w-100">
                    <td class="w-50">team</td>
                    <td class="w-50">score</td>
                </tr>
            </thead>
            <tbody class="rank-data"> 
                <tr class="rank-wait-data" style="opacity: 1; color:black">
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
                console.log(res)
                res.forEach( (e,i) => {
                    e.team = e.team.replaceAll(' ','')
                    var elementToMove = $('.'+e.team+'-b');
                    var targetIndex = i;
                    elementToMove.animate(
                        {
                            top: targetIndex * elementToMove.height(),
                            "z-index": 9
                        },
                        1000
                    );
                    $('.'+e.team+'-s').text(e.score).animate({ opacity: 1 });
                    $('.'+e.team+'-t').text(e.team).animate({ opacity: 0.7 });
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
                    element = element.replaceAll(" ","")
                    $(".rank-data").append(`
                        <tr class="`+element+`-b row w-100 m-0">
                            <td class="`+ element +`-t col"></td>
                            <td class="`+ element +`-s col"></td>
                        </tr>
                    `)
                });
                $.ajax(getting);
            }
        })
    }
</script>
@endsection