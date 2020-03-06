<article>
	{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
	<section>
		<ul class="nav nav-tabs mb-2" role="tablist">
			<li class="nav-item active" data-tab="tab-chosen">
				<a class="nav-link active" id="chosen-tab" data-toggle="tab" href="#chosen" role="tab" aria-controls="chosen" aria-chosen="true">Określone</a>
			</li>
			<li class="nav-item" data-tab="tab-new">
				<a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-chosen="false">Nowe</a>
			</li>
		</ul>
		<div class="tab-content">
			<section id="chosen" class="tab-pane active" role="tabpanel" aria-labelledby="chosen-tab">
				<!-- <p>Poniższe obrazy zostaną przypisane do aktualności.</p> -->
				{include file='controls/sortable-images.tpl' type='news'}
				<button class="button" data-js="choose">Wybierz</button>
			</section>
			<section id="new" class="tab-pane" role="tabpanel" aria-labelledby="new-tab">
				{include file='partials/transfer-file-form.tpl'}
			</section>
		</div>
	</section>
</article>