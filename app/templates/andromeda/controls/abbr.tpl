<div class="row">
    <div class="form-component">
        <label for="form-abbr">Skrót</label>
        <input id="form-abbr" name="dataset[abbr]" type="text" class="form-control" value="{$aFields.abbr|default:''}" placeholder="Wpisz skrót lub zostaw puste" aria-describedby="abbr-help" required />
        <small id="abbr-help" class="form-text text-muted">
            Wartość pola odpowiada za stworzenie katalogu mediów dla danej gry. Konwencja sugeruje używanie małych liter i cyfr przy wyborze nazwy. Opcjonalne jest stosowanie myślnika i tworzenie skrótu z pierwszych liter nazwy gry. Przykładowe skróty: ff7, lom, ff13-2, itp.
        </small>
    </div>
</div>