function ShowHide(lohko)
	{
	var dynamicdiv = document.getElementById(lohko);
	var radioyes = document.getElementById(lohko + 's_radio_yes');
	var radiono = document.getElementById(lohko + 's_radio_no');
	if ( radioyes.checked )
		{
		dynamicdiv.style.display="block";
		}
	if ( radiono.checked )
		{
		dynamicdiv.style.display="none";
		}
	}