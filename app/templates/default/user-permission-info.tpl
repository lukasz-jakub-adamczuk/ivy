		<article>
			{include file='parts/info-header.tpl' header=$header|default:'Uprawnienia użytkownika'}
			<section>
				<form method="post" action="{$base}/{$ctrl}/promote" class="clearfix">
					<div class="table-row">
						<div class="main-form">
							<section>
								{foreach name=permissiongroups from=$aPermissionGroups item=pg key=pgk}
								<h3>{$pg.name}</h3>
								<table class="table permissions">
									{if !$smarty.foreach.permissiongroups.first}
										{include file='else/user-permission-info-table-header.tpl'}
									{else}
									<thead>
										<tr>
											<th>...</th>
											<th>all</th>
										</tr>
									</thead>
									{/if}
									<tbody>
									{if !$smarty.foreach.permissiongroups.first}
										{foreach from=$aPermissions.$pgk item=perm}
										<tr>
											<td>{$perm.name}</td>
											<td><input name="dataset[perms][{$perm.slug}][]" type="checkbox" value="create"></td>
											<td><input name="dataset[perms][{$perm.slug}][]" type="checkbox" value="read"></td>
											<td><input name="dataset[perms][{$perm.slug}][]" type="checkbox" value="update"></td>
											<td><input name="dataset[perms][{$perm.slug}][]" type="checkbox" value="delete"></td>
										</tr>
										{/foreach}
									{else}
										{foreach from=$aPermissions.$pgk item=perm}
										<tr>
											<td>{$perm.name}</td>
											<td><input name="dataset[perms][{$perm.slug}][]" type="checkbox" value="create"></td>
										</tr>
										{/foreach}
									{/if}
									</tbody>
								</table>
								{/foreach}
							</section>
							<section>
								<h3>Publicystyka</h3>
								<table class="table permissions crud">
									{include file='else/user-permission-info-table-header.tpl'}
									<tbody>
										{foreach from=$aTypes item=cat}
										<tr>
											<td>{$cat.slug}</td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="create"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="read"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="update"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="delete"></td>
										</tr>
										{/foreach}
									</tbody>
								</table>
							</section>
							<section>
								<h3>Gry</h3>
								<table class="table permissions crud">
									{include file='else/user-permission-info-table-header.tpl'}
									<tbody>
										{foreach from=$categories item=cat}
										<tr>
											<td>{$cat.slug}</td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="create"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="read"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="update"></td>
											<td><input name="dataset[perms][{$cat.slug}][]" type="checkbox" value="delete"></td>
										</tr>
										{/foreach}
									</tbody>
								</table>
							</section>
						</div>
						<div class="sub-form">
							{if isset($aFields.id_user)}
							<input name="id" type="hidden" value="{$aFields.id_user}" />
							{/if}
							<section class="col">
								<div class="row">
									<div class="label">
										<label for="form-user-group">Grupa</label>
									</div>
									<div>
										<select id="form-user-group" name="dataset[id_user_group]">
										<option value="0">brak</option>
										{foreach from=$aUserGroups item=ug}
											<option value="{$ug.id_user_group}"{if isset($aFields.id_user_group) and $ug.id_user_group eq $aFields.id_user_group} selected="selected"{/if}>{$ug.name}</option>
										{/foreach}
										</select>
									</div>
								</div>
							</section>
							<section>
								<p>Uprawnienia określamy w dwojaki sposób:</p>
								<p>Każdego użytkownika przypisujemy do określonej grupy:</p>
								<ul class="x-style key-value">
									<li><span>Admin</span> - użytkownik o największych uprawnieniach, może wszystko, dosłownie.</li>
									<li><span>Junior</span> - użytkownik o dużych uprawnieniach, może wiele.</li>
									<li><span>Moderator</span> - użytkownik o średnich uprawnieniach, głównie weryfikuje treści.</li>
									<li><span>Editor</span> - użytkownik o małych uprawnieniach, głównie tworzy treści.</li>
									<li><span>User</span> - użytkownik o małych uprawnieniach, zalogowany użytkownik.</li>
									<li><span>Anonymous</span> - użytkownik o bardzo małych uprawnieniach, niezalogowany użytkownik.</li>
								</ul>
								<p>Użytkownik z danej grupy, promuje użytkowników o niższych uprawnieniach, maksymalnie do grupy niższej od własnej.</p>
								<p>Szczegółowe uprawnienia rozszerzają dostępne uprawnienia, jeśli są konieczne, ale użytkownik nie może być awansowany z innych przyczyn.</p>
							</section>
						</div>
					</div>
					<div class="buttons">
						{include file='controls/buttons.tpl'}
					</div>
				</form>
			</section>
		</article>