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
class Bplayer_Playlist extends Widget_Base
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
		return 'bplayer-playlist';
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
		return esc_html__('Audio Playlist Player', 'media-player-addons-for-elementor');
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
		return 'bl_icon fas fa-music eicon-kit-details';
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
		return ['bplayer-script', 'bplayer-audio-playlist', 'elementor-frontend'];
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
				'label' 	=> esc_html__('Advanced Audio Playlist Settings', 'media-player-addons-for-elementor'),
				'tab' 		=> \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'track_options',
			[
				'label' 	=> esc_html__('Track Options', 'media-player-addons-for-elementor'),
				'type' 		=> \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'track_title',
			[
				'label' 		=> esc_html__('Track Title', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input Song Title here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);

		$repeater->add_control(
			'track_source',
			[
				'label' 		=> esc_html__('Track Source', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'media_type' 	=> 'audio',
				'description'	=> esc_html__('Upload or Paste Your MP3 Music here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);

		$repeater->add_control(
			'track_poster',
			[
				'label' 		=> esc_html__('Track Poster', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
				'label_block'	=> true,
			]
		);
		$repeater->add_control(
			'track_artist_name',
			[
				'label' 		=> esc_html__('Singer Name', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input singer name her', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);
		$repeater->add_control(
			'track_album',
			[
				'label' 		=> esc_html__('Track Album', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder'	=> esc_attr__('Input Song\'s Album here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);
		$this->add_control(
			'media_source',
			[
				'label' 		=> esc_html__('Playlist', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'title_field' 	=> '{{{ track_title }}}',
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
			'bplayer_size',
			[
				'label' 		=> esc_html__('Player Size', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> esc_attr__('Wide', 'media-player-addons-for-elementor'),
				'label_off' 	=> esc_attr__('Narrow', 'media-player-addons-for-elementor'),
				'return_value' 	=> 'yes',
				'default' 		=> 'false',
				'show_label'	=> true,
				'dynamic'		=> [
					'active'	=> true
				],
				'description'	=> esc_html__('Choose Player Size', 'media-player-addons-for-elementor')
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
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$bplayer_settings = $this->get_settings();

		$bplayer_opt	= [];

		//player Size control
		if ('yes' === $settings['bplayer_size']) {
			$bplayer_opt['bplayer_size'] = true;
		} else {
			$bplayer_opt['bplayer_size'] = false;
		}
		//player Mode control
		if ('yes' === $settings['dark_mode']) {
			$bplayer_opt['dark_mode'] = true;
		} else {
			$bplayer_opt['dark_mode'] = false;
		}

		// Sanitize each item in the media_source array
		if (!empty($settings['media_source']) && is_array($settings['media_source'])) {
			foreach ($settings['media_source'] as $key => $item) {
				if (isset($item['track_title'])) {
					$settings['media_source'][$key]['track_title'] = sanitize_xss_input($item['track_title']);
				}
				if (isset($item['track_source'])) {
					$settings['media_source'][$key]['track_source'] = $item['track_source'];
				}
				if (isset($item['track_poster'])) {
					$settings['media_source'][$key]['track_poster'] = $item['track_poster'];
				}
				if (isset($item['track_artist_name'])) {
					$settings['media_source'][$key]['track_artist_name'] = sanitize_xss_input($item['track_artist_name']);
				}
				if (isset($item['track_album'])) {
					$settings['media_source'][$key]['track_album'] = sanitize_xss_input($item['track_album']);
				}
			}
		}
		$bplayer_opt['media_source'] = $settings['media_source'];

?>
		<div id="app" data-settings='<?php echo wp_json_encode($bplayer_opt); ?>'></div>

<?php
	}
}
