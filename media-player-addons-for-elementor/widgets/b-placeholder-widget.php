<?php
namespace BMianAddon\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class B_Lock_Widget extends Widget_Base {

    private $locked_widget_name;
    private $locked_widget_icon;
    private $locked_widget_id;

    public function __construct( $locked_widget_name = 'Locked Widget', $locked_widget_id = 'b-lock-widget', $locked_widget_icon = 'eicon-lock-user', $data = [], $args = null ) {
        parent::__construct( $data, $args );
        $this->locked_widget_name = $locked_widget_name;
        $this->locked_widget_id = $locked_widget_id;
        $this->locked_widget_icon = $locked_widget_icon;
    }

    public function get_name() {
        return $this->locked_widget_id;
    }

    public function get_title() {
        return esc_html__( $this->locked_widget_name, 'media-player-addons-for-elementor' );
    }

    public function get_icon() {
        return $this->locked_widget_icon;
    }

    public function get_categories() {
        return [ 'b_pro_widgets' ];
    }

    public function is_premium() {
        return true;
    }

    public function get_keywords() {
        return [ 'locked', 'pro', 'upgrade' ];
    }

    protected function render() {
        // This will be seen only if manually added somehow.
        echo '<div style="border:1px dashed #ccc;padding:10px;text-align:center;">';
        echo esc_html__( 'This is a Pro widget. Please upgrade to unlock full access.', 'media-player-addons-for-elementor' );
        echo '</div>';
    }
}