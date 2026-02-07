<?php
namespace BMianAddon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

if (! defined('ABSPATH')) exit; // Exit if accessed directly
class Classic_Video_Playlist extends Widget_Base {

    public function get_name() {
        return 'classic_video_player_playlist';
    }

    public function get_title() {
        return __('Classic Video Playlist', 'media-player-addons-for-elementor');
    }

    public function get_icon() {
        return 'classic-video-playlist bl_icon';
    }
    public function get_categories() {
        return ['media-player-addons-for-elementor'];
    }
    public function get_keywords() {
        return ['video', 'playlist', 'classic', 'media', 'player'];
    }
    public function get_script_depends()
	{
		return ['classic-video-playlist', 'elementor-frontend'];
	}
    protected function register_controls() {
        $this->start_controls_section(
			'section_content',
			[
				'label' 	=> esc_html__('Classic Video Playlist Settings', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'track_options',
			[
				'label' 	=> esc_html__('Track Options', 'media-player-addons-for-elementor'),
				'type' 		=> Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'playlist_label',
            [
                'label' => esc_html__('Playlist Label', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Playlist', 'media-player-addons-for-elementor'),
                'placeholder' => esc_html__('Enter playlist label here', 'media-player-addons-for-elementor'),
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'video_title',
			[
				'label' 		=> esc_html__('Video Title', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input Video Title here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);

		$repeater->add_control(
			'video_source',
			[
				'label' 		=> esc_html__('Video Source', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'media_type' 	=> 'video',
				'description'	=> esc_html__('Upload or Paste Your Video here', 'media-player-addons-for-elementor'),
				'label_block'	=> true,
			]
		);
		$repeater->add_control(
			'video_poster',
			[
				'label' 		=> esc_html__('Video Poster', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' 		=> \Elementor\Utils::get_placeholder_image_src(),
				],
				'label_block'	=> true,
			]
		);
		$repeater->add_control(
			'video_artist_name',
			[
				'label' 		=> esc_html__('Video Artist Name', 'media-player-addons-for-elementor'),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder'	=> esc_attr__('Input video artist name here', 'media-player-addons-for-elementor'),
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
						'video_title' => 'Stellar Journey',
                        'video_poster' => [
                            'url' => 'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&w=800&q=80'
                        ],
                        'video_source' => [
                            'url' => 'https://test-streams.mux.dev/x36xhzz/x36xhzz.m3u8'
                        ],
                        'video_artist_name' => 'Artist Name',
                    ],
                    [
						'video_title' => 'Cosmic Drift',
                        'video_poster' => [
                            'url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=800&q=80'
                        ],
                        'video_source' => [
                            'url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                        ],
                        'video_artist_name' => 'Artist Name',
                    ],
                    [
						'video_title' => 'Neon Nights',
                        'video_poster' => [
                            'url' => 'https://github.com/user-attachments/assets/a2ca0dfd-e53f-4e79-b8b0-288847e59b9a'
                        ],
                        'video_source' => [
                            'url' => 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4'
                        ],
                        'video_artist_name' => 'Artist Name',
                    ],
                    [
						'video_title' => 'Lunar Dreams',
                        'video_poster' => [
                            'url' => 'https://images.unsplash.com/photo-1504199367641-aba8151af406?auto=format&fit=crop&w=800&q=80'
                        ],
                        'video_source' => [
                            'url' => 'https://www.w3schools.com/html/mov_bbb.mp4'
                        ],
                        'video_artist_name' => 'Artist Name',
                    ],
                ],
				'title_field' 	=> '{{{ video_title }}}',
			]
		);

        $this->add_control(
            'show_player_repeat',
            [
                'label' => __('Show Player Repeat', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'on', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'off', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_player_autoplay',
            [
                'label' => __('Show Player Autoplay', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'on', 'media-player-addons-for-elementor' ),
                'label_off' => __( 'off', 'media-player-addons-for-elementor' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_playlist',
            [
                'label' => __('Show Playlist', 'media-player-addons-for-elementor'),
                'type' => Controls_Manager::SWITCHER,
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
				'label' 	=> esc_html__('Layout', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .container-video-playlist',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'player_border',
				'selector' => '{{WRAPPER}} .container-video-playlist',
			]
		);
		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .container-video-playlist' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .container-video-playlist',
			]
		);
		$this->add_control(
			'container_padding',
			[
				'label' => esc_html__( 'Padding', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .container-video-playlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'container_margin',
			[
				'label' => esc_html__( 'Margin', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .container-video-playlist' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'style_control_playlist',
			[
				'label' 	=> esc_html__('Playlist', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'List Title Typography', 'media-player-addons-for-elementor' ),
				'name' => 'title_track_typography',
				'selector' => '{{WRAPPER}} .video-playlist-item .title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'List Duration Typography', 'media-player-addons-for-elementor' ),
				'name' => 'title_track_duration_typography',
				'selector' => '{{WRAPPER}} .video-playlist-item .duration',
			]
		);
		$this->start_controls_tabs(
			'style_tabs',
			[
				'label' => esc_html__( 'Playlist Item', 'media-player-addons-for-elementor' ),
			]
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'media-player-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'title_track_normal_color',
			[
				'label' => esc_html__( 'Title Track Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'track_duration_normal_color',
			[
				'label' => esc_html__( 'Track Duration Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item .duration' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'background_normal_color',
			[
				'label' => esc_html__( 'Background', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'media-player-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'title_track_hover_color',
			[
				'label' => esc_html__( 'Title Track Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item:hover .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'track_duration_hover_color',
			[
				'label' => esc_html__( 'Track Duration Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item:hover .duration' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'background_hover_color',
			[
				'label' => esc_html__( 'Background', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_active_tab',
			[
				'label' => esc_html__( 'Active', 'media-player-addons-for-elementor' ),
			]
		);
		$this->add_control(
			'title_track_active_color',
			[
				'label' => esc_html__( 'Title Track Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item.active .title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'track_duration_active_color',
			[
				'label' => esc_html__( 'Track Duration Text Color', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item.active .duration' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'background_active_color',
			[
				'label' => esc_html__( 'Background ', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item.active' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'playlist_border',
				'selector' => '{{WRAPPER}} .video-playlist-item ',
			]
		);
		$this->add_control(
			'playlist_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'playlist_item_padding',
			[
				'label' => esc_html__( 'Padding', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'playlist_item_margin',
			[
				'label' => esc_html__( 'Margin', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .video-playlist-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'style_play_button_settings',
			[
				'label' 	=> esc_html__('Play Button', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
            'play_button_size',
            [
                'label' => esc_html__( 'Button Size', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'play_button_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'play_button_style_tabs',
            [
                'label' => esc_html__( 'Play Button', 'media-player-addons-for-elementor' ),
            ]
        );

        $this->start_controls_tab(
            'play_button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'media-player-addons-for-elementor' ),
            ]
        );
        $this->add_control(
            'play_button_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'play_button_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'play_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'media-player-addons-for-elementor' ),
            ]
        );
        $this->add_control(
            'play_button_bg_hover_color',
            [
                'label' => esc_html__( 'Background Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'play_button_icon_hover_color',
            [
                'label' => esc_html__( 'Icon Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'play_button_border',
                'selector' => '{{WRAPPER}} .container-video-playlist .center-control',
            ]
        );
        $this->add_control(
            'play_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'play_button_padding',
            [
                'label' => esc_html__( 'Padding', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'play_button_margin',
            [
                'label' => esc_html__( 'Margin', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .container-video-playlist .center-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_controls_settings',
			[
				'label' 	=> esc_html__('Controls', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'player_controls_color',
			[
				'label' => esc_html__( 'Controls Color ', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .container-video-playlist input:checked+.slider' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .container-video-playlist .progress-bar' => 'background: {{VALUE}}',
					'{{WRAPPER}} .container-video-playlist .volume-fill' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'player_icons_color',
			[
				'label' => esc_html__( 'Icons Color ', 'media-player-addons-for-elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .container-video-playlist .btn i' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'style_controls_other_settings',
			[
				'label' 	=> esc_html__('Other Settings', 'media-player-addons-for-elementor'),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
            'header_background_color',
            [
                'label' => esc_html__( 'Header Background Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .playlist .header' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Playlist Label Typography', 'media-player-addons-for-elementor' ),
                'name' => 'playlist_label_typography',
                'selector' => '{{WRAPPER}} .playlist .header h4',
            ]
        );

        $this->add_control(
            'playlist_label_color',
            [
                'label' => esc_html__( 'Playlist Label Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .playlist .header h4' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Video Count Typography', 'media-player-addons-for-elementor' ),
                'name' => 'video_count_typography',
                'selector' => '{{WRAPPER}} .playlist .header span',
            ]
        );

        $this->add_control(
            'video_count_color',
            [
                'label' => esc_html__( 'Video Count Color', 'media-player-addons-for-elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .playlist .header span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'label' => esc_html__( 'Overlay Title Typography', 'media-player-addons-for-elementor' ),
            'name' => 'overlay_title_typography',
            'selector' => '{{WRAPPER}} .container-video-playlist .overlay',
            ]
        );

        $this->add_control(
            'overlay_title_color',
            [
            'label' => esc_html__( 'Overlay Title Color', 'media-player-addons-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .container-video-playlist .overlay' => 'color: {{VALUE}}',
            ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
            'label' => esc_html__( 'Label Typography', 'media-player-addons-for-elementor' ),
            'name' => 'label_typography',
            'selector' => '{{WRAPPER}} .container-video-playlist .more-videos',
            ]
        );

        $this->add_control(
            'label_color',
            [
            'label' => esc_html__( 'Label Color', 'media-player-addons-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .container-video-playlist .more-videos' => 'color: {{VALUE}}',
            ],
            ]
        );
        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $playlist_label = !empty($settings['playlist_label']) ? $settings['playlist_label'] : esc_html__('Playlist', 'media-player-addons-for-elementor');
        $playlist_videos = !empty($settings['media_source']) ? $settings['media_source'] : [];
        $video_count = count($playlist_videos);
        $show_player_repeat = isset($settings['show_player_repeat']) && $settings['show_player_repeat'] === 'yes' ? true : false;
        $show_player_autoplay = isset($settings['show_player_autoplay']) && $settings['show_player_autoplay'] === 'yes' ? true : false;
        $show_playlist = isset($settings['show_playlist']) && $settings['show_playlist'] === 'yes' ? true : false;

        ?>
        <div class="container-video-playlist">

            <div class="video-player" id="player">
                <video id="main-video" class="main-video" playsinline>
                    <source src="<?php echo esc_url($playlist_videos[0]['video_source']['url']); ?>" type="video/mp4">
                </video>

                <div class="center-control" id="center-toggle">
                    <i class="ri-memories-line"></i>
                </div>

                <div class="overlay">STOP! NO MORE WINGING IT!</div>
                <div class="more-videos">MORE VIDEOS!</div>

                <div class="custom-controls">
                    <div class="controls-wrapper">
                        <div class="progress-row">
                            <button class="btn play-pause" id="play-pause-btn">
                                <i class="ri-play-fill"></i>
                            </button>
                            <?php if ( $show_player_repeat ) : ?>
                            <button class="btn" id="loop-btn" data-tooltip="Loop current video">
                                <i class="ri-memories-line"></i>
                            </button>
                            <?php endif; ?>
                            <div class="progress-container" id="progress-container">
                                <div class="progress-bar" id="video-progress-bar"></div>
                                <div class="progress-tooltip" id="progress-tooltip"></div>
                            </div>
                            <span class="time-display">
                                <span id="current-time">00:00</span> / <span id="duration">00:00</span>
                            </span>
                            <?php if ( $show_player_autoplay ) : ?>
                            <div class="toggle-container" id="autoplay-container" data-tooltip-on="Autoplay on" data-tooltip-off="Autoplay off">
                                <label class="switch">
                                    <input type="checkbox" id="autoplay-toggle" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="controls-main">
                            <div class="left-controls">
                                <div class="volume-group">
                                    <button class="btn" id="mute-btn">
                                        <i class="ri-volume-up-fill"></i>
                                    </button>
                                    <div class="volume-slider" id="volume-slider">
                                        <div class="volume-fill" id="volume-fill"></div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn fullscreen-btn" id="fullscreen-btn">
                                <i class="ri-fullscreen-fill"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($video_count > 1 && $show_playlist)  : ?>
            <div class="playlist">
                <div class="header">
                    <h4><?php echo esc_html($playlist_label); ?></h4> <span><?php echo esc_html($video_count); ?> Videos</span>
                </div>

                <ul id="playlist">
                    <?php foreach ($playlist_videos as $index => $video) :
						$active_class = ($index === 0) ? 'active' : '';
					?>
                    <li data-src="<?php echo esc_url($video['video_source']['url']); ?>" class="<?php echo esc_attr($active_class); ?> video-playlist-item">
                        <img src="<?php echo esc_url($video['video_poster']['url']); ?>" alt="<?php echo esc_attr($video['video_title']); ?>">
                        <span class="title"><?php echo esc_html($video['video_title']); ?></span>
                        <span class="duration">--:--</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
        </div>
        <?php
    }

}