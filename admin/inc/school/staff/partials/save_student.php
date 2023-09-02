<?php
defined( 'ABSPATH' ) || die();

require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/WLSM_M_Class.php';
require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/staff/WLSM_M_Staff_Class.php';
require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/WLSM_Helper.php';
require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/staff/WLSM_M_Staff_General.php';
require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/staff/WLSM_M_Staff_Transport.php';

$school_id  = $current_school['id'];
$session_id = $current_session['ID'];

$page_url = WLSM_M_Staff_General::get_students_page_url();

$admissions_page_url = WLSM_M_Staff_General::get_admissions_page_url();

// Registration settings.
$settings_registration = WLSM_M_Setting::get_settings_registration( $school_id );
$auto_admission_number = $settings_registration['auto_admission_number'];
$auto_roll_number      = $settings_registration['auto_roll_number'];

$gender_list       = WLSM_Helper::gender_list();
$student_type_list = WLSM_Helper::student_type();

$sponsorship_list = WLSM_Helper::sponsorship_list();
$intake_list = WLSM_Helper::intake_list();
$mode_list = WLSM_Helper::mode_list();
$city_list = WLSM_Helper::city_list();
$province_list = WLSM_Helper::province_list();
$nationality_list = WLSM_Helper::nationality_list();
$term_list = WLSM_Helper::term_list();
$title_list = WLSM_Helper::title_list();
$marital_list = WLSM_Helper::marital_list();
$const_list = WLSM_Helper::const_list();
$relationship_list = WLSM_Helper::relationship_list();

$student = null;

$nonce_action = 'add-admission';
$action       = 'wlsm-add-admission';

$name              = '';
$gender            = '';
$dob               = '';
$religion          = '';
$caste             = '';
$blood_group       = '';
$address           = '';
$city              = '';
$title              = '';
$marital            = '';
$consti             = '';
$state             = '';
$country           = '';
$phone             = '';
$email             = '';
$id_number         = '';
$id_proof          = '';
$nrc          = '';
$parent_id_proof   = '';
$note              = '';
$admission_date    = '';
$class_id          = '';
$class_label       = '';
$section_id        = '';
$admission_number  = '';
$roll_number       = '';
$photo_id          = '';
$father_name       = '';
$father_phone      = '';
$father_occupation = '';
$mother_name       = '';
$mother_phone      = '';
$mother_occupation = '';
$route_vehicle_id  = '';
$username          = '';
$login_email       = '';
$is_active         = 1;
$room_id           = '';
$student_type      = '';
$subject_id      = '';

$sections = array();

$parent_username    = '';
$parent_login_email = '';

$fees = WLSM_M_Staff_Accountant::fetch_fees( $school_id );

// Registration settings.
$settings_registration             = WLSM_M_Setting::get_settings_registration( $school_id );
$school_registration_dob           = $settings_registration['dob'];
$school_registration_religion      = $settings_registration['religion'];
$school_registration_caste         = $settings_registration['caste'];
$school_registration_blood_group   = $settings_registration['blood_group'];
$school_registration_phone         = $settings_registration['phone'];
$school_registration_city          = $settings_registration['city'];
$school_registration_title          = $settings_registration['title'];
$school_registration_marital          = $settings_registration['marital'];
$school_registration_const          = $settings_registration['consti'];
$school_registration_state         = $settings_registration['state'];
$school_registration_country       = $settings_registration['country'];
$school_registration_transport     = $settings_registration['transport'];
$school_registration_parent_detail = $settings_registration['parent_detail'];
$school_registration_parent_login  = $settings_registration['parent_login'];
$school_registration_id_number     = $settings_registration['id_number'];

if ( isset( $_GET['id'] ) && ! empty( $_GET['id'] ) ) {
	$current_user = WLSM_M_Role::can( 'manage_students' );

	$id      = absint( $_GET['id'] );
	$student = WLSM_M_Staff_General::fetch_student( $school_id, $session_id, $id, $restrict_to_section );

	if ( $student ) {
		$nonce_action = 'edit-student-' . $student->ID;
		$action       = 'wlsm-edit-student';

		$name              = $student->student_name;
		$gender            = $student->gender;
		$student_type      = $student->student_type;
		$dob               = $student->dob;
		$religion          = $student->religion;
		$caste             = $student->caste;
		$blood_group       = $student->blood_group;
		$address           = $student->address;
		$city              = $student->city;
		$title            = $student->title;
		$marital            = $student->marital;
		$consti             = $student->consti;
		$state             = $student->state;
		$country           = $student->country;
		$phone             = $student->phone;
		$email             = $student->email;
		$id_number         = $student->id_number;
		$id_proof          = $student->id_proof;
		$nrc          = $student->nrc;
		$parent_id_proof   = $student->parent_id_proof;
		$note              = $student->note;
		$admission_date    = $student->admission_date;
		$class_id          = $student->class_id;
		$class_label       = $student->class_label;
		$section_id        = $student->section_id;
		$admission_number  = $student->admission_number;
		$roll_number       = $student->roll_number;
		$photo_id          = $student->photo_id;
		$father_name       = $student->father_name;
		$father_phone      = $student->father_phone;
		$father_occupation = $student->father_occupation;
		$mother_name       = $student->mother_name;
		$mother_phone      = $student->mother_phone;
		$mother_occupation = $student->mother_occupation;
		$route_vehicle_id  = $student->route_vehicle_id;
		$username          = $student->username;
		$login_email       = $student->login_email;
		$is_active         = $student->is_active;
		$room_id           = $student->room_id;

		$sections = WLSM_M_Staff_Class::fetch_sections( $student->class_school_id );

		$parent_user_id = $student->parent_user_id;
		$classes        = WLSM_M_Staff_Class::fetch_classes( $school_id );

		$parent_user = get_user_by( 'ID', $parent_user_id );
		if ( $parent_user ) {
			$parent_username    = $parent_user->user_login;
			$parent_login_email = $parent_user->user_email;
		}

		$fees = WLSM_M_Staff_Accountant::fetch_student_fees( $school_id, $id );

	}
} else {
	$current_user = WLSM_M_Role::can( 'manage_admissions' );

	$classes = WLSM_M_Staff_Class::fetch_classes( $school_id );

	if ( isset( $_GET['inquiry_id'] ) && ! empty( $_GET['inquiry_id'] ) ) {
		$inquiry_id = absint( $_GET['inquiry_id'] );
		$inquiry    = WLSM_M_Staff_General::fetch_inquiry( $school_id, $inquiry_id );
		if ( $inquiry && $inquiry->is_active ) {
			$name     = $inquiry->name;
			$phone    = $inquiry->phone;
			$email    = $inquiry->email;
			$class_id = $inquiry->class_id;

			$class_school = WLSM_M_Staff_Class::get_class( $school_id, $class_id );
			if ( $class_school ) {
				$sections = WLSM_M_Staff_Class::fetch_sections( $class_school->ID );
			}
		}
	}
}

if ( ! $current_user ) {
	die();
}

$fee_periods = WLSM_Helper::fee_period_list();

$routes_vehicles = WLSM_M_Staff_Transport::fetch_routes_vehicles( $school_id );
$routes          = array();
foreach ( $routes_vehicles as $route_vehicle ) {
	if ( array_key_exists( $route_vehicle->route_id, $routes ) ) {
		array_push(
			$routes[ $route_vehicle->route_id ]['vehicles'],
			array(
				'vehicle_number' => $route_vehicle->vehicle_number,
				'ID'             => $route_vehicle->ID,
			)
		);
	} else {
		$routes[ $route_vehicle->route_id ] = array(
			'route_name' => $route_vehicle->route_name,
			'vehicles'   => array(
				array(
					'vehicle_number' => $route_vehicle->vehicle_number,
					'ID'             => $route_vehicle->ID,
				),
			),
		);
	}
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="mt-3 text-center wlsm-section-heading-block">
			<span class="wlsm-section-heading-box">
				<span class="wlsm-section-heading">
					<?php
					{
						/* translators: %s: session label */
						printf( esc_html__( 'New Admission', 'school-management' ));
					}
					?>
				</span>
			</span>
			<?php if ( $student ) { ?>
				<span class="float-md-right">
					<a href="<?php echo esc_url( $page_url ); ?>" class="btn btn-sm btn-outline-light">
						<i class="fas fa-users"></i>&nbsp;
						<?php esc_html_e( 'View All', 'school-management' ); ?>
					</a>
				</span>
			<?php } elseif ( WLSM_M_Role::check_permission( array( 'manage_students' ), $current_school['permissions'] ) ) { ?>
				<span class="float-md-right">
					<a href="<?php echo esc_url( $admissions_page_url . '&action=bulk_import' ); ?>" class="btn btn-sm btn-outline-light">
						<i class="fas fa-file-import"></i>&nbsp;
						<?php esc_html_e( 'Bulk Admission', 'school-management' ); ?>
					</a>
					<a href="<?php echo esc_url( $page_url ); ?>" class="btn btn-sm btn-outline-light">
						<i class="fas fa-users"></i>&nbsp;
						<?php esc_html_e( 'View Students', 'school-management' ); ?>
					</a>
				</span>
			<?php } ?>
		</div>
		<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="<?php echo esc_attr( $action ); ?>-form">

			<?php $nonce = wp_create_nonce( $nonce_action ); ?>
			<input type="hidden" name="<?php echo esc_attr( $nonce_action ); ?>" value="<?php echo esc_attr( $nonce ); ?>">

			<input type="hidden" name="action" value="<?php echo esc_attr( $action ); ?>">

			<?php
			if ( $student ) {
				?>
				<input type="hidden" name="student_id" value="<?php echo esc_attr( $student->ID ); ?>">
				<?php
			} else {
				if ( isset( $inquiry ) && $inquiry ) {
					?>
					<input type="hidden" name="inquiry_id" value="<?php echo esc_attr( $inquiry->ID ); ?>">
					<?php
				}
			}
			?>

<!-- Personal Detail -->
<div class="wlsm-form-section">
    <div class="row">
	<div class="col-md-12">
		<div class="wlsm-form-sub-heading wlsm-font-bold">
			<?php esc_html_e( 'Personal Detail', 'school-management' ); ?>
		</div>
	</div>

	
		<div class="form-group col-md-4">
			<label for="wlsm_title" class="wlsm-font-bold">
				<span class="wlsm-important">*</span> <?php esc_html_e( 'Title', 'school-management' ); ?>:
			</label>
			<select name="title" class="form-control selectpicker" id="wlsm_title" data-live-search="true">
				<option value=""><?php esc_html_e( 'Select Title', 'school-management' ); ?></option>
				<?php foreach ($title_list as $key => $value) { ?>
					<option value="<?php echo esc_attr($key); ?>" <?php selected($key, $title, true); ?>>
						<?php echo esc_html($value); ?>
					</option>
				<?php } ?>
			</select>
		</div>

		<div class="form-group col-md-4">
			<label for="wlsm_name" class="wlsm-font-bold">
				<span class="wlsm-important">*</span> <?php esc_html_e( 'Student Name', 'school-management' ); ?>:
			</label>
			<input type="text" name="name" class="form-control" id="wlsm_name" placeholder="<?php esc_attr_e( 'Enter Student Name', 'school-management' ); ?>" value="<?php echo esc_attr( stripslashes( $name ) ); ?>">
		</div>



    <div class="form-group col-md-4">
        <label for="wlsm_gender" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e('Gender', 'school-management'); ?>:
        </label>
        <br>
        <select name="gender" class="form-control selectpicker" id="wlsm_gender" data-live-search="true">
            <option value=""><?php esc_html_e( 'Select Gender', 'school-management' ); ?></option>
            <?php foreach ($gender_list as $key => $value) { ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $gender, true); ?>>
                    <?php echo esc_html($value); ?>
                </option>
            <?php } ?>
        </select>
        </div>

    <?php
    function formatDateInputScript(): void {
        ?>
        <script>
            function formatDateInput() {
                const input = document.getElementById("wlsm_date_of_birth");
                input.addEventListener("input", function() {
                    const inputValue = input.value;
                    const formattedValue = formatWithDash(inputValue);
                    input.value = formattedValue;
                });
            }

            function formatWithDash(value) {
                const formattedValue = value.replace(/-/g, '').replace(/^(\d{2})(\d{2})?(\d{4})?/, function(match, day, month, year) {
                    let formattedString = '';
                    if (day) {
                        formattedString += day.slice(0, 2);
                    }
                    if (month) {
                        formattedString += "-" + month.slice(0, 2);
                    }
                    if (year) {
                        formattedString += "-" + year.slice(0, 4);
                    }
                    return formattedString;
                });
                return formattedValue;
            }

            document.addEventListener("DOMContentLoaded", formatDateInput);
        </script>
        <?php
    }
    ?>

    <div class="form-group col-md-4">
        <?php if ($school_registration_dob) : ?>
            <label for="wlsm_date_of_birth" class="wlsm-font-bold">
                <?php esc_html_e('Date of Birth', 'school-management'); ?>:
            </label>
            <input type="text" name="dob" class="form-control" id="wlsm_date_of_birth" placeholder="<?php esc_attr_e('DD-MM-YYYY', 'school-management'); ?>" value="<?php echo esc_attr(WLSM_Config::get_date_text($dob)); ?>">

            <?php formatDateInputScript(); ?>
        <?php endif; ?>
    </div>

        <div class="form-group col-md-4">
        <label for="wlsm_marital" class="wlsm-font-bold">
            <?php esc_html_e( 'Marital Status', 'school-management' ); ?>:
        </label>
        <select name="marital" class="form-control selectpicker" id="wlsm_marital" data-live-search="true">
            <option value=""><?php esc_html_e( 'Select Marital', 'school-management' ); ?></option>
            <?php foreach ($marital_list as $key => $value) { ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $marital, true); ?>>
                    <?php echo esc_html($value); ?>
                </option>
            <?php } ?>
        </select>
    </div>
					
			
					<div class="form-group col-md-4">
						<label for="wlsm_address" class="wlsm-font-bold">
							<?php esc_html_e( 'Physical Address', 'school-management' ); ?>:
						</label>
						<input type="text" name="address" class="form-control" id="wlsm_address" placeholder="<?php esc_attr_e( 'Enter Physical Address', 'school-management' ); ?>" value="<?php echo esc_attr( $address ); ?>">
					</div>

					<?php if ( $school_registration_phone ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_phone" class="wlsm-font-bold">
							<?php esc_html_e( 'Phone', 'school-management' ); ?>:
						</label>
						<input type="text" name="phone" class="form-control" id="wlsm_phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'school-management' ); ?>" value="<?php echo esc_attr( $phone ); ?>">
					</div>
					<?php endif ?>

					<div class="form-group col-md-4">
						<label for="wlsm_email" class="wlsm-font-bold">
							<span class="wlsm-important">* </span><?php esc_html_e( 'Email', 'school-management' ); ?>:
						</label>
						<input type="email" name="email" class="form-control" id="wlsm_email" placeholder="<?php esc_attr_e( 'Enter Email Address', 'school-management' ); ?>" value="<?php echo esc_attr( stripcslashes( $email ) ); ?>">
					</div>

					<?php if ( $school_registration_state ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_state" class="wlsm-font-bold">
							<?php esc_html_e( 'Province', 'school-management' ); ?>:
						</label>
						<select name="state" class="form-control selectpicker" id="wlsm_state" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Province', 'school-management' ); ?></option>
							<?php foreach ( $province_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $state, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					<?php if ( $school_registration_city ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_city" class="wlsm-font-bold">
							<?php esc_html_e( 'District', 'school-management' ); ?>:
						</label>
						<select name="city" class="form-control selectpicker" id="wlsm_city" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select District', 'school-management' ); ?></option>
							<?php foreach ( $city_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $city, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>


				
						<div class="form-group col-md-4">
						<label for="wlsm_consti" class="wlsm-font-bold">
							<?php esc_html_e( 'Constituency', 'school-management' ); ?>:
						</label>
						<select name="consti" class="form-control selectpicker" id="wlsm_consti" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Constituency', 'school-management' ); ?></option>
							<?php foreach ( $const_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $consti, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					
					
					<?php if ( $school_registration_country ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_country" class="wlsm-font-bold">
							<?php esc_html_e( 'Nationality', 'school-management' ); ?>:
						</label>
						<select name="country" class="form-control selectpicker" id="wlsm_country" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Nationality', 'school-management' ); ?></option>
							<?php foreach ( $nationality_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $country, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>

			<?php

            function formatIDNumberAndUploadScript(): void {
                ?>
                <script>
                    function formatIDNumberInput() {
                        var idNumberInput = document.getElementById('wlsm_id_number');
                        idNumberInput.addEventListener('input', function() {
                            var input = this.value.replace(/\D/g, ''); // Remove non-numeric characters
            
                            // Add slashes to the input as per format XXXXXX/XX/X
                            var formattedInput = '';
                            for (var i = 0; i < input.length; i++) {
                                if (i === 6 || i === 8) {
                                    formattedInput += '/';
                                }
                                formattedInput += input[i];
                            }
            
                            // Update the input value
                            this.value = formattedInput;
                        });
                    }
            
                    document.addEventListener('DOMContentLoaded', formatIDNumberInput);
                </script>
                <?php
            }
            
            ?>
            

                <?php if ($school_registration_id_number) : ?>
                    <div class="form-group col-md-4">
                        <label for="wlsm_id_number" class="wlsm-font-bold">
                            <?php esc_html_e('NRC Number', 'school-management'); ?>:
                        </label>
                        <input type="text" name="id_number" class="form-control" id="wlsm_id_number" placeholder="<?php esc_attr_e('Enter NRC Number', 'school-management'); ?>" value="<?php echo esc_attr(stripcslashes($id_number)); ?>">
                    </div>
                <?php endif; ?>
            
                <div class="form-group col-md-4">
                    <div class="wlsm-id-proof-box">
                        <label for="wlsm_id_proof" class="wlsm-font-bold">
                            <?php esc_html_e('Upload School Results', 'school-management'); ?>:
                        </label>
            
                        <?php if (!empty($id_proof)) { ?>
                            <br>
                            <a target="_blank" href="<?php echo esc_url(wp_get_attachment_url($id_proof)); ?>" class="text-primary wlsm-font-bold wlsm-id_proof"><?php esc_html_e('Download School Results', 'school-management'); ?></a>
                        <?php } ?>
            
                        <div class="custom-file mb-3">
                            <input type="file" class="custom-file-input" id="wlsm_id_proof" name="id_proof">
                            <label class="custom-file-label" for="wlsm_id_proof">
                                <?php esc_html_e('Choose File', 'school-management'); ?>
                            </label>
                        </div>
                    </div>
                </div>
           
            
            	<div class="form-group col-md-4">
    <div class="wlsm-nrc-box">
        <label for="wlsm_nrc" class="wlsm-font-bold">
            <?php esc_html_e( 'Upload NRC', 'school-management' ); ?>:
        </label>
        <?php if ( ! empty( $nrc ) ) { ?>
            <br>
            <a target="_blank" href="<?php echo esc_url( wp_get_attachment_url( $nrc ) ); ?>" class="text-primary wlsm-font-bold wlsm-nrc"><?php esc_html_e( 'Download NRC', 'school-management' ); ?></a>
        <?php } ?>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="wlsm_nrc" name="nrc">
            <label class="custom-file-label" for="wlsm_nrc">
                <?php esc_html_e( 'Choose File', 'school-management' ); ?>
            </label>
            </div>
            </div>
            </div>
            </div>
            </div>




<!-- Admission Detail -->
<div class="wlsm-form-section">
<div class="row">
    <div class="col-md-12">
        <div class="wlsm-form-sub-heading wlsm-font-bold">
            <?php esc_html_e( 'Admission Detail', 'school-management' ); ?>
        </div>
        <?php if ( $student ) { ?>
            <h6 class="text-center text-danger"> <strong> <?php esc_html_e( 'Note: Make sure to manually generate invoice according to that class as well.', 'school-management' ); ?></strong></h6>
        <?php } ?>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label for="wlsm_admission_date" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e( 'Admission Date', 'school-management' ); ?>:
        </label>
        <input type="text" name="admission_date" class="form-control" id="wlsm_admission_date" placeholder="<?php esc_attr_e( 'Enter admission date', 'school-management' ); ?>" value="<?php echo esc_attr( WLSM_Config::get_date_text( $admission_date ) ); ?>">
    </div>

    <div class="form-group col-md-4">
        <label for="wlsm_class" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e( 'Year of Study', 'school-management' ); ?>:
        </label>
        
            <select name="class_id" class="form-control selectpicker" data-nonce="<?php echo esc_attr( wp_create_nonce( 'get-class-sections' ) ); ?>" id="wlsm_class" data-live-search="true">
                <option value=""><?php esc_html_e( 'Select Year of Study', 'school-management' ); ?></option>
                <?php foreach ( $classes as $class ) { ?>
                    <option value="<?php echo esc_attr( $class->ID ); ?>" <?php selected( $class->ID, $class_id, true ); ?>>
                        <?php echo esc_html( WLSM_M_Class::get_label_text( $class->label ) ); ?>
                    </option>
                <?php } ?>
            </select>
        
    </div>

    <div class="form-group col-md-4">
        <label for="wlsm_section" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e( 'Programme', 'school-management' ); ?>:
        </label>
        <select name="section_id" class="form-control selectpicker" id="wlsm_section" data-live-search="true" title="<?php esc_attr_e( 'Select Programme', 'school-management' ); ?>">
            <?php foreach ( $sections as $section ) { ?>
                <option value="<?php echo esc_attr( $section->ID ); ?>" <?php selected( $section->ID, $section_id, true ); ?>>
                    <?php echo esc_html( WLSM_M_Staff_Class::get_section_label_text( $section->label ) ); ?>
                </option>
            <?php } ?>
        </select>
    </div>
</div>

	<div class="form-row">
	    <?php if ( $school_registration_caste ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_caste" class="wlsm-font-bold">
							<?php esc_html_e( 'Mode of Study', 'school-management' ); ?>:
						</label>
						<select name="caste" class="form-control selectpicker" id="wlsm_caste" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Mode of Study', 'school-management' ); ?></option>
							<?php foreach ( $mode_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $caste, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					<?php if ( $school_registration_religion ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_religion" class="wlsm-font-bold">
							<?php esc_html_e( 'Intake', 'school-management' ); ?>:
						</label>
						<select name="religion" class="form-control selectpicker" id="wlsm_religion" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Intake', 'school-management' ); ?></option>
							<?php foreach ( $intake_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $religion, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					
					<?php if ( $school_registration_blood_group ) : ?>
						<div class="form-group col-md-4">
						<label for="wlsm_blood_group" class="wlsm-font-bold">
							<?php esc_html_e( 'Sponsorship', 'school-management' ); ?>:
						</label>
						<select name="blood_group" class="form-control selectpicker" id="wlsm_blood_group" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Sponsorship', 'school-management' ); ?></option>
							<?php foreach ( $sponsorship_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $blood_group, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					
				</div>



				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="wlsm_admission_number" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Admission Number', 'school-management' ); ?>:
							<?php if ( $auto_admission_number ) { ?> <small class="text-dark"><?php esc_html_e( '(Auto Generated)', 'school-management' ); ?></small> <?php } ?>
						</label>
						<input <?php if ( $auto_admission_number ) { echo 'readonly'; } ?> type="text" name="admission_number" class="form-control" id="wlsm_admission_number" placeholder=" <?php if ( $auto_admission_number ) { esc_attr_e( '---- Auto Generated ----', 'school-management' ); } else { esc_attr_e( 'Enter admission number', 'school-management' ); } ?> " value="<?php echo esc_attr( $admission_number ); ?>">
					</div>

					<div class="form-group col-md-4">
						<label for="wlsm_roll_number" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Roll Number', 'school-management' ); ?>:
							<?php if ( $auto_roll_number ) { ?>
								<small class="text-dark"><?php esc_html_e( '(Auto Generated)', 'school-management' ); ?></small>
							<?php } ?>
						</label>
						<input type="text" name="name" class="form-control" id="wlsm_name" placeholder="<?php esc_attr_e( 'Enter student name', 'school-management' ); ?>" value="<?php echo esc_attr( stripcslashes( $name ) ); ?>">
					</div>
					<div class="form-group col-md-4">
    <label for="wlsm_note" class="wlsm-font-bold">
        <?php esc_html_e( 'Term', 'school-management' ); ?>:
    </label>
    <select name="note" class="form-control selectpicker" id="wlsm_note" data-live-search="true">
        <option value=""><?php esc_html_e( 'Select Term', 'school-management' ); ?></option>
        <?php foreach ( $term_list as $key => $value ) { ?>
            <option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $note, true ); ?>>
                <?php echo esc_html( $value ); ?>
            </option>
        <?php } ?>
    </select>
</div>
</div>

					<div class="form-row">
					               <div class="form-group col-md-4">
	<label for="wlsm_student_type" class="wlsm-font-bold">
		<?php esc_html_e( 'Student Type', 'school-management' ); ?>:
	</label>
	<select name="student_type" class="form-control selectpicker" id="wlsm_student_type" data-live-search="true">
		<option value=""><?php esc_html_e( 'Select Student Type', 'school-management' ); ?></option>
		<?php foreach ( $student_type_list as $key => $value ) { ?>
			<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $student_type, true ); ?>>
				<?php echo esc_html( $value ); ?>
			</option>
		<?php } ?>
	</select>
	</div>
			
	<div class="form-group col-md-4">
	<div class="wlsm-photo-box">
		<div class="wlsm-photo-section">
			<label for="wlsm_photo" class="wlsm-font-bold">
				<?php esc_html_e('Upload Passport Size Photo', 'school-management'); ?>:
			</label>
			<?php if (!empty($photo_id)) { ?>
				<img src="<?php echo esc_url(wp_get_attachment_url($photo_id)); ?>" class="img-responsive wlsm-photo">
				<a href="<?php echo esc_url(wp_get_attachment_url($photo_id)); ?>" download><?php esc_html_e('Download', 'school-management'); ?></a>
			<?php } ?>
			<div class="custom-file mb-3">
				<input type="file" class="custom-file-input" id="wlsm_photo" name="photo">
				<label class="custom-file-label" for="wlsm_photo">
					<?php esc_html_e('Choose File', 'school-management'); ?>
				</label>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
                
     


			<!-- Parent Detail -->
<?php if ($school_registration_parent_detail) : ?>
	<div class="wlsm-form-section">
		<div class="row">
			<div class="col-md-12">
				<div class="wlsm-form-sub-heading wlsm-font-bold">
					<?php esc_html_e('Guardian Detail', 'school-management'); ?>
				</div>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="wlsm_father_name" class="wlsm-font-bold">
					<?php esc_html_e('Guardian\'s Name', 'school-management'); ?>:
				</label>
				<input type="text" name="father_name" class="form-control" id="wlsm_father_name" placeholder="<?php esc_attr_e('Enter Guardian\'s Name', 'school-management'); ?>" value="<?php echo esc_attr(stripcslashes($father_name)); ?>">
			</div>
			<div class="form-group col-md-4">
				<label for="wlsm_father_phone" class="wlsm-font-bold">
					<?php esc_html_e('Guardian\'s Phone', 'school-management'); ?>:
				</label>
				<input type="text" name="father_phone" class="form-control" id="wlsm_father_phone" placeholder="<?php esc_attr_e('Enter Guardian\'s Phone Number', 'school-management'); ?>" value="<?php echo esc_attr($father_phone); ?>">
			</div>
			<div class="form-group col-md-4">
				<label for="wlsm_father_occupation" class="wlsm-font-bold">
					<?php esc_html_e('Guardian\'s Occupation', 'school-management'); ?>:
				</label>
				<input type="text" name="father_occupation" class="form-control" id="wlsm_father_occupation" placeholder="<?php esc_attr_e('Enter Guardian\'s Occupation', 'school-management'); ?>" value="<?php echo esc_attr($father_occupation); ?>">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="wlsm_mother_name" class="wlsm-font-bold">
					<?php esc_html_e('Guardian\'s Physical Address', 'school-management'); ?>:
				</label>
				<input type="text" name="mother_name" class="form-control" id="wlsm_mother_name" placeholder="<?php esc_attr_e('Enter Guardian\'s Physical Address', 'school-management'); ?>" value="<?php echo esc_attr(stripcslashes($mother_name)); ?>">
			</div>
			<div class="form-group col-md-4">
				<label for="wlsm_mother_phone" class="wlsm-font-bold">
					<?php esc_html_e('Guardian\'s Workplace Address', 'school-management'); ?>:
				</label>
				<input type="text" name="mother_phone" class="form-control" id="wlsm_mother_phone" placeholder="<?php esc_attr_e('Enter Guardian\'s Workplace Address', 'school-management'); ?>" value="<?php echo esc_attr($mother_phone); ?>">
			</div>
					<div class="form-group col-md-4">
						<label for="wlsm_mother_occupation" class="wlsm-font-bold">
							<?php esc_html_e( 'Relationship with Student', 'school-management' ); ?>:
						</label>
						<select name="mother_occupation" class="form-control selectpicker" id="wlsm_mother_occupation" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Relationship', 'school-management' ); ?></option>
							<?php foreach ( $relationship_list as $key => $value ) { ?>
								<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $mother_occupation, true ); ?>>
									<?php echo esc_html( $value ); ?>
								</option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<div class="wlsm-parent-id-proof-box">
							<div class="wlsm-parent-id-proof-section">
								<label for="wlsm_parent_id_proof" class="wlsm-font-bold">
									<?php esc_html_e( 'Upload Guardian\'s NRC', 'school-management' ); ?>:
								</label>
								<?php if ( ! empty( $parent_id_proof ) ) { ?>
									<br>
									<a target="_blank" href="<?php echo esc_url( wp_get_attachment_url( $parent_id_proof ) ); ?>" class="text-primary wlsm-font-bold wlsm-parent-id-proof"><?php esc_html_e( 'Download Guardian\'s NRC', 'school-management' ); ?></a>
								<?php } ?>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="wlsm_parent_id_proof" name="parent_id_proof">
									<label class="custom-file-label" for="wlsm_parent_id_proof">
										<?php esc_html_e( 'Choose File', 'school-management' ); ?>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif ?>

			<!-- Student Login Detail -->
			<div class="wlsm-form-section">
				<div class="row">
					<div class="col-md-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Login Detail', 'school-management' ); ?>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<div class="form-check form-check-inline">
							<input <?php checked( false, (bool) $username, true ); ?> class="form-check-input" type="radio" name="student_new_or_existing" id="wlsm_student_disallow_login" value="">
							<label class="ml-1 form-check-label text-secondary font-weight-bold" for="wlsm_student_disallow_login">
								<?php esc_html_e( 'Disallow Login?', 'school-management' ); ?>
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input <?php checked( true, (bool) $username, true ); ?> class="form-check-input" type="radio" name="student_new_or_existing" id="wlsm_student_existing_user" value="existing_user">
							<label class="ml-1 form-check-label text-primary font-weight-bold" for="wlsm_student_existing_user">
								<?php esc_html_e( 'Existing User?', 'school-management' ); ?>
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="student_new_or_existing" id="wlsm_student_new_user" value="new_user">
							<label class="ml-1 form-check-label text-danger font-weight-bold" for="wlsm_student_new_user">
								<?php esc_html_e( 'New User?', 'school-management' ); ?>
							</label>
						</div>
					</div>
				</div>

				<div class="form-row wlsm-student-existing-user">
					<div class="form-group col-md-4">
						<label for="wlsm_existing_username" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Existing Username', 'school-management' ); ?>:
							<?php if ( $username ) { ?>
								<small>
									<em class="text-secondary">
										<?php esc_html_e( 'Usernames cannot be changed.', 'school-management' ); ?>
									</em>
								</small>
							<?php } ?>
						</label>
						<input type="text" name="existing_username" class="form-control" id="wlsm_existing_username" placeholder="<?php esc_attr_e( 'Enter existing username', 'school-management' ); ?>" value="<?php echo esc_attr( $username ); ?>" <?php if ( $username ) { echo 'readonly'; } ?> >
					</div>

					<?php if ( $username ) { ?>

						<div class="form-group col-md-4">
							<label for="wlsm_new_login_password" class="wlsm-font-bold">
								<?php esc_html_e( 'Password', 'school-management' ); ?>:
							</label>
							<input type="password" name="new_password" class="form-control" id="wlsm_new_login_password" placeholder="<?php esc_attr_e( 'Enter password', 'school-management' ); ?>">
						</div>
					<?php } ?>
				</div>

				<div class="form-row wlsm-student-new-user">
					<div class="form-group col-md-4">
						<label for="wlsm_username" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Username', 'school-management' ); ?>:
						</label>
						<input type="text" name="username" class="form-control" id="wlsm_username" placeholder="<?php esc_attr_e( 'Enter username', 'school-management' ); ?>">
					</div>

				

					<div class="form-group col-md-4">
						<label for="wlsm_login_password" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Password', 'school-management' ); ?>:
						</label>
						<input type="password" name="password" class="form-control" id="wlsm_login_password" placeholder="<?php esc_attr_e( 'Enter password', 'school-management' ); ?>">
					</div>
				</div>
			</div>


				<!-- hostel Detail -->
				<div class="wlsm-form-section">
				<div class="row">
					<div class="col-md-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Hostel Detail', 'school-management' ); ?>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="wlsm_room" class="wlsm-font-bold">
							<?php esc_html_e( 'Hostel Room No.', 'school-management' ); ?>:
						</label>
						<select name="room_id" class="form-control selectpicker" id="wlsm_room" data-live-search="true" title="<?php esc_attr_e( 'Select', 'school-management' ); ?>">
							<option value=""><?php esc_html_e( 'Select', 'school-management' ); ?></option>
									<?php
									$rooms = WLSM_M_Staff_Transport::fetch_hostel_rooms();
									foreach ( $rooms as $room ) {
										?>
										<option <?php selected( $room_id, $room->ID, true ); ?> value="<?php echo esc_attr( $room->ID ); ?>">
											<?php echo esc_html( $room->room_name ); ?>
										</option>
									<?php } ?>
						</select>
					</div>
				</div>
			</div>


			<!-- Status -->
			<div class="wlsm-form-section">
				<div class="row">
					<div class="col-md-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Status', 'school-management' ); ?>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<div class="form-check form-check-inline">
							<input <?php checked( 1, $is_active, true ); ?> class="form-check-input" type="radio" name="is_active" id="wlsm_status_active" value="1">
							<label class="ml-1 form-check-label text-primary font-weight-bold" for="wlsm_status_active">
								<?php echo esc_html( WLSM_M_Staff_Class::get_active_text() ); ?>
							</label>
						</div>
						<div class="form-check form-check-inline">
							<input <?php checked( 0, $is_active, true ); ?> class="form-check-input" type="radio" name="is_active" id="wlsm_status_inactive" value="0">
							<label class="ml-1 form-check-label text-danger font-weight-bold" for="wlsm_status_inactive">
								<?php echo esc_html( WLSM_M_Staff_Class::get_inactive_text() ); ?>
							</label>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-2">
				<div class="col-md-12 text-center">
					<button type="submit" class="btn btn-primary" id="<?php echo esc_attr( $action ); ?>-btn">
						<?php
						if ( $student ) {
							?>
							<i class="fas fa-save"></i>&nbsp;
							<?php
							esc_html_e( 'Update Student', 'school-management' );
						} else {
							?>
							<i class="fas fa-plus-square"></i>&nbsp;
							<?php
							esc_html_e( 'Submit', 'school-management' );
						}
						?>
					</button>
				</div>
			</div>

		</form>
	</div>
</div>
