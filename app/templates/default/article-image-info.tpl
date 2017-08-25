		<article>
			{include file='parts/info-header.tpl' header=$sHeader|default:'Szczegóły'}
			<section>
				<ul class="tabs">
					<li data-tab="tab-chosen" class="active">Wybrane</li>
					<li data-tab="tab-new">Nowe</li>
				</ul>
				<section id="tab-chosen" class="tab">
					<!-- <p>Poniższe obrazy zostaną przypisane do aktualności.</p> -->
					<ul id="sortable-images" class="sortable-items">
					{if isset($aImages)}
						{foreach from=$aImages item=img key=ik}
						<li>
							<a href="{$base}/article-image/{$ik}/remove" class="icon-close" data-js="remove-image" data-asset="{$img.name}"></a>
							<figure class="thumbnail">
								
								<img width="120" height="120" data-src="{$site}/image.php?img={$sUrl}{$img.name}&size=120x120" data-article-image="{$ik}" data-asset="{$img.name}">
							</figure>
						</li>
						{/foreach}
					{else}
						<p class="warn">Brak obrazów.</p>
					{/if}
					</ul>
					</form>
					<button class="button" data-js="choose">Wybierz</button>
				</section>
				<section id="tab-new" class="tab hidden">
					{include file='else/transfer-file-form.tpl'}
				</section>
			</section>
		</article>