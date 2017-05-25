{foreach name=boxes from=$aHomeBoxes item=box key=bk}
<!-- <a href="{$base}/news" class="black box"> -->
				<div class="col-md-4">
					
					<header>
						<span class="vam m-s icon-{$box.icon|default:$bk}"></span>
						<h3 class="vam m-s">{$box.header}</h3>
					</header>
					<p>{$aDescriptions.$bk|humanize}</p>
					<footer>
					{foreach from=$box.links item=link key=lk}
						<a href="{$base}{$link.url}" class="btn btn-default icon-{$link.icon|default:$lk}">{$link.name}</a>
					{/foreach}
					</footer>
					
				</div>
				<!-- {$smarty.foreach.boxes.index} -->
				<!-- {$smarty.foreach.boxes.iteration} -->
				{if $smarty.foreach.boxes.iteration gt 0 and $smarty.foreach.boxes.iteration % 3 eq 0}
					<div class="clearfix visible-md-block"></div>
				{/if}
				<!-- </a> -->
				{/foreach}