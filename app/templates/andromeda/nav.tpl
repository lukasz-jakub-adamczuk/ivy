<nav id="info" class="navbar navbar-expand-lg navbar-light bg-light">
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
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{$base}/" class="nav-link" title="Home">Home</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/news" class="nav-link" title="Aktualności">Aktualności</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/article" class="nav-link" title="Artykuły">Artykuły</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/article-category" class="nav-link" title="Kategorie">Kategorie</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/news-comment" class="nav-link" title="Komentarze">Komentarze</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/article-verdict" class="nav-link" title="Werdykty">Werdykty</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/fragment" class="nav-link" title="Fragmenty">Fragmenty</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/lobby" class="nav-link" title="Poczekalnia">Poczekalnia</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/file-manager" class="nav-link" title="Pliki">Pliki</a>
            </li>
            <li class="nav-item">
                <a href="{$base}/user" class="nav-link" title="Użytkownicy">Użytkownicy</a>
            </li>
        </ul>
        <!-- <a href="{$base}/story" class="icon-profile"></a>
        
        <a href="{$base}/media" class="icon-image"></a>
        <a href="{$base}/trophy" class="icon-trophy"></a>
        <a href="{$base}/sz-cup" class="icon-star"></a>
        <a href="{$base}/stats" class="icon-stats"></a>
        <a href="{$base}/settings" class="icon-user"></a> -->
    </div>
</nav>