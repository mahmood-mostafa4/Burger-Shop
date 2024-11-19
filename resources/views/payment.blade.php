@extends('layouts.main')
@section('content')

<section class="container mt-2 my-3 py-5">
<div class="container mt-2 text-center">

<h4>Payment</h4>
@if (Session::has('total') && Session::get('total') != null)
    @if (Session::has('order_id') && Session::get('order_id') != null)

    <h4 style="color:blue;  margin-top:30px;" > Total : {{ session::get('total') }}</h4>
    <div id="paypal-button-container" style="margin-left: 210px;"></div>

    @endif
@endif
</div>
</section>
<script src="https://www.paypal.com/sdk/js?client-id=AdWzpylbxjAfvqPqqaNIcqLcDmDynP1n0tyg9N3URyoL6oqAScbbdvVZEw5BBJn_YiO2iXJ3yKSXwhMo&currency=USD"></script>
<!-- Set up a container element for the button -->

<script>
    paypal.Buttons({
        // Sets transaction when a payment button is clicked
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        currency_code: 'USD',
                        value: '{{ Session::get('total') }}'
                    }
                }]
            });
        },

        // Finalizes the transaction after payer approval
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Successful capture ! for dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('transaction' + transaction.status + ':' + transaction.id + '\n\nSee console for all available details.');

                window.location.href = "/verify_payment/" + transaction.id;

            });
        }
    }).render('#paypal-button-container');
</script>
@endsection
