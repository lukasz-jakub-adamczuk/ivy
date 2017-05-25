		<article class="container">
			{include file='parts/info-header.tpl' header=$sHeader|default:'Szczegóły'}
			<section>
				<form method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="table-form">
					<div class="_table-row row">
						<div class="_main-form col-md-8">
							{include file=$sFormMainPartTemplate}
							{*include file='else/main-form-fix.tpl'*}
						</div>
						<div class="_sub-form _clearfix col-md-4">
							{include file=$sFormSubPartTemplate}
						</div>
					</div>
					<div class="navbar">
						{include file='controls/buttons.tpl'}
					</div>
				</form>
			</section>
		</article>