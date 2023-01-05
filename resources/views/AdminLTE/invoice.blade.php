@if ($update_order->status == NULL)
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>Invoice - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-md-12">   
 <div class="row">
		
    <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
        <div class="row">
            <div class="receipt-header">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="receipt-left">
                        <img class="img-responsive" alt="iamgurdeeposahan" src="{{'/'.$data_siswa->foto}}" style="width: 71px; border-radius: 43px;">
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <div class="receipt-right">
                        <h5>{{$data_siswa->name}} </h5>
                        <p>{{$data_siswa->nisn}} <i class="fa fa-profile"></i></p>
                        <p>{{$data_siswa->email}} <i class="fa fa-envelope-o"></i></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="receipt-header receipt-header-mid">
                <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                    <div class="receipt-right">
                        <h3>{{$data_kelas_program->nama}} </h3>
                        <p>{{$data_kelas_program->alamat}} <i class="fa fa-home"></i></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div>
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: #6f42c1;">
                        <th>Kelas / Program Kursus</th>
                        <th>Waktu</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-md-7"> {{$data_kelas_program->deskripsi}}</td>
                        <td class="col-md-2"><i class="fa fa-inr"></i> {{$data_kelas_program->jumlah_bulan}} bulan</td>
                        <td class="col-md-3"><i class="fa fa-inr"></i> {{$data_kelas_program->harga}}</td>
                    </tr>
                    <tr>
                        <td class="text-right"><h2><strong>Total: </strong></h2></td>
                        <td></td>
                        <td class="text-left text-danger"><h2><strong><i class="fa fa-inr"></i> {{$data_kelas_program->harga}}</strong></h2></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="row">
            <div class="receipt-header receipt-header-mid receipt-footer">
                <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                    <div class="receipt-right">
                        <p><b>Date :</b> 15 Aug 2016</p>
                        <h5 style="color: rgb(140, 140, 140);">Thanks for shopping.!</h5>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-4">
                    <div class="receipt-left">
                        <button id="pay-button" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;">Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>    
	</div>
</div>

<style type="text/css">
    body{
    background:#eee;
    margin-top:20px;
    }
    .text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #6f42c1;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}
		
		#container {
			background-color: #dcdcdc;
		}
</style>

<script type="text/javascript">

</script>
</body>
</html>
    
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
                    status: '1',
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