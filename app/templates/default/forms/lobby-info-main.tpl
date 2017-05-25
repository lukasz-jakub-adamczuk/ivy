						<!-- <input name="id" type="hidden" value="{$aFields.id_article|default:0}" /> -->
						<!-- <input name="object" type="hidden" value="{$aFields.object}" /> -->
						<!-- {if isset($aFields.id_object)} -->
						<input name="id_object" type="hidden" value="{$aFields.id_object|default:0}" />
						<!-- {/if} -->
						<section>
							{include file='controls/title.tpl'}
							{include file='controls/editor.tpl'}
							{include file='controls/markup.tpl' visible=false}
							{include file='controls/markdown.tpl' visible=false}
						</section>