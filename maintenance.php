<?php
if (!defined('ABSPATH')) exit;

$logo_url = get_template_directory_uri() . '/assets/img/logo/logo.svg';
$email = get_option('glc_email');
$phone_1 = get_option('glc_phone_1');
$phone_2 = get_option('glc_phone_2');
$digits_1 = preg_replace('/\D/', '', $phone_1);
$digits_2 = preg_replace('/\D/', '', $phone_2);

header('HTTP/1.1 503 Service Unavailable');
header('Retry-After: 3600');
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Сайт на технічному обслуговуванні — GLC</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Mulish', sans-serif;
            background: #f8f9fa;
            color: #333;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .maintenance {
            text-align: center;
            padding: 40px 20px;
            max-width: 560px;
        }

        .maintenance__logo {
            height: 60px;
            margin-bottom: 40px;
        }

        .maintenance__title {
            font-size: 28px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 16px;
        }

        .maintenance__desc {
            font-size: 18px;
            font-weight: 400;
            line-height: 1.5;
            color: #666;
            margin-bottom: 40px;
        }

        .maintenance__contacts {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .maintenance__contact-link {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }

        .maintenance__contact-link:hover { color: #f5c518; }

        @media (max-width: 480px) {
            .maintenance__title { font-size: 22px; }
            .maintenance__desc { font-size: 16px; }
        }
    </style>
</head>
<body>
    <div class="maintenance">
        <img src="<?php echo esc_url($logo_url); ?>" alt="GLC" class="maintenance__logo">
        <h1 class="maintenance__title">Сайт на технічному обслуговуванні</h1>
        <p class="maintenance__desc">Ми проводимо планові роботи. Сайт незабаром буде доступний. Дякуємо за терпіння!</p>

        <?php if ($email || $phone_1 || $phone_2): ?>
            <div class="maintenance__contacts">
                <?php if ($phone_1): ?>
                    <a href="tel:+<?php echo esc_attr($digits_1); ?>" class="maintenance__contact-link">
                        <?php echo esc_html(glc_format_phone($phone_1)); ?>
                    </a>
                <?php endif; ?>
                <?php if ($phone_2): ?>
                    <a href="tel:+<?php echo esc_attr($digits_2); ?>" class="maintenance__contact-link">
                        <?php echo esc_html(glc_format_phone($phone_2)); ?>
                    </a>
                <?php endif; ?>
                <?php if ($email): ?>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="maintenance__contact-link">
                        <?php echo esc_html($email); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php exit; ?>
