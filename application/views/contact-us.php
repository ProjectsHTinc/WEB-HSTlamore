        <!-- Page Breadcrumb Start -->
        <div class="main-breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="breadcrumb-content text-center ptb-70">
                            <ul class="breadcrumb-list breadcrumb">
                                <li><a href="#">home</a></li>
                                <li><a href="#">contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Page Breadcrumb End -->
        
        <!-- Contact Email Area Start -->
        <div class="contact-email-area mt-50">
            <div class="container">
                <div class="row">
                <h3 class="mb-5">Contact Us</h3>
                        <p class="text-capitalize mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <div class="col-md-6">
                   
                                    
                                    <h5 class="contact-info mtb-10">contact info:</h5>
                                    <ul class="footer-list first-content">
                                        <li><i class="pe-7s-map-marker"></i>Address will be here</li>
                                        <li><i class="pe-7s-mail"></i>your-email@example.com</li>
                                        <li><i class="pe-7s-call"></i>+00 123 45678</li>
                                    </ul>
              
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <form id="contact-form" class="contact-form" action="" method="post">
                                <div class="address-wrapper">
                                    <div class="col-md-12">
                                        <div class="address-fname">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-email">
                                            <input type="email" name="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-web">
                                            <input type="text" name="website" placeholder="Website">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="address-subject">
                                            <input type="text" name="subject" placeholder="Subject">
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="address-textarea">
                                            <textarea name="message" placeholder="Write your message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <p class="form-message ml-15"></p>
                                <div class="col-xs-12 footer-content mail-content">
                                    <div class="send-email pull-right">
                                        <input type="submit" value="Send Email" class="submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                        		<div class="alert alert-success alert-dismissible" id="send" style="display:none;">
    								<strong>Request Send..</strong> Your Message send to Webmaster...
  								</div>
                        
                                <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
    								<strong>Sorry!.. Please Check Your Email id.
  								</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Email Area End -->
        
        <!-- Google Map Start -->
        <div id="map" class="mt-20" style="height:550px"></div>
        <!-- Google Map End -->
        
        
        
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDAq7MrCR1A2qIShmjbtLHSKjcEIEBEEwM"></script>
  <script language="javascript">
	$('#contact-form').validate({ // initialize the plugin
    rules: {
		 name: {
            required: true,
        },
        email: {
            required: true,email:true,
        },
        subject: {
            required: true,
        },
		message: {
            required: true,
        },
    },
    messages: {
		name: { required:"Enter your Name"},
		email: { required:"Enter your Email"},
		subject: { required:"Enter Subject"},
		message: { required:"Enter Message"},
    },
    submitHandler: function(form) {
       
		$.ajax({
            url: "<?php echo base_url(); ?>home/contact_us",
            type: 'POST',
            data: $('#contact-form').serialize(),
            success: function(response) {
				 if (response == "send") {
					$('#error').hide();
                     $('#send').show();
                } else {
					$('#error').show();
                }
            }
        });
    }
});
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
			
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 11,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(23.761226, 90.420766), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                styles: [{
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#444444"
                        }]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#f2f2f2"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{
                                "saturation": -100
                            },
                            {
                                "lightness": 45
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "simplified"
                        }]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{
                                "color": "#314453"
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [{
                                "lightness": "-12"
                            },
                            {
                                "saturation": "0"
                            },
                            {
                                "color": "#4bc7e9"
                            }
                        ]
                    }
                ]
            };

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>

            var mapElement = document.getElementById('map');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(23.761226, 90.420766),
                map: map,
                title: 'Snazzy!'
            });
        }
    </script>