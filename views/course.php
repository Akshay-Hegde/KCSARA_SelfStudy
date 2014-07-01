<div id="selfstudy-content">

	<header>
		<h1><?php echo $data_course[0]['course_title'] ?></h1>
	</header>

	<div id="toc">
		<h2>Self Study</h2>
		<ol>
			<?php foreach($data_course as $data): ?>
				<li><a href="<?php echo '/' . $uri_base . $data['course_slug'] . '/' . $data['lesson_slug'] ?>"><?php echo htmlspecialchars( $data['lesson_title'] ) ?></a></li>
			<?php endforeach; ?>
		</ol>
	</div>

	<div>
		<?php if( $data_lesson === NULL ): ?>
			<h1><?php echo "Oops! We're Sorry." ?></h1>
			<p><?php echo "There isn't a lesson by that title in this course." ?></p>
		<?php else: ?>
			<?php echo $data_lesson['lesson_html'] ?>
		<?php endif ?>
	</div>

</div>