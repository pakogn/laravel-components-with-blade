<table class="DataTable">
	@if (count($$elements) === 0)
		There are no @lang("resources.{$elements}")
	@else
		<thead>
			<tr>
				@yield($elements.'TableHeader')
			</tr>
		</thead>
		<tbody>
			@yield($elements.'TableBody')
		</tbody>
	@endif
</table>