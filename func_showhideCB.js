function ShowHideCB(lohko)
	{
	var dynamicdiv = document.getElementById(lohko);
	var cbyes = document.getElementById(lohko + '_checkbox');
	if ( cbyes.checked )
		{
		dynamicdiv.style.display="block";
		}
	else
		{
		dynamicdiv.style.display="none";
		}
	}