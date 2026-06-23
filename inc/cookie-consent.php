<?php
if (!defined('ABSPATH')) exit;

add_action('wp_footer', function() {
    $privacy_url = get_privacy_policy_url();
    if (!$privacy_url)
        $privacy_url = home_url('/privacy-policy/');
    ?>
    <div class="cookie-consent" id="glc-cookie-consent">
        <div class="cookie-consent__inner container">
            <p class="cookie-consent__text">
                Ми використовуємо файли cookie для аналітики та покращення роботи сайту.
                <a href="<?php echo esc_url($privacy_url); ?>" class="cookie-consent__link">Політика конфіденційності</a>
            </p>
            <div class="cookie-consent__actions">
                <button type="button" class="btn--primary cookie-consent__btn" id="glc-consent-accept">Прийняти</button>
                <button type="button" class="btn--outline cookie-consent__btn" id="glc-consent-decline">Відхилити</button>
            </div>
        </div>
    </div>
    <script>
    (function() {
        var banner = document.getElementById('glc-cookie-consent');

        function getCookie(name) {
            var match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
            return match ? match[1] : '';
        }

        if (!getCookie('glc_consent')) {
            banner.style.display = 'flex';
        }

        function setCookie(name, value, days) {
            var d = new Date();
            d.setTime(d.getTime() + days * 86400000);
            document.cookie = name + '=' + value + ';expires=' + d.toUTCString() + ';path=/;SameSite=Lax' + (location.protocol === 'https:' ? ';Secure' : '');
        }

        document.getElementById('glc-consent-accept').addEventListener('click', function() {
            setCookie('glc_consent', '1', 365);
            banner.style.display = 'none';
            location.reload();
        });

        document.getElementById('glc-consent-decline').addEventListener('click', function() {
            setCookie('glc_consent', '0', 365);
            banner.style.display = 'none';
            location.reload();
        });
    })();
    </script>
    <?php
}, 99);
