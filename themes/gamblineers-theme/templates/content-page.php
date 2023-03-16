<?php
do_action( 'qm/start', 'page' );
  if (!$modules = get_field('modules') ): //get_post_meta( get_the_ID(), '', true )) :

    $modules = [
      [
        'acf_fc_layout' => 'simple_header',
        'manually' => [
          'breadcrumbs' => '',
          'graphic' => '1',
          'title' => [
            'tag' => 'h1',
            'title' => get_the_title(),
            'color' => 'tc-w',
          ],
          'content' => '',
          'limit_d' => 0,
          'limit_m' => 0
        ],
        'settings' => [
          'section_id' => '',
          'css_classes' => '',
          'text_color' => [
            'type' => '1',
            'theme' => '0'
          ],
          'text_align' => [
            'tad' => 'ta-u-sm-c',
            'tam' => 'ta-o-xs-c'
          ],
          'background' => [
            'desktop' => [
              'type' => '1',
              'theme' => 'bg-u-sm-pv'
            ],
            'mobile' => [
              'type' => '1',
              'theme' => 'bg-o-xs-pv'
            ]
          ],
          'visibility' => '0',
          'defer' => ''
        ]
      ],
      [
        'acf_fc_layout' => 'text-section',
        'manually' => [
          'blocks' => [
            [
              'content' => wpautop(get_the_content()),
            ]
          ],
          'bullets' => 'ul--circle',
          'layout' => [
            'ld' => '0',
            'lm' => '0'
          ]
        ],
        'settings' => [ 
          'section_id' => '',
          'css_classes' => '',
          'text_color' => [
            'type' => '1',
            'theme' => '0'
          ],
          'text_align' => [
            'tad' => '0',
            'tam' => '0'
          ],
          'background' => [
            'desktop' => [
              'type' => '1',
              'theme' => '0',
            ],
            'mobile' => [
              'type' => '1',
              'theme' => '0',
            ]
          ],
          'visibility' => '0',
          'defer' => ''
        ]
      ]
    ];
  endif;

  cf_get_template('modular.php', CF_TEMPLATES_DIR, ['modules' => $modules]);
  
  if ( get_option( 'options_ab_pages', false ) ) :
    cf_get_template('author-box.php', CF_TEMPLATES_MODULE_DIR, [
      'view' => 'author-box',
      'settings' => ['class' => 'bg-u-sm-s bg-o-xs-s'],
      'defer' => true
    ]);
  endif;
do_action( 'qm/stop', 'page' );