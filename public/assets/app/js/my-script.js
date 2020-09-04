$('document').ready(function () {

	$('#city').click(function(){
		var city = $(this).val();

		if(city === 'Kramatorsk'){
			var w = $('.company');
			console.log(w);
			var company = $(".company [value='NKMZ']").attr("selected", "");
			var adres = $(".adres [value='NP']").attr("selected", "");
		}

		if(city === 'Kiev'){
			var w = $('.company');
			console.log(w);
			var company = $(".company [value='Azovstal']").attr("selected", "");
			var adres = $(".adres [value='street']").attr("selected", "");
		}

	});

	$('#m_user_profile_tab_2').click(function(){
		$('#m_user_profile_tab_1').css('display', 'none');
		$(this).addClass('active show')
		$(this).css('display', 'block');

	});

});//end ready