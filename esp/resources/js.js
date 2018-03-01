/******
* This is a collection of scripts written for Form Mod (Form Creator) copyright Michael O'Toole
*****/


// Show/Hide element with cookie option

/*** 
*  takes three possible elements...
*  switches the first element and set cookie
*  switch second element visibility...
*
***/


/*
jQuery(document).load(function(){
	jQuery('#dvLoading').fadeOut(1000);
});
*/



$(document).ready(function() {
   window.setTimeout("fadeDiv();", 800);
 }
)

function fadeDiv() {
   $("#dvLoading").fadeOut('slow');
}





function update_form()
{
	document.getElementById('update_button').click();
}

function Show(id)
{
	var element = null;
	if (document.getElementById) 
	{
		element = document.getElementById(id);
	}
	else if (document.all)
	{
		element = document.all[id];
	} 
	else if (document.layers)
	{
		element = document.layers[id];
	}
	if (element.style.display == "none")
	{ 
		element.style.display = "inline"; 
	}
	else
	{
		element.style.display = "none";
	}
}
function Hide(id)
{
	var element = null;
	if (document.getElementById) 
	{
		element = document.getElementById(id);
	}
	else if (document.all)
	{
		element = document.all[id];
	} 
	else if (document.layers)
	{
		element = document.layers[id];
	}
	if (element.style.display == "inline")
	{ 
		element.style.display = "none"; 
	}
	else
	{
		element.style.display = "inline";
	}
}

function ShowHideSwap(id1, id2)
{
	switch_visibility(id1);
	switch_visibility(id2);
}

function ShowHide(id1, id2, id3) 
{
	var onoff = switch_visibility(id1);
	if (id2 != '')
	{
		switch_visibility(id2);
	}
}
	
function switch_visibility(id) 
{
	var element = null;
	if (document.getElementById) 
	{
		element = document.getElementById(id);
	}
	else if (document.all)
	{
		element = document.all[id];
	} 
	else if (document.layers)
	{
		element = document.layers[id];
	}

	if (element)
	{
		if (element.style) 
		{
			if (element.style.display == "none")
			{ 
				element.style.display = ""; 
				return 1;
			}
			else
			{
				element.style.display = "none";
				return 2;
			}
		}
		else 
		{
			element.visibility = "show"; 
			return 1;
		}
	}
}


function is_hidden(id) 
{
	var element = null;

	if (document.getElementById) 
	{
		element = document.getElementById(id);
	}
	else if (document.all)
	{
		element = document.all[id];
	} 
	else if (document.layers)
	{
		element = document.layers[id];
	}

	if (element)
	{
		if (element.style) 
		{
			if (element.style.display == "none")
			{ 
				return(1);
			}
			else
			{
				return(0);
			}
		}
	}
}
