{config_load file='variables.conf' section='controllers'}
<!DOCTYPE html>
<html>
{include file='head.tpl'}
<body>
    {if $smarty.const.DEBUG_MODE}
        {include file='debug.tpl'}
    {/if}
    <!-- <main class="container-fluid"> -->
    {if $usr::set()}
        {include file='nav.tpl'}
        <div class="container-fluid">
            <div class="row">
                <div class="sidebar col-md-2">
                {include file='sidebar.tpl'}
                </div>
                <div class="content col-md-10">
                {include file='dialog.tpl'}
                {include file='messages.tpl'}
                {include file="$content.tpl"}
                {include file='footer.tpl'}
                </div>
            </div>
        </div>
    {else}
        {include file='auth.tpl'}
    {/if}
    <!-- </main> -->
    {include file='scripts.tpl'}
</body>
</html>