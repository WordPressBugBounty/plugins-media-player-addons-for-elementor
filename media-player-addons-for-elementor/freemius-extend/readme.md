# Step 1 

### Include the Freemius Extension
To integrate the Lock functionality, add the following statement to your plugin's main file:

Replace `your_plugin_fs` with your Freemius integration function name

```PHP
require_once('freemius-extend/index.php');

FreemiusExtend::instance(your_plugin_fs(), [
	'upgradeUrl' => 'https://checkout.freemius.com/plugin/20780/plan/34626/',
	'title' => 'Unlock Pro features', // optionnal
	'message' => 'This control is available in Pro.', // optionnal
	'confirm' => 'Upgrade Now', // optionnal
	'cancel' => 'Maybe later', // optionnal
]);
```

# Step 2 - Add Following Method to the Widget Class


## Method 1

```PHP
   /**
     * Add a control to the widget.
     * 
     * Extends parent add_control to handle premium controls by adding
     * visual indicators and locking for non-premium users.
     *
     * @param string $name Control name
     * @param array $args Control arguments
     * @param array $options Control additional options
     * @return void
     */
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

    
    // Control additional options for group control
    public function add_group__control($group_name, $args = [], $options = [])
    {
        // Check if this is a premium control and user doesn't have premium access
        if (!$this->is_premium() && in_array($args['name'], $this->premium_controls())) {
            // Append _locked to control name
            $args['name'] = $args['name'] . '_locked';

            // Add Pro label and locked class
            $args['label'] = $args['label'] . " <span class='fs_pro_control_label'>Pro</span>";
            $args['classes'] = isset($args['classes']) ? $args['classes'] . ' fs-locked' : 'fs-locked';
            $args['type'] =  Controls_Manager::RAW_HTML;
            $args['raw']   = ' <i class="eicon-edit" aria-hidden="true" style="font-family: eicons, Bangla1046, sans-serif;"></i>';

            parent::add_control($args['name'], $args, $options);
        } else {
            parent::add_group_control($group_name, $args, $options);
        }
    }
```





## Method 2 - Premium Feature Availability Check

This method verifies if premium features are accessible to the current user. Replace `your_plugin_fs` with your Freemius integration function name.

```PHP
    /**
     * Check if premium features are available
     * 
     * Checks if the premium licensing system is active and the current user
     * has access to premium features.
     *
     * @since 1.0.0
     * @access public
     * @return boolean True if premium features are available, false otherwise
     */
    public function is_premium() 
    {
        return function_exists('your_plugin_fs') && your_plugin_fs()->can_use_premium_code();
    }

```

## Method 3 - Add List of Premium Controls

```PHP
    /**
     * Get list of premium controls
     * 
     * Returns an array of control names that are only available in premium version.
     *
     * @since 1.0.0
     * @access public
     * @return array Array of premium control names/ids
     */
    public function premium_controls()
    {
        return [
           
        ];
    }
```

# Step 3 - Configure Premium Feature Lock Settings

Update the `FS_Lock` configuration object in the `waitUntilLoadJquery` function within `index.php`. This object controls the premium feature upgrade dialog:

```js
const FS_Lock = {
                upgradeUrl: 'https://checkout.freemius.com/plugin/20780/plan/34626/',
                title: 'Unlock Pro features',
                message: 'This control is available in Pro.',
                confirm: 'Upgrade',
                cancel: 'Maybe later',
            }

```