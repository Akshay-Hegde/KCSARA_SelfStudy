<div id="selfstudy-content">

	<?php if( ! empty($data_published_courses) ): ?>

		<div class="one_full">
			<section class="title">
				<h4><?php echo lang('selfstudy:published_courses') ?></h4>
			</section>

			<section class="item">
				<div class="content">
					<table class="table-list" cellspacing="0">
						<thead>
							<tr>
								<th><?php echo lang('selfstudy:title') ?></th>
								<th class="collapse"><span><?php echo lang('selfstudy:description') ?></span></th>
								<th><?php echo lang('selfstudy:version') ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_published_courses as $data): ?>
								<tr>
									<td class="collapse"><?php echo '<a href="' . site_url('selfstudy/' . $data['slug']) . '" title="' . lang('selfstudy:frontend_link_title') . '">' . $data['title'] . '</a>'; ?></td>
									<td><?php echo $data['description'] ?></td>
									<td class="align-center"><?php echo $data['version'] ?></td>
									<td class="actions">
										<a href="<?php echo site_url('admin/selfstudy/' . $data['slug']) ?>" title="<?php echo lang('selfstudy:edit_link_title')?>" class="button confirm"><?php echo lang('selfstudy:edit')?></a>
										<a href="<?php echo site_url('admin/selfstudy/depublish/' . $data['slug']) ?>" title="<?php echo lang('selfstudy:depublish_link_title')?>" class="button confirm"><?php echo lang('selfstudy:depublish')?></a>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</section>
		</div>

	<?php endif; ?>

	<?php if( ! empty($data_unpublished_courses) ): ?>

		<div class="one_full">
			<section class="title">
				<h4><?php echo lang('selfstudy:unpublished_courses') ?></h4>
			</section>

			<section class="item">
				<div class="content">
					<table class="table-list" cellspacing="0">
						<thead>
							<tr>
								<th><?php echo lang('selfstudy:title') ?></th>
								<th class="collapse"><span><?php echo lang('selfstudy:description') ?></span></th>
								<th><?php echo lang('selfstudy:version') ?></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data_unpublished_courses as $data): ?>
								<tr>
									<td class="collapse"><?php echo $data['title'] ?></td>
									<td><?php echo $data['description'] ?></td>
									<td class="align-center"><?php echo $data['version'] ?></td>
									<td class="actions">
										<a href="<?php echo site_url('admin/selfstudy/edit/' . $data['slug']) ?>" title="<?php echo lang('selfstudy:edit_link_title')?>" class="button confirm"><?php echo lang('selfstudy:edit')?></a>
										<a href="<?php echo site_url('admin/selfstudy/publish/' . $data['slug']) ?>" title="<?php echo lang('selfstudy:publish_link_title')?>" class="button confirm"><?php echo lang('selfstudy:publish')?></a>
										<a href="<?php echo site_url('admin/selfstudy/delete/' . $data['slug']) ?>" title="<?php echo lang('selfstudy:delete_link_title')?>" class="button confirm"><?php echo lang('selfstudy:delete')?></a>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</section>
		</div>

	<?php endif; ?>

</div>