		<article>
			{include file='parts/index-header.tpl' header="Katalogi i pliki"}
			<section>
				<article>
					<div class="nav-bar">
						<a href="{$base}/{$ctrl}/index">dev</a>
						{if isset($aPathItems)}
							{foreach name=fpi from=$aPathItems item=path key=pk}
								{if $smarty.foreach.fpi.last}
								/ <span>{$path.name}</span>
								{else}
								/ <a href="{$base}/{$ctrl}/index{if $path.url neq ''}/{$path.url}{/if}">{$path.name}</a>
								{/if}
							{/foreach}
						{/if}
					</div>
					<form method="post" action="{$base}/{$ctrl}/index{if isset($sPath)}/{$sPath}{/if}">
						<input name="path" type="hidden" value="{$sPath|default:''}" />
						{if isset($aPathItems)}
						<div class="nav-bar with-borders bg-almost-white">
							<div class="mass-actions dib">
								<button name="action[delete]" type="submit" value="USUŃ" class="button icon-trash"></button>
								<button name="action[remove]" type="submit" value="USUŃ" class="button icon-trash red"></button>
							</div>
							<div class="related-actions dib ml">
								{if $sPath eq ''}<span class="button disabled icon-folder"></span>{else}<a href="{$base}/{$ctrl}/info-dir{if $sPath neq ''}/{$sPath}{/if}" class="button icon-folder"></a>{/if}
								<a href="{$base}/{$ctrl}/info-dir-add{if $sPath neq ''}/{$sPath}{/if}" class="button icon-folder"><sup class="icon-add"></sup></a>
								<a href="{$base}/{$ctrl}/info-file-add{if $sPath neq ''}/{$sPath}{/if}" class="button icon-file"><sup class="icon-add"></sup></a>
							</div>
							
							<span id="toggle-layout">
								<span class="pill active icon-grid" data-layout="grid"></span><span class="pill icon-list" data-layout="list"></span>
							</span>
						</div>
						{/if}
						{if isset($aDirs)}
						<div class="dir-content grid">
							{foreach from=$aDirs item=dir key=dk}
								{if $dir.name neq '..'}<input id="dir-{$dk}" name="dirs[]" type="checkbox" value="{$dir.name}" class="mass-checkbox">{/if}
								<div>
									<a href="{$base}/{$ctrl}/index{if $dir.name eq '..'}{$sUpDirPath}{else}/{if $sPath}{$sPath},{/if}{$dir.name}{/if}" class="res icon-folder"></a>
									<label for="dir-{$dk}"><span>{$dir.name}</span></label>
								</div>
							{/foreach}
							{if isset($aFiles)}
								{foreach from=$aFiles item=file key=fk}
									<input id="file-{$fk}" name="files[]" type="checkbox" value="{$file.name}" class="mass-checkbox">
									<div>
										<span class="res {if $file.type eq 'image'}icon-image image-thumbnail{elseif $file.type eq 'audio'}icon-music{elseif $file.type eq 'video'}icon-film{else}icon-file{/if}">
											{if $file.type eq 'image'}
											<img src="{$site}/{if $sPath}{$sPath|replace:',':'/'}/{/if}{$file.name}">
											{/if}
										</span>
										<label for="file-{$fk}"><span>{$file.name}</span></label>
									</div>
								{/foreach}
							{/if}
						</div>
						{/if}
					</form>
					{if isset($aCounts)}
					<div class="nav-bar with-borders bg-almost-white fs-small">
						<span id="dirs-count">{$aCounts.dirs|default:0}</span> katalogów, <span id="files-count">{$aCounts.files|default:0}</span> plików
					</div>
					{/if}
				</article>
			</section>
		</article>