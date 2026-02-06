<?php

namespace BMianAddon\Widgets;

use Elementor\Modules\DynamicTags\Module as TagsModule;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class b_html5_addon extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'Html5VideoPlayer';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Html5 Video Player', 'media-player-addons-for-elementor');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'bl_icon fas fa-video eicon-play';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['media-player-addons-for-elementor'];
    }

    public function get_script_depends()
    {
        return ['plyr-js', 'html5-player-main', 'hls', 'elementor-frontend'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls()
    {



        //Vedio player Content Settings

        //single video

        $this->start_controls_section(
            '_section_images',
            [
                'label' => __('Vedio Player Content Settings', 'media-player-addons-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,

            ]
        );



        $this->add_control(
            'choose_source',
            [
                'label'         => __('Multiple Quality', 'media-player-addons-for-elementor'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __('yes', 'media-player-addons-for-elementor'),
                'label_off'     => __('no', 'media-player-addons-for-elementor'),
                'return_value'  => 'yes',
                'default'       => '',
            ]
        );

        $this->add_control(
            'srrc_type',
            [
                'label' => esc_html__('Source From', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'uploaad',
                'options' => [
                    'uploaad' => esc_html__('Media Library', 'media-player-addons-for-elementor'),
                    'liink' => esc_html__('Video File Link', 'media-player-addons-for-elementor'),
                ],
                'condition' => [
                    'choose_source'    =>  '',
                ]

            ]
        );
        $this->add_control(
            'videoos_upload',
            [
                'label' => esc_html__('Upload Video', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'choose_source'    =>  '',
                    'srrc_type'     => 'uploaad',
                ]
            ]
        );
        $this->add_control(
            'videoos_link',
            [
                'label' => esc_html__('Video Link', 'media-player-addons-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://your-link.com', 'media-player-addons-for-elementor'),
                'default' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',
                'condition' => [
                    'choose_source'    =>  '',
                    'srrc_type'     => 'liink',
                ]
            ]
        );

        $this->add_control(
            'custom_poster',
            [
                'label' => esc_html__('Add Custom Poster', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'media-player-addons-for-elementor'),
                'label_off' => esc_html__('No', 'media-player-addons-for-elementor'),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'poster',
            [
                'label' => esc_html__('Custom Poster For Video', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'custom_poster'    =>  'true',
                ]
            ]
        );

        //End single video


        //Start Multiple video
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'src_type',
            [
                'label' => esc_html__('Video Source', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'upload',
                'options' => [
                    'upload' => esc_html__('Upload Video', 'media-player-addons-for-elementor'),
                    'link' => esc_html__('Put Video Link', 'media-player-addons-for-elementor'),
                ],
            ]
        );
        $repeater->add_control(
            'video_upload',
            [
                'label' => esc_html__('Upload Video', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'src_type'     => 'upload',
                ]
            ]
        );
        $repeater->add_control(
            'video_link',
            [
                'label' => esc_html__('Video Link', 'media-player-addons-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://your-link.com', 'media-player-addons-for-elementor'),
                'default' => 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4',
                'condition' => [
                    'src_type'     => 'link',
                ]
            ]
        );
        $repeater->add_control(
            'video_size',
            [
                'label' => esc_html__('Video Size', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__('Select', 'media-player-addons-for-elementor'),
                    '240' => esc_html__('240', 'media-player-addons-for-elementor'),
                    '360' => esc_html__('360', 'media-player-addons-for-elementor'),
                    '480' => esc_html__('480', 'media-player-addons-for-elementor'),
                    '576' => esc_html__('576', 'media-player-addons-for-elementor'),
                    '720' => esc_html__('720', 'media-player-addons-for-elementor'),
                    '1080' => esc_html__('1080', 'media-player-addons-for-elementor'),
                    '1440' => esc_html__('1440', 'media-player-addons-for-elementor'),
                    '2160' => esc_html__('2160', 'media-player-addons-for-elementor'),
                    '2880' => esc_html__('2880', 'media-player-addons-for-elementor'),
                    '4320'  => esc_html__('4320', 'media-player-addons-for-elementor'),
                ],
            ]
        );

        $this->add_control(
            'video_list',
            [
                'label' => esc_html__('Video List', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'choose_source'    =>  'yes',
                ]

            ]
        );

        $this->end_controls_section();
        //End multiple video


        // Vedo subtitle start
        $this->start_controls_section(
            '_sub_settings',
            [
                'label' => __('Vedio Player Subtitle Settings', 'media-player-addons-for-elementor'),

            ]
        );
        $repeaterg = new \Elementor\Repeater();
        $repeaterg->add_control(
            'src_typed',
            [
                'label' => esc_html__('Subtitle Source', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SELECT,
                'default' => 'uploadds',
                'options' => [
                    'uploadds' => esc_html__('Upload Subtitle', 'media-player-addons-for-elementor'),
                    'linkks' => esc_html__('Put Subtitle Link', 'media-player-addons-for-elementor'),
                ],
            ]
        );
        $repeaterg->add_control(
            'subtitle_upload',
            [
                'label' => esc_html__('Upload Subtitle', 'media-player-addons-for-elementor'),

                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'vtt',
                'condition' => [
                    'src_typed'    =>  'uploadds',
                ]
            ]
        );
        $repeaterg->add_control(
            'subtitle_link',
            [
                'label' => esc_html__('Subtitle Link', 'media-player-addons-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('https://your-link.com', 'media-player-addons-for-elementor'),
                'condition' => [
                    'src_typed'    =>  'linkks',
                ]
            ]
        );
        $repeaterg->add_control(
            'subtitle_ssize',
            [
                'label' => esc_html__('Subtitle language', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Eg: English, For english subtitle write English', 'media-player-addons-for-elementor'),
                'sanitize_callback' => 'sanitize_text_field',

            ]
        );
        $this->add_control(
            'subtitle_list',
            [
                'label' => esc_html__('Subtitle List', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeaterg->get_controls(),


            ]
        );
        $this->end_controls_section();

        //Vedio player Color Settings
        $this->start_controls_section(
            'section_ttabb',
            [
                'label' => esc_html__('Vedio Player Color Settings', 'media-player-addons-for-elementor'),
                'tab'  => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'all_bg',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Controls Hover Background Color', 'media-player-addons-for-elementor'),
                'default'   =>  '#00b3ff',
            ]
        );

           $this->add_control(
            'captions_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Video Captions Background Color', 'media-player-addons-for-elementor'),
                'default'   =>  '#1F2425',
            ]
        );

           $this->add_control(
            'plr_range_bg',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Progressbar Thumb Color', 'media-player-addons-for-elementor'),
                'default'   =>  '#ffff',
            ]
        );

        $this->add_control(
        'tooltip_text',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Tooltip Text Color', 'media-player-addons-for-elementor'),
            'default'   =>  '#000',
        ]
    );

        $this->add_control(
        'tooltip_bg',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Tooltip Background Color', 'media-player-addons-for-elementor'),
            'default'   =>  '#ffff',
        ]
    );

       $this->add_control(
        'v_r_t_b',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Progressbar Color', 'media-player-addons-for-elementor'),
            'default'   =>  '#73888A',
        ]
    );

        $this->add_control(
        'p_b_b',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Badge Background', 'media-player-addons-for-elementor'),
            'default'   =>  '#4a5464',
        ]
    );
    $this->add_control( 
    'p_b_t_c',
    [
        'type' => Controls_Manager::COLOR,
        'label' =>esc_html__('Badge Text Color', 'media-player-addons-for-elementor'),
        'default'   =>  '#fff',
    ]
    );


    $this->add_control( 
    'v_c_c_h',
    [
        'type' => Controls_Manager::COLOR,
        'label' =>esc_html__('Controls Hover Color', 'media-player-addons-for-elementor'),
        'default'   =>  '#fff',
    ]
    );


  $this->add_control( 
    'p_c_t_c',
    [
        'type' => Controls_Manager::COLOR,
        'label' =>esc_html__('Captions Text Color', 'media-player-addons-for-elementor'),
        'default'   =>  '#ffff',
    ]
    );

  $this->add_control( 
    'v_c_c',
    [
        'type' => Controls_Manager::COLOR,
        'label' =>esc_html__('Player All Icon Color', 'media-player-addons-for-elementor'),
        'default'   =>  '#ffff',
    ]
    );

        $this->end_controls_section();

        //Vedio player Control Settings
        $this->start_controls_section(
            'section_tabb',
            [
                'label' => esc_html__('Vedio Player Control Settings', 'media-player-addons-for-elementor'),
            ]
        );

        $this->add_control(
		'show_large_play',
		[
			'label' => __( 'Large Play', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'restart',
		[
			'label' => __( 'Restart', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
         $this->add_control(
		'rewind',
		[
			'label' => __( 'Rewind', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

           $this->add_control(
		'play',
		[
			'label' => __( 'Play', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
        $this->add_control(
		'fast-forward',
		[
			'label' => __( 'Fast-Forward', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'progress',
		[
			'label' => __( 'Progress', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

      $this->add_control(
		'current-time',
		[
			'label' => __( 'Current-Time', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
       $this->add_control(
		'duration',
		[
			'label' => __( 'Duration', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
       $this->add_control(
		'mute',
		[
			'label' => __( 'Mute', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

         $this->add_control(
		'volume',
		[
			'label' => __( 'Volume', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
           $this->add_control(
		'captions',
		[
			'label' => __( 'Captions', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);


         $this->add_control(
		'settings',
		[
			'label' => __( 'Settings', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'pip',
		[
			'label' => __( 'Pip', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

         $this->add_control(
		'airplay',
		[
			'label' => __( 'Airplay', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'download',
		[
			'label' => __( 'Download', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);
            $this->add_control(
		'fullscreen',
		[
			'label' => __( 'Fullscreen', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'Hide', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->end_controls_section();
        //Others settings

        $this->start_controls_section(
            'se_ttabb',
            [
                'label' => esc_html__('Vedio Player Other Settings', 'media-player-addons-for-elementor'),
            ]
        );

        $this->add_control(
			'p_c_i_s',
			[
				'label' 		=> esc_html__( 'Player Control Icon Size', 'media-player-addons-for-elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=>['px'],
				'range' 		=> 
				[
					'px' => [
						'min' 	=> 0,
						'max' 	=> 20,
						'step' 	=> 1,
					],
				
				],
				'default' => [
					'unit' => 'px',
					'size' => 18,
				],
			]
		);
         $this->add_control(
			'p_r_t_h',
			[
				'label' 		=> esc_html__( 'Player Range Thumb Size', 'media-player-addons-for-elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=>['px'],
				'range' 		=> 
				[
					'px' => [
						'min' 	=> 0,
						'max' 	=> 15,
						'step' 	=> 1,
					],
				
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
			]
		);

        $this->end_controls_section();
    }
    public function is_premium() 
    {
        return function_exists('mpafe_fs') && mpafe_fs()->can_use_premium_code();
    }

    public function add_control($name, $args = [], $options = [])
    {
        // Check if this is a premium control and user doesn't have premium access
        if (!$this->is_premium() && in_array($name, $this->premium_controls())) {
            // Append _locked to control name
            $name = $name . '_locked';

            // Add Pro label and locked class
            $args['label'] = $args['label'] . " <span class='fs_pro_control_label'>Pro</span>";
            $args['classes'] = isset($args['classes']) ? $args['classes'] . ' fs-locked' : 'fs-locked';
        }

        parent::add_control($name, $args, $options);
    }

    public function premium_controls()
    {
        return [
           'fast-forward',
           'volume',
           'captions',
           'settings',
           'pip',
           'airplay',
           'download',
           'fullscreen',
           'all_bg',
           'captions_color',
           'plr_range_bg',
           'tooltip_text',
           'tooltip_bg',
           'v_r_t_b',
           'p_b_b',
           'p_b_t_c',
           'v_c_c_h',
           'p_c_t_c',
           'v_c_c',
           'p_r_t_h',
           'p_c_i_s',
        ];
    }
    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
		$settings = $this->get_settings_for_display();

		 $video_list = $settings['video_list'];
         $multiple_quality = $settings['choose_source'];
         $subtitle_list = $settings['subtitle_list'];

        $all_bg         = !empty($settings['all_bg']) ? $settings['all_bg'] : '#00b3ff';
        $captions_color = !empty($settings['captions_color']) ? $settings['captions_color'] : '#ffffff';
        $plr_range_bg   = !empty($settings['plr_range_bg']) ? $settings['plr_range_bg'] : '#cccccc';
        $tooltip_text   = !empty($settings['tooltip_text']) ? $settings['tooltip_text'] : '#000';
        $tooltip_bg     = !empty($settings['tooltip_bg']) ? $settings['tooltip_bg'] : '#ffffff';
        $v_r_t_b        = !empty($settings['v_r_t_b']) ? $settings['v_r_t_b'] : '#fff';
        $p_c_i_s        = !empty($settings['p_c_i_s']) ? $settings['p_c_i_s'] : ['size' => 16];
        $p_b_b          = !empty($settings['p_b_b']) ? $settings['p_b_b'] : '#ffffff';
        $p_b_t_c        = !empty($settings['p_b_t_c']) ? $settings['p_b_t_c'] : '#000000';
        $v_c_c_h        = !empty($settings['v_c_c_h']) ? $settings['v_c_c_h'] : '#fff';
        $p_c_t_c        = !empty($settings['p_c_t_c']) ? $settings['p_c_t_c'] : '#000000';
        $v_c_c          = !empty($settings['v_c_c']) ? $settings['v_c_c'] : '#fff';
		$poster    = $settings['poster'];

        $show_large_play = isset($settings['show_large_play']) ? $settings['show_large_play'] : 'no';
        $restart         = isset($settings['restart']) ? $settings['restart'] : 'no';
        $rewind          = isset($settings['rewind']) ? $settings['rewind'] : 'no';
        $play            = isset($settings['play']) ? $settings['play'] : 'no';
        $fastforward     = isset($settings['fast-forward']) ? $settings['fast-forward'] : 'no';
        $progress        = isset($settings['progress']) ? $settings['progress'] : 'no';
        $currenttime     = isset($settings['current-time']) ? $settings['current-time'] : 'no';
        $duration        = isset($settings['duration']) ? $settings['duration'] : 'no';
        $mute            = isset($settings['mute']) ? $settings['mute'] : 'no';
        $volume          = isset($settings['volume']) ? $settings['volume'] : 'no';
        $captions        = isset($settings['captions']) ? $settings['captions'] : 'no';
        $sets            = isset($settings['settings']) ? $settings['settings'] : 'no';
        $pip             = isset($settings['pip']) ? $settings['pip'] : 'no';
        $airplay         = isset($settings['airplay']) ? $settings['airplay'] : 'no';
        $download        = isset($settings['download']) ? $settings['download'] : 'no';
        $fullscreen      = isset($settings['fullscreen']) ? $settings['fullscreen'] : 'no';


		$controls = [];
		$controls['play-large'] = $show_large_play == 'yes' ? 'yes' : 'no';
		$controls['all_bg'] = $all_bg == 'yes' ? 'yes' : 'no';
		$controls['captions_color'] = $captions_color == 'yes' ? 'yes' : 'no';
		$controls['tooltip_text'] = $tooltip_text == 'yes' ? 'yes' : 'no';
		$controls['tooltip_bg'] = $tooltip_bg == 'yes' ? 'yes' : 'no';
		$controls['plr_range_bg'] = $plr_range_bg == 'yes' ? 'yes' : 'no';
		$controls['p_c_i_s'] = $p_c_i_s == 'yes' ? 'yes' : 'no';
		$controls['p_b_t_c'] = $p_b_t_c == 'yes' ? 'yes' : 'no';
		$controls['v_c_c_h'] = $v_c_c_h == 'yes' ? 'yes' : 'no';
		$controls['p_c_t_c'] = $p_c_t_c == 'yes' ? 'yes' : 'no';
		$controls['v_c_c'] = $v_c_c == 'yes' ? 'yes' : 'no';
		$controls['v_r_t_b'] = $v_r_t_b == 'yes' ? 'yes' : 'no';
		$controls['restart'] = $restart == 'yes' ? 'yes' : 'no';
		$controls['rewind'] = $rewind == 'yes' ? 'yes' : 'no';
		$controls['play'] = $play == 'yes' ? 'yes' : 'no';
		$controls['fast-forward'] = $fastforward == 'yes' ? 'yes' : 'no';
		$controls['progress'] = $progress == 'yes' ? 'yes' : 'no';
		$controls['current-time'] = $currenttime == 'yes' ? 'yes' : 'no';
		$controls['duration'] = $duration == 'yes' ? 'yes' : 'no';
		$controls['mute'] = $mute == 'yes' ? 'yes' : 'no';
		$controls['volume'] = $volume == 'yes' ? 'yes' : 'no';
		$controls['captions'] = $captions == 'yes' ? 'yes' : 'no';
		$controls['settings'] = $sets == 'yes' ? 'yes' : 'no';
		$controls['pip'] = $pip == 'yes' ? 'yes' : 'no';
		$controls['airplay'] = $airplay == 'yes' ? 'yes' : 'no';
		$controls['download'] = $download == 'yes' ? 'yes' : 'no';
		$controls['fullscreen'] = $fullscreen == 'yes' ? 'yes' : 'no';

        $thumb_height = ! empty( $settings['p_r_t_h'] ) ? $settings['p_r_t_h'] : '14';
		
	?>
	  <?php
          $video_link = '';   
          $videoos_link = '';
          $subtitle_link = '';
          //single vedio
            if($settings['srrc_type'] == 'uploaad'){
            $videoos_link = $settings['videoos_upload']['url'];
        } else {
            $videoos_link = $settings['videoos_link'];
        }
          $extensionn = $ext = pathinfo($videoos_link, PATHINFO_EXTENSION);   
       ?>

    <video src="<?php echo esc_url($videoos_link); ?>" class="b_addon_player" data-settings='<?php echo wp_json_encode($controls) ?>' style="--plyr-color-main:<?php echo esc_attr($all_bg);?>;--plyr-control-icon-size:<?php echo esc_attr($p_c_i_s['size']).'px' ?>;--plyr-range-thumb-background:<?php echo esc_attr($plr_range_bg); ?>;--plyr-range-thumb-height:<?php echo esc_attr($thumb_height).'px' ?>;--plyr-tooltip-color:<?php echo esc_attr($tooltip_text); ?>;--plyr-tooltip-background:<?php echo esc_attr($tooltip_bg); ?>;--plyr-video-range-track-background:<?php echo esc_attr($v_r_t_b); ?>;--plyr-badge-background:<?php echo esc_attr($p_b_b); ?>;--plyr-badge-text-color:<?php echo esc_attr($p_b_t_c); ?>;--plyr-video-control-color-hover:<?php echo esc_attr($v_c_c_h); ?>;--plyr-video-control-color:<?php echo esc_attr($v_c_c); ?>;--plyr-captions-background:<?php echo esc_attr($captions_color); ?>;--plyr-captions-text-color:<?php echo esc_attr($p_c_t_c); ?>;" playsinline controls data-poster="<?php echo esc_url($poster['url']); ?>">

        <?php if($multiple_quality !== 'yes'): ?>
        <source src="<?php echo esc_url($videoos_link); ?>" type="video/<?php echo esc_attr($extensionn); ?>"/>
	  	<?php else: 
	  		foreach($video_list as $item):
                if($item['src_type'] == 'upload'){
                    $video_link = $item['video_upload']['url'];
                    $video_link = $video_link;
                    $video_size = $item['video_size'];
                } else {
                    $video_link = $item['video_link'];
                    $video_link = $video_link;
                    $video_size = $item['video_size'];
                }
            $extension = $ext = pathinfo($video_link, PATHINFO_EXTENSION);
	  	 ?>
	  	 <source src="<?php echo esc_url($video_link); ?>" type="video/<?php echo esc_attr($extension); ?>" size="<?php echo esc_attr($video_size); ?>"/>
	  <?php endforeach; endif; ?>

      <?php foreach($subtitle_list as $item):
          if($item['src_typed'] == 'uploadds'){
                    $subtitle_link = $item['subtitle_upload']['url'];
                    $subtitle_link = $subtitle_link;
                    $subtitle_ssize = $item['subtitle_ssize'];
                } else {
                    $subtitle_link = $item['subtitle_link'];
                    $subtitle_link = $subtitle_link;
                    $subtitle_ssize = $item['subtitle_ssize'];
                }
                 $extensionds = $ext = pathinfo($subtitle_link, PATHINFO_EXTENSION);
        ?>
	  <track kind="captions" label="<?php echo esc_attr($subtitle_ssize); ?>" kind="subtitles/<?php echo esc_attr($extension); ?>" src="<?php echo esc_url($subtitle_link);?>" srclang="<?php echo esc_attr($subtitle_ssize); ?>" default />
     <?php endforeach; ?>
	</video>
	<?php
    }
    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    // protected function _content_template() {}

}
## How can I report security bugs?
