		<article>
			{include file='partials/info-header.tpl' header=$header|default:'Szczegóły'}
			<section>
				<ul class="tabs">
					<li data-tab="tab-chosen" class="active">Wybrane</li>
					<li data-tab="tab-new">Nowe</li>
				</ul>
				<section id="tab-chosen" class="tab">
					<!-- <p>Poniższe obrazy zostaną przypisane do aktualności.</p> -->
					{include file='controls/sortable-images.tpl' type='news'}
					<button class="button" data-js="choose">Wybierz</button>
				</section>
				<section id="tab-new" class="tab hidden">
					{include file='partials/transfer-file-form.tpl'}
				</section>
			</section>
		</article>