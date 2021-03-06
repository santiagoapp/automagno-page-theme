<?php

// =============================================================================
// FUNCTIONS/GLOBAL/ADMIN/ADDONS/MARKUP/PAGE-HOME-BOX-CUSTOMIZER-MANAGER.PHP
// -----------------------------------------------------------------------------
// Addons home page output.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Page Output
// =============================================================================

// Page Output
// =============================================================================

?>

<div class="tco-column">
  <div class="tco-box tco-box-min-height tco-box-theme-options-manager" data-tco-module="x-theme-options-manager">

    <header class="tco-box-header">
      <?php echo $status_icon_validated; ?>
      <h2 class="tco-box-title"><?php _e( 'Theme Options Manager', '__x__' ); ?></h2>
    </header>

    <div class="tco-box-content tco-pan tco-ta-center">

      <div class="tco-theme-options-action-group">
        <form class="tco-form tco-theme-options-import" method="post" action="" enctype="multipart/form-data" data-tco-module-target="import-form" data-tco-module-processor>
          <div class="tco-theme-options-import-input">
            <?php x_tco()->admin_icon( 'import' ); ?>
            <input type="file" name="files[]" id="tco-theme-options-import-file" data-tco-module-target="import-file"/>
            <label for="tco-theme-options-import-file"><?php _e( '<strong>Choose an XCS file</strong> or drag it here to import.', '__x__' ); ?></label>
          </div>
          <span class="tco-status-text"></span>
        </form>
      </div>

      <div class="tco-form tco-theme-options-action-group">
        <form class="tco-theme-options-export" method="post">
          <button type="submit" name="tco-theme-options-export" data-tco-module-target="export">
            <?php x_tco()->admin_icon( 'export' ); ?>
            <span><?php _e( 'Export', '__x__' ); ?></span>
          </button>
        </form>
        <form class="tco-form tco-theme-options-reset" method="post">
          <button type="submit" name="tco-theme-options-reset" data-tco-module-target="reset">
            <?php x_tco()->admin_icon( 'refresh' ); ?>
            <span><?php _e( 'Reset', '__x__' ); ?></span>
          </button>
        </form>
      </div>

    </div>

  </div>
</div>
