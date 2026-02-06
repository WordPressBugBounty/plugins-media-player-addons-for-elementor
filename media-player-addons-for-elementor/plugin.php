<?php
namespace BMianAddon;

use BMianAddon\Widgets\b_html5_addon;
use BMianAddon\Widgets\b_html5_audio;
use BMianAddon\Widgets\b_youtube_vedio;
use BMianAddon\Widgets\b_vemio_vedio;
use BMianAddon\Widgets\b_art_addon;
use BMianAddon\Widgets\Bplayer;
use BMianAddon\Widgets\d_player;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class b_Addon {

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
		
		 wp_register_script( 'hls', plugins_url( '/assets/js/hls.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], false, true );
         wp_register_script( 'plyr-js', plugins_url( '/assets/js/plyr.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], false, true );
		 wp_register_script( 'artplayer-js', plugins_url( '/assets/js/artplayer.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], false, true );
		 wp_register_script( 'danmuku-js', plugins_url( '/assets/js/artplayer-plugin-danmuku.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], false, true );
		 wp_register_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [ 'jquery', 'elementor-frontend' ], false, true );


		wp_register_script( 'dplayermin-js', plugins_url( '/assets/js/dplayer.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend' ], false, true );

		
		wp_register_script( 'bplayer-playlist', plugins_url( '/assets/js/main-scripts-playlist.js', __FILE__ ), [ 'jquery', 'elementor-frontend', 'bplayer-script'], false, true );
		wp_register_script( 'bplayer-audio-playlist', plugins_url( '/assets/js/main-audio-playlist.js', __FILE__ ), [ 'jquery', 'elementor-frontend', 'bplayer-script'], false, true );
		wp_register_script( 'bplayer-main', plugins_url( '/assets/js/main-scripts.js', __FILE__ ), [ 'jquery', 'bplayer-script', 'elementor-frontend'], false, true );
		wp_register_script( 'bplayer-script', plugins_url( '/assets/js/bplayer.min.js', __FILE__ ), [ 'jquery', 'elementor-frontend'], false, true );

		wp_register_script( 'main-js', plugins_url( '/assets/js/main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'hls'], false, true );
		wp_register_script( 'art-main-js', plugins_url( '/assets/js/art-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'artplayer-js'], false, true );
		wp_register_script( 'd-player-main-js', plugins_url( '/assets/js/d-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'dplayermin-js'], false, true );
		wp_register_script( 'html5-player-main', plugins_url( '/assets/js/html5-player-main.js', __FILE__ ), ['jquery', 'elementor-frontend', 'hls'], false, true );
		wp_register_script( 'html5-audio-player', plugins_url( '/assets/js/html5-audio-player.js', __FILE__ ), ['jquery', 'elementor-frontend', 'hls', 'plyr-js'], false, true );
		wp_register_script( 'youtube-player', plugins_url( '/assets/js/youtube-player.js', __FILE__ ), ['jquery', 'elementor-frontend', 'plyr-js'], false, true );
		wp_register_script( 'audio-playlist-player', plugins_url( '/assets/js/advanced-audio-playlist.js', __FILE__ ), ['jquery', 'elementor-frontend', 'swiper-js'], false, true );
		wp_register_script( 'classic-playlist-player', plugins_url( '/assets/js/classic-audio-playlist.js', __FILE__ ), ['jquery', 'elementor-frontend'], false, true );

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

		wp_register_style("ua-plyry",plugins_url("/assets/css/plyr.css",__FILE__), array(), '1.0.10');
		wp_enqueue_style( 'ua-plyry' );
		wp_register_style("ua-plyr-css",plugins_url("/assets/css/styler.css",__FILE__), array(), '1.0.10');
		wp_enqueue_style( 'ua-plyr-css' );

	}

	public function register_lock_script() {
		wp_enqueue_script(
			'b-locked-widget-admin-lock',
			plugin_dir_url( __FILE__ ) . 'assets/js/admin-lock.js',
			['jquery'],
			'1.0.0',
			true
		);
		wp_localize_script( 'b-locked-widget-admin-lock', 'MyLockedWidget', [
			'upgradeUrl' => admin_url( 'admin.php?page=media-player-addons-for-elementor#/pricing' ),
			'widgetName' => 'Media Player Addons Pro',
		] );
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

		if ( !in_array( 'bmp_art_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-artplayer.php' );
		}
		if ( !in_array( 'bmp_dplayer_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/d_player.php' );
		}
		if ( !in_array( 'bmp_vimeo_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-vemio-vedio-player.php' );
		}
		if ( !in_array( 'bmp_html5_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b_html5_addon.php' );
		}
		if ( !in_array( 'bmp_html5_audio_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-html5-audio.php' );
		}
		if ( !in_array( 'bmp_youtube_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-youtube-vedio-player.php' );
		}
		//for bplayer
		if ( !in_array( 'bmp_advance_audio_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-audio.php' );
		}
		if ( !in_array( 'bmp_audio_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-playlist-audio.php' );
		}
		if ( !in_array( 'bmp_video_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-playlist-video.php' );
		}
		if ( !in_array( 'bmp_advance_video_player', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/bplayer-widget-video.php' );
		}	
		if ( !in_array( 'bmp_advance_audio_player_playlist', $active_widgets, true ) ) {
			require_once( __DIR__ . '/widgets/b-advance-audio-playlist.php' );
		}
		if( mpafeIsPremium() ) {
			if ( !in_array( 'bmp_classic_audio_player_playlist', $active_widgets, true ) ) {
				require_once( __DIR__ . '/widgets/b-classic-audio-playlist.php' );
			}
		} else {
			//register lock widget for non pro users
			require_once( __DIR__ . '/widgets/b-placeholder-widget.php' );
		}

	}
	//editor scripts
	function editor_scripts() {
		wp_register_style("swiper-style",'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
		wp_enqueue_style( 'swiper-style' );
		wp_register_style("ua-aa",plugins_url("/assets/css/style.css",__FILE__));
		wp_enqueue_style( 'ua-aa' );
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

		if ( !in_array( 'bmp_vimeo_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\b_vemio_vedio() );
		}
		if ( !in_array( 'bmp_art_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\b_art_addon() );
		}
		//dplayer
		if ( !in_array( 'bmp_dplayer_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\d_player() );
		}
		if ( !in_array( 'bmp_html5_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\b_html5_addon() );
		}
		if ( !in_array( 'bmp_html5_audio_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\b_html5_audio() );
		}
		if ( !in_array( 'bmp_youtube_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\b_youtube_vedio() );
		}

		//for bplayer
		if ( !in_array( 'bmp_advance_audio_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bplayer() );
		}
		if ( !in_array( 'bmp_audio_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bplayer_Playlist() );
		}
		if ( !in_array( 'bmp_advance_video_player', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bplayer_Video() );
		}
		if ( !in_array( 'bmp_video_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Bplayer_Video_Playlist() );
		}
		if ( !in_array( 'bmp_advance_audio_player_playlist', $active_widgets, true ) ) {
			\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Advance_Audio_Playlist() );
		}
		if( mpafeIsPremium() ) {
			if ( !in_array( 'bmp_classic_audio_player_playlist', $active_widgets, true ) ) {
				\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Classic_Audio_Playlist() );
			}
		} else {
			//register lock widget for non pro users
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\B_Lock_Widget('Classic Audio Playlist', 'classic-audio-playlist') );
		}

	}
	
	//category registered
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'media-player-addons-for-elementor',
			[
				'title' => __('Media Player For Elementor', 'media-player-addons-for-elementor' ),
				'icon' => 'fa fa-plug',
			]
		);
		$elements_manager->add_category(
			'b_pro_widgets',
			[
				'title' => __( 'Media Player Pro For Elementor', 'media-player-addons-for-elementor' ),
				'icon'  => 'fa fa-lock',
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
		add_action( 'elementor/elements/categories_registered',  [ $this,'add_elementor_widget_categories' ]);
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'editor_scripts' ] , 100 );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'register_lock_script' ] );
	}

}
b_Addon::instance();


