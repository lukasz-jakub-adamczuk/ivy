{if isset($aFields.id_fragment_type) and ($aFields.id_fragment_type eq 1 or $aFields.id_fragment_type eq 2)}<div id="fragment-preview" class="row">
								<div class="label">
									<label for="form-cover">Pogdląd</label>
								</div>
								<div>
									<img id="cover-image-preview" src="{$site}{$aFields.fragment|default:''}" style="width: 100%; height: auto;" />
								</div>
							</div>{/if}