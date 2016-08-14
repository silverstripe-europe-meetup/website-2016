<div class="background-color background-color-$BackgroundColor">
	<div class="background">
		<div class="container">
			<div class="container-inner section-inner">
				<% if $ShowTitle %>
					<div class="content">
						<h2 class="content-title">
							<% if $PreTitle %>
								<span class="pre-title">$PreTitle</span>
							<% end_if %>
							<span class="title">$Title</span>
						</h2>
					</div>
				<% end_if %>
				<div class="images">
					<div class="images-inner">
						<% loop $GalleryImages.sort('SortOrder') %>
							<div class="image">
								<a href="$URL" target="_blank">
									$CroppedImage(400, 400)
								</a>
							</div>
						<% end_loop %>
						<div class="clear"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
