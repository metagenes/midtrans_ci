<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
require 'C:\xampp\htdocs\midtrans_ci\vendor\midtrans\midtrans-php\Midtrans.php';
use Restserver\Libraries\REST_Controller;
use Midtrans\Libraries\Midtrans;

class Snap extends REST_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct($config = 'rest')
    {
		parent::__construct($config);
		$this->load->database();
        $params = array('server_key' => 'SB-Mid-server-IZ4SpVcYVxSaLlzp3xhsiVHw', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index_get()
    {
    	$message = "welcome to checkout API";
			// Required
			// $transaction_details = array(
			//   'order_id' => rand(),
			//   'gross_amount' => 94000, // no decimal allowed for creditcard
			// );
			// // Data yang akan dikirim untuk request redirect_url.
			// $credit_card['secure'] = true;
			// //ser save_card true to enable oneclick or 2click
			// //$credit_card['save_card'] = true;
			// $transaction_data = array(
			// 	'transaction_details'=> $transaction_details,
			// );
			// $snapToken =  $this->midtrans->getSnapToken($transaction_data);	
			$this->response($message, 200);
	}
	
	public function index_post()
    {
    	$message = "welcome to checkout API";
			// Required
			$transaction_details = array(
			  'order_id' => rand(),
			  
			
			  'gross_amount' => $this->post('total_price'), // no decimal allowed for creditcard

			);

			$customer_details = array(
			  'first_name' => $this->post('customer_name'),
			  'email' => $this->post('customer_email'),
			  'phone' => $this->post('customer_phone'),
			);

			$item_details = array(
				'name' => $this->post('product_description'),
				'quantity' => 1,
				'price' => $this->post('total_price'), 
			);
			// Data yang akan dikirim untuk request redirect_url.
			$credit_card['secure'] = true;
			//ser save_card true to enable oneclick or 2click
			//$credit_card['save_card'] = true;
			$transaction_data = array(
				'transaction_details'=> $transaction_details,
				'customer_details' => $customer_details,
				'item_details' => $item_details,
			);
			$snapToken =  $this->midtrans->getSnapToken($transaction_data);	
			$transaction_data = $this->response($transaction_data);
			$link_token=$this->response($snapToken);
			echo $link_token;
			echo $transaction_data;
	}
	
}
?>