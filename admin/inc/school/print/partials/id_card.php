<?php
defined( 'ABSPATH' ) || die();

// Registration settings.
$settings_registration           = WLSM_M_Setting::get_settings_registration( $school_id );
$settings_registration           = WLSM_M_Setting::get_settings_registration( $id_number );
$school_registration_blood_group = $settings_registration['blood_group'];
?>
<div class="wlsm-print-id-card-container">

	<?php require WLSM_PLUGIN_DIR_PATH . 'admin/inc/school/print/partials/school_header.php'; ?>

	<div class="row wlsm-print-id-card-details mt-1 mobile-id-card">
		<div class="col-8 wlsm-print-id-card-right">
			<ul>
				<li>
					<span class="wlsm-font-bold"><?php esc_html_e( 'Student Name', 'school-management' ); ?>:</span>
					<span><?php echo esc_html( WLSM_M_Staff_Class::get_name_text( $student->student_name ) ); ?></span>
				</li>
				<li>
					<span class="wlsm-font-bold"><?php esc_html_e( 'NRC Number', 'school-management' ); ?>:</span>
					<span><?php echo esc_html( $student->id_number ); ?></span>
				</li>
				<li>
					<span class="wlsm-font-bold"><?php esc_html_e( 'Admission Number', 'school-management' ); ?>:</span>
					<span><?php echo esc_html( $student->admission_number ); ?></span>
				</li>

				<li>
					<span class="pr-3">
						<span class="wlsm-font-bold"><?php esc_html_e( 'Year of Study', 'school-management' ); ?>:</span>
						<span><?php echo esc_html( WLSM_M_Class::get_label_text( $student->class_label ) ); ?></span>
					</span>
					<span class="pl-3">
						<span class="wlsm-font-bold"><?php esc_html_e( 'Programme', 'school-management' ); ?>:</span>
						<span><?php echo esc_html( WLSM_M_Class::get_label_text( $student->section_label ) ); ?></span>
					</span>
				</li>
				<li>
					<span class="pr-3">
						<span class="wlsm-font-bold"><?php esc_html_e( 'Intake', 'school-management' ); ?>:</span>
						<span><?php echo esc_html( WLSM_M_Staff_Class::get_roll_no_text( $student->religion ) ); ?></span>
					</span>
					
					<?php if ( $school_registration_blood_group ) : ?>
						<span class="pl-3">
							<span class="wlsm-font-bold"><?php esc_html_e( 'Sponsorship', 'school-management' ); ?>:</span>
							<span><?php echo esc_html( $student->blood_group ); ?></span>
						</span>
					<?php endif ?>
					
				</li>
				<li>
					<span class="wlsm-font-bold"><?php esc_html_e( 'Mode of Study', 'school-management' ); ?>:</span>
					<span><?php echo esc_html( WLSM_M_Staff_Class::get_name_text( $student->caste ) ); ?></span>
				</li>
				<li>
					<span class="wlsm-font-bold"><?php esc_html_e( 'Term', 'school-management' ); ?>:</span>
					<span><?php echo esc_html( WLSM_M_Staff_Class::get_phone_text( $student->note ) ); ?></span>
				</li>
			</ul>
		</div>

		<div class="col-3 wlsm-print-id-card-left">
			<div class="wlsm-print-id-card-photo-box">
			<?php if ( ! empty( $photo_id ) ) { ?>
				<img src="<?php echo esc_url( wp_get_attachment_url( $photo_id ) ); ?>" class="wlsm-print-id-card-photo">
			<?php } ?>
			</div>
			<div class="wlsm-print-id-card-authorized-by">
				<?php if ( ! empty( $school_signature ) ) { ?>
					<img src="<?php echo esc_url( wp_get_attachment_url( $school_signature ) ); ?>" class="wlsm-print-id-card-signature">
				<?php } ?>
				<span><?php esc_html_e( 'Authorized By', 'school-management' ); ?></span>
			</div>
		</div>
	</div>

</div>
