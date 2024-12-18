<!DOCTYPE html>
<html>
<head>
    <title>Mobile Parts Supplier</title>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg w-full max-w-lg p-6">
        <h1 class="text-2xl font-semibold text-blue-600 mb-4">Mobile Parts Supplier</h1>
        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
        <p class="text-gray-700 mb-6">To confirm your order, please make a payment below.</p>

        <form class="space-y-4 require-validation"
        role="form"
        action="{{ route('stripe.post') }}"
        method="post"
        data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        id="payment-form"
        >
        @csrf
            <!-- Name on Card -->
            <div>
                <label for="name-on-card" class="block text-sm font-medium text-gray-700">Name on Card</label>
                <input type="text" required class="mt-1 w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Card Number -->
            <div>
                <label for="card-number" class="block text-sm font-medium text-gray-700">Card Number</label>
                <input type="text" id="card-number"  required class="mt-1 w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 card-number">
            </div>

            <!-- CVC -->
            <div>
                <label for="cvc" class="block text-sm font-medium text-gray-700">CVC</label>
                <input type="text" id="cvc" placeholder="ex. 311" required class="mt-1 w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 card-cvc">
            </div>

            <!-- Expiration Month -->
            <div>
                <label for="expiration-month" class="block text-sm font-medium text-gray-700">Expiration Month</label>
                <input type="text" id="expiration-month" placeholder="MM" required class="mt-1 w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 card-expiry-month">
            </div>

            <!-- Expiration Year -->
            <div>
                <label for="expiration-year" class="block text-sm font-medium text-gray-700">Expiration Year</label>
                <input type="text" id="expiration-year"  placeholder="YYYY" required class="mt-1 w-full border rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500 card-expiry-year">
            </div>
            <div class='form-row row'>
                <div class='col-md-12 error form-group hide'>
                    <div class='alert-danger alert'>Please correct the errors and try
                        again.</div>
                </div>
            </div>
            <input type="hidden" name="total_amount" value="{{ $order_inv->total_amount }}">
                        <input type="hidden" name="order_id" value="{{ $order_inv->id }}">
            <!-- Pay Now Button -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Pay Now - {{$order_inv->total_amount}}</button>
            </div>
        </form>
    </div>



</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">

$(function() {

    /*------------------------------------------
    --------------------------------------------
    Stripe Payment Code
    --------------------------------------------
    --------------------------------------------*/

    var $form = $(".require-validation");

    $('form.require-validation').bind('submit', function(e) {
        var $form = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid = true;
        $errorMessage.addClass('hide');

        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });

        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }

    });

    /*------------------------------------------
    --------------------------------------------
    Stripe Response Handler
    --------------------------------------------
    --------------------------------------------*/
    function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];

            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }

});
</script>
</html>
