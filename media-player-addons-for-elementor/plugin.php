<?php
namespace MPAFE;

use MPAFE\Widgets\b_html5_addon;
use MPAFE\Widgets\b_html5_audio;
use MPAFE\Widgets\b_youtube_vedio;
use MPAFE\Widgets\b_vemio_vedio;
use MPAFE\Widgets\b_art_addon;
use MPAFE\Widgets\Bplayer;
use MPAFE\Widgets\d_player;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class mpafe_Addon {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {

		 wp_enqueue_script('jquery');
		
		 wp_register_script( 'mpafe-hls', plugins_url( '/assets/js/hls.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );
         wp_register_script( 'mpafe-plyr-js', plugins_url( '/assets/js/plyr.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );
		 wp_register_script( 'mpafe-artplayer-js', plugins_url( '/assets/js/artplayer.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );
		 wp_register_script( 'mpafe-danmuku-js', plugins_url( '/assets/js/artplayer-plugin-danmuku.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );
		 wp_register_script( 'mpafe-swiper-js', plugins_url('/vendor/swiper/swiper-bundle.min.js',__FILE__), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );


		wp_register_script( 'mpafe-dplayermin-js', plugins_url( '/assets/js/dplayer.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], MPAFE_VERSION, true );

		
		wp_register_script( 'mpafe-bplayer-playlist', plugins_url( '/assets/js/main-scripts-playlist.js', __FILE__ ), [ 'jquery', 'elementor-frontend', 'mpafe-bplayer-script'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-bplayer-audio-playlist', plugins_url( '/assets/js/main-audio-playlist.js', __FILE__ ), [ 'jquery', 'elementor-frontend', 'mpafe-bplayer-script'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-bplayer-main', plugins_url( '/assets/js/main-scripts.js', __FILE__ ), [ 'jquery', 'mpafe-bplayer-script', 'elementor-frontend'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-bplayer-script', plugins_url( '/assets/js/bplayer.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend'], MPAFE_VERSION, true );

		wp_register_script( 'mpafe-main-js', plugins_url( '/assets/js/main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-hls'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-art-main-js', plugins_url( '/assets/js/art-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'artplayer-js'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-d-player-main-js', plugins_url( '/assets/js/d-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-dplayermin-js'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-html5-player-main', plugins_url( '/assets/js/html5-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-hls'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-html5-audio-player', plugins_url( '/assets/js/html5-audio-player.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-hls', 'mpafe-plyr-js'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-youtube-player', plugins_url( '/assets/js/youtube-player.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-plyr-js'], MPAFE_VERSION, true );
		wp_register_script( 'mpafe-audio-playlist-player', plugins_url( '/assets/js/advanced-audio-playlist.js', __FILE__ ), ['jquery', 'elementor-frontend', 'mpafe-swiper-js'], MPAFE_VERSION, true );

	}
	
	/**
	 * widget_styles
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_styles(){

		wp_register_style("mpafe-ua-plyry",plugins_url("/assets/css/plyr.css",__FILE__), [], MPAFE_VERSION);
		wp_enqueue_style( 'mpafe-ua-plyry' );
		wp_register_style("mpafe-ua-plyr-css",plugins_url("/assets/css/styler.css",__FILE__), [], MPAFE_VERSION);
		wp_enqueue_style( 'mpafe-ua-plyr-css' );

	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {

		$active_widgets = (array) get_option( 'mpafeGetBlocks', [] );

		if ( !in_array( 'mpafe_art_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-artplayer.php' );
		}
		if ( !in_array( 'mpafe_dplayer_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/d_player.php' );
		}
		if ( !in_array( 'mpafe_vimeo_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-vemio-vedio-player.php' );
		}
		if ( !in_array( 'mpafe_html5_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b_html5_addon.php' );
		}
		if ( !in_array( 'mpafe_html5_audio_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-html5-audio.php' );
		}
		if ( !in_array( 'mpafe_youtube_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-youtube-vedio-player.php' );
		}
		//for bplayer
		if ( !in_array( 'mpafe_advance_audio_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-audio.php' );
		}
		if ( !in_array( 'mpafe_audio_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-playlist-audio.php' );
		}
		if ( !in_array( 'mpafe_video_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-playlist-video.php' );
		}
		if ( !in_array( 'mpafe_advance_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-video.php' );
		}	
		if ( !in_array( 'mpafe_advance_audio_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-advance-audio-playlist.php' );
		}


	}
	//editor scripts
	function editor_scripts() {
		wp_register_style("mpafe-swiper-style", plugins_url('/vendor/swiper/swiper-bundle.min.css',__FILE__), [], MPAFE_VERSION, false);
		wp_enqueue_style( 'mpafe-swiper-style' );
		wp_register_style("mpafe-ua-aa",plugins_url("/assets/css/style.css",__FILE__), [], MPAFE_VERSION, false);
		wp_enqueue_style( 'mpafe-ua-aa' );
	}
	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();
		// Register Widgets
		$active_widgets = get_option( 'mpafeGetBlocks', [] );

		if(empty($active_widgets)) {
			$active_widgets = ['default_list'];
		}

		if ( !in_array( 'mpafe_vimeo_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_vemio_vedio() );
		}
		if ( !in_array( 'mpafe_art_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_art_addon() );
		}
		//dplayer
		if ( !in_array( 'mpafe_dplayer_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_d_player() );
		}
		if ( !in_array( 'mpafe_html5_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_html5_addon() );
		}
		if ( !in_array( 'mpafe_html5_audio_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_html5_audio() );
		}
		if ( !in_array( 'mpafe_youtube_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_youtube_vedio() );
		}

		//for bplayer
		if ( !in_array( 'mpafe_advance_audio_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_Bplayer() );
		}
		if ( !in_array( 'mpafe_audio_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_Bplayer_Playlist() );
		}
		if ( !in_array( 'mpafe_advance_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_Bplayer_Video() );
		}
		if ( !in_array( 'mpafe_video_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_Bplayer_Video_Playlist() );
		}
		if ( !in_array( 'mpafe_advance_audio_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\mpafe_Advance_Audio_Playlist() );
		}


	}
	
	//category registered
	public function mpafe_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'media-player-addons-for-elementor',
			[
				'title' => __('Media Player For Elementor', 'media-player-addons-for-elementor' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Enqueue widget styles
        add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_styles' ] , 100 );
        add_action( 'admin_enqueue_scripts', [ $this, 'widget_styles' ] , 100 );

		// Enqueue widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ], 100 );
        add_action( 'admin_enqueue_scripts', [ $this, 'widget_scripts' ] , 100 );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		//category registered
		add_action( 'elementor/elements/categories_registered',  [ $this,'mpafe_add_elementor_widget_categories' ]);
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'editor_scripts' ] , 100 );
	}

}
mpafe_Addon::instance();


