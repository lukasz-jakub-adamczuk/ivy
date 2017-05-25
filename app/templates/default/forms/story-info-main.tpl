						<input name="id" type="hidden" value="{$aFields.id_story|default:0}" />
						<section>
							{include file='controls/title.tpl'}
							{include file='controls/slug.tpl'}
							{include file='controls/editor.tpl'}
							{include file='controls/markup.tpl' visible=false}
							{include file='controls/markdown.tpl' visible=false}
						</section>