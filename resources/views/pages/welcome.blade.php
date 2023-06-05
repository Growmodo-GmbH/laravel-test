@extends('layouts.app')

@section('content')

<welcome-component data ="{{Auth::user()->name}}" role={{Auth::user()->role}}></welcome-component>
@endsection