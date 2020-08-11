<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require 'C:\xampp\htdocs\midtrans_ci\vendor\midtrans\midtrans-php\Midtrans.php';

use Restserver\Libraries\REST_Controller;

class Produk extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
        $params = array('server_key' => 'SB-Mid-server-IZ4SpVcYVxSaLlzp3xhsiVHw', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }


    //Menampilkan welcome message
    function index_post() {
        $message = "welcome to checkout API";
        $checkout = array (
            'customer_name' => $this->post('customer_name'),
            'customer_email' => $this->post('customer_email'),
            'customer_phone' => $this->post('customer_phone'),
            'total_price' => floatval($this->post('total_price')),
            'product_description' => $this->post('product_description'),
        );

        $transaction_details = array(
            'order_id'      => rand(),
            'total price'  => floatval($this->post('total_price')),
        );
        // Optional
        $item_details = array (
                'id'       => rand(),
                        'price'    => floatval($this->post('total_price')),
                        'quantity' => 1,
                        'name'     => $this->post('product_description'),
          );
        // Optional
        $customer_details = array(
            'first_name'    => $this->post('customer_name'),
                    'email'         =>  $this->post('customer_email'),
                    'phone'         =>  $this->post('customer_phone'),
        );
        // Fill transaction details
        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
        );
        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $snapToken =  $this->midtrans->getSnapToken($transaction);	
        $this->response($snapToken, 200);
    }

}

?>