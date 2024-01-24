<link rel="stylesheet" type="text/css" href="css/background.css">

<div class="chat-popup small" id="widget">
    <div id="header-display" onclick="changeStat('normal', true)">
        <div class="header-display-icon"></div>
        <div class="header-display-text">Chat</div>
    </div>
    <div id="body-display" class="small-body">
        <div class="body-display-content">
            <section class="chat">
                <div class="messages"></div>
                <div class="user-inputs">
                    <form class="chat-form" method="POST">
                        <input type="text" name="joueur_id" id="joueur_id" value="<?php echo $id ?>" style="display:none;"/>
                        <input type="text" autocomplete="off" id="content" name="content" placeholder="Tape ton message ici..."/>
                        <button type="submit" id="submit" disabled="disabled">Envoyer</button>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <div id="icon-openbig" class="icon" onclick="changeStat('big', false)"></div>
    <div id="icon-closebig" class="icon" onclick="changeStat('normal', false)"></div>
    <div id="icon-close" class="icon" onclick="changeStat('small', false)"></div>
    
    <script src="javascript/background.js"></script>
</div>