<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'user/complete-order', 
        'user/complete-order/*', 
        'get/ssl-response', 
        'invoice/*', 
        '/user/recharge-wallet', 
        '/user/recharge-wallet/*', 
        'paystack/initialize', 
        'paytm/success*', 
        'user/complete-recharge', 
        'user/complete-recharge*',
        'my-wallet', 
        'payment', 
        'seller/complete-purchase',
        'whatsapp/webhook/*',
        'telegram/webhook/*',
        'messenger/webhook/*',
        'client/flow-builder-next-step',
        'client/razor_pay-success',
        'sms/dlr/*',
        'sms/inbound/*',
    ];


}
