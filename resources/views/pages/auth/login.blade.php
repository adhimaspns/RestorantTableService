@extends('layouts.auth')
@section('title-page', 'Login')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 margin-top-100">
                @if (session('gagal-login'))
                    <div class="alert alert-danger">
                        {{ session('gagal-login')}}
                        <a href="{{ url('login') }}" style="float: right"> 
                            x
                        </a>
                    </div>  
                @endif

                <div class="card margin-bottom-50">
                    <div class="card-header text-center">
                        Login
                    </div>
                    <div class="card-body">
                        <form action="{{ url('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="min: 6">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
