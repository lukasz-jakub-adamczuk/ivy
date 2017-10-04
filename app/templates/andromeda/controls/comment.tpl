<!-- <div class="row"> -->
    <div class="form-component">
        <label for="form-comment">Treść</label>
        <textarea id="form-comment" name="dataset[comment]" rows="10" cols="40" class="form-control" placeholder="Wpisz treść komentarza">
            {$aFields.comment|stripslashes|default:''}
        </textarea>
    </div>
<!-- </div> -->