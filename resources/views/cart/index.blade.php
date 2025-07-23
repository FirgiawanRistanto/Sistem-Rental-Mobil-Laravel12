@extends('layouts.store')

@section('content')
<div class="container content-container">
    <h2>Keranjang Belanja Anda</h2>
    <table id="cart" class="table table-hover table-condensed">
        <thead>
            <tr>
                <th style="width:5%"><input type="checkbox" id="selectAllProducts"></th>
                <th style="width:45%">Produk</th>
                <th style="width:10%">Harga</th>
                <th style="width:8%">Kuantitas</th>
                <th style="width:20%" class="text-center">Subtotal</th>
                <th style="width:12%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0 @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <tr data-id="{{ $id }}">
                        <td><input type="checkbox" class="product-checkbox" data-id="{{ $id }}"></td>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset('images/' . $details['image']) }}" width="100" height="100" class="img-responsive"/></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $details['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                        </td>
                        <td data-th="Subtotal" class="text-center">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-danger btn-sm remove-from-cart"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right"><h3><strong>Total Rp {{ number_format($total, 0, ',', '.') }}</strong></h3></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">
                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Lanjutkan Belanja</a>
                    <button class="btn btn-success" onclick="proceedToCheckout()">Checkout</button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('scripts')
<script type="text/javascript">

    function updateCartTotal() {
        let total = 0;
        $('.product-checkbox:checked').each(function() {
            const row = $(this).closest('tr');
            const priceString = row.find('[data-th="Price"]').text().replace('Rp ', '').replace(/\./g, ''); // Remove "Rp " and all dots
            const price = parseInt(priceString); // Use parseInt for integer prices
            const quantity = parseInt(row.find('.quantity').val());
            total += price * quantity;
        });
        $('tfoot h3 strong').text('Total Rp ' + total.toLocaleString('id-ID'));
    }

    // Initial total calculation on page load
    $(document).ready(function() {
        updateCartTotal();
    });

    // Select All / Deselect All
    $('#selectAllProducts').on('change', function() {
        $('.product-checkbox').prop('checked', $(this).prop('checked'));
        updateCartTotal();
    });

    // Individual product checkbox change
    $('.product-checkbox').on('change', function() {
        if (!$(this).prop('checked')) {
            $('#selectAllProducts').prop('checked', false);
        }
        updateCartTotal();
    });

    // Update cart quantity
    $(".update-cart").change(function (e) {
        e.preventDefault();

        var ele = $(this);

        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    function proceedToCheckout() {
        const selectedProductIds = [];
        $('.product-checkbox:checked').each(function() {
            selectedProductIds.push($(this).data('id'));
        });

        if (selectedProductIds.length === 0) {
            alert('Pilih setidaknya satu produk untuk checkout.');
            return;
        }

        // Redirect to checkout page with selected product IDs
        // We will use a form submission to send data via POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route('cart.checkout') }}';
        form.style.display = 'none';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        selectedProductIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_products[]';
            input.value = id;
            form.appendChild(input);
        });

        document.body.appendChild(form);
        form.submit();
    }

</script>
@endpush
