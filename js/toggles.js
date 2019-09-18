function displayLocField()
{
	var x = document.getElementById("locinfo");
	var name = document.getElementById("username").value;
	var pass = document.getElementById("pass").value;
	if(name != "" && pass != "" && name != null && pass != null)
	{
		x.style.display = "block";		
	}
}

function hideField()
{
	var x = document.getElementById("output");
	x.style.display = "none";
}

function ajaxSubmit()
{
	var x = document.getElementById("output");
	document.getElementById("output").innerHTML = "";
	x.style.display = "block";
	var username = document.getElementById('username').value;
	var pass = document.getElementById('pass').value;
	var city = document.getElementById('city').value;
	var state = document.getElementById('state').value;
	var country = document.getElementById('country').value;
	if(city != "" && state != "" && country != "" && city != null && state != null && country != null && username != "" && pass != "" && username != null && pass != null)
	{
		$.ajax
		({
			url: "insertData.php",
			data: {username:username, pass:pass, city:city, state:state, country:country},
			cache: false,
			success: function(html)
			{
				$("#output").html(html);
			}
		});
	}
	else
	{
		document.getElementById("output").innerHTML = "Error: Empty field(s)";
	}
	return false;
}

function ajaxDisplay()
{
	var x = document.getElementById("output");
	x.innerHTML = "";
	x.style.display = "table";
	$.ajax
	({
		url: "showData.php",
		cache: false,
		success: function(html)
		{
			$("#output").html(html);
		}
	});
	
	return false;
}


