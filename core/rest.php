<?php
	
	require_once('active.php');

	class Rest
	{
		private $url = '';
		public $method = '';
		private $headers = array(
						    'Accept: application/json',
						    'Content-Type: application/json'
						);
		public $data = '';

		private $handle;

		public $response;

		public $code;

		private $ac;

		function __construct($url, $data)
		{			
			$this->ac=new active();
			$this->url=$url;
			$this->data=$data;

			$this->handle = curl_init();
			curl_setopt($this->handle, CURLOPT_URL, $this->url);
			curl_setopt($this->handle, CURLOPT_HTTPHEADER, $this->headers);
			curl_setopt($this->handle, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($this->handle, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($this->handle, CURLOPT_SSL_VERIFYPEER, false);
		}

		public function get()
		{
			$this->response = curl_exec($this->handle);
			$this->code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);

			$this->ac->limit(2);
			$result=$this->ac->get('usuarios')->json();

			return $result;
		}

		public function post()
		{
			curl_setopt($this->handle, CURLOPT_POST, true);
        	curl_setopt($this->handle, CURLOPT_POSTFIELDS, $this->data);

        	$result=$this->response = curl_exec($this->handle);
			$this->code = curl_getinfo($this->handle, CURLINFO_EFFECTIVE_URL);

			return $result;
		}

		public function put()
		{
			curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'PUT');
        	curl_setopt($this->handle, CURLOPT_POSTFIELDS, $this->data);

			$result=$this->response = curl_exec($this->handle);
			$this->code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);

			return $result;
		}

		public function delete()
		{
			curl_setopt($this->handle, CURLOPT_CUSTOMREQUEST, 'DELETE');

			$result=$this->response = curl_exec($this->handle);
			$this->code = curl_getinfo($this->handle, CURLINFO_HTTP_CODE);

			return $result;
		}
	}
	
	/*$data = json_encode(array(
	    'q'=> 'John'
	));

	$r=new Rest('https://www.google.com', $data);

	echo $r->post();

	var_dump($r->code);*/
?>