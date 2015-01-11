<?php
// Satellite gives us all the tools and config settings of the parent plugin
$Satellite = new Satellite();

// Set a variable to hold all your unique plugin settings
$awesome = $this->get_option('Awesome');

$styling = ($w = $awesome['width']) ? 'width:'.$w.'px;' : null;

// Utilize the configuration saved for Images from the Satellite parent
$images = $this->get_option('Images');

// Use log_me to view arrays, objects or strings in the PHP error_log for local development.
$Satellite->log_me($images);

if (!empty($slides)) : 
  $Satellite->Gallery->loadData($slides[0]->section);
  /** Font Size is set on the Gallery **/
  $fontSize = $Satellite->Gallery->data->font;

  // How should the image be opened?
  $imagesbox = $images['imagesbox'];

  if ($imagesbox == "T") {
      $class="thickbox";
      $rel = null;
  } elseif ($imagesbox == "L") {
      $class = "lightbox";
      $rel = "lightbox[".$slides[0]->section."]";
  }

?>
<div id="awesome-slider">
    <?php foreach($slides as $slide):
        $image_src = $Satellite->Html->image_url($slide->image); ?>
        <div class="awesome-slide opac<?php echo $awesome['startOpacity'];?>" style="<?php echo $styling;?>">
            <?php // Link to a page rather than the image
            if ($slide->uselink == "Y" && !empty($slider->link)) : ?>
                <a href="<?php echo $slider->link; ?>" title="<?php echo $slider->title; ?>" target="<?php echo ($pagelink == "S") ? "_self" : "_blank" ?>">
            <?PHP // Link to the image - lightbox or thickbox? Make sure nolink isn't in place.
            elseif ($imagesbox != "N" && ! $this->get_option('nolinker')) : ?>
                <a class="<?php echo $class; ?>" href="<?php echo $image_src; ?>" rel="<?php echo $rel; ?>" title="<?php echo $slide->title; ?>">
            <?PHP endif; ?>
                <img src="<?php echo $image_src; ?>"
                      alt="<?php echo $slide->title; ?>" />
            <?PHP // End the link if it was started
            if (($imagesbox != "N" && ! $this->get_option('nolinker')) || $slide->uselink == "Y")  { ?></a><?PHP } ?>
            <span class="awesome-caption">
                <h3><?php echo $slide->title; ?></h3>
                <p><?php echo $slide->description; ?></p>
            </span>
        </div>
    <?php endforeach;?>
</div>
<?php endif;
