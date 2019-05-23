{config_load file='variables.conf' section='controllers'}
<!DOCTYPE html>
<html>
{include file='head.tpl'}
<body id="page-top" class="sidebar-toggled">
    {if $smarty.const.DEBUG_MODE}
        {include file='debug.tpl'}
    {/if}
    <div id="wrapper">
    {if $usr::set()}
        {include file='sidebar.tpl'}
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                {include file='nav.tpl'}
                <div class="container-fluid">
                    {include file='messages.tpl'}
                    {include file="$content.tpl"}
                </div>
            </div>
            {*include file='footer.tpl'*}
        </div>
    {else}
        {include file='auth.tpl'}
    {/if}
    </div>
    {include file='dialog.tpl'}
    {include file='scripts.tpl'}
</body>
</html>