<?php
$Satellite = new Satellite;
$awesome = $this->get_option('Awesome');
$optionsArray = array(
    array("name" => __("Width", STLAWE_PLUGIN_NAME),
        "desc" => __("How wide will your awesome images be in pixels?", STLAWE_PLUGIN_NAME),
        "id" => "width",
        "type" => "text",
        "value" => $awesome['width'],
        "std" => "180"),
    array("name" => __('Starting Opacity', STLAWE_PLUGIN_NAME),
        "desc" => __("All images will start at this opacity and show full on hover", STLAWE_PLUGIN_NAME),
        "id" => "startOpacity",
        "type" => "select",
        "value" => $awesome['startOpacity'],
        "std" => '8',
        "options" => array(
            array('id' => '5', 'title' => __('50% Opacity', STLAWE_PLUGIN_NAME)),
            array('id' => '6', 'title' => __('60% Opacity', STLAWE_PLUGIN_NAME)),
            array('id' => '7', 'title' => __('70% Opacity', STLAWE_PLUGIN_NAME)),
            array('id' => '8', 'title' => __('80% Opacity', STLAWE_PLUGIN_NAME)),
            array('id' => '9', 'title' => __('90% Opacity', STLAWE_PLUGIN_NAME)),
            array('id' => '10', 'title' => __('Full Opacity', STLAWE_PLUGIN_NAME)),
        )
    )
);

?>
<table class="form-table">
    <tbody>
    <?php $Satellite->Form->display($optionsArray, $this->pre . 'Awesome'); ?>
    </tbody>
</table>