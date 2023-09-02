<?php
defined( 'ABSPATH' ) || die();

require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/staff/WLSM_M_Staff_Transport.php';

$school_id = NULL;

$gender = '';
$survey = 'google';

$routes = array();

$school_registration_form_title    = '';
$school_registration_dob           = '';
$school_registration_religion      = '';
$school_registration_caste         = '';
$school_registration_blood_group   = '';
$school_registration_phone         = '';
$school_registration_city          = '';
$school_registration_title          = '';
$school_registration_marital          = '';
$school_registration_consti          = '';
$school_registration_state         = '';
$school_registration_country       = '';
$school_registration_transport     = '';
$school_registration_parent_detail = '';
$school_registration_parent_occupation = '';
$school_registration_parent_login  = '';
$school_registration_id_number     = '';

if ( isset( $attr['school_id'] ) ) {
	$school_id = absint( $attr['school_id'] );

	$school = WLSM_M_School::get_active_school( $school_id );
	if ( ! $school ) {
		$invalid_message = esc_html__( 'School not found.', 'school-management' );
		return require_once WLSM_PLUGIN_DIR_PATH . 'public/inc/partials/invalid.php';
	}

	$classes = WLSM_M_Staff_General::fetch_school_classes( $school_id );

	$routes_vehicles = WLSM_M_Staff_Transport::fetch_routes_vehicles( $school_id );

	$routes = array();
	foreach ( $routes_vehicles as $route_vehicle ) {
		if ( array_key_exists( $route_vehicle->route_id, $routes ) ) {
			array_push(
				$routes[ $route_vehicle->route_id ]['vehicles'],
				array( 'vehicle_number' => $route_vehicle->vehicle_number, 'ID' => $route_vehicle->ID )
			);
		} else {
			$routes[ $route_vehicle->route_id ] = array(
				'route_name' => $route_vehicle->route_name,
				'vehicles'   => array( array( 'vehicle_number' => $route_vehicle->vehicle_number, 'ID' => $route_vehicle->ID ) )
			);
		}
	}

	// Registration settings.
	$settings_registration          = WLSM_M_Setting::get_settings_registration( $school_id );
	$school_registration_form_title    = $settings_registration['form_title'];
	$school_registration_dob           = $settings_registration['dob'];
	$school_registration_religion      = $settings_registration['religion'];
	$school_registration_caste         = $settings_registration['caste'];
	$school_registration_blood_group   = $settings_registration['blood_group'];
	$school_registration_phone         = $settings_registration['phone'];
	$school_registration_city          = $settings_registration['city'];
	$school_registration_consti          = $settings_registration['consti'];
	$school_registration_marital          = $settings_registration['marital'];
	$school_registration_title          = $settings_registration['title'];
	$school_registration_state         = $settings_registration['state'];
	$school_registration_country       = $settings_registration['country'];
	$school_registration_transport     = $settings_registration['transport'];
	$school_registration_parent_detail = $settings_registration['parent_detail'];
	$school_registration_parent_login  = $settings_registration['parent_login'];
	$school_registration_id_number     = $settings_registration['id_number'];
	$school_registration_survey        = $settings_registration['survey'];

	$settings_registration = true;

} else {
	$school  = NULL;
	$schools = WLSM_M_School::get_active_schools();

	// Registration settings.
	$settings_registration = false;
}

$gender_list = WLSM_Helper::gender_list();
$survey_list = WLSM_Helper::survey_list();

$sponsorship_list = WLSM_Helper::sponsorship_list();
$intake_list = WLSM_Helper::intake_list();
$mode_list = WLSM_Helper::mode_list();
$city_list = WLSM_Helper::city_list();
$marital_list = WLSM_Helper::marital_list();
$title_list = WLSM_Helper::title_list();
$const_list = WLSM_Helper::const_list();
$province_list = WLSM_Helper::province_list();
$nationality_list = WLSM_Helper::nationality_list();

$nonce_action = 'wlsm-submit-registration';
?>
<div class="wlsm wlsm-grid">
	<div id="wlsm-submit-registration-section">

		<?php
		if ( $settings_registration && $school_registration_form_title ) {
		?>
		<div class="wlsm-header-title wlsm-font-bold wlsm-mb-3">
			<span class="wlsm-border-bottom wlsm-pb-1">
				<?php echo esc_html( $school_registration_form_title ); ?>
			</span>
		</div>
		<?php
		} else {
		?>
		<div class="wlsm-header-title wlsm-font-bold wlsm-mb-3">
			<span class="wlsm-border-bottom wlsm-pb-1">
				<?php esc_html_e( 'Online Registration', 'school-management' ); ?>
			</span>
		</div>
		<?php
		}
	 	?>
		<div class="wlsm-header-title wlsm-font-bold wlsm-mb-3">
			<span class="wlsm-border-bottom wlsm-pb-1">
			</span>
		</div>

		<form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" id="wlsm-submit-registration-form">

			<?php $nonce = wp_create_nonce( $nonce_action ); ?>
			<input type="hidden" name="<?php echo esc_attr( $nonce_action ); ?>" value="<?php echo esc_attr( $nonce ); ?>">

			<input type="hidden" name="action" value="wlsm-p-submit-registration">

			<?php if ( ! $school ) { ?>
			<div class="wlsm-form-group wlsm-row">
				<div class="wlsm-col-12">
					<label for="wlsm_school" class="wlsm-form-label wlsm-font-bold">
						<?php esc_html_e( 'School', 'school-management' ); ?>:
					</label>
				</div>
				<div class="wlsm-col-4 wlsm-px-0">
					<select name="school_id" class="wlsm-form-control wlsm_school" data-nonce="<?php echo esc_attr( wp_create_nonce( 'get-school-classes' ) ); ?>" data-routes-vehicles-nonce="<?php echo esc_attr( wp_create_nonce( 'get-school-routes-vehicles' ) ); ?>" id="wlsm_school" data-sections="1">
						<option value=""><?php esc_html_e( 'Select School', 'school-management' ); ?></option>
						<?php foreach ( $schools as $value ) { ?>
						<option value="<?php echo esc_attr( $value->ID ); ?>">
							<?php echo esc_html( WLSM_M_School::get_label_text( $value->label ) ); ?>
						</option>
						<?php } ?>
					</select>
				</div>
			</div>
			<?php } else { ?>
			<input type="hidden" name="school_id" value="<?php echo esc_attr( $school_id ); ?>" id="wlsm_school">
			<div class="wlsm-form-group wlsm-row wlsm-mb-2">
				<div class="wlsm-col-12">
					<label class="wlsm-form-label wlsm-font-bold">
						<?php esc_html_e( 'School', 'school-management' ); ?>:
					</label>
				</div>
				<div class="wlsm-col-12 wlsm-px-0">
					<span class="wlsm-font-normal">
					<?php echo esc_html( WLSM_M_School::get_label_text( $school->label ) ); ?>
					</span>
				</div>
			</div>
			<?php } ?>

 <!-- Personal Detail -->
			<div class="wlsm-form-section">
				<div class="wlsm-row">
					<div class="wlsm-col-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Personal Detail', 'school-management' ); ?>
						</div>
					</div>
				</div>

				<div class="wlsm-row">
    <div class="wlsm-form-group wlsm-col-4">
        <label for="wlsm_session" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e('Academic Year', 'school-management'); ?>:
        </label>
        <select name="session_id" class="wlsm-form-control" id="wlsm_session">
            <option value=""><?php esc_html_e('Select Academic Year', 'school-management'); ?></option>
            <?php
            $sessions = WLSM_M_Session::fetch_sessions(); // Fetch the available sessions dynamically
            foreach ($sessions as $session) {
                ?>
                <option value="<?php echo esc_attr($session->ID); ?>"><?php echo esc_html($session->label); ?></option>
                <?php
            }
            ?>
        </select>
    </div>
				     <?php
    function formatIdNumberScript(): void {
    ?>
        <script>
            function formatIdNumber(input) {
                // Remove all non-numeric characters
                let numericValue = input.value.replace(/\D/g, '');

                // Ensure the numeric value has exactly 9 digits
                if (numericValue.length > 9) {
                    numericValue = numericValue.substr(0, 9);
                }

                // Format the numeric value with slashes
                if (numericValue.length >= 6) {
                    numericValue = numericValue.replace(/(\d{6})(\d{2})(\d{1})/, '$1/$2/$3');
                }

                // Update the input value
                input.value = numericValue;
            }

            document.addEventListener("DOMContentLoaded", function() {
                const input = document.getElementById("wlsm_id_number");
                input.addEventListener("input", function() {
                    formatIdNumber(input);
                });
            });
        </script>
    <?php
    }

    formatIdNumberScript();
    ?>
</div>

    
    
    <?php if ($school_registration_id_number OR empty($school_id)): ?>
        <div class="wlsm-row" id="registration_id">
            <div class="wlsm-form-group wlsm-col-4">
                <label for="wlsm_id_number" class="wlsm-font-bold">
                    <?php esc_html_e('NRC Number', 'school-management'); ?>:
                </label>
                <input type="text" name="id_number" class="wlsm-form-control" id="wlsm_id_number" placeholder="<?php esc_attr_e('Enter NRC Number', 'school-management'); ?>" value="">
            </div>
            
            <div class="wlsm-form-group wlsm-col-4">
                <label class="wlsm-font-bold wlsm-d-block">
                    <span class="wlsm-important">*</span> <?php esc_html_e('Gender', 'school-management'); ?>:
                </label>
                <select name="gender" class="wlsm-form-control selectpicker" id="wlsm_gender" data-live-search="true">
                    <option value=""><?php esc_html_e('Select Gender', 'school-management'); ?></option>
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
                            return formattedValue.slice(0, 10); // Restrict to maximum of 10 characters
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
                        </label><br>
                        <input type="text" name="dob" class="form-control" id="wlsm_date_of_birth" placeholder="<?php esc_attr_e('DD-MM-YYYY', 'school-management'); ?>" value="<?php echo esc_attr(WLSM_Config::get_date_text($dob)); ?>">
                
                        <?php formatDateInputScript(); ?>
                    <?php endif; ?>
                    </div>
					
				
					
					<div class="wlsm-row">
    <div class="wlsm-form-group wlsm-col-4">
        <label for="wlsm_title" class="wlsm-font-bold">
            <span class="wlsm-important">*</span> <?php esc_html_e( 'Title', 'school-management' ); ?>:
        </label>
        <select name="title" class="wlsm-form-control selectpicker" id="wlsm_title" data-live-search="true">
            <option value=""><?php esc_html_e('Select Title', 'school-management'); ?></option>
            <?php foreach ($title_list as $key => $value) { ?>
                <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $title, true); ?>>
                    <?php echo esc_html($value); ?>
                </option>
            <?php } ?>
        </select>
    </div>
					
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_name" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Student Name', 'school-management' ); ?>:
						</label>
						<input type="text" name="name" class="wlsm-form-control" id="wlsm_name" placeholder="<?php esc_attr_e( 'Enter student Name', 'school-management' ); ?>" value="">
					</div>
					
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_marital" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Marital Status', 'school-management' ); ?>:
						</label>
						<select name="marital" class="wlsm-form-control selectpicker" id="wlsm_marital" data-live-search="true">
                    <option value=""><?php esc_html_e('Select Marital Status', 'school-management'); ?></option>
                    <?php foreach ($marital_list as $key => $value) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $marital, true); ?>>
                            <?php echo esc_html($value); ?>
                        </option>
                    <?php } ?>
                    </select>
					</div>

				
						<div class="wlsm-form-group wlsm-col-4" id="registration_phone">
						<label for="wlsm_phone" class="wlsm-font-bold">
							<?php esc_html_e( 'Phone Number', 'school-management' ); ?>:
						</label>
						<input type="text" name="phone" class="wlsm-form-control" id="wlsm_phone" placeholder="<?php esc_attr_e( 'Enter Phone Number', 'school-management' ); ?>" value="">
					</div>
					

					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_email" class="wlsm-font-bold">
							<?php esc_html_e( 'Email', 'school-management' ); ?>:
						</label>
						<input type="email" name="email" class="wlsm-form-control" id="wlsm_email" placeholder="<?php esc_attr_e( 'Enter Email Address', 'school-management' ); ?>" value="">
					</div>
				
    <?php if ($school_registration_state OR empty($school_id)) : ?>
        <div class="wlsm-form-group wlsm-col-4" id="registration_state">
            <label for="wlsm_state" class="wlsm-font-bold">
                <?php esc_html_e('Province', 'school-management'); ?>:
            </label>
            <select name="state" class="wlsm-form-control selectpicker" id="wlsm_state" data-live-search="true">
                <option value=""><?php esc_html_e('Select Province', 'school-management'); ?></option>
                <option value="Central"><?php echo esc_html($province_list['Central']); ?></option>
                <option value="Copperbelt"><?php echo esc_html($province_list['Copperbelt']); ?></option>
                <option value="Eastern"><?php echo esc_html($province_list['Eastern']); ?></option>
                <option value="Luapula"><?php echo esc_html($province_list['Luapula']); ?></option>
                <option value="Lusaka"><?php echo esc_html($province_list['Lusaka']); ?></option>
                <option value="Muchinga"><?php echo esc_html($province_list['Muchinga']); ?></option>
                <option value="Northern"><?php echo esc_html($province_list['Northern']); ?></option>
                <option value="North-Western"><?php echo esc_html($province_list['North-Western']); ?></option>
                <option value="Southern"><?php echo esc_html($province_list['Southern']); ?></option>
                <option value="Western"><?php echo esc_html($province_list['Western']); ?></option>
            </select>
        </div>
    <?php endif ?>

    <?php if ($school_registration_city OR empty($school_id)) : ?>
        <div class="wlsm-form-group wlsm-col-4" id="registration_city">
            <label for="wlsm_city" class="wlsm-font-bold">
                <?php esc_html_e('District', 'school-management'); ?>:
            </label>
            <select name="city" class="wlsm-form-control selectpicker" id="wlsm_city" data-live-search="true">
                <option value=""><?php esc_html_e('Select District', 'school-management'); ?></option>
            </select>
        </div>
    <?php endif ?>
    
    		
						<div class="wlsm-form-group wlsm-col-4" id="registration_consti" >
						<label for="wlsm_consti" class="wlsm-font-bold">
							<?php esc_html_e( 'Constituency', 'school-management' ); ?>:
						</label>
            <select name="consti" class="wlsm-form-control selectpicker" id="wlsm_consti" data-live-search="true">
                <option value=""><?php esc_html_e('Select Constituency', 'school-management'); ?></option>
            </select>
        </div>
    

<?php
function generate_district_script($city_list)
{
    ob_start();
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var provinceDropdown = document.getElementById('wlsm_state');
            var districtDropdown = document.getElementById('wlsm_city');

            var districtOptions = {
                Central: {
                    Chibombo: '<?php echo esc_js($city_list['Chibombo']); ?>',
                    Chisamba: '<?php echo esc_js($city_list['Chisamba']); ?>',
                    Chitambo: '<?php echo esc_js($city_list['Chitambo']); ?>',
                    Kabwe: '<?php echo esc_js($city_list['Kabwe']); ?>',
                    'Kapiri Mposhi': '<?php echo esc_js($city_list['Kapiri Mposhi']); ?>',
                    Luano: '<?php echo esc_js($city_list['Luano']); ?>',
                    Mkushi: '<?php echo esc_js($city_list['Mkushi']); ?>',
                    Mumbwa: '<?php echo esc_js($city_list['Mumbwa']); ?>',
                    Ngabwe: '<?php echo esc_js($city_list['Ngabwe']); ?>',
                    Serenje: '<?php echo esc_js($city_list['Serenje']); ?>',
                    Shibuyunji: '<?php echo esc_js($city_list['Shibuyunji']); ?>'
                },
                Copperbelt: {
                    Chililabombwe: '<?php echo esc_js($city_list['Chililabombwe']); ?>',
                    Chingola: '<?php echo esc_js($city_list['Chingola']); ?>',
                    Kalulushi: '<?php echo esc_js($city_list['Kalulushi']); ?>',
                    Kitwe: '<?php echo esc_js($city_list['Kitwe']); ?>',
                    Luanshya: '<?php echo esc_js($city_list['Luanshya']); ?>',
                    Lufwanyama: '<?php echo esc_js($city_list['Lufwanyama']); ?>',
                    Masaiti: '<?php echo esc_js($city_list['Masaiti']); ?>',
                    Mpongwe: '<?php echo esc_js($city_list['Mpongwe']); ?>',
                    Mufulira: '<?php echo esc_js($city_list['Mufulira']); ?>',
                    Ndola: '<?php echo esc_js($city_list['Ndola']); ?>',
                },
                Eastern: {
                    Chadiza: '<?php echo esc_js($city_list['Chadiza']); ?>',
                    Chama: '<?php echo esc_js($city_list['Chama']); ?>',
                    Chasefu: '<?php echo esc_js($city_list['Chasefu']); ?>',
                    Chipangali: '<?php echo esc_js($city_list['Chipangali']); ?>',
                    Chipata: '<?php echo esc_js($city_list['Chipata']); ?>',
                    Kasenengwa: '<?php echo esc_js($city_list['Kasenengwa']); ?>',
                    Katete: '<?php echo esc_js($city_list['Katete']); ?>',
                    Lumezi: '<?php echo esc_js($city_list['Lumezi']); ?>',
                    Lundazi: '<?php echo esc_js($city_list['Lundazi']); ?>',
                    Lusangazi: '<?php echo esc_js($city_list['Lusangazi']); ?>',
                    Mambwe: '<?php echo esc_js($city_list['Mambwe']); ?>',
                    Nyimba: '<?php echo esc_js($city_list['Nyimba']); ?>',
                    Petauke: '<?php echo esc_js($city_list['Petauke']); ?>',
                    Sinda: '<?php echo esc_js($city_list['Sinda']); ?>',
                    Vubwi: '<?php echo esc_js($city_list['Vubwi']); ?>',
                },
                Luapula: {
                    Chembe: '<?php echo esc_js($city_list['Chembe']); ?>',
                    Chienge: '<?php echo esc_js($city_list['Chienge']); ?>',
                    Chifunabuli: '<?php echo esc_js($city_list['Chifunabuli']); ?>',
                    Chipili: '<?php echo esc_js($city_list['Chipili']); ?>',
                    Kawambwa: '<?php echo esc_js($city_list['Kawambwa']); ?>',
                    Lunga: '<?php echo esc_js($city_list['Lunga']); ?>',
                    Mansa: '<?php echo esc_js($city_list['Mansa']); ?>',
                    Milenge: '<?php echo esc_js($city_list['Milenge']); ?>',
                    Mwansabombwe: '<?php echo esc_js($city_list['Mwansabombwe']); ?>',
                    Mwense: '<?php echo esc_js($city_list['Mwense']); ?>',
                    Nchelenge: '<?php echo esc_js($city_list['Nchelenge']); ?>',
                    Samfya: '<?php echo esc_js($city_list['Samfya']); ?>',
                },
                Lusaka: {
                    Chilanga: '<?php echo esc_js($city_list['Chilanga']); ?>',
                    Chongwe: '<?php echo esc_js($city_list['Chongwe']); ?>',
                    Kafue: '<?php echo esc_js($city_list['Kafue']); ?>',
                    Luangwa: '<?php echo esc_js($city_list['Luangwa']); ?>',
                    Lusaka: '<?php echo esc_js($city_list['Lusaka']); ?>',
                    Rufunsa: '<?php echo esc_js($city_list['Rufunsa']); ?>',
                },
                Muchinga: {
                    Chinsali: '<?php echo esc_js($city_list['Chinsali']); ?>',
                    Isoka: '<?php echo esc_js($city_list['Isoka']); ?>',
                    Kanchibiya: '<?php echo esc_js($city_list['Kanchibiya']); ?>',
                    Lavushimanda: '<?php echo esc_js($city_list['Lavushimanda']); ?>',
                    Mafinga: '<?php echo esc_js($city_list['Mafinga']); ?>',
                    Mpika: '<?php echo esc_js($city_list['Mpika']); ?>',
                    Nakonde: '<?php echo esc_js($city_list['Nakonde']); ?>',
                    Shiwangandu: '<?php echo esc_js($city_list['Shiwangandu']); ?>',
                },
                Northern: {
                    Chilubi: '<?php echo esc_js($city_list['Chilubi']); ?>',
                    Kaputa: '<?php echo esc_js($city_list['Kaputa']); ?>',
                    Kasama: '<?php echo esc_js($city_list['Kasama']); ?>',
                    Lunte: '<?php echo esc_js($city_list['Lunte']); ?>',
                    Lupososhi: '<?php echo esc_js($city_list['Lupososhi']); ?>',
                    Luwingu: '<?php echo esc_js($city_list['Luwingu']); ?>',
                    Mbala: '<?php echo esc_js($city_list['Mbala']); ?>',
                    Mporokoso: '<?php echo esc_js($city_list['Mporokoso']); ?>',
                    Mpulungu: '<?php echo esc_js($city_list['Mpulungu']); ?>',
                    Mungwi: '<?php echo esc_js($city_list['Mungwi']); ?>',
                    Nsama: '<?php echo esc_js($city_list['Nsama']); ?>',
                    'Senga Hill': '<?php echo esc_js($city_list['Senga Hill']); ?>',
                },
                'North-Western': {
                    Chavuma: '<?php echo esc_js($city_list['Chavuma']); ?>',
                    Ikelenge: '<?php echo esc_js($city_list['Ikelenge']); ?>',
                    Kabompo: '<?php echo esc_js($city_list['Kabompo']); ?>',
                    Kalumbila: '<?php echo esc_js($city_list['Kalumbila']); ?>',
                    Kasempa: '<?php echo esc_js($city_list['Kasempa']); ?>',
                    Manyinga: '<?php echo esc_js($city_list['Manyinga']); ?>',
                    Mufumbwe: '<?php echo esc_js($city_list['Mufumbwe']); ?>',
                    Mushindamo: '<?php echo esc_js($city_list['Mushindamo']); ?>',
                    Mwinilunga: '<?php echo esc_js($city_list['Mwinilunga']); ?>',
                    Solwezi: '<?php echo esc_js($city_list['Solwezi']); ?>',
                    Zambezi: '<?php echo esc_js($city_list['Zambezi']); ?>',
                },
                Southern: {
                    Chikankata: '<?php echo esc_js($city_list['Chikankata']); ?>',
                    Chirundu: '<?php echo esc_js($city_list['Chirundu']); ?>',
                    Choma: '<?php echo esc_js($city_list['Choma']); ?>',
                    Gwembe: '<?php echo esc_js($city_list['Gwembe']); ?>',
                    'Itezhi-Tezhi': '<?php echo esc_js($city_list['Itezhi-Tezhi']); ?>',
                    Kalomo: '<?php echo esc_js($city_list['Kalomo']); ?>',
                    Kazungula: '<?php echo esc_js($city_list['Kazungula']); ?>',
                    Livingstone: '<?php echo esc_js($city_list['Livingstone']); ?>',
                    Mazabuka: '<?php echo esc_js($city_list['Mazabuka']); ?>',
                    Monze: '<?php echo esc_js($city_list['Monze']); ?>',
                    Namwala: '<?php echo esc_js($city_list['Namwala']); ?>',
                    Pemba: '<?php echo esc_js($city_list['Pemba']); ?>',
                    Siavonga: '<?php echo esc_js($city_list['Siavonga']); ?>',
                    Sinazongwe: '<?php echo esc_js($city_list['Sinazongwe']); ?>',
                    Zimba: '<?php echo esc_js($city_list['Zimba']); ?>',
                },
                Western: {
                    Kalabo: '<?php echo esc_js($city_list['Kalabo']); ?>',
                    Kaoma: '<?php echo esc_js($city_list['Kaoma']); ?>',
                    Limulunga: '<?php echo esc_js($city_list['Limulunga']); ?>',
                    Luampa: '<?php echo esc_js($city_list['Luampa']); ?>',
                    Lukulu: '<?php echo esc_js($city_list['Lukulu']); ?>',
                    Mitete: '<?php echo esc_js($city_list['Mitete']); ?>',
                    Mongu: '<?php echo esc_js($city_list['Mongu']); ?>',
                    Mulobezi: '<?php echo esc_js($city_list['Mulobezi']); ?>',
                    Mwandi: '<?php echo esc_js($city_list['Mwandi']); ?>',
                    Nalikwanda: '<?php echo esc_js($city_list['Nalikwanda']); ?>',
                    Nalolo: '<?php echo esc_js($city_list['Nalolo']); ?>',
                    Nkeyema: '<?php echo esc_js($city_list['Nkeyema']); ?>',
                    Senanga: '<?php echo esc_js($city_list['Senanga']); ?>',
                    Sesheke: '<?php echo esc_js($city_list['Sesheke']); ?>',
                    Shangombo: '<?php echo esc_js($city_list['Shangombo']); ?>',
                    Sikongo: '<?php echo esc_js($city_list['Sikongo']); ?>',
                    Sioma: '<?php echo esc_js($city_list['Sioma']); ?>',
                }
            };

            provinceDropdown.addEventListener('change', function() {
                var selectedProvince = provinceDropdown.value;
                districtDropdown.innerHTML = '<option value="">' + '<?php esc_html_e('Select District', 'school-management'); ?>' + '</option>';

                if (selectedProvince in districtOptions) {
                    var districts = districtOptions[selectedProvince];
                    for (var key in districts) {
                        if (districts.hasOwnProperty(key)) {
                            var option = document.createElement('option');
                            option.value = key;
                            option.textContent = districts[key];
                            districtDropdown.appendChild(option);
                        }
                    }
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

// Usage:
echo generate_district_script($city_list);
?>



			

<?php
function generate_constituency_script($const_list)
{
    ob_start();
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var stateDropdown = document.getElementById('wlsm_state');
            var constituencyDropdown = document.getElementById('wlsm_consti');

            var constituencyOptions = {
                'Central': {
                    'Bwacha': '<?php echo esc_js($const_list['Bwacha']); ?>',
                    'Chisamba': '<?php echo esc_js($const_list['Chisamba']); ?>',
                    'Chitambo': '<?php echo esc_js($const_list['Chitambo']); ?>',
                    'Itezhi-Tezhi': '<?php echo esc_js($const_list['Itezhi-Tezhi']); ?>',
                    'Kabwe Central': '<?php echo esc_js($const_list['Kabwe Central']); ?>',
                    'Kapiri Mposhi': '<?php echo esc_js($const_list['Kapiri Mposhi']); ?>',
                    'Katuba': '<?php echo esc_js($const_list['Katuba']); ?>',
                    'Keembe': '<?php echo esc_js($const_list['Keembe']); ?>',
                    'Lufubu': '<?php echo esc_js($const_list['Lufubu']); ?>',
                    'Mkushi North': '<?php echo esc_js($const_list['Mkushi North']); ?>',
                    'Mkushi South': '<?php echo esc_js($const_list['Mkushi South']); ?>',
                    'Mumbwa': '<?php echo esc_js($const_list['Mumbwa']); ?>',
                    'Mwembeshi': '<?php echo esc_js($const_list['Mwembeshi']); ?>',
                    'Nangoma': '<?php echo esc_js($const_list['Nangoma']); ?>',
                    'Serenje': '<?php echo esc_js($const_list['Serenje']); ?>'
                },
                
                Copperbelt: {
                    'Bwana Mkubwa': '<?php echo esc_js($const_list['Bwana Mkubwa']); ?>',
                    Chifubu: '<?php echo esc_js($const_list['Chifubu']); ?>',
                    Chililabombwe: '<?php echo esc_js($const_list['Chililabombwe']); ?>',
                    Chimwemwe: '<?php echo esc_js($const_list['Chimwemwe']); ?>',
                    Chingola: '<?php echo esc_js($const_list['Chingola']); ?>',
                    Kabushi: '<?php echo esc_js($const_list['Kabushi']); ?>',
                    Kafulafuta: '<?php echo esc_js($const_list['Kafulafuta']); ?>',
                    Kalulushi: '<?php echo esc_js($const_list['Kalulushi']); ?>',
                    Kamfinsa: '<?php echo esc_js($const_list['Kamfinsa']); ?>',
                    Kankoyo: '<?php echo esc_js($const_list['Kankoyo']); ?>',
                    Kantanshi: '<?php echo esc_js($const_list['Kantanshi']); ?>',
                    Kwacha: '<?php echo esc_js($const_list['Kwacha']); ?>',
                    Luanshya: '<?php echo esc_js($const_list['Luanshya']); ?>',
                    Lufwanyama: '<?php echo esc_js($const_list['Lufwanyama']); ?>',
                    Masaiti: '<?php echo esc_js($const_list['Masaiti']); ?>',
                    Mpongwe: '<?php echo esc_js($const_list['Mpongwe']); ?>',
                    Mufulira: '<?php echo esc_js($const_list['Mufulira']); ?>',
                    Nchanga: '<?php echo esc_js($const_list['Nchanga']); ?>',
                    'Ndola Central': '<?php echo esc_js($const_list['Ndola Central']); ?>',
                    Nkana: '<?php echo esc_js($const_list['Nkana']); ?>',
                    Roan: '<?php echo esc_js($const_list['Roan']); ?>',
                    Wusakile: '<?php echo esc_js($const_list['Wusakile']); ?>'
                },
                Eastern: {
                    Chadiza: '<?php echo esc_js($const_list['Chadiza']); ?>',
                    Chasefu: '<?php echo esc_js($const_list['Chasefu']); ?>',
                    Chipangali: '<?php echo esc_js($const_list['Chipangali']); ?>',
                    'Chipata Central': '<?php echo esc_js($const_list['Chipata Central']); ?>',
                    Kapoche: '<?php echo esc_js($const_list['Kapoche']); ?>',
                    Kasenengwa: '<?php echo esc_js($const_list['Kasenengwa']); ?>',
                    Kaumbwe: '<?php echo esc_js($const_list['Kaumbwe']); ?>',
                    Luangeni: '<?php echo esc_js($const_list['Luangeni']); ?>',
                    Lumezi: '<?php echo esc_js($const_list['Lumezi']); ?>',
                    Lundazi: '<?php echo esc_js($const_list['Lundazi']); ?>',
                    Malambo: '<?php echo esc_js($const_list['Malambo']); ?>',
                    Milanzi: '<?php echo esc_js($const_list['Milanzi']); ?>',
                    Mkaika: '<?php echo esc_js($const_list['Mkaika']); ?>',
                    Msanzala: '<?php echo esc_js($const_list['Msanzala']); ?>',
                    Nyimba: '<?php echo esc_js($const_list['Nyimba']); ?>',
                    'Petauke Central': '<?php echo esc_js($const_list['Petauke Central']); ?>',
                    Sinda: '<?php echo esc_js($const_list['Sinda']); ?>',
                    Vubwi: '<?php echo esc_js($const_list['Vubwi']); ?>'
                },
                Luapula: {
                    Bahati: '<?php echo esc_js($const_list['Bahati']); ?>',
                    Bangweulu: '<?php echo esc_js($const_list['Bangweulu']); ?>',
                    Chembe: '<?php echo esc_js($const_list['Chembe']); ?>',
                    Chienge: '<?php echo esc_js($const_list['Chienge']); ?>',
                    Chifunabuli: '<?php echo esc_js($const_list['Chifunabuli']); ?>',
                    Chipili: '<?php echo esc_js($const_list['Chipili']); ?>',
                    Kawambwa: '<?php echo esc_js($const_list['Kawambwa']); ?>',
                    Luapula: '<?php echo esc_js($const_list['Luapula']); ?>',
                    Mambilima: '<?php echo esc_js($const_list['Mambilima']); ?>',
                    'Mansa Central': '<?php echo esc_js($const_list['Mansa Central']); ?>',
                    Milenge: '<?php echo esc_js($const_list['Milenge']); ?>',
                    Mwansabombwe: '<?php echo esc_js($const_list['Mwansabombwe']); ?>',
                    Mwense: '<?php echo esc_js($const_list['Mwense']); ?>',
                    Nchelenge: '<?php echo esc_js($const_list['Nchelenge']); ?>',
                    Pambashe: '<?php echo esc_js($const_list['Pambashe']); ?>'
                },
                Lusaka: {
                    Chawama: '<?php echo esc_js($const_list['Chawama']); ?>',
                    Chilanga: '<?php echo esc_js($const_list['Chilanga']); ?>',
                    Chirundu: '<?php echo esc_js($const_list['Chirundu']); ?>',
                    Chongwe: '<?php echo esc_js($const_list['Chongwe']); ?>',
                    Feira: '<?php echo esc_js($const_list['Feira']); ?>',
                    Kabwata: '<?php echo esc_js($const_list['Kabwata']); ?>',
                    Kafue: '<?php echo esc_js($const_list['Kafue']); ?>',
                    Kanyama: '<?php echo esc_js($const_list['Kanyama']); ?>',
                    'Lusaka Central': '<?php echo esc_js($const_list['Lusaka Central']); ?>',
                    Mandevu: '<?php echo esc_js($const_list['Mandevu']); ?>',
                    Matero: '<?php echo esc_js($const_list['Matero']); ?>',
                    Munali: '<?php echo esc_js($const_list['Munali']); ?>',
                    Rufunsa: '<?php echo esc_js($const_list['Rufunsa']); ?>'
                },
                Muchinga: {
                    'Chama North': '<?php echo esc_js($const_list['Chama North']); ?>',
                    'Chama South': '<?php echo esc_js($const_list['Chama South']); ?>',
                    Chinsali: '<?php echo esc_js($const_list['Chinsali']); ?>',
                    Isoka: '<?php echo esc_js($const_list['Isoka']); ?>',
                    Kanchibiya: '<?php echo esc_js($const_list['Kanchibiya']); ?>',
                    Mafinga: '<?php echo esc_js($const_list['Mafinga']); ?>',
                    Mfuwe: '<?php echo esc_js($const_list['Mfuwe']); ?>',
                    Mpika: '<?php echo esc_js($const_list['Mpika']); ?>',
                    Nakonde: '<?php echo esc_js($const_list['Nakonde']); ?>',
                    'Shiwa Ng\'andu': '<?php echo esc_js($const_list['Shiwa Ng\'andu']); ?>'
                },
                Northern: {
                    Chilubi: '<?php echo esc_js($const_list['Chilubi']); ?>',
                    Chimbamilonga: '<?php echo esc_js($const_list['Chimbamilonga']); ?>',
                    Kaputa: '<?php echo esc_js($const_list['Kaputa']); ?>',
                    Kasama: '<?php echo esc_js($const_list['Kasama']); ?>',
                    Lubansenshi: '<?php echo esc_js($const_list['Lubansenshi']); ?>',
                    Lukashya: '<?php echo esc_js($const_list['Lukashya']); ?>',
                    Lunte: '<?php echo esc_js($const_list['Lunte']); ?>',
                    Lupososhi: '<?php echo esc_js($const_list['Lupososhi']); ?>',
                    Malole: '<?php echo esc_js($const_list['Malole']); ?>',
                    Mbala: '<?php echo esc_js($const_list['Mbala']); ?>',
                    Mporokoso: '<?php echo esc_js($const_list['Mporokoso']); ?>',
                    Mpulungu: '<?php echo esc_js($const_list['Mpulungu']); ?>',
                    'Senga Hill': '<?php echo esc_js($const_list['Senga Hill']); ?>'
                },
                'North-Western': {
                    Chavuma: '<?php echo esc_js($const_list['Chavuma']); ?>',
                    Ikelengi: '<?php echo esc_js($const_list['Ikelengi']); ?>',
                    Kabompo: '<?php echo esc_js($const_list['Kabompo']); ?>',
                    Kasempa: '<?php echo esc_js($const_list['Kasempa']); ?>',
                    Manyinga: '<?php echo esc_js($const_list['Manyinga']); ?>',
                    Mufumbwe: '<?php echo esc_js($const_list['Mufumbwe']); ?>',
                    Mwinilunga: '<?php echo esc_js($const_list['Mwinilunga']); ?>',
                    'Solwezi Central': '<?php echo esc_js($const_list['Solwezi Central']); ?>',
                    'Solwezi East': '<?php echo esc_js($const_list['Solwezi East']); ?>',
                    'Solwezi West': '<?php echo esc_js($const_list['Solwezi West']); ?>',
                    'Zambezi East': '<?php echo esc_js($const_list['Zambezi East']); ?>',
                    'Zambezi West': '<?php echo esc_js($const_list['Zambezi West']); ?>'
                },
                'Southern': {
                    Bweengwa: '<?php echo esc_js($const_list['Bweengwa']); ?>',
                    Chikankata: '<?php echo esc_js($const_list['Chikankata']); ?>',
                    Choma: '<?php echo esc_js($const_list['Choma']); ?>',
                    Dundumwenzi: '<?php echo esc_js($const_list['Dundumwenzi']); ?>',
                    Gwembe: '<?php echo esc_js($const_list['Gwembe']); ?>',
                    'Kalomo Central': '<?php echo esc_js($const_list['Kalomo Central']); ?>',
                    Katombola: '<?php echo esc_js($const_list['Katombola']); ?>',
                    Livingstone: '<?php echo esc_js($const_list['Livingstone']); ?>',
                    Magoye: '<?php echo esc_js($const_list['Magoye']); ?>',
                    Mapatizya: '<?php echo esc_js($const_list['Mapatizya']); ?>',
                    'Mazabuka Central': '<?php echo esc_js($const_list['Mazabuka Central']); ?>',
                    Mbabala: '<?php echo esc_js($const_list['Mbabala']); ?>',
                    Monze: '<?php echo esc_js($const_list['Monze']); ?>',
                    Moomba: '<?php echo esc_js($const_list['Moomba']); ?>',
                    Namwala: '<?php echo esc_js($const_list['Namwala']); ?>',
                    Pemba: '<?php echo esc_js($const_list['Pemba']); ?>',
                    Siavonga: '<?php echo esc_js($const_list['Siavonga']); ?>',
                    Sinazongwe: '<?php echo esc_js($const_list['Sinazongwe']); ?>'
                },
                'Western': {
                    'Kalabo Central': '<?php echo esc_js($const_list['Kalabo Central']); ?>',
                    'Kaoma': '<?php echo esc_js($const_list['Kaoma']); ?>',
                    'Liuwa': '<?php echo esc_js($const_list['Liuwa']); ?>',
                    'Luampa': '<?php echo esc_js($const_list['Luampa']); ?>',
                    'Luena': '<?php echo esc_js($const_list['Luena']); ?>',
                    'Lukulu East': '<?php echo esc_js($const_list['Lukulu East']); ?>',
                    'Mangango': '<?php echo esc_js($const_list['Mangango']); ?>',
                    'Mitete': '<?php echo esc_js($const_list['Mitete']); ?>',
                    'Mongu Central': '<?php echo esc_js($const_list['Mongu Central']); ?>',
                    'Mulobezi': '<?php echo esc_js($const_list['Mulobezi']); ?>',
                    'Mwandi': '<?php echo esc_js($const_list['Mwandi']); ?>',
                    'Nalikwanda': '<?php echo esc_js($const_list['Nalikwanda']); ?>',
                    'Nalolo': '<?php echo esc_js($const_list['Nalolo']); ?>',
                    'Nkeyema': '<?php echo esc_js($const_list['Nkeyema']); ?>',
                    'Senanga': '<?php echo esc_js($const_list['Senanga']); ?>',
                    'Sesheke': '<?php echo esc_js($const_list['Sesheke']); ?>',
                    'Shang’ombo': '<?php echo esc_js($const_list['Shang’ombo']); ?>',
                    'Sikongo': '<?php echo esc_js($const_list['Sikongo']); ?>',
                    'Sioma': '<?php echo esc_js($const_list['Sioma']); ?>'
                }
            };

            stateDropdown.addEventListener('change', function() {
                var selectedState = stateDropdown.value;
                constituencyDropdown.innerHTML = '<option value="">' + '<?php esc_html_e('Select Constituency', 'school-management'); ?>' + '</option>';

                if (selectedState in constituencyOptions) {
                    var constituencies = constituencyOptions[selectedState];
                    for (var key in constituencies) {
                        if (constituencies.hasOwnProperty(key)) {
                            var option = document.createElement('option');
                            option.value = key;
                            option.textContent = constituencies[key];
                            constituencyDropdown.appendChild(option);
                        }
                    }
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}

// Usage:
echo generate_constituency_script($const_list);
?>


					
					<?php if ($school_registration_country OR empty($school_id)): ?>
						<div class="wlsm-form-group wlsm-col-4" id="registration_country" >
						<label for="wlsm_country" class="wlsm-font-bold">
							<?php esc_html_e( 'Nationality', 'school-management' ); ?>:
						</label>
						<select name="country" class="wlsm-form-control selectpicker" id="wlsm_country" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Nationality', 'school-management' ); ?></option>
							<?php foreach ( $nationality_list as $key => $value ) { ?>
							<option value="<?php echo esc_attr( $key ); ?>">
								<?php echo esc_html( $value ); ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					
				
						
<div class="wlsm-row">
					<div class="wlsm-row">
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_address" class="wlsm-font-bold">
							<?php esc_html_e( 'Physical Address', 'school-management' ); ?>:
						</label>
						<input type="text" name="address" class="wlsm-form-control" id="wlsm_address" placeholder="<?php esc_attr_e( 'Enter Physical Address', 'school-management' ); ?>" value="">
					</div>
			
				
					<div class="wlsm-form-group wlsm-col-4">
						<div class="wlsm-id-proof-box wlsm-mt-2">
							<div class="wlsm-id-proof-section">
								<label for="wlsm_id_proof" class="wlsm-font-bold">
									<?php esc_html_e( 'Upload School Results (PDF)', 'school-management' ); ?>:
								</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="wlsm_id_proof" name="id_proof" accept=".pdf">
									            </div>
									        </div>
									    </div>
									</div>
									
						<div class="wlsm-form-group wlsm-col-4">
						<div class="wlsm-nrc-box wlsm-mt-2">
						<div class="wlsm-nrc-box wlsm-mt-2">
							<div class="wlsm-nrc-section">
								<label for="wlsm_nrc" class="wlsm-font-bold">
									<?php esc_html_e( 'Upload NRC(PDF)', 'school-management' ); ?>:
								</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="wlsm_nrc" name="nrc" accept=".pdf">
									</div>
									
										</div>
									</div>
								</div>
						</div>
					<?php endif ?>
		
		
		<div class="wlsm-row">	
				

			<!-- Admission Detail -->
			<div class="wlsm-form-section">
				<div class="wlsm-row">
					<div class="wlsm-col-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Admission Detail', 'school-management' ); ?>
								</div>
					

				<div class="wlsm-row">
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_school_class" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Year of Study', 'school-management' ); ?>:
						</label>
						<select name="class_id" class="wlsm-form-control" data-nonce="<?php echo esc_attr( wp_create_nonce( 'get-class-sections' ) ); ?>" id="wlsm_school_class">
							<option value=""><?php esc_html_e( 'Select Year of Study', 'school-management' ); ?></option>
							<?php
							if ( isset( $classes ) ) {
								foreach ( $classes as $class ) {
								?>
								<option value="<?php echo esc_attr( $class->ID ); ?>">
									<?php echo esc_html( WLSM_M_Class::get_label_text( $class->label ) ); ?>
								</option>
								<?php
								}
							}
							?>
						</select>
					</div>

					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_section" class="wlsm-font-bold">
							<span class="wlsm-important">*</span> <?php esc_html_e( 'Programme', 'school-management' ); ?>:
						</label>
						<select name="section_id" class="wlsm-form-control" id="wlsm_section">
							<option value=""><?php esc_html_e( 'Select Programme', 'school-management' ); ?></option>
						</select>
					</div>

					<div class="wlsm-form-group wlsm-col-4">
	                <div class="wlsm-photo-box wlsm-mt-2">
		                <div class="wlsm-photo-section">
		                	<label for="wlsm_photo" class="wlsm-font-bold">
				            <?php esc_html_e('Upload Passport Size Photo (JPG, JPEG, PNG)', 'school-management'); ?>:
			                </label>
			                <div class="custom-file mb-3">
				            <input type="file" class="custom-file-input" id="wlsm_photo" name="photo" accept=".jpg, .jpeg, .png">
			                    </div>
		                </div>
                	</div>
                	</div>
               
                
                <?php if ($school_registration_caste OR empty($school_id)): ?>
						<div class="wlsm-form-group wlsm-col-4" id="registration_caste">
						<label for="wlsm_caste" class="wlsm-font-bold">
							<?php esc_html_e( 'Mode of Study', 'school-management' ); ?>:
						</label>
						<select name="caste" class="wlsm-form-control selectpicker" id="wlsm_caste" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Mode of Study', 'school-management' ); ?></option>
							<?php foreach ( $mode_list as $key => $value ) { ?>
							<option value="<?php echo esc_attr( $key ); ?>">
								<?php echo esc_html( $value ); ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>

					<?php if ($school_registration_blood_group OR empty($school_id)): ?>
						<div class="wlsm-form-group wlsm-col-4" id="registration_blood_group">
						<label for="wlsm_blood_group" class="wlsm-font-bold">
							<?php esc_html_e( 'Sponsorship', 'school-management' ); ?>:
						</label>
						<select name="blood_group" class="wlsm-form-control selectpicker" id="wlsm_blood_group" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Sponsorship', 'school-management' ); ?></option>
							<?php foreach ( $sponsorship_list as $key => $value ) { ?>
							<option value="<?php echo esc_attr( $key ); ?>">
								<?php echo esc_html( $value ); ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
					
					<?php if ($school_registration_religion OR empty($school_id)): ?>
						<div class="wlsm-form-group wlsm-col-4" id="registration_religion">
						<label for="wlsm_religion" class="wlsm-font-bold">
							<?php esc_html_e( 'Intake', 'school-management' ); ?>:
						</label>
						<select name="religion" class="wlsm-form-control selectpicker" id="wlsm_religion" data-live-search="true">
							<option value=""><?php esc_html_e( 'Select Intake', 'school-management' ); ?></option>
							<?php foreach ( $intake_list as $key => $value ) { ?>
							<option value="<?php echo esc_attr( $key ); ?>">
								<?php echo esc_html( $value ); ?>
							</option>
							<?php } ?>
						</select>
					</div>
					<?php endif ?>
				
				
			

			<!-- Parent Detail -->
			<?php if ($school_registration_parent_detail OR empty($school_id)): ?>
				<div class="wlsm-form-section" id="registration_parent_detail">
				<div class="wlsm-row">
					<div class="wlsm-col-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e( 'Guardian Detail', 'school-management' ); ?>
							</div>
						
				<div class="wlsm-row">
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_father_name" class="wlsm-font-bold">
							<?php esc_html_e( 'Guardian\'s Name', 'school-management' ); ?>:
						</label>
						<input type="text" name="father_name" class="wlsm-form-control" id="wlsm_father_name" placeholder="<?php esc_attr_e( 'Enter Guardian\'s Name', 'school-management' ); ?>" value="">
					</div>
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_father_phone" class="wlsm-font-bold">
							<?php esc_html_e( 'Guardian\'s Phone', 'school-management' ); ?>:
						</label>
						<input type="text" name="father_phone" class="wlsm-form-control" id="wlsm_father_phone" placeholder="<?php esc_attr_e( 'Enter Guardian\'s Phone Number', 'school-management' ); ?>" value="">
					</div>
					<?php if ($school_registration_parent_occupation OR empty($school_id)): ?>
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_father_occupation" class="wlsm-font-bold">
							<?php esc_html_e( 'Guardian\'s Occupation', 'school-management' ); ?>:
						</label>
						<input type="text" name="father_occupation" class="wlsm-form-control" id="wlsm_father_occupation" placeholder="<?php esc_attr_e( 'Enter Guardian\'s Occupation', 'school-management' ); ?>" value="">
					</div>
					<?php endif ?>
				</div>

				<div class="wlsm-row">
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_mother_name" class="wlsm-font-bold">
							<?php esc_html_e( 'Guardian\'s Physical Address', 'school-management' ); ?>:
						</label>
						<input type="text" name="mother_name" class="wlsm-form-control" id="wlsm_mother_name" placeholder="<?php esc_attr_e( 'Enter Guardian\'s Physical Address', 'school-management' ); ?>" value="">
					</div>
					<div class="wlsm-form-group wlsm-col-4">
						<label for="wlsm_mother_phone" class="wlsm-font-bold">
							<?php esc_html_e( 'Guardian\'s Workplace Address', 'school-management' ); ?>:
						</label>
						<input type="text" name="mother_phone" class="wlsm-form-control" id="wlsm_mother_phone" placeholder="<?php esc_attr_e( 'Enter Guardian\'s Workplace Address', 'school-management' ); ?>" value="">
					</div>
					
					<div class="wlsm-form-group wlsm-col-4">
						<div class="wlsm-parent-id-proof-box">
							<div class="wlsm-parent-id-proof-section">
								<label for="wlsm_parent_id_proof" class="wlsm-font-bold">
									<?php esc_html_e( 'Upload Guardian\'s NRC(PDF)', 'school-management' ); ?>:
								</label>
								<div class="custom-file mb-3">
									<input type="file" class="custom-file-input" id="wlsm_parent_id_proof" name="parent_id_proof" accept=".pdf">
						</div>
					</div>
				</div>
			</div>
			<?php endif ?>
					</div>
				
				

			<?php if (isset($school_registration_survey) OR empty($school_id)): ?>
			<!-- Student survey Detail -->
			<div class="wlsm-form-section">
				<div class="wlsm-row">
					<div class="wlsm-col-12">
						<div class="wlsm-form-sub-heading wlsm-font-bold">
							<?php esc_html_e('How Did you Hear about Us?', 'school-management'); ?>
						</div>
					
				<?php
				foreach ($survey_list as $key => $value) {
					reset($survey_list);
				?>
					<div class="wlsm-form-check">
						<input class="wlsm-form-check-input" type="radio" name="survey" id="wlsm_survey_<?php echo esc_attr($value); ?>" value="<?php echo esc_attr($key); ?>" <?php checked($key, $survey, true); ?>>
						<label class="wlsm-ml-1 wlsm-form-check-label wlsm-font-bold" for="wlsm_survey_<?php echo esc_attr($value); ?>">
							<?php echo esc_html($value); ?>
						</label>
					</div>
				<?php
				}
				?>
			</div>
			<?php endif ?>
			

			<div class="wlsm-form-section wlsm-mt-2">
				<?php
				if ( get_option( 'wlsm_gdpr_enable' ) ) {
				?>
				<div class="wlsm-form-group wlsm-row wlsm-mb-2">
					<input type="checkbox" name="gdpr" id="wlsm_gdpr" class="wlsm-mt-1 wlsm-mr-1" value="1">
					<label class="wlsm-font-bold wlsm-d-i-block wlsm-ml-1" for="wlsm_gdpr">
						<?php echo wp_kses( WLSM_Config::gdpr_text_registration(), array( 'a' => array( 'href' => array() ) ) );?>
					</label>
				</div>
				<?php
				}
				?>
			</div>

			<div class="wlsm-border-top wlsm-pt-2 wlsm-mt-1">
				<button class="button wlsm-btn btn btn-primary" type="submit" id="wlsm-submit-registration-btn">
					<?php esc_html_e( 'Submit', 'school-management' ); ?>
				</button>
			</div>

		</form>

	</div>
</div>
<?php
return ob_get_clean();
