<?php
class SP_Framework_User_Utility{

	static public function get_list($data = null){
		$result = array();

		if($data){

			//default value
			$values = array(
				'role'         => '',
				'role__in'     => array(),
				'role__not_in' => array(),
				'meta_key'     => '',
				'meta_value'   => '',
				'meta_compare' => '',
				'meta_query'   => array(),
				'include'      => array(),
				'exclude'      => array(),
				'orderby'      => 'login',
				'order'        => 'ASC',
				'offset'       => '',
				'search'       => '',
				'number'       => '',
				'paged'        => 1,
				'count_total'  => false,
				'fields'       => 'all',
				'who'          => '',
				'date_query'   => array()
			); 

			//set custom value
			foreach ($values as $key => $value) {
				if (array_key_exists($key, $data)) {
					$values[$key] = $data[$key];
				}
			}

			//args array
			$args = array(
				'role'         => $values['role'],
				'role__in'     => $values['role__in'],
				'role__not_in' => $values['role__not_in'],
				'meta_key'     => $values['meta_key'],
				'meta_value'   => $values['meta_value'],
				'meta_compare' => $values['meta_compare'],
				'meta_query'   => $values['meta_query'],
				'include'      => $values['include'],
				'exclude'      => $values['exclude'],
				'orderby'      => $values['orderby'],
				'order'        => $values['order'],
				'offset'       => $values['offset'],
				'search'       => $values['search'],
				'number'       => $values['number'],
				'paged'        => $values['paged'],
				'count_total'  => $values['count_total'],
				'fields'       => $values['fields'],
				'who'          => $values['who'],
				'date_query'   => $values['date_query']
			);

			$users = get_users($args);

			if(!empty($users)){
				$index = 0;

				foreach ($users as $user) {

					$index++;
					$userID = $user->ID;

					//data
					$result[$userID]['cnt'] 		= $index;
					$result[$userID]['id'] 			= $userID;
					$result[$userID]['login'] 		= $user->user_login;
					$result[$userID]['nicename'] 	= $user->user_nicename;
					$result[$userID]['email'] 		= $user->user_email;
					$result[$userID]['url'] 		= $user->user_url;
					$result[$userID]['registered'] 	= $user->user_registered;
					$result[$userID]['status'] 		= $user->user_status;
					$result[$userID]['name'] 		= $user->display_name;
				}
			}
		}

		return $result;
	}

	static public function get_meta($id, $name){
		if($id && $name){
			$name = 'sp_'.$name;
			$value = get_the_author_meta($name, $id);
		} else {
			$value = '';
		}	

		return $value;
	}

	static public function update_meta($id, $name, $value){
		if($id && $name && $value){
			$name = 'sp_'.$name;
			update_user_meta($id, $name, $value);
		}	
	}

}