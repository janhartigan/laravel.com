<?php echo View::make('partials.header')->with('title', $title)->render(); ?>
<div class="mid-content">
	<div class="container main">
		<div class="row">
			<div id="docs-sidebar" class="sidebar docs span3 <?php echo $section ?>">
				<form method="get" action="http://www.google.com/search">
					<input type="hidden" name="as_sitesearch" id="as_sitesearch" value="laravel.com/docs/">
					<input type="search" results="5" name="q" id="q" autosave="laraveldocs" placeholder="Search the documentation">
				</form>
				<ul class="toc">
					<li><a href="/docs/toc">Table of Contents</a></li>
				</ul>
			</div>
			<div class="content docs span9">
				<div class="well">

					<?php echo $content; ?>

				</div>
			</div>
		</div>
	</div>
</div>

<?php echo View::make('partials.footer')->render(); ?>