		<article>
			{include file='parts/info-header.tpl' header=$sHeader|default:'Szczegóły'}
			<section>
				<ul class="tabs">
					<li data-tab="tab-all">Wszystkie</li>
					<li data-tab="tab-selected" class="active">Określone</li>
					<li data-tab="tab-new">Nowe</li>
				</ul>
				<section id="tab-all" class="tab hidden">
					<p>Wybierz jeden z istniejących już obrazów i przypisz do treści.</p>
					<div>
						{foreach from=$aImages item=img}<figure class="thumbnail">
						<img src="{$site}/image.php?img={$img.fragment}&size=128x128" class="img-thumb" data-image-fragment="{$img.fragment}" data-image-fragment-id="{$img.id_fragment}" />
						</figure>{/foreach}
					</div>
				</section>
				<section id="tab-selected" class="tab">
					<p>Wybierz jeden z istniejących już obrazów i przypisz do treści.</p>
					<div>
						{foreach from=$aSelectedImages item=img}<figure class="thumbnail">
						<img src="{$site}/image.php?img={$img.fragment}&size=128x128" class="img_-thumb" data-image-fragment="{$img.fragment}" data-image-fragment-id="{$img.id_fragment}" />
						</figure>{/foreach}
					</div>
				</section>
				<section id="tab-new" class="tab hidden">
					{include file='else/transfer-file-form.tpl'}
				</section>
			</section>
		</article>