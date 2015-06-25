<?php

/**
 * Template Name: Simple Structure
 * Version: 1.0
 * Description: The default template for Gravity PDF 4.x+
 * Author: Gravity PDF
 * Group: Core
 * License: GPLv2
 * Required PDF Version: 4.0
 */

/* Prevent direct access to the template */
if(! class_exists('GFForms') ) {
   return;
}

/**
 * All Gravity PDF 4.x templates have access to the following variables:
 *
 * $form (The current Gravity Form array)
 * $entry (The raw entry data)
 * $lead (alias of $entry)
 * $form_data (The processed entry data stored in an array)
 * $settings (the current PDF configuration)
 *
 * The following variables are avaliable for backwards compatibility purposes:
 *
 * $form_id (the current form ID)
 * $lead_ids (an array of the selected entries)
 * $lead_id (the current entry ID)
 *
 * To see the variable structure add "var_dump($variable); exit;" to your PDF template and view in your browser
 *
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>Gravity PDF</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<style>
		@page {
			margin: 10mm;
		}

		body {
			font-family: Dejavu Sans, sans-serif;
			font-size: 9pt;
			color: #333;
		}

		/* Handle Gravity Forms CSS Ready Classes */
		.row-separator {
			clear: both;
			padding: 1.25mm 0;
			/*border-bottom: 1px solid #CCC;*/
		}

		.gf_left_half,
		.gf_left_third, .gf_middle_third,
		.gf_list_2col li, .gf_list_3col li, .gf_list_4col li, .gf_list_5col li {
			float: left;
		}

		.gf_right_half,
		.gf_right_third {
			float: right;
		}

		.gf_left_half, .gf_right_half,
		.gf_list_2col li {
			width: 49%;
		}

		.gf_left_third, .gf_middle_third, .gf_right_third,
		.gf_list_3col li {
			width: 32.33%;
		}

		.gf_list_4col li {
			width: 24%;
		}

		.gf_list_5col li {
			width: 19%;
		}

		.gf_left_half, .gf_right_half {
			padding-right: 1%;
		}

		.gf_left_third, .gf_middle_third, .gf_right_third {
			padding-right: 1.505%;
		}

		.gf_right_half, .gf_right_third {
			padding-right: 0;
		}

		/* Don't double float the list items if already floated (mPDF does not support this ) */
		.gf_left_half li, .gf_right_half li,
		.gf_left_third li, .gf_middle_third li, .gf_right_third li {
			width: 100% !important;
			float: none !important;
		}

		/**
		 * Headings
		 */
		h3 {
			margin: 1.5mm 0 0.5mm;
			padding: 0;
		}

		/**
		 * Quiz Style Support
		 */
		.gquiz-field {
		    color: #666;
		}

		.gquiz-correct-choice {
		    font-weight: bold;
		    color: black;
		}

		.gf-quiz-img {
		    padding-left: 5px !important;
		    vertical-align: middle;
		}

		/**
		 * Survey Style Support
		 */
		.gsurvey-likert-choice-label {
		    padding: 4px;
		}

		.gsurvey-likert-choice {
		    text-align: center;
		}

		/**
		 * Table Support
		 */
		table {
			width: 100%;
			border-collapse: collapse;
			page-break-inside: avoid;
		}

		th, td {
			font-size: 9pt;
		}

		/**
		 * List Support
		 */
		ul, ol {
			margin: 0;
			padding-left: 1mm;
		}

		li {
			margin: 0;
			padding: 0;
			list-style-position: inside;
		}

		/**
		 * Independant Template Styles
		 */
		.gfpdf-field .label {
			text-transform: uppercase;
			font-size: 8pt;
		}

		.gfpdf-field .value {
			border: 1px solid #CCC;
			padding: 1.5mm 2mm;
		}
		
	</style>

</head>
	<body>
		<?php
			/**
			 * Set up our configuration array to control what is and is not generated
			 * @var array
			 */
			$config = array(
				'settings' 	=> $settings,
				'meta' 		=> array(
					'echo'                => true,
					'exclude'             => true, /* whether we should exclude fields with a CSS value of 'exclude'. Default to true */
					'empty'               => false, /* whether to show empty fields or not. Default is false */
					'hidden'              => true, /* whether we should skip fields hidden with conditional logic. Default to true. */
					'show_title'          => true, /* whether we should show the form title. Default to true */
					'section_content'     => false, /* whether we should include a section breaks content. Default to false */
					'page_names'          => false, /* whether we should show the form's page names. Default to false */
					'html_field'          => false, /* whether we should show the form's html fields. Default to false */
					'individual_products' => false, /* Whether to show individual fields in the entry. Default to false - they are grouped together at the end of the form */
				)
			);

			/**
			 * Generate our HTML markup
			 *
			 * To keep it simplier for users, the PDF template files are in PHP's global namespace
			 * which means you have easy access to all PHP and WordPress' core classes.
			 *
			 * If however you want to access any Gravity PDF classes you'll need to use its
			 * full namespace (as we have done below)
			 *
			 */
			$pdf = new GFPDF\View\View_PDF;
			$pdf->process_html_structure($entry, $config);
		?>
	</body>
</html>