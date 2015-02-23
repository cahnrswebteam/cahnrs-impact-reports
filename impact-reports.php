<?php namespace cahnrswp\publications\impact_reports;
/**
 * Plugin Name: Impact Reports
 * Plugin URI:  http://cahnrs.wsu.edu/communications/2014/05/30/impact-reports/
 * Description: Web-first publications with an option to generate PDFs for printing
 * Version:     0.1
 * Author:      CAHNRS Communications
 * Author URI:  http://cahnrs.wsu.edu/communications/
 * License:     Copyright Washington State University
 * License URI: http://copyright.wsu.edu
 */

class impact_report {

	public function __construct() {

		$this->define_constants(); // YEP, THAT'S WHAT IT DOES
		$this->init_autoload(); // ACTIVATE CUSTOM AUTOLOADER FOR CLASSES

	}

	public function plugin() {

		$init_taxonomies = new taxonomies_control(); // REGISTER CUSTOM TAXONOMIES
		$init_posttypes = new posttype_control(); // REGISTER CUSTOM POST TYPE
		$init_scripts = new scripts_control(); // ENQUEUE SCRIPTS AND STYLES
		$init_templates = new template_control(); // LOAD CUSTOM TEMPLATES
		$init_widgets = new widget_control(); // REGISTER WIDGET AREA
		$init_editor = new editor_control(); // TINYMCE PLUGIN HANDLING
		$init_pdf = new pdf_converter_control(); // ADDS PDF FUNCTIONALITY
		$init_draft_visibility = new draft_visibility_control(); // Make drafts viewable

		if ( \is_admin() ) {
			$init_helptab = new helptab_control(); // CONTEXTUAL HELP
			$init_image = new image_control(); // ADD HELP TEXT TO THE FEATURED IMAGE BLOCK
			$init_metabox = new metabox_control(); // CUSTOM METABOXES
		}

	}

	private function define_constants() {
		define( __NAMESPACE__ . '\URL', plugin_dir_url( __FILE__ ) ); // PLUGIN BASE URL
		define( __NAMESPACE__ . '\DIR', plugin_dir_path( __FILE__ ) ); // DIRECTORY PATH
	}

	private function init_autoload() {
		require_once 'controls/autoload_control.php'; //REQUIRE AUTOLOADER CONTROL - MAKES IT MORE PORTABLE
		$autoload = new autoload_control(); // INIT AUTOLOADER SO WE DON'T HAVE TO USE REQUIRE ANY MORE
	}

}

$init_plugin = new impact_report();

$init_plugin->plugin();
?>