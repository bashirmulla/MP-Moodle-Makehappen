<?php

// Globals.
global $USER, $CFG,$DB;
define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/trend_analysis_report/locallib.php');  // Include our function library.

define('PREFERRED_RENDERER_TARGET', RENDERER_TARGET_GENERAL);
require_login();

$homeurl    = new moodle_url('/local/mp_report/index.php');

if(!is_manager() && !is_admin() && !is_senior_manager() && !is_complieance()) {
    echo ("You are not authorized to view this page");
}

global $USER, $CFG,$DB;

$tableName  = get_string('accident_table','local_trend_analysis_report');

$query_con_str =" 1=1 ";
$filterData = get_requests();

if(!is_number($filterData['year'])) $filterData['year'] = date("Y");


echo html_writer:: start_tag('div',array('class'=>'table-responsive'));
$target_year_data = $DB->get_records_sql(" SELECT * FROM mdl_report_target WHERE year= ?",$filterData);
//echo '<pre>';
//print_r($target_year_data);
foreach($target_year_data as $rec) {
    $decode_data = json_decode($rec->data);
    if(!empty($decode_data))
    foreach($decode_data as $key2=>$rec2) {
//        echo '<pre>';
//        print_r($key2);
//        print_r($rec2);
        if (strcasecmp($key2,"Fatalities")==0) {
            $Q1_fat_target = $Q2_fat_target = $Q3_fat_target = $Q4_fat_target = 0;
            $k = 0;
            $fat_tar_jan=$fat_tar_feb=$fat_tar_mar=$fat_tar_apr=$fat_tar_may=$fat_tar_jun=$fat_tar_jul=$fat_tar_aug=$fat_tar_sep=$fat_tar_oct=$fat_tar_nov=$fat_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_fat_target = ($Q1_fat_target + $rec3);
                    if ($k == 1) $fat_tar_jan=$rec3;else if ($k == 2) $fat_tar_feb=$rec3;else if ($k == 3) $fat_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_fat_target = ($Q2_fat_target + $rec3);
                    if ($k == 4) $fat_tar_apr=$rec3;else if ($k == 5) $fat_tar_may=$rec3;else if ($k == 6) $fat_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_fat_target = ($Q3_fat_target + $rec3);
                    if ($k == 7) $fat_tar_jul=$rec3;else if ($k == 8) $fat_tar_aug=$rec3;else if ($k == 9) $fat_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_fat_target = ($Q4_fat_target + $rec3);
                    if ($k == 10) $fat_tar_oct=$rec3;else if ($k == 11) $fat_tar_nov=$rec3;else if ($k == 12) $fat_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Specific Injuries")==0) {
            $Q1_spe_target = 0;
            $Q2_spe_target = 0;
            $Q3_spe_target = 0;
            $Q4_spe_target = 0;

            $k = 0;
            $spe_tar_jan=$spe_tar_feb=$spe_tar_mar=$spe_tar_apr=$spe_tar_may=$spe_tar_jun=$spe_tar_jul=$spe_tar_aug=$spe_tar_sep=$spe_tar_oct=$spe_tar_nov=$spe_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_spe_target = ($Q1_spe_target + $rec3);
                    if ($k == 1) $spe_tar_jan=$rec3;else if ($k == 2) $spe_tar_feb=$rec3;else if ($k == 3) $spe_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_spe_target = ($Q2_spe_target + $rec3);
                    if ($k == 4) $spe_tar_apr=$rec3;else if ($k == 5) $spe_tar_may=$rec3;else if ($k == 6) $spe_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_spe_target = ($Q3_spe_target + $rec3);
                    if ($k == 7) $spe_tar_jul=$rec3;else if ($k == 8) $spe_tar_aug=$rec3;else if ($k == 9) $spe_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_spe_target = ($Q4_spe_target + $rec3);
                    if ($k == 10) $spe_tar_oct=$rec3;else if ($k == 11) $spe_tar_nov=$rec3;else if ($k == 12) $spe_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Over 7 day injury")==0) {
            $Q1_7day_target = 0;
            $Q2_7day_target = 0;
            $Q3_7day_target = 0;
            $Q4_7day_target = 0;

            $k = 0;
            $day7_tar_jan=$day7_tar_feb=$day7_tar_mar=$day7_tar_apr=$day7_tar_may=$day7_tar_jun=$day7_tar_jul=$day7_tar_aug=$day7_tar_sep=$day7_tar_oct=$day7_tar_nov=$day7_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_7day_target = ($Q1_7day_target + $rec3);
                    if ($k == 1) $day7_tar_jan=$rec3;else if ($k == 2) $day7_tar_feb=$rec3;else if ($k == 3) $day7_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_7day_target = ($Q2_7day_target + $rec3);
                    if ($k == 4) $day7_tar_apr=$rec3;else if ($k == 5) $day7_tar_may=$rec3;else if ($k == 6) $day7_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_7day_target = ($Q3_7day_target + $rec3);
                    if ($k == 7) $day7_tar_jul=$rec3;else if ($k == 8) $day7_tar_aug=$rec3;else if ($k == 9) $day7_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_7day_target = ($Q4_7day_target + $rec3);
                    if ($k == 10) $day7_tar_oct=$rec3;else if ($k == 11) $day7_tar_nov=$rec3;else if ($k == 12) $day7_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Occupational Diseases")==0) {
            $Q1_occu_target = 0;
            $Q2_occu_target = 0;
            $Q3_occu_target = 0;
            $Q4_occu_target = 0;

            $k = 0;
            $occu_tar_jan=$occu_tar_feb=$occu_tar_mar=$occu_tar_apr=$occu_tar_may=$occu_tar_jun=$occu_tar_jul=$occu_tar_aug=$occu_tar_sep=$occu_tar_oct=$occu_tar_nov=$occu_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_occu_target = ($Q1_occu_target + $rec3);
                    if ($k == 1) $occu_tar_jan=$rec3;else if ($k == 2) $occu_tar_feb=$rec3;else if ($k == 3) $occu_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_occu_target = ($Q2_occu_target + $rec3);
                    if ($k == 4) $occu_tar_apr=$rec3;else if ($k == 5) $occu_tar_may=$rec3;else if ($k == 6) $occu_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_occu_target = ($Q3_occu_target + $rec3);
                    if ($k == 7) $occu_tar_jul=$rec3;else if ($k == 8) $occu_tar_aug=$rec3;else if ($k == 9) $occu_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_occu_target = ($Q4_occu_target + $rec3);
                    if ($k == 10) $occu_tar_oct=$rec3;else if ($k == 11) $occu_tar_nov=$rec3;else if ($k == 12) $occu_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Dangerous Occurrences")==0) {
            $Q1_dan_target = 0;
            $Q2_dan_target = 0;
            $Q3_dan_target = 0;
            $Q4_dan_target = 0;

            $k = 0;
            $dan_tar_jan=$dan_tar_feb=$dan_tar_mar=$dan_tar_apr=$dan_tar_may=$dan_tar_jun=$dan_tar_jul=$dan_tar_aug=$dan_tar_sep=$dan_tar_oct=$dan_tar_nov=$dan_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_dan_target = ($Q1_dan_target + $rec3);
                    if ($k == 1) $dan_tar_jan=$rec3;else if ($k == 2) $dan_tar_feb=$rec3;else if ($k == 3) $dan_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_dan_target = ($Q2_dan_target + $rec3);
                    if ($k == 4) $dan_tar_apr=$rec3;else if ($k == 5) $dan_tar_may=$rec3;else if ($k == 6) $dan_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_dan_target = ($Q3_dan_target + $rec3);
                    if ($k == 7) $dan_tar_jul=$rec3;else if ($k == 8) $dan_tar_aug=$rec3;else if ($k == 9) $dan_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_dan_target = ($Q4_dan_target + $rec3);
                    if ($k == 10) $dan_tar_oct=$rec3;else if ($k == 11) $dan_tar_nov=$rec3;else if ($k == 12) $dan_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Non fatal accidents to non workers")==0) {
            $Q1_nonf_target = 0;
            $Q2_nonf_target = 0;
            $Q3_nonf_target = 0;
            $Q4_nonf_target = 0;

            $k = 0;
            $nonf_tar_jan=$nonf_tar_feb=$nonf_tar_mar=$nonf_tar_apr=$nonf_tar_may=$nonf_tar_jun=$nonf_tar_jul=$nonf_tar_aug=$nonf_tar_sep=$nonf_tar_oct=$nonf_tar_nov=$nonf_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_nonf_target = ($Q1_nonf_target + $rec3);
                    if ($k == 1) $nonf_tar_jan=$rec3;else if ($k == 2) $nonf_tar_feb=$rec3;else if ($k == 3) $nonf_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_nonf_target = ($Q2_nonf_target + $rec3);
                    if ($k == 4) $nonf_tar_apr=$rec3;else if ($k == 5) $nonf_tar_may=$rec3;else if ($k == 6) $nonf_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_nonf_target = ($Q3_nonf_target + $rec3);
                    if ($k == 7) $nonf_tar_jul=$rec3;else if ($k == 8) $nonf_tar_aug=$rec3;else if ($k == 9) $nonf_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_nonf_target = ($Q4_nonf_target + $rec3);
                    if ($k == 10) $nonf_tar_oct=$rec3;else if ($k == 11) $nonf_tar_nov=$rec3;else if ($k == 12) $nonf_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Gas Incident")==0) {
            $Q1_gas_target = 0;
            $Q2_gas_target = 0;
            $Q3_gas_target = 0;
            $Q4_gas_target = 0;

            $k = 0;
            $gas_tar_jan=$gas_tar_feb=$gas_tar_mar=$gas_tar_apr=$gas_tar_may=$gas_tar_jun=$gas_tar_jul=$gas_tar_aug=$gas_tar_sep=$gas_tar_oct=$gas_tar_nov=$gas_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_gas_target = ($Q1_gas_target + $rec3);
                    if ($k == 1) $gas_tar_jan=$rec3;else if ($k == 2) $gas_tar_feb=$rec3;else if ($k == 3) $gas_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_gas_target = ($Q2_gas_target + $rec3);
                    if ($k == 4) $gas_tar_apr=$rec3;else if ($k == 5) $gas_tar_may=$rec3;else if ($k == 6) $gas_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_gas_target = ($Q3_gas_target + $rec3);
                    if ($k == 7) $gas_tar_jul=$rec3;else if ($k == 8) $gas_tar_aug=$rec3;else if ($k == 9) $gas_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_gas_target = ($Q4_gas_target + $rec3);
                    if ($k == 10) $gas_tar_oct=$rec3;else if ($k == 11) $gas_tar_nov=$rec3;else if ($k == 12) $gas_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Total RIDDOR Report")==0) {
            $Q1_ridd_target = 0;
            $Q2_ridd_target = 0;
            $Q3_ridd_target = 0;
            $Q4_ridd_target = 0;

            $k = 0;
            $ridd_tar_jan=$ridd_tar_feb=$ridd_tar_mar=$ridd_tar_apr=$ridd_tar_may=$ridd_tar_jun=$ridd_tar_jul=$ridd_tar_aug=$ridd_tar_sep=$ridd_tar_oct=$ridd_tar_nov=$ridd_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_ridd_target = ($Q1_ridd_target + $rec3);
                    if ($k == 1) $ridd_tar_jan=$rec3;else if ($k == 2) $ridd_tar_feb=$rec3;else if ($k == 3) $ridd_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_ridd_target = ($Q2_ridd_target + $rec3);
                    if ($k == 4) $ridd_tar_apr=$rec3;else if ($k == 5) $ridd_tar_may=$rec3;else if ($k == 6) $ridd_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_ridd_target = ($Q3_ridd_target + $rec3);
                    if ($k == 7) $ridd_tar_jul=$rec3;else if ($k == 8) $ridd_tar_aug=$rec3;else if ($k == 9) $ridd_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_ridd_target = ($Q4_ridd_target + $rec3);
                    if ($k == 10) $ridd_tar_oct=$rec3;else if ($k == 11) $ridd_tar_nov=$rec3;else if ($k == 12) $ridd_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"No of medical treatment over first aid")==0) {
            $Q1_medi_target = 0;
            $Q2_medi_target = 0;
            $Q3_medi_target = 0;
            $Q4_medi_target = 0;

            $k = 0;
            $medi_tar_jan=$medi_tar_feb=$medi_tar_mar=$medi_tar_apr=$medi_tar_may=$medi_tar_jun=$medi_tar_jul=$medi_tar_aug=$medi_tar_sep=$medi_tar_oct=$medi_tar_nov=$medi_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_medi_target = ($Q1_medi_target + $rec3);
                    if ($k == 1) $medi_tar_jan=$rec3;else if ($k == 2) $medi_tar_feb=$rec3;else if ($k == 3) $medi_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_medi_target = ($Q2_medi_target + $rec3);
                    if ($k == 4) $medi_tar_apr=$rec3;else if ($k == 5) $medi_tar_may=$rec3;else if ($k == 6) $medi_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_medi_target = ($Q3_medi_target + $rec3);
                    if ($k == 7) $medi_tar_jul=$rec3;else if ($k == 8) $medi_tar_aug=$rec3;else if ($k == 9) $medi_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_medi_target = ($Q4_medi_target + $rec3);
                    if ($k == 10) $medi_tar_oct=$rec3;else if ($k == 11) $medi_tar_nov=$rec3;else if ($k == 12) $medi_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"No of minor injuries")==0) {
            $Q1_mino_target = 0;
            $Q2_mino_target = 0;
            $Q3_mino_target = 0;
            $Q4_mino_target = 0;

            $k = 0;
            $mino_tar_jan=$mino_tar_feb=$mino_tar_mar=$mino_tar_apr=$mino_tar_may=$mino_tar_jun=$mino_tar_jul=$mino_tar_aug=$mino_tar_sep=$mino_tar_oct=$mino_tar_nov=$mino_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_mino_target = ($Q1_mino_target + $rec3);
                    if ($k == 1) $mino_tar_jan=$rec3;else if ($k == 2) $mino_tar_feb=$rec3;else if ($k == 3) $mino_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_mino_target = ($Q2_mino_target + $rec3);
                    if ($k == 4) $mino_tar_apr=$rec3;else if ($k == 5) $mino_tar_may=$rec3;else if ($k == 6) $mino_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_mino_target = ($Q3_mino_target + $rec3);
                    if ($k == 7) $mino_tar_jul=$rec3;else if ($k == 8) $mino_tar_aug=$rec3;else if ($k == 9) $mino_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_mino_target = ($Q4_mino_target + $rec3);
                    if ($k == 10) $mino_tar_oct=$rec3;else if ($k == 11) $mino_tar_nov=$rec3;else if ($k == 12) $mino_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Total lost days")==0) {
            $Q1_lost_target = 0;
            $Q2_lost_target = 0;
            $Q3_lost_target = 0;
            $Q4_lost_target = 0;

            $k = 0;
            $lost_tar_jan=$lost_tar_feb=$lost_tar_mar=$lost_tar_apr=$lost_tar_may=$lost_tar_jun=$lost_tar_jul=$lost_tar_aug=$lost_tar_sep=$lost_tar_oct=$lost_tar_nov=$lost_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_lost_target = ($Q1_lost_target + $rec3);
                    if ($k == 1) $lost_tar_jan=$rec3;else if ($k == 2) $lost_tar_feb=$rec3;else if ($k == 3) $lost_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_lost_target = ($Q2_lost_target + $rec3);
                    if ($k == 4) $lost_tar_apr=$rec3;else if ($k == 5) $lost_tar_may=$rec3;else if ($k == 6) $lost_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_lost_target = ($Q3_lost_target + $rec3);
                    if ($k == 7) $lost_tar_jul=$rec3;else if ($k == 8) $lost_tar_aug=$rec3;else if ($k == 9) $lost_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_lost_target = ($Q4_lost_target + $rec3);
                    if ($k == 10) $lost_tar_oct=$rec3;else if ($k == 11) $lost_tar_nov=$rec3;else if ($k == 12) $lost_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Hazard Identification")==0) {
            $Q1_haz_target = 0;
            $Q2_haz_target = 0;
            $Q3_haz_target = 0;
            $Q4_haz_target = 0;

            $k = 0;
            $haz_tar_jan=$haz_tar_feb=$haz_tar_mar=$haz_tar_apr=$haz_tar_may=$haz_tar_jun=$haz_tar_jul=$haz_tar_aug=$haz_tar_sep=$haz_tar_oct=$haz_tar_nov=$haz_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_haz_target = ($Q1_haz_target + $rec3);
                    if ($k == 1) $haz_tar_jan=$rec3;else if ($k == 2) $haz_tar_feb=$rec3;else if ($k == 3) $haz_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_haz_target = ($Q2_haz_target + $rec3);
                    if ($k == 4) $haz_tar_apr=$rec3;else if ($k == 5) $haz_tar_may=$rec3;else if ($k == 6) $haz_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_haz_target = ($Q3_haz_target + $rec3);
                    if ($k == 7) $haz_tar_jul=$rec3;else if ($k == 8) $haz_tar_aug=$rec3;else if ($k == 9) $haz_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_haz_target = ($Q4_haz_target + $rec3);
                    if ($k == 10) $haz_tar_oct=$rec3;else if ($k == 11) $haz_tar_nov=$rec3;else if ($k == 12) $haz_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Near Misses")==0) {
            $Q1_near_target = 0;
            $Q2_near_target = 0;
            $Q3_near_target = 0;
            $Q4_near_target = 0;

            $k = 0;
            $near_tar_jan=$near_tar_feb=$near_tar_mar=$near_tar_apr=$near_tar_may=$near_tar_jun=$near_tar_jul=$near_tar_aug=$near_tar_sep=$near_tar_oct=$near_tar_nov=$near_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_near_target = ($Q1_near_target + $rec3);
                    if ($k == 1) $near_tar_jan=$rec3;else if ($k == 2) $near_tar_feb=$rec3;else if ($k == 3) $near_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_near_target = ($Q2_near_target + $rec3);
                    if ($k == 4) $near_tar_apr=$rec3;else if ($k == 5) $near_tar_may=$rec3;else if ($k == 6) $near_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_near_target = ($Q3_near_target + $rec3);
                    if ($k == 7) $near_tar_jul=$rec3;else if ($k == 8) $near_tar_aug=$rec3;else if ($k == 9) $near_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_near_target = ($Q4_near_target + $rec3);
                    if ($k == 10) $near_tar_oct=$rec3;else if ($k == 11) $near_tar_nov=$rec3;else if ($k == 12) $near_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Hazards Identified / Near Misses Total")==0) {
            $Q1_haznea_target = 0;
            $Q2_haznea_target = 0;
            $Q3_haznea_target = 0;
            $Q4_haznea_target = 0;

            $k = 0;
            $haznea_tar_jan=$haznea_tar_feb=$haznea_tar_mar=$haznea_tar_apr=$haznea_tar_may=$haznea_tar_jun=$haznea_tar_jul=$haznea_tar_aug=$haznea_tar_sep=$haznea_tar_oct=$haznea_tar_nov=$haznea_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_haznea_target = ($Q1_haznea_target + $rec3);
                    if ($k == 1) $haznea_tar_jan=$rec3;else if ($k == 2) $haznea_tar_feb=$rec3;else if ($k == 3) $haznea_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_haznea_target = ($Q2_haznea_target + $rec3);
                    if ($k == 4) $haznea_tar_apr=$rec3;else if ($k == 5) $haznea_tar_may=$rec3;else if ($k == 6) $haznea_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_haznea_target = ($Q3_haznea_target + $rec3);
                    if ($k == 7) $haznea_tar_jul=$rec3;else if ($k == 8) $haznea_tar_aug=$rec3;else if ($k == 9) $haznea_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_haznea_target = ($Q4_haznea_target + $rec3);
                    if ($k == 10) $haznea_tar_oct=$rec3;else if ($k == 11) $haznea_tar_nov=$rec3;else if ($k == 12) $haznea_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Incidents")==0) {
            $Q1_inci_target = 0;
            $Q2_inci_target = 0;
            $Q3_inci_target = 0;
            $Q4_inci_target = 0;

            $k = 0;
            $inci_tar_jan=$inci_tar_feb=$inci_tar_mar=$inci_tar_apr=$inci_tar_may=$inci_tar_jun=$inci_tar_jul=$inci_tar_aug=$inci_tar_sep=$inci_tar_oct=$inci_tar_nov=$inci_tar_dec=0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_inci_target = ($Q1_inci_target + $rec3);
                    if ($k == 1) $inci_tar_jan=$rec3;else if ($k == 2) $inci_tar_feb=$rec3;else if ($k == 3) $inci_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_inci_target = ($Q2_inci_target + $rec3);
                    if ($k == 4) $inci_tar_apr=$rec3;else if ($k == 5) $inci_tar_may=$rec3;else if ($k == 6) $inci_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_inci_target = ($Q3_inci_target + $rec3);
                    if ($k == 7) $inci_tar_jul=$rec3;else if ($k == 8) $inci_tar_aug=$rec3;else if ($k == 9) $inci_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_inci_target = ($Q4_inci_target + $rec3);
                    if ($k == 10) $inci_tar_oct=$rec3;else if ($k == 11) $inci_tar_nov=$rec3;else if ($k == 12) $inci_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"Toolbox Talks / Safety Briefings delivered")==0) {
            $Q1_tosa_target = $Q2_tosa_target = $Q3_tosa_target = $Q4_tosa_target = 0;
            $tosa_tar_jan=$tosa_tar_feb=$tosa_tar_mar=$tosa_tar_apr=$tosa_tar_may=$tosa_tar_jun=$tosa_tar_jul=$tosa_tar_aug=$tosa_tar_sep=$tosa_tar_oct=$tosa_tar_nov=$tosa_tar_dec=0;
            $k = 0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_tosa_target = ($Q1_tosa_target + $rec3);
                    if ($k == 1) $tosa_tar_jan=$rec3;else if ($k == 2) $tosa_tar_feb=$rec3;else if ($k == 3) $tosa_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_tosa_target = ($Q2_tosa_target + $rec3);
                    if ($k == 4) $tosa_tar_apr=$rec3;else if ($k == 5) $tosa_tar_may=$rec3;else if ($k == 6) $tosa_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_tosa_target = ($Q3_tosa_target + $rec3);
                    if ($k == 7) $tosa_tar_jul=$rec3;else if ($k == 8) $tosa_tar_aug=$rec3;else if ($k == 9) $tosa_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_tosa_target = ($Q4_tosa_target + $rec3);
                    if ($k == 10) $tosa_tar_oct=$rec3;else if ($k == 11) $tosa_tar_nov=$rec3;else if ($k == 12) $tosa_tar_dec=$rec3;
                }
            }
        }
        else if (strcasecmp($key2,"No of Site Audits")==0) {
            $Q1_siau_target = $Q2_siau_target = $Q3_siau_target = $Q4_siau_target = 0;
            $siau_tar_jan=$siau_tar_feb=$siau_tar_mar=$siau_tar_apr=$siau_tar_may=$siau_tar_jun=$siau_tar_jul=$siau_tar_aug=$siau_tar_sep=$siau_tar_oct=$siau_tar_nov=$siau_tar_dec=0;
            $k = 0;
            foreach ($rec2 as $key3 => $rec3) {
//            print_r($rec3);
                $k++;
                if ($k >= 1 && $k <= 3) {
                    $Q1_siau_target = ($Q1_siau_target + $rec3);
                    if ($k == 1) $siau_tar_jan=$rec3;else if ($k == 2) $siau_tar_feb=$rec3;else if ($k == 3) $siau_tar_mar=$rec3;
                } elseif ($k >= 4 && $k <= 6) {
                    $Q2_siau_target = ($Q2_siau_target + $rec3);
                    if ($k == 4) $siau_tar_apr=$rec3;else if ($k == 5) $siau_tar_may=$rec3;else if ($k == 6) $siau_tar_jun=$rec3;
                } elseif ($k >= 7 && $k <= 9) {
                    $Q3_siau_target = ($Q3_siau_target + $rec3);
                    if ($k == 7) $siau_tar_jul=$rec3;else if ($k == 8) $siau_tar_aug=$rec3;else if ($k == 9) $siau_tar_sep=$rec3;
                } elseif ($k >= 10 && $k <= 12) {
                    $Q4_siau_target = ($Q4_siau_target + $rec3);
                    if ($k == 10) $siau_tar_oct=$rec3;else if ($k == 11) $siau_tar_nov=$rec3;else if ($k == 12) $siau_tar_dec=$rec3;
                }
            }
        }
    }
}



$Q1_fat_actual = $Q2_fat_actual = $Q3_fat_actual = $Q4_fat_actual = 0;
$fat_act_jan = $fat_act_feb = $fat_act_mar = $fat_act_apr = $fat_act_may = $fat_act_jun = $fat_act_jul = $fat_act_aug = $fat_act_sep = $fat_act_oct = $fat_act_nov = $fat_act_dec = 0;

$Q1_spe_actual = $Q2_spe_actual = $Q3_spe_actual = $Q4_spe_actual = 0;
$spe_act_jan=$spe_act_feb=$spe_act_mar=$spe_act_apr=$spe_act_may=$spe_act_jun=$spe_act_jul=$spe_act_aug=$spe_act_sep=$spe_act_oct=$spe_act_nov=$spe_act_dec=0;

$Q1_7day_actual = $Q2_7day_actual = $Q3_7day_actual = $Q4_7day_actual = 0;
$day7_act_jan=$day7_act_feb=$day7_act_mar=$day7_act_apr=$day7_act_may=$day7_act_jun=$day7_act_jul=$day7_act_aug=$day7_act_sep=$day7_act_oct=$day7_act_nov=$day7_act_dec=0;

$Q1_occu_actual = $Q2_occu_actual = $Q3_occu_actual = $Q4_occu_actual = 0;
$occu_act_jan=$occu_act_feb=$occu_act_mar=$occu_act_apr=$occu_act_may=$occu_act_jun=$occu_act_jul=$occu_act_aug=$occu_act_sep=$occu_act_oct=$occu_act_nov=$occu_act_dec=0;

$Q1_dan_actual = $Q2_dan_actual = $Q3_dan_actual = $Q4_dan_actual = 0;
$dan_act_jan=$dan_act_feb=$dan_act_mar=$dan_act_apr=$dan_act_may=$dan_act_jun=$dan_act_jul=$dan_act_aug=$dan_act_sep=$dan_act_oct=$dan_act_nov=$dan_act_dec=0;

$Q1_nonf_actual = $Q2_nonf_actual = $Q3_nonf_actual = $Q4_nonf_actual = 0;
$nonf_act_jan=$nonf_act_feb=$nonf_act_mar=$nonf_act_apr=$nonf_act_may=$nonf_act_jun=$nonf_act_jul=$nonf_act_aug=$nonf_act_sep=$nonf_act_oct=$nonf_act_nov=$nonf_act_dec=0;

$Q1_gas_actual = $Q2_gas_actual = $Q3_gas_actual = $Q4_gas_actual = 0;
$gas_act_jan=$gas_act_feb=$gas_act_mar=$gas_act_apr=$gas_act_may=$gas_act_jun=$gas_act_jul=$gas_act_aug=$gas_act_sep=$gas_act_oct=$gas_act_nov=$gas_act_dec=0;

$Q1_ridd_actual = $Q2_ridd_actual = $Q3_ridd_actual = $Q4_ridd_actual = 0;
$ridd_act_jan=$ridd_act_feb=$ridd_act_mar=$ridd_act_apr=$ridd_act_may=$ridd_act_jun=$ridd_act_jul=$ridd_act_aug=$ridd_act_sep=$ridd_act_oct=$ridd_act_nov=$ridd_act_dec=0;

$Q1_medi_actual = $Q2_medi_actual = $Q3_medi_actual = $Q4_medi_actual = 0;
$medi_act_jan=$medi_act_feb=$medi_act_mar=$medi_act_apr=$medi_act_may=$medi_act_jun=$medi_act_jul=$medi_act_aug=$medi_act_sep=$medi_act_oct=$medi_act_nov=$medi_act_dec=0;

$Q1_mino_actual = $Q2_mino_actual = $Q3_mino_actual = $Q4_mino_actual = 0;
$mino_act_jan=$mino_act_feb=$mino_act_mar=$mino_act_apr=$mino_act_may=$mino_act_jun=$mino_act_jul=$mino_act_aug=$mino_act_sep=$mino_act_oct=$mino_act_nov=$mino_act_dec=0;

$Q1_lost_actual = $Q2_lost_actual = $Q3_lost_actual = $Q4_lost_actual = 0;
$lost_act_jan=$lost_act_feb=$lost_act_mar=$lost_act_apr=$lost_act_may=$lost_act_jun=$lost_act_jul=$lost_act_aug=$lost_act_sep=$lost_act_oct=$lost_act_nov=$lost_act_dec=0;

$Q1_haz_actual = $Q2_haz_actual = $Q3_haz_actual = $Q4_haz_actual = 0;
$haz_act_jan=$haz_act_feb=$haz_act_mar=$haz_act_apr=$haz_act_may=$haz_act_jun=$haz_act_jul=$haz_act_aug=$haz_act_sep=$haz_act_oct=$haz_act_nov=$haz_act_dec=0;

$Q1_near_actual = $Q2_near_actual = $Q3_near_actual = $Q4_near_actual = 0;
$near_act_jan=$near_act_feb=$near_act_mar=$near_act_apr=$near_act_may=$near_act_jun=$near_act_jul=$near_act_aug=$near_act_sep=$near_act_oct=$near_act_nov=$near_act_dec=0;

$Q1_haznea_actual = $Q2_haznea_actual = $Q3_haznea_actual = $Q4_haznea_actual = 0;
$haznea_act_jan=$haznea_act_feb=$haznea_act_mar=$haznea_act_apr=$haznea_act_may=$haznea_act_jun=$haznea_act_jul=$haznea_act_aug=$haznea_act_sep=$haznea_act_oct=$haznea_act_nov=$haznea_act_dec=0;

$Q1_inci_actual = $Q2_inci_actual = $Q3_inci_actual = $Q4_inci_actual = 0;
$inci_act_jan=$inci_act_feb=$inci_act_mar=$inci_act_apr=$inci_act_may=$inci_act_jun=$inci_act_jul=$inci_act_aug=$inci_act_sep=$inci_act_oct=$inci_act_nov=$inci_act_dec=0;

$Q1_empl_actual = $Q2_empl_actual = $Q3_empl_actual = $Q4_empl_actual = 0;
$empl_act_jan=$empl_act_feb=$empl_act_mar=$empl_act_apr=$empl_act_may=$empl_act_jun=$empl_act_jul=$empl_act_aug=$empl_act_sep=$empl_act_oct=$empl_act_nov=$empl_act_dec=0;

$Q1_wor_actual = $Q2_wor_actual = $Q3_wor_actual = $Q4_wor_actual = 0;
$wor_act_jan=$wor_act_feb=$wor_act_mar=$wor_act_apr=$wor_act_may=$wor_act_jun=$wor_act_jul=$wor_act_aug=$wor_act_sep=$wor_act_oct=$wor_act_nov=$wor_act_dec=0;

$Q1_tosa_actual = $Q2_tosa_actual = $Q3_tosa_actual = $Q4_tosa_actual = 0;
$tosa_act_jan=$tosa_act_feb=$tosa_act_mar=$tosa_act_apr=$tosa_act_may=$tosa_act_jun=$tosa_act_jul=$tosa_act_aug=$tosa_act_sep=$tosa_act_oct=$tosa_act_nov=$tosa_act_dec=0;

$Q1_numa_actual = $Q2_numa_actual = $Q3_numa_actual = $Q4_numa_actual = 0;
$numa_act_jan=$numa_act_feb=$numa_act_mar=$numa_act_apr=$numa_act_may=$numa_act_jun=$numa_act_jul=$numa_act_aug=$numa_act_sep=$numa_act_oct=$numa_act_nov=$numa_act_dec=0;

$Q1_audr_actual = $Q2_audr_actual = $Q3_audr_actual = $Q4_audr_actual = 0;
$audr_act_jan=$audr_act_feb=$audr_act_mar=$audr_act_apr=$audr_act_may=$audr_act_jun=$audr_act_jul=$audr_act_aug=$audr_act_sep=$audr_act_oct=$audr_act_nov=$audr_act_dec=0;

$Q1_outr_actual = $Q2_outr_actual = $Q3_outr_actual = $Q4_outr_actual = 0;
$outr_act_jan=$outr_act_feb=$outr_act_mar=$outr_act_apr=$outr_act_may=$outr_act_jun=$outr_act_jul=$outr_act_aug=$outr_act_sep=$outr_act_oct=$outr_act_nov=$outr_act_dec=0;

$sql = " SELECT concat(s_mgt_rpt_riddor_event_clf,'_',FROM_UNIXTIME(accident_date,'%c')) as rowid,COUNT(id) as total ,FROM_UNIXTIME(accident_date,'%c') as month , s_mgt_rpt_riddor_event_clf as ridder_event
              FROM mdl_accident_report WHERE     FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']." 
              GROUP by  FROM_UNIXTIME(accident_date,'%m'),s_mgt_rpt_riddor_event_clf ";
$actual_riddor_event_data    = $DB->get_records_sql($sql);
if(!empty($actual_riddor_event_data)){
    foreach ($actual_riddor_event_data as $data) {
//        echo "<pre>";
//        print_r($data);
        $month = $data->month;
        $total = $data->total;
        if ($data->ridder_event == 16) {//Fatalities
            if ($month >= 1 && $month <= 3) {
                $Q1_fat_actual = ($Q1_fat_actual + $total);
                if ($month == 1) $fat_act_jan=$total;else if ($month == 2) $fat_act_feb=$total;else if ($month == 3) $fat_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_fat_actual = ($Q2_fat_actual + $total);
                if ($month == 4) $fat_act_apr=$total;else if ($month == 5) $fat_act_may=$total;else if ($month == 6) $fat_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_fat_actual = ($Q3_fat_actual + $total);
                if ($month == 7) $fat_act_jul=$total;else if ($month == 8) $fat_act_aug=$total;else if ($month == 9) $fat_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_fat_actual = ($Q4_fat_actual + $total);
                if ($month == 10) $fat_act_oct=$total;else if ($month == 11) $fat_act_nov=$total;else if ($month == 12) $fat_act_dec=$total;
            }
        }
        else if ($data->ridder_event == 17) {//Specific Injuries
            if ($month >= 1 && $month <= 3) {
                $Q1_spe_actual = ($Q1_spe_actual + $total);
                if ($month == 1) $spe_act_jan=$total;else if ($month == 2) $spe_act_feb=$total;else if ($month == 3) $spe_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_spe_actual = ($Q2_spe_actual + $total);
                if ($month == 4) $spe_act_apr=$total;else if ($month == 5) $spe_act_may=$total;else if ($month == 6) $spe_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_spe_actual = ($Q3_spe_actual + $total);
                if ($month == 7) $spe_act_jul=$total;else if ($month == 8) $spe_act_aug=$total;else if ($month == 9) $spe_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_spe_actual = ($Q4_spe_actual + $total);
                if ($month == 10) $spe_act_oct=$total;else if ($month == 11) $spe_act_nov=$total;else if ($month == 12) $spe_act_dec=$total;
            }
        }
        else if ($data->ridder_event == 18) {//Over 7 Day Incapacity
            if ($month >= 1 && $month <= 3) {
                $Q1_7day_actual = ($Q1_7day_actual + $total);
                if ($month == 1) $day7_act_jan=$total;else if ($month == 2) $day7_act_feb=$total;else if ($month == 3) $day7_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_7day_actual = ($Q2_7day_actual + $total);
                if ($month == 4) $day7_act_apr=$total;else if ($month == 5) $day7_act_may=$total;else if ($month == 6) $day7_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_7day_actual = ($Q3_7day_actual + $total);
                if ($month == 7) $day7_act_jul=$total;else if ($month == 8) $day7_act_aug=$total;else if ($month == 9) $day7_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_7day_actual = ($Q4_7day_actual + $total);
                if ($month == 10) $day7_act_oct=$total;else if ($month == 11) $day7_act_nov=$total;else if ($month == 12) $day7_act_dec=$total;
            }

        }
        else if ($data->ridder_event == 19) {//Non Fatal Accidents to non workers
            if ($month >= 1 && $month <= 3) {
                $Q1_nonf_actual = ($Q1_nonf_actual + $total);
                if ($month == 1) $nonf_act_jan=$total;else if ($month == 2) $nonf_act_feb=$total;else if ($month == 3) $nonf_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_nonf_actual = ($Q2_nonf_actual + $total);
                if ($month == 4) $nonf_act_apr=$total;else if ($month == 5) $nonf_act_may=$total;else if ($month == 6) $nonf_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_nonf_actual = ($Q3_nonf_actual + $total);
                if ($month == 7) $nonf_act_jul=$total;else if ($month == 8) $nonf_act_aug=$total;else if ($month == 9) $nonf_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_nonf_actual = ($Q4_nonf_actual + $total);
                if ($month == 10) $nonf_act_oct=$total;else if ($month == 11) $nonf_act_nov=$total;else if ($month == 12) $nonf_act_dec=$total;
            }
        }
        else if ($data->ridder_event == 20) {//Occupational Disease
            if ($month >= 1 && $month <= 3) {
                $Q1_occu_actual = ($Q1_occu_actual + $total);
                if ($month == 1) $occu_act_jan=$total;else if ($month == 2) $occu_act_feb=$total;else if ($month == 3) $occu_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_occu_actual = ($Q2_occu_actual + $total);
                if ($month == 4) $occu_act_apr=$total;else if ($month == 5) $occu_act_may=$total;else if ($month == 6) $occu_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_occu_actual = ($Q3_occu_actual + $total);
                if ($month == 7) $occu_act_jul=$total;else if ($month == 8) $occu_act_aug=$total;else if ($month == 9) $occu_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_occu_actual = ($Q4_occu_actual + $total);
                if ($month == 10) $occu_act_oct=$total;else if ($month == 11) $occu_act_nov=$total;else if ($month == 12) $occu_act_dec=$total;
            }
        }
        else if ($data->ridder_event == 21) {//Dangerous Occurrence
            if ($month >= 1 && $month <= 3) {
                $Q1_dan_actual = ($Q1_dan_actual + $total);
                if ($month == 1) $dan_act_jan=$total;else if ($month == 2) $dan_act_feb=$total;else if ($month == 3) $dan_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_dan_actual = ($Q2_dan_actual + $total);
                if ($month == 4) $dan_act_apr=$total;else if ($month == 5) $dan_act_may=$total;else if ($month == 6) $dan_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_dan_actual = ($Q3_dan_actual + $total);
                if ($month == 7) $dan_act_jul=$total;else if ($month == 8) $dan_act_aug=$total;else if ($month == 9) $dan_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_dan_actual = ($Q4_dan_actual + $total);
                if ($month == 10) $dan_act_oct=$total;else if ($month == 11) $dan_act_nov=$total;else if ($month == 12) $dan_act_dec=$total;
            }
        }
        else if ($data->ridder_event == 22) {//Gas Incidents
            if ($month >= 1 && $month <= 3) {
                $Q1_gas_actual = ($Q1_gas_actual + $total);
                if ($month == 1) $gas_act_jan=$total;else if ($month == 2) $gas_act_feb=$total;else if ($month == 3) $gas_act_mar=$total;
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_gas_actual = ($Q2_gas_actual + $total);
                if ($month == 4) $gas_act_apr=$total;else if ($month == 5) $gas_act_may=$total;else if ($month == 6) $gas_act_jun=$total;
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_gas_actual = ($Q3_gas_actual + $total);
                if ($month == 7) $gas_act_jul=$total;else if ($month == 8) $gas_act_aug=$total;else if ($month == 9) $gas_act_sep=$total;
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_gas_actual = ($Q4_gas_actual + $total);
                if ($month == 10) $gas_act_oct=$total;else if ($month == 11) $gas_act_nov=$total;else if ($month == 12) $gas_act_dec=$total;
            }
        }

    }

}

$sql = " SELECT FROM_UNIXTIME(accident_date,'%c') as rowid, COUNT(id) as total, FROM_UNIXTIME(accident_date,'%c') as month
FROM mdl_accident_report WHERE FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']." AND s_mgt_rpt_2508_completed =1 GROUP by  FROM_UNIXTIME(accident_date,'%m') ";
$actual_total_RIDDOR_report_data = $DB->get_records_sql($sql);
if(!empty($actual_total_RIDDOR_report_data)){
    foreach ($actual_total_RIDDOR_report_data as $data) {//Total RIDDOR Report
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_ridd_actual = ($Q1_ridd_actual + $total);
            if ($month == 1) $ridd_act_jan=$total;else if ($month == 2) $ridd_act_feb=$total;else if ($month == 3) $ridd_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_ridd_actual = ($Q2_ridd_actual + $total);
            if ($month == 4) $ridd_act_apr=$total;else if ($month == 5) $ridd_act_may=$total;else if ($month == 6) $ridd_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_ridd_actual = ($Q3_ridd_actual + $total);
            if ($month == 7) $ridd_act_jul=$total;else if ($month == 8) $ridd_act_aug=$total;else if ($month == 9) $ridd_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_ridd_actual = ($Q4_ridd_actual + $total);
            if ($month == 10) $ridd_act_oct=$total;else if ($month == 11) $ridd_act_nov=$total;else if ($month == 12) $ridd_act_dec=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(accident_date,'%c') as rowid, COUNT(id) as total, FROM_UNIXTIME(accident_date,'%c') as month 
FROM mdl_accident_report WHERE FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']." AND accident_treatment ='Yes' AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3)) GROUP by  FROM_UNIXTIME(accident_date,'%m') ";
$actual_no_of_medical_treatment_over_first_aid_data = $DB->get_records_sql($sql);
if(!empty($actual_no_of_medical_treatment_over_first_aid_data)){
    foreach ($actual_no_of_medical_treatment_over_first_aid_data as $data) {//No of medical treatment over first aid
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_medi_actual = ($Q1_medi_actual + $total);
            if ($month == 1) $medi_act_jan=$total;else if ($month == 2) $medi_act_feb=$total;else if ($month == 3) $medi_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_medi_actual = ($Q2_medi_actual + $total);
            if ($month == 4) $medi_act_apr=$total;else if ($month == 5) $medi_act_may=$total;else if ($month == 6) $medi_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_medi_actual = ($Q3_medi_actual + $total);
            if ($month == 7) $medi_act_jul=$total;else if ($month == 8) $medi_act_aug=$total;else if ($month == 9) $medi_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_medi_actual = ($Q4_medi_actual + $total);
            if ($month == 10) $medi_act_oct=$total;else if ($month == 11) $medi_act_nov=$total;else if ($month == 12) $medi_act_dec=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(accident_date,'%c') as rowid, COUNT(id) as total, FROM_UNIXTIME(accident_date,'%c') as month 
FROM mdl_accident_report WHERE FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']." AND minor_injuries ='Yes' AND accident_treatment='No' AND (s_mgt_rpt_2508_completed IN(2,3) OR s_mgt_rpt_2508_completed IS NULL) GROUP by  FROM_UNIXTIME(accident_date,'%m') ";
$actual_no_of_minor_injuries_data = $DB->get_records_sql($sql);
if(!empty($actual_no_of_minor_injuries_data)){
    foreach ($actual_no_of_minor_injuries_data as $data) {//No of minor injuries
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_mino_actual = ($Q1_mino_actual + $total);
            if ($month == 1) $mino_act_jan=$total;else if ($month == 2) $mino_act_feb=$total;else if ($month == 3) $mino_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_mino_actual = ($Q2_mino_actual + $total);
            if ($month == 4) $mino_act_apr=$total;else if ($month == 5) $mino_act_may=$total;else if ($month == 6) $mino_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_mino_actual = ($Q3_mino_actual + $total);
            if ($month == 7) $mino_act_jul=$total;else if ($month == 8) $mino_act_aug=$total;else if ($month == 9) $mino_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_mino_actual = ($Q4_mino_actual + $total);
            if ($month == 10) $mino_act_oct=$total;else if ($month == 11) $mino_act_nov=$total;else if ($month == 12) $mino_act_dec=$total;
        }
    }
}

// Non reportable injury Rate --- Calculation  START

$sql = " SELECT FROM_UNIXTIME(accident_date,'%c') as rowid, COUNT(id) as total, FROM_UNIXTIME(accident_date,'%c') as month 
FROM mdl_accident_report WHERE FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']."  AND (s_mgt_rpt_2508_completed IS NULL OR s_mgt_rpt_2508_completed IN(2,3)) GROUP by  FROM_UNIXTIME(accident_date,'%m') ";
$non_reportable_data = $DB->get_records_sql($sql);
if(!empty($non_reportable_data)){
    foreach ($non_reportable_data as $data) {//No of medical treatment over first aid
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_non_reportable = ($Q1_non_reportable + $total);
            if ($month == 1) $non_reportable_jan=$total;else if ($month == 2) $non_reportable_feb=$total;else if ($month == 3) $non_reportable_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_non_reportable = ($Q2_non_reportable + $total);
            if ($month == 4) $non_reportable_apr=$total;else if ($month == 5) $non_reportable_may=$total;else if ($month == 6) $non_reportable_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_non_reportable = ($Q3_non_reportable + $total);
            if ($month == 7) $non_reportable_jul=$total;else if ($month == 8) $non_reportable_aug=$total;else if ($month == 9) $non_reportable_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_non_reportable = ($Q4_non_reportable + $total);
            if ($month == 10) $non_reportable_oct=$total;else if ($month == 11) $non_reportable_nov=$total;else if ($month == 12) $non_reportable_dec=$total;
        }
    }
}
// Non reportable injury Rate --- Calculation  END






$sql = " SELECT FROM_UNIXTIME(accident_date,'%c') as rowid, COALESCE(SUM(lost_time_days), 0) as total, FROM_UNIXTIME(accident_date,'%c') as month 
FROM mdl_accident_report WHERE FROM_UNIXTIME(accident_date,'%Y')=".$filterData['year']." AND lost_time ='Yes' GROUP by  FROM_UNIXTIME(accident_date,'%m') ";
$actual_total_lost_days_accident_data = $DB->get_records_sql($sql);
if(!empty($actual_total_lost_days_accident_data)){
    foreach ($actual_total_lost_days_accident_data as $data) {//Total lost days - accident
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_lost_actual = ($Q1_lost_actual + $total);
            if ($month == 1) $lost_act_jan=$total;else if ($month == 2) $lost_act_feb=$total;else if ($month == 3) $lost_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_lost_actual = ($Q2_lost_actual + $total);
            if ($month == 4) $lost_act_apr=$total;else if ($month == 5) $lost_act_may=$total;else if ($month == 6) $lost_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_lost_actual = ($Q3_lost_actual + $total);
            if ($month == 7) $lost_act_jul=$total;else if ($month == 8) $lost_act_aug=$total;else if ($month == 9) $lost_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_lost_actual = ($Q4_lost_actual + $total);
            if ($month == 10) $lost_act_oct=$total;else if ($month == 11) $lost_act_nov=$total;else if ($month == 12) $lost_act_dec=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(i_date,'%c') as rowid, COALESCE(SUM(lost_time_days), 0) as total, FROM_UNIXTIME(i_date,'%c') as month 
FROM mdl_incident_report WHERE FROM_UNIXTIME(i_date,'%Y')=".$filterData['year']." AND lost_time ='Yes' GROUP by  FROM_UNIXTIME(i_date,'%m') ";
$actual_total_lost_days_incident_data = $DB->get_records_sql($sql);
if(!empty($actual_total_lost_days_incident_data)){
    foreach ($actual_total_lost_days_incident_data as $data) {//Total lost days - incident
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_lost_actual = ($Q1_lost_actual + $total);
            if ($month == 1) $lost_act_jan+=$total;else if ($month == 2) $lost_act_feb+=$total;else if ($month == 3) $lost_act_mar+=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_lost_actual = ($Q2_lost_actual + $total);
            if ($month == 4) $lost_act_apr+=$total;else if ($month == 5) $lost_act_may+=$total;else if ($month == 6) $lost_act_jun+=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_lost_actual = ($Q3_lost_actual + $total);
            if ($month == 7) $lost_act_jul+=$total;else if ($month == 8) $lost_act_aug+=$total;else if ($month == 9) $lost_act_sep+=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_lost_actual = ($Q4_lost_actual + $total);
            if ($month == 10) $lost_act_oct+=$total;else if ($month == 11) $lost_act_nov+=$total;else if ($month == 12) $lost_act_dec+=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(i_date,'%c') as rowid, count(id) as total, FROM_UNIXTIME(i_date,'%c') as month 
         FROM mdl_incident_report 
         WHERE FROM_UNIXTIME(i_date,'%Y')=".$filterData['year']." AND 
         ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=30 
                          ELSE  correct_report_category=30 
              END ) 
         GROUP by  FROM_UNIXTIME(i_date,'%m') ";
$actual_hazard_identification_data = $DB->get_records_sql($sql);
if(!empty($actual_hazard_identification_data)){
    foreach ($actual_hazard_identification_data as $data) {//Hazard Identification
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_haz_actual = ($Q1_haz_actual + $total);
            if ($month == 1) $haz_act_jan=$total;else if ($month == 2) $haz_act_feb=$total;else if ($month == 3) $haz_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_haz_actual = ($Q2_haz_actual + $total);
            if ($month == 4) $haz_act_apr=$total;else if ($month == 5) $haz_act_may=$total;else if ($month == 6) $haz_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_haz_actual = ($Q3_haz_actual + $total);
            if ($month == 7) $haz_act_jul=$total;else if ($month == 8) $haz_act_aug=$total;else if ($month == 9) $haz_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_haz_actual = ($Q4_haz_actual + $total);
            if ($month == 10) $haz_act_oct=$total;else if ($month == 11) $haz_act_nov=$total;else if ($month == 12) $haz_act_dec=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(i_date,'%c') as rowid, count(id) as total, FROM_UNIXTIME(i_date,'%c') as month 
         FROM mdl_incident_report 
         WHERE FROM_UNIXTIME(i_date,'%Y')=".$filterData['year']." AND 
         ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=29 
                          ELSE  correct_report_category=29 
              END ) 
         GROUP by  FROM_UNIXTIME(i_date,'%m') ";
$actual_near_misses_data = $DB->get_records_sql($sql);
if(!empty($actual_near_misses_data)){
    foreach ($actual_near_misses_data as $data) {//Near Misses
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_near_actual = ($Q1_near_actual + $total);
            if ($month == 1) $near_act_jan=$total;else if ($month == 2) $near_act_feb=$total;else if ($month == 3) $near_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_near_actual = ($Q2_near_actual + $total);
            if ($month == 4) $near_act_apr=$total;else if ($month == 5) $near_act_may=$total;else if ($month == 6) $near_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_near_actual = ($Q3_near_actual + $total);
            if ($month == 7) $near_act_jul=$total;else if ($month == 8) $near_act_aug=$total;else if ($month == 9) $near_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_near_actual = ($Q4_near_actual + $total);
            if ($month == 10) $near_act_oct=$total;else if ($month == 11) $near_act_nov=$total;else if ($month == 12) $near_act_dec=$total;
        }
    }
}

//Hazards Identified / Near Misses Total
$Q1_haznea_actual = ($Q1_haz_actual + $Q1_near_actual);
$haznea_act_jan=($haz_act_jan + $near_act_jan);$haznea_act_feb=($haz_act_feb + $near_act_feb);$haznea_act_mar=($haz_act_mar + $near_act_mar);
$Q2_haznea_actual = ($Q2_haz_actual + $Q2_near_actual);
$haznea_act_apr=($haz_act_apr + $near_act_apr);$haznea_act_may=($haz_act_may + $near_act_may);$haznea_act_jun=($haz_act_jun + $near_act_jun);
$Q3_haznea_actual = ($Q3_haz_actual + $Q3_near_actual);
$haznea_act_jul=($haz_act_jul + $near_act_jul);$haznea_act_aug=($haz_act_aug + $near_act_aug);$haznea_act_sep=($haz_act_sep + $near_act_sep);
$Q4_haznea_actual = ($Q4_haz_actual + $Q4_near_actual);
$haznea_act_oct=($haz_act_oct + $near_act_oct);$haznea_act_nov=($haz_act_nov + $near_act_nov);$haznea_act_dec=($haz_act_dec + $near_act_dec);

$sql = " SELECT FROM_UNIXTIME(i_date,'%c') as rowid, count(id) as total, FROM_UNIXTIME(i_date,'%c') as month 
         FROM mdl_incident_report 
         WHERE FROM_UNIXTIME(i_date,'%Y')=".$filterData['year']." AND 
         ( CASE WHEN is_correct_report_category='Yes' OR is_correct_report_category IS NULL  
                          THEN report_category=31 
                          ELSE  correct_report_category=31 
              END ) 
         GROUP by  FROM_UNIXTIME(i_date,'%m') ";

$actual_incidents_data = $DB->get_records_sql($sql);
if(!empty($actual_incidents_data)){
    foreach ($actual_incidents_data as $data) {//Incidents
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_inci_actual = ($Q1_inci_actual + $total);
            if ($month == 1) $inci_act_jan=$total;else if ($month == 2) $inci_act_feb=$total;else if ($month == 3) $inci_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_inci_actual = ($Q2_inci_actual + $total);
            if ($month == 4) $inci_act_apr=$total;else if ($month == 5) $inci_act_may=$total;else if ($month == 6) $inci_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_inci_actual = ($Q3_inci_actual + $total);
            if ($month == 7) $inci_act_jul=$total;else if ($month == 8) $inci_act_aug=$total;else if ($month == 9) $inci_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_inci_actual = ($Q4_inci_actual + $total);
            if ($month == 10) $inci_act_oct=$total;else if ($month == 11) $inci_act_nov=$total;else if ($month == 12) $inci_act_dec=$total;
        }
    }
}

$sql = " SELECT FROM_UNIXTIME(timecreated,'%c') as rowid, COUNT(id) as total, FROM_UNIXTIME(timecreated,'%c') as month 
FROM mdl_course WHERE FROM_UNIXTIME(timecreated,'%Y')=".$filterData['year']." AND (coursetype =3 OR coursetype =4) GROUP by  FROM_UNIXTIME(timecreated,'%m') ";
$actual_toolbox_talks_safety_briefings_delivered_data = $DB->get_records_sql($sql);
if(!empty($actual_toolbox_talks_safety_briefings_delivered_data)){
    foreach ($actual_toolbox_talks_safety_briefings_delivered_data as $data) {//Toolbox Talks / Safety Briefings delivered
        $month = $data->month;
        $total = $data->total;

        if ($month >= 1 && $month <= 3) {
            $Q1_tosa_actual = ($Q1_tosa_actual + $total);
            if ($month == 1) $tosa_act_jan=$total;else if ($month == 2) $tosa_act_feb=$total;else if ($month == 3) $tosa_act_mar=$total;
        } elseif ($month >= 4 && $month <= 6) {
            $Q2_tosa_actual = ($Q2_tosa_actual + $total);
            if ($month == 4) $tosa_act_apr=$total;else if ($month == 5) $tosa_act_may=$total;else if ($month == 6) $tosa_act_jun=$total;
        } elseif ($month >= 7 && $month <= 9) {
            $Q3_tosa_actual = ($Q3_tosa_actual + $total);
            if ($month == 7) $tosa_act_jul=$total;else if ($month == 8) $tosa_act_aug=$total;else if ($month == 9) $tosa_act_sep=$total;
        } elseif ($month >= 10 && $month <= 12) {
            $Q4_tosa_actual = ($Q4_tosa_actual + $total);
            if ($month == 10) $tosa_act_oct=$total;else if ($month == 11) $tosa_act_nov=$total;else if ($month == 12) $tosa_act_dec=$total;
        }
    }
}

$actual_year_data = $DB->get_records_sql(" SELECT * FROM mdl_report_actual WHERE year=".$filterData['year']);
//echo '<pre>';
//print_r($actual_year_data);

$objAvgYTD = new stdClass(); // BM added to get average YTD on figures entered
$objAvgQ1 = new stdClass(); // BM added to get average on quarter figures entered
$objAvgQ2 = new stdClass(); // BM added to get average on quarter figures entered
$objAvgQ3 = new stdClass(); // BM added to get average on quarter figures entered
$objAvgQ4 = new stdClass(); // BM added to get average on quarter figures entered

foreach($actual_year_data as $rec) {
    $month = 0;
    $month = $rec->month;
    $decode_data = json_decode($rec->data);
    if(!empty($decode_data))
    foreach($decode_data as $key2=>$rec2) {
        if (strcasecmp($rec2[0],"Average number of employees")==0) {
            if ($month >= 1 && $month <= 3) {
                $Q1_empl_actual = ($Q1_empl_actual + $rec2[1]);
                if ($month == 1) $objAvgQ1->empl_act_jan=$objAvgYTD->empl_act_jan=$empl_act_jan=$rec2[1];else if ($month == 2) $objAvgQ1->empl_act_feb=$objAvgYTD->empl_act_feb=$empl_act_feb=$rec2[1];else if ($month == 3) $objAvgQ1->empl_act_mar=$objAvgYTD->empl_act_mar=$empl_act_mar=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_empl_actual = ($Q2_empl_actual + $rec2[1]);
                if ($month == 4) $objAvgQ2->empl_act_apr=$objAvgYTD->empl_act_apr=$empl_act_apr=$rec2[1];else if ($month == 5) $objAvgQ2->empl_act_may=$objAvgYTD->empl_act_may=$empl_act_may=$rec2[1];else if ($month == 6) $objAvgQ2->empl_act_jun=$objAvgYTD->empl_act_jun=$empl_act_jun=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_empl_actual = ($Q3_empl_actual + $rec2[1]);
                if ($month == 7) $objAvgQ3->empl_act_jul=$objAvgYTD->empl_act_jul=$empl_act_jul=$rec2[1];else if ($month == 8) $objAvgQ3->empl_act_aug=$objAvgYTD->empl_act_aug=$empl_act_aug=$rec2[1];else if ($month == 9) $objAvgQ3->empl_act_sep=$objAvgYTD->empl_act_sep=$empl_act_sep=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_empl_actual = ($Q4_empl_actual + $rec2[1]);
                if ($month == 10) $objAvgQ4->empl_act_oct=$objAvgYTD->empl_act_oct=$empl_act_oct=$rec2[1];else if ($month == 11) $objAvgQ4->empl_act_nov=$objAvgYTD->empl_act_nov=$empl_act_nov=$rec2[1];else if ($month == 12) $objAvgQ4->empl_act_dec=$objAvgYTD->empl_act_dec=$empl_act_dec=$rec2[1];
            }
        }
        else if (strcasecmp($rec2[0],"Hours worked")==0) {
            if ($month >= 1 && $month <= 3) {
                $Q1_wor_actual = ($Q1_wor_actual + $rec2[1]);
                if ($month == 1) $wor_act_jan=$rec2[1];else if ($month == 2) $wor_act_feb=$rec2[1];else if ($month == 3) $wor_act_mar=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_wor_actual = ($Q2_wor_actual + $rec2[1]);
                if ($month == 4) $wor_act_apr=$rec2[1];else if ($month == 5) $wor_act_may=$rec2[1];else if ($month == 6) $wor_act_jun=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_wor_actual = ($Q3_wor_actual + $rec2[1]);
                if ($month == 7) $wor_act_jul=$rec2[1];else if ($month == 8) $wor_act_aug=$rec2[1];else if ($month == 9) $wor_act_sep=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_wor_actual = ($Q4_wor_actual + $rec2[1]);
                if ($month == 10) $wor_act_oct=$rec2[1];else if ($month == 11) $wor_act_nov=$rec2[1];else if ($month == 12) $wor_act_dec=$rec2[1];
            }
        }
        else if (strcasecmp($rec2[0],"Number of Audits")==0) {
            if ($month >= 1 && $month <= 3) {
                $Q1_numa_actual = ($Q1_numa_actual + $rec2[1]);
                if ($month == 1) $numa_act_jan=$rec2[1];else if ($month == 2) $numa_act_feb=$rec2[1];else if ($month == 3) $numa_act_mar=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_numa_actual = ($Q2_numa_actual + $rec2[1]);
                if ($month == 4) $numa_act_apr=$rec2[1];else if ($month == 5) $numa_act_may=$rec2[1];else if ($month == 6) $numa_act_jun=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_numa_actual = ($Q3_numa_actual + $rec2[1]);
                if ($month == 7) $numa_act_jul=$rec2[1];else if ($month == 8) $numa_act_aug=$rec2[1];else if ($month == 9) $numa_act_sep=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_numa_actual = ($Q4_numa_actual + $rec2[1]);
                if ($month == 10) $numa_act_oct=$rec2[1];else if ($month == 11) $numa_act_nov=$rec2[1];else if ($month == 12) $numa_act_dec=$rec2[1];
            }
        }
        else if (strcasecmp($rec2[0],"Audit Recommendations")==0) {
            if ($month >= 1 && $month <= 3) {
                $Q1_audr_actual = ($Q1_audr_actual + $rec2[1]);
                if ($month == 1) $audr_act_jan=$rec2[1];else if ($month == 2) $audr_act_feb=$rec2[1];else if ($month == 3) $audr_act_mar=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_audr_actual = ($Q2_audr_actual + $rec2[1]);
                if ($month == 4) $audr_act_apr=$rec2[1];else if ($month == 5) $audr_act_may=$rec2[1];else if ($month == 6) $audr_act_jun=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_audr_actual = ($Q3_audr_actual + $rec2[1]);
                if ($month == 7) $audr_act_jul=$rec2[1];else if ($month == 8) $audr_act_aug=$rec2[1];else if ($month == 9) $audr_act_sep=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_audr_actual = ($Q4_audr_actual + $rec2[1]);
                if ($month == 10) $audr_act_oct=$rec2[1];else if ($month == 11) $audr_act_nov=$rec2[1];else if ($month == 12) $audr_act_dec=$rec2[1];
            }
        }
        else if (strcasecmp($rec2[0],"Outstanding Recommendations")==0) {
            if ($month >= 1 && $month <= 3) {
                $Q1_outr_actual = ($Q1_outr_actual + $rec2[1]);
                if ($month == 1) $outr_act_jan=$rec2[1];else if ($month == 2) $outr_act_feb=$rec2[1];else if ($month == 3) $outr_act_mar=$rec2[1];
            } elseif ($month >= 4 && $month <= 6) {
                $Q2_outr_actual = ($Q2_outr_actual + $rec2[1]);
                if ($month == 4) $outr_act_apr=$rec2[1];else if ($month == 5) $outr_act_may=$rec2[1];else if ($month == 6) $outr_act_jun=$rec2[1];
            } elseif ($month >= 7 && $month <= 9) {
                $Q3_outr_actual = ($Q3_outr_actual + $rec2[1]);
                if ($month == 7) $outr_act_jul=$rec2[1];else if ($month == 8) $outr_act_aug=$rec2[1];else if ($month == 9) $outr_act_sep=$rec2[1];
            } elseif ($month >= 10 && $month <= 12) {
                $Q4_outr_actual = ($Q4_outr_actual + $rec2[1]);
                if ($month == 10) $outr_act_oct=$rec2[1];else if ($month == 11) $outr_act_nov=$rec2[1];else if ($month == 12) $outr_act_dec=$rec2[1];
            }
        }
    }
}
// green 00FF00 amber FFBF00 red FF0000
$Q1_fat_actual_cell_color = $Q2_fat_actual_cell_color = $Q3_fat_actual_cell_color = $Q4_fat_actual_cell_color = $YTD_fat_actual_cell_color = '';
$fat_act_jan_cell_color = $fat_act_feb_cell_color = $fat_act_mar_cell_color = $fat_act_apr_cell_color = $fat_act_may_cell_color = $fat_act_jun_cell_color = $fat_act_jul_cell_color = $fat_act_aug_cell_color = $fat_act_sep_cell_color = $fat_act_oct_cell_color = $fat_act_nov_cell_color = $fat_act_dec_cell_color = '';
if ($fat_act_jan>$fat_tar_jan) $fat_act_jan_cell_color=" red ";
elseif ($fat_act_jan==0) $fat_act_jan_cell_color=" green ";
elseif ($fat_act_jan==$fat_tar_jan) $fat_act_jan_cell_color=" amber ";
elseif ($fat_act_jan<$fat_tar_jan) $fat_act_jan_cell_color=" green ";
if ($fat_act_feb>$fat_tar_feb) $fat_act_feb_cell_color=" red ";
elseif ($fat_act_feb==0) $fat_act_feb_cell_color=" green ";
elseif ($fat_act_feb==$fat_tar_feb) $fat_act_feb_cell_color=" amber ";
elseif ($fat_act_feb<$fat_tar_feb) $fat_act_feb_cell_color=" green ";
if ($fat_act_mar>$fat_tar_mar) $fat_act_mar_cell_color=" red ";
elseif ($fat_act_mar==0) $fat_act_mar_cell_color=" green ";
elseif ($fat_act_mar==$fat_tar_mar) $fat_act_mar_cell_color=" amber ";
elseif ($fat_act_mar<$fat_tar_mar) $fat_act_mar_cell_color=" green ";
if ($Q1_fat_actual>$Q1_fat_target) $Q1_fat_actual_cell_color=" red ";
elseif ($Q1_fat_actual==0) $Q1_fat_actual_cell_color=" green ";
elseif ($Q1_fat_actual==$Q1_fat_target) $Q1_fat_actual_cell_color=" amber ";
elseif ($Q1_fat_actual<$Q1_fat_target) $Q1_fat_actual_cell_color=" green ";
if ($fat_act_apr>$fat_tar_apr) $fat_act_apr_cell_color=" red ";
elseif ($fat_act_apr==0) $fat_act_apr_cell_color=" green ";
elseif ($fat_act_apr==$fat_tar_apr) $fat_act_apr_cell_color=" amber ";
elseif ($fat_act_apr<$fat_tar_apr) $fat_act_apr_cell_color=" green ";
if ($fat_act_may>$fat_tar_may) $fat_act_may_cell_color=" red ";
elseif ($fat_act_may==0) $fat_act_may_cell_color=" green ";
elseif ($fat_act_may==$fat_tar_may) $fat_act_may_cell_color=" amber ";
elseif ($fat_act_may<$fat_tar_may) $fat_act_may_cell_color=" green ";
if ($fat_act_jun>$fat_tar_jun) $fat_act_jun_cell_color=" red ";
elseif ($fat_act_jun==0) $fat_act_jun_cell_color=" green ";
elseif ($fat_act_jun==$fat_tar_jun) $fat_act_jun_cell_color=" amber ";
elseif ($fat_act_jun<$fat_tar_jun) $fat_act_jun_cell_color=" green ";
if ($Q2_fat_actual>$Q2_fat_target) $Q2_fat_actual_cell_color=" red ";
elseif ($Q2_fat_actual==0) $Q2_fat_actual_cell_color=" green ";
elseif ($Q2_fat_actual==$Q2_fat_target) $Q2_fat_actual_cell_color=" amber ";
elseif ($Q2_fat_actual<$Q2_fat_target) $Q2_fat_actual_cell_color=" green ";
if ($fat_act_jul>$fat_tar_jul) $fat_act_jul_cell_color=" red ";
elseif ($fat_act_jul==0) $fat_act_jul_cell_color=" green ";
elseif ($fat_act_jul==$fat_tar_jul) $fat_act_jul_cell_color=" amber ";
elseif ($fat_act_jul<$fat_tar_jul) $fat_act_jul_cell_color=" green ";
if ($fat_act_aug>$fat_tar_aug) $fat_act_aug_cell_color=" red ";
elseif ($fat_act_aug==0) $fat_act_aug_cell_color=" green ";
elseif ($fat_act_aug==$fat_tar_aug) $fat_act_aug_cell_color=" amber ";
elseif ($fat_act_aug<$fat_tar_aug) $fat_act_aug_cell_color=" green ";
if ($fat_act_sep>$fat_tar_sep) $fat_act_sep_cell_color=" red ";
elseif ($fat_act_sep==0) $fat_act_sep_cell_color=" green ";
elseif ($fat_act_sep==$fat_tar_sep) $fat_act_sep_cell_color=" amber ";
elseif ($fat_act_sep<$fat_tar_sep) $fat_act_sep_cell_color=" green ";
if ($Q3_fat_actual>$Q3_fat_target) $Q3_fat_actual_cell_color=" red ";
elseif ($Q3_fat_actual==0) $Q3_fat_actual_cell_color=" green ";
elseif ($Q3_fat_actual==$Q3_fat_target) $Q3_fat_actual_cell_color=" amber ";
elseif ($Q3_fat_actual<$Q3_fat_target) $Q3_fat_actual_cell_color=" green ";
if ($fat_act_oct>$fat_tar_oct) $fat_act_oct_cell_color=" red ";
elseif ($fat_act_oct==0) $fat_act_oct_cell_color=" green ";
elseif ($fat_act_oct==$fat_tar_oct) $fat_act_oct_cell_color=" amber ";
elseif ($fat_act_oct<$fat_tar_oct) $fat_act_oct_cell_color=" green ";
if ($fat_act_nov>$fat_tar_nov) $fat_act_nov_cell_color=" red ";
elseif ($fat_act_nov==0) $fat_act_nov_cell_color=" green ";
elseif ($fat_act_nov==$fat_tar_nov) $fat_act_nov_cell_color=" amber ";
elseif ($fat_act_nov<$fat_tar_nov) $fat_act_nov_cell_color=" green ";
if ($fat_act_dec>$fat_tar_dec) $fat_act_dec_cell_color=" red ";
elseif ($fat_act_dec==0) $fat_act_dec_cell_color=" green ";
elseif ($fat_act_dec==$fat_tar_dec) $fat_act_dec_cell_color=" amber ";
elseif ($fat_act_dec<$fat_tar_dec) $fat_act_dec_cell_color=" green ";
if ($Q4_fat_actual>$Q4_fat_target) $Q4_fat_actual_cell_color=" red ";
elseif ($Q4_fat_actual==0) $Q4_fat_actual_cell_color=" green ";
elseif ($Q4_fat_actual==$Q4_fat_target) $Q4_fat_actual_cell_color=" amber ";
elseif ($Q4_fat_actual<$Q4_fat_target) $Q4_fat_actual_cell_color=" green ";
if (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)>($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=" red ";
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)==0) $YTD_fat_actual_cell_color=" green ";
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)==($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=" amber ";
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)<($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=" green ";

$Q1_spe_actual_cell_color = $Q2_spe_actual_cell_color = $Q3_spe_actual_cell_color = $Q4_spe_actual_cell_color = $YTD_spe_actual_cell_color = '';
$spe_act_jan_cell_color = $spe_act_feb_cell_color = $spe_act_mar_cell_color = $spe_act_apr_cell_color = $spe_act_may_cell_color = $spe_act_jun_cell_color = $spe_act_jul_cell_color = $spe_act_aug_cell_color = $spe_act_sep_cell_color = $spe_act_oct_cell_color = $spe_act_nov_cell_color = $spe_act_dec_cell_color = '';
if ($spe_act_jan>$spe_tar_jan) $spe_act_jan_cell_color=" red ";
elseif ($spe_act_jan==0) $spe_act_jan_cell_color=" green ";
elseif ($spe_act_jan==$spe_tar_jan) $spe_act_jan_cell_color=" amber ";
elseif ($spe_act_jan<$spe_tar_jan) $spe_act_jan_cell_color=" green ";
if ($spe_act_feb>$spe_tar_feb) $spe_act_feb_cell_color=" red ";
elseif ($spe_act_feb==0) $spe_act_feb_cell_color=" green ";
elseif ($spe_act_feb==$spe_tar_feb) $spe_act_feb_cell_color=" amber ";
elseif ($spe_act_feb<$spe_tar_feb) $spe_act_feb_cell_color=" green ";
if ($spe_act_mar>$spe_tar_mar) $spe_act_mar_cell_color=" red ";
elseif ($spe_act_mar==0) $spe_act_mar_cell_color=" green ";
elseif ($spe_act_mar==$spe_tar_mar) $spe_act_mar_cell_color=" amber ";
elseif ($spe_act_mar<$spe_tar_mar) $spe_act_mar_cell_color=" green ";
if ($Q1_spe_actual>$Q1_spe_target) $Q1_spe_actual_cell_color=" red ";
elseif ($Q1_spe_actual==0) $Q1_spe_actual_cell_color=" green ";
elseif ($Q1_spe_actual==$Q1_spe_target) $Q1_spe_actual_cell_color=" amber ";
elseif ($Q1_spe_actual<$Q1_spe_target) $Q1_spe_actual_cell_color=" green ";
if ($spe_act_apr>$spe_tar_apr) $spe_act_apr_cell_color=" red ";
elseif ($spe_act_apr==0) $spe_act_apr_cell_color=" green ";
elseif ($spe_act_apr==$spe_tar_apr) $spe_act_apr_cell_color=" amber ";
elseif ($spe_act_apr<$spe_tar_apr) $spe_act_apr_cell_color=" green ";
if ($spe_act_may>$spe_tar_may) $spe_act_may_cell_color=" red ";
elseif ($spe_act_may==0) $spe_act_may_cell_color=" green ";
elseif ($spe_act_may==$spe_tar_may) $spe_act_may_cell_color=" amber ";
elseif ($spe_act_may<$spe_tar_may) $spe_act_may_cell_color=" green ";
if ($spe_act_jun>$spe_tar_jun) $spe_act_jun_cell_color=" red ";
elseif ($spe_act_jun==0) $spe_act_jun_cell_color=" green ";
elseif ($spe_act_jun==$spe_tar_jun) $spe_act_jun_cell_color=" amber ";
elseif ($spe_act_jun<$spe_tar_jun) $spe_act_jun_cell_color=" green ";
if ($Q2_spe_actual>$Q2_spe_target) $Q2_spe_actual_cell_color=" red ";
elseif ($Q2_spe_actual==0) $Q2_spe_actual_cell_color=" green ";
elseif ($Q2_spe_actual==$Q2_spe_target) $Q2_spe_actual_cell_color=" amber ";
elseif ($Q2_spe_actual<$Q2_spe_target) $Q2_spe_actual_cell_color=" green ";
if ($spe_act_jul>$spe_tar_jul) $spe_act_jul_cell_color=" red ";
elseif ($spe_act_jul==0) $spe_act_jul_cell_color=" green ";
elseif ($spe_act_jul==$spe_tar_jul) $spe_act_jul_cell_color=" amber ";
elseif ($spe_act_jul<$spe_tar_jul) $spe_act_jul_cell_color=" green ";
if ($spe_act_aug>$spe_tar_aug) $spe_act_aug_cell_color=" red ";
elseif ($spe_act_aug==0) $spe_act_aug_cell_color=" green ";
elseif ($spe_act_aug==$spe_tar_aug) $spe_act_aug_cell_color=" amber ";
elseif ($spe_act_aug<$spe_tar_aug) $spe_act_aug_cell_color=" green ";
if ($spe_act_sep>$spe_tar_sep) $spe_act_sep_cell_color=" red ";
elseif ($spe_act_sep==0) $spe_act_sep_cell_color=" green ";
elseif ($spe_act_sep==$spe_tar_sep) $spe_act_sep_cell_color=" amber ";
elseif ($spe_act_sep<$spe_tar_sep) $spe_act_sep_cell_color=" green ";
if ($Q3_spe_actual>$Q3_spe_target) $Q3_spe_actual_cell_color=" red ";
elseif ($Q3_spe_actual==0) $Q3_spe_actual_cell_color=" green ";
elseif ($Q3_spe_actual==$Q3_spe_target) $Q3_spe_actual_cell_color=" amber ";
elseif ($Q3_spe_actual<$Q3_spe_target) $Q3_spe_actual_cell_color=" green ";
if ($spe_act_oct>$spe_tar_oct) $spe_act_oct_cell_color=" red ";
elseif ($spe_act_oct==0) $spe_act_oct_cell_color=" green ";
elseif ($spe_act_oct==$spe_tar_oct) $spe_act_oct_cell_color=" amber ";
elseif ($spe_act_oct<$spe_tar_oct) $spe_act_oct_cell_color=" green ";
if ($spe_act_nov>$spe_tar_nov) $spe_act_nov_cell_color=" red ";
elseif ($spe_act_nov==0) $spe_act_nov_cell_color=" green ";
elseif ($spe_act_nov==$spe_tar_nov) $spe_act_nov_cell_color=" amber ";
elseif ($spe_act_nov<$spe_tar_nov) $spe_act_nov_cell_color=" green ";
if ($spe_act_dec>$spe_tar_dec) $spe_act_dec_cell_color=" red ";
elseif ($spe_act_dec==0) $spe_act_dec_cell_color=" green ";
elseif ($spe_act_dec==$spe_tar_dec) $spe_act_dec_cell_color=" amber ";
elseif ($spe_act_dec<$spe_tar_dec) $spe_act_dec_cell_color=" green ";
if ($Q4_spe_actual>$Q4_spe_target) $Q4_spe_actual_cell_color=" red ";
elseif ($Q4_spe_actual==0) $Q4_spe_actual_cell_color=" green ";
elseif ($Q4_spe_actual==$Q4_spe_target) $Q4_spe_actual_cell_color=" amber ";
elseif ($Q4_spe_actual<$Q4_spe_target) $Q4_spe_actual_cell_color=" green ";
if (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)>($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=" red ";
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)==0) $YTD_spe_actual_cell_color=" green ";
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)==($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=" amber ";
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)<($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=" green ";

$Q1_7day_actual_cell_color = $Q2_7day_actual_cell_color = $Q3_7day_actual_cell_color = $Q4_7day_actual_cell_color = $YTD_7day_actual_cell_color = '';
$day7_act_jan_cell_color = $day7_act_feb_cell_color = $day7_act_mar_cell_color = $day7_act_apr_cell_color = $day7_act_may_cell_color = $day7_act_jun_cell_color = $day7_act_jul_cell_color = $day7_act_aug_cell_color = $day7_act_sep_cell_color = $day7_act_oct_cell_color = $day7_act_nov_cell_color = $day7_act_dec_cell_color = '';
if ($day7_act_jan>$day7_tar_jan) $day7_act_jan_cell_color=" red ";
elseif ($day7_act_jan==0) $day7_act_jan_cell_color=" green ";
elseif ($day7_act_jan==$day7_tar_jan) $day7_act_jan_cell_color=" amber ";
elseif ($day7_act_jan<$day7_tar_jan) $day7_act_jan_cell_color=" green ";
if ($day7_act_feb>$day7_tar_feb) $day7_act_feb_cell_color=" red ";
elseif ($day7_act_feb==0) $day7_act_feb_cell_color=" green ";
elseif ($day7_act_feb==$day7_tar_feb) $day7_act_feb_cell_color=" amber ";
elseif ($day7_act_feb<$day7_tar_feb) $day7_act_feb_cell_color=" green ";
if ($day7_act_mar>$day7_tar_mar) $day7_act_mar_cell_color=" red ";
elseif ($day7_act_mar==0) $day7_act_mar_cell_color=" green ";
elseif ($day7_act_mar==$day7_tar_mar) $day7_act_mar_cell_color=" amber ";
elseif ($day7_act_mar<$day7_tar_mar) $day7_act_mar_cell_color=" green ";
if ($Q1_7day_actual>$Q1_7day_target) $Q1_7day_actual_cell_color=" red ";
elseif ($Q1_7day_actual==0) $Q1_7day_actual_cell_color=" green ";
elseif ($Q1_7day_actual==$Q1_7day_target) $Q1_7day_actual_cell_color=" amber ";
elseif ($Q1_7day_actual<$Q1_7day_target) $Q1_7day_actual_cell_color=" green ";
if ($day7_act_apr>$day7_tar_apr) $day7_act_apr_cell_color=" red ";
elseif ($day7_act_apr==0) $day7_act_apr_cell_color=" green ";
elseif ($day7_act_apr==$day7_tar_apr) $day7_act_apr_cell_color=" amber ";
elseif ($day7_act_apr<$day7_tar_apr) $day7_act_apr_cell_color=" green ";
if ($day7_act_may>$day7_tar_may) $day7_act_may_cell_color=" red ";
elseif ($day7_act_may==0) $day7_act_may_cell_color=" green ";
elseif ($day7_act_may==$day7_tar_may) $day7_act_may_cell_color=" amber ";
elseif ($day7_act_may<$day7_tar_may) $day7_act_may_cell_color=" green ";
if ($day7_act_jun>$day7_tar_jun) $day7_act_jun_cell_color=" red ";
elseif ($day7_act_jun==0) $day7_act_jun_cell_color=" green ";
elseif ($day7_act_jun==$day7_tar_jun) $day7_act_jun_cell_color=" amber ";
elseif ($day7_act_jun<$day7_tar_jun) $day7_act_jun_cell_color=" green ";
if ($Q2_7day_actual>$Q2_7day_target) $Q2_7day_actual_cell_color=" red ";
elseif ($Q2_7day_actual==0) $Q2_7day_actual_cell_color=" green ";
elseif ($Q2_7day_actual==$Q2_7day_target) $Q2_7day_actual_cell_color=" amber ";
elseif ($Q2_7day_actual<$Q2_7day_target) $Q2_7day_actual_cell_color=" green ";
if ($day7_act_jul>$day7_tar_jul) $day7_act_jul_cell_color=" red ";
elseif ($day7_act_jul==0) $day7_act_jul_cell_color=" green ";
elseif ($day7_act_jul==$day7_tar_jul) $day7_act_jul_cell_color=" amber ";
elseif ($day7_act_jul<$day7_tar_jul) $day7_act_jul_cell_color=" green ";
if ($day7_act_aug>$day7_tar_aug) $day7_act_aug_cell_color=" red ";
elseif ($day7_act_aug==0) $day7_act_aug_cell_color=" green ";
elseif ($day7_act_aug==$day7_tar_aug) $day7_act_aug_cell_color=" amber ";
elseif ($day7_act_aug<$day7_tar_aug) $day7_act_aug_cell_color=" green ";
if ($day7_act_sep>$day7_tar_sep) $day7_act_sep_cell_color=" red ";
elseif ($day7_act_sep==0) $day7_act_sep_cell_color=" green ";
elseif ($day7_act_sep==$day7_tar_sep) $day7_act_sep_cell_color=" amber ";
elseif ($day7_act_sep<$day7_tar_sep) $day7_act_sep_cell_color=" green ";
if ($Q3_7day_actual>$Q3_7day_target) $Q3_7day_actual_cell_color=" red ";
elseif ($Q3_7day_actual==0) $Q3_7day_actual_cell_color=" green ";
elseif ($Q3_7day_actual==$Q3_7day_target) $Q3_7day_actual_cell_color=" amber ";
elseif ($Q3_7day_actual<$Q3_7day_target) $Q3_7day_actual_cell_color=" green ";
if ($day7_act_oct>$day7_tar_oct) $day7_act_oct_cell_color=" red ";
elseif ($day7_act_oct==0) $day7_act_oct_cell_color=" green ";
elseif ($day7_act_oct==$day7_tar_oct) $day7_act_oct_cell_color=" amber ";
elseif ($day7_act_oct<$day7_tar_oct) $day7_act_oct_cell_color=" green ";
if ($day7_act_nov>$day7_tar_nov) $day7_act_nov_cell_color=" red ";
elseif ($day7_act_nov==0) $day7_act_nov_cell_color=" green ";
elseif ($day7_act_nov==$day7_tar_nov) $day7_act_nov_cell_color=" amber ";
elseif ($day7_act_nov<$day7_tar_nov) $day7_act_nov_cell_color=" green ";
if ($day7_act_dec>$day7_tar_dec) $day7_act_dec_cell_color=" red ";
elseif ($day7_act_dec==0) $day7_act_dec_cell_color=" green ";
elseif ($day7_act_dec==$day7_tar_dec) $day7_act_dec_cell_color=" amber ";
elseif ($day7_act_dec<$day7_tar_dec) $day7_act_dec_cell_color=" green ";
if ($Q4_7day_actual>$Q4_7day_target) $Q4_7day_actual_cell_color=" red ";
elseif ($Q4_7day_actual==0) $Q4_7day_actual_cell_color=" green ";
elseif ($Q4_7day_actual==$Q4_7day_target) $Q4_7day_actual_cell_color=" amber ";
elseif ($Q4_7day_actual<$Q4_7day_target) $Q4_7day_actual_cell_color=" green ";
if (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)>($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=" red ";
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)==0) $YTD_7day_actual_cell_color=" green ";
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)==($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=" amber ";
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)<($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=" green ";

$Q1_occu_actual_cell_color = $Q2_occu_actual_cell_color = $Q3_occu_actual_cell_color = $Q4_occu_actual_cell_color = $YTD_occu_actual_cell_color = '';
$occu_act_jan_cell_color = $occu_act_feb_cell_color = $occu_act_mar_cell_color = $occu_act_apr_cell_color = $occu_act_may_cell_color = $occu_act_jun_cell_color = $occu_act_jul_cell_color = $occu_act_aug_cell_color = $occu_act_sep_cell_color = $occu_act_oct_cell_color = $occu_act_nov_cell_color = $occu_act_dec_cell_color = '';
if ($occu_act_jan>$occu_tar_jan) $occu_act_jan_cell_color=" red ";
elseif ($occu_act_jan==0) $occu_act_jan_cell_color=" green ";
elseif ($occu_act_jan==$occu_tar_jan) $occu_act_jan_cell_color=" amber ";
elseif ($occu_act_jan<$occu_tar_jan) $occu_act_jan_cell_color=" green ";
if ($occu_act_feb>$occu_tar_feb) $occu_act_feb_cell_color=" red ";
elseif ($occu_act_feb==0) $occu_act_feb_cell_color=" green ";
elseif ($occu_act_feb==$occu_tar_feb) $occu_act_feb_cell_color=" amber ";
elseif ($occu_act_feb<$occu_tar_feb) $occu_act_feb_cell_color=" green ";
if ($occu_act_mar>$occu_tar_mar) $occu_act_mar_cell_color=" red ";
elseif ($occu_act_mar==0) $occu_act_mar_cell_color=" green ";
elseif ($occu_act_mar==$occu_tar_mar) $occu_act_mar_cell_color=" amber ";
elseif ($occu_act_mar<$occu_tar_mar) $occu_act_mar_cell_color=" green ";
if ($Q1_occu_actual>$Q1_occu_target) $Q1_occu_actual_cell_color=" red ";
elseif ($Q1_occu_actual==0) $Q1_occu_actual_cell_color=" green ";
elseif ($Q1_occu_actual==$Q1_occu_target) $Q1_occu_actual_cell_color=" amber ";
elseif ($Q1_occu_actual<$Q1_occu_target) $Q1_occu_actual_cell_color=" green ";
if ($occu_act_apr>$occu_tar_apr) $occu_act_apr_cell_color=" red ";
elseif ($occu_act_apr==0) $occu_act_apr_cell_color=" green ";
elseif ($occu_act_apr==$occu_tar_apr) $occu_act_apr_cell_color=" amber ";
elseif ($occu_act_apr<$occu_tar_apr) $occu_act_apr_cell_color=" green ";
if ($occu_act_may>$occu_tar_may) $occu_act_may_cell_color=" red ";
elseif ($occu_act_may==0) $occu_act_may_cell_color=" green ";
elseif ($occu_act_may==$occu_tar_may) $occu_act_may_cell_color=" amber ";
elseif ($occu_act_may<$occu_tar_may) $occu_act_may_cell_color=" green ";
if ($occu_act_jun>$occu_tar_jun) $occu_act_jun_cell_color=" red ";
elseif ($occu_act_jun==0) $occu_act_jun_cell_color=" green ";
elseif ($occu_act_jun==$occu_tar_jun) $occu_act_jun_cell_color=" amber ";
elseif ($occu_act_jun<$occu_tar_jun) $occu_act_jun_cell_color=" green ";
if ($Q2_occu_actual>$Q2_occu_target) $Q2_occu_actual_cell_color=" red ";
elseif ($Q2_occu_actual==0) $Q2_occu_actual_cell_color=" green ";
elseif ($Q2_occu_actual==$Q2_occu_target) $Q2_occu_actual_cell_color=" amber ";
elseif ($Q2_occu_actual<$Q2_occu_target) $Q2_occu_actual_cell_color=" green ";
if ($occu_act_jul>$occu_tar_jul) $occu_act_jul_cell_color=" red ";
elseif ($occu_act_jul==0) $occu_act_jul_cell_color=" green ";
elseif ($occu_act_jul==$occu_tar_jul) $occu_act_jul_cell_color=" amber ";
elseif ($occu_act_jul<$occu_tar_jul) $occu_act_jul_cell_color=" green ";
if ($occu_act_aug>$occu_tar_aug) $occu_act_aug_cell_color=" red ";
elseif ($occu_act_aug==0) $occu_act_aug_cell_color=" green ";
elseif ($occu_act_aug==$occu_tar_aug) $occu_act_aug_cell_color=" amber ";
elseif ($occu_act_aug<$occu_tar_aug) $occu_act_aug_cell_color=" green ";
if ($occu_act_sep>$occu_tar_sep) $occu_act_sep_cell_color=" red ";
elseif ($occu_act_sep==0) $occu_act_sep_cell_color=" green ";
elseif ($occu_act_sep==$occu_tar_sep) $occu_act_sep_cell_color=" amber ";
elseif ($occu_act_sep<$occu_tar_sep) $occu_act_sep_cell_color=" green ";
if ($Q3_occu_actual>$Q3_occu_target) $Q3_occu_actual_cell_color=" red ";
elseif ($Q3_occu_actual==0) $Q3_occu_actual_cell_color=" green ";
elseif ($Q3_occu_actual==$Q3_occu_target) $Q3_occu_actual_cell_color=" amber ";
elseif ($Q3_occu_actual<$Q3_occu_target) $Q3_occu_actual_cell_color=" green ";
if ($occu_act_oct>$occu_tar_oct) $occu_act_oct_cell_color=" red ";
elseif ($occu_act_oct==0) $occu_act_oct_cell_color=" green ";
elseif ($occu_act_oct==$occu_tar_oct) $occu_act_oct_cell_color=" amber ";
elseif ($occu_act_oct<$occu_tar_oct) $occu_act_oct_cell_color=" green ";
if ($occu_act_nov>$occu_tar_nov) $occu_act_nov_cell_color=" red ";
elseif ($occu_act_nov==0) $occu_act_nov_cell_color=" green ";
elseif ($occu_act_nov==$occu_tar_nov) $occu_act_nov_cell_color=" amber ";
elseif ($occu_act_nov<$occu_tar_nov) $occu_act_nov_cell_color=" green ";
if ($occu_act_dec>$occu_tar_dec) $occu_act_dec_cell_color=" red ";
elseif ($occu_act_dec==0) $occu_act_dec_cell_color=" green ";
elseif ($occu_act_dec==$occu_tar_dec) $occu_act_dec_cell_color=" amber ";
elseif ($occu_act_dec<$occu_tar_dec) $occu_act_dec_cell_color=" green ";
if ($Q4_occu_actual>$Q4_occu_target) $Q4_occu_actual_cell_color=" red ";
elseif ($Q4_occu_actual==0) $Q4_occu_actual_cell_color=" green ";
elseif ($Q4_occu_actual==$Q4_occu_target) $Q4_occu_actual_cell_color=" amber ";
elseif ($Q4_occu_actual<$Q4_occu_target) $Q4_occu_actual_cell_color=" green ";
if (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)>($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=" red ";
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)==0) $YTD_occu_actual_cell_color=" green ";
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)==($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=" amber ";
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)<($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=" green ";

$Q1_dan_actual_cell_color = $Q2_dan_actual_cell_color = $Q3_dan_actual_cell_color = $Q4_dan_actual_cell_color = $YTD_dan_actual_cell_color = '';
$dan_act_jan_cell_color = $dan_act_feb_cell_color = $dan_act_mar_cell_color = $dan_act_apr_cell_color = $dan_act_may_cell_color = $dan_act_jun_cell_color = $dan_act_jul_cell_color = $dan_act_aug_cell_color = $dan_act_sep_cell_color = $dan_act_oct_cell_color = $dan_act_nov_cell_color = $dan_act_dec_cell_color = '';
if ($dan_act_jan>$dan_tar_jan) $dan_act_jan_cell_color=" red ";
elseif ($dan_act_jan==0) $dan_act_jan_cell_color=" green ";
elseif ($dan_act_jan==$dan_tar_jan) $dan_act_jan_cell_color=" amber ";
elseif ($dan_act_jan<$dan_tar_jan) $dan_act_jan_cell_color=" green ";
if ($dan_act_feb>$dan_tar_feb) $dan_act_feb_cell_color=" red ";
elseif ($dan_act_feb==0) $dan_act_feb_cell_color=" green ";
elseif ($dan_act_feb==$dan_tar_feb) $dan_act_feb_cell_color=" amber ";
elseif ($dan_act_feb<$dan_tar_feb) $dan_act_feb_cell_color=" green ";
if ($dan_act_mar>$dan_tar_mar) $dan_act_mar_cell_color=" red ";
elseif ($dan_act_mar==0) $dan_act_mar_cell_color=" green ";
elseif ($dan_act_mar==$dan_tar_mar) $dan_act_mar_cell_color=" amber ";
elseif ($dan_act_mar<$dan_tar_mar) $dan_act_mar_cell_color=" green ";
if ($Q1_dan_actual>$Q1_dan_target) $Q1_dan_actual_cell_color=" red ";
elseif ($Q1_dan_actual==0) $Q1_dan_actual_cell_color=" green ";
elseif ($Q1_dan_actual==$Q1_dan_target) $Q1_dan_actual_cell_color=" amber ";
elseif ($Q1_dan_actual<$Q1_dan_target) $Q1_dan_actual_cell_color=" green ";
if ($dan_act_apr>$dan_tar_apr) $dan_act_apr_cell_color=" red ";
elseif ($dan_act_apr==0) $dan_act_apr_cell_color=" green ";
elseif ($dan_act_apr==$dan_tar_apr) $dan_act_apr_cell_color=" amber ";
elseif ($dan_act_apr<$dan_tar_apr) $dan_act_apr_cell_color=" green ";
if ($dan_act_may>$dan_tar_may) $dan_act_may_cell_color=" red ";
elseif ($dan_act_may==0) $dan_act_may_cell_color=" green ";
elseif ($dan_act_may==$dan_tar_may) $dan_act_may_cell_color=" amber ";
elseif ($dan_act_may<$dan_tar_may) $dan_act_may_cell_color=" green ";
if ($dan_act_jun>$dan_tar_jun) $dan_act_jun_cell_color=" red ";
elseif ($dan_act_jun==0) $dan_act_jun_cell_color=" green ";
elseif ($dan_act_jun==$dan_tar_jun) $dan_act_jun_cell_color=" amber ";
elseif ($dan_act_jun<$dan_tar_jun) $dan_act_jun_cell_color=" green ";
if ($Q2_dan_actual>$Q2_dan_target) $Q2_dan_actual_cell_color=" red ";
elseif ($Q2_dan_actual==0) $Q2_dan_actual_cell_color=" green ";
elseif ($Q2_dan_actual==$Q2_dan_target) $Q2_dan_actual_cell_color=" amber ";
elseif ($Q2_dan_actual<$Q2_dan_target) $Q2_dan_actual_cell_color=" green ";
if ($dan_act_jul>$dan_tar_jul) $dan_act_jul_cell_color=" red ";
elseif ($dan_act_jul==0) $dan_act_jul_cell_color=" green ";
elseif ($dan_act_jul==$dan_tar_jul) $dan_act_jul_cell_color=" amber ";
elseif ($dan_act_jul<$dan_tar_jul) $dan_act_jul_cell_color=" green ";
if ($dan_act_aug>$dan_tar_aug) $dan_act_aug_cell_color=" red ";
elseif ($dan_act_aug==0) $dan_act_aug_cell_color=" green ";
elseif ($dan_act_aug==$dan_tar_aug) $dan_act_aug_cell_color=" amber ";
elseif ($dan_act_aug<$dan_tar_aug) $dan_act_aug_cell_color=" green ";
if ($dan_act_sep>$dan_tar_sep) $dan_act_sep_cell_color=" red ";
elseif ($dan_act_sep==0) $dan_act_sep_cell_color=" green ";
elseif ($dan_act_sep==$dan_tar_sep) $dan_act_sep_cell_color=" amber ";
elseif ($dan_act_sep<$dan_tar_sep) $dan_act_sep_cell_color=" green ";
if ($Q3_dan_actual>$Q3_dan_target) $Q3_dan_actual_cell_color=" red ";
elseif ($Q3_dan_actual==0) $Q3_dan_actual_cell_color=" green ";
elseif ($Q3_dan_actual==$Q3_dan_target) $Q3_dan_actual_cell_color=" amber ";
elseif ($Q3_dan_actual<$Q3_dan_target) $Q3_dan_actual_cell_color=" green ";
if ($dan_act_oct>$dan_tar_oct) $dan_act_oct_cell_color=" red ";
elseif ($dan_act_oct==0) $dan_act_oct_cell_color=" green ";
elseif ($dan_act_oct==$dan_tar_oct) $dan_act_oct_cell_color=" amber ";
elseif ($dan_act_oct<$dan_tar_oct) $dan_act_oct_cell_color=" green ";
if ($dan_act_nov>$dan_tar_nov) $dan_act_nov_cell_color=" red ";
elseif ($dan_act_nov==0) $dan_act_nov_cell_color=" green ";
elseif ($dan_act_nov==$dan_tar_nov) $dan_act_nov_cell_color=" amber ";
elseif ($dan_act_nov<$dan_tar_nov) $dan_act_nov_cell_color=" green ";
if ($dan_act_dec>$dan_tar_dec) $dan_act_dec_cell_color=" red ";
elseif ($dan_act_dec==0) $dan_act_dec_cell_color=" green ";
elseif ($dan_act_dec==$dan_tar_dec) $dan_act_dec_cell_color=" amber ";
elseif ($dan_act_dec<$dan_tar_dec) $dan_act_dec_cell_color=" green ";
if ($Q4_dan_actual>$Q4_dan_target) $Q4_dan_actual_cell_color=" red ";
elseif ($Q4_dan_actual==0) $Q4_dan_actual_cell_color=" green ";
elseif ($Q4_dan_actual==$Q4_dan_target) $Q4_dan_actual_cell_color=" amber ";
elseif ($Q4_dan_actual<$Q4_dan_target) $Q4_dan_actual_cell_color=" green ";
if (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)>($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=" red ";
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)==0) $YTD_dan_actual_cell_color=" green ";
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)==($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=" amber ";
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)<($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=" green ";

$Q1_nonf_actual_cell_color = $Q2_nonf_actual_cell_color = $Q3_nonf_actual_cell_color = $Q4_nonf_actual_cell_color = $YTD_nonf_actual_cell_color = '';
$nonf_act_jan_cell_color = $nonf_act_feb_cell_color = $nonf_act_mar_cell_color = $nonf_act_apr_cell_color = $nonf_act_may_cell_color = $nonf_act_jun_cell_color = $nonf_act_jul_cell_color = $nonf_act_aug_cell_color = $nonf_act_sep_cell_color = $nonf_act_oct_cell_color = $nonf_act_nov_cell_color = $nonf_act_dec_cell_color = '';
if ($nonf_act_jan>$nonf_tar_jan) $nonf_act_jan_cell_color=" red ";
elseif ($nonf_act_jan==0) $nonf_act_jan_cell_color=" green ";
elseif ($nonf_act_jan==$nonf_tar_jan) $nonf_act_jan_cell_color=" amber ";
elseif ($nonf_act_jan<$nonf_tar_jan) $nonf_act_jan_cell_color=" green ";
if ($nonf_act_feb>$nonf_tar_feb) $nonf_act_feb_cell_color=" red ";
elseif ($nonf_act_feb==0) $nonf_act_feb_cell_color=" green ";
elseif ($nonf_act_feb==$nonf_tar_feb) $nonf_act_feb_cell_color=" amber ";
elseif ($nonf_act_feb<$nonf_tar_feb) $nonf_act_feb_cell_color=" green ";
if ($nonf_act_mar>$nonf_tar_mar) $nonf_act_mar_cell_color=" red ";
elseif ($nonf_act_mar==0) $nonf_act_mar_cell_color=" green ";
elseif ($nonf_act_mar==$nonf_tar_mar) $nonf_act_mar_cell_color=" amber ";
elseif ($nonf_act_mar<$nonf_tar_mar) $nonf_act_mar_cell_color=" green ";
if ($Q1_nonf_actual>$Q1_nonf_target) $Q1_nonf_actual_cell_color=" red ";
elseif ($Q1_nonf_actual==0) $Q1_nonf_actual_cell_color=" green ";
elseif ($Q1_nonf_actual==$Q1_nonf_target) $Q1_nonf_actual_cell_color=" amber ";
elseif ($Q1_nonf_actual<$Q1_nonf_target) $Q1_nonf_actual_cell_color=" green ";
if ($nonf_act_apr>$nonf_tar_apr) $nonf_act_apr_cell_color=" red ";
elseif ($nonf_act_apr==0) $nonf_act_apr_cell_color=" green ";
elseif ($nonf_act_apr==$nonf_tar_apr) $nonf_act_apr_cell_color=" amber ";
elseif ($nonf_act_apr<$nonf_tar_apr) $nonf_act_apr_cell_color=" green ";
if ($nonf_act_may>$nonf_tar_may) $nonf_act_may_cell_color=" red ";
elseif ($nonf_act_may==0) $nonf_act_may_cell_color=" green ";
elseif ($nonf_act_may==$nonf_tar_may) $nonf_act_may_cell_color=" amber ";
elseif ($nonf_act_may<$nonf_tar_may) $nonf_act_may_cell_color=" green ";
if ($nonf_act_jun>$nonf_tar_jun) $nonf_act_jun_cell_color=" red ";
elseif ($nonf_act_jun==0) $nonf_act_jun_cell_color=" green ";
elseif ($nonf_act_jun==$nonf_tar_jun) $nonf_act_jun_cell_color=" amber ";
elseif ($nonf_act_jun<$nonf_tar_jun) $nonf_act_jun_cell_color=" green ";
if ($Q2_nonf_actual>$Q2_nonf_target) $Q2_nonf_actual_cell_color=" red ";
elseif ($Q2_nonf_actual==0) $Q2_nonf_actual_cell_color=" green ";
elseif ($Q2_nonf_actual==$Q2_nonf_target) $Q2_nonf_actual_cell_color=" amber ";
elseif ($Q2_nonf_actual<$Q2_nonf_target) $Q2_nonf_actual_cell_color=" green ";
if ($nonf_act_jul>$nonf_tar_jul) $nonf_act_jul_cell_color=" red ";
elseif ($nonf_act_jul==0) $nonf_act_jul_cell_color=" green ";
elseif ($nonf_act_jul==$nonf_tar_jul) $nonf_act_jul_cell_color=" amber ";
elseif ($nonf_act_jul<$nonf_tar_jul) $nonf_act_jul_cell_color=" green ";
if ($nonf_act_aug>$nonf_tar_aug) $nonf_act_aug_cell_color=" red ";
elseif ($nonf_act_aug==0) $nonf_act_aug_cell_color=" green ";
elseif ($nonf_act_aug==$nonf_tar_aug) $nonf_act_aug_cell_color=" amber ";
elseif ($nonf_act_aug<$nonf_tar_aug) $nonf_act_aug_cell_color=" green ";
if ($nonf_act_sep>$nonf_tar_sep) $nonf_act_sep_cell_color=" red ";
elseif ($nonf_act_sep==0) $nonf_act_sep_cell_color=" green ";
elseif ($nonf_act_sep==$nonf_tar_sep) $nonf_act_sep_cell_color=" amber ";
elseif ($nonf_act_sep<$nonf_tar_sep) $nonf_act_sep_cell_color=" green ";
if ($Q3_nonf_actual>$Q3_nonf_target) $Q3_nonf_actual_cell_color=" red ";
elseif ($Q3_nonf_actual==0) $Q3_nonf_actual_cell_color=" green ";
elseif ($Q3_nonf_actual==$Q3_nonf_target) $Q3_nonf_actual_cell_color=" amber ";
elseif ($Q3_nonf_actual<$Q3_nonf_target) $Q3_nonf_actual_cell_color=" green ";
if ($nonf_act_oct>$nonf_tar_oct) $nonf_act_oct_cell_color=" red ";
elseif ($nonf_act_oct==0) $nonf_act_oct_cell_color=" green ";
elseif ($nonf_act_oct==$nonf_tar_oct) $nonf_act_oct_cell_color=" amber ";
elseif ($nonf_act_oct<$nonf_tar_oct) $nonf_act_oct_cell_color=" green ";
if ($nonf_act_nov>$nonf_tar_nov) $nonf_act_nov_cell_color=" red ";
elseif ($nonf_act_nov==0) $nonf_act_nov_cell_color=" green ";
elseif ($nonf_act_nov==$nonf_tar_nov) $nonf_act_nov_cell_color=" amber ";
elseif ($nonf_act_nov<$nonf_tar_nov) $nonf_act_nov_cell_color=" green ";
if ($nonf_act_dec>$nonf_tar_dec) $nonf_act_dec_cell_color=" red ";
elseif ($nonf_act_dec==0) $nonf_act_dec_cell_color=" green ";
elseif ($nonf_act_dec==$nonf_tar_dec) $nonf_act_dec_cell_color=" amber ";
elseif ($nonf_act_dec<$nonf_tar_dec) $nonf_act_dec_cell_color=" green ";
if ($Q4_nonf_actual>$Q4_nonf_target) $Q4_nonf_actual_cell_color=" red ";
elseif ($Q4_nonf_actual==0) $Q4_nonf_actual_cell_color=" green ";
elseif ($Q4_nonf_actual==$Q4_nonf_target) $Q4_nonf_actual_cell_color=" amber ";
elseif ($Q4_nonf_actual<$Q4_nonf_target) $Q4_nonf_actual_cell_color=" green ";
if (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)>($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=" red ";
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)==0) $YTD_nonf_actual_cell_color=" green ";
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)==($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=" amber ";
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)<($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=" green ";

$Q1_gas_actual_cell_color = $Q2_gas_actual_cell_color = $Q3_gas_actual_cell_color = $Q4_gas_actual_cell_color = $YTD_gas_actual_cell_color = '';
$gas_act_jan_cell_color = $gas_act_feb_cell_color = $gas_act_mar_cell_color = $gas_act_apr_cell_color = $gas_act_may_cell_color = $gas_act_jun_cell_color = $gas_act_jul_cell_color = $gas_act_aug_cell_color = $gas_act_sep_cell_color = $gas_act_oct_cell_color = $gas_act_nov_cell_color = $gas_act_dec_cell_color = '';
if ($gas_act_jan>$gas_tar_jan) $gas_act_jan_cell_color=" red ";
elseif ($gas_act_jan==0) $gas_act_jan_cell_color=" green ";
elseif ($gas_act_jan==$gas_tar_jan) $gas_act_jan_cell_color=" amber ";
elseif ($gas_act_jan<$gas_tar_jan) $gas_act_jan_cell_color=" green ";
if ($gas_act_feb>$gas_tar_feb) $gas_act_feb_cell_color=" red ";
elseif ($gas_act_feb==0) $gas_act_feb_cell_color=" green ";
elseif ($gas_act_feb==$gas_tar_feb) $gas_act_feb_cell_color=" amber ";
elseif ($gas_act_feb<$gas_tar_feb) $gas_act_feb_cell_color=" green ";
if ($gas_act_mar>$gas_tar_mar) $gas_act_mar_cell_color=" red ";
elseif ($gas_act_mar==0) $gas_act_mar_cell_color=" green ";
elseif ($gas_act_mar==$gas_tar_mar) $gas_act_mar_cell_color=" amber ";
elseif ($gas_act_mar<$gas_tar_mar) $gas_act_mar_cell_color=" green ";
if ($Q1_gas_actual>$Q1_gas_target) $Q1_gas_actual_cell_color=" red ";
elseif ($Q1_gas_actual==0) $Q1_gas_actual_cell_color=" green ";
elseif ($Q1_gas_actual==$Q1_gas_target) $Q1_gas_actual_cell_color=" amber ";
elseif ($Q1_gas_actual<$Q1_gas_target) $Q1_gas_actual_cell_color=" green ";
if ($gas_act_apr>$gas_tar_apr) $gas_act_apr_cell_color=" red ";
elseif ($gas_act_apr==0) $gas_act_apr_cell_color=" green ";
elseif ($gas_act_apr==$gas_tar_apr) $gas_act_apr_cell_color=" amber ";
elseif ($gas_act_apr<$gas_tar_apr) $gas_act_apr_cell_color=" green ";
if ($gas_act_may>$gas_tar_may) $gas_act_may_cell_color=" red ";
elseif ($gas_act_may==0) $gas_act_may_cell_color=" green ";
elseif ($gas_act_may==$gas_tar_may) $gas_act_may_cell_color=" amber ";
elseif ($gas_act_may<$gas_tar_may) $gas_act_may_cell_color=" green ";
if ($gas_act_jun>$gas_tar_jun) $gas_act_jun_cell_color=" red ";
elseif ($gas_act_jun==0) $gas_act_jun_cell_color=" green ";
elseif ($gas_act_jun==$gas_tar_jun) $gas_act_jun_cell_color=" amber ";
elseif ($gas_act_jun<$gas_tar_jun) $gas_act_jun_cell_color=" green ";
if ($Q2_gas_actual>$Q2_gas_target) $Q2_gas_actual_cell_color=" red ";
elseif ($Q2_gas_actual==0) $Q2_gas_actual_cell_color=" green ";
elseif ($Q2_gas_actual==$Q2_gas_target) $Q2_gas_actual_cell_color=" amber ";
elseif ($Q2_gas_actual<$Q2_gas_target) $Q2_gas_actual_cell_color=" green ";
if ($gas_act_jul>$gas_tar_jul) $gas_act_jul_cell_color=" red ";
elseif ($gas_act_jul==0) $gas_act_jul_cell_color=" green ";
elseif ($gas_act_jul==$gas_tar_jul) $gas_act_jul_cell_color=" amber ";
elseif ($gas_act_jul<$gas_tar_jul) $gas_act_jul_cell_color=" green ";
if ($gas_act_aug>$gas_tar_aug) $gas_act_aug_cell_color=" red ";
elseif ($gas_act_aug==0) $gas_act_aug_cell_color=" green ";
elseif ($gas_act_aug==$gas_tar_aug) $gas_act_aug_cell_color=" amber ";
elseif ($gas_act_aug<$gas_tar_aug) $gas_act_aug_cell_color=" green ";
if ($gas_act_sep>$gas_tar_sep) $gas_act_sep_cell_color=" red ";
elseif ($gas_act_sep==0) $gas_act_sep_cell_color=" green ";
elseif ($gas_act_sep==$gas_tar_sep) $gas_act_sep_cell_color=" amber ";
elseif ($gas_act_sep<$gas_tar_sep) $gas_act_sep_cell_color=" green ";
if ($Q3_gas_actual>$Q3_gas_target) $Q3_gas_actual_cell_color=" red ";
elseif ($Q3_gas_actual==0) $Q3_gas_actual_cell_color=" green ";
elseif ($Q3_gas_actual==$Q3_gas_target) $Q3_gas_actual_cell_color=" amber ";
elseif ($Q3_gas_actual<$Q3_gas_target) $Q3_gas_actual_cell_color=" green ";
if ($gas_act_oct>$gas_tar_oct) $gas_act_oct_cell_color=" red ";
elseif ($gas_act_oct==0) $gas_act_oct_cell_color=" green ";
elseif ($gas_act_oct==$gas_tar_oct) $gas_act_oct_cell_color=" amber ";
elseif ($gas_act_oct<$gas_tar_oct) $gas_act_oct_cell_color=" green ";
if ($gas_act_nov>$gas_tar_nov) $gas_act_nov_cell_color=" red ";
elseif ($gas_act_nov==0) $gas_act_nov_cell_color=" green ";
elseif ($gas_act_nov==$gas_tar_nov) $gas_act_nov_cell_color=" amber ";
elseif ($gas_act_nov<$gas_tar_nov) $gas_act_nov_cell_color=" green ";
if ($gas_act_dec>$gas_tar_dec) $gas_act_dec_cell_color=" red ";
elseif ($gas_act_dec==0) $gas_act_dec_cell_color=" green ";
elseif ($gas_act_dec==$gas_tar_dec) $gas_act_dec_cell_color=" amber ";
elseif ($gas_act_dec<$gas_tar_dec) $gas_act_dec_cell_color=" green ";
if ($Q4_gas_actual>$Q4_gas_target) $Q4_gas_actual_cell_color=" red ";
elseif ($Q4_gas_actual==0) $Q4_gas_actual_cell_color=" green ";
elseif ($Q4_gas_actual==$Q4_gas_target) $Q4_gas_actual_cell_color=" amber ";
elseif ($Q4_gas_actual<$Q4_gas_target) $Q4_gas_actual_cell_color=" green ";
if (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)>($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=" red ";
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)==0) $YTD_gas_actual_cell_color=" green ";
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)==($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=" amber ";
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)<($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=" green ";

$Q1_ridd_actual_cell_color = $Q2_ridd_actual_cell_color = $Q3_ridd_actual_cell_color = $Q4_ridd_actual_cell_color = $YTD_ridd_actual_cell_color = '';
$ridd_act_jan_cell_color = $ridd_act_feb_cell_color = $ridd_act_mar_cell_color = $ridd_act_apr_cell_color = $ridd_act_may_cell_color = $ridd_act_jun_cell_color = $ridd_act_jul_cell_color = $ridd_act_aug_cell_color = $ridd_act_sep_cell_color = $ridd_act_oct_cell_color = $ridd_act_nov_cell_color = $ridd_act_dec_cell_color = '';
if ($ridd_act_jan>$ridd_tar_jan) $ridd_act_jan_cell_color=" red ";
elseif ($ridd_act_jan==0) $ridd_act_jan_cell_color=" green ";
elseif ($ridd_act_jan==$ridd_tar_jan) $ridd_act_jan_cell_color=" amber ";
elseif ($ridd_act_jan<$ridd_tar_jan) $ridd_act_jan_cell_color=" green ";
if ($ridd_act_feb>$ridd_tar_feb) $ridd_act_feb_cell_color=" red ";
elseif ($ridd_act_feb==0) $ridd_act_feb_cell_color=" green ";
elseif ($ridd_act_feb==$ridd_tar_feb) $ridd_act_feb_cell_color=" amber ";
elseif ($ridd_act_feb<$ridd_tar_feb) $ridd_act_feb_cell_color=" green ";
if ($ridd_act_mar>$ridd_tar_mar) $ridd_act_mar_cell_color=" red ";
elseif ($ridd_act_mar==0) $ridd_act_mar_cell_color=" green ";
elseif ($ridd_act_mar==$ridd_tar_mar) $ridd_act_mar_cell_color=" amber ";
elseif ($ridd_act_mar<$ridd_tar_mar) $ridd_act_mar_cell_color=" green ";
if ($Q1_ridd_actual>$Q1_ridd_target) $Q1_ridd_actual_cell_color=" red ";
elseif ($Q1_ridd_actual==0) $Q1_ridd_actual_cell_color=" green ";
elseif ($Q1_ridd_actual==$Q1_ridd_target) $Q1_ridd_actual_cell_color=" amber ";
elseif ($Q1_ridd_actual<$Q1_ridd_target) $Q1_ridd_actual_cell_color=" green ";
if ($ridd_act_apr>$ridd_tar_apr) $ridd_act_apr_cell_color=" red ";
elseif ($ridd_act_apr==0) $ridd_act_apr_cell_color=" green ";
elseif ($ridd_act_apr==$ridd_tar_apr) $ridd_act_apr_cell_color=" amber ";
elseif ($ridd_act_apr<$ridd_tar_apr) $ridd_act_apr_cell_color=" green ";
if ($ridd_act_may>$ridd_tar_may) $ridd_act_may_cell_color=" red ";
elseif ($ridd_act_may==0) $ridd_act_may_cell_color=" green ";
elseif ($ridd_act_may==$ridd_tar_may) $ridd_act_may_cell_color=" amber ";
elseif ($ridd_act_may<$ridd_tar_may) $ridd_act_may_cell_color=" green ";
if ($ridd_act_jun>$ridd_tar_jun) $ridd_act_jun_cell_color=" red ";
elseif ($ridd_act_jun==0) $ridd_act_jun_cell_color=" green ";
elseif ($ridd_act_jun==$ridd_tar_jun) $ridd_act_jun_cell_color=" amber ";
elseif ($ridd_act_jun<$ridd_tar_jun) $ridd_act_jun_cell_color=" green ";
if ($Q2_ridd_actual>$Q2_ridd_target) $Q2_ridd_actual_cell_color=" red ";
elseif ($Q2_ridd_actual==0) $Q2_ridd_actual_cell_color=" green ";
elseif ($Q2_ridd_actual==$Q2_ridd_target) $Q2_ridd_actual_cell_color=" amber ";
elseif ($Q2_ridd_actual<$Q2_ridd_target) $Q2_ridd_actual_cell_color=" green ";
if ($ridd_act_jul>$ridd_tar_jul) $ridd_act_jul_cell_color=" red ";
elseif ($ridd_act_jul==0) $ridd_act_jul_cell_color=" green ";
elseif ($ridd_act_jul==$ridd_tar_jul) $ridd_act_jul_cell_color=" amber ";
elseif ($ridd_act_jul<$ridd_tar_jul) $ridd_act_jul_cell_color=" green ";
if ($ridd_act_aug>$ridd_tar_aug) $ridd_act_aug_cell_color=" red ";
elseif ($ridd_act_aug==0) $ridd_act_aug_cell_color=" green ";
elseif ($ridd_act_aug==$ridd_tar_aug) $ridd_act_aug_cell_color=" amber ";
elseif ($ridd_act_aug<$ridd_tar_aug) $ridd_act_aug_cell_color=" green ";
if ($ridd_act_sep>$ridd_tar_sep) $ridd_act_sep_cell_color=" red ";
elseif ($ridd_act_sep==0) $ridd_act_sep_cell_color=" green ";
elseif ($ridd_act_sep==$ridd_tar_sep) $ridd_act_sep_cell_color=" amber ";
elseif ($ridd_act_sep<$ridd_tar_sep) $ridd_act_sep_cell_color=" green ";
if ($Q3_ridd_actual>$Q3_ridd_target) $Q3_ridd_actual_cell_color=" red ";
elseif ($Q3_ridd_actual==0) $Q3_ridd_actual_cell_color=" green ";
elseif ($Q3_ridd_actual==$Q3_ridd_target) $Q3_ridd_actual_cell_color=" amber ";
elseif ($Q3_ridd_actual<$Q3_ridd_target) $Q3_ridd_actual_cell_color=" green ";
if ($ridd_act_oct>$ridd_tar_oct) $ridd_act_oct_cell_color=" red ";
elseif ($ridd_act_oct==0) $ridd_act_oct_cell_color=" green ";
elseif ($ridd_act_oct==$ridd_tar_oct) $ridd_act_oct_cell_color=" amber ";
elseif ($ridd_act_oct<$ridd_tar_oct) $ridd_act_oct_cell_color=" green ";
if ($ridd_act_nov>$ridd_tar_nov) $ridd_act_nov_cell_color=" red ";
elseif ($ridd_act_nov==0) $ridd_act_nov_cell_color=" green ";
elseif ($ridd_act_nov==$ridd_tar_nov) $ridd_act_nov_cell_color=" amber ";
elseif ($ridd_act_nov<$ridd_tar_nov) $ridd_act_nov_cell_color=" green ";
if ($ridd_act_dec>$ridd_tar_dec) $ridd_act_dec_cell_color=" red ";
elseif ($ridd_act_dec==0) $ridd_act_dec_cell_color=" green ";
elseif ($ridd_act_dec==$ridd_tar_dec) $ridd_act_dec_cell_color=" amber ";
elseif ($ridd_act_dec<$ridd_tar_dec) $ridd_act_dec_cell_color=" green ";
if ($Q4_ridd_actual>$Q4_ridd_target) $Q4_ridd_actual_cell_color=" red ";
elseif ($Q4_ridd_actual==0) $Q4_ridd_actual_cell_color=" green ";
elseif ($Q4_ridd_actual==$Q4_ridd_target) $Q4_ridd_actual_cell_color=" amber ";
elseif ($Q4_ridd_actual<$Q4_ridd_target) $Q4_ridd_actual_cell_color=" green ";
if (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)>($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=" red ";
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)==0) $YTD_ridd_actual_cell_color=" green ";
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)==($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=" amber ";
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)<($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=" green ";

$Q1_medi_actual_cell_color = $Q2_medi_actual_cell_color = $Q3_medi_actual_cell_color = $Q4_medi_actual_cell_color = $YTD_medi_actual_cell_color = '';
$medi_act_jan_cell_color = $medi_act_feb_cell_color = $medi_act_mar_cell_color = $medi_act_apr_cell_color = $medi_act_may_cell_color = $medi_act_jun_cell_color = $medi_act_jul_cell_color = $medi_act_aug_cell_color = $medi_act_sep_cell_color = $medi_act_oct_cell_color = $medi_act_nov_cell_color = $medi_act_dec_cell_color = '';
if ($medi_act_jan>$medi_tar_jan) $medi_act_jan_cell_color=" red ";
elseif ($medi_act_jan==0) $medi_act_jan_cell_color=" green ";
elseif ($medi_act_jan==$medi_tar_jan) $medi_act_jan_cell_color=" amber ";
elseif ($medi_act_jan<$medi_tar_jan) $medi_act_jan_cell_color=" green ";
if ($medi_act_feb>$medi_tar_feb) $medi_act_feb_cell_color=" red ";
elseif ($medi_act_feb==0) $medi_act_feb_cell_color=" green ";
elseif ($medi_act_feb==$medi_tar_feb) $medi_act_feb_cell_color=" amber ";
elseif ($medi_act_feb<$medi_tar_feb) $medi_act_feb_cell_color=" green ";
if ($medi_act_mar>$medi_tar_mar) $medi_act_mar_cell_color=" red ";
elseif ($medi_act_mar==0) $medi_act_mar_cell_color=" green ";
elseif ($medi_act_mar==$medi_tar_mar) $medi_act_mar_cell_color=" amber ";
elseif ($medi_act_mar<$medi_tar_mar) $medi_act_mar_cell_color=" green ";
if ($Q1_medi_actual>$Q1_medi_target) $Q1_medi_actual_cell_color=" red ";
elseif ($Q1_medi_actual==0) $Q1_medi_actual_cell_color=" green ";
elseif ($Q1_medi_actual==$Q1_medi_target) $Q1_medi_actual_cell_color=" amber ";
elseif ($Q1_medi_actual<$Q1_medi_target) $Q1_medi_actual_cell_color=" green ";
if ($medi_act_apr>$medi_tar_apr) $medi_act_apr_cell_color=" red ";
elseif ($medi_act_apr==0) $medi_act_apr_cell_color=" green ";
elseif ($medi_act_apr==$medi_tar_apr) $medi_act_apr_cell_color=" amber ";
elseif ($medi_act_apr<$medi_tar_apr) $medi_act_apr_cell_color=" green ";
if ($medi_act_may>$medi_tar_may) $medi_act_may_cell_color=" red ";
elseif ($medi_act_may==0) $medi_act_may_cell_color=" green ";
elseif ($medi_act_may==$medi_tar_may) $medi_act_may_cell_color=" amber ";
elseif ($medi_act_may<$medi_tar_may) $medi_act_may_cell_color=" green ";
if ($medi_act_jun>$medi_tar_jun) $medi_act_jun_cell_color=" red ";
elseif ($medi_act_jun==0) $medi_act_jun_cell_color=" green ";
elseif ($medi_act_jun==$medi_tar_jun) $medi_act_jun_cell_color=" amber ";
elseif ($medi_act_jun<$medi_tar_jun) $medi_act_jun_cell_color=" green ";
if ($Q2_medi_actual>$Q2_medi_target) $Q2_medi_actual_cell_color=" red ";
elseif ($Q2_medi_actual==0) $Q2_medi_actual_cell_color=" green ";
elseif ($Q2_medi_actual==$Q2_medi_target) $Q2_medi_actual_cell_color=" amber ";
elseif ($Q2_medi_actual<$Q2_medi_target) $Q2_medi_actual_cell_color=" green ";
if ($medi_act_jul>$medi_tar_jul) $medi_act_jul_cell_color=" red ";
elseif ($medi_act_jul==0) $medi_act_jul_cell_color=" green ";
elseif ($medi_act_jul==$medi_tar_jul) $medi_act_jul_cell_color=" amber ";
elseif ($medi_act_jul<$medi_tar_jul) $medi_act_jul_cell_color=" green ";
if ($medi_act_aug>$medi_tar_aug) $medi_act_aug_cell_color=" red ";
elseif ($medi_act_aug==0) $medi_act_aug_cell_color=" green ";
elseif ($medi_act_aug==$medi_tar_aug) $medi_act_aug_cell_color=" amber ";
elseif ($medi_act_aug<$medi_tar_aug) $medi_act_aug_cell_color=" green ";
if ($medi_act_sep>$medi_tar_sep) $medi_act_sep_cell_color=" red ";
elseif ($medi_act_sep==0) $medi_act_sep_cell_color=" green ";
elseif ($medi_act_sep==$medi_tar_sep) $medi_act_sep_cell_color=" amber ";
elseif ($medi_act_sep<$medi_tar_sep) $medi_act_sep_cell_color=" green ";
if ($Q3_medi_actual>$Q3_medi_target) $Q3_medi_actual_cell_color=" red ";
elseif ($Q3_medi_actual==0) $Q3_medi_actual_cell_color=" green ";
elseif ($Q3_medi_actual==$Q3_medi_target) $Q3_medi_actual_cell_color=" amber ";
elseif ($Q3_medi_actual<$Q3_medi_target) $Q3_medi_actual_cell_color=" green ";
if ($medi_act_oct>$medi_tar_oct) $medi_act_oct_cell_color=" red ";
elseif ($medi_act_oct==0) $medi_act_oct_cell_color=" green ";
elseif ($medi_act_oct==$medi_tar_oct) $medi_act_oct_cell_color=" amber ";
elseif ($medi_act_oct<$medi_tar_oct) $medi_act_oct_cell_color=" green ";
if ($medi_act_nov>$medi_tar_nov) $medi_act_nov_cell_color=" red ";
elseif ($medi_act_nov==0) $medi_act_nov_cell_color=" green ";
elseif ($medi_act_nov==$medi_tar_nov) $medi_act_nov_cell_color=" amber ";
elseif ($medi_act_nov<$medi_tar_nov) $medi_act_nov_cell_color=" green ";
if ($medi_act_dec>$medi_tar_dec) $medi_act_dec_cell_color=" red ";
elseif ($medi_act_dec==0) $medi_act_dec_cell_color=" green ";
elseif ($medi_act_dec==$medi_tar_dec) $medi_act_dec_cell_color=" amber ";
elseif ($medi_act_dec<$medi_tar_dec) $medi_act_dec_cell_color=" green ";
if ($Q4_medi_actual>$Q4_medi_target) $Q4_medi_actual_cell_color=" red ";
elseif ($Q4_medi_actual==0) $Q4_medi_actual_cell_color=" green ";
elseif ($Q4_medi_actual==$Q4_medi_target) $Q4_medi_actual_cell_color=" amber ";
elseif ($Q4_medi_actual<$Q4_medi_target) $Q4_medi_actual_cell_color=" green ";
if (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)>($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=" red ";
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)==0) $YTD_medi_actual_cell_color=" green ";
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)==($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=" amber ";
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)<($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=" green ";

$Q1_mino_actual_cell_color = $Q2_mino_actual_cell_color = $Q3_mino_actual_cell_color = $Q4_mino_actual_cell_color = $YTD_mino_actual_cell_color = '';
$mino_act_jan_cell_color = $mino_act_feb_cell_color = $mino_act_mar_cell_color = $mino_act_apr_cell_color = $mino_act_may_cell_color = $mino_act_jun_cell_color = $mino_act_jul_cell_color = $mino_act_aug_cell_color = $mino_act_sep_cell_color = $mino_act_oct_cell_color = $mino_act_nov_cell_color = $mino_act_dec_cell_color = '';
if ($mino_act_jan>$mino_tar_jan) $mino_act_jan_cell_color=" red ";
elseif ($mino_act_jan==0) $mino_act_jan_cell_color=" green ";
elseif ($mino_act_jan==$mino_tar_jan) $mino_act_jan_cell_color=" amber ";
elseif ($mino_act_jan<$mino_tar_jan) $mino_act_jan_cell_color=" green ";
if ($mino_act_feb>$mino_tar_feb) $mino_act_feb_cell_color=" red ";
elseif ($mino_act_feb==0) $mino_act_feb_cell_color=" green ";
elseif ($mino_act_feb==$mino_tar_feb) $mino_act_feb_cell_color=" amber ";
elseif ($mino_act_feb<$mino_tar_feb) $mino_act_feb_cell_color=" green ";
if ($mino_act_mar>$mino_tar_mar) $mino_act_mar_cell_color=" red ";
elseif ($mino_act_mar==0) $mino_act_mar_cell_color=" green ";
elseif ($mino_act_mar==$mino_tar_mar) $mino_act_mar_cell_color=" amber ";
elseif ($mino_act_mar<$mino_tar_mar) $mino_act_mar_cell_color=" green ";
if ($Q1_mino_actual>$Q1_mino_target) $Q1_mino_actual_cell_color=" red ";
elseif ($Q1_mino_actual==0) $Q1_mino_actual_cell_color=" green ";
elseif ($Q1_mino_actual==$Q1_mino_target) $Q1_mino_actual_cell_color=" amber ";
elseif ($Q1_mino_actual<$Q1_mino_target) $Q1_mino_actual_cell_color=" green ";
if ($mino_act_apr>$mino_tar_apr) $mino_act_apr_cell_color=" red ";
elseif ($mino_act_apr==0) $mino_act_apr_cell_color=" green ";
elseif ($mino_act_apr==$mino_tar_apr) $mino_act_apr_cell_color=" amber ";
elseif ($mino_act_apr<$mino_tar_apr) $mino_act_apr_cell_color=" green ";
if ($mino_act_may>$mino_tar_may) $mino_act_may_cell_color=" red ";
elseif ($mino_act_may==0) $mino_act_may_cell_color=" green ";
elseif ($mino_act_may==$mino_tar_may) $mino_act_may_cell_color=" amber ";
elseif ($mino_act_may<$mino_tar_may) $mino_act_may_cell_color=" green ";
if ($mino_act_jun>$mino_tar_jun) $mino_act_jun_cell_color=" red ";
elseif ($mino_act_jun==0) $mino_act_jun_cell_color=" green ";
elseif ($mino_act_jun==$mino_tar_jun) $mino_act_jun_cell_color=" amber ";
elseif ($mino_act_jun<$mino_tar_jun) $mino_act_jun_cell_color=" green ";
if ($Q2_mino_actual>$Q2_mino_target) $Q2_mino_actual_cell_color=" red ";
elseif ($Q2_mino_actual==0) $Q2_mino_actual_cell_color=" green ";
elseif ($Q2_mino_actual==$Q2_mino_target) $Q2_mino_actual_cell_color=" amber ";
elseif ($Q2_mino_actual<$Q2_mino_target) $Q2_mino_actual_cell_color=" green ";
if ($mino_act_jul>$mino_tar_jul) $mino_act_jul_cell_color=" red ";
elseif ($mino_act_jul==0) $mino_act_jul_cell_color=" green ";
elseif ($mino_act_jul==$mino_tar_jul) $mino_act_jul_cell_color=" amber ";
elseif ($mino_act_jul<$mino_tar_jul) $mino_act_jul_cell_color=" green ";
if ($mino_act_aug>$mino_tar_aug) $mino_act_aug_cell_color=" red ";
elseif ($mino_act_aug==0) $mino_act_aug_cell_color=" green ";
elseif ($mino_act_aug==$mino_tar_aug) $mino_act_aug_cell_color=" amber ";
elseif ($mino_act_aug<$mino_tar_aug) $mino_act_aug_cell_color=" green ";
if ($mino_act_sep>$mino_tar_sep) $mino_act_sep_cell_color=" red ";
elseif ($mino_act_sep==0) $mino_act_sep_cell_color=" green ";
elseif ($mino_act_sep==$mino_tar_sep) $mino_act_sep_cell_color=" amber ";
elseif ($mino_act_sep<$mino_tar_sep) $mino_act_sep_cell_color=" green ";
if ($Q3_mino_actual>$Q3_mino_target) $Q3_mino_actual_cell_color=" red ";
elseif ($Q3_mino_actual==0) $Q3_mino_actual_cell_color=" green ";
elseif ($Q3_mino_actual==$Q3_mino_target) $Q3_mino_actual_cell_color=" amber ";
elseif ($Q3_mino_actual<$Q3_mino_target) $Q3_mino_actual_cell_color=" green ";
if ($mino_act_oct>$mino_tar_oct) $mino_act_oct_cell_color=" red ";
elseif ($mino_act_oct==0) $mino_act_oct_cell_color=" green ";
elseif ($mino_act_oct==$mino_tar_oct) $mino_act_oct_cell_color=" amber ";
elseif ($mino_act_oct<$mino_tar_oct) $mino_act_oct_cell_color=" green ";
if ($mino_act_nov>$mino_tar_nov) $mino_act_nov_cell_color=" red ";
elseif ($mino_act_nov==0) $mino_act_nov_cell_color=" green ";
elseif ($mino_act_nov==$mino_tar_nov) $mino_act_nov_cell_color=" amber ";
elseif ($mino_act_nov<$mino_tar_nov) $mino_act_nov_cell_color=" green ";
if ($mino_act_dec>$mino_tar_dec) $mino_act_dec_cell_color=" red ";
elseif ($mino_act_dec==0) $mino_act_dec_cell_color=" green ";
elseif ($mino_act_dec==$mino_tar_dec) $mino_act_dec_cell_color=" amber ";
elseif ($mino_act_dec<$mino_tar_dec) $mino_act_dec_cell_color=" green ";
if ($Q4_mino_actual>$Q4_mino_target) $Q4_mino_actual_cell_color=" red ";
elseif ($Q4_mino_actual==0) $Q4_mino_actual_cell_color=" green ";
elseif ($Q4_mino_actual==$Q4_mino_target) $Q4_mino_actual_cell_color=" amber ";
elseif ($Q4_mino_actual<$Q4_mino_target) $Q4_mino_actual_cell_color=" green ";
if (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)>($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=" red ";
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)==0) $YTD_mino_actual_cell_color=" green ";
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)==($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=" amber ";
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)<($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=" green ";

$Q1_lost_actual_cell_color = $Q2_lost_actual_cell_color = $Q3_lost_actual_cell_color = $Q4_lost_actual_cell_color = $YTD_lost_actual_cell_color = '';
$lost_act_jan_cell_color = $lost_act_feb_cell_color = $lost_act_mar_cell_color = $lost_act_apr_cell_color = $lost_act_may_cell_color = $lost_act_jun_cell_color = $lost_act_jul_cell_color = $lost_act_aug_cell_color = $lost_act_sep_cell_color = $lost_act_oct_cell_color = $lost_act_nov_cell_color = $lost_act_dec_cell_color = '';
if ($lost_act_jan>$lost_tar_jan) $lost_act_jan_cell_color=" red ";
elseif ($lost_act_jan==0) $lost_act_jan_cell_color=" green ";
elseif ($lost_act_jan==$lost_tar_jan) $lost_act_jan_cell_color=" amber ";
elseif ($lost_act_jan<$lost_tar_jan) $lost_act_jan_cell_color=" green ";
if ($lost_act_feb>$lost_tar_feb) $lost_act_feb_cell_color=" red ";
elseif ($lost_act_feb==0) $lost_act_feb_cell_color=" green ";
elseif ($lost_act_feb==$lost_tar_feb) $lost_act_feb_cell_color=" amber ";
elseif ($lost_act_feb<$lost_tar_feb) $lost_act_feb_cell_color=" green ";
if ($lost_act_mar>$lost_tar_mar) $lost_act_mar_cell_color=" red ";
elseif ($lost_act_mar==0) $lost_act_mar_cell_color=" green ";
elseif ($lost_act_mar==$lost_tar_mar) $lost_act_mar_cell_color=" amber ";
elseif ($lost_act_mar<$lost_tar_mar) $lost_act_mar_cell_color=" green ";
if ($Q1_lost_actual>$Q1_lost_target) $Q1_lost_actual_cell_color=" red ";
elseif ($Q1_lost_actual==0) $Q1_lost_actual_cell_color=" green ";
elseif ($Q1_lost_actual==$Q1_lost_target) $Q1_lost_actual_cell_color=" amber ";
elseif ($Q1_lost_actual<$Q1_lost_target) $Q1_lost_actual_cell_color=" green ";
if ($lost_act_apr>$lost_tar_apr) $lost_act_apr_cell_color=" red ";
elseif ($lost_act_apr==0) $lost_act_apr_cell_color=" green ";
elseif ($lost_act_apr==$lost_tar_apr) $lost_act_apr_cell_color=" amber ";
elseif ($lost_act_apr<$lost_tar_apr) $lost_act_apr_cell_color=" green ";
if ($lost_act_may>$lost_tar_may) $lost_act_may_cell_color=" red ";
elseif ($lost_act_may==0) $lost_act_may_cell_color=" green ";
elseif ($lost_act_may==$lost_tar_may) $lost_act_may_cell_color=" amber ";
elseif ($lost_act_may<$lost_tar_may) $lost_act_may_cell_color=" green ";
if ($lost_act_jun>$lost_tar_jun) $lost_act_jun_cell_color=" red ";
elseif ($lost_act_jun==0) $lost_act_jun_cell_color=" green ";
elseif ($lost_act_jun==$lost_tar_jun) $lost_act_jun_cell_color=" amber ";
elseif ($lost_act_jun<$lost_tar_jun) $lost_act_jun_cell_color=" green ";
if ($Q2_lost_actual>$Q2_lost_target) $Q2_lost_actual_cell_color=" red ";
elseif ($Q2_lost_actual==0) $Q2_lost_actual_cell_color=" green ";
elseif ($Q2_lost_actual==$Q2_lost_target) $Q2_lost_actual_cell_color=" amber ";
elseif ($Q2_lost_actual<$Q2_lost_target) $Q2_lost_actual_cell_color=" green ";
if ($lost_act_jul>$lost_tar_jul) $lost_act_jul_cell_color=" red ";
elseif ($lost_act_jul==0) $lost_act_jul_cell_color=" green ";
elseif ($lost_act_jul==$lost_tar_jul) $lost_act_jul_cell_color=" amber ";
elseif ($lost_act_jul<$lost_tar_jul) $lost_act_jul_cell_color=" green ";
if ($lost_act_aug>$lost_tar_aug) $lost_act_aug_cell_color=" red ";
elseif ($lost_act_aug==0) $lost_act_aug_cell_color=" green ";
elseif ($lost_act_aug==$lost_tar_aug) $lost_act_aug_cell_color=" amber ";
elseif ($lost_act_aug<$lost_tar_aug) $lost_act_aug_cell_color=" green ";
if ($lost_act_sep>$lost_tar_sep) $lost_act_sep_cell_color=" red ";
elseif ($lost_act_sep==0) $lost_act_sep_cell_color=" green ";
elseif ($lost_act_sep==$lost_tar_sep) $lost_act_sep_cell_color=" amber ";
elseif ($lost_act_sep<$lost_tar_sep) $lost_act_sep_cell_color=" green ";
if ($Q3_lost_actual>$Q3_lost_target) $Q3_lost_actual_cell_color=" red ";
elseif ($Q3_lost_actual==0) $Q3_lost_actual_cell_color=" green ";
elseif ($Q3_lost_actual==$Q3_lost_target) $Q3_lost_actual_cell_color=" amber ";
elseif ($Q3_lost_actual<$Q3_lost_target) $Q3_lost_actual_cell_color=" green ";
if ($lost_act_oct>$lost_tar_oct) $lost_act_oct_cell_color=" red ";
elseif ($lost_act_oct==0) $lost_act_oct_cell_color=" green ";
elseif ($lost_act_oct==$lost_tar_oct) $lost_act_oct_cell_color=" amber ";
elseif ($lost_act_oct<$lost_tar_oct) $lost_act_oct_cell_color=" green ";
if ($lost_act_nov>$lost_tar_nov) $lost_act_nov_cell_color=" red ";
elseif ($lost_act_nov==0) $lost_act_nov_cell_color=" green ";
elseif ($lost_act_nov==$lost_tar_nov) $lost_act_nov_cell_color=" amber ";
elseif ($lost_act_nov<$lost_tar_nov) $lost_act_nov_cell_color=" green ";
if ($lost_act_dec>$lost_tar_dec) $lost_act_dec_cell_color=" red ";
elseif ($lost_act_dec==0) $lost_act_dec_cell_color=" green ";
elseif ($lost_act_dec==$lost_tar_dec) $lost_act_dec_cell_color=" amber ";
elseif ($lost_act_dec<$lost_tar_dec) $lost_act_dec_cell_color=" green ";
if ($Q4_lost_actual>$Q4_lost_target) $Q4_lost_actual_cell_color=" red ";
elseif ($Q4_lost_actual==0) $Q4_lost_actual_cell_color=" green ";
elseif ($Q4_lost_actual==$Q4_lost_target) $Q4_lost_actual_cell_color=" amber ";
elseif ($Q4_lost_actual<$Q4_lost_target) $Q4_lost_actual_cell_color=" green ";
if (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)>($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=" red ";
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)==0) $YTD_lost_actual_cell_color=" green ";
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)==($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=" amber ";
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)<($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=" green ";

$Q1_inci_actual_cell_color = $Q2_inci_actual_cell_color = $Q3_inci_actual_cell_color = $Q4_inci_actual_cell_color = $YTD_inci_actual_cell_color = '';
$inci_act_jan_cell_color = $inci_act_feb_cell_color = $inci_act_mar_cell_color = $inci_act_apr_cell_color = $inci_act_may_cell_color = $inci_act_jun_cell_color = $inci_act_jul_cell_color = $inci_act_aug_cell_color = $inci_act_sep_cell_color = $inci_act_oct_cell_color = $inci_act_nov_cell_color = $inci_act_dec_cell_color = '';
if ($inci_act_jan>$inci_tar_jan) $inci_act_jan_cell_color=" red ";
elseif ($inci_act_jan==0) $inci_act_jan_cell_color=" green ";
elseif ($inci_act_jan==$inci_tar_jan) $inci_act_jan_cell_color=" amber ";
elseif ($inci_act_jan<$inci_tar_jan) $inci_act_jan_cell_color=" green ";
if ($inci_act_feb>$inci_tar_feb) $inci_act_feb_cell_color=" red ";
elseif ($inci_act_feb==0) $inci_act_feb_cell_color=" green ";
elseif ($inci_act_feb==$inci_tar_feb) $inci_act_feb_cell_color=" amber ";
elseif ($inci_act_feb<$inci_tar_feb) $inci_act_feb_cell_color=" green ";
if ($inci_act_mar>$inci_tar_mar) $inci_act_mar_cell_color=" red ";
elseif ($inci_act_mar==0) $inci_act_mar_cell_color=" green ";
elseif ($inci_act_mar==$inci_tar_mar) $inci_act_mar_cell_color=" amber ";
elseif ($inci_act_mar<$inci_tar_mar) $inci_act_mar_cell_color=" green ";
if ($Q1_inci_actual>$Q1_inci_target) $Q1_inci_actual_cell_color=" red ";
elseif ($Q1_inci_actual==0) $Q1_inci_actual_cell_color=" green ";
elseif ($Q1_inci_actual==$Q1_inci_target) $Q1_inci_actual_cell_color=" amber ";
elseif ($Q1_inci_actual<$Q1_inci_target) $Q1_inci_actual_cell_color=" green ";
if ($inci_act_apr>$inci_tar_apr) $inci_act_apr_cell_color=" red ";
elseif ($inci_act_apr==0) $inci_act_apr_cell_color=" green ";
elseif ($inci_act_apr==$inci_tar_apr) $inci_act_apr_cell_color=" amber ";
elseif ($inci_act_apr<$inci_tar_apr) $inci_act_apr_cell_color=" green ";
if ($inci_act_may>$inci_tar_may) $inci_act_may_cell_color=" red ";
elseif ($inci_act_may==0) $inci_act_may_cell_color=" green ";
elseif ($inci_act_may==$inci_tar_may) $inci_act_may_cell_color=" amber ";
elseif ($inci_act_may<$inci_tar_may) $inci_act_may_cell_color=" green ";
if ($inci_act_jun>$inci_tar_jun) $inci_act_jun_cell_color=" red ";
elseif ($inci_act_jun==0) $inci_act_jun_cell_color=" green ";
elseif ($inci_act_jun==$inci_tar_jun) $inci_act_jun_cell_color=" amber ";
elseif ($inci_act_jun<$inci_tar_jun) $inci_act_jun_cell_color=" green ";
if ($Q2_inci_actual>$Q2_inci_target) $Q2_inci_actual_cell_color=" red ";
elseif ($Q2_inci_actual==0) $Q2_inci_actual_cell_color=" green ";
elseif ($Q2_inci_actual==$Q2_inci_target) $Q2_inci_actual_cell_color=" amber ";
elseif ($Q2_inci_actual<$Q2_inci_target) $Q2_inci_actual_cell_color=" green ";
if ($inci_act_jul>$inci_tar_jul) $inci_act_jul_cell_color=" red ";
elseif ($inci_act_jul==0) $inci_act_jul_cell_color=" green ";
elseif ($inci_act_jul==$inci_tar_jul) $inci_act_jul_cell_color=" amber ";
elseif ($inci_act_jul<$inci_tar_jul) $inci_act_jul_cell_color=" green ";
if ($inci_act_aug>$inci_tar_aug) $inci_act_aug_cell_color=" red ";
elseif ($inci_act_aug==0) $inci_act_aug_cell_color=" green ";
elseif ($inci_act_aug==$inci_tar_aug) $inci_act_aug_cell_color=" amber ";
elseif ($inci_act_aug<$inci_tar_aug) $inci_act_aug_cell_color=" green ";
if ($inci_act_sep>$inci_tar_sep) $inci_act_sep_cell_color=" red ";
elseif ($inci_act_sep==0) $inci_act_sep_cell_color=" green ";
elseif ($inci_act_sep==$inci_tar_sep) $inci_act_sep_cell_color=" amber ";
elseif ($inci_act_sep<$inci_tar_sep) $inci_act_sep_cell_color=" green ";
if ($Q3_inci_actual>$Q3_inci_target) $Q3_inci_actual_cell_color=" red ";
elseif ($Q3_inci_actual==0) $Q3_inci_actual_cell_color=" green ";
elseif ($Q3_inci_actual==$Q3_inci_target) $Q3_inci_actual_cell_color=" amber ";
elseif ($Q3_inci_actual<$Q3_inci_target) $Q3_inci_actual_cell_color=" green ";
if ($inci_act_oct>$inci_tar_oct) $inci_act_oct_cell_color=" red ";
elseif ($inci_act_oct==0) $inci_act_oct_cell_color=" green ";
elseif ($inci_act_oct==$inci_tar_oct) $inci_act_oct_cell_color=" amber ";
elseif ($inci_act_oct<$inci_tar_oct) $inci_act_oct_cell_color=" green ";
if ($inci_act_nov>$inci_tar_nov) $inci_act_nov_cell_color=" red ";
elseif ($inci_act_nov==0) $inci_act_nov_cell_color=" green ";
elseif ($inci_act_nov==$inci_tar_nov) $inci_act_nov_cell_color=" amber ";
elseif ($inci_act_nov<$inci_tar_nov) $inci_act_nov_cell_color=" green ";
if ($inci_act_dec>$inci_tar_dec) $inci_act_dec_cell_color=" red ";
elseif ($inci_act_dec==0) $inci_act_dec_cell_color=" green ";
elseif ($inci_act_dec==$inci_tar_dec) $inci_act_dec_cell_color=" amber ";
elseif ($inci_act_dec<$inci_tar_dec) $inci_act_dec_cell_color=" green ";
if ($Q4_inci_actual>$Q4_inci_target) $Q4_inci_actual_cell_color=" red ";
elseif ($Q4_inci_actual==0) $Q4_inci_actual_cell_color=" green ";
elseif ($Q4_inci_actual==$Q4_inci_target) $Q4_inci_actual_cell_color=" amber ";
elseif ($Q4_inci_actual<$Q4_inci_target) $Q4_inci_actual_cell_color=" green ";
if (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)>($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=" red ";
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)==0) $YTD_inci_actual_cell_color=" green ";
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)==($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=" amber ";
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)<($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=" green ";





$Q1_haz_actual_cell_color = $Q2_haz_actual_cell_color = $Q3_haz_actual_cell_color = $Q4_haz_actual_cell_color = $YTD_haz_actual_cell_color = '';
$haz_act_jan_cell_color = $haz_act_feb_cell_color = $haz_act_mar_cell_color = $haz_act_apr_cell_color = $haz_act_may_cell_color = $haz_act_jun_cell_color = $haz_act_jul_cell_color = $haz_act_aug_cell_color = $haz_act_sep_cell_color = $haz_act_oct_cell_color = $haz_act_nov_cell_color = $haz_act_dec_cell_color = '';
if ($haz_act_jan<$haz_tar_jan) $haz_act_jan_cell_color=" red ";
elseif ($haz_act_jan==$haz_tar_jan) $haz_act_jan_cell_color=" amber ";
elseif ($haz_act_jan>$haz_tar_jan) $haz_act_jan_cell_color=" green ";
if ($haz_act_feb<$haz_tar_feb) $haz_act_feb_cell_color=" red ";
elseif ($haz_act_feb==$haz_tar_feb) $haz_act_feb_cell_color=" amber ";
elseif ($haz_act_feb>$haz_tar_feb) $haz_act_feb_cell_color=" green ";
if ($haz_act_mar<$haz_tar_mar) $haz_act_mar_cell_color=" red ";
elseif ($haz_act_mar==$haz_tar_mar) $haz_act_mar_cell_color=" amber ";
elseif ($haz_act_mar>$haz_tar_mar) $haz_act_mar_cell_color=" green ";
if ($Q1_haz_actual<$Q1_haz_target) $Q1_haz_actual_cell_color=" red ";
elseif ($Q1_haz_actual==$Q1_haz_target) $Q1_haz_actual_cell_color=" amber ";
elseif ($Q1_haz_actual>$Q1_haz_target) $Q1_haz_actual_cell_color=" green ";
if ($haz_act_apr<$haz_tar_apr) $haz_act_apr_cell_color=" red ";
elseif ($haz_act_apr==$haz_tar_apr) $haz_act_apr_cell_color=" amber ";
elseif ($haz_act_apr>$haz_tar_apr) $haz_act_apr_cell_color=" green ";
if ($haz_act_may<$haz_tar_may) $haz_act_may_cell_color=" red ";
elseif ($haz_act_may==$haz_tar_may) $haz_act_may_cell_color=" amber ";
elseif ($haz_act_may>$haz_tar_may) $haz_act_may_cell_color=" green ";
if ($haz_act_jun<$haz_tar_jun) $haz_act_jun_cell_color=" red ";
elseif ($haz_act_jun==$haz_tar_jun) $haz_act_jun_cell_color=" amber ";
elseif ($haz_act_jun>$haz_tar_jun) $haz_act_jun_cell_color=" green ";
if ($Q2_haz_actual<$Q2_haz_target) $Q2_haz_actual_cell_color=" red ";
elseif ($Q2_haz_actual==$Q2_haz_target) $Q2_haz_actual_cell_color=" amber ";
elseif ($Q2_haz_actual>$Q2_haz_target) $Q2_haz_actual_cell_color=" green ";
if ($haz_act_jul<$haz_tar_jul) $haz_act_jul_cell_color=" red ";
elseif ($haz_act_jul==$haz_tar_jul) $haz_act_jul_cell_color=" amber ";
elseif ($haz_act_jul>$haz_tar_jul) $haz_act_jul_cell_color=" green ";
if ($haz_act_aug<$haz_tar_aug) $haz_act_aug_cell_color=" red ";
elseif ($haz_act_aug==$haz_tar_aug) $haz_act_aug_cell_color=" amber ";
elseif ($haz_act_aug>$haz_tar_aug) $haz_act_aug_cell_color=" green ";
if ($haz_act_sep<$haz_tar_sep) $haz_act_sep_cell_color=" red ";
elseif ($haz_act_sep==$haz_tar_sep) $haz_act_sep_cell_color=" amber ";
elseif ($haz_act_sep>$haz_tar_sep) $haz_act_sep_cell_color=" green ";
if ($Q3_haz_actual<$Q3_haz_target) $Q3_haz_actual_cell_color=" red ";
elseif ($Q3_haz_actual==$Q3_haz_target) $Q3_haz_actual_cell_color=" amber ";
elseif ($Q3_haz_actual>$Q3_haz_target) $Q3_haz_actual_cell_color=" green ";
if ($haz_act_oct<$haz_tar_oct) $haz_act_oct_cell_color=" red ";
elseif ($haz_act_oct==$haz_tar_oct) $haz_act_oct_cell_color=" amber ";
elseif ($haz_act_oct>$haz_tar_oct) $haz_act_oct_cell_color=" green ";
if ($haz_act_nov<$haz_tar_nov) $haz_act_nov_cell_color=" red ";
elseif ($haz_act_nov==$haz_tar_nov) $haz_act_nov_cell_color=" amber ";
elseif ($haz_act_nov>$haz_tar_nov) $haz_act_nov_cell_color=" green ";
if ($haz_act_dec<$haz_tar_dec) $haz_act_dec_cell_color=" red ";
elseif ($haz_act_dec==$haz_tar_dec) $haz_act_dec_cell_color=" amber ";
elseif ($haz_act_dec>$haz_tar_dec) $haz_act_dec_cell_color=" green ";
if ($Q4_haz_actual<$Q4_haz_target) $Q4_haz_actual_cell_color=" red ";
elseif ($Q4_haz_actual==$Q4_haz_target) $Q4_haz_actual_cell_color=" amber ";
elseif ($Q4_haz_actual>$Q4_haz_target) $Q4_haz_actual_cell_color=" green ";
if (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)<($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=" red ";
elseif (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)==($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=" amber ";
elseif (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)>($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=" green ";

$Q1_near_actual_cell_color = $Q2_near_actual_cell_color = $Q3_near_actual_cell_color = $Q4_near_actual_cell_color = $YTD_near_actual_cell_color = '';
$near_act_jan_cell_color = $near_act_feb_cell_color = $near_act_mar_cell_color = $near_act_apr_cell_color = $near_act_may_cell_color = $near_act_jun_cell_color = $near_act_jul_cell_color = $near_act_aug_cell_color = $near_act_sep_cell_color = $near_act_oct_cell_color = $near_act_nov_cell_color = $near_act_dec_cell_color = '';
if ($near_act_jan<$near_tar_jan) $near_act_jan_cell_color=" red ";
elseif ($near_act_jan==$near_tar_jan) $near_act_jan_cell_color=" amber ";
elseif ($near_act_jan>$near_tar_jan) $near_act_jan_cell_color=" green ";
if ($near_act_feb<$near_tar_feb) $near_act_feb_cell_color=" red ";
elseif ($near_act_feb==$near_tar_feb) $near_act_feb_cell_color=" amber ";
elseif ($near_act_feb>$near_tar_feb) $near_act_feb_cell_color=" green ";
if ($near_act_mar<$near_tar_mar) $near_act_mar_cell_color=" red ";
elseif ($near_act_mar==$near_tar_mar) $near_act_mar_cell_color=" amber ";
elseif ($near_act_mar>$near_tar_mar) $near_act_mar_cell_color=" green ";
if ($Q1_near_actual<$Q1_near_target) $Q1_near_actual_cell_color=" red ";
elseif ($Q1_near_actual==$Q1_near_target) $Q1_near_actual_cell_color=" amber ";
elseif ($Q1_near_actual>$Q1_near_target) $Q1_near_actual_cell_color=" green ";
if ($near_act_apr<$near_tar_apr) $near_act_apr_cell_color=" red ";
elseif ($near_act_apr==$near_tar_apr) $near_act_apr_cell_color=" amber ";
elseif ($near_act_apr>$near_tar_apr) $near_act_apr_cell_color=" green ";
if ($near_act_may<$near_tar_may) $near_act_may_cell_color=" red ";
elseif ($near_act_may==$near_tar_may) $near_act_may_cell_color=" amber ";
elseif ($near_act_may>$near_tar_may) $near_act_may_cell_color=" green ";
if ($near_act_jun<$near_tar_jun) $near_act_jun_cell_color=" red ";
elseif ($near_act_jun==$near_tar_jun) $near_act_jun_cell_color=" amber ";
elseif ($near_act_jun>$near_tar_jun) $near_act_jun_cell_color=" green ";
if ($Q2_near_actual<$Q2_near_target) $Q2_near_actual_cell_color=" red ";
elseif ($Q2_near_actual==$Q2_near_target) $Q2_near_actual_cell_color=" amber ";
elseif ($Q2_near_actual>$Q2_near_target) $Q2_near_actual_cell_color=" green ";
if ($near_act_jul<$near_tar_jul) $near_act_jul_cell_color=" red ";
elseif ($near_act_jul==$near_tar_jul) $near_act_jul_cell_color=" amber ";
elseif ($near_act_jul>$near_tar_jul) $near_act_jul_cell_color=" green ";
if ($near_act_aug<$near_tar_aug) $near_act_aug_cell_color=" red ";
elseif ($near_act_aug==$near_tar_aug) $near_act_aug_cell_color=" amber ";
elseif ($near_act_aug>$near_tar_aug) $near_act_aug_cell_color=" green ";
if ($near_act_sep<$near_tar_sep) $near_act_sep_cell_color=" red ";
elseif ($near_act_sep==$near_tar_sep) $near_act_sep_cell_color=" amber ";
elseif ($near_act_sep>$near_tar_sep) $near_act_sep_cell_color=" green ";
if ($Q3_near_actual<$Q3_near_target) $Q3_near_actual_cell_color=" red ";
elseif ($Q3_near_actual==$Q3_near_target) $Q3_near_actual_cell_color=" amber ";
elseif ($Q3_near_actual>$Q3_near_target) $Q3_near_actual_cell_color=" green ";
if ($near_act_oct<$near_tar_oct) $near_act_oct_cell_color=" red ";
elseif ($near_act_oct==$near_tar_oct) $near_act_oct_cell_color=" amber ";
elseif ($near_act_oct>$near_tar_oct) $near_act_oct_cell_color=" green ";
if ($near_act_nov<$near_tar_nov) $near_act_nov_cell_color=" red ";
elseif ($near_act_nov==$near_tar_nov) $near_act_nov_cell_color=" amber ";
elseif ($near_act_nov>$near_tar_nov) $near_act_nov_cell_color=" green ";
if ($near_act_dec<$near_tar_dec) $near_act_dec_cell_color=" red ";
elseif ($near_act_dec==$near_tar_dec) $near_act_dec_cell_color=" amber ";
elseif ($near_act_dec>$near_tar_dec) $near_act_dec_cell_color=" green ";
if ($Q4_near_actual<$Q4_near_target) $Q4_near_actual_cell_color=" red ";
elseif ($Q4_near_actual==$Q4_near_target) $Q4_near_actual_cell_color=" amber ";
elseif ($Q4_near_actual>$Q4_near_target) $Q4_near_actual_cell_color=" green ";
if (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)<($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=" red ";
elseif (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)==($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=" amber ";
elseif (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)>($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=" green ";

$Q1_haznea_actual_cell_color = $Q2_haznea_actual_cell_color = $Q3_haznea_actual_cell_color = $Q4_haznea_actual_cell_color = $YTD_haznea_actual_cell_color = '';
$haznea_act_jan_cell_color = $haznea_act_feb_cell_color = $haznea_act_mar_cell_color = $haznea_act_apr_cell_color = $haznea_act_may_cell_color = $haznea_act_jun_cell_color = $haznea_act_jul_cell_color = $haznea_act_aug_cell_color = $haznea_act_sep_cell_color = $haznea_act_oct_cell_color = $haznea_act_nov_cell_color = $haznea_act_dec_cell_color = '';
if ($haznea_act_jan<$haznea_tar_jan) $haznea_act_jan_cell_color=" red ";
elseif ($haznea_act_jan==$haznea_tar_jan) $haznea_act_jan_cell_color=" amber ";
elseif ($haznea_act_jan>$haznea_tar_jan) $haznea_act_jan_cell_color=" green ";
if ($haznea_act_feb<$haznea_tar_feb) $haznea_act_feb_cell_color=" red ";
elseif ($haznea_act_feb==$haznea_tar_feb) $haznea_act_feb_cell_color=" amber ";
elseif ($haznea_act_feb>$haznea_tar_feb) $haznea_act_feb_cell_color=" green ";
if ($haznea_act_mar<$haznea_tar_mar) $haznea_act_mar_cell_color=" red ";
elseif ($haznea_act_mar==$haznea_tar_mar) $haznea_act_mar_cell_color=" amber ";
elseif ($haznea_act_mar>$haznea_tar_mar) $haznea_act_mar_cell_color=" green ";
if ($Q1_haznea_actual<$Q1_haznea_target) $Q1_haznea_actual_cell_color=" red ";
elseif ($Q1_haznea_actual==$Q1_haznea_target) $Q1_haznea_actual_cell_color=" amber ";
elseif ($Q1_haznea_actual>$Q1_haznea_target) $Q1_haznea_actual_cell_color=" green ";
if ($haznea_act_apr<$haznea_tar_apr) $haznea_act_apr_cell_color=" red ";
elseif ($haznea_act_apr==$haznea_tar_apr) $haznea_act_apr_cell_color=" amber ";
elseif ($haznea_act_apr>$haznea_tar_apr) $haznea_act_apr_cell_color=" green ";
if ($haznea_act_may<$haznea_tar_may) $haznea_act_may_cell_color=" red ";
elseif ($haznea_act_may==$haznea_tar_may) $haznea_act_may_cell_color=" amber ";
elseif ($haznea_act_may>$haznea_tar_may) $haznea_act_may_cell_color=" green ";
if ($haznea_act_jun<$haznea_tar_jun) $haznea_act_jun_cell_color=" red ";
elseif ($haznea_act_jun==$haznea_tar_jun) $haznea_act_jun_cell_color=" amber ";
elseif ($haznea_act_jun>$haznea_tar_jun) $haznea_act_jun_cell_color=" green ";
if ($Q2_haznea_actual<$Q2_haznea_target) $Q2_haznea_actual_cell_color=" red ";
elseif ($Q2_haznea_actual==$Q2_haznea_target) $Q2_haznea_actual_cell_color=" amber ";
elseif ($Q2_haznea_actual>$Q2_haznea_target) $Q2_haznea_actual_cell_color=" green ";
if ($haznea_act_jul<$haznea_tar_jul) $haznea_act_jul_cell_color=" red ";
elseif ($haznea_act_jul==$haznea_tar_jul) $haznea_act_jul_cell_color=" amber ";
elseif ($haznea_act_jul>$haznea_tar_jul) $haznea_act_jul_cell_color=" green ";
if ($haznea_act_aug<$haznea_tar_aug) $haznea_act_aug_cell_color=" red ";
elseif ($haznea_act_aug==$haznea_tar_aug) $haznea_act_aug_cell_color=" amber ";
elseif ($haznea_act_aug>$haznea_tar_aug) $haznea_act_aug_cell_color=" green ";
if ($haznea_act_sep<$haznea_tar_sep) $haznea_act_sep_cell_color=" red ";
elseif ($haznea_act_sep==$haznea_tar_sep) $haznea_act_sep_cell_color=" amber ";
elseif ($haznea_act_sep>$haznea_tar_sep) $haznea_act_sep_cell_color=" green ";
if ($Q3_haznea_actual<$Q3_haznea_target) $Q3_haznea_actual_cell_color=" red ";
elseif ($Q3_haznea_actual==$Q3_haznea_target) $Q3_haznea_actual_cell_color=" amber ";
elseif ($Q3_haznea_actual>$Q3_haznea_target) $Q3_haznea_actual_cell_color=" green ";
if ($haznea_act_oct<$haznea_tar_oct) $haznea_act_oct_cell_color=" red ";
elseif ($haznea_act_oct==$haznea_tar_oct) $haznea_act_oct_cell_color=" amber ";
elseif ($haznea_act_oct>$haznea_tar_oct) $haznea_act_oct_cell_color=" green ";
if ($haznea_act_nov<$haznea_tar_nov) $haznea_act_nov_cell_color=" red ";
elseif ($haznea_act_nov==$haznea_tar_nov) $haznea_act_nov_cell_color=" amber ";
elseif ($haznea_act_nov>$haznea_tar_nov) $haznea_act_nov_cell_color=" green ";
if ($haznea_act_dec<$haznea_tar_dec) $haznea_act_dec_cell_color=" red ";
elseif ($haznea_act_dec==$haznea_tar_dec) $haznea_act_dec_cell_color=" amber ";
elseif ($haznea_act_dec>$haznea_tar_dec) $haznea_act_dec_cell_color=" green ";
if ($Q4_haznea_actual<$Q4_haznea_target) $Q4_haznea_actual_cell_color=" red ";
elseif ($Q4_haznea_actual==$Q4_haznea_target) $Q4_haznea_actual_cell_color=" amber ";
elseif ($Q4_haznea_actual>$Q4_haznea_target) $Q4_haznea_actual_cell_color=" green ";
if (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)<($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=" red ";
elseif (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)==($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=" amber ";
elseif (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)>($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=" green ";

$Q1_tosa_actual_cell_color = $Q2_tosa_actual_cell_color = $Q3_tosa_actual_cell_color = $Q4_tosa_actual_cell_color = $YTD_tosa_actual_cell_color = '';
$tosa_act_jan_cell_color = $tosa_act_feb_cell_color = $tosa_act_mar_cell_color = $tosa_act_apr_cell_color = $tosa_act_may_cell_color = $tosa_act_jun_cell_color = $tosa_act_jul_cell_color = $tosa_act_aug_cell_color = $tosa_act_sep_cell_color = $tosa_act_oct_cell_color = $tosa_act_nov_cell_color = $tosa_act_dec_cell_color = '';
if ($tosa_act_jan<$tosa_tar_jan) $tosa_act_jan_cell_color=" red ";
elseif ($tosa_act_jan==$tosa_tar_jan) $tosa_act_jan_cell_color=" amber ";
elseif ($tosa_act_jan>$tosa_tar_jan) $tosa_act_jan_cell_color=" green ";
if ($tosa_act_feb<$tosa_tar_feb) $tosa_act_feb_cell_color=" red ";
elseif ($tosa_act_feb==$tosa_tar_feb) $tosa_act_feb_cell_color=" amber ";
elseif ($tosa_act_feb>$tosa_tar_feb) $tosa_act_feb_cell_color=" green ";
if ($tosa_act_mar<$tosa_tar_mar) $tosa_act_mar_cell_color=" red ";
elseif ($tosa_act_mar==$tosa_tar_mar) $tosa_act_mar_cell_color=" amber ";
elseif ($tosa_act_mar>$tosa_tar_mar) $tosa_act_mar_cell_color=" green ";
if ($Q1_tosa_actual<$Q1_tosa_target) $Q1_tosa_actual_cell_color=" red ";
elseif ($Q1_tosa_actual==$Q1_tosa_target) $Q1_tosa_actual_cell_color=" amber ";
elseif ($Q1_tosa_actual>$Q1_tosa_target) $Q1_tosa_actual_cell_color=" green ";
if ($tosa_act_apr<$tosa_tar_apr) $tosa_act_apr_cell_color=" red ";
elseif ($tosa_act_apr==$tosa_tar_apr) $tosa_act_apr_cell_color=" amber ";
elseif ($tosa_act_apr>$tosa_tar_apr) $tosa_act_apr_cell_color=" green ";
if ($tosa_act_may<$tosa_tar_may) $tosa_act_may_cell_color=" red ";
elseif ($tosa_act_may==$tosa_tar_may) $tosa_act_may_cell_color=" amber ";
elseif ($tosa_act_may>$tosa_tar_may) $tosa_act_may_cell_color=" green ";
if ($tosa_act_jun<$tosa_tar_jun) $tosa_act_jun_cell_color=" red ";
elseif ($tosa_act_jun==$tosa_tar_jun) $tosa_act_jun_cell_color=" amber ";
elseif ($tosa_act_jun>$tosa_tar_jun) $tosa_act_jun_cell_color=" green ";
if ($Q2_tosa_actual<$Q2_tosa_target) $Q2_tosa_actual_cell_color=" red ";
elseif ($Q2_tosa_actual==$Q2_tosa_target) $Q2_tosa_actual_cell_color=" amber ";
elseif ($Q2_tosa_actual>$Q2_tosa_target) $Q2_tosa_actual_cell_color=" green ";
if ($tosa_act_jul<$tosa_tar_jul) $tosa_act_jul_cell_color=" red ";
elseif ($tosa_act_jul==$tosa_tar_jul) $tosa_act_jul_cell_color=" amber ";
elseif ($tosa_act_jul>$tosa_tar_jul) $tosa_act_jul_cell_color=" green ";
if ($tosa_act_aug<$tosa_tar_aug) $tosa_act_aug_cell_color=" red ";
elseif ($tosa_act_aug==$tosa_tar_aug) $tosa_act_aug_cell_color=" amber ";
elseif ($tosa_act_aug>$tosa_tar_aug) $tosa_act_aug_cell_color=" green ";
if ($tosa_act_sep<$tosa_tar_sep) $tosa_act_sep_cell_color=" red ";
elseif ($tosa_act_sep==$tosa_tar_sep) $tosa_act_sep_cell_color=" amber ";
elseif ($tosa_act_sep>$tosa_tar_sep) $tosa_act_sep_cell_color=" green ";
if ($Q3_tosa_actual<$Q3_tosa_target) $Q3_tosa_actual_cell_color=" red ";
elseif ($Q3_tosa_actual==$Q3_tosa_target) $Q3_tosa_actual_cell_color=" amber ";
elseif ($Q3_tosa_actual>$Q3_tosa_target) $Q3_tosa_actual_cell_color=" green ";
if ($tosa_act_oct<$tosa_tar_oct) $tosa_act_oct_cell_color=" red ";
elseif ($tosa_act_oct==$tosa_tar_oct) $tosa_act_oct_cell_color=" amber ";
elseif ($tosa_act_oct>$tosa_tar_oct) $tosa_act_oct_cell_color=" green ";
if ($tosa_act_nov<$tosa_tar_nov) $tosa_act_nov_cell_color=" red ";
elseif ($tosa_act_nov==$tosa_tar_nov) $tosa_act_nov_cell_color=" amber ";
elseif ($tosa_act_nov>$tosa_tar_nov) $tosa_act_nov_cell_color=" green ";
if ($tosa_act_dec<$tosa_tar_dec) $tosa_act_dec_cell_color=" red ";
elseif ($tosa_act_dec==$tosa_tar_dec) $tosa_act_dec_cell_color=" amber ";
elseif ($tosa_act_dec>$tosa_tar_dec) $tosa_act_dec_cell_color=" green ";
if ($Q4_tosa_actual<$Q4_tosa_target) $Q4_tosa_actual_cell_color=" red ";
elseif ($Q4_tosa_actual==$Q4_tosa_target) $Q4_tosa_actual_cell_color=" amber ";
elseif ($Q4_tosa_actual>$Q4_tosa_target) $Q4_tosa_actual_cell_color=" green ";
if (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)<($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=" red ";
elseif (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)==($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=" amber ";
elseif (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)>($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=" green ";

$Q1_numa_actual_cell_color = $Q2_numa_actual_cell_color = $Q3_numa_actual_cell_color = $Q4_numa_actual_cell_color = $YTD_numa_actual_cell_color = '';
$numa_act_jan_cell_color = $numa_act_feb_cell_color = $numa_act_mar_cell_color = $numa_act_apr_cell_color = $numa_act_may_cell_color = $numa_act_jun_cell_color = $numa_act_jul_cell_color = $numa_act_aug_cell_color = $numa_act_sep_cell_color = $numa_act_oct_cell_color = $numa_act_nov_cell_color = $numa_act_dec_cell_color = '';
if ($numa_act_jan<$siau_tar_jan) $numa_act_jan_cell_color=" red ";
elseif ($numa_act_jan==$siau_tar_jan) $numa_act_jan_cell_color=" amber ";
elseif ($numa_act_jan>$siau_tar_jan) $numa_act_jan_cell_color=" green ";
if ($numa_act_feb<$siau_tar_feb) $numa_act_feb_cell_color=" red ";
elseif ($numa_act_feb==$siau_tar_feb) $numa_act_feb_cell_color=" amber ";
elseif ($numa_act_feb>$siau_tar_feb) $numa_act_feb_cell_color=" green ";
if ($numa_act_mar<$siau_tar_mar) $numa_act_mar_cell_color=" red ";
elseif ($numa_act_mar==$siau_tar_mar) $numa_act_mar_cell_color=" amber ";
elseif ($numa_act_mar>$siau_tar_mar) $numa_act_mar_cell_color=" green ";
if ($Q1_numa_actual<$Q1_siau_target) $Q1_numa_actual_cell_color=" red ";
elseif ($Q1_numa_actual==$Q1_siau_target) $Q1_numa_actual_cell_color=" amber ";
elseif ($Q1_numa_actual>$Q1_siau_target) $Q1_numa_actual_cell_color=" green ";
if ($numa_act_apr<$siau_tar_apr) $numa_act_apr_cell_color=" red ";
elseif ($numa_act_apr==$siau_tar_apr) $numa_act_apr_cell_color=" amber ";
elseif ($numa_act_apr>$siau_tar_apr) $numa_act_apr_cell_color=" green ";
if ($numa_act_may<$siau_tar_may) $numa_act_may_cell_color=" red ";
elseif ($numa_act_may==$siau_tar_may) $numa_act_may_cell_color=" amber ";
elseif ($numa_act_may>$siau_tar_may) $numa_act_may_cell_color=" green ";
if ($numa_act_jun<$siau_tar_jun) $numa_act_jun_cell_color=" red ";
elseif ($numa_act_jun==$siau_tar_jun) $numa_act_jun_cell_color=" amber ";
elseif ($numa_act_jun>$siau_tar_jun) $numa_act_jun_cell_color=" green ";
if ($Q2_numa_actual<$Q2_siau_target) $Q2_numa_actual_cell_color=" red ";
elseif ($Q2_numa_actual==$Q2_siau_target) $Q2_numa_actual_cell_color=" amber ";
elseif ($Q2_numa_actual>$Q2_siau_target) $Q2_numa_actual_cell_color=" green ";
if ($numa_act_jul<$siau_tar_jul) $numa_act_jul_cell_color=" red ";
elseif ($numa_act_jul==$siau_tar_jul) $numa_act_jul_cell_color=" amber ";
elseif ($numa_act_jul>$siau_tar_jul) $numa_act_jul_cell_color=" green ";
if ($numa_act_aug<$siau_tar_aug) $numa_act_aug_cell_color=" red ";
elseif ($numa_act_aug==$siau_tar_aug) $numa_act_aug_cell_color=" amber ";
elseif ($numa_act_aug>$siau_tar_aug) $numa_act_aug_cell_color=" green ";
if ($numa_act_sep<$siau_tar_sep) $numa_act_sep_cell_color=" red ";
elseif ($numa_act_sep==$siau_tar_sep) $numa_act_sep_cell_color=" amber ";
elseif ($numa_act_sep>$siau_tar_sep) $numa_act_sep_cell_color=" green ";
if ($Q3_numa_actual<$Q3_siau_target) $Q3_numa_actual_cell_color=" red ";
elseif ($Q3_numa_actual==$Q3_siau_target) $Q3_numa_actual_cell_color=" amber ";
elseif ($Q3_numa_actual>$Q3_siau_target) $Q3_numa_actual_cell_color=" green ";
if ($numa_act_oct<$siau_tar_oct) $numa_act_oct_cell_color=" red ";
elseif ($numa_act_oct==$siau_tar_oct) $numa_act_oct_cell_color=" amber ";
elseif ($numa_act_oct>$siau_tar_oct) $numa_act_oct_cell_color=" green ";
if ($numa_act_nov<$siau_tar_nov) $numa_act_nov_cell_color=" red ";
elseif ($numa_act_nov==$siau_tar_nov) $numa_act_nov_cell_color=" amber ";
elseif ($numa_act_nov>$siau_tar_nov) $numa_act_nov_cell_color=" green ";
if ($numa_act_dec<$siau_tar_dec) $numa_act_dec_cell_color=" red ";
elseif ($numa_act_dec==$siau_tar_dec) $numa_act_dec_cell_color=" amber ";
elseif ($numa_act_dec>$siau_tar_dec) $numa_act_dec_cell_color=" green ";
if ($Q4_numa_actual<$Q4_siau_target) $Q4_numa_actual_cell_color=" red ";
elseif ($Q4_numa_actual==$Q4_siau_target) $Q4_numa_actual_cell_color=" amber ";
elseif ($Q4_numa_actual>$Q4_siau_target) $Q4_numa_actual_cell_color=" green ";
if (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)<($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=" red ";
elseif (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)==($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=" amber ";
elseif (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)>($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=" green ";
?>

<table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
    <tr class="row1">
        <td class="column0 style70 s style70" rowspan="3">Lagging Indicators</td>
        <td class="column1 style71 s style74" colspan="8">Quarter 1</td>
        <td class="column9 style71 s style75" colspan="8">Quarter 2</td>
        <td class="column17 style71 s style75" colspan="8">Quarter 3</td>
        <td class="column25 style71 s style72" colspan="8">Quarter 4</td>
        <td class="column33 style1"></td>
        <td class="column34 style2"></td>
    </tr>
    <tr class="row2">
        <td class="column1 style67 n style67" colspan="2">Jan-<?=$filterData['year']?></td>
        <td class="column3 style67 n style67" colspan="2">Feb-<?=$filterData['year']?></td>
        <td class="column5 style67 n style76" colspan="2">Mar-<?=$filterData['year']?></td>
        <td class="column7 style3 s">Q1</td>
        <td class="column8 style4 s">Q1</td>
        <td class="column9 style69 n style67" colspan="2">Apr-<?=$filterData['year']?></td>
        <td class="column11 style67 n style67" colspan="2">May-<?=$filterData['year']?></td>
        <td class="column13 style67 n style67" colspan="2">Jun-<?=$filterData['year']?></td>
        <td class="column15 style4 s">Q2</td>
        <td class="column16 style4 s">Q2</td>
        <td class="column17 style67 n style67" colspan="2">Jul-<?=$filterData['year']?></td>
        <td class="column19 style67 n style67" colspan="2">Aug-<?=$filterData['year']?></td>
        <td class="column21 style67 n style67" colspan="2">Sep-<?=$filterData['year']?></td>
        <td class="column23 style4 s">Q3</td>
        <td class="column24 style4 s">Q3</td>
        <td class="column25 style67 n style67" colspan="2">Oct-<?=$filterData['year']?></td>
        <td class="column27 style67 n style67" colspan="2">Nov-<?=$filterData['year']?></td>
        <td class="column29 style67 n style67" colspan="2">Dec-<?=$filterData['year']?></td>
        <td class="column31 style4 s">Q4</td>
        <td class="column32 style4 s">Q4</td>
        <td class="column33 style68 s style68" colspan="2">YTD</td>
    </tr>
    <tr class="row3">
        <td class="column1 style6 s">Target</td>
        <td class="column2 style6 s">Actual</td>
        <td class="column3 style6 s">Target</td>
        <td class="column4 style6 s">Actual</td>
        <td class="column5 style6 s">Target</td>
        <td class="column6 style1 s">Actual</td>
        <td class="column7 style7 s">Target</td>
        <td class="column8 style5 s">Actual</td>
        <td class="column9 style2 s">Target</td>
        <td class="column10 style6 s">Actual</td>
        <td class="column11 style6 s">Target</td>
        <td class="column12 style6 s">Actual</td>
        <td class="column13 style6 s">Target</td>
        <td class="column14 style6 s">Actual</td>
        <td class="column15 style7 s">Target</td>
        <td class="column16 style5 s">Actual</td>
        <td class="column17 style6 s">Target</td>
        <td class="column18 style6 s">Actual</td>
        <td class="column19 style6 s">Target</td>
        <td class="column20 style6 s">Actual</td>
        <td class="column21 style6 s">Target</td>
        <td class="column22 style6 s">Actual</td>
        <td class="column23 style7 s">Target</td>
        <td class="column24 style5 s">Actual</td>
        <td class="column25 style6 s">Target</td>
        <td class="column26 style6 s">Actual</td>
        <td class="column27 style6 s">Target</td>
        <td class="column28 style6 s">Actual</td>
        <td class="column29 style6 s">Target</td>
        <td class="column30 style6 s">Actual</td>
        <td class="column31 style7 s">Target</td>
        <td class="column32 style5 s">Actual</td>
        <td class="column33 style56 s">Target</td>
        <td class="column34 style56 s">Actual</td>
    </tr>
    <tr class="row4">
        <td class="column0 style8 s">Accidents / Incidents</td>
        <td class="column1 style9"></td>
        <td class="column2 style9"></td>
        <td class="column3 style9"></td>
        <td class="column4 style9"></td>
        <td class="column5 style9"></td>
        <td class="column6 style9"></td>
        <td class="column7 style9"></td>
        <td class="column8 style9"></td>
        <td class="column9 style9"></td>
        <td class="column10 style9"></td>
        <td class="column11 style9"></td>
        <td class="column12 style9"></td>
        <td class="column13 style9"></td>
        <td class="column14 style9"></td>
        <td class="column15 style9"></td>
        <td class="column16 style9"></td>
        <td class="column17 style9"></td>
        <td class="column18 style9"></td>
        <td class="column19 style9"></td>
        <td class="column20 style9"></td>
        <td class="column21 style9"></td>
        <td class="column22 style9"></td>
        <td class="column23 style9"></td>
        <td class="column24 style9"></td>
        <td class="column25 style9"></td>
        <td class="column26 style9"></td>
        <td class="column27 style9"></td>
        <td class="column28 style9"></td>
        <td class="column29 style9"></td>
        <td class="column30 style9"></td>
        <td class="column31 style9"></td>
        <td class="column32 style9"></td>
        <td class="column33 style9"></td>
        <td class="column34 style9"></td>
    </tr>
    <tr class="row5">
        <td class="column0 style41 s border-left border-top">Fatalities</td>
        <td class="column1 style10 n border-top"><?=$fat_tar_jan?></td>
        <td class="column2 style12 n border-top <?=$fat_act_jan_cell_color?>"><?=$fat_act_jan?></td>
        <td class="column3 style15 n border-top"><?=$fat_tar_feb?></td>
        <td class="column4 style12 n border-top <?=$fat_act_feb_cell_color?>"><?=$fat_act_feb?></td>
        <td class="column5 style10 n border-top"><?=$fat_tar_mar?></td>
        <td class="column6 style11 n border-top <?=$fat_act_mar_cell_color?>"><?=$fat_act_mar?></td>
        <td class="column7 style13 f border-top border-left"><?=$Q1_fat_target?></td>
        <td class="column8 style14 f border-top border-right <?=$Q1_fat_actual_cell_color?>"><?=$Q1_fat_actual?></td>
        <td class="column9 style15 n border-top"><?=$fat_tar_apr?></td>
        <td class="column10 style12 n border-top <?=$fat_act_apr_cell_color?>"><?=$fat_act_apr?></td>
        <td class="column11 style10 n border-top"><?=$fat_tar_may?></td>
        <td class="column12 style12 n border-top <?=$fat_act_may_cell_color?>"><?=$fat_act_may?></td>
        <td class="column13 style10 n border-top"><?=$fat_tar_jun?></td>
        <td class="column14 style11 n border-top <?=$fat_act_jun_cell_color?>"><?=$fat_act_jun?></td>
        <td class="column15 style13 f border-top border-left"><?=$Q2_fat_target?></td>
        <td class="column16 style14 f border-top border-right <?=$Q2_fat_actual_cell_color?>"><?=$Q2_fat_actual?></td>
        <td class="column17 style15 n border-top"><?=$fat_tar_jul?></td>
        <td class="column18 style12 n border-top <?=$fat_act_jul_cell_color?>"><?=$fat_act_jul?></td>
        <td class="column19 style10 n border-top"><?=$fat_tar_aug?></td>
        <td class="column20 style12 n border-top <?=$fat_act_aug_cell_color?>"><?=$fat_act_aug?></td>
        <td class="column21 style10 n border-top"><?=$fat_tar_sep?></td>
        <td class="column22 style11 n border-top <?=$fat_act_sep_cell_color?>"><?=$fat_act_sep?></td>
        <td class="column23 style13 f border-top border-left"><?=$Q3_fat_target?></td>
        <td class="column24 style14 f border-top border-right <?=$Q3_fat_actual_cell_color?>"><?=$Q3_fat_actual?></td>
        <td class="column25 style15 n border-top"><?=$fat_tar_oct?></td>
        <td class="column26 style12 n border-top <?=$fat_act_oct_cell_color?>"><?=$fat_act_oct?></td>
        <td class="column27 style10 n border-top"><?=$fat_tar_nov?></td>
        <td class="column28 style12 n border-top <?=$fat_act_nov_cell_color?>"><?=$fat_act_nov?></td>
        <td class="column29 style10 n border-top"><?=$fat_tar_dec?></td>
        <td class="column30 style11 n border-top <?=$fat_act_dec_cell_color?>"><?=$fat_act_dec?></td>
        <td class="column31 style13 f border-top border-left"><?=$Q4_fat_target?></td>
        <td class="column32 style14 f border-top border-right <?=$Q4_fat_actual_cell_color?>"><?=$Q4_fat_actual?></td>
        <td class="column33 style15 f border-top"><?=($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)?></td>
        <td class="column34 style12 f border-top border-right <?=$YTD_fat_actual_cell_color?>"><?=($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)?></td>
    </tr>
    <tr class="row6">
        <td class="column0 style42 s border-left">Specific Injuries</td>
        <td class="column1 style16 n"><?=$spe_tar_jan?></td>
        <td class="column2 style18 n <?=$spe_act_jan_cell_color?>"><?=$spe_act_jan?></td>
        <td class="column3 style21 n"><?=$spe_tar_feb?></td>
        <td class="column4 style18 n <?=$spe_act_feb_cell_color?>"><?=$spe_act_feb?></td>
        <td class="column5 style16 n"><?=$spe_tar_mar?></td>
        <td class="column6 style17 n <?=$spe_act_mar_cell_color?>"><?=$spe_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_spe_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_spe_actual_cell_color?>"><?=$Q1_spe_actual?></td>
        <td class="column9 style21 n"><?=$spe_tar_apr?></td>
        <td class="column10 style18 n <?=$spe_act_apr_cell_color?>"><?=$spe_act_apr?></td>
        <td class="column11 style16 n"><?=$spe_tar_may?></td>
        <td class="column12 style18 n <?=$spe_act_may_cell_color?>"><?=$spe_act_may?></td>
        <td class="column13 style16 n"><?=$spe_tar_jun?></td>
        <td class="column14 style17 n <?=$spe_act_jun_cell_color?>"><?=$spe_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_spe_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_spe_actual_cell_color?>"><?=$Q2_spe_actual?></td>
        <td class="column17 style21 n"><?=$spe_tar_jul?></td>
        <td class="column18 style18 n <?=$spe_act_jul_cell_color?>"><?=$spe_act_jul?></td>
        <td class="column19 style16 n"><?=$spe_tar_aug?></td>
        <td class="column20 style18 n <?=$spe_act_aug_cell_color?>"><?=$spe_act_aug?></td>
        <td class="column21 style16 n"><?=$spe_tar_sep?></td>
        <td class="column22 style17 n <?=$spe_act_sep_cell_color?>"><?=$spe_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_spe_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_spe_actual_cell_color?>"><?=$Q3_spe_actual?></td>
        <td class="column25 style21 n"><?=$spe_tar_oct?></td>
        <td class="column26 style18 n <?=$spe_act_oct_cell_color?>"><?=$spe_act_oct?></td>
        <td class="column27 style16 n"><?=$spe_tar_nov?></td>
        <td class="column28 style18 n <?=$spe_act_nov_cell_color?>"><?=$spe_act_nov?></td>
        <td class="column29 style16 n"><?=$spe_tar_dec?></td>
        <td class="column30 style17 n <?=$spe_act_dec_cell_color?>"><?=$spe_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_spe_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_spe_actual_cell_color?>"><?=$Q4_spe_actual?></td>
        <td class="column33 style21 f"><?=($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_spe_actual_cell_color?>"><?=($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)?></td>
    </tr>
    <tr class="row7">
        <td class="column0 style42 s border-left">Over 7 day injury</td>
        <td class="column1 style16 n"><?=$day7_tar_jan?></td>
        <td class="column2 style18 n <?=$day7_act_jan_cell_color?>"><?=$day7_act_jan?></td>
        <td class="column3 style21 n"><?=$day7_tar_feb?></td>
        <td class="column4 style18 n <?=$day7_act_feb_cell_color?>"><?=$day7_act_feb?></td>
        <td class="column5 style16 n"><?=$day7_tar_mar?></td>
        <td class="column6 style17 n <?=$day7_act_mar_cell_color?>"><?=$day7_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_7day_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_7day_actual_cell_color?>"><?=$Q1_7day_actual?></td>
        <td class="column9 style21 n"><?=$day7_tar_apr?></td>
        <td class="column10 style18 n <?=$day7_act_apr_cell_color?>"><?=$day7_act_apr?></td>
        <td class="column11 style16 n"><?=$day7_tar_may?></td>
        <td class="column12 style18 n <?=$day7_act_may_cell_color?>"><?=$day7_act_may?></td>
        <td class="column13 style16 n"><?=$day7_tar_jun?></td>
        <td class="column14 style17 n <?=$day7_act_jun_cell_color?>"><?=$day7_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_7day_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_7day_actual_cell_color?>"><?=$Q2_7day_actual?></td>
        <td class="column17 style21 n"><?=$day7_tar_jul?></td>
        <td class="column18 style18 n <?=$day7_act_jul_cell_color?>"><?=$day7_act_jul?></td>
        <td class="column19 style16 n"><?=$day7_tar_aug?></td>
        <td class="column20 style18 n <?=$day7_act_aug_cell_color?>"><?=$day7_act_aug?></td>
        <td class="column21 style16 n"><?=$day7_tar_sep?></td>
        <td class="column22 style17 n <?=$day7_act_sep_cell_color?>"><?=$day7_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_7day_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_7day_actual_cell_color?>"><?=$Q3_7day_actual?></td>
        <td class="column25 style21 n"><?=$day7_tar_oct?></td>
        <td class="column26 style18 n <?=$day7_act_oct_cell_color?>"><?=$day7_act_oct?></td>
        <td class="column27 style16 n"><?=$day7_tar_nov?></td>
        <td class="column28 style18 n <?=$day7_act_nov_cell_color?>"><?=$day7_act_nov?></td>
        <td class="column29 style16 n"><?=$day7_tar_dec?></td>
        <td class="column30 style17 n <?=$day7_act_dec_cell_color?>"><?=$day7_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_7day_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_7day_actual_cell_color?>"><?=$Q4_7day_actual?></td>
        <td class="column33 style21 f"><?=($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_7day_actual_cell_color?>"><?=($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)?></td>
    </tr>
    <tr class="row8">
        <td class="column0 style42 s border-left">Occupational Diseases</td>
        <td class="column1 style16 n"><?=$occu_tar_jan?></td>
        <td class="column2 style18 n <?=$occu_act_jan_cell_color?>"><?=$occu_act_jan?></td>
        <td class="column3 style21 n"><?=$occu_tar_feb?></td>
        <td class="column4 style18 n <?=$occu_act_feb_cell_color?>"><?=$occu_act_feb?></td>
        <td class="column5 style16 n"><?=$occu_tar_mar?></td>
        <td class="column6 style17 n <?=$occu_act_mar_cell_color?>"><?=$occu_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_occu_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_occu_actual_cell_color?>"><?=$Q1_occu_actual?></td>
        <td class="column9 style21 n"><?=$occu_tar_apr?></td>
        <td class="column10 style18 n <?=$occu_act_apr_cell_color?>"><?=$occu_act_apr?></td>
        <td class="column11 style16 n"><?=$occu_tar_may?></td>
        <td class="column12 style18 n <?=$occu_act_may_cell_color?>"><?=$occu_act_may?></td>
        <td class="column13 style16 n"><?=$occu_tar_jun?></td>
        <td class="column14 style17 n <?=$occu_act_jun_cell_color?>"><?=$occu_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_occu_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_occu_actual_cell_color?>"><?=$Q2_occu_actual?></td>
        <td class="column17 style21 n"><?=$occu_tar_jul?></td>
        <td class="column18 style18 n <?=$occu_act_jul_cell_color?>"><?=$occu_act_jul?></td>
        <td class="column19 style16 n"><?=$occu_tar_aug?></td>
        <td class="column20 style18 n <?=$occu_act_aug_cell_color?>"><?=$occu_act_aug?></td>
        <td class="column21 style16 n"><?=$occu_tar_sep?></td>
        <td class="column22 style17 n <?=$occu_act_sep_cell_color?>"><?=$occu_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_occu_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_occu_actual_cell_color?>"><?=$Q3_occu_actual?></td>
        <td class="column25 style21 n"><?=$occu_tar_oct?></td>
        <td class="column26 style18 n <?=$occu_act_oct_cell_color?>"><?=$occu_act_oct?></td>
        <td class="column27 style16 n"><?=$occu_tar_nov?></td>
        <td class="column28 style18 n <?=$occu_act_nov_cell_color?>"><?=$occu_act_nov?></td>
        <td class="column29 style16 n"><?=$occu_tar_dec?></td>
        <td class="column30 style17 n <?=$occu_act_dec_cell_color?>"><?=$occu_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_occu_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_occu_actual_cell_color?>"><?=$Q4_occu_actual?></td>
        <td class="column33 style21 f"><?=($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_occu_actual_cell_color?>"><?=($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)?></td>
    </tr>
    <tr class="row9">
        <td class="column0 style42 s border-left">Dangerous Occurrences</td>
        <td class="column1 style16 n"><?=$dan_tar_jan?></td>
        <td class="column2 style18 n <?=$dan_act_jan_cell_color?>"><?=$dan_act_jan?></td>
        <td class="column3 style21 n"><?=$dan_tar_feb?></td>
        <td class="column4 style18 n <?=$dan_act_feb_cell_color?>"><?=$dan_act_feb?></td>
        <td class="column5 style16 n"><?=$dan_tar_mar?></td>
        <td class="column6 style17 n <?=$dan_act_mar_cell_color?>"><?=$dan_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_dan_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_dan_actual_cell_color?>"><?=$Q1_dan_actual?></td>
        <td class="column9 style21 n"><?=$dan_tar_apr?></td>
        <td class="column10 style18 n <?=$dan_act_apr_cell_color?>"><?=$dan_act_apr?></td>
        <td class="column11 style16 n"><?=$dan_tar_may?></td>
        <td class="column12 style18 n <?=$dan_act_may_cell_color?>"><?=$dan_act_may?></td>
        <td class="column13 style16 n"><?=$dan_tar_jun?></td>
        <td class="column14 style17 n <?=$dan_act_jun_cell_color?>"><?=$dan_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_dan_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_dan_actual_cell_color?>"><?=$Q2_dan_actual?></td>
        <td class="column17 style21 n"><?=$dan_tar_jul?></td>
        <td class="column18 style18 n <?=$dan_act_jul_cell_color?>"><?=$dan_act_jul?></td>
        <td class="column19 style16 n"><?=$dan_tar_aug?></td>
        <td class="column20 style18 n <?=$dan_act_aug_cell_color?>"><?=$dan_act_aug?></td>
        <td class="column21 style16 n"><?=$dan_tar_sep?></td>
        <td class="column22 style17 n <?=$dan_act_sep_cell_color?>"><?=$dan_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_dan_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_dan_actual_cell_color?>"><?=$Q3_dan_actual?></td>
        <td class="column25 style21 n"><?=$dan_tar_oct?></td>
        <td class="column26 style18 n <?=$dan_act_oct_cell_color?>"><?=$dan_act_oct?></td>
        <td class="column27 style16 n"><?=$dan_tar_nov?></td>
        <td class="column28 style18 n <?=$dan_act_nov_cell_color?>"><?=$dan_act_nov?></td>
        <td class="column29 style16 n"><?=$dan_tar_dec?></td>
        <td class="column30 style17 n <?=$dan_act_dec_cell_color?>"><?=$dan_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_dan_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_dan_actual_cell_color?>"><?=$Q4_dan_actual?></td>
        <td class="column33 style21 f"><?=($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_dan_actual_cell_color?>"><?=($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)?></td>
    </tr>
    <tr class="row10">
        <td class="column0 style42 s border-left">Non fatal accidents to non workers</td>
        <td class="column1 style16 n"><?=$nonf_tar_jan?></td>
        <td class="column2 style18 n <?=$nonf_act_jan_cell_color?>"><?=$nonf_act_jan?></td>
        <td class="column3 style21 n"><?=$nonf_tar_feb?></td>
        <td class="column4 style18 n <?=$nonf_act_feb_cell_color?>"><?=$nonf_act_feb?></td>
        <td class="column5 style16 n"><?=$nonf_tar_mar?></td>
        <td class="column6 style17 n <?=$nonf_act_mar_cell_color?>"><?=$nonf_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_nonf_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_nonf_actual_cell_color?>"><?=$Q1_nonf_actual?></td>
        <td class="column9 style21 n"><?=$nonf_tar_apr?></td>
        <td class="column10 style18 n <?=$nonf_act_apr_cell_color?>"><?=$nonf_act_apr?></td>
        <td class="column11 style16 n"><?=$nonf_tar_may?></td>
        <td class="column12 style18 n <?=$nonf_act_may_cell_color?>"><?=$nonf_act_may?></td>
        <td class="column13 style16 n"><?=$nonf_tar_jun?></td>
        <td class="column14 style17 n <?=$nonf_act_jun_cell_color?>"><?=$nonf_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_nonf_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_nonf_actual_cell_color?>"><?=$Q2_nonf_actual?></td>
        <td class="column17 style21 n"><?=$nonf_tar_jul?></td>
        <td class="column18 style18 n <?=$nonf_act_jul_cell_color?>"><?=$nonf_act_jul?></td>
        <td class="column19 style16 n"><?=$nonf_tar_aug?></td>
        <td class="column20 style18 n <?=$nonf_act_aug_cell_color?>"><?=$nonf_act_aug?></td>
        <td class="column21 style16 n"><?=$nonf_tar_sep?></td>
        <td class="column22 style17 n <?=$nonf_act_sep_cell_color?>"><?=$nonf_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_nonf_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_nonf_actual_cell_color?>"><?=$Q3_nonf_actual?></td>
        <td class="column25 style21 n"><?=$nonf_tar_oct?></td>
        <td class="column26 style18 n <?=$nonf_act_oct_cell_color?>"><?=$nonf_act_oct?></td>
        <td class="column27 style16 n"><?=$nonf_tar_nov?></td>
        <td class="column28 style18 n <?=$nonf_act_nov_cell_color?>"><?=$nonf_act_nov?></td>
        <td class="column29 style16 n"><?=$nonf_tar_dec?></td>
        <td class="column30 style17 n <?=$nonf_act_dec_cell_color?>"><?=$nonf_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_nonf_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_nonf_actual_cell_color?>"><?=$Q4_nonf_actual?></td>
        <td class="column33 style21 f"><?=($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_nonf_actual_cell_color?>"><?=($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)?></td>
    </tr>
    <tr class="row11">
        <td class="column0 style42 s border-left">Gas Incident</td>
        <td class="column1 style16 n"><?=$gas_tar_jan?></td>
        <td class="column2 style18 n <?=$gas_act_jan_cell_color?>"><?=$gas_act_jan?></td>
        <td class="column3 style21 n"><?=$gas_tar_feb?></td>
        <td class="column4 style18 n <?=$gas_act_feb_cell_color?>"><?=$gas_act_feb?></td>
        <td class="column5 style16 n"><?=$gas_tar_mar?></td>
        <td class="column6 style17 n <?=$gas_act_mar_cell_color?>"><?=$gas_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_gas_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_gas_actual_cell_color?>"><?=$Q1_gas_actual?></td>
        <td class="column9 style21 n"><?=$gas_tar_apr?></td>
        <td class="column10 style18 n <?=$gas_act_apr_cell_color?>"><?=$gas_act_apr?></td>
        <td class="column11 style16 n"><?=$gas_tar_may?></td>
        <td class="column12 style18 n <?=$gas_act_may_cell_color?>"><?=$gas_act_may?></td>
        <td class="column13 style16 n"><?=$gas_tar_jun?></td>
        <td class="column14 style17 n <?=$gas_act_jun_cell_color?>"><?=$gas_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_gas_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_gas_actual_cell_color?>"><?=$Q2_gas_actual?></td>
        <td class="column17 style21 n"><?=$gas_tar_jul?></td>
        <td class="column18 style18 n <?=$gas_act_jul_cell_color?>"><?=$gas_act_jul?></td>
        <td class="column19 style16 n"><?=$gas_tar_aug?></td>
        <td class="column20 style18 n <?=$gas_act_aug_cell_color?>"><?=$gas_act_aug?></td>
        <td class="column21 style16 n"><?=$gas_tar_sep?></td>
        <td class="column22 style17 n <?=$gas_act_sep_cell_color?>"><?=$gas_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_gas_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_gas_actual_cell_color?>"><?=$Q3_gas_actual?></td>
        <td class="column25 style21 n"><?=$gas_tar_oct?></td>
        <td class="column26 style18 n <?=$gas_act_oct_cell_color?>"><?=$gas_act_oct?></td>
        <td class="column27 style16 n"><?=$gas_tar_nov?></td>
        <td class="column28 style18 n <?=$gas_act_nov_cell_color?>"><?=$gas_act_nov?></td>
        <td class="column29 style16 n"><?=$gas_tar_dec?></td>
        <td class="column30 style17 n <?=$gas_act_dec_cell_color?>"><?=$gas_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_gas_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_gas_actual_cell_color?>"><?=$Q4_gas_actual?></td>
        <td class="column33 style21 f"><?=($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_gas_actual_cell_color?>"><?=($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)?></td>
    </tr>
    <tr class="row12">
        <td class="column0 style85 s border-left border-bottom">Total RIDDOR Report</td>
        <td class="column1 style81 n border-bottom"><?=$ridd_tar_jan?></td>
        <td class="column2 style83 n border-bottom <?=$ridd_act_jan_cell_color?>"><?=$ridd_act_jan?></td>
        <td class="column3 style82 n border-bottom"><?=$ridd_tar_feb?></td>
        <td class="column4 style83 n border-bottom <?=$ridd_act_feb_cell_color?>"><?=$ridd_act_feb?></td>
        <td class="column5 style81 n border-bottom"><?=$ridd_tar_mar?></td>
        <td class="column6 style86 n border-bottom <?=$ridd_act_mar_cell_color?>"><?=$ridd_act_mar?></td>
        <td class="column7 style48 f border-bottom border-left"><?=$Q1_ridd_target?></td>
        <td class="column8 style22 f border-bottom border-right <?=$Q1_ridd_actual_cell_color?>"><?=$Q1_ridd_actual?></td>
        <td class="column9 style82 n border-bottom"><?=$ridd_tar_apr?></td>
        <td class="column10 style83 n border-bottom <?=$ridd_act_apr_cell_color?>"><?=$ridd_act_apr?></td>
        <td class="column11 style81 n border-bottom"><?=$ridd_tar_may?></td>
        <td class="column12 style83 n border-bottom <?=$ridd_act_may_cell_color?>"><?=$ridd_act_may?></td>
        <td class="column13 style81 n border-bottom"><?=$ridd_tar_jun?></td>
        <td class="column14 style86 n border-bottom <?=$ridd_act_jun_cell_color?>"><?=$ridd_act_jun?></td>
        <td class="column15 style77 f border-bottom border-left"><?=$Q2_ridd_target?></td>
        <td class="column16 style78 f border-bottom border-right <?=$Q2_ridd_actual_cell_color?>"><?=$Q2_ridd_actual?></td>
        <td class="column17 style82 n border-bottom"><?=$ridd_tar_jul?></td>
        <td class="column18 style83 n border-bottom <?=$ridd_act_jul_cell_color?>"><?=$ridd_act_jul?></td>
        <td class="column19 style81 n border-bottom"><?=$ridd_tar_aug?></td>
        <td class="column20 style83 n border-bottom <?=$ridd_act_aug_cell_color?>"><?=$ridd_act_aug?></td>
        <td class="column21 style81 n border-bottom"><?=$ridd_tar_sep?></td>
        <td class="column22 style86 n border-bottom <?=$ridd_act_sep_cell_color?>"><?=$ridd_act_sep?></td>
        <td class="column23 style45 f border-bottom border-left"><?=$Q3_ridd_target?></td>
        <td class="column24 style46 f border-bottom border-right <?=$Q3_ridd_actual_cell_color?>"><?=$Q3_ridd_actual?></td>
        <td class="column25 style82 n border-bottom"><?=$ridd_tar_oct?></td>
        <td class="column26 style83 n border-bottom <?=$ridd_act_oct_cell_color?>"><?=$ridd_act_oct?></td>
        <td class="column27 style81 n border-bottom"><?=$ridd_tar_nov?></td>
        <td class="column28 style83 n border-bottom <?=$ridd_act_nov_cell_color?>"><?=$ridd_act_nov?></td>
        <td class="column29 style81 n border-bottom"><?=$ridd_tar_dec?></td>
        <td class="column30 style86 n border-bottom <?=$ridd_act_dec_cell_color?>"><?=$ridd_act_dec?></td>
        <td class="column31 style45 f border-bottom border-left"><?=$Q4_ridd_target?></td>
        <td class="column32 style46 f border-bottom border-right <?=$Q4_ridd_actual_cell_color?>"><?=$Q4_ridd_actual?></td>
        <td class="column33 style30 f border-bottom"><?=($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)?></td>
        <td class="column34 style26 f border-right border-bottom <?=$YTD_ridd_actual_cell_color?>"><?=($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)?></td>
    </tr>
    <tr class="row13">
        <td class="column0 style50 s border-left">No of medical treatment over first aid</td>
        <td class="column1 style10 n"><?=$medi_tar_jan?></td>
        <td class="column2 style11 n <?=$medi_act_jan_cell_color?>"><?=$medi_act_jan?></td>
        <td class="column3 style10 n"><?=$medi_tar_feb?></td>
        <td class="column4 style12 n <?=$medi_act_feb_cell_color?>"><?=$medi_act_feb?></td>
        <td class="column5 style10 n"><?=$medi_tar_mar?></td>
        <td class="column6 style11 n <?=$medi_act_mar_cell_color?>"><?=$medi_act_mar?></td>
        <td class="column7 style13 f border-left"><?=$Q1_medi_target?></td>
        <td class="column8 style14 f border-right <?=$Q1_medi_actual_cell_color?>"><?=$Q1_medi_actual?></td>
        <td class="column9 style15 n"><?=$medi_tar_apr?></td>
        <td class="column10 style12 n <?=$medi_act_apr_cell_color?>"><?=$medi_act_apr?></td>
        <td class="column11 style10 n"><?=$medi_tar_may?></td>
        <td class="column12 style12 n <?=$medi_act_may_cell_color?>"><?=$medi_act_may?></td>
        <td class="column13 style10 n"><?=$medi_tar_jun?></td>
        <td class="column14 style11 n <?=$medi_act_jun_cell_color?>"><?=$medi_act_jun?></td>
        <td class="column15 style13 f border-left"><?=$Q2_medi_target?></td>
        <td class="column16 style14 f border-right <?=$Q2_medi_actual_cell_color?>"><?=$Q2_medi_actual?></td>
        <td class="column17 style15 n"><?=$medi_tar_jul?></td>
        <td class="column18 style12 n <?=$medi_act_jul_cell_color?>"><?=$medi_act_jul?></td>
        <td class="column19 style10 n"><?=$medi_tar_aug?></td>
        <td class="column20 style11 n <?=$medi_act_aug_cell_color?>"><?=$medi_act_aug?></td>
        <td class="column21 style10 n"><?=$medi_tar_sep?></td>
        <td class="column22 style11 n <?=$medi_act_sep_cell_color?>"><?=$medi_act_sep?></td>
        <td class="column23 style13 f border-left"><?=$Q3_medi_target?></td>
        <td class="column24 style14 f border-right <?=$Q3_medi_actual_cell_color?>"><?=$Q3_medi_actual?></td>
        <td class="column25 style15 n"><?=$medi_tar_oct?></td>
        <td class="column26 style12 n <?=$medi_act_oct_cell_color?>"><?=$medi_act_oct?></td>
        <td class="column27 style10 n"><?=$medi_tar_nov?></td>
        <td class="column28 style12 n <?=$medi_act_nov_cell_color?>"><?=$medi_act_nov?></td>
        <td class="column29 style10 n"><?=$medi_tar_dec?></td>
        <td class="column30 style11 n <?=$medi_act_dec_cell_color?>"><?=$medi_act_dec?></td>
        <td class="column31 style13 f border-left"><?=$Q4_medi_target?></td>
        <td class="column32 style14 f border-right <?=$Q4_medi_actual_cell_color?>"><?=$Q4_medi_actual?></td>
        <td class="column33 style15 f"><?=($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)?></td>
        <td class="column34 style12 f border-right <?=$YTD_medi_actual_cell_color?>"><?=($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)?></td>
    </tr>
    <tr class="row14">
        <td class="column0 style42 s border-left">No of minor injuries</td>
        <td class="column1 style16 n"><?=$mino_tar_jan?></td>
        <td class="column2 style17 n <?=$mino_act_jan_cell_color?>"><?=$mino_act_jan?></td>
        <td class="column3 style16 n"><?=$mino_tar_feb?></td>
        <td class="column4 style18 n <?=$mino_act_feb_cell_color?>"><?=$mino_act_feb?></td>
        <td class="column5 style16 n"><?=$mino_tar_mar?></td>
        <td class="column6 style17 n <?=$mino_act_mar_cell_color?>"><?=$mino_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_mino_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_mino_actual_cell_color?>"><?=$Q1_mino_actual?></td>
        <td class="column9 style21 n"><?=$mino_tar_apr?></td>
        <td class="column10 style18 n <?=$mino_act_apr_cell_color?>"><?=$mino_act_apr?></td>
        <td class="column11 style16 n"><?=$mino_tar_may?></td>
        <td class="column12 style18 n <?=$mino_act_may_cell_color?>"><?=$mino_act_may?></td>
        <td class="column13 style16 n"><?=$mino_tar_jun?></td>
        <td class="column14 style17 n <?=$mino_act_jun_cell_color?>"><?=$mino_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_mino_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_mino_actual_cell_color?>"><?=$Q2_mino_actual?></td>
        <td class="column17 style21 n"><?=$mino_tar_jul?></td>
        <td class="column18 style18 n <?=$mino_act_jul_cell_color?>"><?=$mino_act_jul?></td>
        <td class="column19 style16 n"><?=$mino_tar_aug?></td>
        <td class="column20 style17 n <?=$mino_act_aug_cell_color?>"><?=$mino_act_aug?></td>
        <td class="column21 style16 n"><?=$mino_tar_sep?></td>
        <td class="column22 style17 n <?=$mino_act_sep_cell_color?>"><?=$mino_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_mino_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_mino_actual_cell_color?>"><?=$Q3_mino_actual?></td>
        <td class="column25 style21 n"><?=$mino_tar_oct?></td>
        <td class="column26 style18 n <?=$mino_act_oct_cell_color?>"><?=$mino_act_oct?></td>
        <td class="column27 style16 n"><?=$mino_tar_nov?></td>
        <td class="column28 style18 n <?=$mino_act_nov_cell_color?>"><?=$mino_act_nov?></td>
        <td class="column29 style16 n"><?=$mino_tar_dec?></td>
        <td class="column30 style17 n <?=$mino_act_dec_cell_color?>"><?=$mino_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_mino_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_mino_actual_cell_color?>"><?=$Q4_mino_actual?></td>
        <td class="column33 style21 f"><?=($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_mino_actual_cell_color?>"><?=($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)?></td>
    </tr>
    <tr class="row15">
        <td class="column0 style51 s border-left border-bottom">Total lost days</td>
        <td class="column1 style23 n border-bottom"><?=$lost_tar_jan?></td>
        <td class="column2 style24 n border-bottom <?=$lost_act_jan_cell_color?>"><?=$lost_act_jan?></td>
        <td class="column3 style23 n border-bottom"><?=$lost_tar_feb?></td>
        <td class="column4 style47 n border-bottom <?=$lost_act_feb_cell_color?>"><?=$lost_act_feb?></td>
        <td class="column5 style23 n border-bottom"><?=$lost_tar_mar?></td>
        <td class="column6 style24 n border-bottom <?=$lost_act_mar_cell_color?>"><?=$lost_act_mar?></td>
        <td class="column7 style28 f border-bottom border-left"><?=$Q1_lost_target?></td>
        <td class="column8 style29 f border-bottom border-right <?=$Q1_lost_actual_cell_color?>"><?=$Q1_lost_actual?></td>
        <td class="column9 style49 n border-bottom"><?=$lost_tar_apr?></td>
        <td class="column10 style47 n border-bottom <?=$lost_act_apr_cell_color?>"><?=$lost_act_apr?></td>
        <td class="column11 style23 n border-bottom"><?=$lost_tar_may?></td>
        <td class="column12 style47 n border-bottom <?=$lost_act_may_cell_color?>"><?=$lost_act_may?></td>
        <td class="column13 style23 n border-bottom"><?=$lost_tar_jun?></td>
        <td class="column14 style24 n border-bottom <?=$lost_act_jun_cell_color?>"><?=$lost_act_jun?></td>
        <td class="column15 style28 f border-bottom border-left"><?=$Q2_lost_target?></td>
        <td class="column16 style29 f border-bottom border-right <?=$Q2_lost_actual_cell_color?>"><?=$Q2_lost_actual?></td>
        <td class="column17 style49 n border-bottom"><?=$lost_tar_jul?></td>
        <td class="column18 style47 n border-bottom <?=$lost_act_jul_cell_color?>"><?=$lost_act_jul?></td>
        <td class="column19 style23 n border-bottom"><?=$lost_tar_aug?></td>
        <td class="column20 style24 n border-bottom <?=$lost_act_aug_cell_color?>"><?=$lost_act_aug?></td>
        <td class="column21 style23 n border-bottom"><?=$lost_tar_sep?></td>
        <td class="column22 style24 n border-bottom <?=$lost_act_sep_cell_color?>"><?=$lost_act_sep?></td>
        <td class="column23 style28 f border-bottom border-left"><?=$Q3_lost_target?></td>
        <td class="column24 style29 f border-bottom border-right <?=$Q3_lost_actual_cell_color?>"><?=$Q3_lost_actual?></td>
        <td class="column25 style49 n border-bottom"><?=$lost_tar_oct?></td>
        <td class="column26 style47 n border-bottom <?=$lost_act_oct_cell_color?>"><?=$lost_act_oct?></td>
        <td class="column27 style23 n border-bottom"><?=$lost_tar_nov?></td>
        <td class="column28 style47 n border-bottom <?=$lost_act_nov_cell_color?>"><?=$lost_act_nov?></td>
        <td class="column29 style23 n border-bottom"><?=$lost_tar_dec?></td>
        <td class="column30 style24 n border-bottom <?=$lost_act_dec_cell_color?>"><?=$lost_act_dec?></td>
        <td class="column31 style28 f border-bottom border-left"><?=$Q4_lost_target?></td>
        <td class="column32 style29 f border-bottom border-right <?=$Q4_lost_actual_cell_color?>"><?=$Q4_lost_actual?></td>
        <td class="column33 style49 f border-bottom"><?=($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)?></td>
        <td class="column34 style47 f border-right border-bottom <?=$YTD_lost_actual_cell_color?>"><?=($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)?></td>
    </tr>
    <tr class="row16">
        <td class="column0 style61 s border-left">Hazard Identification</td>
        <td class="column1 style10 n"><?=$haz_tar_jan?></td>
        <td class="column2 style12 n <?=$haz_act_jan_cell_color?>"><?=$haz_act_jan?></td>
        <td class="column3 style10 n"><?=$haz_tar_feb?></td>
        <td class="column4 style12 n <?=$haz_act_feb_cell_color?>"><?=$haz_act_feb?></td>
        <td class="column5 style10 n"><?=$haz_tar_mar?></td>
        <td class="column6 style11 n <?=$haz_act_mar_cell_color?>"><?=$haz_act_mar?></td>
        <td class="column7 style13 f border-left"><?=$Q1_haz_target?></td>
        <td class="column8 style14 f border-right <?=$Q1_haz_actual_cell_color?>"><?=$Q1_haz_actual?></td>
        <td class="column9 style15 n"><?=$haz_tar_apr?></td>
        <td class="column10 style12 n <?=$haz_act_apr_cell_color?>"><?=$haz_act_apr?></td>
        <td class="column11 style10 n"><?=$haz_tar_may?></td>
        <td class="column12 style12 n <?=$haz_act_may_cell_color?>"><?=$haz_act_may?></td>
        <td class="column13 style10 n"><?=$haz_tar_jun?></td>
        <td class="column14 style11 n <?=$haz_act_jun_cell_color?>"><?=$haz_act_jun?></td>
        <td class="column15 style13 f border-left"><?=$Q2_haz_target?></td>
        <td class="column16 style14 f border-right <?=$Q2_haz_actual_cell_color?>"><?=$Q2_haz_actual?></td>
        <td class="column17 style15 n"><?=$haz_tar_jul?></td>
        <td class="column18 style12 n <?=$haz_act_jul_cell_color?>"><?=$haz_act_jul?></td>
        <td class="column19 style10 n"><?=$haz_tar_aug?></td>
        <td class="column20 style11 n <?=$haz_act_aug_cell_color?>"><?=$haz_act_aug?></td>
        <td class="column21 style10 n"><?=$haz_tar_sep?></td>
        <td class="column22 style11 n <?=$haz_act_sep_cell_color?>"><?=$haz_act_sep?></td>
        <td class="column23 style13 f border-left"><?=$Q3_haz_target?></td>
        <td class="column24 style14 f border-right <?=$Q3_haz_actual_cell_color?>"><?=$Q3_haz_actual?></td>
        <td class="column25 style15 n"><?=$haz_tar_oct?></td>
        <td class="column26 style12 n <?=$haz_act_oct_cell_color?>"><?=$haz_act_oct?></td>
        <td class="column27 style10 n"><?=$haz_tar_nov?></td>
        <td class="column28 style12 n <?=$haz_act_nov_cell_color?>"><?=$haz_act_nov?></td>
        <td class="column29 style10 n"><?=$haz_tar_dec?></td>
        <td class="column30 style11 n <?=$haz_act_dec_cell_color?>"><?=$haz_act_dec?></td>
        <td class="column31 style13 f border-left"><?=$Q4_haz_target?></td>
        <td class="column32 style14 f border-right <?=$Q4_haz_actual_cell_color?>"><?=$Q4_haz_actual?></td>
        <td class="column33 style15 f"><?=($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)?></td>
        <td class="column34 style12 f border-right <?=$YTD_haz_actual_cell_color?>"><?=($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)?></td>
    </tr>
    <tr class="row17">
        <td class="column0 style62 s border-left">Near Misses</td>
        <td class="column1 style16 n"><?=$near_tar_jan?></td>
        <td class="column2 style18 n <?=$near_act_jan_cell_color?>"><?=$near_act_jan?></td>
        <td class="column3 style16 n"><?=$near_tar_feb?></td>
        <td class="column4 style18 n <?=$near_act_feb_cell_color?>"><?=$near_act_feb?></td>
        <td class="column5 style16 n"><?=$near_tar_mar?></td>
        <td class="column6 style17 n <?=$near_act_mar_cell_color?>"><?=$near_act_mar?></td>
        <td class="column7 style19 f border-left"><?=$Q1_near_target?></td>
        <td class="column8 style20 f border-right <?=$Q1_near_actual_cell_color?>"><?=$Q1_near_actual?></td>
        <td class="column9 style21 n"><?=$near_tar_apr?></td>
        <td class="column10 style18 n <?=$near_act_apr_cell_color?>"><?=$near_act_apr?></td>
        <td class="column11 style16 n"><?=$near_tar_may?></td>
        <td class="column12 style18 n <?=$near_act_may_cell_color?>"><?=$near_act_may?></td>
        <td class="column13 style16 n"><?=$near_tar_jun?></td>
        <td class="column14 style17 n <?=$near_act_jun_cell_color?>"><?=$near_act_jun?></td>
        <td class="column15 style19 f border-left"><?=$Q2_near_target?></td>
        <td class="column16 style20 f border-right <?=$Q2_near_actual_cell_color?>"><?=$Q2_near_actual?></td>
        <td class="column17 style21 n"><?=$near_tar_jul?></td>
        <td class="column18 style18 n <?=$near_act_jul_cell_color?>"><?=$near_act_jul?></td>
        <td class="column19 style16 n"><?=$near_tar_aug?></td>
        <td class="column20 style17 n <?=$near_act_aug_cell_color?>"><?=$near_act_aug?></td>
        <td class="column21 style16 n"><?=$near_tar_sep?></td>
        <td class="column22 style17 n <?=$near_act_sep_cell_color?>"><?=$near_act_sep?></td>
        <td class="column23 style19 f border-left"><?=$Q3_near_target?></td>
        <td class="column24 style20 f border-right <?=$Q3_near_actual_cell_color?>"><?=$Q3_near_actual?></td>
        <td class="column25 style21 n"><?=$near_tar_oct?></td>
        <td class="column26 style18 n <?=$near_act_oct_cell_color?>"><?=$near_act_oct?></td>
        <td class="column27 style16 n"><?=$near_tar_nov?></td>
        <td class="column28 style18 n <?=$near_act_nov_cell_color?>"><?=$near_act_nov?></td>
        <td class="column29 style16 n"><?=$near_tar_dec?></td>
        <td class="column30 style17 n <?=$near_act_dec_cell_color?>"><?=$near_act_dec?></td>
        <td class="column31 style19 f border-left"><?=$Q4_near_target?></td>
        <td class="column32 style20 f border-right <?=$Q4_near_actual_cell_color?>"><?=$Q4_near_actual?></td>
        <td class="column33 style21 f"><?=($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)?></td>
        <td class="column34 style18 f border-right <?=$YTD_near_actual_cell_color?>"><?=($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)?></td>
    </tr>
    <tr class="row18">
        <td class="column0 style84 s border-left border-bottom">Hazards Identified / Near Misses Total</td>
        <td class="column1 style25 n border-bottom"><?=$haznea_tar_jan?></td>
        <td class="column2 style26 n border-bottom <?=$haznea_act_jan_cell_color?>"><?=$haznea_act_jan?></td>
        <td class="column3 style25 n border-bottom"><?=$haznea_tar_feb?></td>
        <td class="column4 style26 n border-bottom <?=$haznea_act_feb_cell_color?>"><?=$haznea_act_feb?></td>
        <td class="column5 style25 n border-bottom"><?=$haznea_tar_mar?></td>
        <td class="column6 style27 n border-bottom <?=$haznea_act_mar_cell_color?>"><?=$haznea_act_mar?></td>
        <td class="column7 style28 f border-bottom border-left"><?=$Q1_haznea_target?></td>
        <td class="column8 style29 f border-bottom border-right <?=$Q1_haznea_actual_cell_color?>"><?=$Q1_haznea_actual?></td>
        <td class="column9 style30 n border-bottom"><?=$haznea_tar_apr?></td>
        <td class="column10 style26 n border-bottom <?=$haznea_act_apr_cell_color?>"><?=$haznea_act_apr?></td>
        <td class="column11 style25 n border-bottom"><?=$haznea_tar_may?></td>
        <td class="column12 style26 n border-bottom <?=$haznea_act_may_cell_color?>"><?=$haznea_act_may?></td>
        <td class="column13 style25 n border-bottom"><?=$haznea_tar_jun?></td>
        <td class="column14 style27 n border-bottom <?=$haznea_act_jun_cell_color?>"><?=$haznea_act_jun?></td>
        <td class="column15 style28 f border-bottom border-left"><?=$Q2_haznea_target?></td>
        <td class="column16 style29 f border-bottom border-right <?=$Q2_haznea_actual_cell_color?>"><?=$Q2_haznea_actual?></td>
        <td class="column17 style30 n border-bottom"><?=$haznea_tar_jul?></td>
        <td class="column18 style26 n border-bottom <?=$haznea_act_jul_cell_color?>"><?=$haznea_act_jul?></td>
        <td class="column19 style25 n border-bottom"><?=$haznea_tar_aug?></td>
        <td class="column20 style27 n border-bottom <?=$haznea_act_aug_cell_color?>"><?=$haznea_act_aug?></td>
        <td class="column21 style25 n border-bottom"><?=$haznea_tar_sep?></td>
        <td class="column22 style27 n border-bottom <?=$haznea_act_sep_cell_color?>"><?=$haznea_act_sep?></td>
        <td class="column23 style28 f border-bottom border-left"><?=$Q3_near_target?></td>
        <td class="column24 style29 f border-bottom border-right <?=$Q3_haznea_actual_cell_color?>"><?=$Q3_haznea_actual?></td>
        <td class="column25 style30 n border-bottom"><?=$haznea_tar_oct?></td>
        <td class="column26 style26 n border-bottom <?=$haznea_act_oct_cell_color?>"><?=$haznea_act_oct?></td>
        <td class="column27 style25 n border-bottom"><?=$haznea_tar_nov?></td>
        <td class="column28 style26 n border-bottom <?=$haznea_act_nov_cell_color?>"><?=$haznea_act_nov?></td>
        <td class="column29 style25 n border-bottom"><?=$haznea_tar_dec?></td>
        <td class="column30 style27 n border-bottom <?=$haznea_act_dec_cell_color?>"><?=$haznea_act_dec?></td>
        <td class="column31 style28 f border-bottom border-left"><?=$Q4_haznea_target?></td>
        <td class="column32 style29 f border-bottom border-right <?=$Q4_haznea_actual_cell_color?>"><?=$Q4_haznea_actual?></td>
        <td class="column33 style30 f border-bottom"><?=($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)?></td>
        <td class="column34 style26 f border-right border-bottom <?=$YTD_haznea_actual_cell_color?>"><?=($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)?></td>
    </tr>
    <tr class="row19">
        <td class="column0 style80 s border-left border-bottom">Incidents</td>
        <td class="column1 style81 n border-bottom"><?=$inci_tar_jan?></td>
        <td class="column2 style86 n border-bottom <?=$inci_act_jan_cell_color?>"><?=$inci_act_jan?></td>
        <td class="column3 style81 n border-bottom"><?=$inci_tar_feb?></td>
        <td class="column4 style83 n border-bottom <?=$inci_act_feb_cell_color?>"><?=$inci_act_feb?></td>
        <td class="column5 style81 n border-bottom"><?=$inci_tar_mar?></td>
        <td class="column6 style86 n border-bottom <?=$inci_act_mar_cell_color?>"><?=$inci_act_mar?></td>
        <td class="column7 style39 f border-bottom border-left"><?=$Q1_inci_target?></td>
        <td class="column8 style40 f border-bottom border-right <?=$Q1_inci_actual_cell_color?>"><?=$Q1_inci_actual?></td>
        <td class="column9 style82 n border-bottom"><?=$inci_tar_apr?></td>
        <td class="column10 style83 n border-bottom <?=$inci_act_apr_cell_color?>"><?=$inci_act_apr?></td>
        <td class="column11 style81 n border-bottom"><?=$inci_tar_may?></td>
        <td class="column12 style83 n border-bottom <?=$inci_act_may_cell_color?>"><?=$inci_act_may?></td>
        <td class="column13 style81 n border-bottom"><?=$inci_tar_jun?></td>
        <td class="column14 style86 n border-bottom <?=$inci_act_jun_cell_color?>"><?=$inci_act_jun?></td>
        <td class="column15 style39 f border-bottom border-left"><?=$Q2_inci_target?></td>
        <td class="column16 style40 f border-bottom border-right <?=$Q2_inci_actual_cell_color?>"><?=$Q2_inci_actual?></td>
        <td class="column17 style82 n border-bottom"><?=$inci_tar_jul?></td>
        <td class="column18 style83 n border-bottom <?=$inci_act_jul_cell_color?>"><?=$inci_act_jul?></td>
        <td class="column19 style81 n border-bottom"><?=$inci_tar_aug?></td>
        <td class="column20 style86 n border-bottom <?=$inci_act_aug_cell_color?>"><?=$inci_act_aug?></td>
        <td class="column21 style81 n border-bottom"><?=$inci_tar_sep?></td>
        <td class="column22 style86 n border-bottom <?=$inci_act_sep_cell_color?>"><?=$inci_act_sep?></td>
        <td class="column23 style39 f border-bottom border-left"><?=$Q3_inci_target?></td>
        <td class="column24 style40 f border-bottom border-right <?=$Q3_inci_actual_cell_color?>"><?=$Q3_inci_actual?></td>
        <td class="column25 style82 n border-bottom"><?=$inci_tar_oct?></td>
        <td class="column26 style83 n border-bottom <?=$inci_act_oct_cell_color?>"><?=$inci_act_oct?></td>
        <td class="column27 style81 n border-bottom"><?=$inci_tar_nov?></td>
        <td class="column28 style83 n border-bottom <?=$inci_act_nov_cell_color?>"><?=$inci_act_nov?></td>
        <td class="column29 style81 n border-bottom"><?=$inci_tar_dec?></td>
        <td class="column30 style86 n border-bottom <?=$inci_act_dec_cell_color?>"><?=$inci_act_dec?></td>
        <td class="column31 style39 f border-bottom border-left"><?=$Q4_inci_target?></td>
        <td class="column32 style40 f border-bottom border-right <?=$Q4_inci_actual_cell_color?>"><?=$Q4_inci_actual?></td>
        <td class="column33 style82 f border-bottom"><?=($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)?></td>
        <td class="column34 style83 f border-right border-bottom <?=$YTD_inci_actual_cell_color?>"><?=($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)?></td>
    </tr>
    <tr class="row20">
        <td class="column0 style91 s border-left">Avg. No of employees</td>
        <td class="column1 style90"></td>
        <td class="column2 style12 n"><?=$empl_act_jan?></td>
        <td class="column3 style63"></td>
        <td class="column4 style43 n"><?=$empl_act_feb?></td>
        <td class="column5 style63"></td>
        <td class="column6 style44 n"><?=$empl_act_mar?></td>
        <td class="column7 style87 border-left"></td>
        <td class="column8 style14 f border-right"><?=$Q1_empl_actual = get_avg($objAvgQ1)?></td>
        <td class="column9 style31"></td>
        <td class="column10 style43 n"><?=$empl_act_apr?></td>
        <td class="column11 style63"></td>
        <td class="column12 style43 n"><?=$empl_act_may?></td>
        <td class="column13 style63"></td>
        <td class="column14 style44 n"><?=$empl_act_jun?></td>
        <td class="column15 style32 border-left"></td>
        <td class="column16 style33 f border-right"><?=$Q2_empl_actual = get_avg($objAvgQ2)?></td>
        <td class="column17 style31"></td>
        <td class="column18 style43 n"><?=$empl_act_jul?></td>
        <td class="column19 style63"></td>
        <td class="column20 style44 n"><?=$empl_act_aug?></td>
        <td class="column21 style63"></td>
        <td class="column22 style44 n"><?=$empl_act_sep?></td>
        <td class="column23 style32 border-left"></td>
        <td class="column24 style33 f border-right"><?=$Q3_empl_actual = get_avg($objAvgQ3)?></td>
        <td class="column25 style31"></td>
        <td class="column26 style43 n"><?=$empl_act_oct?></td>
        <td class="column27 style63"></td>
        <td class="column28 style43 n"><?=$empl_act_nov?></td>
        <td class="column29 style63"></td>
        <td class="column30 style44 n"><?=$empl_act_dec?></td>
        <td class="column31 style87 border-left"></td>
        <td class="column32 style88 f border-right"><?=$Q4_empl_actual = get_avg($objAvgQ4)?></td>
        <td class="column33 style31"></td>
        <td class="column34 style43 f border-right"><?=$Q2_empl_actual = get_avg($objAvgYTD)?></td>
    </tr>
    <tr class="row21">
        <td class="column0 style92 s border-left">Total hours worked</td>
        <td class="column1 style64"></td>
        <td class="column2 style43 n"><?=$wor_act_jan?></td>
        <td class="column3 style64"></td>
        <td class="column4 style43 n"><?=$wor_act_feb?></td>
        <td class="column5 style64"></td>
        <td class="column6 style44 n"><?=$wor_act_mar?></td>
        <td class="column7 style34 border-left"></td>
        <td class="column8 style20 f border-right"><?=$Q1_wor_actual?></td>
        <td class="column9 style36"></td>
        <td class="column10 style43 n"><?=$wor_act_apr?></td>
        <td class="column11 style64"></td>
        <td class="column12 style43 n"><?=$wor_act_may?></td>
        <td class="column13 style64"></td>
        <td class="column14 style44 n"><?=$wor_act_jun?></td>
        <td class="column15 style34 border-left"></td>
        <td class="column16 style35 f border-right"><?=$Q2_wor_actual?></td>
        <td class="column17 style36"></td>
        <td class="column18 style43 n"><?=$wor_act_jul?></td>
        <td class="column19 style64"></td>
        <td class="column20 style44 n"><?=$wor_act_aug?></td>
        <td class="column21 style64"></td>
        <td class="column22 style44 n"><?=$wor_act_sep?></td>
        <td class="column23 style34 border-left"></td>
        <td class="column24 style35 f border-right"><?=$Q3_wor_actual?></td>
        <td class="column25 style36"></td>
        <td class="column26 style43 n"><?=$wor_act_oct?></td>
        <td class="column27 style64"></td>
        <td class="column28 style43 n"><?=$wor_act_nov?></td>
        <td class="column29 style64"></td>
        <td class="column30 style44 n"><?=$wor_act_dec?></td>
        <td class="column31 style34 border-left"></td>
        <td class="column32 style35 f border-right"><?=$Q4_wor_actual?></td>
        <td class="column33 style36"></td>
        <td class="column34 style18 f border-right"><?=($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual)?></td>
    </tr>
    <tr class="row22">
        <td class="column0 style92 s border-left">Non reportable Injury Rate</td>
        <td class="column1 style64"></td>
        <td class="column2 style65 f"><?=$wor_act_jan>0 ? round(($non_reportable_jan*100000)/$wor_act_jan,2): 0?></td>
        <td class="column3 style79"></td>
        <td class="column4 style65 f"><?=$wor_act_feb>0 ? round(($non_reportable_feb*100000)/$wor_act_feb,2): 0?></td>
        <td class="column5 style79"></td>
        <td class="column6 style60 f"><?=$wor_act_mar>0 ? round(($non_reportable_mar*100000)/$wor_act_mar,2): 0?></td>
        <td class="column7 style57 border-left"></td>
        <td class="column8 style58 f border-right"><?=$Q1_wor_actual>0 ? round(($Q1_non_reportable*100000)/$Q1_wor_actual,2): 0?></td>
        <td class="column9 style59"></td>
        <td class="column10 style65 f"><?=$wor_act_apr>0 ? round(($non_reportable_apr*100000)/$wor_act_apr,2): 0?></td>
        <td class="column11 style79"></td>
        <td class="column12 style65 f"><?=$wor_act_may>0 ? round(($non_reportable_may*100000)/$wor_act_may,2): 0?></td>
        <td class="column13 style79"></td>
        <td class="column14 style60 f"><?=$wor_act_jun>0 ? round(($non_reportable_jun*100000)/$wor_act_jun,2): 0?></td>
        <td class="column15 style57 border-left"></td>
        <td class="column16 style58 f border-right"><?=$Q2_wor_actual>0 ? round(($Q2_non_reportable*100000)/$Q2_wor_actual,2): 0?></td>
        <td class="column17 style59"></td>
        <td class="column18 style65 f"><?=$wor_act_jul>0 ? round(($non_reportable_jul*100000)/$wor_act_jul,2): 0?></td>
        <td class="column19 style79"></td>
        <td class="column20 style60 f"><?=$wor_act_aug>0 ? round(($non_reportable_aug*100000)/$wor_act_aug,2): 0?></td>
        <td class="column21 style79"></td>
        <td class="column22 style60 f"><?=$wor_act_sep>0 ? round(($non_reportable_sep*100000)/$wor_act_sep,2): 0?></td>
        <td class="column23 style57 border-left"></td>
        <td class="column24 style58 f border-right"><?=$Q3_wor_actual>0 ? round(($Q3_non_reportable*100000)/$Q3_wor_actual,2): 0?></td>
        <td class="column25 style59"></td>
        <td class="column26 style65 f"><?=$wor_act_oct>0 ? round(($non_reportable_oct*100000)/$wor_act_oct,2): 0?></td>
        <td class="column27 style79"></td>
        <td class="column28 style65 f"><?=$wor_act_nov>0 ? round(($non_reportable_nov*100000)/$wor_act_nov,2): 0?></td>
        <td class="column29 style79"></td>
        <td class="column30 style60 f"><?=$wor_act_dec>0 ? round(($non_reportable_dec*100000)/$wor_act_dec,2): 0?></td>
        <td class="column31 style57 border-left"></td>
        <td class="column32 style58 f border-right"><?=$Q4_wor_actual>0 ? round(($Q4_non_reportable*100000)/$Q4_wor_actual,2): 0?></td>
        <td class="column33 style59"></td>
        <td class="column34 style65 f border-right"><?=(is_nan((($Q1_non_reportable+$Q2_non_reportable+$Q3_non_reportable+$Q4_non_reportable) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual))?0:round((($Q1_non_reportable+$Q2_non_reportable+$Q3_non_reportable+$Q4_non_reportable) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual),2))?></td>
    </tr>
    <tr class="row23">
        <td class="column0 style93 s border-left border-bottom">Accident Frequency Rates (AFR)</td>
        <td class="column1 style66 border-bottom"></td>
        <td class="column2 style26 f border-bottom"><?=(is_nan((($ridd_act_jan * 100000)/$wor_act_jan))?0:(is_infinite(($ridd_act_jan * 100000)/$wor_act_jan)?0:round(($ridd_act_jan * 100000)/$wor_act_jan,2)))?></td>
        <td class="column3 style66 border-bottom"></td>
        <td class="column4 style26 f border-bottom"><?=(is_nan((($ridd_act_feb * 100000)/$wor_act_feb))?0:(is_infinite(($ridd_act_feb * 100000)/$wor_act_feb)?0:round(($ridd_act_feb * 100000)/$wor_act_feb,2)))?></td>
        <td class="column5 style66 border-bottom"></td>
        <td class="column6 style27 f border-bottom"><?=(is_nan((($ridd_act_mar * 100000)/$wor_act_mar))?0:(is_infinite(($ridd_act_mar * 100000)/$wor_act_mar)?0:round(($ridd_act_mar * 100000)/$wor_act_mar,2)))?></td>
        <td class="column7 style37 border-bottom border-left"></td>
        <td class="column8 style29 f border-bottom border-right"><?=(is_nan((($Q1_ridd_actual * 100000)/$Q1_wor_actual))?0:(is_infinite((($Q1_ridd_actual * 100000)/$Q1_wor_actual))?0:round(($Q1_ridd_actual * 100000)/$Q1_wor_actual,2)))?></td>
        <td class="column9 style38 border-bottom"></td>
        <td class="column10 style26 f border-bottom"><?=(is_nan((($ridd_act_apr * 100000)/$wor_act_apr))?0:(is_infinite(($ridd_act_apr * 100000)/$wor_act_apr)?0:round(($ridd_act_apr * 100000)/$wor_act_apr,2)))?></td>
        <td class="column11 style66 border-bottom"></td>
        <td class="column12 style26 f border-bottom"><?=(is_nan((($ridd_act_may * 100000)/$wor_act_may))?0:(is_infinite(($ridd_act_may * 100000)/$wor_act_may)?0:round(($ridd_act_may * 100000)/$wor_act_may,2)))?></td>
        <td class="column13 style66 border-bottom"></td>
        <td class="column14 style27 f border-bottom"><?=(is_nan((($ridd_act_jun * 100000)/$wor_act_jun))?0:(is_infinite(($ridd_act_jun * 100000)/$wor_act_jun)?0:round(($ridd_act_jun * 100000)/$wor_act_jun,2)))?></td>
        <td class="column15 style37 border-bottom border-left"></td>
        <td class="column16 style29 f border-bottom border-right"><?=(is_nan((($Q2_ridd_actual * 100000)/$Q2_wor_actual))?0:(is_infinite((($Q2_ridd_actual * 100000)/$Q2_wor_actual))?0:round(($Q2_ridd_actual * 100000)/$Q2_wor_actual,2)))?></td>
        <td class="column17 style38 border-bottom"></td>
        <td class="column18 style26 f border-bottom"><?=(is_nan((($ridd_act_jul * 100000)/$wor_act_jul))?0:(is_infinite(($ridd_act_jul * 100000)/$wor_act_jul)?0:round(($ridd_act_jul * 100000)/$wor_act_jul,2)))?></td>
        <td class="column19 style66 border-bottom"></td>
        <td class="column20 style27 f border-bottom"><?=(is_nan((($ridd_act_aug * 100000)/$wor_act_aug))?0:(is_infinite(($ridd_act_aug * 100000)/$wor_act_aug)?0:round(($ridd_act_aug * 100000)/$wor_act_aug,2)))?></td>
        <td class="column21 style66 border-bottom"></td>
        <td class="column22 style27 f border-bottom"><?=(is_nan((($ridd_act_sep * 100000)/$wor_act_sep))?0:(is_infinite(($ridd_act_sep * 100000)/$wor_act_sep)?0:round(($ridd_act_sep * 100000)/$wor_act_sep,2)))?></td>
        <td class="column23 style37 border-bottom border-left"></td>
        <td class="column24 style29 f border-bottom border-right"><?=(is_nan((($Q3_ridd_actual * 100000)/$Q3_wor_actual))?0:(is_infinite((($Q3_ridd_actual * 100000)/$Q3_wor_actual))?0:round(($Q3_ridd_actual * 100000)/$Q3_wor_actual,2)))?></td>
        <td class="column25 style38 border-bottom"></td>
        <td class="column26 style26 f border-bottom"><?=(is_nan((($ridd_act_oct * 100000)/$wor_act_oct))?0:(is_infinite(($ridd_act_oct * 100000)/$wor_act_oct)?0:round(($ridd_act_oct * 100000)/$wor_act_oct,2)))?></td>
        <td class="column27 style66 border-bottom"></td>
        <td class="column28 style26 f border-bottom"><?=(is_nan((($ridd_act_nov * 100000)/$wor_act_nov))?0:(is_infinite(($ridd_act_nov * 100000)/$wor_act_nov)?0:round(($ridd_act_nov * 100000)/$wor_act_nov,2)))?></td>
        <td class="column29 style66 border-bottom"></td>
        <td class="column30 style27 f border-bottom"><?=(is_nan((($ridd_act_dec * 100000)/$wor_act_dec))?0:(is_infinite(($ridd_act_dec * 100000)/$wor_act_dec)?0:round(($ridd_act_dec * 100000)/$wor_act_dec,2)))?></td>
        <td class="column31 style37 border-bottom border-left"></td>
        <td class="column32 style29 f border-bottom border-right"><?=(is_nan((($Q4_ridd_actual * 100000)/$Q4_wor_actual))?0:(is_infinite((($Q4_ridd_actual * 100000)/$Q4_wor_actual))?0:round(($Q4_ridd_actual * 100000)/$Q4_wor_actual,2)))?></td>
        <td class="column33 style38 border-bottom"></td>
        <td class="column34 style26 f border-right border-bottom"><?=(is_nan(((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual)))?0:(is_infinite((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual))?0:round((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual),2)))?></td>
    </tr>
    <tr class="row24">
        <td class="column0">&nbsp;</td>
        <td class="column1">&nbsp;</td>
        <td class="column2">&nbsp;</td>
        <td class="column3">&nbsp;</td>
        <td class="column4">&nbsp;</td>
        <td class="column5">&nbsp;</td>
        <td class="column6">&nbsp;</td>
        <td class="column7">&nbsp;</td>
        <td class="column8">&nbsp;</td>
        <td class="column9">&nbsp;</td>
        <td class="column10">&nbsp;</td>
        <td class="column11">&nbsp;</td>
        <td class="column12">&nbsp;</td>
        <td class="column13">&nbsp;</td>
        <td class="column14">&nbsp;</td>
        <td class="column15">&nbsp;</td>
        <td class="column16">&nbsp;</td>
        <td class="column17">&nbsp;</td>
        <td class="column18">&nbsp;</td>
        <td class="column19">&nbsp;</td>
        <td class="column20">&nbsp;</td>
        <td class="column21">&nbsp;</td>
        <td class="column22">&nbsp;</td>
        <td class="column23">&nbsp;</td>
        <td class="column24">&nbsp;</td>
        <td class="column25">&nbsp;</td>
        <td class="column26">&nbsp;</td>
        <td class="column27">&nbsp;</td>
        <td class="column28">&nbsp;</td>
        <td class="column29">&nbsp;</td>
        <td class="column30">&nbsp;</td>
        <td class="column31">&nbsp;</td>
        <td class="column32">&nbsp;</td>
        <td class="column33">&nbsp;</td>
        <td class="column34">&nbsp;</td>
    </tr>
    <tr class="row25">
        <td class="column0 style70 s style70" rowspan="3">Leading Indicators</td>
        <td class="column1 style71 s style74" colspan="8">Quarter 1</td>
        <td class="column9 style71 s style75" colspan="8">Quarter 2</td>
        <td class="column17 style71 s style75" colspan="8">Quarter 3</td>
        <td class="column25 style71 s style72" colspan="8">Quarter 4</td>
        <td class="column33 style1"></td>
        <td class="column34 style2"></td>
    </tr>
    <tr class="row26">
        <td class="column1 style67 n style67" colspan="2">Jan-<?=$filterData['year']?></td>
        <td class="column3 style67 n style67" colspan="2">Feb-<?=$filterData['year']?></td>
        <td class="column5 style67 n style76" colspan="2">Mar-<?=$filterData['year']?></td>
        <td class="column7 style3 s">Q1</td>
        <td class="column8 style4 s">Q1</td>
        <td class="column9 style69 n style67" colspan="2">Apr-<?=$filterData['year']?></td>
        <td class="column11 style67 n style67" colspan="2">May-<?=$filterData['year']?></td>
        <td class="column13 style67 n style67" colspan="2">Jun-<?=$filterData['year']?></td>
        <td class="column15 style4 s">Q2</td>
        <td class="column16 style4 s">Q2</td>
        <td class="column17 style67 n style67" colspan="2">Jul-<?=$filterData['year']?></td>
        <td class="column19 style67 n style67" colspan="2">Aug-<?=$filterData['year']?></td>
        <td class="column21 style67 n style67" colspan="2">Sep-<?=$filterData['year']?></td>
        <td class="column23 style4 s">Q3</td>
        <td class="column24 style4 s">Q3</td>
        <td class="column25 style67 n style67" colspan="2">Oct-<?=$filterData['year']?></td>
        <td class="column27 style67 n style67" colspan="2">Nov-<?=$filterData['year']?></td>
        <td class="column29 style67 n style67" colspan="2">Dec-<?=$filterData['year']?></td>
        <td class="column31 style4 s">Q4</td>
        <td class="column32 style4 s">Q4</td>
        <td class="column33 style68 s style68" colspan="2">YTD</td>
    </tr>
    <tr class="row27">
        <td class="column1 style6 s">Target</td>
        <td class="column2 style6 s">Actual</td>
        <td class="column3 style6 s">Target</td>
        <td class="column4 style6 s">Actual</td>
        <td class="column5 style6 s">Target</td>
        <td class="column6 style1 s">Actual</td>
        <td class="column7 style7 s">Target</td>
        <td class="column8 style5 s">Actual</td>
        <td class="column9 style2 s">Target</td>
        <td class="column10 style6 s">Actual</td>
        <td class="column11 style6 s">Target</td>
        <td class="column12 style6 s">Actual</td>
        <td class="column13 style6 s">Target</td>
        <td class="column14 style6 s">Actual</td>
        <td class="column15 style7 s">Target</td>
        <td class="column16 style5 s">Actual</td>
        <td class="column17 style6 s">Target</td>
        <td class="column18 style6 s">Actual</td>
        <td class="column19 style6 s">Target</td>
        <td class="column20 style6 s">Actual</td>
        <td class="column21 style6 s">Target</td>
        <td class="column22 style6 s">Actual</td>
        <td class="column23 style7 s">Target</td>
        <td class="column24 style5 s">Actual</td>
        <td class="column25 style6 s">Target</td>
        <td class="column26 style6 s">Actual</td>
        <td class="column27 style6 s">Target</td>
        <td class="column28 style6 s">Actual</td>
        <td class="column29 style6 s">Target</td>
        <td class="column30 style6 s">Actual</td>
        <td class="column31 style7 s">Target</td>
        <td class="column32 style5 s">Actual</td>
        <td class="column33 style6 s">Target</td>
        <td class="column34 style6 s">Actual</td>
    </tr>
    <tr class="row28">
        <td class="column0 style8 s">Toolbox Talks</td>
        <td class="column1 style9"></td>
        <td class="column2 style9"></td>
        <td class="column3 style9"></td>
        <td class="column4 style9"></td>
        <td class="column5 style9"></td>
        <td class="column6 style9"></td>
        <td class="column7 style9"></td>
        <td class="column8 style9"></td>
        <td class="column9 style9"></td>
        <td class="column10 style9"></td>
        <td class="column11 style9"></td>
        <td class="column12 style9"></td>
        <td class="column13 style9"></td>
        <td class="column14 style9"></td>
        <td class="column15 style9"></td>
        <td class="column16 style9"></td>
        <td class="column17 style9"></td>
        <td class="column18 style9"></td>
        <td class="column19 style9"></td>
        <td class="column20 style9"></td>
        <td class="column21 style9"></td>
        <td class="column22 style9"></td>
        <td class="column23 style9"></td>
        <td class="column24 style9"></td>
        <td class="column25 style9"></td>
        <td class="column26 style9"></td>
        <td class="column27 style9"></td>
        <td class="column28 style9"></td>
        <td class="column29 style9"></td>
        <td class="column30 style9"></td>
        <td class="column31 style9"></td>
        <td class="column32 style9"></td>
        <td class="column33 style9"></td>
        <td class="column34 style9"></td>
    </tr>
    <tr class="row29">
        <td class="column0 style89 s border-left border-top border-bottom">Toolbox Talks / Safety Briefings delivered</td>
        <td class="column1 style55 n border-top border-bottom"><?=$tosa_tar_jan?></td>
        <td class="column2 style54 n border-top border-bottom <?=$tosa_act_jan_cell_color?>"><?=$tosa_act_jan?></td>
        <td class="column3 style55 n border-top border-bottom"><?=$tosa_tar_feb?></td>
        <td class="column4 style54 n border-top border-bottom <?=$tosa_act_feb_cell_color?>"><?=$tosa_act_feb?></td>
        <td class="column5 style55 n border-top border-bottom"><?=$tosa_tar_mar?></td>
        <td class="column6 style53 n border-top border-bottom <?=$tosa_act_mar_cell_color?>"><?=$tosa_act_mar?></td>
        <td class="column7 style39 n border-top border-bottom border-left"><?=$Q1_tosa_target?></td>
        <td class="column8 style40 n border-top border-bottom border-right <?=$Q1_tosa_actual_cell_color?>"><?=$Q1_tosa_actual?></td>
        <td class="column9 style52 n border-top border-bottom"><?=$tosa_tar_apr?></td>
        <td class="column10 style54 n border-top border-bottom <?=$tosa_act_apr_cell_color?>"><?=$tosa_act_apr?></td>
        <td class="column11 style55 n border-top border-bottom"><?=$tosa_tar_may?></td>
        <td class="column12 style54 n border-top border-bottom <?=$tosa_act_may_cell_color?>"><?=$tosa_act_may?></td>
        <td class="column13 style55 n border-top border-bottom"><?=$tosa_tar_jun?></td>
        <td class="column14 style53 n border-top border-bottom <?=$tosa_act_jun_cell_color?>"><?=$tosa_act_jun?></td>
        <td class="column15 style39 n border-top border-bottom border-left"><?=$Q2_tosa_target?></td>
        <td class="column16 style40 n border-top border-bottom border-right <?=$Q2_tosa_actual_cell_color?>"><?=$Q2_tosa_actual?></td>
        <td class="column17 style52 n border-top border-bottom"><?=$tosa_tar_jul?></td>
        <td class="column18 style53 n border-top border-bottom <?=$tosa_act_jul_cell_color?>"><?=$tosa_act_jul?></td>
        <td class="column19 style55 n border-top border-bottom"><?=$tosa_tar_aug?></td>
        <td class="column20 style54 n border-top border-bottom <?=$tosa_act_aug_cell_color?>"><?=$tosa_act_aug?></td>
        <td class="column21 style55 n border-top border-bottom"><?=$tosa_tar_sep?></td>
        <td class="column22 style53 n border-top border-bottom <?=$tosa_act_sep_cell_color?>"><?=$tosa_act_sep?></td>
        <td class="column23 style39 n border-top border-bottom border-left"><?=$Q3_tosa_target?></td>
        <td class="column24 style40 n border-top border-bottom border-right <?=$Q3_tosa_actual_cell_color?>"><?=$Q3_tosa_actual?></td>
        <td class="column25 style52 n border-top border-bottom"><?=$tosa_tar_oct?></td>
        <td class="column26 style54 n border-top border-bottom <?=$tosa_act_oct_cell_color?>"><?=$tosa_act_oct?></td>
        <td class="column27 style55 n border-top border-bottom"><?=$tosa_tar_nov?></td>
        <td class="column28 style54 n border-top border-bottom <?=$tosa_act_nov_cell_color?>"><?=$tosa_act_nov?></td>
        <td class="column29 style55 n border-top border-bottom"><?=$tosa_tar_dec?></td>
        <td class="column30 style53 n border-top border-bottom <?=$tosa_act_dec_cell_color?>"><?=$tosa_act_dec?></td>
        <td class="column31 style39 n border-top border-bottom border-left"><?=$Q4_tosa_target?></td>
        <td class="column32 style40 n border-top border-bottom border-right <?=$Q4_tosa_actual_cell_color?>"><?=$Q4_tosa_actual?></td>
        <td class="column33 style52 n border-top border-bottom"><?=($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)?></td>
        <td class="column34 style54 n border-right border-top border-bottom <?=$YTD_tosa_actual_cell_color?>"><?=($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)?></td>
    </tr>
    <tr class="row30">
        <td class="column0 style8 s">Site Audits</td>
        <td class="column1 style9"></td>
        <td class="column2 style9"></td>
        <td class="column3 style9"></td>
        <td class="column4 style9"></td>
        <td class="column5 style9"></td>
        <td class="column6 style9"></td>
        <td class="column7 style9"></td>
        <td class="column8 style9"></td>
        <td class="column9 style9"></td>
        <td class="column10 style9"></td>
        <td class="column11 style9"></td>
        <td class="column12 style9"></td>
        <td class="column13 style9"></td>
        <td class="column14 style9"></td>
        <td class="column15 style9"></td>
        <td class="column16 style9"></td>
        <td class="column17 style9"></td>
        <td class="column18 style9"></td>
        <td class="column19 style9"></td>
        <td class="column20 style9"></td>
        <td class="column21 style9"></td>
        <td class="column22 style9"></td>
        <td class="column23 style9"></td>
        <td class="column24 style9"></td>
        <td class="column25 style9"></td>
        <td class="column26 style9"></td>
        <td class="column27 style9"></td>
        <td class="column28 style9"></td>
        <td class="column29 style9"></td>
        <td class="column30 style9"></td>
        <td class="column31 style9"></td>
        <td class="column32 style9"></td>
        <td class="column33 style9"></td>
        <td class="column34 style9"></td>
    </tr>
    <tr class="row31">
        <td class="column0 style1 s border-left border-top">No of Site Audits</td>
        <td class="column1 style10 n border-top"><?=$siau_tar_jan?></td>
        <td class="column2 style12 n border-top <?=$numa_act_jan_cell_color?>"><?=$numa_act_jan?></td>
        <td class="column3 style10 n border-top"><?=$siau_tar_feb?></td>
        <td class="column4 style12 n border-top <?=$numa_act_feb_cell_color?>"><?=$numa_act_feb?></td>
        <td class="column5 style10 n border-top"><?=$siau_tar_mar?></td>
        <td class="column6 style11 n border-top <?=$numa_act_mar_cell_color?>"><?=$numa_act_mar?></td>
        <td class="column7 style13 n border-top border-left"><?=$Q1_siau_target?></td>
        <td class="column8 style14 n border-top border-right <?=$Q1_numa_actual_cell_color?>"><?=$Q1_numa_actual?></td>
        <td class="column9 style15 n border-top"><?=$siau_tar_apr?></td>
        <td class="column10 style12 n border-top <?=$numa_act_apr_cell_color?>"><?=$numa_act_apr?></td>
        <td class="column11 style10 n border-top"><?=$siau_tar_may?></td>
        <td class="column12 style12 n border-top <?=$numa_act_may_cell_color?>"><?=$numa_act_may?></td>
        <td class="column13 style10 n border-top"><?=$siau_tar_jun?></td>
        <td class="column14 style11 n border-top <?=$numa_act_jun_cell_color?>"><?=$numa_act_jun?></td>
        <td class="column15 style13 n border-top border-left"><?=$Q2_siau_target?></td>
        <td class="column16 style14 n border-top border-right <?=$Q2_numa_actual_cell_color?>"><?=$Q2_numa_actual?></td>
        <td class="column17 style15 n border-top"><?=$siau_tar_jul?></td>
        <td class="column18 style11 n border-top <?=$numa_act_jul_cell_color?>"><?=$numa_act_jul?></td>
        <td class="column19 style10 n border-top"><?=$siau_tar_aug?></td>
        <td class="column20 style12 n border-top <?=$numa_act_aug_cell_color?>"><?=$numa_act_aug?></td>
        <td class="column21 style10 n border-top"><?=$siau_tar_sep?></td>
        <td class="column22 style11 n border-top <?=$numa_act_sep_cell_color?>"><?=$numa_act_sep?></td>
        <td class="column23 style13 n border-top border-left"><?=$Q3_siau_target?></td>
        <td class="column24 style14 n border-top border-right <?=$Q3_numa_actual_cell_color?>"><?=$Q3_numa_actual?></td>
        <td class="column25 style15 n border-top"><?=$siau_tar_oct?></td>
        <td class="column26 style12 n border-top <?=$numa_act_oct_cell_color?>"><?=$numa_act_oct?></td>
        <td class="column27 style10 n border-top"><?=$siau_tar_nov?></td>
        <td class="column28 style12 n border-top <?=$numa_act_nov_cell_color?>"><?=$numa_act_nov?></td>
        <td class="column29 style10 n border-top"><?=$siau_tar_dec?></td>
        <td class="column30 style11 n border-top <?=$numa_act_dec_cell_color?>"><?=$numa_act_dec?></td>
        <td class="column31 style13 n border-top border-left"><?=$Q4_siau_target?></td>
        <td class="column32 style14 n border-top border-right <?=$Q4_numa_actual_cell_color?>"><?=$Q4_numa_actual?></td>
        <td class="column33 style15 n border-top"><?=($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)?></td>
        <td class="column34 style12 n border-right border-top <?=$YTD_numa_actual_cell_color?>"><?=($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)?></td>
    </tr>
    <tr class="row32">
        <td class="column0 style89 s border-left">Audit Recommendations</td>
        <td class="column1 style64"></td>
        <td class="column2 style18 n"><?=$audr_act_jan?></td>
        <td class="column3 style64"></td>
        <td class="column4 style18 n"><?=$audr_act_feb?></td>
        <td class="column5 style64"></td>
        <td class="column6 style17 n"><?=$audr_act_mar?></td>
        <td class="column7 style34 border-left"></td>
        <td class="column8 style20 n border-right"><?=$Q1_audr_actual?></td>
        <td class="column9 style36"></td>
        <td class="column10 style18 n"><?=$audr_act_apr?></td>
        <td class="column11 style64"></td>
        <td class="column12 style18 n"><?=$audr_act_may?></td>
        <td class="column13 style64"></td>
        <td class="column14 style17 n"><?=$audr_act_jun?></td>
        <td class="column15 style34 border-left"></td>
        <td class="column16 style20 n border-right"><?=$Q2_audr_actual?></td>
        <td class="column17 style36"></td>
        <td class="column18 style17 n"><?=$audr_act_jul?></td>
        <td class="column19 style64"></td>
        <td class="column20 style18 n"><?=$audr_act_aug?></td>
        <td class="column21 style64"></td>
        <td class="column22 style17 n"><?=$audr_act_sep?></td>
        <td class="column23 style34 border-left"></td>
        <td class="column24 style20 n border-right"><?=$Q3_audr_actual?></td>
        <td class="column25 style34"></td>
        <td class="column26 style18 n"><?=$audr_act_oct?></td>
        <td class="column27 style34"></td>
        <td class="column28 style18 n"><?=$audr_act_nov?></td>
        <td class="column29 style34"></td>
        <td class="column30 style17 n"><?=$audr_act_dec?></td>
        <td class="column31 style34 border-left"></td>
        <td class="column32 style20 n border-right"><?=$Q4_audr_actual?></td>
        <td class="column33 style36"></td>
        <td class="column34 style18 n border-right"><?=($Q1_audr_actual+$Q2_audr_actual+$Q3_audr_actual+$Q4_audr_actual)?></td>
    </tr>
    <tr class="row33">
        <td class="column0 style89 s border-left border-bottom">Outstanding Recommendations</td>
        <td class="column1 style66 border-bottom"></td>
        <td class="column2 style26 n border-bottom"><?=$outr_act_jan?></td>
        <td class="column3 style66 border-bottom"></td>
        <td class="column4 style26 n border-bottom"><?=$outr_act_feb?></td>
        <td class="column5 style66 border-bottom"></td>
        <td class="column6 style27 n border-bottom"><?=$outr_act_mar?></td>
        <td class="column7 style37 border-bottom border-left"></td>
        <td class="column8 style29 n border-bottom border-right"><?=$Q1_outr_actual?></td>
        <td class="column9 style38 border-bottom"></td>
        <td class="column10 style26 n border-bottom"><?=$outr_act_apr?></td>
        <td class="column11 style66 border-bottom"></td>
        <td class="column12 style26 n border-bottom"><?=$outr_act_may?></td>
        <td class="column13 style66 border-bottom"></td>
        <td class="column14 style27 n border-bottom"><?=$outr_act_jun?></td>
        <td class="column15 style37 border-bottom border-left"></td>
        <td class="column16 style29 n border-bottom border-right"><?=$Q2_outr_actual?></td>
        <td class="column17 style38 border-bottom"></td>
        <td class="column18 style27 n border-bottom"><?=$outr_act_jul?></td>
        <td class="column19 style66 border-bottom"></td>
        <td class="column20 style26 n border-bottom"><?=$outr_act_aug?></td>
        <td class="column21 style66 border-bottom"></td>
        <td class="column22 style27 n border-bottom"><?=$outr_act_sep?></td>
        <td class="column23 style66 border-bottom border-left"></td>
        <td class="column24 style29 n border-bottom border-right"><?=$Q3_outr_actual?></td>
        <td class="column25 style34 border-bottom"></td>
        <td class="column26 style26 n border-bottom"><?=$outr_act_oct?></td>
        <td class="column27 style36 border-bottom"></td>
        <td class="column28 style26 n border-bottom"><?=$outr_act_nov?></td>
        <td class="column29 style36 border-bottom"></td>
        <td class="column30 style27 n border-bottom"><?=$outr_act_dec?></td>
        <td class="column31 style37 border-bottom border-left"></td>
        <td class="column32 style29 n border-bottom border-right"><?=$Q4_outr_actual?></td>
        <td class="column33 style38 border-bottom"></td>
        <td class="column34 style26 n border-right border-bottom"><?=($Q1_outr_actual+$Q2_outr_actual+$Q3_outr_actual+$Q4_outr_actual)?></td>
    </tr>
</table>
<?php
echo html_writer:: end_tag('div');
require_once('calm_scorecard_total_pdf_data.php');
?>
