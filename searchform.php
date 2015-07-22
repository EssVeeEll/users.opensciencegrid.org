<form method="get" class="" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
      <input type="text" placeholder="<?php esc_attr_e('Search...', 'artificial_reason'); ?>" class="field form-control" name="s" id="s">
      <span class="input-group-btn">
        <button id="searchform-btn" class="btn btn-ar btn-primary" type="submit"><i class="fa fa-search"></i></button>
      </span>
    </div><!-- /input-group -->
</form>