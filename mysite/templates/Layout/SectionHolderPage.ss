<% loop $LayoutSections %>
	<{$SectionHTMLTag} id="section-$URLSegment" class="section $SectionClasses $FirstLast<% if $SectionGutter && $NextSection && $NextSection.SectionGutter %><% if $BackgroundColor == $NextSection.BackgroundColor %> no-gutter-bottom<% end_if %><% end_if %>">
	$LayoutSection
	</{$SectionHTMLTag}>
<% end_loop %>
