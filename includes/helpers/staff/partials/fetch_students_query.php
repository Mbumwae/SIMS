<?php
defined( 'ABSPATH' ) || die();

$searchBy = $filter['search_by'];
$where    = '';

if ( 'search_by_class' === $searchBy ) {
	$class_id   = $filter['class_id'];
	$section_id = $filter['section_id'];

	if ( $class_id ) {
		$where .= ' AND cs.class_id = ' . absint( $class_id );
		if ( $section_id ) {
			$where .= ' AND se.ID = ' . absint( $section_id );
		}
	}

} else {
	$search_field   = $filter['search_field'];
	$search_keyword = $filter['search_keyword'];

	if ( $search_field ) {
		if ( 'admission_number' == $search_field ) {
			$where .= ' AND sr.admission_number LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'id_number' == $search_field ) {
			$where .= ' AND sr.id_number LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'name' == $search_field ) {
			$where .= ' AND sr.name LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'religion' == $search_field ) {
			$where .= ' AND sr.religion LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'note' == $search_field ) {
			$where .= ' AND sr.note LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'consti' == $search_field ) {
			$where .= ' AND sr.consti LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		}  else if ( 'address' == $search_field ) {
			$where .= ' AND sr.address LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'city' == $search_field ) {
			$where .= ' AND sr.city LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'state' == $search_field ) {
			$where .= ' AND sr.state LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'country' == $search_field ) {
			$where .= ' AND sr.country LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'blood_group' == $search_field ) {
			$where .= ' AND sr.blood_group LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'caste' == $search_field ) {
			$where .= ' AND sr.caste LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'login_email' == $search_field ) {
			$where .= ' AND u.user_email LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'username' == $search_field ) {
			$where .= ' AND u.user_login LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		} else if ( 'admission_date' == $search_field ) {
			require_once WLSM_PLUGIN_DIR_PATH . 'includes/helpers/WLSM_Config.php';
			$search_keyword = DateTime::createFromFormat( WLSM_Config::date_format(), sanitize_text_field( $search_keyword ) );
			if ( ! empty( $search_keyword ) ) {
				$search_keyword = $search_keyword->format( 'Y-m-d' );
			}
			$where .= ' AND sr.admission_date LIKE "%' . sanitize_text_field( $search_keyword ) . '%"';
		}
	}
}
