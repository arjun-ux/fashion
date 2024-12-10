<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{
   protected $fillable = [
       'customer_name',
       'product_id',
       'product_name', 
       'quantity',
       'price',
       'total_price',
       'payment_status'
   ];

   public function produk()
   {
       return $this->belongsTo(Produk::class, 'product_id');
   }
}