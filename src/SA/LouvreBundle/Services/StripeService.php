<?php
namespace SA\LouvreBundle\Services;

class StripeService {
    
    public function stripeCheckout($token, $price)
    {
        \Stripe\Stripe::setApiKey("sk_test_bd3aG1UHfzKVP5MLbGfbsL86");
    
        $charge = \Stripe\Charge::create(array(
            "amount" => $price*100, // Amount in cents
            "currency" => "eur",
            "source" => $token,
            "description" => "Paiement louvre"
        ));
        return $charge;
    }
}