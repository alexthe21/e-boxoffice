<?php

namespace At21\EBoxOfficeBundle\Controller;

use PayPal\Exception\PayPalConfigurationException;
use PayPal\Exception\PayPalConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\Common\Persistence\ObjectManager;

class PaymentController extends Controller
{
    protected $container;
    protected $em;

    /**
     * @param Container $container
     * @param ObjectManager $em
     */
    public function __construct($container, $em)
    {
        $this->container = $container;
        $this->em = $em;
    }
    /**
     * @param array $creditCardArray
     * @param array $seats
     *
     * @return string
     */
    public function payAction($creditCardArray, $seats)
    {
        try{
            $sdkConfig = array(
                "mode" => "sandbox"
            );
            $apiContext = $this->container->get('paypal_rest_apicontext');
            $apiContext->getCredential()->updateAccessToken($sdkConfig);
            $creditCard = $this->container->get('paypal_rest_creditcard');
            $creditCard->setType($creditCardArray[0])
                ->setNumber($creditCardArray[1])
                ->setExpireMonth($creditCardArray[3])
                ->setExpireYear($creditCardArray[4])
                ->setCvv2($creditCardArray[2])
                ->setFirstName($creditCardArray[5])
                ->setLastName($creditCardArray[6]);
            /*
            ->setNumber("4929162883651752")
            ->setNumber("4012888888881881")
            */

            $fi = $this->container->get('paypal_rest_fundinginstrument');
            $fi->setCreditCard($creditCard);

            $payer = $this->container->get('paypal_rest_payer');
            $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));
            $itemListArray = [];
            $amountDouble = 0;
            $tax = 0;
            foreach($seats as $s){
                $seat = $this->em->getRepository('At21EBoxOfficeBundle:Seat')->find($s['id']);
                $amountDoubleItem = $seat->getSession()->getPrice();
                $amountDouble += $amountDoubleItem;
                $taxItem = $amountDouble * 0.2;
                $tax += $taxItem;
                $item = clone $this->container->get('paypal_rest_item');
                $item->setName($seat->getId())
                    ->setDescription(
                        $seat->getSession()->getDate()->format('d/m/Y H:i:s') . ' ' .
                        $seat->getSession()->getTheatre()->getName() . ' ' .
                        $seat->getColumnNumber() . ' ' .
                        $seat->getRowNumber()
                    )
                    ->setCurrency('GBP')
                    ->setQuantity(1)
                    ->setTax($taxItem)
                    ->setPrice($amountDoubleItem);

                $itemListArray[] = $item;
            }

            $itemList = $this->container->get('paypal_rest_itemlist');
            $itemList->setItems($itemListArray);

            $details = $this->container->get('paypal_rest_details');
            $details->setTax($tax)
                ->setSubtotal($amountDouble);

            $amount = $this->container->get('paypal_rest_amount');
            $amount->setCurrency("GBP")
                ->setTotal($tax + $amountDouble)
                ->setDetails($details);

            $transaction = $this->container->get('paypal_rest_transaction');
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

            $payment = $this->container->get('paypal_rest_payment');
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

            $payment->create($apiContext);
            return $payment;
        } catch (PayPalConnectionException $e){
            return $e;
        } catch (PayPalConfigurationException $e) {
            return $e;
        }
    }
}