<div class="background-color background-color-$BackgroundColor">
	<div class="container">
		<div class="container-inner section-inner">
			<div class="content-box background-color background-color-white">
				<div class="content-box-inner">
					<div class="container-inner">
						<div class="content">
							<% if $ShowTitle %>
								<h2 class="content-title">
									<% if $PreTitle %>
										<span class="pre-title">$PreTitle</span>
									<% end_if %>
									<span class="title">$Title</span>
								</h2>
							<% end_if %>
							<div class="typography">
								$Content
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
