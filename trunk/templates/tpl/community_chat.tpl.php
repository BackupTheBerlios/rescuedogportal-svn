{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>{$shopconfig_pagetitle} Chat</b></span></td>
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tablea">
			<form name="jform">
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
				<tr>
					<td>
						<select class="input" name="channels" onChange="jchat.processJInput(jform.channels.options[jform.channels.selectedIndex].value)">
							<option value="">Select Channel...</option>
							<option value="/join #rettungshundeforum"> #rettungshundeforum</option>
							<option value="/join "> </option>
						</select>
						
						<select class="input" name="actions" onChange="jchat.processJInput(jform.actions.options[jform.actions.selectedIndex].value)">
							<option value="">Select Action...</option>
							<option value="/me fall down laughing ...."> fall down laughing ....</option>
							<option value="/me just gave you a %Rfinger"> just gave you a finger</option>
							<option value="/me wants to be %C9,4%Blike Mike!"> wants to be like Mike</option>

						</select>
						
						<select class="input" name="sound" onChange="jchat.processJInput(jform.sound.options[jform.sound.selectedIndex].value)">
							<option value="">Select Sound...</option>
							<option value="/s yahoo"> Yahoo!</option>
							<option value="/s no"> No !</option>
							<option value="/s ohyea"> Oh Yea!</option>

						</select>
						
						<select class="input" name="emotion" onChange="jchat.processJInput(jform.emotion.options[jform.emotion.selectedIndex].value)">
							<option value=":)">:)</option>
							<option value=":(">:(</option>
							<option value=":D">:D</option>
							<option value=":P">:P</option>
							<option value=";(">;(</option>

							<option value=":applause:">:applause:</option>
							<option value=":kiss:">:kiss:</option>
							<option value=":hello:">:hello:</option>
							<option value=":banghead:">:banghead:</option>
							<option value=":confused:">:confused:</option>
							<option value=":mad:">:mad:</option>

							<option value=":cool:">:cool:</option>
							<option value=":evil:">:evil:</option>
							<option value=":love:">:love:</option>
							<option value=":thumbup:">:thumbup:</option>
							<option value=":thumbdown:">:thumbdown:</option>
							<option value=":bye:">:bye:</option>

						</select>
						<br />
						<a href="#" onclick="jchat.processJInput('/clear'); return false"><img src="bilder/mod/chat/chat_clear.gif" border="0" alt="Clear Screen" width="68" height="16"></a>
						<a href="#" onclick="jchat.processJInput('/nick '+prompt('Nickname','')); return false"><img src="bilder/mod/chat/chat_nick.gif" border="0" alt="Nickname" width="68" height="16" /></a>
						<a href="#" onclick="jchat.processJInput('/quit '+prompt('Chat verlassen!','')); return false"><img src="bilder/mod/chat/chat_quit.gif" border="0" alt="Chat verlassen!" width="68" height="16" /></a>
						<a href="#" onclick="jchat.processJInput('/msg '+prompt('Eine Nachricht versenden','')+' '+prompt('Welche Nachricht soll gesandt werden?','')); return false"><img src="bilder/mod/chat/chat_message.gif" border="0" alt="Eine Nachricht versenden" width="68" height="16" /></a>
						<a href="#" onclick="jchat.processJInput('/topic % '+prompt('Titel','')); return false"><img src="bilder/mod/chat/chat_topic.gif" border="0" alt="Titel" width="68" height="16" /></a>
						<a href="#" onclick="jchat.processJInput('/ctcp '+prompt('CTCP Befehl','')+' '+prompt('Welcher CTCP-Befel soll gesandt werden?','')); return false"><img src="bilder/mod/chat/chat_ctcp.gif" border="0" alt="CTCP Befehl" width="68" height="16" /></a>
						<a href="#" onclick="jchat.processJInput('/showurl '+prompt('URL','')); return false"><img src="bilder/mod/chat/chat_showurl.gif" border="0" alt="URL" width="68" height="16" /></a>

					</td>
				</tr>
				<tr>
					<td align="center">
					<nobr>
						<applet name="jchat" codebase="mod/chat/" archive="jirc_nss.zip,resources.zip"  code="Chat.class" width="100%" height="300" MAYSCRIPT>

							<param name="CABBASE" value="jirc_mss.cab,resources.cab">
							<param name="UserCmdColor" value="blue">
							<param name="BackgroundColor" value="#969696">
							<param name="TextColor" value="black">
							<param name="TextScreenColor" value="white">
							<param name="ListTextColor" value="blue">
							<param name="ListScreenColor" value="234,233,209">
							<param name="LogoBorderColor" value="white">
							<param name="TitleForegroundColor" value="white">

							<param name="TitleBackgroundColor" value="black">
							<param name="TextFontSize" value="12">
							<param name="TextFontName" value="Arial">
							<param name="FGColor" value="black">
							<param name="InputTextColor" value="black">
							<param name="InputScreenwhiteColor" value="">
							<param name="ServerPort" value="6667">
							<param name="ServerName1" value="irc.free-irc.de">
							<param name="ServerName2" value="irc.free-irc.de">

							<param name="Channel1" value="#rettungshundeforum">
							<param name="Channel2" value="">
							<param name="Channel3" value="">
							<param name="Channel4" value="">
							<param name="Channel5" value="">
							<param name="HostName" value="localhost" >
							<param name="WelcomeMessage" value="Willkommen im BRK Rettungshundeportal JIRC Chat!">
							<param name="RealName" value="rescue-dog_1">
							<param name="NickName" value="rescue-dog_1">
							<param name="UserName" value="rescue-dog_1">
														
							<param name="DisplayConfigRealName" value="false">
							<param name="DisplayConfigServer" value="false">
							<param name="DisplayConfigPort" value="false">
							<param name="DisplayConfigMisc" value="false">
							<param name="AllowShowURL" value="true">
							<param name="AllowIdentd" value="true">
							<param name="AllowURL" value="true">
														
							<param name="FilterKeys" value=":) :( :D :P ;) :confused: :mad: :cool: ;( :love: :thumbup: :thumbdown: :evil: :kiss: :hello: :applause: :banghead: :bye:">

							<param name="FilterVals" value="smile.gif frown.gif biggrin.gif tongue.gif wink.gif confused.gif mad.gif cool.gif evil.gif love.gif thumbup.gif thumbdown.gif evil.gif kiss.gif hello.gif applause.gif banghead.gif bye.gif">
							
							<param name="UseModeIcons" value="true">
							<param name="TimeStampFormat" value="hh:mm a" >
							<param name="AllowTimeStamp" value="true">
							
							<param name="UserProfileURL" value="http://www.rettungshundeforum.com/profile.php?action=chat&username" >
							
							<param name="FieldNameProfileButton" value="Profil">
							<param name="FieldNameChannelJoined" value="Chat betreten" >
							<param name="FieldNameChannelLeft" value="Chat verlassen" >
							<param name="FieldNameChannelLeft" value="Chat verlassen" >

							<param name="FieldNameNickNotify" value="Nickname verändern">
							<param name="FieldNamePrivateIgnore" value="Ignorieren">
							<param name="FieldNameConnecting" value="Verbinden...">
							<param name="FieldNameConnected" value="Verbunden">
							<param name="FieldNameConnectionClose" value="Verbindung abgebrochen">
							<param name="FieldNameQuitMsg" value="Bye Bye">
							<param name="FieldNamePrivateClose" value="CloseClose">
							<param name="FieldNamePrivateChatTitle" value="RHF Chat">
														
							<param name="IgnoreUser" value="ignore user : ">

							<param name="ActivateUser" value="activate  user : ">
	
							<param name="ConfigBorderColor" value="204,153,51">
							<param name="LogoBgColor" value="white">
																	
							<param name="AllowJoinSound" value="true" >
							<param name="AllowLeaveSound" value="true">
							<param name="LogoGifName" value="IRClogo.gif">
							<param name="RefreshColorCode" value="false">
							<param name="SoundMsg" value="Play Sound">
							<param name="NickNameColor" value="6">
							<param name="NickMaskStart" value="">
							<param name="NickMaskEnd" value=":">
							
							<param name="PWindowHeight" value="250">
							<param name="PWindowWidth" value="400">
							<param name="BorderSpacing" value="0">
							<param name="BorderVsp" value="3">
							
							<param name="IgnoreMOTD" value="true">
							<param name="IgnoreModeMsg" value="true">
							<param name="IgnoreServerMsg" value="true">

							<param name="IgnoreCode" value="5" >						
						</applet>
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<br />
{include file="_footer.tpl.php" title=foo}