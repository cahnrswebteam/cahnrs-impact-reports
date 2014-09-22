<?php
require_once("dompdf_config.inc.php");
define('CURRENTURL', 'http://m1.wpdev.cahnrs.wsu.edu/wp-content/plugins/impact-reports');
$html = '
    <html>
<head>
<style type="text/css">
	@page { 
		margin: 5px; 
		font-size: 14px;
		}
	body { 
		margin: 5px; 
		background-image: url('. CURRENTURL.'/dompdf/images/border-black.gif);
		background-repeat: repeat-y;
		background-position: 230px 0;
		font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
		font-size: 14px;
		color: #333;
		}
	.page-break	{ display: block; page-break-before: always; }
	.primary-color {color: #329a4b;}
	.secondary-color {color: #b6bf00;}
	.tertiary-color {color: #6d7377;}
	a {color: #329a4b; text-decoration: none; }
	h1 {
		padding: 15px 0 0 0; margin: 0; text-transform: uppercase; font-size: 30px;  
		font-weight: normal; line-height: 35px;
		}
	h2 {padding: 15px 0 0 0; margin: 0; font-style: italic; font-weight: normal; font-size: 30px; line-height: 35px;}
	h3 {padding: 15px 0 0 0; margin: 0; font-size: 20px; font-weight: normal;}
	h4 {padding: 15px 0 0 0; margin: 0; text-transform: uppercase; font-size: 16px; color: #6d7377;}
	
	div.logo-area,
	div.site-address,
	div.left-column { width: 230px; display: inline-block; word-wrap: break-word;}
	div.logo-area img { width: 220px; height: 188px; margin: 0;}
	div.banner-area,
	div.footer-copy.double-column,
	div.content-column { width: 560px; display: inline-block; padding: 0 0 10px 0;}
	div.banner-area.single-banner img { width: 555px; height: 188px; margin-left: 10px;}
	div.banner-area.double-banner img { width: 272px; height: 188px; margin-left: 10px;}
	div.header {border-bottom: 1px solid #000000;}
	div.footer {
		position: absolute; 
		bottom: 0; left: 0; border-top: 1px solid #000000;}
	div.footer.inner-page {page-break-after: always;}
	div.footer.full-width {background-color: #ffffff;}
	
	div.site-address-inner {margin: 10px 10px 0 0; background-color: #329a4b; padding: 8px; text-align: center;}
	div.site-address-inner a {color: #ffffff; text-decoration: none; font-weight: bold; font-size: 11px;}
	div.footer-copy-inner {color: #555; font-size: 11px; margin: 10px 0 0 10px; text-align: center;}
	div.single-column div.footer-copy-inner {margin: 15px 0 5px 15px; text-align: center;}
	div.footer-copy-inner img {max-width: 285px;}
	
	div.left-column .inner-copy { margin: 0 10px;}
	div.left-column .inner-copy ul { margin: 0; padding: 0 0 0 20px;}
	div.left-column .inner-copy li { padding: 6px 0 6px 0;}
	
	div.content-column .inner-copy {margin: 0 15px 0 15px;}
	div.content-column .inner-copy li {padding-bottom: 6px; padding-top: 6px;}
</style>
</head>
<body>
<!-- ***** START HEADER **** -->
<div class="header">
	<div class="logo-area">
		<img src="http://m1.wpdev.cahnrs.wsu.edu/wp-content/plugins/impact-reports/images/4h-mark.jpg" />
	</div><div class="banner-area single-banner">
		<img src="http://m1.wpdev.cahnrs.wsu.edu/impact-report/4-h-science/un-kids-science/?resized&amp;width=1370&amp;height=450&amp;crop=true" alt="">
	</div>
</div>
<!-- ***** START LEFT COLUMN **** -->
<div class="left-column">
	<div class="inner-copy">
	<h1 class="primary-color">4-H SCIENCE</h1>
	<h3 class="secondary-color">A New Way of Thinking</h3>
	<h4 class="tertiary-color"><span class="indicator secondary-color-bg"></span>BY THE NUMBERS</h4>
	<ul>
<li>4-H Science programs currently in 28 of 39 Washington counties.</li>
<li>1000 faculty, staff, and volunteers participated in STEM training at national, regional, and statewide professional development events.</li>
<li>Over 10,000 4-H Science bookmarks distributed to promote&nbsp;<em>A New Way of Thinking</em>.</li>
<li>In 2013, over 3000 youth in Washington participated in the Maps and Apps experiment.</li>
<li>Since 2010, nearly $700,000 in grant funds, and $15,000 in local gifts received to support STEM-focused programs.</li>
</ul>
	</div>
</div>
<!-- ***** START CENTER COLUMN **** -->
<div class="content-column">
	<div class="inner-copy">
					<h2 class="primary-color">Making an impact in STEM literacy</h2>	
					<h4 class="tertiary-color">Issue</h4>
					<p>America faces a future of intense global competition with a startling shortage of scientists. In 2005, only 18% of U.S. high school seniors were proficient in science (NAEP 2005) and a mere 5% of current U.S. college graduates earned degrees in science, engineering or technology, as compared to 66% in Japan, and 59% in China. By 2011, the National Assessment of Educational Progress (NAEP) reported an increase in science literacy; however, the United States still lags behind its global partners. Literacy in science, technology, engineering and math (STEM) is a prerequisite for young people who face the challenges of our complex world.</p>
					<h4 class="tertiary-color">Response</h4>
					<p>To address the growing demand for STEM professionals, and to increase STEM literacy for youth, Washington State University 4-H has implemented the 4-H Science program:&nbsp;<em>A New Way of Thinking</em>. Objectives include:</p>
<ul>
<li>Increase youth interest, literacy, and engagement in STEM</li>
<li>Increase the number of youth pursuing post-secondary education in STEM</li>
<li>Increase the number of youth pursuing STEM careers</li>
</ul>
<p>While 4-H projects have long been grounded in science, they have not often been framed as science. Faculty, staff, and community partners now encourage a new way of thinking that brings the researched science base of the curriculum to the forefront. Today’s 4-H youth engage in science learning through traditional club experiences, day camps and residential camps, afterschool programs, fairs, conferences, and workshops.</p>
<p>WSU 4-H assembled two teams of “4-H Science Champions,” in Pullman and Seattle, to bring together creative thinking, exploratory questions, and visionary strategies to move 4-H Science forward. The committees, involving WSU and 4-H faculty, researchers, business and community leaders, and STEM professionals, reviewed the target program areas for 4-H Science, prioritized critical needs for STEM, and identified potential partners and strategies to address the needs.</p>
	</div>
</div>
<!-- ***** START FOOTER **** -->
<div class="footer inner-page">
	<div class="site-address">
		<div class="site-address-inner">
			<a href="http://m1.wpdev.cahnrs.wsu.edu/impact-report/">
				http://m1.wpdev.cahnrs.wsu.edu/impact-report/
			</a>
		</div>
	</div><div class="footer-copy double-column">
		<div class="footer-copy-inner">
			For more information, contact&nbsp;<strong>Janet Edwards</strong>, 4-H STEM Specialist, WSU Extension 4-H, SCF 215, PO Box 1495, call: 509-358-7867 or email:&nbsp;<a href="edwardsj@wsu.edu">edwardsj@wsu.edu</a>.
		</div>
	</div>
</div>
<!-- ***** START HEADER **** -->
<div class="header">
	<div class="logo-area">
		<img src="http://m1.wpdev.cahnrs.wsu.edu/impact-report/4-h-science/stem-fan/?resized&amp;width=550&amp;height=450&amp;crop=true" alt="">
	</div><div class="banner-area double-banner">
		<img src="http://m1.wpdev.cahnrs.wsu.edu/impact-report/4-h-science/un-kids-science/?resized&amp;width=1370&amp;height=450&amp;crop=true" alt=""><img src="http://m1.wpdev.cahnrs.wsu.edu/impact-report/4-h-science/un-kids-science/?resized&amp;width=1370&amp;height=450&amp;crop=true" alt="">
	</div>
</div>
<!-- ***** START LEFT COLUMN **** -->
<div class="left-column">
	<div class="inner-copy">
					<h4>Quotes</h4>
					<p><em>“I came into the program with almost zero knowledge of engineering or mechanics and learned a lot from different mentors. I now know how to use computer-aided design programs and different mechanical tools.”</em></p>
<p>On the Robotics competition:<br>
<em>“Getting the pneumatics to work was a problem at the competition. We put out a message to other teams and they came and gave us a hand. These are teams we would be competing with. It’s ‘gracious professionalism.’ It’s about competing, respecting one another, and trying to make sure everyone gets the most out of the experience.”</em></p>
<p>On the Biofuels experiment:<br>
<em>“I enjoyed doing the experiment, recording the results, and making a poster of my findings. I plan on researching more about how to become a chemical engineer after doing this experiment.”</em></p>
					
					<h4>Grants &amp; Donors</h4><ul>
<li>National 4-H Council</li>
<li>Altria and Lockheed Martin</li>
<li>Avista Utilities</li>
<li>Schweitzer Engineering Laboratory</li>
</ul>
	</div>
</div>
<!-- ***** START CENTER COLUMN **** -->
<div class="content-column">
	<div class="inner-copy">
					<h4>Impacts</h4>
					<ul>
<li>WSU 4-H Science has:
<ul>
<li>Raised awareness and changed attitudes about science learning and science careers</li>
<li>Increased science skills and understanding of science concepts</li>
<li>Improved outreach to broader audiences and new partners to engage in STEM programs</li>
</ul>
</li>
<li>4-H Science is implemented in 28 of 39 counties in Washington, with programs in robotics, digital photography, environmental sciences, animal sciences, computer sciences, shooting sports, plant sciences, and engineering and technology.</li>
<li>Over 1000 faculty, staff, and volunteers have participated in STEM professional development training events at the national, regional, and statewide levels. Raising the awareness of 4-H members and leaders that 4-H Science is diverse, and can be included in multiple projects and delivery modes, has been effective in growing the 4-H STEM emphasis.</li>
<li>Since 2010, nearly $700,000 in grant funds and $15000 in local gifts have provided impetus to develop and implement a range of STEM focused programs across the state.</li>
<li>In 2013, over 3000 Washington youth participated in the National Youth Science “Maps and Apps” experiment that explored how geography and geographic information systems (GIS) help people make decisions that respect natural resources.</li>
<li>Sharing opportunities and successes of local 4-H Science programs has increased support and expansion of STEM literacy programs. Over 10,000 4-H Science book- marks have been distributed across the state to market&nbsp;<em>A New Way of Thinking</em>. Feature stories on the WSU 4-H Website and in Extension publications have put 4-H Science in the spotlight.</li>
</ul>
	</div>
</div>
<!-- ***** START FOOTER **** -->
<div class="footer full-width">
		<div class="footer-copy single-column">
			<div class="footer-copy-inner">
					<img src="http://m1.wpdev.cahnrs.wsu.edu/wp-content/plugins/impact-reports/images/4h-wsu-logo.jpg">
	
					<p>For more information about the 4-H Science, Engineering &amp; Technology programs, visit&nbsp;<a href="http://4h.wsu.edu/technology/set.html">http://4h.wsu.edu/technology/set.html</a>.</p>
			</div>
		</div>
</div>
</body>
</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);

$dompdf->render();
$dompdf->stream("hello_world.pdf", array("Attachment" => 0) );

?>