<?php
$obj_id     = isset($this->object) && !empty($this->object->id_news) ? $this->object->id_news : "";
$obj_title  = isset($this->object) && !empty($this->object->title) ? $this->object->title : "Entrez le Titre de la Nouvelle ici.";
$obj_date   = isset($this->object) && !empty($this->object->date_news) ? date("d/m/Y", strtotime($this->object->date_news)) : date("d/m/Y");
?>

<script type="text/javascript">
$(document).ready(function()
{
	evias.kernel.Data.initializeEditor();
	evias.kernel.UI.initTimePickers();
});
</script>

<span class="hidden" id="txt-empty-title">Entrez le Titre de la Nouvelle ici.</span>
<div id="object-editor">
	<form method="post" action="/back-office/news/edit">
	<table cellpadding="10px" cellspacing="0" border="0">
		<thead class="hidden"><th></th><th></th></thead>
		<tbody>
			<tr>
				<td><label>Titre du Son :</label></td>
				<td><input  type="text"
							class="text big-textinput"
							rel="txt-empty-title"
							name="object[title]"
							value="<?php echo $obj_title; ?>" />
				</td>
			</tr>
			<tr>
				<td><label>Date de la Nouvelle :</label></td>
				<td><input  type="text"
							class="datepicker"
							name="object[date_news]"
							value="<?php echo $obj_date; ?>" />
				</td>
			</tr>
		</tbody>
	</table>
	<div class="clear"></div>
	<div class="button-wrapper">
		<input type="hidden" name="oid" value="<?php echo $obj_id; ?>" />
		<input type="submit" value="Sauvegarder" name="save_object" />
	</div>
	</form>
</div>