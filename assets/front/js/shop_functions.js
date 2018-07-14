

function ajxCartdetails(guest_session_id) {
  		var result = '';
        $.ajax({
		url: '<?php echo base_url(); ?>home/get_ajx_cart',
		type: 'POST',
		data: {guest_session_id:guest_session_id},
		cache: false,
        success: function(cart_details) {
			var dataArray = JSON.parse(cart_details);
		//dataArray.length
		if (dataArray.length>0) {
			for (var i = 0; i < dataArray.length; i++){
				var disp_event_id = dataArray[i].id;
				var event_id = dataArray[i].id*564738;
				var enc_event_id = btoa(event_id);
				var event_name = dataArray[i].event_name;
				var sm_event_name = event_name.toLowerCase();
				var eevent_name = sm_event_name.replace(/"/g, "");
				var sevent_name = eevent_name.replace(/'/g, "");
				var qevent_name = sevent_name.replace(/,/g, '');
				var enc_event_name = qevent_name.replace(/\s/g,"-");
				var event_banner = dataArray[i].event_banner;
				var event_type = dataArray[i].event_type;
				var country_name = dataArray[i].country_name;
				var city_name = dataArray[i].city_name;
				var event_venue = dataArray[i].event_venue;
				var start_time = dataArray[i].start_time;
				var end_time = dataArray[i].end_time;
				var start_date = dataArray[i].start_date;
				var sdate = new Date(Date.parse(start_date));
				var s_date = String (sdate);
				var disp_from_date = s_date.replace('05:30:00 GMT+0530 (India Standard Time)', '');
				
				result +="<div class='col-xs-18 col-sm-3 col-md-3 event_box'><div class='thumbnail event_section'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><img src='<?php echo base_url();?>assets/events/banner/"+event_banner+"' alt='' style='height:204px; width:100%;'></a><div class='event_thumb'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'><p class='event_heading event_title_heading'><a href='<?php echo base_url(); ?>eventlist/eventdetails/"+enc_event_id+"/"+enc_event_name+"/'>"+event_name+"</a></p></a>"+display_date+"<p><img src='<?php echo base_url(); ?>assets/front/images/time.png'><span class='event_thumb'>"+start_time+" - "+end_time+" <span></p><p><img src='<?php echo base_url(); ?>assets/front/images/location.png'><span class='event_thumb'>"+event_venue+"<span></p></div><p class='price_section'>"+sevent_type+"</p></div></div>";

			};
				$("#event_list").append(result);

			}


		}
        });
}