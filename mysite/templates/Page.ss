<!doctype html>
<!--[if lt IE 9]>
<html class="no-js ie lt-ie9" lang="$ContentLocale"> <![endif]-->
<!--[if gt IE 8]>
<html class="no-js ie ie9" lang="$ContentLocale"> <![endif]-->
<!--[if !IE]><!-->
<html class="no-js no-ie" lang="$ContentLocale"> <!--<![endif]-->
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
		<title><% if $URLSegment != 'home' %>$Title &raquo; <% end_if %>$SiteConfig.Title <% if $SiteConfig.Tagline %>
			| $SiteConfig.Tagline<% end_if %></title>
		<% base_tag %>
		<meta name="viewport" content="width=device-width"/>
		$MetaTags('false')
		<link rel="shortcut icon" href="{$BaseURL}favicon.ico?v=14"/>
		<%--<link rel="apple-touch-icon" href="{$BaseURL}favicon-180.png">--%>
		<%--<meta name="msapplication-TileImage" content="{$BaseURL}favicon-144.png">--%>
		<%--<meta name="msapplication-TileColor" content="#FFF">--%>
	</head>
	<body>
		<div class="page-container" id="top">
			<% include Header %>
			<div class="layout" role="main"<% if $URLSegment == 'home' %> id="home-top"<% end_if %>>
				$Layout
			</div>
			<% include Footer %>
		</div>
			$RenderDebugBar
        <!-- Piwik -->
        <script type="text/javascript">
            var _paq = _paq || [];
            _paq.push(["setDomains", ["*.stripecon.eu","*.2016.stripecon.eu"]]);
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//piwik.stripecon.eu/";
                _paq.push(['setTrackerUrl', u+'piwik.php']);
                _paq.push(['setSiteId', '6']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <noscript><p><img src="//piwik.stripecon.eu/piwik.php?idsite=6" style="border:0;" alt="" /></p></noscript>
        <!-- End Piwik Code -->
	</body>
</html>
