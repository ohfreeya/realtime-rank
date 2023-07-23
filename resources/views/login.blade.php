@extends('layout.base')

@section('body')
<div class="container">
    <div class="row justify-content-center vh-100 align-content-center">
        <div class="register-form">
            <h3 class="text-center">Login</h3>
            <div class="register-form px-5 pt-3 border-round">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                </div>
                <div class="text-center">
                    <a href="/register" class="text-decoration-none">register</a>
                    <span class="px-2">Or</span>
                    <button type="submit" class="btn btn-primary" onclick="sendLogin()">login</button>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#password').keyup(function(e){
            if(e.keyCode == 13){
                sendLogin()
            }
        })
    })
    function sendLogin(){
        $.ajax({
            url: "{{ Route('login.auth')}}",
            method: 'POST',
            headers: {
                'X-CSRF-Token': "{{ csrf_token() }}"
            },
            data:{
                'email': $("#email").val(),
                'password': $("#password").val()  
            },
            success: function(response){
                localStorage.setItem('token', response.token)
                window.location.href = "dashboard"
            }
        })
    }
</script>
@endsection