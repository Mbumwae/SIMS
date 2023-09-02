<?php
defined( 'ABSPATH' ) || die();

require_once WLSM_PLUGIN_DIR_PATH . 'admin/inc/manager/WLSM_LM.php';

class WLSM_Helper {
	public static function currency_symbols() {
		return array(
			'AED' => '&#1583;.&#1573;',
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;',
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;',
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;',
			'BIF' => '&#70;&#66;&#117;',
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;',
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;',
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;',
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;',
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;',
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;',
			'GNF' => '&#70;&#71;',
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;',
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => '&#1593;.&#1583;',
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;',
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;',
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;',
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;',
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;',
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;',
			'MAD' => '&#1583;.&#1605;.',
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;',
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;',
			'MRO' => '&#85;&#77;',
			'MUR' => '&#8360;',
			'MVR' => '.&#1923;',
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;',
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;',
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;',
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;',
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;',
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;',
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => '',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XDR' => '',
			'XOF' => '',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;',
			'ZWL' => '&#90;&#36;'
		);
	}

	public static function hostel_type_list() {
		return array(
			'male' => esc_html__( 'Male', 'school-management' ),
			'female'  => esc_html__( 'Female', 'school-management' ),
		);
	}


	public static function date_formats() {
		return array(
			'd-m-Y' => 'dd-mm-yyyy',
			'd/m/Y' => 'dd/mm/yyyy',
			'Y-m-d' => 'yyyy-mm-dd',
			'Y/m/d' => 'yyyy/mm/dd',
			'm-d-Y' => 'mm-dd-yyyy',
			'm/d/Y' => 'mm/dd/yyyy',
		);
	}

	public static function gender_list() {
		return array(
			'male'   => esc_html__( 'Male', 'school-management' ),
			'female' => esc_html__( 'Female', 'school-management' ),
		);
	}
	public static function title_list() {
		return array(
			'Mr'   => esc_html__( 'Mr', 'school-management' ),
			'Mrs' => esc_html__( 'Mrs', 'school-management' ),
			'Miss' => esc_html__( 'Miss', 'school-management' ),
		);
	}
	public static function marital_list() {
		return array(
			'Single'   => esc_html__( 'Single', 'school-management' ),
			'Married' => esc_html__( 'Married', 'school-management' ),
			'Divorced' => esc_html__( 'Divorced', 'school-management' ),
		);
	}
	public static function const_list() {
    return array(
        'Bahati' => esc_html__( 'Bahati', 'school-management' ),
        'Bangweulu' => esc_html__( 'Bangweulu', 'school-management' ),
        'Bwacha' => esc_html__( 'Bwacha', 'school-management' ),
        'Bwana Mkubwa' => esc_html__( 'Bwana Mkubwa', 'school-management' ),
        'Bweengwa' => esc_html__( 'Bweengwa', 'school-management' ),
        'Chadiza' => esc_html__( 'Chadiza', 'school-management' ),
        'Chama North' => esc_html__( 'Chama North', 'school-management' ),
        'Chama South' => esc_html__( 'Chama South', 'school-management' ),
        'Chasefu' => esc_html__( 'Chasefu', 'school-management' ),
        'Chavuma' => esc_html__( 'Chavuma', 'school-management' ),
        'Chawama' => esc_html__( 'Chawama', 'school-management' ),
        'Chembe' => esc_html__( 'Chembe', 'school-management' ),
        'Chienge' => esc_html__( 'Chienge', 'school-management' ),
        'Chifubu' => esc_html__( 'Chifubu', 'school-management' ),
        'Chifunabuli' => esc_html__( 'Chifunabuli', 'school-management' ),
        'Chikankata' => esc_html__( 'Chikankata', 'school-management' ),
        'Chilanga' => esc_html__( 'Chilanga', 'school-management' ),
        'Chililabombwe' => esc_html__( 'Chililabombwe', 'school-management' ),
        'Chilubi' => esc_html__( 'Chilubi', 'school-management' ),
        'Chimbamilonga' => esc_html__( 'Chimbamilonga', 'school-management' ),
        'Chimwemwe' => esc_html__( 'Chimwemwe', 'school-management' ),
        'Chingola' => esc_html__( 'Chingola', 'school-management' ),
        'Chinsali' => esc_html__( 'Chinsali', 'school-management' ),
        'Chipangali' => esc_html__( 'Chipangali', 'school-management' ),
        'Chipata Central' => esc_html__( 'Chipata Central', 'school-management' ),
        'Chipili' => esc_html__( 'Chipili', 'school-management' ),
        'Chirundu' => esc_html__( 'Chirundu', 'school-management' ),
        'Chisamba' => esc_html__( 'Chisamba', 'school-management' ),
        'Chitambo' => esc_html__( 'Chitambo', 'school-management' ),
        'Choma' => esc_html__( 'Choma', 'school-management' ),
        'Chongwe' => esc_html__( 'Chongwe', 'school-management' ),
        'Dundumwenzi' => esc_html__( 'Dundumwenzi', 'school-management' ),
        'Feira' => esc_html__( 'Feira', 'school-management' ),
        'Gwembe' => esc_html__( 'Gwembe', 'school-management' ),
        'Ikelengi' => esc_html__( 'Ikelengi', 'school-management' ),
        'Isoka' => esc_html__( 'Isoka', 'school-management' ),
        'Itezhi-Tezhi' => esc_html__( 'Itezhi-Tezhi', 'school-management' ),
        'Kabompo' => esc_html__( 'Kabompo', 'school-management' ),
        'Kabushi' => esc_html__( 'Kabushi', 'school-management' ),
        'Kabwata' => esc_html__( 'Kabwata', 'school-management' ),
        'Kabwe Central' => esc_html__( 'Kabwe Central', 'school-management' ),
        'Kafue' => esc_html__( 'Kafue', 'school-management' ),
        'Kafulafuta' => esc_html__( 'Kafulafuta', 'school-management' ),
        'Kalabo Central' => esc_html__( 'Kalabo Central', 'school-management' ),
        'Kalomo Central' => esc_html__( 'Kalomo Central', 'school-management' ),
        'Kalulushi' => esc_html__( 'Kalulushi', 'school-management' ),
        'Kamfinsa' => esc_html__( 'Kamfinsa', 'school-management' ),
        'Kanchibiya' => esc_html__( 'Kanchibiya', 'school-management' ),
        'Kankoyo' => esc_html__( 'Kankoyo', 'school-management' ),
        'Kantanshi' => esc_html__( 'Kantanshi', 'school-management' ),
        'Kanyama' => esc_html__( 'Kanyama', 'school-management' ),
        'Kaoma' => esc_html__( 'Kaoma', 'school-management' ),
        'Kapiri Mposhi' => esc_html__( 'Kapiri Mposhi', 'school-management' ),
        'Kapoche' => esc_html__( 'Kapoche', 'school-management' ),
        'Kaputa' => esc_html__( 'Kaputa', 'school-management' ),
        'Kasama' => esc_html__( 'Kasama', 'school-management' ),
        'Kasempa' => esc_html__( 'Kasempa', 'school-management' ),
        'Kasenengwa' => esc_html__( 'Kasenengwa', 'school-management' ),
        'Katombola' => esc_html__( 'Katombola', 'school-management' ),
        'Katuba' => esc_html__( 'Katuba', 'school-management' ),
        'Kaumbwe' => esc_html__( 'Kaumbwe', 'school-management' ),
        'Kawambwa' => esc_html__( 'Kawambwa', 'school-management' ),
        'Keembe' => esc_html__( 'Keembe', 'school-management' ),
        'Kwacha' => esc_html__( 'Kwacha', 'school-management' ),
        'Liuwa' => esc_html__( 'Liuwa', 'school-management' ),
        'Livingstone' => esc_html__( 'Livingstone', 'school-management' ),
        'Luampa' => esc_html__( 'Luampa', 'school-management' ),
        'Luangeni' => esc_html__( 'Luangeni', 'school-management' ),
        'Luanshya' => esc_html__( 'Luanshya', 'school-management' ),
        'Luapula' => esc_html__( 'Luapula', 'school-management' ),
        'Lubansenshi' => esc_html__( 'Lubansenshi', 'school-management' ),
        'Luena' => esc_html__( 'Luena', 'school-management' ),
        'Lufubu' => esc_html__( 'Lufubu', 'school-management' ),
        'Lufwanyama' => esc_html__( 'Lufwanyama', 'school-management' ),
        'Lukashya' => esc_html__( 'Lukashya', 'school-management' ),
        'Lukulu East' => esc_html__( 'Lukulu East', 'school-management' ),
        'Lumezi' => esc_html__( 'Lumezi', 'school-management' ),
        'Lundazi' => esc_html__( 'Lundazi', 'school-management' ),
        'Lunte' => esc_html__( 'Lunte', 'school-management' ),
        'Lupososhi' => esc_html__( 'Lupososhi', 'school-management' ),
        'Lusaka Central' => esc_html__( 'Lusaka Central', 'school-management' ),
        'Mafinga' => esc_html__( 'Mafinga', 'school-management' ),
        'Magoye' => esc_html__( 'Magoye', 'school-management' ),
        'Malambo' => esc_html__( 'Malambo', 'school-management' ),
        'Malole' => esc_html__( 'Malole', 'school-management' ),
        'Mambilima' => esc_html__( 'Mambilima', 'school-management' ),
        'Mandevu' => esc_html__( 'Mandevu', 'school-management' ),
        'Mangango' => esc_html__( 'Mangango', 'school-management' ),
        'Mansa Central' => esc_html__( 'Mansa Central', 'school-management' ),
        'Manyinga' => esc_html__( 'Manyinga', 'school-management' ),
        'Mapatizya' => esc_html__( 'Mapatizya', 'school-management' ),
        'Masaiti' => esc_html__( 'Masaiti', 'school-management' ),
        'Matero' => esc_html__( 'Matero', 'school-management' ),
        'Mazabuka Central' => esc_html__( 'Mazabuka Central', 'school-management' ),
        'Mbabala' => esc_html__( 'Mbabala', 'school-management' ),
        'Mbala' => esc_html__( 'Mbala', 'school-management' ),
        'Mfuwe' => esc_html__( 'Mfuwe', 'school-management' ),
        'Milanzi' => esc_html__( 'Milanzi', 'school-management' ),
        'Milenge' => esc_html__( 'Milenge', 'school-management' ),
        'Mitete' => esc_html__( 'Mitete', 'school-management' ),
        'Mkaika' => esc_html__( 'Mkaika', 'school-management' ),
        'Mkushi North' => esc_html__( 'Mkushi North', 'school-management' ),
        'Mkushi South' => esc_html__( 'Mkushi South', 'school-management' ),
        'Mongu Central' => esc_html__( 'Mongu Central', 'school-management' ),
        'Monze' => esc_html__( 'Monze', 'school-management' ),
        'Moomba' => esc_html__( 'Moomba', 'school-management' ),
        'Mpika' => esc_html__( 'Mpika', 'school-management' ),
        'Mpongwe' => esc_html__( 'Mpongwe', 'school-management' ),
        'Mporokoso' => esc_html__( 'Mporokoso', 'school-management' ),
        'Mpulungu' => esc_html__( 'Mpulungu', 'school-management' ),
        'Msanzala' => esc_html__( 'Msanzala', 'school-management' ),
        'Muchinga' => esc_html__( 'Muchinga', 'school-management' ),
        'Mufulira' => esc_html__( 'Mufulira', 'school-management' ),
        'Mufumbwe' => esc_html__( 'Mufumbwe', 'school-management' ),
        'Mulobezi' => esc_html__( 'Mulobezi', 'school-management' ),
        'Mumbwa' => esc_html__( 'Mumbwa', 'school-management' ),
        'Munali' => esc_html__( 'Munali', 'school-management' ),
        'Mwandi' => esc_html__( 'Mwandi', 'school-management' ),
        'Mwansabombwe' => esc_html__( 'Mwansabombwe', 'school-management' ),
        'Mwembeshi' => esc_html__( 'Mwembeshi', 'school-management' ),
        'Mwense' => esc_html__( 'Mwense', 'school-management' ),
        'Mwinilunga' => esc_html__( 'Mwinilunga', 'school-management' ),
        'Nakonde' => esc_html__( 'Nakonde', 'school-management' ),
        'Nalikwanda' => esc_html__( 'Nalikwanda', 'school-management' ),
        'Nalolo' => esc_html__( 'Nalolo', 'school-management' ),
        'Namwala' => esc_html__( 'Namwala', 'school-management' ),
        'Nangoma' => esc_html__( 'Nangoma', 'school-management' ),
        'Nchanga' => esc_html__( 'Nchanga', 'school-management' ),
        'Nchelenge' => esc_html__( 'Nchelenge', 'school-management' ),
        'Ndola Central' => esc_html__( 'Ndola Central', 'school-management' ),
        'Nkana' => esc_html__( 'Nkana', 'school-management' ),
        'Nkeyema' => esc_html__( 'Nkeyema', 'school-management' ),
        'Nyimba' => esc_html__( 'Nyimba', 'school-management' ),
        'Pambashe' => esc_html__( 'Pambashe', 'school-management' ),
        'Pemba' => esc_html__( 'Pemba', 'school-management' ),
        'Petauke Central' => esc_html__( 'Petauke Central', 'school-management' ),
        'Roan' => esc_html__( 'Roan', 'school-management' ),
        'Rufunsa' => esc_html__( 'Rufunsa', 'school-management' ),
        'Senanga' => esc_html__( 'Senanga', 'school-management' ),
        'Senga Hill' => esc_html__( 'Senga Hill', 'school-management' ),
        'Serenje' => esc_html__( 'Serenje', 'school-management' ),
        'Sesheke' => esc_html__( 'Sesheke', 'school-management' ),
        'Shang’ombo' => esc_html__( 'Shang’ombo', 'school-management' ),
        'Shiwa Ng\'andu' => esc_html__( 'Shiwa Ng\'andu', 'school-management' ),
        'Siavonga' => esc_html__( 'Siavonga', 'school-management' ),
        'Sikongo' => esc_html__( 'Sikongo', 'school-management' ),
        'Sinazongwe' => esc_html__( 'Sinazongwe', 'school-management' ),
        'Sinda' => esc_html__( 'Sinda', 'school-management' ),
        'Sioma' => esc_html__( 'Sioma', 'school-management' ),
        'Solwezi Central' => esc_html__( 'Solwezi Central', 'school-management' ),
        'Solwezi East' => esc_html__( 'Solwezi East', 'school-management' ),
        'Solwezi West' => esc_html__( 'Solwezi West', 'school-management' ),
        'Vubwi' => esc_html__( 'Vubwi', 'school-management' ),
        'Wusakile' => esc_html__( 'Wusakile', 'school-management' ),
        'Zambezi East' => esc_html__( 'Zambezi East', 'school-management' ),
        'Zambezi West' => esc_html__( 'Zambezi West', 'school-management' ),

        	);
	}
	
        
	public static function institution_list() {
		return array(
			'MTTI'   => esc_html__( 'Mongu Trades Training Institute', 'school-management' ),
		);
	}
	
	public static function department_list() {
		return array(
			'Business Department'   => esc_html__( 'Business Department', 'school-management' ),
			'female' => esc_html__( 'Female', 'school-management' ),
		);
	}
	
	public static function ministry_list() {
		return array(
			'MoTS'   => esc_html__( 'Ministry of Technology & Science', 'school-management' ),
		);
	}
	
	public static function position_list() {
		return array(
			'Lecturer'   => esc_html__( 'Lecturer', 'school-management' ),
		);
	}
	
	
	public static function intake_list() {
		return array(
			'January'   => esc_html__( 'January', 'school-management' ),
			'May' => esc_html__( 'May', 'school-management' ),
			'September'  => esc_html__( 'September', 'school-management' ),
		);
	}
	
	public static function survey_list() {
		return array(
			'google'    => esc_html__( 'Google', 'school-management' ),
			'facebook'  => esc_html__( 'Facebook', 'school-management' ),
			'radio' => esc_html__( 'Radio', 'school-management' ),
			'friends'   => esc_html__( 'Friends & Family', 'school-management' ),
			'tv'    => esc_html__( 'TV', 'school-management' ),
			'flyer'     => esc_html__( 'Flyer', 'school-management' ),
			'other'     => esc_html__( 'Other', 'school-management' ),
		);
	}

	public static function student_type() {
		return array(
			'New Student' => esc_html__( 'New Student', 'school-management' ),
			'Returning Student' => esc_html__( 'Returning Student', 'school-management' ),
		);
	}
	
	public static function mode_list() {
		return array(
			'Full-Time' => esc_html__( 'Full-Time', 'school-management' ),
			'odfl' => esc_html__( 'ODFL', 'school-management' ),
		);
	}
	
	public static function relationship_list() {
		return array(
			'Father' => esc_html__( 'Father', 'school-management' ),
			'Mother' => esc_html__( 'Mother', 'school-management' ),
			'Uncle' => esc_html__( 'Uncle', 'school-management' ),
			'Auntie' => esc_html__( 'Auntie', 'school-management' ),
			'Grandmother' => esc_html__( 'Garandmother', 'school-management' ),
			'Grandfather' => esc_html__( 'Grandfather', 'school-management' ),
			'Sibling' => esc_html__( 'Sibling', 'school-management' ),
			'Husband' => esc_html__( 'Husband', 'school-management' ),
			'Wife' => esc_html__( 'Wife', 'school-management' ),
			'Self' => esc_html__( 'Self', 'school-management' ),
		
		);
	}
	
	public static function city_list() {
    return array(
        'Chadiza' => esc_html__( 'Chadiza', 'school-management' ),
        'Chama' => esc_html__( 'Chama', 'school-management' ),
        'Chavuma' => esc_html__( 'Chavuma', 'school-management' ),
        'Chembe' => esc_html__( 'Chembe', 'school-management' ),
        'Chibombo' => esc_html__( 'Chibombo', 'school-management' ),
        'Chiengi' => esc_html__( 'Chiengi', 'school-management' ),
        'Chikankata' => esc_html__( 'Chikankata', 'school-management' ),
        'Chilanga' => esc_html__( 'Chilanga', 'school-management' ),
        'Chililabombwe' => esc_html__( 'Chililabombwe', 'school-management' ),
        'Chilubi' => esc_html__( 'Chilubi', 'school-management' ),
        'Chingola' => esc_html__( 'Chingola', 'school-management' ),
        'Chinsali' => esc_html__( 'Chinsali', 'school-management' ),
        'Chipili' => esc_html__( 'Chipili', 'school-management' ),
        'Chirundu' => esc_html__( 'Chirundu', 'school-management' ),
        'Chisamba' => esc_html__( 'Chisamba', 'school-management' ),
        'Chitambo' => esc_html__( 'Chitambo', 'school-management' ),
        'Choma' => esc_html__( 'Choma', 'school-management' ),
        'Chongwe' => esc_html__( 'Chongwe', 'school-management' ),
        'Gwembe' => esc_html__( 'Gwembe', 'school-management' ),
        'Ikelenge' => esc_html__( 'Ikelenge', 'school-management' ),
        'Isoka' => esc_html__( 'Isoka', 'school-management' ),
        'Itezhi-Tezhi' => esc_html__( 'Itezhi-Tezhi', 'school-management' ),
        'Kabompo' => esc_html__( 'Kabompo', 'school-management' ),
        'Kabwe' => esc_html__( 'Kabwe', 'school-management' ),
        'Kafue' => esc_html__( 'Kafue', 'school-management' ),
        'Kalabo' => esc_html__( 'Kalabo', 'school-management' ),
        'Kalomo' => esc_html__( 'Kalomo', 'school-management' ),
        'Kalulushi' => esc_html__( 'Kalulushi', 'school-management' ),
        'Kaoma' => esc_html__( 'Kaoma', 'school-management' ),
        'Kapiri Mposhi' => esc_html__( 'Kapiri Mposhi', 'school-management' ),
        'Kaputa' => esc_html__( 'Kaputa', 'school-management' ),
        'Kasama' => esc_html__( 'Kasama', 'school-management' ),
        'Kasempa' => esc_html__( 'Kasempa', 'school-management' ),
        'Katete' => esc_html__( 'Katete', 'school-management' ),
        'Kawambwa' => esc_html__( 'Kawambwa', 'school-management' ),
        'Kazungula' => esc_html__( 'Kazungula', 'school-management' ),
        'Kitwe' => esc_html__( 'Kitwe', 'school-management' ),
        'Limulunga' => esc_html__( 'Limulunga', 'school-management' ),
        'Livingstone' => esc_html__( 'Livingstone', 'school-management' ),
        'Luampa' => esc_html__( 'Luampa', 'school-management' ),
        'Luangwa' => esc_html__( 'Luangwa', 'school-management' ),
        'Luano' => esc_html__( 'Luano', 'school-management' ),
        'Luanshya' => esc_html__( 'Luanshya', 'school-management' ),
        'Luena' => esc_html__( 'Luena', 'school-management' ),
        'Lufwanyama' => esc_html__( 'Lufwanyama', 'school-management' ),
        'Lukulu' => esc_html__( 'Lukulu', 'school-management' ),
        'Lundazi' => esc_html__( 'Lundazi', 'school-management' ),
        'Lunga' => esc_html__( 'Lunga', 'school-management' ),
        'Lusaka' => esc_html__( 'Lusaka', 'school-management' ),
        'Luwingu' => esc_html__( 'Luwingu', 'school-management' ),
        'Mafinga' => esc_html__( 'Mafinga', 'school-management' ),
        'Mambwe' => esc_html__( 'Mambwe', 'school-management' ),
        'Mansa' => esc_html__( 'Mansa', 'school-management' ),
        'Manyinga' => esc_html__( 'Manyinga', 'school-management' ),
        'Masaiti' => esc_html__( 'Masaiti', 'school-management' ),
        'Mazabuka' => esc_html__( 'Mazabuka', 'school-management' ),
        'Mbala' => esc_html__( 'Mbala', 'school-management' ),
        'Milenge' => esc_html__( 'Milenge', 'school-management' ),
        'Mitete' => esc_html__( 'Mitete', 'school-management' ),
        'Mkushi' => esc_html__( 'Mkushi', 'school-management' ),
        'Mongu' => esc_html__( 'Mongu', 'school-management' ),
        'Monze' => esc_html__( 'Monze', 'school-management' ),
        'Mpika' => esc_html__( 'Mpika', 'school-management' ),
        'Mpongwe' => esc_html__( 'Mpongwe', 'school-management' ),
        'Mporokoso' => esc_html__( 'Mporokoso', 'school-management' ),
        'Mpulungu' => esc_html__( 'Mpulungu', 'school-management' ),
        'Mufulira' => esc_html__( 'Mufulira', 'school-management' ),
        'Mufumbwe' => esc_html__( 'Mufumbwe', 'school-management' ),
        'Mulobezi' => esc_html__( 'Mulobezi', 'school-management' ),
        'Mumbwa' => esc_html__( 'Mumbwa', 'school-management' ),
        'Mungwi' => esc_html__( 'Mungwi', 'school-management' ),
        'Mwandi' => esc_html__( 'Mwandi', 'school-management' ),
        'Mwansabombwe' => esc_html__( 'Mwansabombwe', 'school-management' ),
        'Mwense' => esc_html__( 'Mwense', 'school-management' ),
        'Mwinilunga' => esc_html__( 'Mwinilunga', 'school-management' ),
        'Nakonde' => esc_html__( 'Nakonde', 'school-management' ),
        'Nalikwanda' => esc_html__( 'Nalikwanda', 'school-management' ),
        'Nalolo' => esc_html__( 'Nalolo', 'school-management' ),
        'Namwala' => esc_html__( 'Namwala', 'school-management' ),
        'Nchelenge' => esc_html__( 'Nchelenge', 'school-management' ),
        'Ndola' => esc_html__( 'Ndola', 'school-management' ),
        'Ngabwe' => esc_html__( 'Ngabwe', 'school-management' ),
        'Nkeyema' => esc_html__( 'Nkeyema', 'school-management' ),
        'Nsama' => esc_html__( 'Nsama', 'school-management' ),
        'Nyimba' => esc_html__( 'Nyimba', 'school-management' ),
        'Pemba' => esc_html__( 'Pemba', 'school-management' ),
        'Petauke' => esc_html__( 'Petauke', 'school-management' ),
        'Rufunsa' => esc_html__( 'Rufunsa', 'school-management' ),
        'Samfya' => esc_html__( 'Samfya', 'school-management' ),
        'Senanga' => esc_html__( 'Senanga', 'school-management' ),
        'Serenje' => esc_html__( 'Serenje', 'school-management' ),
        'Sesheke' => esc_html__( 'Sesheke', 'school-management' ),
        'Shangombo' => esc_html__( 'Shangombo', 'school-management' ),
        'Shibuyunji' => esc_html__( 'Shibuyunji', 'school-management' ),
        'Shiwangandu' => esc_html__( 'Shiwangandu', 'school-management' ),
        'Siavonga' => esc_html__( 'Siavonga', 'school-management' ),
        'Sikongo' => esc_html__( 'Sikongo', 'school-management' ),
        'Sinazongwe' => esc_html__( 'Sinazongwe', 'school-management' ),
        'Sinda' => esc_html__( 'Sinda', 'school-management' ),
        'Sioma' => esc_html__( 'Sioma', 'school-management' ),
        'Solwezi' => esc_html__( 'Solwezi', 'school-management' ),
        'Vubwi' => esc_html__( 'Vubwi', 'school-management' ),
        'Zambezi' => esc_html__( 'Zambezi', 'school-management' ),
        'Zimba' => esc_html__( 'Zimba', 'school-management' ),
        'Chipata' => esc_html__( 'Chipata', 'school-management' ),
        'Kafulafuta' => esc_html__( 'Kafulafuta', 'school-management' ),
        'Lundazi' => esc_html__( 'Lundazi', 'school-management' ),
        'Nakonde' => esc_html__( 'Nakonde', 'school-management' ),
        'Nyimba' => esc_html__( 'Nyimba', 'school-management' ),
        'Chilanga' => esc_html__( 'Chilanga', 'school-management' ),
        'Mkushi' => esc_html__( 'Mkushi', 'school-management' ),
        'Mungwi' => esc_html__( 'Mungwi', 'school-management' ),
        'Mwinilunga' => esc_html__( 'Mwinilunga', 'school-management' ),
        'Namwala' => esc_html__( 'Namwala', 'school-management' ),
        'Chavuma' => esc_html__( 'Chavuma', 'school-management' ),
        'Gwembe' => esc_html__( 'Gwembe', 'school-management' ),
        'Kanchibiya' => esc_html__( 'Kanchibiya', 'school-management' ),
        'Luampa' => esc_html__( 'Luampa', 'school-management' ),
        'Lumezi' => esc_html__( 'Lumezi', 'school-management' ),
        'Lusangazi' => esc_html__( 'Lusangazi', 'school-management' ),
        'Mwense' => esc_html__( 'Mwense', 'school-management' ),
        'Nchelenge' => esc_html__( 'Nchelenge', 'school-management' ),
        'Nsama' => esc_html__( 'Nsama', 'school-management' ),
        'Serenje' => esc_html__( 'Serenje', 'school-management' ),
        'Shiwang' => esc_html__( 'Shiwang', 'school-management' ),
        'Chibombo' => esc_html__( 'Chibombo', 'school-management' ),
        'Chikankata' => esc_html__( 'Chikankata', 'school-management' ),
        'Kalumbila' => esc_html__( 'Kalumbila', 'school-management' ),
        'Kasempa' => esc_html__( 'Kasempa', 'school-management' ),
        'Mafinga' => esc_html__( 'Mafinga', 'school-management' ),
        'Mpongwe' => esc_html__( 'Mpongwe', 'school-management' ),
        'Sioma' => esc_html__( 'Sioma', 'school-management' ),
        'Chingola' => esc_html__( 'Chingola', 'school-management' ),
        'Kabwe' => esc_html__( 'Kabwe', 'school-management' ),
        'Kalulushi' => esc_html__( 'Kalulushi', 'school-management' ),
        'Kansanshi' => esc_html__( 'Kansanshi', 'school-management' ),
        'Lufwanyama' => esc_html__( 'Lufwanyama', 'school-management' ),
        'Lusaka' => esc_html__( 'Lusaka', 'school-management' ),
        'Mpongwe' => esc_html__( 'Mpongwe', 'school-management' ),
        'Ndola' => esc_html__( 'Ndola', 'school-management' ),
        'Solwezi' => esc_html__( 'Solwezi', 'school-management' ),
        'Zambezi' => esc_html__( 'Zambezi', 'school-management' ),
        'Chasefu' => esc_html__( 'Chasefu', 'school-management' ),
        'Chipangali' => esc_html__( 'Chipangali', 'school-management' ),
        'Kasenengwa' => esc_html__( 'Kasenengwa', 'school-management' ),
        'Chienge' => esc_html__( 'Chienge', 'school-management' ),
        'Chifunabuli' => esc_html__( 'Chifunabuli', 'school-management' ),
        'Mushindamo' => esc_html__( 'Mushindamo', 'school-management' ),
        'Lavushimanda' => esc_html__( 'Lavushimanda', 'school-management' ),
        'Lunte' => esc_html__( 'Lunte', 'school-management' ),
        'Lupososhi' => esc_html__( 'Lupososhi', 'school-management' ),
        'Senga Hill' => esc_html__( 'Senga Hill', 'school-management' ),
    );
}


	public static function sponsorship_list() {
		return array(
			'GRZ'  => esc_html__( 'TEVET Bursary (GRZ)', 'school-management' ),
			'CDF'  => esc_html__( 'CDF', 'school-management' ),
			'CAM'  => esc_html__( 'CAMFED', 'school-management' ),
			'CAR'  => esc_html__( 'CARITAS', 'school-management' ),
			'TEVET Fund'  => esc_html__( 'TEVET Fund', 'school-management' ),
			'AP'  => esc_html__( 'African Parks', 'school-management' ),
			'WP'  => esc_html__( 'Western Power', 'school-management' ),
			'WW'  => esc_html__( 'Western Water', 'school-management' ),
			'OBL'  => esc_html__( 'OBL', 'school-management' ),
			'Self'  => esc_html__( 'Self', 'school-management' ),
		);
	}
	
	public static function province_list() {
		return array(
			'Central' => esc_html__( 'Central', 'school-management' ),
			'Copperbelt' => esc_html__( 'Copperbelt', 'school-management' ),
			'Eastern' => esc_html__( 'Eastern', 'school-management' ),
			'Luapula' => esc_html__( 'Luapula', 'school-management' ),
			'Lusaka' => esc_html__( 'Lusaka', 'school-management' ),
			'Muchinga' => esc_html__( 'Muchinga', 'school-management' ),
			'North-Western' => esc_html__('North-Western', 'school-management' ),
			'Northern' => esc_html__('Northern', 'school-management'),
			'Southern' => esc_html__('Southern', 'school-management'),
			'Western' => esc_html__('Western', 'school-management'),
		);
	}
	
	public static function nationality_list() {
		return array(
			'Zambia' => esc_html__( 'Zambia', 'school-management' ),
				);
	}
	
	public static function term_list() {
		return array(
			'Term I' => esc_html__( 'Term I', 'school-management' ),
			'Term II' => esc_html__( 'Term II', 'school-management' ),
			'Term III' => esc_html__( 'Term III', 'school-management' ),
				);
	}

		public static function search_field_list() {
	return array(
		'admission_number' => esc_html__( 'Admission Number', 'school-management' ),
		'name'             => esc_html__( 'Name', 'school-management' ),
		'blood_group'      => esc_html__( 'Sponsorship', 'school-management' ),
		'city'             => esc_html__( 'District', 'school-management' ),
		'religion'         => esc_html__( 'Intake', 'school-management' ),
		'caste'            => esc_html__( 'Mode of Study', 'school-management' ),
		'consti'           => esc_html__( 'Constituency', 'school-management' ),
		'note'             => esc_html__( 'Term', 'school-management' ),
		'is_active'        => esc_html__( 'Status', 'school-management' ),
	);
}



	public static function invoice_search_field_list() {
		return array(
			'invoice_number'    => esc_html__( 'Invoice Number', 'school-management' ),
			'invoice_title'     => esc_html__( 'Invoice Title', 'school-management' ),
			'date_issued'       => esc_html__( 'Date Issued', 'school-management' ),
			'due_date'          => esc_html__( 'Due Date', 'school-management' ),
			'status'            => esc_html__( 'Status (Paid, Unpaid, Partially Paid)', 'school-management' ),
			'name'              => esc_html__( 'Student Name', 'school-management' ),
			'admission_number'  => esc_html__( 'Admission Number', 'school-management' ),
			'enrollment_number' => esc_html__( 'Enrollment Number', 'school-management' ),
			'phone'             => esc_html__( 'Phone', 'school-management' ),
			'email'             => esc_html__( 'Email', 'school-management' ),
			'father_name'       => esc_html__( 'Father\'s Name', 'school-management' ),
			'father_phone'      => esc_html__( 'Father\'s Phone', 'school-management' ),
		);
	}

	public static function attendance_status() {
		return array(
			'h'  => esc_html__( 'Undefined', 'school-management' ),
			'p' => esc_html__( 'Present', 'school-management' ),
			'a' => esc_html__( 'Absent', 'school-management' ),
			's' => esc_html__( 'Sick', 'school-management' ),
		);
	}

	public static function subject_type_list() {
		return array(
			'theory'     => esc_html__( 'Theory', 'school-management' ),
			'practical'  => esc_html__( 'Practical', 'school-management' ),
			'practical'  => esc_html__( 'Combined', 'school-management' ),
		);
	}

	public static function get_subject_type_text( $key ) {
		if ( isset( self::subject_type_list()[ $key ] ) ) {
			return self::subject_type_list()[ $key ];
		}

		return '';
	}

	public static function meeting_host() {
		return 'me';
	}

	public static function generate_random_code( $length = 10 ) {
		$default_code = bin2hex( random_bytes( $length / 2 ) );
		return $default_code;
	}

	public static function get_meeting_type( $key, $empty = '-' ) {
		$meeting_types = self::meeting_types();
		if ( isset( $meeting_types[ $key ] ) ) {
			return $meeting_types[ $key ];
		}
		return '-';
	}

	public static function meeting_types() {
		return array(
			8 => esc_html__( 'Recurring Class with fixed time', 'school-management' ),
			2 => esc_html__( 'Scheduled Class', 'school-management' ),
		);
	}

	public static function meeting_recurrence_types() {
		return array(
			'1' => esc_html__( 'Daily', 'school-management' ),
			'2' => esc_html__( 'Weekly', 'school-management' ),
			'3' => esc_html__( 'Monthly', 'school-management' ),
		);
	}

	public static function meeting_approval_types() {
		return array(
			'0' => esc_html__( 'Automatically approve.', 'school-management' ),
			'1' => esc_html__( 'Manually approve.', 'school-management' ),
			'2' => esc_html__( 'No registration required.', 'school-management' ),
		);
	}

	public static function meeting_registration_types() {
		return array(
			'1' => esc_html__( 'Attendees register once and can attend any of the occurrences.', 'school-management' ),
			'2' => esc_html__( 'Attendees need to register for each occurrence to attend.', 'school-management' ),
			'3' => esc_html__( 'Attendees register once and can choose one or more occurrences to attend.', 'school-management' ),
		);
	}

	public static function meeting_weekly_days() {
		return array(
			'1' => esc_html__( 'Monday', 'school-management' ),
			'2' => esc_html__( 'Tuesday', 'school-management' ),
			'3' => esc_html__( 'Wednesday', 'school-management' ),
			'4' => esc_html__( 'Thursday', 'school-management' ),
			'5' => esc_html__( 'Friday', 'school-management' ),
		);
	}

	public static function days_list( $day = '' ) {
		$base_date = 4;

		if ( is_numeric( $day ) ) {
			$base_date += $day;

			$format_base_date = str_pad( $base_date, 2, '0', STR_PAD_LEFT );

			return date_i18n( 'l', strtotime( $format_base_date . '-01-1970' ) );
		}

		$weekdays = array();

		for ( $i = 1; $i <= 7; $i++ ) {
			$base_date++;

			$format_base_date = str_pad( $base_date, 2, '0', STR_PAD_LEFT );

			$weekdays[ $i ] = date_i18n( 'l', strtotime( $format_base_date . '-01-1970' ) );
		}

		return $weekdays;
	}

	public static function fee_period_list() {
		return array(
			'one-time'    => esc_html__( 'One Time', 'school-management' ),
			'monthly'     => esc_html__( 'Monthly', 'school-management' ),
			'quarterly'   => esc_html__( 'Termly', 'school-management' ),
			'annually'    => esc_html__( 'Annually (12 Months)', 'school-management' ),
		);
	}

	public static function due_date_period() {
		return array(
			'daily'    => esc_html__( 'Daily', 'school-management' ),
			'monthly'  => esc_html__( 'Monthly', 'school-management' ),
			'annually' => esc_html__( 'Annually', 'school-management' ),
		);
	}

	public static function get_certificate_property( $key ) {
		if ( array_key_exists( $key, self::certificate_properties() ) ) {
			return self::certificate_properties()[ $key ];
		}
		return '';
	}

	public static function certificate_properties() {
		return array(
			'left'        => esc_html__( 'Position X', 'school-management' ),
			'top'         => esc_html__( 'Position Y', 'school-management' ),
			'font-weight' => esc_html__( 'Font Weight', 'school-management' ),
			'font-size'   => esc_html__( 'Font Size', 'school-management' ),
			'width'       => esc_html__( 'Width', 'school-management' ),
			'height'      => esc_html__( 'Height', 'school-management' ),
		);
	}

	public static function get_certificate_field_label( $key ) {
		if ( array_key_exists( $key, self::certificate_field_labels() ) ) {
			return self::certificate_field_labels()[ $key ];
		}
		return '';
	}

	public static function certificate_field_labels() {
		return array(
			'name'               => esc_html__( 'Name', 'school-management' ),
			'certificate-number' => esc_html__( 'Certificate Number', 'school-management' ),
			'certificate-title'  => esc_html__( 'Certificate Title', 'school-management' ),
			'photo'              => esc_html__( 'Photo', 'school-management' ),
			'qcode'              => esc_html__( 'QR Code', 'school-management' ),
			'enrollment-number'  => esc_html__( 'Enrollment Number', 'school-management' ),
			'admission-number'   => esc_html__( 'Admission Number', 'school-management' ),
			'roll-number'        => esc_html__( 'Roll Number', 'school-management' ),
			'session-label'      => esc_html__( 'Session Label', 'school-management' ),
			'session-start-date' => esc_html__( 'Session Start Date', 'school-management' ),
			'session-end-date'   => esc_html__( 'Session End Date', 'school-management' ),
			'session-start-year' => esc_html__( 'Session Start Year', 'school-management' ),
			'session-end-year'   => esc_html__( 'Session End Year', 'school-management' ),
			'class'              => esc_html__( 'Class', 'school-management' ),
			'section'            => esc_html__( 'Section', 'school-management' ),
			'dob'                => esc_html__( 'Date of Birth', 'school-management' ),
			'caste'              => esc_html__( 'Caste', 'school-management' ),
			'blood-group'        => esc_html__( 'Blood Group', 'school-management' ),
			'father-name'        => esc_html__( 'Father\'s Name', 'school-management' ),
			'mother-name'        => esc_html__( 'Mother\'s Name', 'school-management' ),
			'class-teacher'      => esc_html__( 'Class Teacher', 'school-management' ),
			'school-name'        => esc_html__( 'School Name', 'school-management' ),
			'school-phone'       => esc_html__( 'School Phone', 'school-management' ),
			'school-email'       => esc_html__( 'School Email', 'school-management' ),
			'school-address'     => esc_html__( 'School Address', 'school-management' ),
			'school-logo'        => esc_html__( 'School Logo', 'school-management' ),
		);
	}

	public static function get_certificate_field_type( $key ) {
		if ( array_key_exists( $key, self::certificate_field_types() ) ) {
			return self::certificate_field_types()[ $key ];
		}
		return 'text';
	}

	public static function certificate_field_types() {
		return array(
			'left'        => 'number',
			'top'         => 'number',
			'font-weight' => 'number',
			'font-size'   => 'number',
			'width'       => 'number',
			'height'      => 'number'
		);
	}

	public static function get_certificate_place_holder( $key, $school_id = '' ) {
		if ( array_key_exists( $key, self::certificate_place_holders( $school_id ) ) ) {
			return self::certificate_place_holders( $school_id )[ $key ];
		}
		return '';
	}

	public static function certificate_place_holders( $school_id = '' ) {
		$school_name     = '';
		$school_phone    = '';
		$school_email    = '';
		$school_address  = '';
		$school_logo_url = '';

		if ( $school_id ) {
			$school         = WLSM_M_School::fetch_school( $school_id );
			$school_name    = esc_html( WLSM_M_School::get_label_text( $school->label ) );
			$school_phone   = esc_html( WLSM_M_School::get_phone_text( $school->phone ) );
			$school_email   = esc_html( WLSM_M_School::get_email_text( $school->email ) );
			$school_address = esc_html( WLSM_M_School::get_address_text( $school->address ) );

			$settings_general = WLSM_M_Setting::get_settings_general( $school_id );
			$school_logo      = $settings_general['school_logo'];
			if ( ! empty ( $school_logo ) ) {
				$school_logo_url = esc_url( wp_get_attachment_url( $school_logo ) );
			}
		}

		return array(
			'name'               => '[STUDENT_NAME]',
			'certificate-number' => '[CERTIFICATE_NO]',
			'certificate-title'  => '[CERTIFICATE_TITLE]',
			'photo'              => WLSM_PLUGIN_URL . 'assets/images/student.jpg',
			'qcode'              => WLSM_PLUGIN_URL . 'assets/images/qcode.png',
			'enrollment-number'  => '[ENROLLMENT_NO]',
			'admission-number'   => '[ADMISSION_NO]',
			'roll-number'        => '[ROLL_NO]',
			'session-label'      => '[SESSION_LABEL]',
			'session-start-date' => '[START_DATE]',
			'session-end-date'   => '[END_DATE]',
			'session-start-year' => '[START_YEAR]',
			'session-end-year'   => '[END_YEAR]',
			'class'              => '[CLASS]',
			'section'            => '[SECTION]',
			'dob'                => '[DATE_OF_BIRTH]',
			'caste'              => '[CASTE]',
			'blood-group'        => '[BLOOD_GROUP]',
			'father-name'        => '[FATHER_NAME]',
			'mother-name'        => '[MOTHER_NAME]',
			'class-teacher'      => '[CLASS_TEACHER]',
			'school-name'        => $school_name,
			'school-phone'       => $school_phone,
			'school-email'       => $school_email,
			'school-address'     => $school_address,
			'school-logo'        => $school_logo_url,
		);
	}

	public static function get_certificate_place_holder_type( $key ) {
		if ( array_key_exists( $key, self::certificate_place_holder_types() ) ) {
			return self::certificate_place_holder_types()[ $key ];
		}
		return 'text';
	}

	public static function certificate_place_holder_types() {
		return array(
			'name'               => 'text',
			'certificate-number' => 'text',
			'certificate-title'  => 'text',
			'photo'              => 'image',
			'qcode'              => 'image',
			'enrollment-number'  => 'text',
			'admission-number'   => 'text',
			'roll-number'        => 'text',
			'session-label'      => 'text',
			'session-start-date' => 'text',
			'session-end-date'   => 'text',
			'session-start-year' => 'text',
			'session-end-year'   => 'text',
			'class'              => 'text',
			'section'            => 'text',
			'dob'                => 'text',
			'caste'              => 'text',
			'blood-group'        => 'text',
			'father-name'        => 'text',
			'mother-name'        => 'text',
			'class-teacher'      => 'text',
			'school-name'        => 'text',
			'school-phone'       => 'text',
			'school-email'       => 'text',
			'school-address'     => 'text',
			'school-logo'        => 'image',
		);
	}

	public static function charts() {
		return array(
			'monthly_admissions'     => esc_html__( 'Monthly Admissions', 'school-management' ),
			'monthly_payments'       => esc_html__( 'Monthly Payments', 'school-management' ),
			'monthly_income_expense' => esc_html__( 'Monthly Income / Expense', 'school-management' )
		);
	}

	public static function chart_types() {
		return array(
			'line',
			'bar',
			'radar',
			'pie',
			'doughnut',
			'polarArea'
		);
	}

	public static function default_chart_types() {
		return array(
			'monthly_admissions'     => 'bar',
			'monthly_payments'       => 'bar',
			'monthly_income_expense' => 'bar'
		);
	}

	public static function get_certificate_dynamic_fields() {
		return array(
			'name' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'certificate-number' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '58',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '24',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '14',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'certificate-title' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '190',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '24',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '20',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'photo' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '460',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '319',
						'unit'  => 'pt'
					),
					'width' => array(
						'value' => '98',
						'unit'  => 'pt'
					),
					'height' => array(
						'value' => '135',
						'unit'  => 'pt'
					)
				),
				'type' => 'image'
			),
			'qcode' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '325',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '319',
						'unit'  => 'pt'
					),
					'width' => array(
						'value' => '98',
						'unit'  => 'pt'
					),
					'height' => array(
						'value' => '135',
						'unit'  => 'pt'
					)
				),
				'type' => 'image'
			),
			'enrollment-number' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '119',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '355',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '14',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'admission-number' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '150',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '150',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'roll-number' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '82',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '394',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '14',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'session-label' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'session-start-date' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '297',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'session-end-date' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '412',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'session-start-year' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '375',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '275',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'session-end-year' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '375',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '275',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'class' => array(
				'enable' => 1,
				'props'  => array(
					'left' => array(
						'value' => '363',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '594',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'section' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '300',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '300',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'dob' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'caste' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'blood-group' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'father-name' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'mother-name' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'class-teacher' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '187',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '544',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '18',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'school-name' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '16',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'school-phone' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '12',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'school-email' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '12',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'school-address' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '165',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '643',
						'unit'  => 'pt'
					),
					'font-weight' => array(
						'value' => '600',
						'unit'  => ''
					),
					'font-size' => array(
						'value' => '12',
						'unit'  => 'pt'
					)
				),
				'type' => 'text'
			),
			'school-logo' => array(
				'enable' => 0,
				'props'  => array(
					'left' => array(
						'value' => '150',
						'unit'  => 'pt'
					),
					'top' => array(
						'value' => '50',
						'unit'  => 'pt'
					),
					'width' => array(
						'value' => '90',
						'unit'  => 'pt'
					),
					'height' => array(
						'value' => '90',
						'unit'  => 'pt'
					)
				),
				'type' => 'image'
			)
		);
	}

	public static function get_image_mime() {
		return array('image/jpg', 'image/jpeg', 'image/png');
	}

	public static function get_csv_mime() {
		return array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
	}

	public static function get_attachment_mime() {
		return array('image/jpg', 'image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/x-rar-compressed', 'application/octet-stream', 'application/zip', 'application/octet-stream', 'application/x-zip-compressed', 'multipart/x-zip', 'video/x-flv', 'video/mp4', 'application/x-mpegURL', 'video/MP2T', 'video/3gpp', 'video/quicktime', 'video/x-msvideo', 'video/x-ms-wmv');
	}

	public static function is_valid_file( $file, $type = 'attachment' ) {
		$get_mime = 'get_' . $type . '_mime';

		if ( extension_loaded( 'fileinfo' ) ) {
			$finfo = finfo_open( FILEINFO_MIME_TYPE );
			$mime  = finfo_file( $finfo, $file['tmp_name'] );
			finfo_close( $finfo );

		} else {
			$mime = $file['type'];
		}

		if ( ! in_array( $mime, self::$get_mime() ) ) {
			return false;
		}

		return true;
	}

	public static function calculate_grade( $marks_grades, $percentage ) {
		$percentage = absint( $percentage );
		foreach ( $marks_grades as $mark_grade ) {
			if ( $mark_grade['min'] <= $percentage && $percentage <= $mark_grade['max'] ) {
				return $mark_grade['grade'];
			}
		}

		return '';
	}

	public static function inquiry_success_message_placeholders() {
		return array(
			'[NAME]'  => esc_html__( 'Inquisitor Name', 'school-management' ),
			'[PHONE]' => esc_html__( 'Inquisitor Phone', 'school-management' ),
			'[EMAIL]' => esc_html__( 'Inquisitor Email', 'school-management' ),
			'[CLASS]' => esc_html__( 'Inquisitor Year of Study', 'school-management' )
		);
	}

	public static function registration_success_message_placeholders() {
		return array(
			'[NAME]'  => esc_html__( 'Student Name', 'school-management' ),
			'[PHONE]' => esc_html__( 'Phone', 'school-management' ),
			'[EMAIL]' => esc_html__( 'Email', 'school-management' ),
			'[CLASS]' => esc_html__( 'Year of Study', 'school-management' )
		);
	}

	public static function enqueue_datatable_assets() {
		wp_enqueue_style( 'jquery-dataTables', WLSM_PLUGIN_URL . 'assets/css/datatable/jquery.dataTables.min.css' );
		wp_enqueue_style( 'buttons-bootstrap4', WLSM_PLUGIN_URL . 'assets/css/datatable/buttons.bootstrap4.min.css' );

		wp_enqueue_script( 'dataTables-buttons', WLSM_PLUGIN_URL . 'assets/js/datatable/dataTables.buttons.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'buttons-bootstrap4', WLSM_PLUGIN_URL . 'assets/js/datatable/buttons.bootstrap4.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'jszip', WLSM_PLUGIN_URL . 'assets/js/datatable/jszip.min.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'vfs-fonts', WLSM_PLUGIN_URL . 'assets/js/datatable/vfs_fonts.js', array( 'jquery' ), true, true );
		wp_enqueue_script( 'buttons-html5', WLSM_PLUGIN_URL . 'assets/js/datatable/buttons.html5.min.js', array( 'jszip' ), true, true );
	}

	public static function check_buffer( $show_buffer_error = true ) {
		$buffer = ob_get_clean();
		if ( ! empty( $buffer ) ) {
			if ( $show_buffer_error ) {
				throw new Exception( $buffer );
			}

			throw new Exception( esc_html__( 'Unexpected error occurred!', 'school-management' ) );
		}
	}

	public static function is_php_incompatible_for_meetings( $version = '7.1.0' ) {
		return ( ! ( version_compare( PHP_VERSION, $version ) >= 0 ) );
	}

	public static function check_demo() {
		if ( WLSM_DEMO_MODE ) {
			wp_send_json_error( 'This action is disabled in demo.' );
		}
	}

	public static function lm_valid() {
		$wlsm_lm     = WLSM_LM::get_instance();
		$wlsm_lm_val = $wlsm_lm->is_valid();
		if ( isset( $wlsm_lm_val ) && $wlsm_lm_val ) {
			return true;
		}
		return false;
	}
}
