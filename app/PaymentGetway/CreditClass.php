<?php

namespace App\PaymentGetway;

use App\Calculator;
use App\Order;
use Illuminate\Http\Request;
use App\PaymentGetway\PaymentGetwayInterface;

class CreditClass implements PaymentGetwayInterface
{
    public $errorMessage = "حدث خطا اثناء عملية السداد برجاء مراجعة البنك";

    private $fee = [
        'title' => '',
        'amount' => 0
    ];

    public function getFee()
    {
        return false;
    }

    public function pay(Order $order)
    {
        $price = $order->totalPrice;

        if ($price <= 0) {
            $order->paid = 1;
            $order->save();
            return redirect(route('order.complete'));
        }
        // show payment form
        $bankResponse = $this->bankResponse($price, $order);

        if (is_object(json_decode($bankResponse))) {
            $checkoutId = json_decode($bankResponse)->id;
            return redirect()->route('order.creditBankForm', [$order->id, $checkoutId]);
        } else {
            return back()->with('error', $bankResponse);
        }
    }

    public function payCalc(Calculator $calculator)
    {
        $price = $calculator->total_price;

        if ($price <= 0) {
            $calculator->paid = 1;
            $calculator->save();
            return redirect(route('order.complete'));
        }
        // show payment form
        $bankResponse = $this->bankResponse($price, $calculator, 'CALC-');

        if (is_object(json_decode($bankResponse))) {
            $checkoutId = json_decode($bankResponse)->id;
            return redirect()->route('calculator.creditBankForm', [$calculator->id, $checkoutId]);
        } else {
            return back()->with('error', $bankResponse);
        }
    }


    public function bankResponse($price, $order, $prefix = null)
    {
        $url = "https://oppwa.com/v1/checkouts";

        $data = "entityId=8ac9a4ce74b532ef0174b5675af202a5" .
            "&amount=" . $price .
            "&currency=SAR" .
            "&merchantTransactionId=" . $prefix . $order->id .
            "&billing.street1=" . $order->address .
            "&billing.city=" . $order->city .
            "&billing.state=KSA" .
            "&billing.country=SA" .
            "&billing.postcode=" . $order->postcode ?? '11258' .
            "&customer.givenName=" . $order->first_name .
            "&customer.surname=" . $order->last_name .
            "&customer.email=" . $order->email .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer OGFjOWE0Y2U3NGI1MzJlZjAxNzRiNTY2M2JmNTAyOTF8TXpOcDNlUVF4Yw=='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseData = curl_exec($ch);

        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function completePayment($id)
    {
        $url = "https://oppwa.com/v1/checkouts/{$id}/payment";
        $url .= "?entityId=8ac9a4ce74b532ef0174b5675af202a5";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:Bearer OGFjOWE0Y2U3NGI1MzJlZjAxNzRiNTY2M2JmNTAyOTF8TXpOcDNlUVF4Yw=='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        return $responseData;
    }

    public function payment(Request $request)
    {
        $id = $request->id;

        $responseData = $this->completePayment($id);

        $code = json_decode($responseData)->result->code;

        if (preg_match('/^(000\.000\.|000\.100\.1|000\.[36])/', $code) || preg_match('/^(000\.400\.0|000\.400\.100)/', $code)) {
            return true;
        }

        return false;
    }
}
