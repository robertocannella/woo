<?php
/**
 *  template.
 *
 * @package 'fictional_university'
 */

/**
 * Add a 'Add rel="nofollow" to link' checkbox to the WordPress link editor
 *
 * @see https://danielbachhuber.com/tip/rel-nofollow-link-modal/
 */
add_action( 'after_wp_tiny_mce', function(){
    ?>
    <script>
        var originalWpLink;
        // Ensure both TinyMCE, underscores and wpLink are initialized

        if ( typeof tinymce !== 'undefined' && typeof _ !== 'undefined' && typeof wpLink !== 'undefined' ) {
            // Ensure the #link-options div is present, because it's where we're appending our checkbox.

            if ( tinymce.$('#link-options').length ) {
                // Append our checkbox HTML to the #link-options div, which is already present in the DOM.
                tinymce.$('#link-options').append(
                    <?php
                    echo json_encode(
                            '<div class="link-nofollow"><label><span></span><input type="checkbox" id="wp-link-nofollow" /> Add rel="nofollow" to link</label></div>' .
                                    '<div class="link-add-btn"><label><span></span><input type="checkbox" id="wp-link-add-btn" /> Add button class</label></div>' );
                    ?>);
                // Clone the original wpLink object so we retain access to some functions.
                originalWpLink = _.clone( wpLink );
                wpLink.addRelNofollow = tinymce.$('#wp-link-nofollow');

                // Override the original wpLink object to include our custom functions.
                wpLink = _.extend( wpLink, {
                    /**
                     * Fetch attributes for the generated link based on
                     * the link editor form properties.
                     *
                     * In this case, we're calling the original getAttrs()
                     * function, and then including our own behavior.
                     */
                    getAttrs: function() {
                        var attrs = originalWpLink.getAttrs();
                        attrs.rel = wpLink.addRelNofollow.prop( 'checked' ) ? 'nofollow' : false;
                        return attrs;
                    },
                    /**
                     * Build the link's HTML based on attrs when inserting
                     * into the text editor.
                     *
                     * In this case, we're completely overriding the existing
                     * function.
                     */
                    buildHtml: function( attrs ) {
                        var html = '<a href="' + attrs.href + '"';

                        if ( attrs.target ) {
                            html += ' target="' + attrs.target + '"';
                        }
                        if ( attrs.rel ) {
                            html += ' rel="' + attrs.rel + '"';
                        }
                        return html + '>';
                    },
                    /**
                     * Set the value of our checkbox based on the presence
                     * of the rel='nofollow' link attribute.
                     *
                     * In this case, we're calling the original mceRefresh()
                     * function, then including our own behavior
                     */
                    mceRefresh: function( searchStr, text ) {

                        originalWpLink.mceRefresh( searchStr, text );
                        var editor = window.tinymce.get( window.wpActiveEditor )
                        if ( typeof editor !== 'undefined' && ! editor.isHidden() ) {
                            var linkNode = editor.dom.getParent( editor.selection.getNode(), 'a[href]' );
                            if ( linkNode ) {
                                wpLink.addRelNofollow.prop( 'checked', 'nofollow' === editor.dom.getAttrib( linkNode, 'rel' ) );
                            }
                        }
                    }
                });
            }
        }
    </script>
    <style>
        #wp-link #link-options .link-nofollow {
            padding: 3px 0 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #wp-link #link-options .link-nofollow label span {
            width: 83px;
        }

        .has-text-field #wp-link .query-results {
            top: 223px;
        }
    </style>
    <?php
});