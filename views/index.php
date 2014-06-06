<div id="selfstudy-content">

	{{ if ! list }}
	<p>{{ helper:lang line="selfstudy:no_courses_found" }}</p>
	
	{{ else }}
	<ul>
		{{ list }}
		<li>{{ title }}</li>
		{{ /list }}
	</ul>

	{{ endif }}

</div>