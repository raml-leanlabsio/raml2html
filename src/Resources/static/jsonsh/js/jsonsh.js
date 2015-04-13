/**
 * JSONSH - JSON Syntax Highlight
 *
 * @version v0.2.0 ( 4/20/2012 )
 *
 * @author <a href="http://www.peterschmalfeldt.com">Peter Schmalfeldt</a>
 *
 * @namespace jsonsh
 */
var jsonsh = {

    /** Track whether we've done an initial reformatting */
    is_pretty: false,

    /** Store old Source to compare if changes were made before formatting again */
    old_value: '',

    /** Store old api url to compare if changes were made before formatting again */
    old_url: '',

    /** Single place to update how fast/slow the animations will take */
    animation_speed: 250,

    /** Single place to update how you want to manage the tabbing in your reformatting */
    tab_space: '  ',

    /** Initialize JSONSH */
    init: function(el)
    {
        var _this = this;
        jQuery(el).find('.code').each(function(){
            _this.make_pretty(this);
        });
    },

    /**  */
    make_pretty: function(el)
    {
        el = jQuery(el);
        var json = el.val();

        /** Try to Validate & Format Source */
        if(json != '')
        {
            var box = jQuery(el.parent());
            box.html('<pre class="prettyprint"><code class="language-js">' + json + '</code></pre>');

            /** Now that the heavy lifing is done, MAKE IT PRETTY */
            prettyPrint();

                /** Bring up the reset link to allow user to get back to the begging ASAP */
            //}
            /** Invalid Source */
            /*catch(error)
            {
                *//** Bring up the reset link to allow user to get back to the begging ASAP *//*
                jQuery('.reset').fadeIn(jsonsh.animation_speed);

                *//** Show the error message we got to the user so then know what's up *//*
                jQuery('#result').addClass('fail').html(error.message).fadeIn();
            }*/
        }
    }
};
