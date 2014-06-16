<div id="selfstudy-content">

	<h1><?php echo htmlspecialchars( lang('selfstudy:available_courses')) ?></h2>

	<?php if( empty($data_published_courses) ): ?>

		<p><?php echo htmlspecialchars( lang('selfstudy:no_courses_found') ) ?></p>
	
	<?php else: ?>

		<p><?php echo htmlspecialchars( lang('selfstudy:available_course_intro')); ?></p>

		<ul>
			<?php foreach($data_published_courses as $data): ?>
				<li><a href="<?php echo $uri_base . $data['slug'] ?>"><?php echo htmlspecialchars( $data['title'] ) ?></a></li>
			<?php endforeach; ?>
		</ul>

	<?php endif ?>

</div>