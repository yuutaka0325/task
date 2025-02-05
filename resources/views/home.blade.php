@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form> <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> ログアウト </a>
                </div>
                
            </div>
            
        </div>
    </div>
</div>
@endsection
