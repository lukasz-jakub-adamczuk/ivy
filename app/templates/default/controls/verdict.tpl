<div class="row">
	<div class="label">
		<label for="form-verdict">Treść</label><span>Wartość pola jest treścią oceny. HTML jest niedopuszczalny</span>
	</div>
	<div>
		<textarea id="form-verdict" name="dataset[verdict]" rows="10" cols="40" class="input" placeholder="Wpisz treść">{$aFields.verdict|stripslashes|default:''}</textarea>
	</div>
</div>