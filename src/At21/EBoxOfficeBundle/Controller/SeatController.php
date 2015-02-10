<?php

namespace At21\EBoxOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use PayPal\Exception\PayPalConnectionException;

class SeatController extends Controller
{

    /**
     * @param Request $request
     *
     * @return OptimisticLockException| PayPalConnectionException | Response
     */
    public function confirmAndPayAction(Request $request)
    {
        $em = $this->getDoctrine()
            ->getManager();
        $seats = $request->request->get('seats');
        $entitySeats = array();
        $userId = $seats[0]['user'];
        $amount = 0;
        try {
            $user = $em->getRepository('At21EBoxOfficeBundle:User')->find($userId);
            foreach ($seats as $s){
                $seat = $em->find('At21EBoxOfficeBundle:Seat', $s['id'], LockMode::OPTIMISTIC, $s['version']);
                $seat->setUser($user);
                $amount += intval($s['price']);
                $entitySeats[] = $seat;
                $em->persist($seat);
            }
            $sdkConfig = array(
                "mode" => "sandbox"
            );
            $apiContext = $this->get('paypal_rest_apicontext');
            $apiContext->getCredential()->updateAccessToken($sdkConfig);
            $creditCard = $this->get('paypal_rest_creditcard');
            $creditCard->setType("visa")
                /*->setNumber("4929162883651752")*/
                ->setNumber("4012888888881881")
                ->setExpireMonth("11")
                ->setExpireYear("2019")
                ->setCvv2("012")
                ->setFirstName("Joe")
                ->setLastName("Shopper");

            $fi = $this->get('paypal_rest_fundinginstrument');
            $fi->setCreditCard($creditCard);

            $payer = $this->get('paypal_rest_payer');
            $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments(array($fi));

            $item1 = clone $this->get('paypal_rest_item');
            $item1->setName('Ground Coffee 40 oz')
                ->setDescription('Ground Coffee 40 oz')
                ->setCurrency('GBP')
                ->setQuantity(1)
                ->setTax(0.3)
                ->setPrice(7.50);

            $item2 = clone $this->get('paypal_rest_item');
            $item2->setName('Granola bars')
                ->setDescription('Granola Bars with Peanuts')
                ->setCurrency('GBP')
                ->setQuantity(5)
                ->setTax(0.2)
                ->setPrice(2.00);

            $itemList = $this->get('paypal_rest_itemlist');
            $itemList->setItems(array($item1, $item2));

            $details = $this->get('paypal_rest_details');
            $details->setShipping(1.2)
                ->setTax(1.3)
                ->setSubtotal(17.5);

            $amount = $this->get('paypal_rest_amount');
            $amount->setCurrency("GBP")
                ->setTotal(20.00)
                ->setDetails($details);

            $transaction = $this->get('paypal_rest_transaction');
            $transaction->setAmount($amount)
                ->setItemList($itemList)
                ->setDescription("Payment description")
                ->setInvoiceNumber(uniqid());

            $payment = $this->get('paypal_rest_payment');
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));

            $request = clone $payment;

            $payment->create($apiContext);
            $em->flush();
        } catch(OptimisticLockException $e) {
            return new Response($e->getMessage());
        } catch (PayPalConnectionException $ex) {
            return new Response($ex->getMessage(). $ex->getData());
        }
        return new Response($request);
    }
}