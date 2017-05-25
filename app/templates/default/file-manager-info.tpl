		<article>
			<header class="inner">
				<a href="{$base}/{$ctrl}/index{if $sPath neq ''}/{$sPath}{/if}" class="vam icon-arrow-left3"></a>
				<h2 class="vam">Szczegóły katalogu</h2>
			</header>
			<section>
				{include file='forms/file-manager-info-file-upload-form.tpl'}
				{include file='forms/file-manager-info-file-download-form.tpl'}
				{include file='forms/file-manager-info-dir-add-form.tpl'}
				{include file='forms/file-manager-info-dir-form.tpl'}
			</section>
		</article>