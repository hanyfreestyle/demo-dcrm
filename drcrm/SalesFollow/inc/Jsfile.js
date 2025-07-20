
var obj;
if(window.XMLHttpRequest)
{obj = new XMLHttpRequest();}
else if(window.ActiveXObject)
{obj = new ActiveXObject("MSXML2.XMLHTTP");}
function GetArchivesPhoto()
{
	document.getElementById('city').innerHTML = "<img src='../include/img/loading30.gif'>";
	var  close_ID = document.country_city.close_id.value;
	var url = 'CloseTicket_ChangeClose_Ajex.php?CloseId='+close_ID;
	if(obj) 
	{	
		obj.open("GET", url);
		obj.onreadystatechange = function()
		{
		if (obj.readyState == 4 && obj.status == 200) {
		document.getElementById('city').innerHTML = obj.responseText;
		}
		}
		obj.send(null);
	}
}

