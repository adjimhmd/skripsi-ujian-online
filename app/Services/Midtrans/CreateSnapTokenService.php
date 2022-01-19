<?php
 
namespace App\Services\Midtrans;
 
use Midtrans\Snap;
 
class CreateSnapTokenService extends Midtrans
{
    protected $order;
 
    public function __construct($order)
    {
        parent::__construct();
 
        $this->order = $order;
    }
 
    public function getSnapToken()
    {
        $params = [
            'transaction_details' => [
                // 'order_id' => '2',
                // 'gross_amount' => '20000',
                'order_id' => 'midtrans_'.$this->order->id_rombel,
                'gross_amount' => $this->order->harga,
            ],
            'item_details' => [
                [
                    'id' => $this->order->kelas_program_id,
                    'price' => $this->order->harga,
                    'quantity' => 1,
                    'name' => $this->order->deskripsi,
                ],
            ],
            'customer_details' => [
                'first_name' => $this->order->name,
                'email' => $this->order->email,
                'phone' => $this->order->no_telp,
            ]
        ];
 
        $snapToken = Snap::getSnapToken($params);
 
        return $snapToken;
    }
}