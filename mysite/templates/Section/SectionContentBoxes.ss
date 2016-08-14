<div class="background-color background-color-$BackgroundColor">
	<div class="container">
		<div class="container-inner section-inner">
			<div class="content">
				<% if $ShowTitle %>
					<h2 class="content-title">
						<% if $PreTitle %>
							<span class="pre-title">$PreTitle</span>
						<% end_if %>
						<span class="title">$Title</span>
					</h2>
				<% end_if %>
				<ul class="boxes boxes-per-row-$ItemsColumns box-show-separator">
					<% loop $Items %>
					<li class="box">
						<div class="box-inner">
							<%--<h3 class="box-title"><span>$Title</span></h3>--%>
							<div class="box-content typography">
								<p>$Content</p>
							</div>
						</div>
					<% end_loop %>
				</ul>
			</div>
		</div>
	</div>
</div>

