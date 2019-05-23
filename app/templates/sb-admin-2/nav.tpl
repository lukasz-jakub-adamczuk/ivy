<nav id="info" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="navbar" id="mainNavBar">
        <a id="home" name="home" href="{$base}/" class="nav-icon icon-home">Home</a>
        <a id="comments-tgr" href="{$base}/news-comment" class="nav-icon icon-comments{if $allAwaitingComments gt 0} count{/if}" data-count="{$allAwaitingComments}">
            Komentarze <span class="badge badge-secondary">{$allAwaitingComments}</span>
        </a>
        <a id="notification-tgr" href="{$base}/postman/index/n4g" class="nav-icon icon-notification{if $postman.total gt 0} count{/if}" data-count="{$postman.total}">
            Listonosz <span class="badge badge-secondary">{$postman.total}</span>
        </a>
        <span class="fr">
            {if $usr::set()}
            <strong>{$usr::get('name')}</strong>
            <a href="{$base}/logout" class="nav-icon icon-logout">{$usr::get('name')}</a>
            {/if}
        </span>
    </div>
</nav>