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
						{foreach from=$aImages item=img}
						<img src="{$site}{$img.fragment}" width="160" height="120" class="img-thumb" data-image-fragment="{$img.fragment}" />
						{/foreach}
					</div>
				</section>
				<section id="tab-selected" class="tab">
					<p>Wybierz jeden z istniejących już obrazów i przypisz do treści.</p>
					<div>
						{foreach from=$aSelectedImages item=img}
						<img src="{$site}{$img.fragment}" width="160" height="120" class="img-thumb" data-image-fragment="{$img.fragment}" />
						{/foreach}
					</div>
				</section>
				<section id="tab-new" class="tab hidden">
					<p>Dodaj nowy plik, który będzie używany.</p>
					<div></div>
					{include file='forms/file-manager-info-file-upload-form.tpl'}
					{include file='forms/file-manager-info-file-download-form.tpl'}
				</section>
			</section>
		</article>