<?php
/*
 * Copyright 2011 <http://voidweb.com>.
 * Author: Deepesh Malviya <https://github.com/deepeshmalviya>.
 * 
 * Simple-REST - Lightweight PHP REST Library
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License. 
 */

/**
 * Class implements RESTfulness
 */


/**
 * Abstract Controller
 * To be extended by every controller in application
 */
abstract class RestController {
	protected $request;
	protected $response;
	protected $responseStatus;

	public function __construct($request) {
		$this->request = $request;		
	}

	final public function getResponseStatus() {
		return $this->responseStatus;
	}

	final public function getResponse() {
		return $this->response;
	}

	public function checkAuth() {
		return true;
	}

	// @codeCoverageIgnoreStart
	abstract public function get();
	abstract public function post();
	abstract public function put();
	abstract public function delete();
	// @codeCoverageIgnoreEnd
	
}
