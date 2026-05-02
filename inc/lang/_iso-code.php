<?php
/**
 * Add "ISO Code" custom field to the "web-lang" taxonomy
 */

// ── 1. Display field on the Add Term form ────────────────────────────────────
function web_lang_add_iso_code_field() {
    ?>
    <div class="form-field">
        <label for="iso-code"><?php esc_html_e( 'ISO Code', 'wg-blank' ); ?></label>
        <input type="text" name="iso-code" id="iso-code" value="" maxlength="10" />
        <p class="description"><?php esc_html_e( 'Enter the ISO language code (e.g. en_US, pl_PL).', 'wg-blankn' ); ?></p>
    </div>
    <?php
}
add_action( 'web-lang_add_form_fields', 'web_lang_add_iso_code_field' );

function web_lang_edit_iso_code_field( $term ) {
    $iso_code = get_term_meta( $term->term_id, 'iso-code', true );
    ?>
    <tr class="form-field">
        <th scope="row">
            <label for="iso-code"><?php esc_html_e( 'ISO Code', 'wg-blank' ); ?></label>
        </th>
        <td>
            <input type="text" name="iso-code" id="iso-code" value="<?php echo esc_attr( $iso_code ); ?>" maxlength="10" />
            <p class="description"><?php esc_html_e( 'Enter the ISO language code (e.g. en_US, pl_PL).', 'wg-blank' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'web-lang_edit_form_fields', 'web_lang_edit_iso_code_field' );

function web_lang_save_iso_code_field( $term_id ) {
    if ( isset( $_POST['iso-code'] ) ) {
        $iso_code = sanitize_text_field( $_POST['iso-code'] );
        add_term_meta( $term_id, 'iso-code', $iso_code, true );
    }
}
add_action( 'created_web-lang', 'web_lang_save_iso_code_field' );

function web_lang_update_iso_code_field( $term_id ) {
    if ( isset( $_POST['iso-code'] ) ) {
        $iso_code = sanitize_text_field( $_POST['iso-code'] );
        update_term_meta( $term_id, 'iso-code', $iso_code );
    }
}
add_action( 'edited_web-lang', 'web_lang_update_iso_code_field' );

function web_lang_add_iso_code_column( $columns ) {
    $columns['iso_code'] = __( 'ISO Code', 'wg-blank' );
    return $columns;
}
add_filter( 'manage_edit-web-lang_columns', 'web_lang_add_iso_code_column' );


// ── 6. Populate the column with each term's value ────────────────────────────
function web_lang_populate_iso_code_column( $content, $column_name, $term_id ) {
    if ( 'iso_code' === $column_name ) {
        $iso_code = get_term_meta( $term_id, 'iso-code', true );
        $content  = $iso_code ? esc_html( $iso_code ) : '—';
    }
    return $content;
}
add_filter( 'manage_web-lang_custom_column', 'web_lang_populate_iso_code_column', 10, 3 );