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
class Advance_Audio_Playlist extends Widget_Base
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
		return 'advance-audio-playlist';
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
		return esc_html__('Advanced Audio Playlist', 'media-player-addons-for-elementor');
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
		return ['audio-playlist-player', 'elementor-frontend', 'swiper-js'];
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
                'default'       => [
                    [
                        'track_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/d80e6b68-b67a-4e27-86ee-e00581883d5c'
                        ],
                        'track_source' => [
                            'url' => 'https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/SynCole-FeelGood.mp3'
                        ],
                        'track_artist_name' => 'Artist Name',
                        'track_album' => 'Album Name',
                    ],
                    [
                        'track_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/9240f7ff-1b8e-4e62-a2d1-df78b285c7e0'
                        ],
                        'track_source' => [
                            'url' => 'https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/HarddopeClarx-Castle.mp3'
                        ],
                        'track_artist_name' => 'Artist Name',
                        'track_album' => 'Album Name',
                    ],
                    [
                        'track_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/6e5ba953-49c5-4634-a1c5-4caf310cba86'
                        ],
                        'track_source' => [
                            'url' => 'https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/PlayDead-NEFFEX.mp3'
                        ],
                        'track_artist_name' => 'Artist Name',
                        'track_album' => 'Album Name',
                    ],
                    [
                        'track_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/a2ca0dfd-e53f-4e79-b8b0-288847e59b9a'
                        ],
                        'track_source' => [
                            'url' => 'https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/KnowMyself-PatrickPatrikios.mp3'
                        ],
                        'track_artist_name' => 'Artist Name',
                        'track_album' => 'Album Name',
                    ],
                    [
                        'track_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/b286d7ff-52a1-452d-9cd9-5920c937b16e'
                        ],
                        'track_source' => [
                            'url' => 'https://github.com/ecemgo/mini-samples-great-tricks/raw/main/song-list/BesomorphCoopex-Redemption.mp3'
                        ],
                        'track_artist_name' => 'Artist Name',
                        'track_album' => 'Album Name',
                    ]
                ],
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

        $this->add_responsive_control(
			'container_width',
			[
				'label'      => __( 'Container Width', 'media-player-addons-for-elementor' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range'      => [
					'%'  => [ 'min' => 10, 'max' => 100 ],
					'px' => [ 'min' => 100, 'max' => 2000 ],
					'vw' => [ 'min' => 10, 'max' => 100 ],
				],
				'default'    => [
					'size' => 90,
					'unit' => '%',
				],
				'selectors'  => [
					'{{WRAPPER}} .playlist-wrapper .playlist-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'player_width',
			[
				'label'      => __( 'Player Width', 'media-player-addons-for-elementor' ),
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
					'{{WRAPPER}} .playlist-wrapper .content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'show_play_timer',
            [
                'label' => __('Show Play Timer', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'on', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'off', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
		$this->end_controls_section();
        $this->start_controls_section(
            'style_control_tab',
			[
				'label' 	=> esc_html__('Background', 'media-player-addons-for-elementor'),
				'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
            'container_bg_img',
            [
                'label' => __('Container Backgroud Image', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'http://demo.bplugins.com/wp-content/uploads/2025/10/banner.png',
                ]
            ]
        );
        $this->add_control(
            'container_bg_color',
            [
                'label' => __('Container Backgroud Color', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#001124',
            ]
        );
        $this->add_group__control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label'=> __('Container Box Shadow','media-player-addons-for-elementor'),
                'selector' => '{{WRAPPER}} .playlist-wrapper .playlist-container',
            ]
        );
        $this->add_group__control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .playlist-wrapper .content',
            ]
        );

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => __('Border Radius', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .playlist-wrapper .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Padding', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .playlist-wrapper .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Margin', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .playlist-wrapper .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label' => __('Background Color', 'media-player-addons-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .playlist-wrapper .content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group__control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .playlist-wrapper .content',
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

    public function add_group__control($group_name, $args = [], $options = [])
    {
        // Check if this is a premium control and user doesn't have premium access
        if (!$this->is_premium() && in_array($args['name'], $this->premium_controls())) {
            // Append _locked to control name
            $args['name'] = $args['name'] . '_locked';

            // Ensure 'label' exists before modifying
            $label = isset($args['label']) ? $args['label'] : ucfirst(str_replace('_', ' ', $args['name']));
            $args['label'] = $label . " <span class='fs_pro_control_label'>Pro</span>";

            // Add locked class
            $args['classes'] = isset($args['classes']) ? $args['classes'] . ' fs-locked' : 'fs-locked';

            // Change control type to RAW_HTML and set display icon
            $args['type'] = Controls_Manager::RAW_HTML;
            $args['raw']  = '<i class="eicon-edit" aria-hidden="true" style="font-family: eicons, Bangla1046, sans-serif;"></i>';

            parent::add_control($args['name'], $args, $options);
        } else {
            parent::add_group_control($group_name, $args, $options);
        }
    }


    public function premium_controls()
    {
        return [
           'content_background_color',
           'container_width',
           'player_width',
           'show_play_timer',
           'container_bg_color',
           'container_bg_img',
           'content_margin',
           'content_padding',
           'content_border_radius',
           'container_box_shadow',
           'content_border',
           'content_box_shadow',
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
		$bplayer_settings = $this->get_settings();
        $playlist_songs = [];
        $show_timer = isset($settings['show_play_timer']) ? $settings['show_play_timer'] : 'no' ; 
        $bg_image_media = isset($settings['container_bg_img']['url']) ? $settings['container_bg_img']['url'] : '';
        $bg_color_media = isset($settings['container_bg_color']) ? $settings['container_bg_color'] : '';

        if (!empty($settings['media_source']) && is_array($settings['media_source'])) {
			foreach ($settings['media_source'] as $key => $item) {
                array_push($playlist_songs, $item['track_source']['url']);
            }
        }

?>
<div class="playlist-wrapper" style="background:<?php echo esc_attr($bg_color_media); ?> url(<?php echo esc_attr($bg_image_media); ?>) no-repeat center center / cover;">
    <section class="playlist-container" data-playlist-songs="<?php echo esc_attr( wp_json_encode( $playlist_songs ) ); ?>">
        <div class="content">
            <div class="slider-playlist">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <?php
                        if (!empty($settings['media_source']) && is_array($settings['media_source'])) {
                            foreach ($settings['media_source'] as $key => $item) {
                        ?>
                        <div class="swiper-slide">
                            <img
                                src="<?php echo esc_attr($item['track_poster']['url']) ?>" />
                            <h1><?php echo esc_html($item['track_album']) ?></h1>
                        </div>
                        <?php
                        
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="playlist">
                    <?php
                        if (!empty($settings['media_source']) && is_array($settings['media_source'])) {
                            foreach ($settings['media_source'] as $key => $item) {
                    ?>
                    <div class="playlist-item">
                        <img src="<?php echo esc_attr($item['track_poster']['url']) ?>"
                            alt="" />
                        <div class="song">
                            <p><?php echo esc_html($item['track_album']) ?></p>
                            <p><?php echo esc_html($item['track_artist_name']) ?></p>
                        </div>
                        <p class="duration">--:--</p>
                        <i class="fa-regular fa-heart like-btn"></i>
                    </div>
                    <?php
                    
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="player">
                <audio id="audioPlayer" src="song-list/AfricanFella-CumbiaDeli.mp3" type="audio/mpeg"></audio>
                <div class="playing-timer">
                    <?php if($show_timer === 'yes'): ?>
                    <span id="current-time">00:00</span><span> / </span><span id="total-duration">00:00</span>
                    <?php endif; ?>
                </div>
                <div class="controls">
                    <svg id="shuffleBtn" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M18 4L21 7M21 7L18 10M21 7H17C16.0707 7 15.606 7 15.2196 7.07686C13.6329 7.39249 12.3925 8.63288 12.0769 10.2196C12 10.606 12 11.0707 12 12C12 12.9293 12 13.394 11.9231 13.7804C11.6075 15.3671 10.3671 16.6075 8.78036 16.9231C8.39397 17 7.92931 17 7 17H3M18 20L21 17M21 17L18 14M21 17H17C16.0707 17 15.606 17 15.2196 16.9231C15.1457 16.9084 15.0724 16.8917 15 16.873M3 7H7C7.92931 7 8.39397 7 8.78036 7.07686C8.85435 7.09158 8.92758 7.1083 9 7.12698"
                                stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                    <svg id="prevBtn" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M20.3 4.30998C20.03 4.18998 19.71 4.24998 19.49 4.44998L12.22 11.27V4.99998C12.22 4.69998 12.04 4.42998 11.77 4.30998C11.5 4.18998 11.18 4.24998 10.96 4.44998L3.49 11.45C3.34 11.59 3.25 11.79 3.25 12C3.25 12.21 3.34 12.41 3.49 12.55L10.96 19.55C11.1 19.68 11.29 19.75 11.47 19.75C11.57 19.75 11.67 19.73 11.77 19.69C12.04 19.57 12.22 19.3 12.22 19V12.73L19.49 19.55C19.63 19.68 19.82 19.75 20 19.75C20.1 19.75 20.2 19.73 20.3 19.69C20.57 19.57 20.75 19.3 20.75 19V4.99998C20.75 4.69998 20.57 4.42998 20.3 4.30998ZM10.72 17.27L5.1 12L10.72 6.72998V17.27ZM19.25 17.27L13.63 12L19.25 6.72998V17.27Z"
                                fill="#000000"></path>
                        </g>
                    </svg>
                    <button id="playPauseBtn">
                        <span id="playPauseIcon" class="fa-play">
                            <svg class="play" viewBox="-3 0 28 28" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <title>play</title>
                                    <desc>Created with Sketch Beta.</desc>
                                    <defs> </defs>
                                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                        sketch:type="MSPage">
                                        <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                            transform="translate(-419.000000, -571.000000)" fill="#000000">
                                            <path
                                                d="M440.415,583.554 L421.418,571.311 C420.291,570.704 419,570.767 419,572.946 L419,597.054 C419,599.046 420.385,599.36 421.418,598.689 L440.415,586.446 C441.197,585.647 441.197,584.353 440.415,583.554"
                                                id="play" sketch:type="MSShapeGroup"> </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <svg class="pause" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d="M8 5V19M16 5V19" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                    </button>
                    <svg id="nextBtn" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M20.51 11.45L13.04 4.44998C12.82 4.24998 12.5 4.18998 12.23 4.30998C11.96 4.42998 11.78 4.69998 11.78 4.99998V11.27L4.51 4.44998C4.29 4.24998 3.97 4.18998 3.7 4.30998C3.43 4.42998 3.25 4.69998 3.25 4.99998V19C3.25 19.3 3.43 19.57 3.7 19.69C3.8 19.73 3.9 19.75 4 19.75C4.19 19.75 4.37 19.68 4.51 19.55L11.78 12.73V19C11.78 19.3 11.96 19.57 12.23 19.69C12.33 19.73 12.43 19.75 12.53 19.75C12.72 19.75 12.9 19.68 13.04 19.55L20.51 12.55C20.66 12.41 20.75 12.21 20.75 12C20.75 11.79 20.66 11.59 20.51 11.45ZM4.75 17.27V6.72998L10.37 12L4.75 17.27ZM13.28 17.27V6.72998L18.9 12L13.28 17.27Z"
                                fill="#000000"></path>
                        </g>
                    </svg>
                    <div class="volume">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.0004 9.00009C16.6281 9.83575 17 10.8745 17 12.0001C17 13.1257 16.6281 14.1644 16.0004 15.0001M18 5.29177C19.8412 6.93973 21 9.33459 21 12.0001C21 14.6656 19.8412 17.0604 18 18.7084M4.6 9.00009H5.5012C6.05213 9.00009 6.32759 9.00009 6.58285 8.93141C6.80903 8.87056 7.02275 8.77046 7.21429 8.63566C7.43047 8.48353 7.60681 8.27191 7.95951 7.84868L10.5854 4.69758C11.0211 4.17476 11.2389 3.91335 11.4292 3.88614C11.594 3.86258 11.7597 3.92258 11.8712 4.04617C12 4.18889 12 4.52917 12 5.20973V18.7904C12 19.471 12 19.8113 11.8712 19.954C11.7597 20.0776 11.594 20.1376 11.4292 20.114C11.239 20.0868 11.0211 19.8254 10.5854 19.3026L7.95951 16.1515C7.60681 15.7283 7.43047 15.5166 7.21429 15.3645C7.02275 15.2297 6.80903 15.1296 6.58285 15.0688C6.32759 15.0001 6.05213 15.0001 5.5012 15.0001H4.6C4.03995 15.0001 3.75992 15.0001 3.54601 14.8911C3.35785 14.7952 3.20487 14.6422 3.10899 14.4541C3 14.2402 3 13.9601 3 13.4001V10.6001C3 10.04 3 9.76001 3.10899 9.54609C3.20487 9.35793 3.35785 9.20495 3.54601 9.10908C3.75992 9.00009 4.03995 9.00009 4.6 9.00009Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        <input type="range" id="volume-range" min="0" max="100" value="100" />
                    </div>
                </div>
                <input type="range" value="0" id="progress-bar" />
            </div>
        </div>
    </section>
</div>
<?php
	}
}
