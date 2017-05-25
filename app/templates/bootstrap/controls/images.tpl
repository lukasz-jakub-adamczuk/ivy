<div id="images" class="_row">
								<p style="margin: 0;"></p>
								<div class="_label">
									<label>{$label}</label> <a data-js="choose-images" data-js-action="{$type}">Wybierz</a>
								</div>
								{if isset($iGalleryImagesTotal)}
									<span>{$iGalleryImagesTotal} {$iGalleryImagesTotal|plural:"obraz":"obrazy":"obrazów"}.</span>
								{else}
									<span>Brak obrazów.</span>
								{/if}
							</div>