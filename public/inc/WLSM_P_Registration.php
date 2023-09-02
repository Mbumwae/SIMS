<?php
defined( 'ABSPATH' ) || die();

require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/WLSM_M_Class.php';
require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/staff/WLSM_M_Staff_General.php';

class WLSM_P_Registration {
	public static function submit_registration() {
		if ( ! wp_verify_nonce( $_POST['wlsm-submit-registration'], 'wlsm-submit-registration' ) ) {
			die();
		}

		try {
			ob_start();
			global $wpdb;

			$gdpr_enable = get_option( 'wlsm_gdpr_enable' );

			$school_id = isset( $_POST['school_id'] ) ? absint( $_POST['school_id'] ) : 0;

			// Personal Detail.
			$name            = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
			$title            = isset( $_POST['title'] ) ? sanitize_text_field( $_POST['title'] ) : '';
			$marital            = isset( $_POST['marital'] ) ? sanitize_text_field( $_POST['marital'] ) : '';
			$consti            = isset( $_POST['consti'] ) ? sanitize_text_field( $_POST['consti'] ) : '';
			$gender          = isset( $_POST['gender'] ) ? sanitize_text_field( $_POST['gender'] ) : '';
			$survey          = isset( $_POST['survey'] ) ? sanitize_text_field( $_POST['survey'] ) : '';
			$dob             = isset( $_POST['dob'] ) ? DateTime::createFromFormat( WLSM_Config::date_format(), sanitize_text_field( $_POST['dob'] ) ) : null;
			$address         = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
			$city            = isset( $_POST['city'] ) ? sanitize_text_field( $_POST['city'] ) : '';
			$state           = isset( $_POST['state'] ) ? sanitize_text_field( $_POST['state'] ) : '';
			$country         = isset( $_POST['country'] ) ? sanitize_text_field( $_POST['country'] ) : '';
			$email           = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
			$phone           = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
			$religion        = isset( $_POST['religion'] ) ? sanitize_text_field( $_POST['religion'] ) : '';
			$caste           = isset( $_POST['caste'] ) ? sanitize_text_field( $_POST['caste'] ) : '';
			$blood_group     = isset( $_POST['blood_group'] ) ? sanitize_text_field( $_POST['blood_group'] ) : '';
			$id_number       = isset( $_POST['id_number'] ) ? sanitize_text_field( $_POST['id_number'] ) : '';
			$id_proof        = ( isset( $_FILES['id_proof'] ) && is_array( $_FILES['id_proof'] ) ) ? $_FILES['id_proof'] : null;
			$nrc        = ( isset( $_FILES['nrc'] ) && is_array( $_FILES['nrc'] ) ) ? $_FILES['nrc'] : null;
			$parent_id_proof = ( isset( $_FILES['parent_id_proof'] ) && is_array( $_FILES['parent_id_proof'] ) ) ? $_FILES['parent_id_proof'] : null;

			// Admission Detail.
			$class_id   = isset( $_POST['class_id'] ) ? absint( $_POST['class_id'] ) : 0;
			$section_id = isset( $_POST['section_id'] ) ? absint( $_POST['section_id'] ) : 0;
			$photo      = ( isset( $_FILES['photo'] ) && is_array( $_FILES['photo'] ) ) ? $_FILES['photo'] : null;

			// Parent Detail.
			$father_name       = isset( $_POST['father_name'] ) ? sanitize_text_field( $_POST['father_name'] ) : '';
			$father_phone      = isset( $_POST['father_phone'] ) ? sanitize_text_field( $_POST['father_phone'] ) : '';
			$father_occupation = isset( $_POST['father_occupation'] ) ? sanitize_text_field( $_POST['father_occupation'] ) : '';
			$mother_name       = isset( $_POST['mother_name'] ) ? sanitize_text_field( $_POST['mother_name'] ) : '';
			$mother_phone      = isset( $_POST['mother_phone'] ) ? sanitize_text_field( $_POST['mother_phone'] ) : '';
			$mother_occupation = isset( $_POST['mother_occupation'] ) ? sanitize_text_field( $_POST['mother_occupation'] ) : '';


			// Transport Detail.
			$route_vehicle_id = isset( $_POST['route_vehicle_id'] ) ? absint( $_POST['route_vehicle_id'] ) : 0;

			// Start validation.
        $errors = array();
        
        // Get the session ID chosen by the applicant (assuming it comes from a form submission).
        $session_id = isset($_POST['session_id']) ? absint($_POST['session_id']) : 0;
        
        // Check if the chosen session exists.
        $session = WLSM_M_Session::get_session($session_id);
        if (!$session) {
            $errors[] = esc_html__('Invalid Academic Year chosen. Please select a valid Academic Year.', 'school-management');
        }
        
        // If no validation errors, process the application.
        if (empty($errors)) {
            // Process the application with the chosen session.
            // ...
        
            // Redirect or display a success message.
            // ...
        } else {
            // Display the validation errors to the user.
            foreach ($errors as $error) {
                echo '<p>' . esc_html($error) . '</p>';
            }
        
            // Display the form again with the submitted values.
            // ...
        }

			$session_id = $session->ID;

			// Personal Detail.
			if ( empty( $name ) ) {
				$errors['name'] = esc_html__( 'Please Enter Student Name.', 'school-management' );
			}
			if ( empty( $title ) ) {
				$errors['title'] = esc_html__( 'Please select Title.', 'school-management' );
			}
			if ( empty( $marital ) ) {
				$errors['marital'] = esc_html__( 'Please select Marital Status.', 'school-management' );
			}
			if ( empty( $consti ) ) {
				$errors['consti'] = esc_html__( 'Please select Constituency.', 'school-management' );
			}
			if ( strlen( $name ) > 60 ) {
				$errors['name'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if (empty($religion)) {
				$errors['religion'] = esc_html__('Please select Intake.', 'school-management');
			}
			if ( ! empty( $religion ) && strlen( $religion ) > 40 ) {
				$errors['religion'] = esc_html__( 'Maximum length cannot exceed 40 characters.', 'school-management' );
			}
			if (empty($id_number)) {
				$errors['id_number'] = esc_html__('Please Enter NRC Number.', 'school-management');
			}
			if (empty($caste)) {
				$errors['caste'] = esc_html__('Please select Mode of Study.', 'school-management');
			}
			if ( ! empty( $caste ) && strlen( $caste ) > 40 ) {
				$errors['caste'] = esc_html__( 'Maximum length cannot exceed 40 characters.', 'school-management' );
			}
			if (empty($phone)) {
				$errors['phone'] = esc_html__('Please Enter Phone Number.', 'school-management');
			}
			if ( ! empty( $id_number ) && strlen( $id_number ) > 11 ) {
				$errors['id_number'] = esc_html__( 'Please provide a valid NRC Number.', 'school-management' );
			}
			if ( ! empty( $phone ) && strlen( $phone ) > 10 ) {
				$errors['phone'] = esc_html__( 'Maximum length cannot exceed 10 characters.', 'school-management' );
			}
			if (empty($email)) {
				$errors['email'] = esc_html__('Please Enter Email.', 'school-management');
			}
			
			
			if ( ! empty( $email ) ) {
				if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
					$errors['email'] = esc_html__( 'Please provide a valid email.', 'school-management' );
				} elseif ( strlen( $email ) > 60 ) {
					$errors['email'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
				}
			}
			
			if (empty($address)) {
				$errors['address'] = esc_html__('Please Enter Physical Address.', 'school-management');
			}
			if (empty($city)) {
				$errors['city'] = esc_html__('Please select District.', 'school-management');
			}
			if ( ! empty( $city ) && strlen( $city ) > 60 ) {
				$errors['city'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if (empty($state)) {
				$errors['state'] = esc_html__('Please select Province.', 'school-management');
			}
			if ( ! empty( $state ) && strlen( $state ) > 60 ) {
				$errors['state'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if (empty($country)) {
				$errors['country'] = esc_html__('Please select Nationality.', 'school-management');
			}
			if ( ! empty( $country ) && strlen( $country ) > 60 ) {
				$errors['country'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if ( ! in_array( $gender, array_keys( WLSM_Helper::gender_list() ) ) ) {
				throw new Exception( esc_html__( 'Please select Gender.', 'school-management' ) );
			}
			if (empty($blood_group)) {
				$errors['blood_group'] = esc_html__('Please select Sponsorship.', 'school-management');
			}
			if ( ! empty( $blood_group ) && ! in_array( $blood_group, array_keys( WLSM_Helper::sponsorship_list() ) ) ) {
				throw new Exception( esc_html__( 'Please specify blood group.', 'school-management' ) );
			}
			if (empty($dob)) {
				$errors['dob'] = esc_html__('Please Enter Date of Birth (DD-MM-YYYY).', 'school-management');
			}
			if ( ! empty( $dob ) ) {
				$dob = $dob->format( 'Y-m-d' );
			} else {
				$dob = null;
			}

			// Admission Detail.
			if ( empty( $school_id ) ) {
				$errors['school_id'] = esc_html__( 'Please select a school.', 'school-management' );
				wp_send_json_error( $errors );
			} else {
				if ( empty( $class_id ) ) {
					$errors['class_id'] = esc_html__( 'Please select Year of Study.', 'school-management' );
					wp_send_json_error( $errors );
				} else {
					// Checks if class exists in the school.
					$class_school = WLSM_M_Staff_Class::fetch_class( $school_id, $class_id );
					if ( ! $class_school ) {
						$errors['class_id'] = esc_html__( 'Year of Study not found.', 'school-management' );
						wp_send_json_error( $errors );
					} else {
						$class_school_id = $class_school->ID;
						$class_label     = $class_school->label;
					}
				}
			}

			$admission_date = current_time( 'Y-m-d' );

			if ( empty( $section_id ) ) {
				$errors['section_id'] = esc_html__( 'Please select Programme.', 'school-management' );
				wp_send_json_error( $errors );
			}
			if (empty($photo)) {
				$errors['photo'] = esc_html__('Please Upload Passport Size Photo.', 'school-management');
				
			}elseif ( isset( $photo['tmp_name'] ) && ! empty( $photo['tmp_name'] ) ) {
			     if ( $photo['size'] > 2 * 1024 * 1024 ) { // Maximum file size is 2 MB
			    $errors['photo'] = esc_html__( 'File size exceeds the maximum limit of 2 MB.', 'school-management' );
			    
				} elseif ( ! WLSM_Helper::is_valid_file( $photo, 'image' ) ) {
					$errors['photo'] = esc_html__( 'Please provide photo in JPG, JPEG or PNG format.', 'school-management' );
				}
			}
			if (empty($id_proof)) {
			    $errors['id_proof'] = esc_html__('Please Upload School Results.', 'school-management');
			    
			} elseif ( isset( $id_proof['tmp_name'] ) && ! empty( $id_proof['tmp_name'] ) ) {
			    if ( $id_proof['size'] > 2 * 1024 * 1024 ) { // Maximum file size is 2 MB
			    $errors['id_proof'] = esc_html__( 'File size exceeds the maximum limit of 2 MB.', 'school-management' );
			        
			    } elseif ( ! WLSM_Helper::is_valid_file( $id_proof, 'attachment' ) ) {
			        $errors['id_proof'] = esc_html__( 'File type is not supported.', 'school-management' );
			        
			    }
			}
			
			if (empty($nrc)) {
			    $errors['nrc'] = esc_html__('Please Upload NRC.', 'school-management');
			    
			} elseif ( isset( $nrc['tmp_name'] ) && ! empty( $nrc['tmp_name'] ) ) {
			    if ( $nrc['size'] > 2 * 1024 * 1024 ) { // Maximum file size is 2 MB
			    $errors['nrc'] = esc_html__( 'File size exceeds the maximum limit of 2 MB.', 'school-management' );
			        
			    } elseif ( ! WLSM_Helper::is_valid_file( $nrc, 'attachment' ) ) {
			        $errors['nrc'] = esc_html__( 'File type is not supported.', 'school-management' );
			        
			    }
			}

			if (empty($parent_id_proof)) {
				$errors['parent_id_proof'] = esc_html__('Please Upload Guardian\'s NRC.', 'school-management');
			    
			} elseif ( isset( $parent_id_proof['tmp_name'] ) && ! empty( $parent_id_proof['tmp_name'] ) ) {
			    if ( $parent_id_proof['size'] > 2 * 1024 * 1024 ) { // Maximum file size is 2 MB
			     $errors['parent_id_proof'] = esc_html__( 'File size exceeds the maximum limit of 2 MB.', 'school-management' );
			     
			}	elseif ( ! WLSM_Helper::is_valid_file( $parent_id_proof, 'attachment' ) ) {
					$errors['parent_id_proof'] = esc_html__( 'File type is not supported.', 'school-management' );
				}
			}

			// Parent Detail.
			if ( empty( $father_name ) ) {
				$errors['father_name'] = esc_html__( 'Please Enter Guardian\'s Name.', 'school-management' );
			}
			if ( ! empty( $father_name ) && strlen( $father_name ) > 60 ) {
				$errors['father_name'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if ( empty( $father_phone ) ) {
				$errors['father_phone'] = esc_html__( 'Please Enter Guardian\'s Phone.', 'school-management' );
			}
			if ( ! empty( $father_phone ) && strlen( $father_phone ) > 10 ) {
				$errors['father_phone'] = esc_html__( 'Maximum length cannot exceed 10 characters.', 'school-management' );
			}
			
			if ( ! empty( $father_occupation ) && strlen( $father_occupation ) > 60 ) {
				$errors['father_occupation'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if ( empty( $mother_name ) ) {
				$errors['mother_name'] = esc_html__( 'Please Enter Guardian\'s Physical Address.', 'school-management' );
			}
			if ( ! empty( $mother_name ) && strlen( $mother_name ) > 60 ) {
				$errors['mother_name'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}
			if ( empty( $mother_phone ) ) {
				$errors['mother_phone'] = esc_html__( 'Please Enter Guardian\'s Workplace Address.', 'school-management' );
			}
			if ( ! empty( $mother_phone ) && strlen( $mother_phone ) > 40 ) {
				$errors['mother_phone'] = esc_html__( 'Maximum length cannot exceed 40 characters.', 'school-management' );
			}
			if ( ! empty( $mother_occupation ) && strlen( $mother_occupation ) > 60 ) {
				$errors['mother_occupation'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
			}

			// Checks if section exists.
			$section = WLSM_M_Staff_Class::get_section( $school_id, $section_id, $class_school_id );
			if ( ! $section ) {
				$errors['section_id'] = esc_html__( 'Programme not found.', 'school-management' );
				wp_send_json_error( $errors );
			}

                            		// Check if the form is submitted.
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Process the form submission.
                // ... (existing code for form processing)
            
                // Extract first name and last name from name (assuming name is stored in $name variable).
                $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
                $name_parts = explode(' ', $name);
                $first_name = $name_parts[0];
                $last_name = $name_parts[count($name_parts) - 1];
            
                // Extract first three letters of the first name and last three letters of the last name.
                $first_name_short = substr($first_name, 0, 3);
                $last_name_short = substr($last_name, -3);
            
                // Generate the username by combining the shortened first name, last name, and first four digits of the ID number.
                $username = $first_name_short . $last_name_short . substr($id_number, 0, 4);
            
                // Make sure the email address is not used as the username.
                if ($login_email === $username) {
                    $errors['username'] = esc_html__('Please provide a different username.', 'school-management');
                }
            
                // Generate the admission number.
                $academic_year = date('y'); // Get the last two digits of the current academic year
                $month_of_application = date('m'); // Get the current month
                $id_number_prefix = substr($id_number, 0, 6);
                $admission_number = $academic_year . $month_of_application . $id_number_prefix;
            
                // Use the admission number as the password.
                $password = $admission_number;
            }


            


			// Transport Detail.
			if ( ! empty( $route_vehicle_id ) ) {
				$route_vehicle = WLSM_M_Staff_Transport::get_route_vehicle( $school_id, $route_vehicle_id );
				if ( ! $route_vehicle ) {
					$errors['route_vehicle_id'] = esc_html__( 'Please select valid transport route vehicle.', 'school-management' );
				}
			} else {
				$route_vehicle_id = null;
			}

			if ( $gdpr_enable ) {
				$gdpr = isset( $_POST['gdpr'] ) ? (bool) ( $_POST['gdpr'] ) : false;
				if ( ! $gdpr ) {
					$errors['gdpr'] = esc_html__( 'Please check for GDPR consent.', 'school-management' );
				}
			}
		} catch ( Exception $exception ) {
			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				$response = $buffer;
			} else {
				$response = $exception->getMessage();
			}
			wp_send_json_error( $response );
		}

		if ( count( $errors ) < 1 ) {
			try {
				// Registration settings.
				$settings_registration               = WLSM_M_Setting::get_settings_registration( $school_id );
				$school_registration_login_user      = $settings_registration['login_user'];
				$school_registration_redirect_url    = $settings_registration['redirect_url'];
				$school_registration_create_invoice  = $settings_registration['create_invoice'];
				$school_registration_success_message = $settings_registration['success_message'];

				$wpdb->query( 'BEGIN;' );

				// Parent user data.
				if ( $allow_parent_login ) {
					// New user.
					$parent_user_data = array(
						'user_email' => $parent_login_email,
						'user_login' => $parent_username,
						'user_pass'  => $parent_password,
					);

					$parent_user_id = wp_insert_user( $parent_user_data );
					if ( is_wp_error( $parent_user_id ) ) {
						throw new Exception( $parent_user_id->get_error_message() );
					}
				} else {
					$parent_user_id = null;
				}

				// Student user data.
				// New user.
				$user_data = array(
					'user_email' => $login_email,
					'user_login' => $username,
					'user_pass'  => $password,
				);

				$user_id = wp_insert_user( $user_data );
				if ( is_wp_error( $user_id ) ) {
					throw new Exception( $user_id->get_error_message() );
				}

				$settings_registration = WLSM_M_Setting::get_settings_registration( $school_id );
				$school_student_active = $settings_registration['student_aprove'];

				if ( $school_student_active === true ) {

					$is_active = 0;

				} else {
					$is_active = 1;
				}

				// Student record data.
				$student_record_data = array(
					'name'              => $name,
					'title'              => $title,
					'marital'              => $marital,
					'consti'              => $consti,
					'gender'            => $gender,
					'survey'            => $survey,
					'dob'               => $dob,
					'phone'             => $phone,
					'email'             => $email,
					'address'           => $address,
					'city'              => $city,
					'state'             => $state,
					'country'           => $country,
					'religion'          => $religion,
					'caste'             => $caste,
					'blood_group'       => $blood_group,
					'id_number'         => $id_number,
					'father_name'       => $father_name,
					'father_phone'      => $father_phone,
					'father_occupation' => $father_occupation,
					'mother_name'       => $mother_name,
					'mother_phone'      => $mother_phone,
					'mother_occupation' => $mother_occupation,
					'admission_date'    => $admission_date,
					'section_id'        => $section_id,
					'route_vehicle_id'  => $route_vehicle_id,
					'user_id'           => $user_id,
					'parent_user_id'    => $parent_user_id,
					'is_active'         => $is_active,
					'from_front'        => 1,
				);
				
				
				// Admission number.
				$admission_number = WLSM_M_Staff_General::get_admission_number( $school_id, $session_id );
				// Generate the admission number.
                $academic_year = date('y'); // Get the last two digits of the current academic year
                $month_of_application = date('m'); // Get the current month
                $id_number_prefix = substr($id_number, 0, 6);
                $admission_number = $academic_year . $month_of_application . $id_number_prefix;
            
				$student_record_data['admission_number'] = $admission_number;

			

				// Roll number.
				$roll_number = WLSM_M_Staff_General::get_roll_number( $school_id, $session_id, $class_id );

				$student_record_data['roll_number'] = $roll_number;

				if ( $gdpr_enable ) {
					$student_record_data['gdpr_agreed'] = $gdpr;
				}

				if ( ! empty( $photo ) ) {
					$photo = media_handle_upload( 'photo', 0 );
					if ( is_wp_error( $photo ) ) {
						throw new Exception( $photo->get_error_message() );
					}
					$student_record_data['photo_id'] = $photo;
				}

				if ( ! empty( $id_proof ) ) {
					$id_proof = media_handle_upload( 'id_proof', 0 );
					if ( is_wp_error( $id_proof ) ) {
						throw new Exception( $id_proof->get_error_message() );
					}
					$student_record_data['id_proof'] = $id_proof;
				}
				
				if ( ! empty( $nrc ) ) {
					$nrc = media_handle_upload( 'nrc', 0 );
					if ( is_wp_error( $nrc ) ) {
						throw new Exception( $nrc->get_error_message() );
					}
					$student_record_data['nrc'] = $nrc;
				}

				if ( ! empty( $parent_id_proof ) ) {
					$parent_id_proof = media_handle_upload( 'parent_id_proof', 0 );
					if ( is_wp_error( $parent_id_proof ) ) {
						throw new Exception( $parent_id_proof->get_error_message() );
					}
					$student_record_data['parent_id_proof'] = $parent_id_proof;
				}

				$student_record_data['session_id'] = $session_id;

				$enrollment_number = WLSM_M_Staff_General::get_enrollment_number( $school_id );

				$student_record_data['enrollment_number'] = $enrollment_number;

				$student_record_data['added_by'] = $user_id;

				$student_record_data['created_at'] = current_time( 'Y-m-d H:i:s' );

				$success = $wpdb->insert( WLSM_STUDENT_RECORDS, $student_record_data );

				$new_student_id = $wpdb->insert_id;

				WLSM_Helper::check_buffer();

				if ( false === $success ) {
					throw new Exception( $wpdb->last_error );
				}

				$placeholders = array(
					'[NAME]'  => stripcslashes( $name ),
					'[PHONE]' => $phone,
					'[EMAIL]' => $email,
					'[CLASS]' => stripcslashes( $class_label ),
					'[SECTION]' => stripcslashes( $section_label ),
				);

				$school_registration_success_placeholders = array_keys( WLSM_Helper::registration_success_message_placeholders() );

				foreach ( $placeholders as $key => $value ) {
					if ( in_array( $key, $school_registration_success_placeholders ) ) {
						$school_registration_success_message = str_replace( $key, $value, $school_registration_success_message );
					}
				}

				// Fees.
				$fees = WLSM_M_Staff_Accountant::fetch_fees_by_class( $school_id, $class_id );

				$fee_order = 10;
				if ( count( $fees ) ) {
					foreach ( $fees as $fee ) {
						$fee_order++;

						// Student fee data.
						$student_fee_data = array(
							'amount'            => $fee->amount,
							'period'            => $fee->period,
							'label'             => $fee->label,
							'fee_order'         => $fee_order,
							'student_record_id' => $new_student_id,
						);

						$student_fee_data['created_at'] = current_time( 'Y-m-d H:i:s' );

						$success = $wpdb->insert( WLSM_STUDENT_FEES, $student_fee_data );

						if ( false === $success ) {
							throw new Exception( $wpdb->last_error );
						}

						if ( $school_registration_create_invoice ) {
							// Invoice data.
							$invoice_data = array(
								'label'           => $student_fee_data['label'],
								'amount'          => $student_fee_data['amount'],
								'date_issued'     => $student_fee_data['created_at'],
								'due_date'        => $student_fee_data['created_at'],
								'partial_payment' => 0,
							);

							$invoice_number = WLSM_M_Invoice::get_invoice_number( $school_id );

							$invoice_data['invoice_number']    = $invoice_number;
							$invoice_data['student_record_id'] = $new_student_id;

							$invoice_data['added_by'] = $user_id;

							$invoice_data['created_at'] = $student_fee_data['created_at'];

							$success = $wpdb->insert( WLSM_INVOICES, $invoice_data );

							if ( false === $success ) {
								throw new Exception( $wpdb->last_error );
							}

							WLSM_Helper::check_buffer();
						}
					}
				}

				$message = $school_registration_success_message;

				$wpdb->query( 'COMMIT;' );

				if ( isset( $new_student_id ) ) {
					// Notify for student registration to student and admin.
					$data = array(
						'school_id'  => $school_id,
						'session_id' => $session_id,
						'student_id' => $new_student_id,
						'password'   => $password,
					);

					wp_schedule_single_event( time() + 30, 'wlsm_notify_for_student_registration_to_student', $data );
					wp_schedule_single_event( time() + 30, 'wlsm_notify_for_student_registration_to_admin', $data );
				}

				if ( $school_registration_login_user ) {
					wp_set_current_user( $user_id, $username );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $username );
				}

				wp_send_json_success(
					array(
						'message'      => $message,
						'redirect_url' => $school_registration_redirect_url,
					)
				);
			} catch ( Exception $exception ) {
				$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}
	
	

	public static function submit_staff_registration() {
		if ( ! wp_verify_nonce( $_POST['wlsm-submit-staff-registration'], 'wlsm-submit-staff-registration' ) ) {
			die();
		}

		try {
			ob_start();
			global $wpdb;

			$school_id = isset( $_POST['school_id'] ) ? absint( $_POST['school_id'] ) : 0;

			// Personal Detail.
			$name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
			$gender  = isset( $_POST['gender'] ) ? sanitize_text_field( $_POST['gender'] ) : '';
			$dob     = isset( $_POST['dob'] ) ? DateTime::createFromFormat( WLSM_Config::date_format(), sanitize_text_field( $_POST['dob'] ) ) : null;
			$address = isset( $_POST['address'] ) ? sanitize_text_field( $_POST['address'] ) : '';
			$email   = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
			$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
			$salary  = isset( $_POST['salary'] ) ? WLSM_Config::sanitize_money( $_POST['salary'] ) : 0;

			// Joining Detail.
			$joining_date = isset( $_POST['joining_date'] ) ? DateTime::createFromFormat( WLSM_Config::date_format(), sanitize_text_field( $_POST['joining_date'] ) ) : null;

			$designation = isset( $_POST['designation'] ) ? sanitize_text_field( $_POST['designation'] ) : '';
			$note        = isset( $_POST['note'] ) ? sanitize_text_field( $_POST['note'] ) : '';

			// Class Teacher.
			$class_id   = isset( $_POST['class_id'] ) ? absint( $_POST['class_id'] ) : 0;
			$section_id = isset( $_POST['section_id'] ) ? absint( $_POST['section_id'] ) : 0;

			// Login Detail.
			$username    = isset( $_POST['username'] ) ? sanitize_text_field( $_POST['username'] ) : '';
			$login_email = isset( $_POST['login_email'] ) ? sanitize_text_field( $_POST['login_email'] ) : '';
			$password    = isset( $_POST['password'] ) ? $_POST['password'] : '';

			// Start validation.
			$errors = array();
			// Personal Detail.
			if ( empty( $name ) ) {
				$errors['name'] = esc_html__( 'Please specify name.', 'school-management' );
			}
			if ( ! empty( $phone ) && strlen( $phone ) > 40 ) {
				$errors['phone'] = esc_html__( 'Maximum length cannot exceed 40 characters.', 'school-management' );
			}
			
			if ( ! empty( $email ) ) {
				if ( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
					$errors['email'] = esc_html__( 'Please provide a valid email.', 'school-management' );
				} elseif ( strlen( $email ) > 60 ) {
					$errors['email'] = esc_html__( 'Maximum length cannot exceed 60 characters.', 'school-management' );
				}
			}

			if ( empty( $school_id ) ) {
				$errors['school_id'] = esc_html__( 'Please select a school.', 'school-management' );
			}

			// staff Login Detail.
			if ( empty( $username ) ) {
				$errors['username'] = esc_html__( 'Please provide username.', 'school-management' );
			}
			if ( empty( $login_email ) ) {
				$errors['login_email'] = esc_html__( 'Please provide login email.', 'school-management' );
			}
			if ( ! filter_var( $login_email, FILTER_VALIDATE_EMAIL ) ) {
				$errors['login_email'] = esc_html__( 'Please provide a valid email.', 'school-management' );
			}
			if ( empty( $password ) ) {
				$errors['password'] = esc_html__( 'Please provide login password.', 'school-management' );
			}

			if ( ! empty( $dob ) ) {
				$dob = $dob->format( 'Y-m-d' );
			} else {
				$dob = null;
			}

			// Class Teacher.
			if ( $class_id ) {
				// Checks if class exists in the school.
				$class_school = WLSM_M_Staff_Class::get_class( $school_id, $class_id );
				if ( ! $class_school ) {
					$errors['class_id'] = esc_html__( 'Year of Study not found.', 'school-management' );
				} else {
					$class_school_id = $class_school->ID;
					if ( ! $section_id ) {
						$errors['section_id'] = esc_html__( 'Please select a Programme.', 'school-management' );
					} else {
						// Checks if section exists.
						$section = WLSM_M_Staff_Class::get_section( $school_id, $section_id, $class_school_id );
						if ( ! $section ) {
							$errors['section_id'] = esc_html__( 'Programme not found.', 'school-management' );
						}
					}
				}
			} else {
				$section_id = null;
			}
		} catch ( Exception $exception ) {
			$buffer = ob_get_clean();
			if ( ! empty( $buffer ) ) {
				$response = $buffer;
			} else {
				$response = $exception->getMessage();
			}
			wp_send_json_error( $response );
		}

		if ( count( $errors ) < 1 ) {
			try {
				$wpdb->query( 'BEGIN;' );

				// New user.
				$user_data = array(
					'user_email' => $login_email,
					'user_login' => $username,
					'user_pass'  => $password,
				);

				$user_id = wp_insert_user( $user_data );

				if ( is_wp_error( $user_id ) ) {
					throw new Exception( $user_id->get_error_message() );
				}
	
				$permissions = array();
				$permissions = serialize($permissions);
				if ( $user_id ) {
					$staff_data['created_at'] = current_time( 'Y-m-d H:i:s' );

					$staff_data['school_id'] = $school_id;
					$staff_data['role']      = 'employee';
					$staff_data['user_id']   = $user_id;
					$staff_data['permissions']   = $permissions;

					$success = $wpdb->insert( WLSM_STAFF, $staff_data );

					$staff_id = $wpdb->insert_id;
				}

				// Student record data.
				$staff_record_data = array(
					'name'         => $name,
					'gender'       => $gender,
					'dob'          => $dob,
					'phone'        => $phone,
					'email'        => $email,
					'address'      => $address,
					'email'        => $email,
					'address'      => $address,
					'salary'       => $salary,
					'designation'  => $designation,
					'note'         => $note,
					'joining_date' => $joining_date,
					'section_id'   => $section_id,
					'is_active'    => 1,
					'staff_id'      => $staff_id,
				);
				$success           = $wpdb->insert( WLSM_ADMINS, $staff_record_data );

				WLSM_Helper::check_buffer();

				if ( false === $success ) {
					throw new Exception( $wpdb->last_error );
				}

				$message = esc_html( 'Staff User Created Successfully.', 'school-management' );

				$wpdb->query( 'COMMIT;' );

				wp_send_json_success(
					array(
						'message' => $message,
					)
				);
			} catch ( Exception $exception ) {
				$wpdb->query( 'ROLLBACK;' );
				wp_send_json_error( $exception->getMessage() );
			}
		}
		wp_send_json_error( $errors );
	}
}
