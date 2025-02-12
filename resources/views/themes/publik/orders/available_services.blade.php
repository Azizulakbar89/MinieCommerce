<h6>Select Delivery Package:</h6>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Select</th>
            <th>Service</th>
            <th>Estimate</th>
            <th>Cost</th>
        </tr>
    </thead>
    @forelse ($services as $service)
        
    <tbody>
        <tr>
            <td>
                <div class="form-check">
                    <input class="form-check-input courier-code" type="radio" name="deliveryPackage" id="packageOKE"
                    value="OKE" checked>
                    <label class="form-check-label" for="packageOKE"></label>
                </div>
            </td>
            <td>{{$service['service']}}({{$service['description']}})</td>
            <td>{{$service['etd']}}</td>
            <td>IDR {{$service['cost']}}</td>
        </tr>
    </tbody>
    @empty
        
    @endforelse
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('.delivery-address').change(function() {
        $('.courier-code').removeAttr('checked');
        $('.available-services').hide();
    });
    $(document).ready(function() {
        $('.courier-code').click(function() {
            let courier = $(this).val();
            let addressID = $('.delivery-address:checked').val();

            console.log('Selected Courier:', courier);
            console.log('Selected Address ID:', addressID);

            $.ajax({
                url: "/orders/shipping-fee",
                method: "POST",
                data: {
                    address_id: addressID,
                    courier: courier,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    $('.available-services').show();
                    $('.available-services').html(result);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        });
    });
</script>
