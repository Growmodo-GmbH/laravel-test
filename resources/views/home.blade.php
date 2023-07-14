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

                    <h1 class="h3 font-weight-normal"> Welcome {{ Auth::user()->username }} </h1>

                    <div class="container-fluid">
                        @if (Auth::user()->is_admin == 1)
                            <div class="col">
                                <a class="btn btn-primary btn-lg btn-block" href="{{ route('records') }}">
                                    View Records
                                </a>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger btn-lg btn-block" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        @else
                            <div class="col">
                                <a class="btn btn-primary" href="{{ route('unsubscribe') }}">
                                    Unsubscribe
                                </a>
                            </div>
                            <div class="col">
                                <a class="btn btn-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        @endif
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
