<% if $LayoutSections.First.ClassName != 'SectionBannerImage' %>
	<div class="header-push"></div>
<% end_if %>
<header class="header<% if $LayoutSections.First.ClassName == 'SectionBannerImage' %> has-header-image<% end_if %>">
	<div class="container">
		<div class="container-inner">
			<a href="$BaseURL#home-top" class="logo scroll">
				<h1>$SiteConfig.Title</h1>
			</a>
			<%--<button class="toggle-nav"><span></span></button>--%>
			<% if $LayoutSectionsMenu %>
				<nav>
					<button class="toggle-nav"><span></span></button>
					<ul>
						<% loop $LayoutSectionsMenu %>
							<li class="$FirstLast">
								<a class="scroll" href="$Link" title="$Title.XML">$MenuTitle</a>
							</li>
						<% end_loop %>
					</ul>
				</nav>
			<% end_if %>
			<%--<div class="clear"></div>--%>
		</div>
	</div>
</header>

