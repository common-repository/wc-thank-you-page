<?php

namespace WPTE\ThankYou;

/**
 * The Admin Class Handeler
 */
class Admin {

	/**
	 * Admin constructor.
	 */
	public function __construct() {

		new Admin\Menu();
		new Admin\Notice();
		new Admin\Classes\Class_Wpte_Product();
	}
}