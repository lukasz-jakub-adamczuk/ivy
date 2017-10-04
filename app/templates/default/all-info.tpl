		<article>
			{include file='parts/info-header.tpl' header=$header|default:'Szczegóły'}
			<section>
				<form method="post" action="{$base}/{$ctrl}/{$sFormMode}" class="table-form">
					<div class="table-row">
						<div class="main-form">
							{include file=$sFormMainPartTemplate}
							{include file='else/main-form-fix.tpl'}
						</div>
						<div class="sub-form clearfix">
							{include file=$sFormSubPartTemplate}
						</div>
					</div>
					<div class="buttons">
						{include file='controls/buttons.tpl'}
					</div>
				</form>
			</section>
		</article>