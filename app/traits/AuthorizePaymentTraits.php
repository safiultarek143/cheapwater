<?php
namespace App\Traits;

use App\Models\Payment;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

trait AuthorizePaymentTraits{
    public function chargeCreditCard($card_number, $cvv_code, $expiration_date, $amount)
    {

        // Common setup for API credentials
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName(config('services.authorize.user'));
        $merchantAuthentication->setTransactionKey(config('services.authorize.key'));

        $refId = 'ref'.time();
        // Create the payment data for a credit card
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_number);
        $creditCard->setCardCode($cvv_code);
        // $creditCard->setExpirationDate( "2038-12");
        $creditCard->setExpirationDate($expiration_date);
        $paymentOne = new AnetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);
        // Create a transaction
        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        // $transactionRequestType->setAmount('60');
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setPayment($paymentOne);
        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if ($response != null)
        {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode()=="1"))
            {
                return [
                    'success' => true,
                    'transaction_id' => $tresponse->getTransId(),
                    'payment_status' => Payment::PAYMENT_PAID
                ];
            }elseif (($tresponse != null) && ($tresponse->getResponseCode()=="4")){
                return [
                    'success' => true,
                    'transaction_id' => $tresponse->getTransId(),
                    'payment_status' => Payment::PAYMENT_PENDING
                ];
            }
            else
            {
            // $tresponse = $response->getTransactionResponse();

            // if ($tresponse != null && $tresponse->getErrors() != null) {
            //     echo " Error Code  : " . $tresponse->getErrors()[0]->getErrorCode() . "\n";
            //     echo " Error Message : " . $tresponse->getErrors()[0]->getErrorText() . "\n";
            // } else {
            //     echo " Error Code  : " . $response->getMessages()->getMessage()[0]->getCode() . "\n";
            //     echo " Error Message : " . $response->getMessages()->getMessage()[0]->getText() . "\n";
            // }
                return [
                    'success' => false,
                ];
            }
        }
        else
        {
            return [
                'success' => false
            ];
        }
    }
}
