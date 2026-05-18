<?php
namespace MPAFE\Widgets;

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
class mpafe_vemio_vedio extends Widget_Base {

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
		return 'VemioVideoPlayer';
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
		return esc_html__( 'Vimeo Video Player', 'media-player-addons-for-elementor' );
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
		return 'bl_icon fab fa-vimeo-v eicon-video';
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
		return [ 'mpafe-plyr-js', 'mpafe-main-js', 'elementor-frontend'];
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
            'section_b_v', [
                'label' =>esc_html__( 'Vedio Player Content Settings', 'media-player-addons-for-elementor' ),
            ]
        );


		$this->add_control(
            'vd_posster_v',
            [
                'label' => esc_html__( 'Vedio Poster', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::MEDIA,
           
               
            ]
        );

	
        $this->add_control(
            'vd_link_v',
            [
                'label' => esc_html__( 'Vedio link', 'media-player-addons-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://Vimeo Link.com', 'media-player-addons-for-elementor' ),
                'default' => 'https://vimeo.com/1113383938?fl=pl&fe=sh'
            ]
        );
     
    $this->end_controls_section();


    $this->start_controls_section(
            'seion_t_v', [
                'label' =>esc_html__( 'Vedio Player Color Settings', 'media-player-addons-for-elementor' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

    $this->end_controls_section();

        //swicher
		 $this->start_controls_section(
            'section_abv', [
                'label' =>esc_html__( 'Vedio Player Control Settings', 'media-player-addons-for-elementor' ),
            ]
        );

		
		$this->add_control(
		'show_large_ply_v',
		[
			'label' => __( 'Large Play', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes'
		]
	);

        $this->add_control(
		'plav',
		[
			'label' => __( 'Play', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes'
		]
	);

        $this->add_control(
		'progresssv',
		[
			'label' => __( 'Progress', 'media-player-addons-for-elementor' ),
			'type' => Controls_Manager::SWITCHER,
			'label_on' => __( 'yes', 'media-player-addons-for-elementor' ),
			'label_off' => __( 'no', 'media-player-addons-for-elementor' ),
			'return_value' => 'yes',
			'default' => 'yes'
		]
	);


    $this->end_controls_section();

    //Others settings
	$this->start_controls_section(
		'se_v_v_ttabb', [
			'label' =>esc_html__( 'Vedio Player Other Settings', 'media-player-addons-for-elementor' ),
		]
    );

    $this->end_controls_section();
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

		//Color Settings
		$vd_link_v = $settings['vd_link_v'];
		$alll_bg_v        = !empty($settings['alll_bg_v']) ? $settings['alll_bg_v'] : '#00b3ff';
		$plrr_range_bggg_v = !empty($settings['plrr_range_bggg_v']) ? $settings['plrr_range_bggg_v'] : '#cccccc';
		$tooltip_teext_v   = !empty($settings['tooltip_teext_v']) ? $settings['tooltip_teext_v'] : '#000000';
		$tooltip_bgg_v     = !empty($settings['tooltip_bgg_v']) ? $settings['tooltip_bgg_v'] : '#ffffff';
		$v_r_t_b_p_v       = !empty($settings['v_r_t_b_p_v']) ? $settings['v_r_t_b_p_v'] : '#fff';
		$v_c_c_h_h_v       = !empty($settings['v_c_c_h_h_v']) ? $settings['v_c_c_h_h_v'] : '#fff';
		$v_c_c_all_v       = !empty($settings['v_c_c_all_v']) ? $settings['v_c_c_all_v'] : '#fff';
		$p_c_i_s_azim_v    = !empty($settings['p_c_i_s_azim_v']) ? $settings['p_c_i_s_azim_v'] : ['size' => 16]; // example default if array
		$p_r_t_h_az_v      = !empty($settings['p_r_t_h_az_v']) ? $settings['p_r_t_h_az_v'] : ['size' => 16];
		$vd_posster_v    = $settings['vd_posster_v'];

		//switch settings	
		$show_large_ply_v  = isset($settings['show_large_ply_v']) ? $settings['show_large_ply_v'] : 'no';
		$resv              = isset($settings['resv']) ? $settings['resv'] : 'no';
		$rewv              = isset($settings['rewv']) ? $settings['rewv'] : 'no';
		$plav              = isset($settings['plav']) ? $settings['plav'] : 'no';
		$fastforwarddv     = isset($settings['fast-forwarddv']) ? $settings['fast-forwarddv'] : 'no';
		$progresssv        = isset($settings['progresssv']) ? $settings['progresssv'] : 'no';
		$currenttimeev     = isset($settings['current-timeev']) ? $settings['current-timeev'] : 'no';
		$durationnv        = isset($settings['durationnv']) ? $settings['durationnv'] : 'no';
		$muteev            = isset($settings['muteev']) ? $settings['muteev'] : 'no';
		$volumeev          = isset($settings['volumeev']) ? $settings['volumeev'] : 'no';
		$setsv             = isset($settings['settingssv']) ? $settings['settingssv'] : 'no';
		$fullscreennv      = isset($settings['fullscreennv']) ? $settings['fullscreennv'] : 'no';
		$autoplay_enabled  = isset($settings['autoplay_enabled']) ? $settings['autoplay_enabled'] : 'no';

		$controls = [];
		$controls['play-large'] = $show_large_ply_v == 'yes' ? 'yes' : 'no';
		$controls['restart'] = $resv == 'yes' ? 'yes' : 'no';
		$controls['rewind'] = $rewv == 'yes' ? 'yes' : 'no';
		$controls['play'] = $plav == 'yes' ? 'yes' : 'no';
		$controls['fast-forward'] = $fastforwarddv == 'yes' ? 'yes' : 'no';
		$controls['progress'] = $progresssv == 'yes' ? 'yes' : 'no';
		$controls['current-time'] = $currenttimeev == 'yes' ? 'yes' : 'no';
		$controls['duration'] = $durationnv == 'yes' ? 'yes' : 'no';
		$controls['mute'] = $muteev == 'yes' ? 'yes' : 'no';
		$controls['volume'] = $volumeev == 'yes' ? 'yes' : 'no';
		$controls['settings'] = $setsv == 'yes' ? 'yes' : 'no';
		$controls['fullscreen'] = $fullscreennv == 'yes' ? 'yes' : 'no';
		$controls['autoplay'] = $autoplay_enabled == 'yes' ? 'yes' : 'no';

	?>

	<div class="vimeo_player" data-settings='<?php echo wp_json_encode($controls) ?>' data-poster="<?php echo esc_attr($vd_posster_v['url']); ?>" style="--plyr-color-main:<?php echo esc_attr($alll_bg_v);?>;--plyr-control-icon-size:<?php echo esc_attr($p_c_i_s_azim_v['size']).'px' ?>;--plyr-range-thumb-background:<?php echo esc_attr($plrr_range_bggg_v);?>;--plyr-range-thumb-height:<?php echo esc_attr($p_r_t_h_az_v['size']).'px' ?>;--plyr-tooltip-color:<?php echo esc_attr($tooltip_teext_v); ?>;--plyr-tooltip-background:<?php echo esc_attr($tooltip_bgg_v); ?>;--plyr-video-range-track-background:<?php echo esc_attr($v_r_t_b_p_v); ?>;--plyr-video-control-color-hover:<?php echo esc_attr($v_c_c_h_h_v); ?>;--plyr-video-control-color:<?php echo esc_attr($v_c_c_all_v); ?>;" data-plyr-provider="vimeo" data-plyr-embed-id="<?php echo esc_url($vd_link_v); ?>"></div>
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
