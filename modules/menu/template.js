function menu_menuChangePublic(link, data){
    if (data == 1) $(link).children('img').attr('src', DIR_TEMPLATE+'images/adminka/btn/btn_on.png');
    else $(link).children('img').attr('src', DIR_TEMPLATE+'images/adminka/btn/btn_off.png');
}





function menu_menuDelItem_before(link){
    if (confirm(WWcms.getTitle('js_ask_delItem'))) return true;
    else return false;
}