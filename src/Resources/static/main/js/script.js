function show_description(id) {

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

    $(document).on('DOMMouseScroll mousewheel', '.desc_resources', function(ev){
        console.log(123);
        var $this = $(this),
            scrollTop = this.scrollTop,
            scrollHeight = this.scrollHeight,
            height = $this.height(),
            delta = (ev.type == 'DOMMouseScroll' ?
            ev.originalEvent.detail * -40 :
                ev.originalEvent.wheelDelta),
            up = delta > 0;

        var prevent = function() {
            ev.stopPropagation();
            ev.preventDefault();
            ev.returnValue = false;
            return false;
        };

        if (!up && -delta > scrollHeight - height - scrollTop) {
            // Scrolling down, but this will take us past the bottom.
            $this.scrollTop(scrollHeight);
            return prevent();
        } else if (up && delta > scrollTop) {
            // Scrolling up, but this will take us past the top.
            $this.scrollTop(0);
            return prevent();
        }
    });
}
