<div id="selfstudy-content">

	<div id="content-body">
		<section class="title">
			<h4><?php
			if( $title )
			{
				echo 'Edit Course: ' . $title;
			}
			else
			{
				echo 'New Course';
			}
			?></h4>
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
									<div class="input"><?php echo site_url() . 'selfstudy/ '. form_input('slug', set_value('slug', $slug), 'class="width-15 disabled"'); ?></div>
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
							<table class="table-list" cellspacing="0">
								<thead>
									<tr>
										<th></th>
										<th><?php echo lang('selfstudy:lesson_title') ?></th>
										<th class="actions"><a href="" title="<?php echo lang('selfstudy:edit_link_title')?>" class="button">+ New Lesson</a></th>
									</tr>
								</thead>
								<tbody class="ui-sortable">
									<?php foreach($data_lessons as $data): ?>
										<tr>
											<td width="30" class="handle"><img alt="Drag Handle" src="http://pyro.douglasburchard.com/system/cms/themes/pyrocms/img/icons/drag_handle.gif" /></td>
											<td class="collapse"><input type="hidden" name="action_to[]" value="1" /><?php echo $data['title'] ?></td>
											<td class="actions">
												<a href="" title="<?php echo lang('selfstudy:edit_link_title')?>" class="button"><?php echo lang('selfstudy:edit')?></a>
												<a href="" title="<?php echo lang('selfstudy:depublish_link_title')?>" class="button confirm"><?php echo lang('selfstudy:delete')?></a>
											</td>
										</tr>
									<?php endforeach; ?>
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


