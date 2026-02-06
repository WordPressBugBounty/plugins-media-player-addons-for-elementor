<?php

namespace BMianAddon\Widgets;

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
class Bplayer_Video extends Widget_Base
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
		return 'bplayer-video';
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
		return esc_html__('Advanced Video Player', 'media-player-addons-for-elementor');
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
		return 'bl_icon fas fa-film eicon-play-o';
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

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['bplayer-script', 'bplayer-main', 'elementor-frontend' ];
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
		$this->start_controls_section(
			'section_content',
			[
				'label' 	=> esc_html__('Advanced Video Player Settings', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'track_options',
			[
				'label' 		=> esc_html__('Video Options', 'media-player-addons-for-elementor'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);
		$this->add_control(
			'track_source',
			[
				'label' 		=> esc_html__('Video Source', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'media_type' 	=> 'video',
				'description'	=> esc_html__('Upload Your Video here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);
		$this->add_control(
			'track_title',
			[
				'label' 		=> esc_html__('Video Title', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input Song Title here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);

		$this->add_control(
			'track_poster',
			[
				'label' 		=> esc_html__('Video Thumbnail', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
				'label_block'	=> true,
			]
		);
		$this->add_control(
			'track_artist_name',
			[
				'label' 		=> esc_html__('Singer Name', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input singer name her', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);
		$this->add_control(
			'track_album',
			[
				'label' 		=> esc_html__('Album Name', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder'	=> esc_attr__('Input Song\'s Album here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);

		// Player Mode and Player Size Options

		$this->add_control(
			'player_options',
			[
				'label' 		=> esc_html__('Player Options', 'media-player-addons-for-elementor'),
				'type' 			=> \Elementor\Controls_Manager::HEADING,
				'separator' 	=> 'after',
			]
		);


		$this->add_control(
			'dark_mode',
			[
				'label' 		=> esc_html__('Mode', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> esc_attr__('Dark', 'media-player-addons-for-elementor'),
				'label_off' 	=> esc_attr__('Light', 'media-player-addons-for-elementor'),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'show_label'	=> true,
				'dynamic'		=> [
					'active'	=> true
				],
				'description'	=> esc_html__('Choose Player Mode', 'media-player-addons-for-elementor'),
			]
		);
		$this->add_responsive_control(
			'player_width',
			[
				'label'      => __( 'Width', 'your-plugin-textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range'      => [
					'%'  => [ 'min' => 10, 'max' => 100 ],
					'px' => [ 'min' => 100, 'max' => 2000 ],
					'vw' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}} c-player' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'player_height',
			[
				'label'      => __( 'Height', 'your-plugin-textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range'      => [
					'%'  => [ 'min' => 10, 'max' => 100 ],
					'px' => [ 'min' => 100, 'max' => 2000 ],
					'vw' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [
					'size' => 350,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .cp-poster' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
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
           'player_height',
           'player_width',
           'dark_mode',
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$bplayer_opt	= [];

		//player Mode control
		if ( isset($settings['show_large_play']) && 'yes' === $settings['dark_mode']) {
			$bplayer_opt['dark_mode'] = true;
		} else {
			$bplayer_opt['dark_mode'] = false;
		}
		$darkmode      = isset($settings['dark_mode']) ? $settings['dark_mode'] : 'no';
		if ('yes' === $darkmode) {
			$bplayer_opt['dark_mode'] = true;
		} else {
			$bplayer_opt['dark_mode'] = false;
		}

		$bplayer_opt['track_title'] 		= sanitize_xss_input($settings['track_title']);
		$bplayer_opt['track_source'] 		= $settings['track_source'];
		$bplayer_opt['track_poster'] 		= $settings['track_poster'];
		$bplayer_opt['track_artist_name'] 	= sanitize_xss_input($settings['track_artist_name']);
		$bplayer_opt['track_album'] 		= sanitize_xss_input($settings['track_album']);

?>

		<div id="bplayer-app" data-settings='<?php echo wp_json_encode($bplayer_opt); ?>'></div>

<?php
	}
}
