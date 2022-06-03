<?php
namespace AwsomeJobPortal\Lib;

class Installer{

	public static function setup(){
		global $wpdb;
        $sector_table = $wpdb->prefix . 'sector';
        $function_table = $wpdb->prefix . 'function';
        $job_title_table = $wpdb->prefix . 'job_title';
        $jobs_table = $wpdb->prefix . 'jobs';
        $career_registration_table = $wpdb->prefix . 'career_registrations';
        $job_applicant_table = $wpdb->prefix.'job_applicants';
        $applicant_work_status_table = $wpdb->prefix.'applicant_work_status';
        $applicant_work_history_table = $wpdb->prefix.'applicant_work_history';
        $applicant_education_history_table = $wpdb->prefix.'applicant_education_history';
        $applicant_additional_info_table = $wpdb->prefix.'applicant_additional_info';
        $job_requirement_table = $wpdb->prefix . 'job_requirements';
        $job_applicant_requirement_table = $wpdb->prefix.'job_applicant_requirement';

        $job_applicant_table_sql = "CREATE TABLE " . $job_applicant_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            job_id int(9) NOT NULL,
            first_name varchar(255),
            last_name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            area_code varchar(255),
            phone varchar(255),
            address_line_1 varchar(255),
            city varchar(255),
            state varchar(255),
            zip_code varchar(255),
            country varchar(255),
            citizen varchar(255),
            covering_letter text,
            cv_url varchar(255),
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            UNIQUE KEY id (id)
            );";

		$applicant_work_status_table_sql = "CREATE TABLE " . $applicant_work_status_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            applicant_id int(9) NOT NULL,
            available_start_date datetime,
            current_employment_status varchar(100),
            past_massy_employee varchar(25),
            past_massy_city varchar(255),
            past_massy_date datetime,
            current_base_salary varchar(255),
            other_benefits varchar(100),
            incentive_earned_last_year varchar(100),
            value_of_other_benefits varchar(100),
            tcc varchar(100),
            UNIQUE KEY id (id)
            );";

        $applicant_work_history_table_sql = "CREATE TABLE " . $applicant_work_history_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            applicant_id int(9) NOT NULL,
            employer_name varchar(255),
            employer_city varchar(255),
            employer_country varchar(255),
            position_held varchar(255),
            start_date datetime,
            currently_employed tinyint(1),
            finish_date datetime,
            duties text,
            reason_for_leaving text,
            employer_name_additional varchar(255),
            employer_city_additional varchar(255),
            employer_country_additional varchar(255),
            position_held_additional varchar(255),
            start_date_additional datetime,
            finish_date_additional datetime,
            employer_area_code varchar(255),
            employer_phone varchar(255),
            supervisor_first_name varchar(255),
            supervisor_last_name varchar(255),
            duties_additional text,
            reason_for_leaving_additional text,
            UNIQUE KEY id (id)
            );";
        
        $applicant_additional_info_table_sql = "CREATE TABLE " . $applicant_additional_info_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            applicant_id int(9) NOT NULL,
            criminal_offender varchar(25),
            offence_reasons text,
            employed_under_other_name varchar(25),
            reason_for_leaving text,
            UNIQUE KEY id (id)
            );";

        $applicant_education_history_table_sql = "CREATE TABLE " . $applicant_education_history_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            applicant_id int(9) NOT NULL,
            school_name varchar(255),
            school_degree varchar(255),
            school_graduated varchar(25),
            college_name varchar(255),
            college_degree varchar(255),
            college_graduated varchar(25),
            school_name_additional varchar(255),
            school_degree_additional varchar(255),
            school_graduated_additional varchar(25),
            college_name_additional varchar(255),
            college_degree_additional varchar(255),
            college_graduated_additional varchar(25),
            UNIQUE KEY id (id)
            );";
        
        $sector_table_sql = "CREATE TABLE " . $sector_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            sector_title varchar(255) NOT NULL,
            sector_icon varchar(255),
            UNIQUE KEY id (id)
            );";
        $function_table_sql = "CREATE TABLE " . $function_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            function_title varchar(255) NOT NULL,
            UNIQUE KEY id (id)
            );";
        $job_title_table_sql = "CREATE TABLE " . $job_title_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            title varchar(255) NOT NULL,
            UNIQUE KEY id (id)
            );";

        $jobs_table_sql = "CREATE TABLE " . $jobs_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            sector_id int(9) NOT NULL,
            function_id int(9) NOT NULL,
            job_title_id int(9) NOT NULL,
            job_title varchar(255),
            job_city varchar(255),
            job_country varchar(255) NOT NULL,
            job_to_date datetime NOT NULL,
            job_rate varchar(255),
            job_description text,
            short_description text,
            job_company text,
            job_status tinytext,
            key_hiring_contact_id int(9) NOT NULL,
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            UNIQUE KEY id (id)
            );";

        $job_requirement_table_sql = "CREATE TABLE " . $job_requirement_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            job_id int(9) NOT NULL,
            req_text text NOT NULL,
            UNIQUE KEY id (id)
            );";

        $job_applicant_requirement_table_sql = "CREATE TABLE " . $job_applicant_requirement_table . " (
                id int(9) NOT NULL AUTO_INCREMENT,
                applicant_id int(9) NOT NULL,
                job_requirement_id int(9) NOT NULL,
                is_check tinyint(1) DEFAULT 0,
                UNIQUE KEY id (id)
                );";

        $career_registration_sql = "CREATE TABLE " . $career_registration_table . " (
            id int(9) NOT NULL AUTO_INCREMENT,
            first_name varchar(255) NOT NULL,
            last_name varchar(255) NOT NULL,
            email varchar(255) NOT NULL,
            area_code varchar(255) NOT NULL,
            phone varchar(255) NOT NULL,
            address_line_1 varchar(255) NOT NULL,
            city varchar(255) NOT NULL,
            state varchar(255) NOT NULL,
            zip_code varchar(255) NOT NULL,
            country varchar(255) NOT NULL,
            citizen varchar(255),
            interest_in_massy text NOT NULL,
            additional_info text NOT NULL,
            cv_url varchar(255) NOT NULL,
            created_at TIMESTAMP,
            updated_at TIMESTAMP,
            UNIQUE KEY id (id)
            );";
        
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            
            // dbDelta($job_applicant_table_sql);
            // dbDelta($applicant_work_status_table_sql);
            // dbDelta($applicant_work_history_table_sql);
            // dbDelta($applicant_additional_info_table_sql);
            // dbDelta($applicant_education_history_table_sql);
            // dbDelta($sector_table_sql);
            // dbDelta($function_table_sql);
            // dbDelta($job_title_table_sql);
            // dbDelta($jobs_table_sql);
            // dbDelta($job_requirement_table_sql);
            // dbDelta($job_applicant_requirement_table_sql);
            // dbDelta($career_registration_sql);
            
	}

	public static function deactivation(){
		global $wpdb;
        $sector_table = $wpdb->prefix . 'sector';
        $function_table = $wpdb->prefix . 'function';
        $job_title_table = $wpdb->prefix . 'job_title';
        $jobs_table = $wpdb->prefix . 'jobs';
        $career_registration_table = $wpdb->prefix . 'career_registrations';
        $job_requirement_table = $wpdb->prefix . 'job_requirements';
        $job_applicant_requirement_table = $wpdb->prefix.'job_applicant_requirement';

        $job_applicant_table = $wpdb->prefix.'job_applicants';
        $applicant_work_status_table = $wpdb->prefix.'applicant_work_status';
        $applicant_work_history_table = $wpdb->prefix.'applicant_work_history';
        $applicant_education_history_table = $wpdb->prefix.'applicant_education_history';
        $applicant_additional_info_table = $wpdb->prefix.'applicant_additional_info';

        // $wpdb->query("DROP TABLE IF EXISTS $job_applicant_table");
        // $wpdb->query("DROP TABLE IF EXISTS $applicant_work_status_table");
        // $wpdb->query("DROP TABLE IF EXISTS $applicant_work_history_table");
        // $wpdb->query("DROP TABLE IF EXISTS $applicant_education_history_table");
        // $wpdb->query("DROP TABLE IF EXISTS $applicant_additional_info_table");
        // $wpdb->query("DROP TABLE IF EXISTS $job_requirement_table");
        // $wpdb->query("DROP TABLE IF EXISTS $job_applicant_requirement_table");
        // $wpdb->query("DROP TABLE IF EXISTS $sector_table");
        // $wpdb->query("DROP TABLE IF EXISTS $function_table");
        // $wpdb->query("DROP TABLE IF EXISTS $job_title_table");
        // $wpdb->query("DROP TABLE IF EXISTS $jobs_table");
        // $wpdb->query("DROP TABLE IF EXISTS $career_registration_table");

	}
}