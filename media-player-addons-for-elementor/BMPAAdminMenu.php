<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

if(!class_exists("MPAFEAdminMenu")) {
	class MPAFEAdminMenu {
		public function __construct() {
			add_action( 'admin_menu', [ $this, 'mpafeAdminMenu' ] );
			add_action( 'admin_enqueue_scripts', [$this, 'mpafeAdminEnqueueScripts'] );
			add_action('wp_ajax_bptbGetBlocks', [ $this, 'mpafeGetBlocks' ]);
		}
	
		public function mpafeAdminMenu() {
			$menuIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM10.6219 8.41459L15.5008 11.6672C15.6846 11.7897 15.7343 12.0381 15.6117 12.2219C15.5824 12.2658 15.5447 12.3035 15.5008 12.3328L10.6219 15.5854C10.4381 15.708 10.1897 15.6583 10.0672 15.4745C10.0234 15.4088 10 15.3316 10 15.2526V8.74741C10 8.52649 10.1791 8.34741 10.4 8.34741C10.479 8.34741 10.5562 8.37078 10.6219 8.41459Z"></path></svg>';
	
			add_menu_page(
				__( 'Media Player Addons by bPlugins', 'media-player-addons-for-elementor' ),
				__( 'Media Player', 'media-player-addons-for-elementor' ),
				'manage_options',
				'media-player-addons-for-elementor',
				'',
				'data:image/svg+xml;base64,' . base64_encode( $menuIcon ),
				22
			);
	
			add_submenu_page(
				'media-player-addons-for-elementor',
				__('Dashboard - Media Player Addons by bPlugins', 'media-player-addons-for-elementor'),
				__('Dashboard', 'media-player-addons-for-elementor'),
				'manage_options',
				'media-player-addons-for-elementor',
				[$this, 'mpafeRenderDashboardPage'],
				0
			);
		}

		public function mpafeGetBlocks(){
			$nonce = sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) ?? null;

			if( !wp_verify_nonce( $nonce, 'bptb_admin_nonce' )){
				wp_send_json_error( 'Invalid Request' );
			}

			$data = json_decode( stripslashes( $_POST['data'] ), true );
			$db_data = get_option( 'mpafeGetBlocks', [] );

			if( !isset( $data ) && $db_data ){
				wp_send_json_success( $db_data );
			}

			update_option( 'mpafeGetBlocks', $data );
			wp_send_json_success( $data );

		}
	
		public function mpafeRenderDashboardPage(){ ?>
			<div
				id='mpafebDashboard'
				data-info='<?php echo esc_attr( wp_json_encode( [
					'version' => BMPA_VERSION,
					'nonce' => wp_create_nonce( 'bptb_admin_nonce' ),
					'licenseActiveNonce' => wp_create_nonce( 'bPlLicenseActivation' ),
					'action' => 'bptbGetBlocks',
					'isPremium' => mpafeIsPremium(),
					'hasPro' => MPAFE_HAS_PRO,
					'pricingUrl' => admin_url('admin.php?page=media-player-addons-for-elementor#/pricing'),
				] ) ); ?>'
			></div>
		<?php }
	
		function mpafeAdminEnqueueScripts( $hook ) {
			if( strpos( $hook, 'media-player-addons-for-elementor' ) ){
				wp_enqueue_style( 'mpafe-admin-dashboard', BMPA_DIR_URL . 'build/admin/dashboard.css', [], BMPA_VERSION );
				wp_enqueue_script( 'mpafe-admin-dashboard', BMPA_DIR_URL . 'build/admin/dashboard.js', [ 'react', 'react-dom','wp-util' ], BMPA_VERSION, true );
				wp_set_script_translations( 'mpafe-admin-dashboard', 'media-player-addons-for-elementor', BMPA_DIR_PATH . 'languages' );
			}
		}
	}
	new MPAFEAdminMenu();
}
