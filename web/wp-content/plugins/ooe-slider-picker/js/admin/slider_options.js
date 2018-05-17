jQuery( function ( $ ) {
    $( 'input[name="osp_settings[osp_radio_field_0]"]' ).change( function() {
        if ( $( 'input[name="osp_settings[osp_radio_field_0]"]:checked' ).val() === 'version1' ) {
            $( '.dependent-slider-v1' ).show();
            $( '.dependent-slider-v1' ).closest( 'tr' ).show();
        } else {
            $( '.dependent-slider-v1' ).hide();
            $( '.dependent-slider-v1' ).closest( 'tr' ).hide();
        }
    } ).trigger( 'change' );

    $( 'input[name="osp_settings[osp_show_cta]"]' ).change( function () {
        if ( $( this ).is( ":checked" ) ) {
            $( '.dependent-show-cta' ).show();
            $( '.dependent-show-cta' ).closest( 'tr' ).show();
        } else {
            $( '.dependent-show-cta' ).hide();
            $( '.dependent-show-cta' ).closest( 'tr' ).hide();
        }
    } ).trigger( 'change' );

    $( 'input[name="osp_settings[osp_order_by]"]' ).click( function () {

        // Show / hide the sort direction section
        if ( $( this ).val() !== 'rand' ) {

            // Show / hide the notice that tells the user which field is used for sorting
            if ( $( this ).val() === 'meta_value_num' ) {
                $( '.dependent-meta-value-num' ).show();
            } else {
                $( '.dependent-meta-value-num' ).hide();
            }

            $( '.dependent-order-by' ).closest( 'tr' ).show();

        } else {
            $( '.dependent-order-by' ).closest( 'tr' ).hide();
        }
    } );
    
    // Fire the above logic on page load
    $( 'input[name="osp_settings[osp_order_by]"]:checked' ).trigger( 'click' );

    // Show / hide all slide options depending on whether or not this post is featured
    $( '#feature_in_slider' ).change( function () {
        if ( $( this ).is( ':checked' ) ) {
            $( '.dependent-slider-option' ).show();
        } else {
            $( '.dependent-slider-option' ).hide();
        }
    } ).trigger( 'change' );
} );
