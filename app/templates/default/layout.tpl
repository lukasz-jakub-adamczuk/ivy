<!DOCTYPE html>
<html>
{include file='header.tpl'}
<body>
	<main>
		{if $smarty.const.DEBUG_MODE}{include file='debug.tpl'}{/if}

		{include file='dialog.tpl'}

		{if isset($user)}{include file='nav.tpl'}{/if}

		{*include file='sidebar.tpl'*}
		
		{if isset($user)}{include file='messages.tpl'}{/if}
		
		{if $content}
		{include file="$content.tpl"}
		{/if}
		
		
	</main>
	{if isset($user)}{include file='footer.tpl'}{/if}
	{include file='scripts.tpl'}
</body>
</html>