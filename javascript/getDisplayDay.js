function getDisplayMatchDay(
    php_call, 
    id_joueur, 
    id_profil, 
    competition, 
    day, 
    current_day, 
    htmlcontentid, 
    button_prev_id, 
    button_next_id, 
    display_day_id,
    specific = null) {

    var contentElement = document.getElementById(htmlcontentid);

    var result = true;
    $.ajax({
        async: false, // !important
        url: 'ajax/'+php_call+'.php',
        data: 'id_joueur=' + id_joueur 
                + "&competition=" + competition 
                + "&day=" + day
                + "&id_profil=" + id_profil,
        success: function(data) {
            var dataJson = JSON.parse(data); 
            contentElement.innerHTML = dataJson.html;

            var button_prev = document.getElementById(button_prev_id);
            var button_next = document.getElementById(button_next_id);
            var display_day = document.getElementById(display_day_id);

            var prevDay = dataJson.id_prev_day;
            var nextDay = dataJson.id_next_day;

            if (prevDay && (specific != 'profilNext' || prevDay >= current_day)) {
                button_prev.classList.remove("viewMatchTitleArrowHidden");
                button_prev.onclick = function() {
                    getDisplayMatchDay(php_call, id_joueur, id_profil, competition, dataJson.id_prev_day, current_day, htmlcontentid, button_prev_id, button_next_id, display_day_id, specific)
                };
            }
            else {
                button_prev.classList.add("viewMatchTitleArrowHidden");
                button_prev.onclick = null;
            }

            if (nextDay && (specific != 'profilLast' || nextDay < current_day)) {
                button_next.classList.remove("viewMatchTitleArrowHidden");
                button_next.onclick = function() {
                    getDisplayMatchDay(php_call, id_joueur, id_profil, competition, dataJson.id_next_day, current_day, htmlcontentid, button_prev_id, button_next_id, display_day_id, specific)
                };
            }
            else {
                button_next.classList.add("viewMatchTitleArrowHidden");
                button_next.onclick = null;
            }
            
            
            display_day.innerHTML = "Journée " + day;
        }
    });
    return result;
}
