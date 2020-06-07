<form action="{{ url('charge') }}" method="post">
    {{ csrf_field() }}
    <input type="email" name="email" placeholder="Enter Email" />
    <input type="text" name="amount" placeholder="Enter Amount" />
    <input type="text" name="cc_number" placeholder="Card Number" />
    <input type="text" name="expiry_month" placeholder="Month" />
    <input type="text" name="expiry_year" placeholder="Year" />
    <input type="text" name="cvv" placeholder="CVV" />
    <input type="submit" name="submit" value="Submit" />
</form>
