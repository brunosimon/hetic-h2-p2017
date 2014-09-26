window.onload = function()
{

	var menu_drop_down = document.getElementById('drop_down');
	
	menu_drop_down.onmouseover = function()
	{
		document.getElementById("drop_down").classList.add('open');
	};

	menu_drop_down.onmouseout = function()
	{
		document.getElementById("drop_down").classList.remove('open');
	};
};