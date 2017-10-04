		<article>
			<header class="inner">
				<h2>Dev Panel</h2>
			</header>
			<section>
				<form method="post" action="{$base}/{$ctrl}/todo-insert">
					<label for="dev-todo">Nowe zadanie</label> <input id="dev-todo" name="task" type="text" /> <input type="submit" value="Dodaj do listy" />
				</form>
				<div class="box">
					<h2>Todo <small>{$aCounts.todo|default:0}</small></h2>
					<form method="post" action="{$base}/{$ctrl}/todo-doing">
						<ul class="no-style">
						{foreach from=$list.todo item=todo}
							<li><label><input name="ids[]" type="checkbox" value="{$todo}" /> {$todo}</label></li>
						{/foreach}
						</ul>
						<input type="submit" value="Zacznij" />
					</form>
				</div>
				<div class="box">
					<h2>Doing <small>{$aCounts.doing|default:0}</small></h2>
					<form method="post" action="{$base}/{$ctrl}/todo-done">
						<ul class="no-style">
						{foreach from=$list.doing item=doing}
							<li><label><input name="ids[]" type="checkbox" value="{$doing}" /> {$doing}</label></li>
						{/foreach}
						</ul>
						<input type="submit" value="Zakończ" />
					</form>
				</div>
				<div class="box">
					<h2>Done <small>{$aCounts.done|default:0}</small></h2>
					<ul>
					{foreach from=$list.done item=done}
						<li>{$done}</li>
					{/foreach}
					</ul>
				</div>
			</section>
			<section>
				<h2>Post-install actions</h2>
				<ul>
					<li><a href="{$base}/dev/import-texts">Import texts from files</a></li>
					<!-- <li><a href="{$base}/dev/convert-texts">Convert imported texts</a></li> -->
					<li><a href="{$base}/dev/set-category-creation-date">Update creation date for categories</a></li>
				</ul>
			</section>
		</article>