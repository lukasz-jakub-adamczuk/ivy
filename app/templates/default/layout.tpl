{config_load file='variables.conf' section='controllers'}
<!DOCTYPE html>
<html>
{include file='head.tpl'}
<body>
    {if $smarty.const.DEBUG_MODE}
        {include file='debug.tpl'}
    {/if}
    <main>
    {if $usr::set()}
        {include file='nav.tpl'}
        {include file='dialog.tpl'}
        {include file='messages.tpl'}
        {include file="$content.tpl"}
        {include file='footer.tpl'}
    {else}
        {include file='auth.tpl'}
    {/if}
    </main>
    {include file='scripts.tpl'}
</body>
</html>