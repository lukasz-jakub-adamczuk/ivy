		<nav id="info">
			<label id="menu-tgr" for="menu-list" class="nav-icon icon-menu" title="Menu nawigacyjne"></label>
			<a id="home" name="home" href="{$base}/" class="nav-icon icon-home"></a>
			{if $smarty.const.DEBUG_MODE}
				<em>group: {$user.group}</em>
				<em>perm: {$user.perm}</em>

				<a href="{$base}/logout" class="icon-log-out" title="Wyloguj">LOG OUT</a>
				&bull;
				<a href="{$base}/dev/index">ToDo list</a> &bull; <a href="{$base}/dev/clear-navigator">clearNavigator()</a>
			{/if}
			<a id="comments-tgr" href="{$base}/news-comment" class="nav-icon icon-comment{if $iAllComments gt 0} count{/if}" data-count="{$iAllComments}"></a>
			<a id="notification-tgr" href="{$base}/postman/index/n4g" class="nav-icon icon-notification{if $iTotal gt 0} count{/if}" data-count="{$iTotal}"></a>
			<span class="fr">
				{if isset($user)}
				<strong>{$user.name}</strong>
				<a href="{$base}/logout" class="nav-icon icon-logout"></a>
				{/if}
			</span>
		</nav>
		<input id="menu-list" type="checkbox" />
		<nav class="nav">
			<a href="{$base}/news" class="icon-news" title="Aktualności"></a>
			<a href="{$base}/article" class="icon-article" title="Artykuły"></a>
			<a href="{$base}/article-category" class="icon-category" title="Kategorie"></a>
			<a href="{$base}/news-comment" class="icon-comments" title="Komentarze"></a>
			<a href="{$base}/article-verdict" class="icon-verdict" title="Werdykty"></a>
			<a href="{$base}/fragment" class="icon-fragment" title="Fragmenty"></a>
			<a href="{$base}/lobby" class="icon-lobby" title="Poczekalnia"></a>
			<a href="{$base}/file-manager" class="icon-folder" title="Pliki"></a>
			<a href="{$base}/user" class="icon-user" title="Użytkownicy"></a>
			<!-- <a href="{$base}/story" class="icon-profile"></a>
			
			<a href="{$base}/media" class="icon-image"></a>
			<a href="{$base}/trophy" class="icon-trophy"></a>
			<a href="{$base}/sz-cup" class="icon-star"></a>
			<a href="{$base}/stats" class="icon-stats"></a>
			<a href="{$base}/settings" class="icon-user"></a> -->
		</nav>