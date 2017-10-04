<div class="row">
    <div class="form-component">
    <!-- <div class="label"> -->
        <label for="form-slug">Alias</label>
        <!-- <span>Wartość pola jest określana automatycznie</span> -->
    <!-- </div> -->
    <!-- <div clas="col-md-6 mb-3"> -->
        <input id="form-slug" name="dataset[slug]" type="text" class="form-control" value="{$aFields.slug|default:''}" placeholder="Wpisz alias lub zostaw puste" readonly="readonly" aria-describedby="slug-help" />
        <small id="slug-help" class="form-text text-muted">
            Wartość pola jest określana automatycznie
        </small>
    </div>
</div>