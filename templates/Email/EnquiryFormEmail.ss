<html>
<body>
<table cellpadding="5" style="font-family:Arial,helvetica">
<% loop $EmailData %>
	<% if $Type = Header %>
	<tr>
		<td valign="top" colspan="2" style="padding-top:10px; font-size:120%">
			<u><b>$Header</b></u>
		</td>
	</tr>
	<% else %>
	<tr>
		<td valign="top"><b>$Header</b></td>
		<td valign="top">$Value</td>
	</tr>
	<% end_if %>
<% end_loop %>
</table>
</body>
</html>