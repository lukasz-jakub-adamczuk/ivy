<ul class="nav nav-tabs mb-2" role="tablist">
	<li class="nav-item active" data-tab="tab-upload">
		<a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">Pliki z dysku</a>
	</li>
	<li class="nav-item" data-tab="tab-download">
		<a class="nav-link" id="download-tab" data-toggle="tab" href="#download" role="tab" aria-controls="download" aria-selected="false">Pliki z internetu</a>
	</li>
</ul>
<div class="tab-content">
	<div id="upload" class="tab-pane active" role="tabpanel" aria-labelledby="upload-tab">
		{include file='forms/file-manager-info-file-upload-form.tpl'}
	</div>
	<div id="download" class="tab-pane" role="tabpanel" aria-labelledby="download-tab">
		{include file='forms/file-manager-info-file-download-form.tpl'}
	</div>
</div>