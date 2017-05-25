		<nav class="navbar navbar-inverse navbar-fixed-top_">
			<div class="containter">
				<div class="navbar-header">
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a class="navbar-brand" href="#">Squarezone Admin</a>
		        </div>
		        <div id="navbar" class="navbar-collapse collapse">
		        	<div class="navbar-right">
						{if isset($user)}
						<strong class="btn">{$user.name}</strong>
						<a href="{$base}/logout" class="glyphicon glyphicon-logout"></a>
						{/if}
					</div>
		          <form class="navbar-form navbar-right">
		            <div class="form-group">
		              <input type="text" placeholder="Email" class="form-control">
		            </div>
		            <div class="form-group">
		              <input type="password" placeholder="Password" class="form-control">
		            </div>
		            <button type="submit" class="btn btn-success">Sign in</button>
		          </form>
		        </div>
	        </div>
        </nav>

		<nav id="info">
			<label id="menu-tgr" for="menu-list" class="glyphicon glyphicon-menu" title="Menu nawigacyjne"></label>
			<a id="home" name="home" href="{$base}/" class="glyphicon glyphicon-home"></a>
			{if $smarty.const.DEBUG_MODE}
				<em>group: {$user.group}</em>
				<em>perm: {$user.perm}</em>

				<a href="{$base}/logout" class="icon-log-out" title="Wyloguj">LOG OUT</a>
				&bull;
				<a href="{$base}/dev/index">ToDo list</a> &bull; <a href="{$base}/dev/clear-navigator">clearNavigator()</a>
			{/if}
			<a id="comments-tgr" href="{$base}/news-comment" class="glyphicon glyphicon-comment{if $iAllComments gt 0} count{/if}" data-count="{$iAllComments}"></a>
			<a id="notification-tgr" href="{$base}/postman/index/n4g" class="glyphicon glyphicon-bell{if $iTotal gt 0} count{/if}" data-count="{$iTotal}"></a>
			<span class="fr">
				{if isset($user)}
				<strong>{$user.name}</strong>
				<a href="{$base}/logout" class="glyphicon glyphicon-logout"></a>
				{/if}
			</span>
		</nav>
		<input id="menu-list" type="checkbox" />

		<ul class="nav nav-pills">
			{*foreach $aNavigation as $nk=>$nav*}
			{foreach from=$aNavigation item=nav key=nk}
			<li{if $nk eq $ctrl} class="active"{/if}>
				<a href="{if isset($name.url)}{$name.url}{else}{$base}/{$nk}{/if}" title="{$nav.name|default:$nk}">
					<span class="glyphicon glyphicon-{$nav.icon|default:$nk}"></span> {$nav.name|default:$nk}
				</a>
			</li>
			{/foreach}
			<!-- <li><a href="{$base}/story"><span class="glyphicon glyphicon-profile"></span> hidden</a></li>
			
			<li><a href="{$base}/media"><span class="glyphicon glyphicon-image"></span> hidden</a></li>
			<li><a href="{$base}/trophy"><span class="glyphicon glyphicon-trophy"></span> hidden</a></li>
			<li><a href="{$base}/sz-cup"><span class="glyphicon glyphicon-star"></span> hidden</a></li>
			<li><a href="{$base}/stats"><span class="glyphicon glyphicon-stats"></span> hidden</a></li>
			<li><a href="{$base}/settings"><span class="glyphicon glyphicon-user"></span> hidden</a></li> -->
		</ul>