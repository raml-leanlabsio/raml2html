function show_description(id){

    window.location.hash = id+'_desc_GET';

    var all = document.getElementsByClassName('desc_resources');


    for (var i = 0; i < all.length; i++) {
        all[i].style['display'] = 'none';
    }
    var el = document.getElementById(id+'_desc');

    jsonsh.init(el);

    if (el.style['display'] == 'none') {
        el.style['display'] = 'block';
    } else {
        el.style['display'] = 'none';
    }

    var allActive = document.getElementsByClassName('active_tab');

    if (allActive.length > 0) {
        for (i = 0; i < allActive.length; i++) {
            allActive[i].className = '';
        }
    }

    var current = document.getElementById(id);
    if (current) {
        current.className = 'active_tab';
    }
}
