var _paq = _paq || [];
(function ($) {
	$('.header.has-header-image').entwine({
		onmatch: function () {
			if (window.location.hash == '#pink-header') {
				this.addClass('pink-header');
			}
			var header = this,
				hasClass = false,
				win = $(window),
				firstChild = $('.layout > .section').first(),
				firstChildHeight = firstChild && firstChild.length ? firstChild.height() / 2 : 300,
				handleScroll = function () {
					if (winWidth >= 700) {
						var scroll = win.scrollTop();
						if (!hasClass) {
							if (scroll > firstChildHeight) {
								header.addClass('scrolled');
								hasClass = true;
							}
						} else {
							if (scroll < firstChildHeight) {
								header.removeClass('scrolled');
								hasClass = false;
							}
						}
					}
				},
				handleResize = function () {
					winWidth = win.width();
					handleScroll();
				};
			handleResize();
			win.resize(handleResize);
			win.scroll(handleScroll);
		}
	});
	$('a.scroll, .typography a').entwine({
		onclick: function () {
			var hash = this.attr('href').split("#")[1];
			var target = $('#' + hash);
			if (target.length) {
				$('html, body').animate({scrollTop: target.offset().top - 70}, 700);
				_paq.push(['trackEvent', 'Scroll', 'Section', this.attr('title')]);
				//window.location.hash = '#' + hash;
				return false;
			}
			else {
				_paq.push(['trackEvent', 'Link', 'External', this.attr('href')]);
			}
		}
	});
	$('.toggle-nav').entwine({
		onclick: function () {
			this.closest('header').find('ul').slideToggle(500);
			return false;
		}
	});
	$('.section-type-SectionMap .section-inner').entwine({
		onmatch: function () {
			var markers = [];
			this.find('.map-marker').each(function () {
				var marker = $(this);
				markers.push({
					lat: marker.data('lat'),
					lng: marker.data('lng'),
					title: marker.data('title'),
					icon: 'mysite/images/map-icons/' + marker.data('type') + '.png',
					iconWidth: marker.data('type') == 'Conference' || marker.data('type') == 'Party' ? 33 : 25,
					iconHeight: marker.data('type') == 'Conference' || marker.data('type') == 'Party' ? 48 : 36,
					content: marker.html()
				});
				marker.remove();
			});
			if (google && google.maps) {
				var map = new google.maps.Map(this.find('.map').get(0), {
					zoom: 15,
					center: new google.maps.LatLng(0, 0),
					mapTypeControl: false,
					streetViewControl: false,
					scrollwheel: false,
					styles: [
						{
							"featureType": "administrative.province",
							"elementType": "all",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"featureType": "landscape",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 65
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "poi",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 51
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "road.highway",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "road.arterial",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 30
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "road.local",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 40
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "transit",
							"elementType": "all",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"hue": "#ffff00"
								},
								{
									"lightness": -25
								},
								{
									"saturation": -97
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "labels",
							"stylers": [
								{
									"visibility": "on"
								},
								{
									"lightness": -25
								},
								{
									"saturation": -100
								}
							]
						}
					]
				});
				var infowindow = new google.maps.InfoWindow(),
					bounds = new google.maps.LatLngBounds();
				for (var i = 0; i < markers.length; i++) {
					(function (marker) {
						var gMarker = new google.maps.Marker({
							position: new google.maps.LatLng(marker.lat, marker.lng),
							map: map,
							title: marker.title,
							// icon: marker.icon
							icon: {
								url: marker.icon,
								// This marker is 20 pixels wide by 32 pixels high.
								size: new google.maps.Size(marker.iconWidth, marker.iconHeight),
								// The origin for this image is (0, 0).
								origin: new google.maps.Point(0, 0),
								// The anchor for this image is the base of the flagpole at (0, 32).
								anchor: new google.maps.Point(marker.iconWidth / 2, marker.iconHeight)
							}
						});
						bounds.extend(gMarker.position);
						google.maps.event.addListener(gMarker, 'click', function () {
							infowindow.setContent(marker.content);
							infowindow.open(map, gMarker);
							_paq.push(['trackEvent', 'Location', 'Infowindow ' + marker.title, 'Open']);
						});
					})(markers[i]);
				}
				map.fitBounds(bounds);
			}
			//
			//
			//
			//
			//
			// infowindow.setContent(infoWindowContent.html());
			// infoWindowContent.remove();
			// var pos = new google.maps.LatLng(this.data('lat'), this.data('lng')), map = new google.maps.Map(this.get(0), {
			// 	zoom: 15,
			// 	center: pos,
			// 	mapTypeControl: false,
			// 	streetViewControl: false,
			// 	scrollwheel: false,
			// 	styles: [{
			// 		"featureType": "administrative",
			// 		"elementType": "labels.text.fill",
			// 		"stylers": [{"color": "#444444"}]
			// 	}, {
			// 		"featureType": "landscape",
			// 		"elementType": "all",
			// 		"stylers": [{"color": "#f2f2f2"}]
			// 	}, {
			// 		"featureType": "poi",
			// 		"elementType": "all",
			// 		"stylers": [{"visibility": "off"}]
			// 	}, {
			// 		"featureType": "poi.park",
			// 		"elementType": "all",
			// 		"stylers": [{"visibility": "on"}]
			// 	}, {
			// 		"featureType": "poi.park",
			// 		"elementType": "geometry.fill",
			// 		"stylers": [{"color": "#00a881"}, {"lightness": "0"}]
			// 	}, {
			// 		"featureType": "poi.park",
			// 		"elementType": "labels.text.fill",
			// 		"stylers": [{"saturation": "-100"}, {"lightness": "-100"}]
			// 	}, {
			// 		"featureType": "road.highway",
			// 		"elementType": "all",
			// 		"stylers": [{"visibility": "on"}]
			// 	}, {
			// 		"featureType": "road.highway",
			// 		"elementType": "geometry.fill",
			// 		"stylers": [{"color": "#ffffff"}]
			// 	}, {
			// 		"featureType": "road.highway",
			// 		"elementType": "geometry.stroke",
			// 		"stylers": [{"visibility": "on"}, {"color": "#26b7e6"}]
			// 	}, {
			// 		"featureType": "road.arterial",
			// 		"elementType": "labels.icon",
			// 		"stylers": [{"visibility": "off"}]
			// 	}, {
			// 		"featureType": "transit",
			// 		"elementType": "all",
			// 		"stylers": [{"visibility": "off"}]
			// 	}, {
			// 		"featureType": "water",
			// 		"elementType": "all",
			// 		"stylers": [{"color": "#142136"}, {"visibility": "on"}]
			// 	}]
			// });
			// var marker = new google.maps.Marker({
			// 	position: pos,
			// 	map: map,
			// 	title: this.data('title'),
			// 	icon: 'mysite/images/map-pin.png'
			// });
			// google.maps.event.addListener(marker, 'click', function () {
			// 	infowindow.open(map, marker);
			// 	_paq.push(['trackEvent', 'Location', 'Infowindow', 'Open']);
			// });
		}
	});
})(jQuery);
// $('#Form_ContactForm_action_HandleForm').on('click', function (e) {
// 	e.preventDefault();
// 	_paq.push(['trackEvent', 'Contactform', $('#Form_ContactForm_Receiver').val(), $('#Form_ContactForm_Subject').val()]);
// 	setTimeout(function () {
// 		$('form').submit();
// 	}, 100);
// });
