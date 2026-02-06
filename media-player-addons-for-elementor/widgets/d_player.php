<?php
namespace BMianAddon\Widgets;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class d_player extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'dPlayer';
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
	public function get_title() {
		return esc_html__( 'dPlayer', 'media-player-addons-for-elementor' );
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
	public function get_icon() {
		return 'bl_icon fas fa-compact-disc eicon-slideshow';
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
	public function get_categories() {
		return [ 'media-player-addons-for-elementor' ];
	}

    public function get_script_depends() {
        return [ 'dplayermin-js', 'd-player-main-js', 'elementor-frontend'];
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
	protected function register_controls() {

  //Vedio player Content Settings

    $this->start_controls_section(
        '_section_video',
        [
            'label' => __( 'Vedio Player Content Settings', 'media-player-addons-for-elementor' ),
             
           
        ]
    );

    $this->add_control(
            'choose_v_source',
            [
                'label'         => __( 'Multiple Quality', 'media-player-addons-for-elementor' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'yes', 'media-player-addons-for-elementor' ),
                'label_off'     => __( 'no', 'media-player-addons-for-elementor' ),
                'return_value'  => 'yes',
                'default'       => '',
            ]
        );

       $this->add_control(
            'srrc_type',
            [
                'label' => esc_html__( 'Source From', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'uploaad',
                'options' => [
                    'uploaad' => esc_html__( 'Media Library', 'media-player-addons-for-elementor' ),
                    'liink' => esc_html__( 'Video File Link', 'media-player-addons-for-elementor' ),
                ],
                'condition' => [
                    'choose_v_source'    =>  '',
                ]
  
            ]
        );
       $this->add_control(
            'videoos_upload',
            [
                'label' => esc_html__( 'Upload Video', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'choose_v_source'    =>  '',
                    'srrc_type'     => 'uploaad',
                ]
            ]
        );
        $this->add_control(
            'videoos_link',
            [
                'label' => esc_html__( 'Video Link', 'media-player-addons-for-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'media-player-addons-for-elementor' ),
                'condition' => [
                    'choose_v_source'    =>  '',
                    'srrc_type'     => 'liink',
                ]
            ]
        );
    //End single video
    //Start Multiple video
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'src_v_type',
            [
                'label' => esc_html__( 'Video Source', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'upload',
                'options' => [
                    'upload' => esc_html__( 'Upload Video', 'media-player-addons-for-elementor' ),
                    'link' => esc_html__( 'Put Video Link', 'media-player-addons-for-elementor' ),
                ],
            ]
        );
        $repeater->add_control(
            'video_v_upload',
            [
                'label' => esc_html__( 'Upload Video', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
                'condition' => [
                    'src_v_type'     => 'upload',
                ]
            ]
        );
        $repeater->add_control(
            'video_v_link',
            [
                'label' => esc_html__( 'Video Link', 'media-player-addons-for-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'media-player-addons-for-elementor' ),
                'condition' => [
                    'src_v_type'     => 'link',
                ]
            ]
        );
        $repeater->add_control(
            'video_d_size',
            [
                'label' => esc_html__( 'Video Size', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Select', 'media-player-addons-for-elementor' ),
                    '240' => esc_html__( '240', 'media-player-addons-for-elementor' ),
                    '360' => esc_html__( '360', 'media-player-addons-for-elementor' ),
                    '480' => esc_html__( '480', 'media-player-addons-for-elementor' ),
                    '576' => esc_html__( '576', 'media-player-addons-for-elementor' ),
                    '720' => esc_html__( '720', 'media-player-addons-for-elementor' ),
                    '1080' => esc_html__( '1080', 'media-player-addons-for-elementor' ),
                    '1440' => esc_html__( '1440', 'media-player-addons-for-elementor' ),
                    '2160' => esc_html__( '2160', 'media-player-addons-for-elementor' ),
                    '2880' => esc_html__( '2880', 'media-player-addons-for-elementor' ),
                    '4320'  => esc_html__( '4320', 'media-player-addons-for-elementor' ),
                ],
            ]
        );
        $this->add_control(
            'video_d_list',
            [
                'label' => esc_html__( 'Video List', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                 'condition' => [
                    'choose_v_source'    =>  'yes',
                ]
           
            ]
        );
      $this->end_controls_section();
      $this->start_controls_section(
        '_sxubc_settings',
        [
            'label' => __( 'dPlayer Subtitle Settings', 'media-player-addons-for-elementor' ),
           
        ]
    );
 
        $this->add_control(
            'dplayer_upload',
            [
                'label' => esc_html__( 'Upload Subtitle', 'media-player-addons-for-elementor' ),
               
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'text/vtt',
            ]
        );

            $this->add_control(
            'sub_d_bg',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Player Subtitle Color', 'media-player-addons-for-elementor'),
                'default'   =>  '#fff',
            ]
        );
  

    $this->end_controls_section();
        // player settings

     $this->start_controls_section(
                '_section_option',
                [
                    'label' => __( 'Vedio Player All Settings', 'media-player-addons-for-elementor' ),
                     
                   
                ]
         );
       $this->add_control(
            'custom_logo_d',
            [
                'label' => esc_html__( 'Add player Logo', 'media-player-addons-for-elementor' ),
                'type' =>Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'media-player-addons-for-elementor' ),
                'label_off' => esc_html__( 'No', 'media-player-addons-for-elementor' ),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'd_logo',
            [
                'label' => esc_html__( 'Player Logo For Video', 'media-player-addons-for-elementor' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'custom_logo_d'    =>  'true',
                ]
            ]
        );

           $this->add_control(
            'custom_banner_d',
            [
                'label' => esc_html__( 'Add Player Banner', 'media-player-addons-for-elementor' ),
                'type' =>Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'media-player-addons-for-elementor' ),
                'label_off' => esc_html__( 'No', 'media-player-addons-for-elementor' ),
                'return_value' => 'true',
                'default' => '',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'banner',
            [
                'label' => esc_html__( 'Add Banner For Video', 'media-player-addons-for-elementor' ),
                'type' =>Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'custom_banner_d'    =>  'true',
                ]
            ]
        );

        $this->add_control(
            'auto_play',
            [
            'label' => __( 'Auto Play', 'media-player-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'description' => __( 'Choose a option whatever you want - Show / Hide
', 'media-player-addons-for-elementor' ),
                'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'video_loop',
            [
            'label' => __( 'Video Loop', 'media-player-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'description' => __( 'Choose a option whatever you want - Show / Hide
', 'media-player-addons-for-elementor' ),
                'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

          $this->add_control(
            'player_theme',
            [
            'label' => __( 'Player Theme Color', 'media-player-addons-for-elementor' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default'   =>  '#e74c3c',
            'description' => __( 'Choose The player Color
', 'media-player-addons-for-elementor' ),
                'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

  $this->add_control(
            'p_font',
            [
                'label'         => esc_html__( 'Player Font Size', 'media-player-addons-for-elementor' ),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    =>['px'],
                'range'         => 
                [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 25,
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
           'custom_logo_d',
           'custom_banner_d',
           'banner',
           'auto_play',
           'video_loop',
           'player_theme',
           'p_font',
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
            $options = [];
		    $options['choose_v_source'] = $settings['choose_v_source'];
		    $options['srrc_type'] = $settings['srrc_type'];
		    $options['videoos_upload'] = $settings['videoos_upload'];
		    $options['videoos_link'] = $settings['videoos_link'];
		    $options['video_d_list'] = $settings['video_d_list'];
		    $options['custom_logo_d'] = isset($settings['custom_logo_d']) ? $settings['custom_logo_d'] : 'no';
		    $options['d_logo'] = isset($settings['d_logo']) ? $settings['d_logo'] : 'no';
		    $options['custom_banner_d'] = isset($settings['custom_banner_d']) ? $settings['custom_banner_d'] : 'no';
		    $options['banner'] = isset($settings['banner']) ? $settings['banner'] : 'no';
		    $options['auto_play'] = isset($settings['auto_play']) ? $settings['auto_play'] : 'no';
		    $options['video_loop'] = isset($settings['video_loop']) ? $settings['video_loop'] : 'no';
		    $options['player_theme'] = isset($settings['player_theme']) ? $settings['player_theme'] : '#fff';
		    $options['p_font'] = isset($settings['p_font']) ? $settings['p_font'] : ['size' => 16];
		    $options['sub_d_bg'] = $settings['sub_d_bg'];
		    $options['dplayer_upload'] = $settings['dplayer_upload'];  
  
?>
   <div id="dplayer"  class ="dplayer" data-settings='<?php echo wp_json_encode($options) ?>'></div>
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
