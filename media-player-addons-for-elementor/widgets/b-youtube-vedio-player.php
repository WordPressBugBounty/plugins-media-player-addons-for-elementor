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
class b_youtube_vedio extends Widget_Base {

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
		return 'YoutubeVideoPlayer';
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
		return esc_html__( 'YouTube Video Player', 'media-player-addons-for-elementor' );
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
		return 'bl_icon fab fa-youtube eicon-e-youtube';
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
		return [ 'plyr-js', 'youtube-player', 'elementor-frontend'];
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



		//Video player Content Settings
		$this->start_controls_section(
            'section_b', [
                'label' =>esc_html__( 'Video Player Content Settings', 'media-player-addons-for-elementor' ),
            ]
        );

		  $this->add_control(
            'vd_posster',
            [
                'label' => esc_html__( 'Video Poster', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::MEDIA,
               
            ]
        );

        $this->add_control(
            'vd_link',
            [
                'label' => esc_html__( 'Video link', 'media-player-addons-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://youtubelink.com', 'media-player-addons-for-elementor' ),
                'default' => 'https://www.youtube.com/watch?v=QAdgKkk_GtY'
            ]
        );
     
        $this->end_controls_section();

	//Video player Color Settings
		$this->start_controls_section(
            'seion_t', [
                'label' =>esc_html__( 'Video player Color Settings', 'media-player-addons-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'alll_bg',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Player Total Background Color', 'media-player-addons-for-elementor'),
                'default'   =>  '#00b3ff',
            ]
        );

		$this->add_control(
            'plrr_range_bggg',
            [
                'type' => Controls_Manager::COLOR,
                'label' =>esc_html__('Range Thumb Background', 'media-player-addons-for-elementor'),
                'default'   =>  '#ffff',
            ]
        );

        $this->add_control(
			'tooltip_teext',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Tooltip Text Color', 'media-player-addons-for-elementor'),
				'default'   =>  '#000',
			]
		);

        $this->add_control(
			'tooltip_bgg',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Tooltip Background Color', 'media-player-addons-for-elementor'),
				'default'   =>  '#ffff',
			]
		);

       $this->add_control(
			'v_r_t_b_p',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Video Range Track Background', 'media-player-addons-for-elementor'),
				'default'   =>  '#7A7979',
			]
		);

		$this->add_control( 
			'v_c_c_h_h',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Video Control Color Hover', 'media-player-addons-for-elementor'),
				'default'   =>  '#ffff',
			]
		);


		$this->add_control( 
			'p_c_t_c',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Captions Text Color', 'media-player-addons-for-elementor'),
				'default'   =>  '#fff',
			]
		);

		$this->add_control( 
			'v_c_c_all',
			[
				'type' => Controls_Manager::COLOR,
				'label' =>esc_html__('Player All Icon Color', 'media-player-addons-for-elementor'),
				'default'   =>  '#ffff',
			]
		);
  
    
    $this->end_controls_section();

    //Video player Control Settings
        $this->start_controls_section(
            'section_tabb', [
                'label' =>esc_html__( 'Video Player Control Settings', 'media-player-addons-for-elementor' ),
            ]
        );

       $this->add_control(
			'show_large_playy',
			[
				'label' => __( 'Large Play', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'restartt',
			[
				'label' => __( 'Restart', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
         $this->add_control(
			'rewindd',
			[
				'label' => __( 'Rewind', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'playy',
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
			'autoplay_enabled',
			[
				'label' => __( 'Autoplay', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'fast-forwardd',
			[
				'label' => __( 'Fast-Forward', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
			'progresss',
			[
				'label' => __( 'Progress', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

      	$this->add_control(
			'current-timee',
			[
				'label' => __( 'Current-Time', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'durationn',
			[
				'label' => __( 'Duration', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'mutee',
			[
				'label' => __( 'Mute', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'volumee',
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
			'settingss',
			[
				'label' => __( 'Settings', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

      	$this->add_control(
			'fullscreenn',
			[
				'label' => __( 'Fullscreen', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
				'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();
		//Others settings

    	$this->start_controls_section(
        'se_ttabb', [
            'label' =>esc_html__( 'Video player Other Settings', 'media-player-addons-for-elementor' ),
        ]
    );

    	$this->add_control(
			'p_c_i_s_azim',
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
			'p_r_t_h_az',
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
           'p_c_i_s_azim',
           'p_r_t_h_az',
           'rewind',
		   'p_r_t_h_az',
		   'rewindd',
		   'fast-forwardd',
		   'current-timee',
		   'mutee',
		   'durationn',
		   'fullscreenn',
		   'settingss',
		   'alll_bg',
		   'plrr_range_bggg',
		   'tooltip_teext',
		   'tooltip_bgg',
		   'v_r_t_b_p',
		   'v_c_c_h_h',
		   'v_c_c_all',
		   'p_c_i_s_azim',
		   'p_r_t_h_az',
		   'p_c_t_c',
		   'autoplay_enabled',
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

        $vd_link = $settings['vd_link'];
		$alll_bg        = !empty($settings['alll_bg']) ? $settings['alll_bg'] : '#00b3ff';
		$plrr_range_bggg = !empty($settings['plrr_range_bggg']) ? $settings['plrr_range_bggg'] : '#cccccc';
		$tooltip_teext   = !empty($settings['tooltip_teext']) ? $settings['tooltip_teext'] : '#000000';
		$tooltip_bgg     = !empty($settings['tooltip_bgg']) ? $settings['tooltip_bgg'] : '#ffffff';
		$v_r_t_b_p       = !empty($settings['v_r_t_b_p']) ? $settings['v_r_t_b_p'] : '#fff';
		$v_c_c_h_h       = !empty($settings['v_c_c_h_h']) ? $settings['v_c_c_h_h'] : '#fff';
		$v_c_c_all       = !empty($settings['v_c_c_all']) ? $settings['v_c_c_all'] : '#fff';
		$p_c_i_s_azim    = !empty($settings['p_c_i_s_azim']) ? $settings['p_c_i_s_azim'] : ['size' => 16];
		$p_r_t_h_az    = !empty($settings['p_r_t_h_az']) ? $settings['p_r_t_h_az'] : ['size' => 16];
		$vd_posster    = $settings['vd_posster'];
		
		//switch settings
		$show_large_playy   = isset($settings['show_large_playy']) ? $settings['show_large_playy'] : 'no';
		$restartt           = isset($settings['restartt']) ? $settings['restartt'] : 'no';
		$rewindd            = isset($settings['rewindd']) ? $settings['rewindd'] : 'no';
		$playy              = isset($settings['playy']) ? $settings['playy'] : 'no';
		$fastforwardd       = isset($settings['fast-forwardd']) ? $settings['fast-forwardd'] : 'no';
		$progresss          = isset($settings['progresss']) ? $settings['progresss'] : 'no';
		$currenttimee       = isset($settings['current-timee']) ? $settings['current-timee'] : 'no';
		$durationn          = isset($settings['durationn']) ? $settings['durationn'] : 'no';
		$mutee              = isset($settings['mutee']) ? $settings['mutee'] : 'no';
		$volumee            = isset($settings['volumee']) ? $settings['volumee'] : 'no';
		$sets               = isset($settings['settingss']) ? $settings['settingss'] : 'no';
		$fullscreenn        = isset($settings['fullscreenn']) ? $settings['fullscreenn'] : 'no';
		$autplay_enabled     = isset($settings['autoplay_enabled']) ? $settings['autoplay_enabled'] : 'no';

		$controls = [];
		$controls['play-large'] = $show_large_playy == 'yes' ? 'yes' : 'no';
		$controls['restart'] = $restartt == 'yes' ? 'yes' : 'no';
		$controls['rewind'] = $rewindd == 'yes' ? 'yes' : 'no';
		$controls['play'] = $playy == 'yes' ? 'yes' : 'no';
		$controls['fast-forward'] = $fastforwardd == 'yes' ? 'yes' : 'no';
		$controls['progress'] = $progresss == 'yes' ? 'yes' : 'no';
		$controls['current-time'] = $currenttimee == 'yes' ? 'yes' : 'no';
		$controls['duration'] = $durationn == 'yes' ? 'yes' : 'no';
		$controls['mute'] = $mutee == 'yes' ? 'yes' : 'no';
		$controls['volume'] = $volumee == 'yes' ? 'yes' : 'no';
		$controls['settings'] = $sets == 'yes' ? 'yes' : 'no';
		$controls['fullscreen'] = $fullscreenn == 'yes' ? 'yes' : 'no';
		$controls['autoplay'] = $autplay_enabled == 'yes' ? 'yes' : 'no';

	?>
     <div class="youtube_player" data-settings='<?php echo wp_json_encode($controls) ?>' data-poster="<?php echo esc_url($vd_posster['url']); ?>" style="--plyr-color-main:<?php echo  esc_attr($alll_bg);?>;--plyr-control-icon-size:<?php echo esc_attr($p_c_i_s_azim['size']).'px' ?>;--plyr-range-thumb-background:<?php echo esc_attr($plrr_range_bggg);?>;--plyr-range-thumb-height:<?php echo esc_attr($p_r_t_h_az['size']).'px' ?>;--plyr-tooltip-color:<?php echo esc_attr($tooltip_teext); ?>;--plyr-tooltip-background:<?php echo esc_attr($tooltip_bgg); ?>;--plyr-video-range-track-background:<?php echo esc_attr($v_r_t_b_p); ?>;--plyr-video-control-color-hover:<?php echo esc_attr($v_c_c_h_h); ?>;--plyr-video-control-color:<?php echo esc_attr($v_c_c_all); ?>;"data-plyr-provider="youtube" data-plyr-embed-id="<?php echo esc_url($vd_link); ?>">
     </div>


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
