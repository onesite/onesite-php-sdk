<?php
/**
 * Copyright 2012 ONESite, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
 
/**
 * DAO for a session object from ONEsite.
 *
 * @author  Mike Benshoof <mbenshoof@onesite.com>
 */
class onesite_sdk_dao_session extends onesite_sdk_dao
{
	/**
	 * Define the public properties here.
	 *
	 * @return void
	 */
	protected function init()
	{
		// The public field mapping to the local properties.
		$this->_public_fields = array(
			'coreU'   => 'core_u',
			'coreX'   => 'core_x',
			'ip'      => 'remote_ip',
			'agent'   => 'agent',
			'expires' => 'session_expires',
			'data'    => 'session_data',
			'state'   => 'session_state_string',
			'user'    => 'user',
		);
		
		$this->_properties['user'] = null;
	}
	
	/**
	 * Check to make sure the session state isn't invalid.
	 *
	 * @return boolean
	 */
	public function isValid()
	{
		// The invalid session states.		
		$invalid = array(
				'missing',
				'security-hash-error',
				'invalid-ip',
				'invalid-expired'			
			);
		
		// Is session no longer valid?
		if (in_array($this->state, $invalid)) {
			return false;
		}
		
		return true;
	}
	
	/**
	 * Check if this session is anonymous.
	 *
	 * @return boolean
	 */
	public function isAnonymous()
	{
		if ($this->state == "anonymous") {
			return true;
		} else {
			return false;
		}
	}
}
