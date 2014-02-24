<?php
	/**
	* 
	*/
	class Array2XML
	{
		
		static function generate_xml_from_array($array, $node_name) {
			$xml = '';

			if (is_array($array) || is_object($array)) {
				foreach ($array as $key=>$value) {
					if (is_numeric($key)) {
						$key = $node_name;
					}

					$xml .= '<' . $key . '>' . "\n" . Array2XML::generate_xml_from_array($value, $node_name) . '</' . $key . '>' . "\n";
				}
			} else {
				$xml = htmlspecialchars($array, ENT_QUOTES) . "\n";
			}

			return $xml;
		}

		static function generate($array, $node_block='tabla', $node_name='campo') {
			$xml = '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";

			$xml .= '<' . $node_block . '>' . "\n";
			$xml .= Array2XML::generate_xml_from_array($array, $node_name);
			$xml .= '</' . $node_block . '>' . "\n";

			return $xml;
		}
	}
?>