<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerLoundry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'id_customer',
        'name_customer_loundry',
        'spesification_loundry_id',
        'quantity_loundry',
        'result_price_loundry',
        'start_loundry_customer',
        'end_loundry_customer',
        'phone_number_customer_loundry',
        'address_customer_loundry',
        'payment_method_id',
        'status_loundry',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spesificationLoundry()
    {
        return $this->belongsTo(SpesificationLoundry::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
