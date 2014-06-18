<div id="selfstudy-content">

	<div id="content-body">
		<section class="title">
			<h4>Edit Course: <?php echo $title ?></h4>
		</section>







		<section class="item">
			<div class="content">

				<div class="tabs">

					<ul class="tab-menu">
						<li><a href="#course-details"><span>Course Details</span></a></li>
						<li><a href="#course-lessons"><span>Course Lessons</span></a></li>
						<li><a href="#repository"><span>Repository</span></a></li>
					</ul>

					<div class="form_inputs" id="course-details">
						<fieldset>
							<ul>
								<li>
									<label for="title"><?php echo lang('selfstudy:title'); ?> <span>*</span></label>
									<div class="input"><?php echo form_input('title', set_value('title', $title), 'class="width-15"'); ?></div>
								</li>
								<li>
									<label for="slug"><?php echo lang('selfstudy:slug'); ?> <span>*</span></label>
									<div class="input"><?php echo form_input('slug', set_value('slug', $slug), 'class="width-15"'); ?></div>
								</li>
								<li>
									<label for="slug"><?php echo lang('selfstudy:description'); ?> <span>*</span></label>
									<div class="input"><?php echo form_input('description', set_value('description', $description), 'class="width-15"'); ?></div>
								</li>
								<li>
									<label for="slug"><?php echo lang('selfstudy:version'); ?> <span>*</span></label>
									<div class="input"><?php echo form_input('version', set_value('version', $version), 'class="width-15"'); ?></div>
								</li>
							</ul>
						</fieldset>
					</div><!-- /.form_inputs -->

					<div class="form_inputs" id="course-lessons">
						<fieldset>
						<div id="lesson-list">
							<ul class="sortable">
								<li id="lesson_1"><div><a href="#" class="live" rel="1">Blah One</a></div></li>
								<li id="lesson_2"><div><a href="#" class="live" rel="2">Blah Two</a></div></li>
							</ul>
						</div>

							<table class="table-list" cellspacing="0">
								<thead>
									<tr>
										<th><?php echo lang('selfstudy:lesson_title') ?></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="collapse">Blah blah</td>
										<td class="actions">
											<a href="" title="<?php echo lang('selfstudy:edit_link_title')?>" class="button"><?php echo lang('selfstudy:edit')?></a>
											<a href="" title="<?php echo lang('selfstudy:depublish_link_title')?>" class="button"><?php echo lang('selfstudy:depublish')?></a>
										</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div><!-- /.form_inputs -->

					<div class="form_inputs" id="repository">
						<fieldset>
							<ul>
								<li><?php echo lang('selfstudy:under_development'); ?></li>
							</ul>
						</fieldset>
					</div><!-- /.form_inputs -->

				</div>

				<div class="buttons align-right padding-top">
					<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
				</div><!-- /.buttons -->

			</div>
		</section>






	</div>

</div>


