<?php

namespace GFPDF\Templates\Config;

use GFPDF\Helper\Helper_Interface_Config;

/**
 * Handles our v3 legacy templates configuration (default-template.php, default-template-two-rows.php and default-template-no-style.php)
 *
 * @package     Gravity PDF
 * @copyright   Copyright (c) 2016, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       4.0
 *
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
    This file is part of Gravity PDF.

    Gravity PDF – Copyright (C) 2016, Blue Liquid Designs

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**
 * The configuration class name should be the same name as the PHP template file name with the following modifications:
 *     The file extension is omitted (.php)
 *     Any hyphens (-) should be replaced with underscores (_)
 *     The class name should be in sentence case (the first character of each word separated by a hyphen (-) or underscore (_) should be uppercase)
 *
 * For instance, a template called core-simple.php or core_simple.php would have a configuration class of "Core_Simple"
 *
 * This naming convention is very important, otherwise the software cannot correctly load the configuration
 *
 * @since 4.0
 */
class Legacy implements Helper_Interface_Config {

	/**
	 * Return the configuration structure.
	 *
	 * The fields key is based on our \GFPDF\Helper\Helper_Abstract_Options Settings API
	 * See the register_settings() method for the exact fields that can be passed in
	 *
	 * @return array The array, split into core components and custom fields
	 *
	 * @since 4.0
	 */
	public function configuration() {
		return array(
			'core' => array(
				'show_page_names'      => true,
				'show_html'            => true,
				'show_section_content' => true,
				'show_empty'           => true,
			),
		);
	}
}
