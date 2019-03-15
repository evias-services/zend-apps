<script type="text/javascript">
$(document).ready(function()
{
	evias.kernel.Data.initializeObjects();
});
</script>

<span class="hidden" id="txt-confirm-delete">Voulez-vous vraiment supprimer cette Nouvelle ?</span>
<div id="objects-list">
	<button class="create-object">Ajouter une Nouvelle</button>
	<table cellpadding="5px" cellspacing="0" border="0" class="objects" data-type="news">
		<thead>
			<th align="center" style="width: 60%;">Contenu</th>
			<th align="center" style="width: 20%;">Date</th>
			<th align="center" style="width: 20%;">Actions</th>
		</thead>
		<tbody>
		<?php
		foreach ($this->objects as $news) : ?>

		<tr class="object" data-id="<?php echo $news->getPK(); ?>">
			<td><?php echo $news->title; ?></td>
			<td align="center"><?php echo date("d.m.Y", strtotime($news->date_news)); ?></td>
			<td class="actions" align="center">
				<ul class="object-actions">
					<li class="delete" data-url="/back-office/news/delete/oid/<?php echo $news->getPK(); ?>"><img src="/images/delete-object.png" alt="Supprimer" /></li>
					<div class="clear"></div>
				</ul>
			</td>
		</tr>

		<?php
		endforeach; ?>
		</tbody>
	</table>
	<div class="clear" style="height: 40px;"></div>
</div>
