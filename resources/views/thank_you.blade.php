@extends('layouts.main')
@section('content')

<section class="container mt-2 my-3 py-5">
<div class="container mt-2 text-center">

<h4>Thank You</h4>
    @if (Session::has('order_id') && Session::get('order_id') != null)
    <h4 style="color: blue; margin-top:30px;" > Order Id : {{ Session::get('order_id') }}</h4>
    <h4 style="margin-top:30px;" > PleaseKeep Your Order Id In A Safe Place For Future Refrences</h4>
    <h4 style="margin-top:30px;" > Your Order Will Be Deliverd In 30-45 Minutes</h4>
    @endif
</div>
</section>

@endsection
