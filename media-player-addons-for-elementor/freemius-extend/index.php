<?php


if (!class_exists('FreemiusExtend')) {
    class FreemiusExtend
    {
        private static $_instance = null;
        private $fs = null;
        private $prefix = 'fs_';
        private $contents = [];
        public function __construct($fs, array $contents = [])
        {
            if (is_object($fs) && method_exists($fs, 'get_id')) {
                $this->fs = $fs;
                $this->prefix = 'fn_' . $fs->get_id();
                $this->contents = wp_parse_args($contents, $this->get_default_content());
            }
            add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_scripts']);
            add_action('wp_footer', [$this, 'wp_footer']);
        }

        public static function instance(object $fs, array $contents = [])
        {
            if (self::$_instance === null) {
                self::$_instance = new self($fs, $contents);
            }
            return self::$_instance;
        }

        public function enqueue_scripts()
        {
            wp_enqueue_script('jquery');
            wp_enqueue_script($this->prefix . 'script', plugin_dir_url(__FILE__) . 'editor-lock.js', ['jquery'], $this->fs->version, true);
            wp_localize_script($this->prefix . 'script', 'FS_Lock', $this->contents);
?>
            <style>
                .elementor-control-type-raw_html.fs-locked .elementor-control-content {
                    display: flex;
                    flex-direction: row !important;
                    justify-content: space-between;
                    align-items: center;
                }

                .fs-locked button,
                .fs-locked .e-global__popover-toggle,
                .fs-lockd .elementor-control-input-wrapper {
                    pointer-events: none;
                }
                
                .fs-locked .elementor-control-content .elementor-control-raw-html {
                    border: none !important;
                }

                .fs-locked .elementor-control-content i {
                    border: var(--e-a-border-bold);
                    width: 27px;
                    height: 27px;
                    border-radius: 3px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    color: #ffffff;
                    background: #3f444c;
                    cursor: pointer;
                }

                .elementor-control.fs-locked .elementor-control-title::after {
                    content: " 🔒";
                    font-weight: 600
                }

                .elementor-control.fs-locked .elementor-control-input,
                .elementor-control.fs-locked .elementor-slider,
                .elementor-control.fs-locked .elementor-slider-input {
                    cursor: not-allowed;
                }

                .elementor-control.fs-locked {
                    opacity: .5
                }

                .fs-upgrade-inline {
                    margin-top: 8px;
                    font-weight: 600
                }

                .fs-upgrade-box {
                    background: #fff7e6;
                    border: 1px dashed var(--e-a-btn-bg-accent);
                    padding: 10px;
                    border-radius: 8px
                }

                .fs_pro_control_label {
                    background: var(--e-a-btn-bg-accent);
                    color: #fff;
                    padding: 2px 5px;
                    border-radius: 4px;
                    font-size: 12px
                }
            </style>
<?php
        }

        function wp_footer()
        {
            // echo '<pre>';
            // print_r($this->prefix);
            // echo '</pre>';
        }

        public function get_default_content()
        {
            return [
                'upgradeUrl' => 'https://checkout.freemius.com/plugin/20780/plan/34626/',
                'title' => 'Unlock Pro features',
                'message' => 'This control is available in Pro.',
                'confirm' => 'Upgrade',
                'cancel' => 'Maybe later',
            ];
        }
    }
}
