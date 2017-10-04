<div class="row">
    <div class="form-component">
        <label for="form-verdict">Treść</label>
        <textarea id="form-verdict" name="dataset[verdict]" rows="10" cols="40" class="input" placeholder="Wpisz treść" aria-describedby="verdict-help">
            {$aFields.verdict|stripslashes|default:''}
        </textarea>
        <small id="verdict-help" class="form-text text-muted">
            Wartość pola jest treścią oceny. HTML jest niedopuszczalny
        </small>
    </div>
</div>