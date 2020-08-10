<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Produk extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }


    //Menampilkan welcome message
    function index_get() {
        $message = "welcome to checkout API";
        $this->response($message, 200);
    }

    function index_post() {
     
        $data = array(
                    'id'           => $this->post('id'),
                    'nama_produk'          => $this->post('nama_produk'),
                    'tipe_produk'    => $this->post('tipe_produk'),
                    'harga'    => $this->post('harga'),
                    'stok'    => $this->post('stok'));
                    // Required
		$transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => 95000, // no decimal allowed for creditcard
          );
        //   $snapToken = $this->midtrans->getSnapToken($data);
		// error_log($snapToken);
		// echo $snapToken;
        $insert = $this->db->insert('produk', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

?>