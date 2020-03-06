<article>
	{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
	<section>
		<ul class="nav nav-tabs mb-2" role="tablist">
			<li class="nav-item" data-tab="tab-all">
				<a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">Wszystkie</a>
			</li>
			<li class="nav-item active" data-tab="tab-selected">
				<a class="nav-link active" id="selected-tab" data-toggle="tab" href="#selected" role="tab" aria-controls="selected" aria-selected="true">Określone</a>
			</li>
			<li class="nav-item" data-tab="tab-new">
				<a class="nav-link" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false">Nowe</a>
			</li>
		</ul>
		<div class="tab-content">
			<section id="all" class="tab-pane" role="tabpanel" aria-labelledby="all-tab">
				<p>Wybierz jeden z istniejących już obrazów i przypisz do treści.</p>
				<div class="flex" style="display: flex; flex-flow: row wrap; justify-content: flex-start; padding: 10px;">
					{foreach from=$aImages item=img}{*<figure class="thumbnail">
					<img src="{$site}/image.php?img={$img.fragment}&size=128x128" class="img-thumb" data-image-fragment="{$img.fragment}" data-image-fragment-id="{$img.id_fragment}" />
					</figure>*}
					<div style="img-box">
					{image file=$img.fragment size=128x128}
					</div>
					{/foreach}
				</div>
			</section>
			<section id="selected" class="tab-pane active" role="tabpanel" aria-labelledby="selected-tab">
				<p>Wybierz jeden z istniejących już obrazów i przypisz do treści.</p>
				<div class="flex" style="display: flex; flex-flow: row wrap; justify-content: flex-start; padding: 10px;">
					{foreach from=$aSelectedImages item=img}{*<figure class="thumbnail">
					<img src="{$site}/image.php?img={$img.fragment}&size=128x128" class="img_-thumb" data-image-fragment="{$img.fragment}" data-image-fragment-id="{$img.id_fragment}" />
					</figure>*}
					<div style="img-box">
						{image file=$img.fragment size=128x128}
					</div>
					{/foreach}
				</div>
			</section>
			<section id="new" class="tab-pane" role="tabpanel" aria-labelledby="new-tab">
				{include file='partials/transfer-file-form.tpl'}
			</section>
		</div>
	</section>
</article>