{foreach from=$aHomeBoxes item=box key=bk}
<!-- <a href="{$base}/news" class="black box"> -->
				<div class="box">
					
					<header>
						<span class="vam m-s icon-{$box.icon|default:$bk}"></span>
						<h3 class="vam m-s">{$box.header}</h3>
					</header>
					<p>{$aDescriptions.$bk|humanize}</p>
					<footer>
					{foreach from=$box.links item=link key=lk}
						<a href="{$base}{$link.url}" class="button icon-{$link.icon|default:$lk}">{*$link.name*}</a>
					{/foreach}
					</footer>
					
				</div>
				<!-- </a> -->
				{/foreach}