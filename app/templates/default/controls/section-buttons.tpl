{*publish: {$publish|default:''}, visible: {$aFields.visible|default:''}*}
{if isset($publish) or isset($aFields.visible)}<section class="col sticky bg-dark tar desktop-visible relative">
						{*include file='spinner.tpl'*}
							{include file='buttons/publish.tpl'}
							{include file='buttons/preview.tpl'}
							{include file='buttons/add-n-save.tpl'}
						</section>{/if}