@extends('layout.base')

@section('body')
<div class="container">
    <div class="row justify-content-center vh-100 align-content-center">
        <div class="register-form w-50">
            <h3 class="text-center">Register</h3>
            <div class="register-form m-5 px-5 border-round">
                <form method="POST" action="{{ Route('register.store')}}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nickname</label>
                        <input type="input" class="form-control" name="name" id="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm" id="confirm">
                    </div>
                    <div class="text-center">
                        <a href="/login" class="text-decoration-none">back</a>
                        <span class="px-2">Or</span>
                        <button type="submit" class="btn btn-primary">register</button>
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
@endsection