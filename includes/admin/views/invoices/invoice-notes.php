<?php
/**
 * Shows notes
 * Used in view invoice page.
 *
 * @package EverAccounting\Admin
 * @var Invoice $invoice The item being used
 */

use EverAccounting\Models\Invoice;

defined( 'ABSPATH' ) || exit();

$notes = eaccounting_get_notes(
	array(
		'number'    => - 1,
		'parent_id' => $invoice->get_id(),
		'type'      => 'invoice',
		'orderby'   => 'date_created',
		'order'     => 'DESC',
	)
);
?>
<div id="ea-invoice_notes-body">
	<div class="ea-card__inside">
		<?php if ( empty( $notes ) ) : ?>
			<p class="ea-card__inside"><?php esc_html_e( 'There are no notes yet.', 'wp-ever-accounting' ); ?></p>

		<?php else : ?>
			<ul class="ea-document-notes">
				<?php foreach ( $notes as $note ) : ?>
					<li class="ea-document-notes__item" data-noteid="<?php echo esc_attr( $note->get_id() ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'ea_delete_note' ) ); ?>">
						<div class="ea-document-notes__item-content">
							<?php echo wp_kses_post( $note->get_note() ); ?>
						</div>
						<div class="ea-document-notes__item-meta">
							<abbr class="exact-date" title="<?php echo esc_attr( $note->get_date_created() ); ?>">
								<?php
								echo sprintf(
								/* translators: %s note creator user */
									esc_html__( 'added on %1$s at %2$s', 'wp-ever-accounting' ),
									esc_html( eaccounting_date( $note->get_date_created(), 'F m, Y' ) ),
									esc_html( eaccounting_date( $note->get_date_created(), 'H:i a' ) )
								);
								?>
							</abbr>
							<a href="#" class="delete_note" role="button"><?php esc_html_e( 'Delete note', 'wp-ever-accounting' ); ?></a>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>

	</div>
	<div class="ea-card__footer">
		<form id="invoice-note-form" method="post" class="ea-document-notes__form">
			<p class="form-field">
				<label for="invoice_note"><?php esc_html_e( 'Add note', 'wp-ever-accounting' ); ?></label>
				<textarea type="text" name="note" class="input-text" cols="20" rows="5" autocomplete="off" spellcheck="false" required></textarea>
			</p>

			<button type="submit" class="add_document_note button"><?php esc_html_e( 'Add', 'wp-ever-accounting' ); ?></button>
			<input type="hidden" name="action" value="eaccounting_add_invoice_note">
			<input type="hidden" name="invoice_id" value="<?php echo esc_attr( $invoice->get_id() ); ?>">
			<?php wp_nonce_field( 'ea_add_invoice_note'); ?>
		</form>
	</div>
</div>
