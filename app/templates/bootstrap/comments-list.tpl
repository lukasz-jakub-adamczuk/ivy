		<article class="container">
			{include file='parts/index-header.tpl' header=$sHeader|default:$aSections.$ctrl.name}
			{include file='parts/sections.tpl'}
			<section class="container_">
				<!-- <a href="{$base}/{$ctrl}/add">Nowy wpis</a> -->
				{include file='parts/filters.tpl'}
				
				{include file='parts/paginator.tpl'}
				<form method="post" action="{$base}/{$ctrl}">
					<div class="navbar border-top border-bottom bg-almost-white">
						{include file='parts/mass-actions.tpl'}
					<a href="{$base}/{$ctrl}" class="btn btn-default">
						<span class="glyphicon glyphicon-refresh"></span>
					</a>
					<!-- <a href="{$base}/{$ctrl}/add" class="button icon-plus4"></a> -->

					</div>

					<ul class="list-group">
						{foreach from=$aList item=item key=ik}
						<li class="list-group-item{if $item.visible eq 0} unverified{/if}">
							<input id="item-{$ik}" name="ids[]" type="checkbox" value="{$item.$sPrimaryKey}" class="list-checkbox mass-checkbox">
							<div>
								<div class="list-header">
									<span class="_vam">{$item.author|default:'Gość'}</span> <time class="gray">{$item.creation_date}</time> <a href="{$site}/article/{if isset($item.category_slug)}{$item.category_slug}/{/if}{$item.object_slug}" class="dark mobile-single-line">{if isset($item.category_name)}{$item.category_name} /{/if} {$item.object_name}</a>
								</div>
								<label for="item-{$item.$sPrimaryKey}" class="list-label{if $item.visible eq 0} red{/if}">{$item.comment|stripslashes}</label>
								<p class="relative">
									<a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}" class="btn btn-default" data-js="fast-edit">Edytuj</a>
									<a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}/accept" class="btn btn-success" data-js="accept">Zaakceptuj</a>
									<a href="{$base}/{$ctrl}/{$item.$sPrimaryKey}/remove" class="btn btn-danger" data-js="remove"class="red">Usuń</a>
								</p>
								<!-- </label> -->
								
							</div>
						</li>
						{/foreach}
					</ul>
					
					<div class="nav-bar border-bottom bg-almost-white">
						{include file='parts/mass-actions.tpl'}
					</div>
				</form>
				{include file='parts/paginator.tpl'}
			</section>
		</article>