<?php

// =============================================================================
// FUNCTIONS/GLOBAL/PLUGINS/GRAVITY-FORMS.PHP
// -----------------------------------------------------------------------------
// Plugin setup for theme compatibility.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Styles
// =============================================================================

// Styles
// =============================================================================

function x_contact_form_7_enqueue_styles() {
  wp_deregister_style( 'contact-form-7' );
}

add_action( 'x_enqueue_styles', 'x_contact_form_7_enqueue_styles' );
