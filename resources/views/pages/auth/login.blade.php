@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Login</h4>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" autofocus required maxlength="60"  />
                    <label for="username">Username</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required />
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
@stop
@section('javascript')

@endsection