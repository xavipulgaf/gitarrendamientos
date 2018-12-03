/**
 * Created by waqasriaz on 11/04/17.
 */

function houzezCaptchaCallback() {

    if (typeof houzez_reCaptcha !== "undefined") {
        var site_key = houzez_reCaptcha.site_key;
        var secret_key = houzez_reCaptcha.secret_key;
        var lightbox_agent_cotnact = houzez_reCaptcha.lightbox_agent_cotnact;
        var is_singular_property = houzez_reCaptcha.is_singular_property;
        var houzez_logged_in = houzez_reCaptcha.houzez_logged_in;
        var houzez_show_captcha = houzez_reCaptcha.houzez_show_captcha;

        var houzez_recaptcha1;
        var houzez_recaptcha2;
        var houzez_recaptcha_lightbox;
        var houzez_recaptcha_login;
        var houzez_recaptcha_register;

        //Render the houzez_recaptcha1 on the element with ID "houzez_recaptcha1"
        if( houzez_show_captcha == 'yes' ) {
            houzez_recaptcha1 = grecaptcha.render('houzez_recaptcha1', {
                'sitekey': site_key, //Replace this with your Site key
                'theme': 'light'
            });
        }

        if( houzez_logged_in != 'yes' ) {
            houzez_recaptcha_login = grecaptcha.render('houzez_recaptcha_login', {
                'sitekey': site_key, //Replace this with your Site key
                'theme': 'light'
            });
            houzez_recaptcha_register = grecaptcha.render('houzez_recaptcha_register', {
                'sitekey': site_key, //Replace this with your Site key
                'theme': 'light'
            });
        }


        if( is_singular_property == 'yes' ) {
            //Render the houzez_recaptcha2 on the element with ID "houzez_recaptcha2"
            houzez_recaptcha2 = grecaptcha.render('houzez_recaptcha2', {
                'sitekey': site_key, //Replace this with your Site key
                'theme': 'light'
            });

            if (lightbox_agent_cotnact != 0) {
                //Render the houzez_recaptcha_lightbox on the element with ID "houzez_recaptcha_lightbox"
                houzez_recaptcha_lightbox = grecaptcha.render('houzez_recaptcha_lightbox', {
                    'sitekey': site_key, //Replace this with your Site key
                    'theme': 'light'
                });
            }
        }
    }
}