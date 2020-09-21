var cnt_new = 0;

function addNewTableRow(tableID, regexp, rindex)
{
	var tbl = document.getElementById('tblLIST-'+tableID);
	var tblS = document.getElementById('tblSAMPLE-'+tableID);
	var cnt = tbl.rows.length;
	var oRow = tbl.insertRow(cnt);
	var col_count = tbl.rows[cnt-1].cells.length;
	cnt_new = cnt_new>0? cnt_new+1: tbl.rows.length;
	

	for(var i=0;i<col_count;i++)
	{
		var oCell = oRow.insertCell(i);
		oCell.className = tblS.rows[0].cells[i].className;
		var html = tblS.rows[0].cells[i].innerHTML;
		oCell.innerHTML = html.replace(regexp,
			function(html)
			{
				return html.replace('[n'+arguments[rindex]+']', '[n'+cnt_new+']');
			}
		);
	}
}

function delete_item(button, tableID, regexp, rindex)
{
	var tableRow = BX.findParent(button, {'tag':'tr'});
	var tableRowCount = BX.findChildren(tableRow.parentNode, {'tag':'tr'}, true);
	
	if(tableRow && tableRowCount.length <= 1)
	{
		addNewTableRow(tableID, regexp, rindex);
	}

	var hidden = BX.findChild(tableRow, {'tag':'input','class':'value-input'}, true);
	if(hidden)
	{
		var table = tableRow.parentNode;
		hidden.style.display = 'none';
		hidden.value = '';
		table.parentNode.appendChild(hidden);
		table.removeChild(tableRow);
	}
}