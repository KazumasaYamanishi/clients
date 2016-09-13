(function($) {
    var $wp_inline_edit = inlineEditPost.edit;

    inlineEditPost.edit = function( id ) {
        $wp_inline_edit.apply( this, arguments );

        var $post_id = 0;
        if ( typeof( id ) == 'object' )
            $post_id = parseInt( this.getId( id ) );

        if ( $post_id > 0 ) {
            var $edit_row = $( '#edit-' + $post_id );
            var $post_row = $( '#post-' + $post_id );

            //ケース単価
            var $iCase = $( '.column-i-case', $post_row ).html();
            $( ':input[name="i-case"]', $edit_row ).val( $iCase );

            //平米単価
            var $iMeter = $( '.column-i-meter', $post_row ).html();
            $( ':input[name="i-meter"]', $edit_row ).val( $iMeter );

        }
    };

})(jQuery);