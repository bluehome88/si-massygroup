<?php
namespace AwsomeJobPortal\Lib;

class Settings {

	private $months = array(
		'JAN' => 'January',
		'FEB' => 'February',
		'MAR' => 'March',
		'APR' => 'April',
		'MAY' => 'May',
		'JUN' => 'June',
		'JUL' => 'JULY',
		'AUG' => 'August',
		'SEP' => 'September',
		'OCT' => 'October',
		'NOV' => 'November',
		'DEC' => 'December',
	);
	private $days;
	private $years;

	public function get_years(){
		$this->years = range(1990, 2050);

		return $this->years;
	}
	public function get_days(){
		$this->days = range(1, 31);

		return $this->days;
	}

	public function get_months(){
		return $this->months;
	}

	public function month_name($index){
		if ( empty($this->months[$index]) ) {
			return;
		}

		return $this->months[$index];
	}

	public function name($alpha2) {
		if ( empty($this->all_countries[$alpha2]) ) {
			return '';
		}
		return __($this->all_countries[$alpha2], 'wp-country');
	}

	public function countries_list($blank = '') {
		$arr = array();
		if ( $blank ) {
			$arr[''] = $blank;
		}
		return array_merge($arr, $this->all_countries);
	}

	public function dropdown($blank = '', $echo = true, $args = array()) {
		$default_args = array(
			'include' => array(),
			'exclude' => array(),
			'name' => 'country',
			'id' => '',
			'class' => '',
			'selected' => array(),
			'multiple' => false,
		);

		$args = array_merge($default_args, $args);

		foreach ( $args as $key => $value ) {
			if ( !array_key_exists($key, $default_args) ) {
				unset($args[$key]);
			}
		}
		$args = array_merge($default_args, $args);
		$args = apply_filters('wp_country_args', $args);
		extract($args);

		$out = '';
		$arr = array();
		if ( $blank ) {
			$arr[''] = $blank; 
		}

		foreach ($this->all_countries as $alpha2 => $value) {
			if ( $include ) {
				if ( in_array($alpha2, $include) ) {
					$arr[$alpha2] = __($value, 'wp-country');
				}
			}
			elseif ( $exclude ) {
				if ( !in_array($alpha2, $exclude) ) {
					$arr[$alpha2] = __($value, 'wp-country');
				}
			}
			else {
				$arr[$alpha2] = __($value, 'wp-country');
			}
		}
		
		if ($arr) {
			$out .= '<select name="' . $name . ($multiple? '[]" multiple ': '"')
				. ($id ? ' id="' . $id . '" ' : '') . ($class ? ' class="' . $class . '"' : '') . '>';
			foreach ($arr as $key => $value) {
				$out .= '<option value="' . $key. '"' . (in_array($key, $selected) ? ' selected' : '') . '>' . $value . '</option>';
			}
			$out .= '</select>';
		}
		if ($echo) {
			echo $out;
		}
		else {
			return $out;
		}
	}
}
// $wp_country = new WP_Country();
