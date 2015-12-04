<?php

namespace GFPDF\Helper;

/**
 * Data overloaded Helper Class
 * Cache shared data across the plugin
 *
 * @package     Gravity PDF
 * @copyright   Copyright (c) 2015, Blue Liquid Designs
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       4.0
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
    This file is part of Gravity PDF.

    Gravity PDF Copyright (C) 2015 Blue Liquid Designs

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
 * @since 4.0
 */
class Helper_Data {

	/**
	 * Location for the overloaded data
	 *
	 * @var array
	 *
	 * @since 4.0
	 */
	private $data = array();

	/**
	 * PHP Magic Method __set()
	 * Run when writing data to inaccessible properties
	 *
	 * @param string $name  Name of the peroperty being interacted with
	 * @param mixed  $value Data to assign to the $name property
	 *
	 * @since 4.0
	 */
	public function __set( $name, $value ) {
		$this->data[ $name ] = $value;
	}

	/**
	 * PHP Magic Method __get()
	 * Run when reading data from inaccessible properties
	 *
	 * @param string $name Name of the property being interacted with
	 *
	 * @return mixed        The data assigned to the $name property is returned
	 *
	 * @since 4.0
	 */
	public function &__get( $name ) {
		/* Check if we actually have a key matching what was requested */
		if ( array_key_exists( $name, $this->data ) ) {
			/* key exists, so return */
			return $this->data[ $name ];
		}

		/* Not found so generate error */
		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE );

		/* because we are returning by reference we need return something that can be referenced */
		$value = null;

		return $value;
	}

	/**
	 * PHP Magic Method __isset()
	 * Triggered when isset() or empty() is called on inaccessible properties
	 *
	 * @param  string $name Name of the property being interacted with
	 *
	 * @return boolean       Whether property exists
	 *
	 * @since 4.0
	 */
	public function __isset( $name ) {
		return isset( $this->data[ $name ] );
	}

	/**
	 * PHP Magic Method __isset()
	 * Triggered when unset() is called on inaccessible properties
	 *
	 * @param  string $name Name of the property being interacted with
	 *
	 * @return void
	 *
	 * @since 4.0
	 */
	public function __unset( $name ) {
		unset( $this->data[ $name ] );
	}

	/**
	 * Set up addon array for use tracking active addons
	 *
	 * @since  3.8
	 */
	public function set_addon_details() {
		$this->addon = array();
	}

	/**
	 * Set up any default data that should be stored
	 *
	 * @return void
	 *
	 * @since 3.8
	 */
	public function init() {
		$this->set_plugin_titles();
	}

	/**
	 * Set up our short title, long title and slug used in settings pages
	 *
	 * @return  void
	 *
	 * @since  4.0
	 */
	public function set_plugin_titles() {
		$this->short_title = __( 'PDF', 'gravity-forms-pdf-extended' );
		$this->title       = __( 'Gravity PDF', 'gravity-forms-pdf-extended' );
		$this->slug        = 'pdf';
	}

	/**
	 * A key-value array to be used in a localized script call for our Gravity PDF javascript files
	 *
	 * @param \GFPDF\Helper\Helper_Options       $options
	 * @param \GFPDF\Helper\Helper_Abstract_Form $form
	 *
	 * @return array
	 *
	 * @since  4.0
	 */
	public function get_localised_script_data( Helper_Options $options, Helper_Abstract_Form $form ) {

		$custom_fonts = array_values( $options->get_custom_fonts() );

		return apply_filters( 'gfpdf_localised_script_array', array(
			'ajaxurl'                     => admin_url( 'admin-ajax.php' ),
			'GFbaseUrl'                   => $form->get_plugin_url(),
			'pluginUrl'                   => PDF_PLUGIN_URL,
			'spinnerUrl'                  => admin_url( 'images/spinner-2x.gif' ),
			'spinnerAlt'                  => __( 'Loading...', 'gravity-forms-pdf-extended' ),
			'general_advanced_show'       => __( 'Show Advanced Options...', 'gravity-forms-pdf-extended' ),
			'general_advanced_hide'       => __( 'Hide Advanced Options...', 'gravity-forms-pdf-extended' ),
			'tools_template_copy_confirm' => __( 'Continue', 'gravity-forms-pdf-extended' ),
			'tools_uninstall_confirm'     => __( 'Uninstall', 'gravity-forms-pdf-extended' ),
			'tools_cancel'                => __( 'Cancel', 'gravity-forms-pdf-extended' ),
			'pdf_list_delete_confirm'     => __( 'Delete', 'gravity-forms-pdf-extended' ),
			'active'                      => __( 'Active', 'gravity-forms-pdf-extended' ),
			'inactive'                    => __( 'Inactive', 'gravity-forms-pdf-extended' ),
			'conditionalText'             => __( 'Enable this PDF if', 'gravity-forms-pdf-extended' ),
			'help_search_placeholder'     => __( 'Search the Gravity PDF Knowledgebase...', 'gravity-forms-pdf-extended' ),
			'ajax_error'                  => __( 'There was an error processing your request. Please try again.', 'gravity-forms-pdf-extended' ),
			'update_success'              => __( 'Successfully Updated', 'gravity-forms-pdf-extended' ),
			'delete_success'              => __( 'Successfully Deleted', 'gravity-forms-pdf-extended' ),
			'custom_fonts'                => json_encode( $custom_fonts ),
			'no'                          => __( 'No', 'gravity-forms-pdf-extended' ),
			'yes'                         => __( 'Yes', 'gravity-forms-pdf-extended' ),
			'standard'                    => __( 'Standard', 'gravity-forms-pdf-extended' ),
			'migration_start'             => __( 'Migration site #%s', 'gravity-forms-pdf-extended' ),
			'migration_complete'          => __( 'Site #%s migration complete.', 'gravity-forms-pdf-extended' ),
			'migration_error_specific'    => __( 'Migration Error', 'gravity-forms-pdf-extended' ),
			'migration_error_generic'     => __( 'Site #%s migration errors.', 'gravity-forms-pdf-extended' ),
			'no_pdfs_found'               => __( "This form doesn't have any PDFs.", 'gravity-forms-pdf-extended' ),
			'no_pdfs_found_link'          => __( "Let's go create one", 'gravity-forms-pdf-extended' ),
		) );
	}
}
