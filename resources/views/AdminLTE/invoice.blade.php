@if ($update_order->status == NULL)
    <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
@elseif ($update_order->status == '2')
    <button class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
@else
    Pembayaran berhasil
@endif

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    const payButton = document.querySelector('#pay-button');
    payButton.addEventListener('click', function(e) {
        e.preventDefault();

        snap.pay('{{ $snapToken }}', {
            // Optional
            onSuccess: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log('success')

                $.ajax({
                  url: 'orders/{{$update_order->id}}',
                  type: "PATCH",
                  cache: false,
                  data:{
                    _token:'{{ csrf_token() }}',
                    status: '0',
                  },
                  success: function(dataResult){
                    dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode)
                    {
                        window.location = "/siswa/list-kelas-program";
                    }
                    else{
                        alert("Internal Server Error");
                    }
                  }
                });
            },
            // Optional
            onPending: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log('pending')
            },
            // Optional
            onError: function(result) {
                /* You may add your own js here, this is just example */
                // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                console.log('error')
            }
        });
    });
</script>