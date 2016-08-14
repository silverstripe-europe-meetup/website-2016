<% if $MapMarkers %>
	<div class="section-inner">
		<div class="map" style="$MapHeight">
			<% loop $MapMarkers %>
				<div class="map-marker" data-lat="$Latitude" data-lng="$Longitude" data-type="$Type"
						data-title="$Title.ATT">
					<div class="typography">
						$Content
					</div>
				</div>
			<% end_loop %>
		</div>
	</div>
<% end_if %>
