						<input id="form-id" name="id" type="hidden" value="{$aFields.id_cup_player|default:0}" />
						<section>
							{include file='controls/name.tpl'}
							{include file='controls/slug.tpl'}
							<!-- {include file='controls/editor.tpl'} -->
							<!-- {include file='controls/markup.tpl' visible=false} -->
							{include file='controls/description.tpl'}
							<!-- {include file='controls/origin.tpl'} -->
						</section>