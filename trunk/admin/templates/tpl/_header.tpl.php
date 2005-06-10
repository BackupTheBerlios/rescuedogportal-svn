<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
	<link rel="stylesheet" href="./templates/tpl/admin.css">
	<title>{$shopconfig_pagetitle}</title>
	{if $fehler == 1}<meta http-equiv="refresh" content="3; URL={$page_redirect}">{/if}
	<script type="text/javascript" src="../mod/js_tree/tree.js"></script>
	<script language="JavaScript" src="../templates/tpl/scripts.js"></script>
	<script type="text/javascript">
<!--
var session_hash = '{$sid}';
var lang_var_edit = 'bearbeiten';
var lang_var_del = 'anzeigen';
var lang_var_empty = 'leeren';
var lang_var_moderator_add = 'Moderator hinzuf&uuml;gen';


var TREE_ITEMS = [
	['<b>{$mandant_name}</b>','0',
		['<b>Mandanten Settings</b>','4',''
			{if $admin_can_use_index_portal == 1}			,['Index - Portal','50','index_portal.php|16|2']		{/if}
			{if $admin_can_use_index_projects == 1}			,['Index - Projects','50','index_projects.php|16|2'],	{/if}
			{if $admin_can_use_index_sponsors == 1}			,['Index - Sponsors','50','index_sponsors.php|16|2'],	{/if}
			{if $admin_can_use_customer_users == 1}			,['Userverwaltung','50','customer.php|16|1',			{/if}
			{if $admin_can_use_customer_users_group == 1}		['Gruppen','50','customer_groups.php|16|2'],		{/if}
			{if $admin_can_use_customer_users == 1}				['Hunde','50','customer_dogs.php|16|2']]			{/if}
			{if $admin_can_use_termin == 1}					,['Termine und Berichte','50','termin.php|16|2'],		{/if}
			{if $admin_can_use_training == 1}				,['Training','50','training.php|16|1',
																['Trainer','50','training_trainer.php|16|2'],
																['Ort','50','training_ort.php|16|2'],
																['Typ','50','training_typ.php|16|2']]				{/if}
		],
		['<b>Portal Settings</b>','4',''
			{if $admin_can_use_global_links == 1}			,['Linkverwaltung','50','link_cat.php|16|2']			{/if}
			{if $admin_can_use_downloads == 1}				,['Downloads','50','download_cat.php|16|2']				{/if}
			{if $admin_can_use_poll_admin == 1}				,['Poll Administration','53','0|16|2']					{/if}	
		],
		{if $admin_admin == 1}
		['<b>Master Administration Settings</b>','4',''
			{if $admin_can_use_mandant == 1}				,['Mandantverwaltung','50','mandant.php|16|2']			{/if}
			{if $admin_can_use_adminsession == 1}			,['Admin Sessions','51','adminsessions.php|16|2']		{/if}
		],
		{/if}
		['<b>Einfache Ansicht</b>','52','']
	]
];

//-->
</script>
</head>
<body>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td width="20%" valign="top" bgcolor="#E6E6E6">
			<table width="100%" height="100%">
				<tr>
					<td>
						<table width="100%" height="100%">
							<tr>
								<td height="50" valign="top"  align="left">
									<a href="welcome.php{$url_sid}" target="main"><img src="./bilder/acplogo.gif" border=0></a>
								</td>
							</tr>
							<tr>
								<td valign="top" width="100%" align="left">
									<!-- <p>Tree Items:</p> -->
									{if $simple_menu == 0}
										{if $admin_can_use_mandant_selection == 1}<form name="ChangeMandant_From"><select name="mandant" onChange="javascript:ChangeMandant(document.getElementsByName('mandant')[0].value, '{$url_und_sid}')">{$mandantselection}</select></form><hr>{/if}
										<script type="text/javascript">new tree (TREE_ITEMS, tree_tpl);</script>
									{else}
										<hr>
										<a href="index.php{$url_sid}">Home</a><br>
										<hr>
										{if $admin_can_use_mandant_selection == 1}<form name="ChangeMandant_From"><select name="mandant" onChange="javascript:ChangeMandant(document.getElementsByName('mandant')[0].value, '{$url_und_sid}')">{$mandantselection}</select></form><hr>{/if}
										
										<br><b>Mandanten Settings</b><br>
										{if $admin_can_use_index_portal == 1}<a href="index_portal.php{$url_sid}">Index - Portal</a><br>{/if}
										{if $admin_can_use_index_projects == 1}<a href="index_projects.php{$url_sid}">Index - Projects</a><br>{/if}
										{if $admin_can_use_index_sponsors == 1}<a href="index_sponsors.php{$url_sid}">Index - Sponsors</a><br>{/if}
										{if $admin_can_use_index_portal == 1 || $admin_can_use_index_projects == 1 || $admin_can_use_index_sponsors == 1}<hr>{/if}
										
										{if $admin_can_use_customer_users == 1}<a href="customer.php{$url_sid}">Userverwaltung</a><br>{/if}
										{if $admin_can_use_customer_users_group == 1}<a href="customer_groups.php{$url_sid}">Userverwaltung - Gruppen</a><br>{/if}
										{if $admin_can_use_customer_users == 1}<a href="customer_dogs.php{$url_sid}">Userverwaltung - Hunde</a><br><hr>{/if}
										{if $admin_can_use_termin == 1}<a href="termin.php{$url_sid}">Termine und Berichte</a><br><hr>{/if}
										{if $admin_can_use_training == 1}<a href="training.php{$url_sid}">Training</a><br><a href="training_trainer.php{$url_sid}">Training - Trainer</a><br><a href="training_ort.php{$url_sid}">Training - Ort</a><br><a href="training_typ.php{$url_sid}">Training - Typ</a><br><hr>{/if}
										
										<br><b>Portal Settings</b><br>
										{if $admin_can_use_global_links == 1}<a href="link_cat.php{$url_sid}">Linkverwaltung</a><br>{/if}
										{if $admin_can_use_downloads == 1}<a href="download_cat.php{$url_sid}">Downloads</a><br>{/if}
										{if $admin_can_use_poll_admin == 1}<a href="" onClick="javascript:window.open('../mod/poll/admin/index.php{$url_sid}', 'Poll Admin', 'width=850,height=400,left=0,top=0,scrollbars=yes')">Poll Administration</a><br>{/if}
										{if $admin_admin == 1}
											<hr>
											<br><b>Master Administration Settings</b><br>
											{if $admin_can_use_mandant == 1}<a href="mandant.php{$url_sid}">Mandantverwaltung</a><br>{/if}
											{if $admin_can_use_adminsession == 1}<a href="adminsessions.php{$url_sid}">Admin Sessions</a><br>{/if}									
										{/if}
										<hr>
										<a href="index.php{$url_sid}&simple=0">Komplexe Ansicht</a>
									{/if}
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="1%" bgcolor="#003366" valign="top">&nbsp;</td>
		<td bgcolor="#E6E6E6" width="79%" valign="top">
			<table width="100%" height="100%">
				<tr>
					<td>
						<table border="0" cellpadding="2" cellspacing="0" width="100%">
							<tr>
								<td>
									<b>{$shopconfig_pagetitle}</b> - Admin Control
								</td>
								<td align="right">
									<b><a href="index.php" target="_parent">Abmelden</a></b> 
									| <b><a href="../index.php" target="_blank">Zur Staffelseite</a></b>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>		
				  	<td valign="top" height="100%" bgcolor="#FFFFFF"> 