<script src="javascript/background.js"></script>
<link rel="stylesheet" type="text/css" href="css/background.css">

<div class="chat-popup small" id="widget">

    <div id="header-display" onclick="changeStat('normal')">
        <div class="header-display-icon"></div>
        <div class="header-display-text">Chat</div>
    </div>
    <div id="body-display" class="small-body">
        <div class="body-display-content"></div>
    </div>

    <div id="icon-openbig" class="icon" onclick="changeStat('big')"></div>
    <div id="icon-closebig" class="icon" onclick="changeStat('normal')"></div>
    <div id="icon-close" class="icon" onclick="changeStat('small')"></div>

</div>