<?php
  // $params = [
  //   'results_per_page' => 3,
  //   'number_of_results' => 3,
  //   'order_by' => 'date',
  //   'list_type' => '3',
  //   'slider' => '1',
  //   'categories' => wp_get_post_terms(get_the_ID(), 'news-category', ['fields' => 'ids']),
  //   'show_categories' => '0',
  //   'load_more' => [],
  //   'button' => '',
  // ];
  $settings = [
    'section_id' => '',
    'css_classes' => '',
    'text_align' => [
      'tad' => '',
      'tam' => ''
    ],
    'background' => [
      'desktop' => [
        'type' => '1',
        'theme' => ''
      ],
      'mobile' => [
        'type' => '1',
        'theme' => ''
      ],
    ],
    'visibility' => 0,
    'defer' => ''
  ];
  $modules = [
    [
      'acf_fc_layout' => 'title',
      'manually' => $news['news_bottom'],
      'settings' => $settings
    ],
    [
      'acf_fc_layout' => 'list_news',
      'manually' => $news['news_bottom'],
      'settings' => $settings
    ]
  ];

  cf_get_template('modular.php', CF_TEMPLATES_DIR, [ 'modules' => $modules ]);
