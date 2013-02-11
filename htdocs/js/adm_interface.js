function selectAll(n)
{
	checkboxes = document.getElementsByName(n);
	for(i=0;i<checkboxes.length;i++)
	{
		checkboxes[i].checked=true;
	}

	return false;
}

function deselectAll(n)
{
	checkboxes = document.getElementsByName(n);
	for(i=0;i<checkboxes.length;i++)
	{
		checkboxes[i].checked=false;
	}

	return false;
}

function selectInverse(n)
{
	checkboxes = document.getElementsByName(n);
	for(i=0;i<checkboxes.length;i++)
	{
		checkboxes[i].checked=(checkboxes[i].checked)?false:true;
	}

	return false;
}
function frmLoad(url)
{
	$("#frmain").loadJFrame(url);
	return false;
}
