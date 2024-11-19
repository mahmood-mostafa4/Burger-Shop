@extends('layouts.main')
@section('content')
<section class="cart container mt-2 my-3 py-5">
<div class="container mt-2 text-center">
<h4> Your Profile</h4>
<p>{{ Auth::user()->name }}</p>
<p>{{ Auth::user()->email }}</p>
</div>
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <input type="submit" class="btn btn-danger" value="logout" style="margin-left: 550px;">
</form>
<div class="mt-3" style="margin-top: 20px;">
<a href="{{ route('user_orders') }}" class="btn btn-warning" style="margin-left: 532px;">Your Orders</a>
</div>
</section>
@endsection
