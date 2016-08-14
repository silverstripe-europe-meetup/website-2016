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
				<div class="content-left-right-container">
					<% if $ShowSeparator %>
						<div class="content-left-right-separator"></div>
					<% end_if %>
					<div class="content-left-right vertical-align-$VerticalAlign">
						<div class="content-left">
							<div class="typography">
								$Content
							</div>
						</div>
						<div class="content-right">
							<div class="typography">
								$Content2
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>