<?php
return [
    'mode' => '',
    'format' => 'A4',
    'default_font_size' => '12',
    'default_font' => 'sans-serif',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 0,
    'margin_footer' => 5,
    'orientation' => 'P',
    'title' => 'Anamel pdf generator',
    'author' => '',
    'watermark' => '',
    'show_watermark' => false,
    'watermark_font' => 'sans-serif',
    'display_mode' => 'fullpage',
    'watermark_text_alpha' => 0.1,
    'custom_font_dir' => 'css/fonts',
    'custom_font_data' => [
        'cer-book' => [
            'R'  => 'cer-book.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        'NeoSansArabic' => [
            'R'  => 'NeoSansArabic.ttf',    // regular font
            'useOTL' => 0xFF,
        ],
        'arabic' => [
            'R'  => 'arabic.ttf',    // regular font
        ],
    ],
    'auto_language_detection' => true,
    'temp_dir' => rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
    'pdfa' => false,
    'pdfaauto' => false,
];
