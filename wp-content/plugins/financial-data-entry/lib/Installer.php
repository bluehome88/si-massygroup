<?php

namespace FinancialDataEntry\Lib;

class Installer{

	public static function setup(){
		global $wpdb;
        $income_statement_information = $wpdb->prefix . 'income_statement_information';
        $balance_sheet_information = $wpdb->prefix . 'balance_sheet_information';
        $balance_sheet_quality_measures = $wpdb->prefix . 'balance_sheet_quality_measures';
        $cash_flow_information = $wpdb->prefix . 'cash_flow_information';
        $financial_years = $wpdb->prefix . 'financial_years';
        $isi_fyears = $wpdb->prefix . 'isi_fyears';
        $bsi_fyears = $wpdb->prefix . 'bsi_fyears';
        $bsqm_fyears = $wpdb->prefix . 'bsqm_fyears';
        $cfi_fyears = $wpdb->prefix . 'cfi_fyears';

        $financial_years_sql = "CREATE TABLE " . $financial_years . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                year varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $income_statement_information_sql = "CREATE TABLE " . $income_statement_information . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                entry_title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $balance_sheet_information_sql = "CREATE TABLE " . $balance_sheet_information . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                entry_title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $balance_sheet_quality_measures_sql = "CREATE TABLE " . $balance_sheet_quality_measures . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                entry_title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $cash_flow_information_sql = "CREATE TABLE " . $cash_flow_information . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                entry_title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $isi_fyears_sql = "CREATE TABLE " . $isi_fyears . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                fy_id int(11) unsigned NOT NULL,
                isi_id int(11) unsigned NOT NULL,
                value varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (fy_id) REFERENCES wp_financial_years(id),
                FOREIGN KEY (isi_id) REFERENCES wp_income_statement_information(id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $bsi_fyears_sql = "CREATE TABLE " . $bsi_fyears . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                fy_id int(11) unsigned NOT NULL,
                bsi_id int(11) unsigned NOT NULL,
                value varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (fy_id) REFERENCES wp_financial_years(id),
                FOREIGN KEY (bsi_id) REFERENCES wp_balance_sheet_information(id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $bsqm_fyears_sql = "CREATE TABLE " . $bsqm_fyears . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                fy_id int(11) unsigned NOT NULL,
                bsqm_id int(11) unsigned NOT NULL,
                value varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (fy_id) REFERENCES wp_financial_years(id),
                FOREIGN KEY (bsqm_id) REFERENCES wp_balance_sheet_quality_measures(id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
        $cfi_fyears_sql = "CREATE TABLE " . $cfi_fyears . " (
                id int(11) unsigned NOT NULL AUTO_INCREMENT,
                fy_id int(11) unsigned NOT NULL,
                cfi_id int(11) unsigned NOT NULL,
                value varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (fy_id) REFERENCES wp_financial_years(id),
                FOREIGN KEY (cfi_id) REFERENCES wp_cash_flow_information(id)
                )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        
        dbDelta($financial_years_sql);
        dbDelta($income_statement_information_sql);
        dbDelta($balance_sheet_information_sql);
        dbDelta($balance_sheet_quality_measures_sql);
        dbDelta($cash_flow_information_sql);
        dbDelta($isi_fyears_sql);
        dbDelta($bsi_fyears_sql);
        dbDelta($bsqm_fyears_sql);
        dbDelta($cfi_fyears_sql);
        
        $fyears = array(
            '2015',
            '2016',
            '2017',
            '2018',
            '2019'
        );

        foreach ($fyears as $fyear) {
            $wpdb->insert( $financial_years, array( 'year' => $fyear));
        }

        $income_statement_information_records = array(
            'Third party revenue',
            'Finance costs',
            'Share results of associates & joint ventures',
            'Proﬁt before tax',
            'Effective tax rate',
            'Proﬁt/(loss) for the year',
            'Total earnings per share ($.¢)'
        );

        foreach ($income_statement_information_records as $record) {
            $wpdb->insert( $income_statement_information, array( 'entry_title' => $record));
        }

        $balance_sheet_information_records = array(
            'Non current assets',
            'Current assets',
            'Total assets',
            'Non current liabilities',
            'Current liabilities',
            'Total liabilities',
            'Shareholder’s equity',
            'Non-controlling interests',
            'Equity',
            'Cash',
            'Debt'
        );

        foreach ($balance_sheet_information_records as $record) {
            $wpdb->insert( $balance_sheet_information, array( 'entry_title' => $record));
        }

        $balance_sheet_quality_measures_records = array(
            'Working Capital',
            'Current Ratio',
            'Quick Ratio',
            'Total debt to shareholder’s equity',
            'Total debt to shareholder’s equity & debt'
        );

        foreach ($balance_sheet_quality_measures_records as $record) {
            $wpdb->insert( $balance_sheet_quality_measures, array( 'entry_title' => $record));
        }

        $cash_flow_information_records = array(
            'Cash ﬂow from operating activities',
            'Cash ﬂow from investing activities',
            'Cash ﬂow from ﬁnancing activities',
            'Net increase/(decrease) in cash',
            'Before exchange rate changes'
        );

        foreach ($cash_flow_information_records as $record) {
            $wpdb->insert( $cash_flow_information, array( 'entry_title' => $record));
        }

        $isi_fyears_records = array(
            0  => array('fy_id'  => 1,'isi_id' => 1,'value'  => '11835836'),
            1  => array('fy_id'  => 2,'isi_id' => 1,'value'  => '11414917'),
            2  => array('fy_id'  => 3,'isi_id' => 1,'value'  => '11637149'),
            3  => array('fy_id'  => 4,'isi_id' => 1,'value'  => '11910053'),
            4  => array('fy_id'  => 5,'isi_id' => 1,'value'  => '11958666'),
            5  => array('fy_id'  => 1,'isi_id' => 2,'value'  => '81094'),
            6  => array('fy_id'  => 2,'isi_id' => 2,'value'  => '53104'),
            7  => array('fy_id'  => 3,'isi_id' => 2,'value'  => '55604'),
            8  => array('fy_id'  => 4,'isi_id' => 2,'value'  => '74056'),
            9  => array('fy_id'  => 5,'isi_id' => 2,'value'  => '72369'),
            10 => array('fy_id'  => 1,'isi_id' => 3,'value'  => '46032'),
            11 => array('fy_id'  => 2,'isi_id' => 3,'value'  => '29289'),
            12 => array('fy_id'  => 3,'isi_id' => 3,'value'  => '68993'),
            13 => array('fy_id'  => 4,'isi_id' => 3,'value'  => '78853'),
            14 => array('fy_id'  => 5,'isi_id' => 3,'value'  => '65965'),
            15 => array('fy_id'  => 1,'isi_id' => 4,'value'  => '921541'),
            16 => array('fy_id'  => 2,'isi_id' => 4,'value'  => '885149'),
            17 => array('fy_id'  => 3,'isi_id' => 4,'value'  => '754292'),
            18 => array('fy_id'  => 4,'isi_id' => 4,'value'  => '874064'),
            19 => array('fy_id'  => 5,'isi_id' => 4,'value'  => '919236'),
            20 => array('fy_id'  => 1,'isi_id' => 5,'value'  => '27'),
            21 => array('fy_id'  => 2,'isi_id' => 5,'value'  => '31'),
            22 => array('fy_id'  => 3,'isi_id' => 5,'value'  => '36'),
            23 => array('fy_id'  => 4,'isi_id' => 5,'value'  => '35'),
            24 => array('fy_id'  => 5,'isi_id' => 5,'value'  => '33'),
            25 => array('fy_id'  => 1,'isi_id' => 6,'value'  => '668314'),
            26 => array('fy_id'  => 2,'isi_id' => 6,'value'  => '536160'),
            27 => array('fy_id'  => 3,'isi_id' => 6,'value'  => '411841'),
            28 => array('fy_id'  => 4,'isi_id' => 6,'value'  => '565475'),
            29 => array('fy_id'  => 5,'isi_id' => 6,'value'  => '613232'),
            30 => array('fy_id'  => 1,'isi_id' => 7,'value'  => '6.53'),
            31 => array('fy_id'  => 2,'isi_id' => 7,'value'  => '5.10'),
            32 => array('fy_id'  => 3,'isi_id' => 7,'value'  => '3.85'),
            33 => array('fy_id'  => 4,'isi_id' => 7,'value'  => '5.32'),
            34 => array('fy_id'  => 5,'isi_id' => 7,'value'  => '5.76')
        );

        $bsi_fyears_records = array(
            0  => array('fy_id'  => 1,'bsi_id' => 1,'value'  => '4572670'),
            1  => array('fy_id'  => 2,'bsi_id' => 1,'value'  => '4868757'),
            2  => array('fy_id'  => 3,'bsi_id' => 1,'value'  => '5003706'),
            3  => array('fy_id'  => 4,'bsi_id' => 1,'value'  => '5010838'),
            4  => array('fy_id'  => 5,'bsi_id' => 1,'value'  => '4985705'),
            5  => array('fy_id'  => 1,'bsi_id' => 2,'value'  => '5846091'),
            6  => array('fy_id'  => 2,'bsi_id' => 2,'value'  => '6172072'),
            7  => array('fy_id'  => 3,'bsi_id' => 2,'value'  => '8273425'),
            8  => array('fy_id'  => 4,'bsi_id' => 2,'value'  => '7466352'),
            9  => array('fy_id'  => 5,'bsi_id' => 2,'value'  => '7339368'),
            10 => array('fy_id'  => 1,'bsi_id' => 3,'value'  => '10418761'),
            11 => array('fy_id'  => 2,'bsi_id' => 3,'value'  => '11040829'),
            12 => array('fy_id'  => 3,'bsi_id' => 3,'value'  => '13277131'),
            13 => array('fy_id'  => 4,'bsi_id' => 3,'value'  => '12477190'),
            14 => array('fy_id'  => 5,'bsi_id' => 3,'value'  => '12325073'),
            15 => array('fy_id'  => 1,'bsi_id' => 4,'value'  => '2408065'),
            16 => array('fy_id'  => 2,'bsi_id' => 4,'value'  => '2503307'),
            17 => array('fy_id'  => 3,'bsi_id' => 4,'value'  => '2530141'),
            18 => array('fy_id'  => 4,'bsi_id' => 4,'value'  => '2467002'),
            19 => array('fy_id'  => 5,'bsi_id' => 4,'value'  => '2400675'),
            20 => array('fy_id'  => 1,'bsi_id' => 5,'value'  => '3251874'),
            21 => array('fy_id'  => 2,'bsi_id' => 5,'value'  => '3274463'),
            22 => array('fy_id'  => 3,'bsi_id' => 5,'value'  => '5368976'),
            23 => array('fy_id'  => 4,'bsi_id' => 5,'value'  => '4395030'),
            24 => array('fy_id'  => 5,'bsi_id' => 5,'value'  => '3977457'),
            25 => array('fy_id'  => 1,'bsi_id' => 6,'value'  => '5659939'),
            26 => array('fy_id'  => 2,'bsi_id' => 6,'value'  => '5777770'),
            27 => array('fy_id'  => 3,'bsi_id' => 6,'value'  => '7899117'),
            28 => array('fy_id'  => 4,'bsi_id' => 6,'value'  => '6862032'),
            29 => array('fy_id'  => 5,'bsi_id' => 6,'value'  => '6378132'),
            30 => array('fy_id'  => 1,'bsi_id' => 7,'value'  => '4522452'),
            31 => array('fy_id'  => 2,'bsi_id' => 7,'value'  => '5004710'),
            32 => array('fy_id'  => 3,'bsi_id' => 7,'value'  => '5137132'),
            33 => array('fy_id'  => 4,'bsi_id' => 7,'value'  => '5384821'),
            34 => array('fy_id'  => 5,'bsi_id' => 7,'value'  => '5713898'),
            35 => array('fy_id'  => 1,'bsi_id' => 8,'value'  => '236370'),
            36 => array('fy_id'  => 2,'bsi_id' => 8,'value'  => '258349'),
            37 => array('fy_id'  => 3,'bsi_id' => 8,'value'  => '240882'),
            38 => array('fy_id'  => 4,'bsi_id' => 8,'value'  => '230337'),
            39 => array('fy_id'  => 5,'bsi_id' => 8,'value'  => '233043'),
            40 => array('fy_id'  => 1,'bsi_id' => 9,'value'  => '4758822'),
            41 => array('fy_id'  => 2,'bsi_id' => 9,'value'  => '5263059'),
            42 => array('fy_id'  => 3,'bsi_id' => 9,'value'  => '5378014'),
            43 => array('fy_id'  => 4,'bsi_id' => 9,'value'  => '5615158'),
            44 => array('fy_id'  => 5,'bsi_id' => 9,'value'  => '5946941'),
            45 => array('fy_id'  => 1,'bsi_id' => 10,'value'  => '1679925'),
            46 => array('fy_id'  => 2,'bsi_id' => 10,'value'  => '2030126'),
            47 => array('fy_id'  => 3,'bsi_id' => 10,'value'  => '1565945'),
            48 => array('fy_id'  => 4,'bsi_id' => 10,'value'  => '1626132'),
            49 => array('fy_id'  => 5,'bsi_id' => 10,'value'  => '2073058'),
            50 => array('fy_id'  => 1,'bsi_id' => 11,'value'  => '2169760'),
            51 => array('fy_id'  => 2,'bsi_id' => 11,'value'  => '2217893'),
            52 => array('fy_id'  => 3,'bsi_id' => 11,'value'  => '2261946'),
            53 => array('fy_id'  => 4,'bsi_id' => 11,'value'  => '2320416'),
            54 => array('fy_id'  => 5,'bsi_id' => 11,'value'  => '2199712')
        );

        $bsqm_fyears_records = array(
            0  => array('fy_id'  => 1,'bsqm_id' => 1,'value'  => '2594217'),
            1  => array('fy_id'  => 2,'bsqm_id' => 1,'value'  => '2897609'),
            2  => array('fy_id'  => 3,'bsqm_id' => 1,'value'  => '2904449'),
            3  => array('fy_id'  => 4,'bsqm_id' => 1,'value'  => '3071322'),
            4  => array('fy_id'  => 5,'bsqm_id' => 1,'value'  => '3361911'),
            5  => array('fy_id'  => 1,'bsqm_id' => 2,'value'  => '1.80'),
            6  => array('fy_id'  => 2,'bsqm_id' => 2,'value'  => '1.88'),
            7  => array('fy_id'  => 3,'bsqm_id' => 2,'value'  => '1.54'),
            8  => array('fy_id'  => 4,'bsqm_id' => 2,'value'  => '1.70'),
            9  => array('fy_id'  => 5,'bsqm_id' => 2,'value'  => '1.85'),
            10 => array('fy_id'  => 1,'bsqm_id' => 3,'value'  => '1.32'),
            11 => array('fy_id'  => 2,'bsqm_id' => 3,'value'  => '1.40'),
            12 => array('fy_id'  => 3,'bsqm_id' => 3,'value'  => '1.25'),
            13 => array('fy_id'  => 4,'bsqm_id' => 3,'value'  => '1.32'),
            14 => array('fy_id'  => 5,'bsqm_id' => 3,'value'  => '1.46'),
            15 => array('fy_id'  => 1,'bsqm_id' => 4,'value'  => '48.0'),
            16 => array('fy_id'  => 2,'bsqm_id' => 4,'value'  => '44.3'),
            17 => array('fy_id'  => 3,'bsqm_id' => 4,'value'  => '44.0'),
            18 => array('fy_id'  => 4,'bsqm_id' => 4,'value'  => '43.1'),
            19 => array('fy_id'  => 5,'bsqm_id' => 4,'value'  => '38.5'),
            20 => array('fy_id'  => 1,'bsqm_id' => 5,'value'  => '32.4'),
            21 => array('fy_id'  => 2,'bsqm_id' => 5,'value'  => '30.7'),
            22 => array('fy_id'  => 3,'bsqm_id' => 5,'value'  => '30.6'),
            23 => array('fy_id'  => 4,'bsqm_id' => 5,'value'  => '30.1'),
            24 => array('fy_id'  => 5,'bsqm_id' => 5,'value'  => '27.8')
        );

        $cfi_fyears_records = array(
            0  => array('fy_id'  => 1,'cfi_id' => 1,'value'  => '984022'),
            1  => array('fy_id'  => 2,'cfi_id' => 1,'value'  => '996615'),
            2  => array('fy_id'  => 3,'cfi_id' => 1,'value'  => '991175'),
            3  => array('fy_id'  => 4,'cfi_id' => 1,'value'  => '735951'),
            4  => array('fy_id'  => 5,'cfi_id' => 1,'value'  => '805869'),
            5  => array('fy_id'  => 1,'cfi_id' => 2,'value'  => '409519'),
            6  => array('fy_id'  => 2,'cfi_id' => 2,'value'  => '470962'),
            7  => array('fy_id'  => 3,'cfi_id' => 2,'value'  => '1005937'),
            8  => array('fy_id'  => 4,'cfi_id' => 2,'value'  => '488033'),
            9  => array('fy_id'  => 5,'cfi_id' => 2,'value'  => '16942'),
            10 => array('fy_id'  => 1,'cfi_id' => 3,'value'  => '497419'),
            11 => array('fy_id'  => 2,'cfi_id' => 3,'value'  => '197166'),
            12 => array('fy_id'  => 3,'cfi_id' => 3,'value'  => '510597'),
            13 => array('fy_id'  => 4,'cfi_id' => 3,'value'  => '177947'),
            14 => array('fy_id'  => 5,'cfi_id' => 3,'value'  => '354078'),
            15 => array('fy_id'  => 1,'cfi_id' => 4,'value'  => '0'),
            16 => array('fy_id'  => 2,'cfi_id' => 4,'value'  => '0'),
            17 => array('fy_id'  => 3,'cfi_id' => 4,'value'  => '0'),
            18 => array('fy_id'  => 4,'cfi_id' => 4,'value'  => '0'),
            19 => array('fy_id'  => 5,'cfi_id' => 4,'value'  => '0'),
            20 => array('fy_id'  => 1,'cfi_id' => 5,'value'  => '77084'),
            21 => array('fy_id'  => 2,'cfi_id' => 5,'value'  => '328487'),
            22 => array('fy_id'  => 3,'cfi_id' => 5,'value'  => '525359'),
            23 => array('fy_id'  => 4,'cfi_id' => 5,'value'  => '69971'),
            24 => array('fy_id'  => 5,'cfi_id' => 5,'value'  => '468733')
        );

        foreach ($isi_fyears_records as $record) {
            $wpdb->insert( $isi_fyears, $record);
        }

        foreach ($bsi_fyears_records as $record) {
            $wpdb->insert( $bsi_fyears, $record);
        }

        foreach ($bsqm_fyears_records as $record) {
            $wpdb->insert( $bsqm_fyears, $record);
        }

        foreach ($cfi_fyears_records as $record) {
            $wpdb->insert( $cfi_fyears, $record);
        }

	}

	public static function deactivation(){
		global $wpdb;
        $income_statement_information = $wpdb->prefix . 'income_statement_information';
        $balance_sheet_information = $wpdb->prefix . 'balance_sheet_information';
        $balance_sheet_quality_measures = $wpdb->prefix . 'balance_sheet_quality_measures';
        $cash_flow_information = $wpdb->prefix . 'cash_flow_information';
        $financial_years = $wpdb->prefix . 'financial_years';
        $isi_fyears = $wpdb->prefix . 'isi_fyears';
        $bsi_fyears = $wpdb->prefix . 'bsi_fyears';
        $bsqm_fyears = $wpdb->prefix . 'bsqm_fyears';
        $cfi_fyears = $wpdb->prefix . 'cfi_fyears';

        $wpdb->query("DROP TABLE IF EXISTS $isi_fyears");
        $wpdb->query("DROP TABLE IF EXISTS $bsi_fyears");
        $wpdb->query("DROP TABLE IF EXISTS $bsqm_fyears");
        $wpdb->query("DROP TABLE IF EXISTS $cfi_fyears");
        $wpdb->query("DROP TABLE IF EXISTS $financial_years");
        $wpdb->query("DROP TABLE IF EXISTS $income_statement_information");
        $wpdb->query("DROP TABLE IF EXISTS $balance_sheet_information");
        $wpdb->query("DROP TABLE IF EXISTS $balance_sheet_quality_measures");
        $wpdb->query("DROP TABLE IF EXISTS $cash_flow_information");
	}
}