<?php namespace cahnrswp\publications\impact_reports;

class helptab_control {


	public function __construct() {

		\add_action( 'admin_head', array( $this, 'help_tab' ) );

	}


	public function help_tab() {

		$screen = \get_current_screen();

		if ( $screen->post_type == 'impact' ) {

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_overview',
				'title'	  => 'About',
				'content' => '<p>Impact reports are concise reports on research, teaching, and engagement from CAHNRS and WSU Extension programs. Each report has three main text sections: 1) <strong>Issue</strong> describes the problem and why the work was undertaken; 2) <strong>Response</strong> describes what was done to address the issue (outputs); and 3) <strong>Impacts</strong> documents the actual outcomes, such as changes in knowledge, or actions and condition of participants or a community. (See below for further descriptions of each section.)</p><p>The image below shows how your content will be organized on a finished report (<span style="color:#c7aa5b;">yellow</span> denotes optional components).</p><p style="text-align:center;"><img src ="' . URL . 'images/layout.png" height="345" width"525" /></p><p>(Word counts per section: Issue + Response, page 1 = 300; Impacts, page 2 = 300. Note, fewer words will fit if material is in bulleted lists.)</p><p>Please click the tabs to the left for descriptions and examples of each component of an impact report. For additional support, please contact the Impact Reports editor, Alycia Rock (<a href="mailto:alycia.rock@wsu.edu">alycia.rock@wsu.edu</a>).</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_logos',
				'title'	  => 'Logo',
				'content' => '<p>The selected <em>Program</em> determines the logo in the top left corner of the first page.</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_images',
				'title'	  => 'Images',
				'content' => '<p>Each impact report can feature four images, with the option for one additional image. All images must meet minimum size requirements in order to produce high-quality print results. Images that are not proportional to the required dimensions may be used, but will be automatically cropped, which may yield undesirable results in some cases.</p><p>Front Page</p><p style="padding-left:30px;">The <em>Featured Image</em> is displayed next to the logo at the top of the front page, and should be at least 1370 × 450 pixels (wide × tall).</p><p style="padding-left:30px;">The <em>Bottom Left Column Image</em> is optional. It should be at least 550 pixels wide. There is no height restriction, but note that using an image here will limit the amount of space that is available for “By the Numbers” text, above it.</p><p>Back Page</p><p style="padding-left:30px;">The <em>First Banner Image</em> should be at least 550 × 450 pixels (wide × tall).</p><p style="padding-left:30px;">Both the <em>Second Banner Image</em> and <em>Third Banner Image</em> should be at least 677 × 450 pixels (wide × tall).</p><p><strong>Images that do not meet the minimum size requirements will not display.</strong></p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_issue',
				'title'	  => 'Issue',
				'content' => '<p>The <em>Issue</em> section describes the context, conditions, and problems that existed and prompted initiation of the project.<br />(Target word count: 150)</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_response',
				'title'	  => 'Response',
				'content' => '<p>The <em>Response</em> section describes the work done in response to the issue. This may include grant funds sought and secured; partnerships developed; workshops organized and delivered; publications, web sites, decision tools and other media created, etc.<br />(Target word count: 150)</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_impact',
				'title'	  => 'Impacts',
				'content' => '<p>The <em>Impacts</em> section outlines the actual documented effects of the project. These are also referred to as outcomes and include short term changes in knowledge or awareness (learning), intermediate term changes in practice (adoption), and long term changes in conditions (economic, environmental or social).<br />(Target word count: 300)</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_numbers',
				'title'	  => 'By the Numbers',
				'content' => '<p>The <em>By the Numbers</em> section shows quantitative results of the project such as number of participants, grant dollars, workshops, resources affected (acres, miles of stream, etc.), and other outputs.<br />(Target word count: 120)</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_quotes',
				'title'	  => 'Quotes',
				'content' => '<p>The <em>Quotes</em> section highlights supporting testimony of the project. These can be direct quotes from participants via surveys or other evaluation instruments, or paraphrased statements from project leaders.<br />(Target word count: 120)</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_additional',
				'title'	  => 'Additional',
				'content' => '<p>The <em>Additional</em> section is optional. It is for any further information and acknowledgments, such as funding partners, grants, donors, etc., as space allows.</p>',
			) );

			$screen->add_help_tab( array(
				'id'			=> 'impact_report_footers',
				'title'	  => 'Footers',
				'content' => '<p>The <em>Front Page Footer</em> is for listing contact information of the unit leader. The <em>Back Page Footer</em> is for contact information for the program.</p>',
			) );

		}

	}

}
?>