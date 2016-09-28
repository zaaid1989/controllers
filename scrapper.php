<?php
class Scrapper extends CI_Controller
	{

		public function get_proofs(){
			$output = array('name'=> 'zaaid', 'hobby'=>'cricket');
			$this->response($output, 200);
		}
		
		protected function response($output, $http_code, $content_type = 'application/json')
		{
			$this->output
			 ->set_status_header($http_code)
			 ->set_content_type($content_type, 'utf-8')
			 ->set_output($content_type === 'application/json' ? json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : $output );
		}
	}