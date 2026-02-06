<?php
namespace BMianAddon\Widgets;

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
class b_html5_audio extends Widget_Base {

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
		return 'Html5AudioPlayer';
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
		return esc_html__( 'Html5 Audio Player', 'media-player-addons-for-elementor' );
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
		return 'bl_icon fas fa-headphones-alt eicon-bullet-list';
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
		return [ 'plyr-js', 'hls', 'html5-audio-player', 'elementor-frontend' ];
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



		//Vedio player Control Settings
		 $this->start_controls_section(
            'section_taab', [
                'label' =>esc_html__( 'Audio Player Content Settings', 'media-player-addons-for-elementor' ),
            ]
        );

           $this->add_control(
            'src_type',
            [
                'label' => esc_html__( 'Audio Source', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'upload',
                'options' => [
                    'upload' => esc_html__( 'Upload Audio', 'media-player-addons-for-elementor' ),
                    'link' => esc_html__( 'Audio Link', 'media-player-addons-for-elementor' ),
                ],
            ]
        );

        $this->add_control(
            'audio_upload',
            array(
                'label' => esc_html__( 'Upload Audio', 'media-player-addons-for-elementor' ),
                'type'  => Controls_Manager::MEDIA,
                'media_type' => 'audio',
                'condition' => array(
                    'src_type' => 'upload',
                ),
            )
        );

        $this->add_control(
            'audio_link',
            [
                'label' => esc_html__( 'Audio Link', 'media-player-addons-for-elementor' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://example.com/music-name.mp3', 'media-player-addons-for-elementor' ),
             
                'condition' => [
                    'src_type'    =>  'link',
                ]
            ]
        );

        $this->end_controls_section();


     //Vedio player Color Settings
		 $this->start_controls_section(
            'section_taabo', [
                'label' =>esc_html__( 'Audio Player Color Settings', 'media-player-addons-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		 

		$this->add_control(
		        'a_plyr_bg',
		        [
		            'type' => Controls_Manager::COLOR,
		            'label' =>esc_html__('Player Background', 'media-player-addons-for-elementor'),
		            'default'   =>  '#ffff',
		        ]
		    );

		   $this->add_control(
		        'a_plyr_c_c',
		        [
		            'type' => Controls_Manager::COLOR,
		            'label' =>esc_html__('Audio Control Color', 'media-player-addons-for-elementor'),
		            'default'   =>  '#4a5764',
		        ]
		    );

          $this->add_control(
            'a_all_color',
            array(
                'label' => esc_html__( 'Progressbar Range Color', 'media-player-addons-for-elementor' ),
                'type'  => Controls_Manager::COLOR,
                'default'   =>  '#00b3ff',
         
            )
        );

          $this->add_control(
            'a_r_t_a_s_c',
            array(
                'label' => esc_html__('Range Thumb Active Shadow color', 'media-player-addons-for-elementor' ),
                'type'  => Controls_Manager::COLOR,
                'default'   =>  '#00b3ff',
         
            )
        );

     $this->add_control(
            'plr_rang_bg',
            array(
                'label' => esc_html__('Range Track Background', 'media-player-addons-for-elementor' ),
                'type'  => Controls_Manager::COLOR,
                'default'   =>  '#CBD1D8',
         
            )
        );


         $this->add_control(
        'audio_rang_a',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Audio Range Track Background', 'media-player-addons-for-elementor'),
            'default'   =>  '#ffff',
        ]
    );

         $this->add_control(
        'plyr_tooltip_bg',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Tooltip Background', 'media-player-addons-for-elementor'),
            'default'   =>  '#ffff',
        ]
    );
         $this->add_control(
        'plyr_tooltip_c',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Tooltip Color', 'media-player-addons-for-elementor'),
            'default'   =>  '#000',
        ]
    );

         $this->add_control(
        'a_c_b_h',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Audio Control Background Hover', 'media-player-addons-for-elementor'),
            'default'   =>  '#1ABAFF',
        ]
    );

           $this->add_control(
        'a_c_l_c_h',
        [
            'type' => Controls_Manager::COLOR,
            'label' =>esc_html__('Control Color Hover', 'media-player-addons-for-elementor'),
            'default'   =>  '#ffff',
        ]
    );

        $this->end_controls_section();
        
        //Vedio player Control Settings
        $this->start_controls_section(
            'audio_tabb', [
                'label' =>esc_html__( 'Audio Player Control Settings', 'media-player-addons-for-elementor' ),
            ]
        );

      $this->add_control(
		'a_play',
		[
			'label' => __( 'Play', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

       $this->add_control(
		'a_progress',
		[
			'label' => __( 'Progressbar', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'a_time',
		[
			'label' => __( 'Current Time', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

        $this->add_control(
		'durationnv_ad',
		[
			'label' => __( 'Duration', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes',
		]
	);

          $this->add_control(
			'a_volume',
			[
				'label' => __( 'Volume', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'a_settings',
			[
				'label' => __( 'Settings', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);   

		$this->add_control(
			'a_download',
			[
				'label' => __( 'Download', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'a_mute',
			[
				'label' => __( 'Mute', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
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
           'a_plyr_c_c',
           'a_plyr_bg',
           'audio_rang_a',
           'a_all_color',
		   'a_r_t_a_s_c',
		   'plr_rang_bg',
		   'plyr_tooltip_bg',
		   'plyr_tooltip_c',
		   'a_c_b_h',
		   'a_c_l_c_h',
           'a_time',
           'a_settings',
           'a_download',
           'a_mute',
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
		   if($settings['src_type'] == 'upload'){
            $audio_link = $settings['audio_upload']['url'];
        } else {
            $audio_link = $settings['audio_link'];
        }
        $a_all_color      = !empty($settings['a_all_color']) ? $settings['a_all_color'] : '#00b3ff';
		$audio_rang_a     = !empty($settings['audio_rang_a']) ? $settings['audio_rang_a'] : '#cccccc';
		$a_plyr_bg        = !empty($settings['a_plyr_bg']) ? $settings['a_plyr_bg'] : 'rgba(180, 180, 180, 0.87)';
		$a_plyr_c_c       = !empty($settings['a_plyr_c_c']) ? $settings['a_plyr_c_c'] : '#ffffff';
		$a_r_t_a_s_c      = !empty($settings['a_r_t_a_s_c']) ? $settings['a_r_t_a_s_c'] : '#999999';
		$plr_rang_bg      = !empty($settings['plr_rang_bg']) ? $settings['plr_rang_bg'] : '#666666';
		$plyr_tooltip_bg  = !empty($settings['plyr_tooltip_bg']) ? $settings['plyr_tooltip_bg'] : '#ffd';
		$plyr_tooltip_c   = !empty($settings['plyr_tooltip_c']) ? $settings['plyr_tooltip_c'] : '#ffffff';
		$a_c_b_h          = !empty($settings['a_c_b_h']) ? $settings['a_c_b_h'] : '#333333';
		$a_c_l_c_h        = !empty($settings['a_c_l_c_h']) ? $settings['a_c_l_c_h'] : '#00b3ff';
        $durationnv_ad    = $settings['durationnv_ad'];



		$play       = isset($settings['a_play']) ? $settings['a_play'] : 'no';
		$progress   = isset($settings['a_progress']) ? $settings['a_progress'] : 'no';
		$current    = isset($settings['a_time']) ? $settings['a_time'] : 'no';
		$volume     = isset($settings['a_volume']) ? $settings['a_volume'] : 'no';
		$settinngs  = isset($settings['a_settings']) ? $settings['a_settings'] : 'no';
		$download   = isset($settings['a_download']) ? $settings['a_download'] : 'no';
		$mute       = isset($settings['a_mute']) ? $settings['a_mute'] : 'no';


		$controls = [];
		$controls['play'] = $play == 'yes' ? 'yes' : 'no';
		$controls['progress'] = $progress == 'yes' ? 'yes' : 'no';
		$controls['current-time'] = $current == 'yes' ? 'yes' : 'no';
	    $controls['duration'] = $durationnv_ad == 'yes' ? 'yes' : 'no';
		$controls['volume'] = $volume == 'yes' ? 'yes' : 'no';
		$controls['settings'] = $settinngs == 'yes' ? 'yes' : 'no';
		$controls['download'] = $download == 'yes' ? 'yes' : 'no';
		$controls['mute'] = $mute == 'yes' ? 'yes' : 'no';


		if($audio_link):
            $arr = explode('.', $audio_link);
            $file_ext = end($arr);
        endif;
        ?>
		<audio class="audio_player" style="--plyr-color-main:<?php echo esc_attr($a_all_color);?>;--plyr-range-thumb-background:<?php echo esc_attr($audio_rang_a);?>;--plyr-audio-controls-background:<?php echo esc_attr($a_plyr_bg); ?>;--plyr-audio-control-color:<?php echo esc_attr($a_plyr_c_c); ?>;--plyr-audio-range-thumb-active-shadow-color:<?php echo esc_attr($a_r_t_a_s_c); ?>;--plyr-audio-range-track-background:<?php echo esc_attr($plr_rang_bg); ?>;--plyr-tooltip-background:<?php echo esc_attr($plyr_tooltip_bg); ?>;--plyr-tooltip-color:<?php echo esc_attr($plyr_tooltip_c); ?>;--plyr-audio-control-background-hover:<?php  echo esc_attr($a_c_b_h); ?>;--plyr-audio-control-color-hover:<?php echo esc_attr($a_c_l_c_h); ?>;" data-settings='<?php echo wp_json_encode($controls) ?>' controls>
		  <source src="<?php echo esc_url($audio_link); ?>" type="audio/<?php echo esc_attr($file_ext); ?>" />
		</audio>
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
	
}
