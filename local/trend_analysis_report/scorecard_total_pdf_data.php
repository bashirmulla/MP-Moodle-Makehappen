<?php

// green 9fe8b6 amber #FFBF00 red c75151
$Q1_fat_actual_cell_color = $Q2_fat_actual_cell_color = $Q3_fat_actual_cell_color = $Q4_fat_actual_cell_color = $YTD_fat_actual_cell_color = '';
$fat_act_jan_cell_color = $fat_act_feb_cell_color = $fat_act_mar_cell_color = $fat_act_apr_cell_color = $fat_act_may_cell_color = $fat_act_jun_cell_color = $fat_act_jul_cell_color = $fat_act_aug_cell_color = $fat_act_sep_cell_color = $fat_act_oct_cell_color = $fat_act_nov_cell_color = $fat_act_dec_cell_color = '';
if ($fat_act_jan>$fat_tar_jan) $fat_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_jan==0) $fat_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_jan==$fat_tar_jan) $fat_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_jan<$fat_tar_jan) $fat_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_feb>$fat_tar_feb) $fat_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_feb==0) $fat_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_feb==$fat_tar_feb) $fat_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_feb<$fat_tar_feb) $fat_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_mar>$fat_tar_mar) $fat_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_mar==0) $fat_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_mar==$fat_tar_mar) $fat_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_mar<$fat_tar_mar) $fat_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_fat_actual>$Q1_fat_target) $Q1_fat_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_fat_actual==0) $Q1_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_fat_actual==$Q1_fat_target) $Q1_fat_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_fat_actual<$Q1_fat_target) $Q1_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_apr>$fat_tar_apr) $fat_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_apr==0) $fat_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_apr==$fat_tar_apr) $fat_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_apr<$fat_tar_apr) $fat_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_may>$fat_tar_may) $fat_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_may==0) $fat_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_may==$fat_tar_may) $fat_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_may<$fat_tar_may) $fat_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_jun>$fat_tar_jun) $fat_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_jun==0) $fat_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_jun==$fat_tar_jun) $fat_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_jun<$fat_tar_jun) $fat_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_fat_actual>$Q2_fat_target) $Q2_fat_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_fat_actual==0) $Q2_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_fat_actual==$Q2_fat_target) $Q2_fat_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_fat_actual<$Q2_fat_target) $Q2_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_jul>$fat_tar_jul) $fat_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_jul==0) $fat_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_jul==$fat_tar_jul) $fat_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_jul<$fat_tar_jul) $fat_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_aug>$fat_tar_aug) $fat_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_aug==0) $fat_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_aug==$fat_tar_aug) $fat_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_aug<$fat_tar_aug) $fat_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_sep>$fat_tar_sep) $fat_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_sep==0) $fat_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_sep==$fat_tar_sep) $fat_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_sep<$fat_tar_sep) $fat_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_fat_actual>$Q3_fat_target) $Q3_fat_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_fat_actual==0) $Q3_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_fat_actual==$Q3_fat_target) $Q3_fat_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_fat_actual<$Q3_fat_target) $Q3_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_oct>$fat_tar_oct) $fat_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_oct==0) $fat_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_oct==$fat_tar_oct) $fat_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_oct<$fat_tar_oct) $fat_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_nov>$fat_tar_nov) $fat_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_nov==0) $fat_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_nov==$fat_tar_nov) $fat_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_nov<$fat_tar_nov) $fat_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($fat_act_dec>$fat_tar_dec) $fat_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($fat_act_dec==0) $fat_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($fat_act_dec==$fat_tar_dec) $fat_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($fat_act_dec<$fat_tar_dec) $fat_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_fat_actual>$Q4_fat_target) $Q4_fat_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_fat_actual==0) $Q4_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_fat_actual==$Q4_fat_target) $Q4_fat_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_fat_actual<$Q4_fat_target) $Q4_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)>($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)==0) $YTD_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)==($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)<($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)) $YTD_fat_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_spe_actual_cell_color = $Q2_spe_actual_cell_color = $Q3_spe_actual_cell_color = $Q4_spe_actual_cell_color = $YTD_spe_actual_cell_color = '';
$spe_act_jan_cell_color = $spe_act_feb_cell_color = $spe_act_mar_cell_color = $spe_act_apr_cell_color = $spe_act_may_cell_color = $spe_act_jun_cell_color = $spe_act_jul_cell_color = $spe_act_aug_cell_color = $spe_act_sep_cell_color = $spe_act_oct_cell_color = $spe_act_nov_cell_color = $spe_act_dec_cell_color = '';
if ($spe_act_jan>$spe_tar_jan) $spe_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_jan==0) $spe_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_jan==$spe_tar_jan) $spe_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_jan<$spe_tar_jan) $spe_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_feb>$spe_tar_feb) $spe_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_feb==0) $spe_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_feb==$spe_tar_feb) $spe_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_feb<$spe_tar_feb) $spe_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_mar>$spe_tar_mar) $spe_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_mar==0) $spe_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_mar==$spe_tar_mar) $spe_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_mar<$spe_tar_mar) $spe_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_spe_actual>$Q1_spe_target) $Q1_spe_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_spe_actual==0) $Q1_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_spe_actual==$Q1_spe_target) $Q1_spe_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_spe_actual<$Q1_spe_target) $Q1_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_apr>$spe_tar_apr) $spe_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_apr==0) $spe_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_apr==$spe_tar_apr) $spe_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_apr<$spe_tar_apr) $spe_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_may>$spe_tar_may) $spe_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_may==0) $spe_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_may==$spe_tar_may) $spe_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_may<$spe_tar_may) $spe_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_jun>$spe_tar_jun) $spe_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_jun==0) $spe_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_jun==$spe_tar_jun) $spe_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_jun<$spe_tar_jun) $spe_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_spe_actual>$Q2_spe_target) $Q2_spe_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_spe_actual==0) $Q2_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_spe_actual==$Q2_spe_target) $Q2_spe_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_spe_actual<$Q2_spe_target) $Q2_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_jul>$spe_tar_jul) $spe_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_jul==0) $spe_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_jul==$spe_tar_jul) $spe_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_jul<$spe_tar_jul) $spe_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_aug>$spe_tar_aug) $spe_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_aug==0) $spe_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_aug==$spe_tar_aug) $spe_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_aug<$spe_tar_aug) $spe_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_sep>$spe_tar_sep) $spe_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_sep==0) $spe_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_sep==$spe_tar_sep) $spe_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_sep<$spe_tar_sep) $spe_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_spe_actual>$Q3_spe_target) $Q3_spe_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_spe_actual==0) $Q3_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_spe_actual==$Q3_spe_target) $Q3_spe_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_spe_actual<$Q3_spe_target) $Q3_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_oct>$spe_tar_oct) $spe_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_oct==0) $spe_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_oct==$spe_tar_oct) $spe_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_oct<$spe_tar_oct) $spe_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_nov>$spe_tar_nov) $spe_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_nov==0) $spe_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_nov==$spe_tar_nov) $spe_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_nov<$spe_tar_nov) $spe_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($spe_act_dec>$spe_tar_dec) $spe_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($spe_act_dec==0) $spe_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($spe_act_dec==$spe_tar_dec) $spe_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($spe_act_dec<$spe_tar_dec) $spe_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_spe_actual>$Q4_spe_target) $Q4_spe_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_spe_actual==0) $Q4_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_spe_actual==$Q4_spe_target) $Q4_spe_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_spe_actual<$Q4_spe_target) $Q4_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)>($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)==0) $YTD_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)==($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)<($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)) $YTD_spe_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_7day_actual_cell_color = $Q2_7day_actual_cell_color = $Q3_7day_actual_cell_color = $Q4_7day_actual_cell_color = $YTD_7day_actual_cell_color = '';
$day7_act_jan_cell_color = $day7_act_feb_cell_color = $day7_act_mar_cell_color = $day7_act_apr_cell_color = $day7_act_may_cell_color = $day7_act_jun_cell_color = $day7_act_jul_cell_color = $day7_act_aug_cell_color = $day7_act_sep_cell_color = $day7_act_oct_cell_color = $day7_act_nov_cell_color = $day7_act_dec_cell_color = '';
if ($day7_act_jan>$day7_tar_jan) $day7_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_jan==0) $day7_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_jan==$day7_tar_jan) $day7_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_jan<$day7_tar_jan) $day7_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_feb>$day7_tar_feb) $day7_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_feb==0) $day7_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_feb==$day7_tar_feb) $day7_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_feb<$day7_tar_feb) $day7_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_mar>$day7_tar_mar) $day7_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_mar==0) $day7_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_mar==$day7_tar_mar) $day7_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_mar<$day7_tar_mar) $day7_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_7day_actual>$Q1_7day_target) $Q1_7day_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_7day_actual==0) $Q1_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_7day_actual==$Q1_7day_target) $Q1_7day_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_7day_actual<$Q1_7day_target) $Q1_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_apr>$day7_tar_apr) $day7_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_apr==0) $day7_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_apr==$day7_tar_apr) $day7_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_apr<$day7_tar_apr) $day7_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_may>$day7_tar_may) $day7_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_may==0) $day7_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_may==$day7_tar_may) $day7_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_may<$day7_tar_may) $day7_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_jun>$day7_tar_jun) $day7_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_jun==0) $day7_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_jun==$day7_tar_jun) $day7_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_jun<$day7_tar_jun) $day7_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_7day_actual>$Q2_7day_target) $Q2_7day_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_7day_actual==0) $Q2_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_7day_actual==$Q2_7day_target) $Q2_7day_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_7day_actual<$Q2_7day_target) $Q2_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_jul>$day7_tar_jul) $day7_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_jul==0) $day7_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_jul==$day7_tar_jul) $day7_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_jul<$day7_tar_jul) $day7_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_aug>$day7_tar_aug) $day7_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_aug==0) $day7_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_aug==$day7_tar_aug) $day7_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_aug<$day7_tar_aug) $day7_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_sep>$day7_tar_sep) $day7_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_sep==0) $day7_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_sep==$day7_tar_sep) $day7_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_sep<$day7_tar_sep) $day7_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_7day_actual>$Q3_7day_target) $Q3_7day_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_7day_actual==0) $Q3_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_7day_actual==$Q3_7day_target) $Q3_7day_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_7day_actual<$Q3_7day_target) $Q3_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_oct>$day7_tar_oct) $day7_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_oct==0) $day7_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_oct==$day7_tar_oct) $day7_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_oct<$day7_tar_oct) $day7_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_nov>$day7_tar_nov) $day7_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_nov==0) $day7_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_nov==$day7_tar_nov) $day7_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_nov<$day7_tar_nov) $day7_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($day7_act_dec>$day7_tar_dec) $day7_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($day7_act_dec==0) $day7_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($day7_act_dec==$day7_tar_dec) $day7_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($day7_act_dec<$day7_tar_dec) $day7_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_7day_actual>$Q4_7day_target) $Q4_7day_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_7day_actual==0) $Q4_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_7day_actual==$Q4_7day_target) $Q4_7day_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_7day_actual<$Q4_7day_target) $Q4_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)>($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)==0) $YTD_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)==($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)<($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)) $YTD_7day_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_occu_actual_cell_color = $Q2_occu_actual_cell_color = $Q3_occu_actual_cell_color = $Q4_occu_actual_cell_color = $YTD_occu_actual_cell_color = '';
$occu_act_jan_cell_color = $occu_act_feb_cell_color = $occu_act_mar_cell_color = $occu_act_apr_cell_color = $occu_act_may_cell_color = $occu_act_jun_cell_color = $occu_act_jul_cell_color = $occu_act_aug_cell_color = $occu_act_sep_cell_color = $occu_act_oct_cell_color = $occu_act_nov_cell_color = $occu_act_dec_cell_color = '';
if ($occu_act_jan>$occu_tar_jan) $occu_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_jan==0) $occu_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_jan==$occu_tar_jan) $occu_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_jan<$occu_tar_jan) $occu_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_feb>$occu_tar_feb) $occu_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_feb==0) $occu_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_feb==$occu_tar_feb) $occu_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_feb<$occu_tar_feb) $occu_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_mar>$occu_tar_mar) $occu_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_mar==0) $occu_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_mar==$occu_tar_mar) $occu_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_mar<$occu_tar_mar) $occu_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_occu_actual>$Q1_occu_target) $Q1_occu_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_occu_actual==0) $Q1_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_occu_actual==$Q1_occu_target) $Q1_occu_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_occu_actual<$Q1_occu_target) $Q1_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_apr>$occu_tar_apr) $occu_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_apr==0) $occu_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_apr==$occu_tar_apr) $occu_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_apr<$occu_tar_apr) $occu_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_may>$occu_tar_may) $occu_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_may==0) $occu_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_may==$occu_tar_may) $occu_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_may<$occu_tar_may) $occu_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_jun>$occu_tar_jun) $occu_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_jun==0) $occu_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_jun==$occu_tar_jun) $occu_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_jun<$occu_tar_jun) $occu_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_occu_actual>$Q2_occu_target) $Q2_occu_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_occu_actual==0) $Q2_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_occu_actual==$Q2_occu_target) $Q2_occu_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_occu_actual<$Q2_occu_target) $Q2_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_jul>$occu_tar_jul) $occu_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_jul==0) $occu_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_jul==$occu_tar_jul) $occu_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_jul<$occu_tar_jul) $occu_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_aug>$occu_tar_aug) $occu_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_aug==0) $occu_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_aug==$occu_tar_aug) $occu_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_aug<$occu_tar_aug) $occu_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_sep>$occu_tar_sep) $occu_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_sep==0) $occu_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_sep==$occu_tar_sep) $occu_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_sep<$occu_tar_sep) $occu_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_occu_actual>$Q3_occu_target) $Q3_occu_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_occu_actual==0) $Q3_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_occu_actual==$Q3_occu_target) $Q3_occu_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_occu_actual<$Q3_occu_target) $Q3_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_oct>$occu_tar_oct) $occu_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_oct==0) $occu_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_oct==$occu_tar_oct) $occu_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_oct<$occu_tar_oct) $occu_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_nov>$occu_tar_nov) $occu_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_nov==0) $occu_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_nov==$occu_tar_nov) $occu_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_nov<$occu_tar_nov) $occu_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($occu_act_dec>$occu_tar_dec) $occu_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($occu_act_dec==0) $occu_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($occu_act_dec==$occu_tar_dec) $occu_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($occu_act_dec<$occu_tar_dec) $occu_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_occu_actual>$Q4_occu_target) $Q4_occu_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_occu_actual==0) $Q4_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_occu_actual==$Q4_occu_target) $Q4_occu_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_occu_actual<$Q4_occu_target) $Q4_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)>($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)==0) $YTD_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)==($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)<($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)) $YTD_occu_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_dan_actual_cell_color = $Q2_dan_actual_cell_color = $Q3_dan_actual_cell_color = $Q4_dan_actual_cell_color = $YTD_dan_actual_cell_color = '';
$dan_act_jan_cell_color = $dan_act_feb_cell_color = $dan_act_mar_cell_color = $dan_act_apr_cell_color = $dan_act_may_cell_color = $dan_act_jun_cell_color = $dan_act_jul_cell_color = $dan_act_aug_cell_color = $dan_act_sep_cell_color = $dan_act_oct_cell_color = $dan_act_nov_cell_color = $dan_act_dec_cell_color = '';
if ($dan_act_jan>$dan_tar_jan) $dan_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_jan==0) $dan_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_jan==$dan_tar_jan) $dan_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_jan<$dan_tar_jan) $dan_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_feb>$dan_tar_feb) $dan_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_feb==0) $dan_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_feb==$dan_tar_feb) $dan_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_feb<$dan_tar_feb) $dan_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_mar>$dan_tar_mar) $dan_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_mar==0) $dan_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_mar==$dan_tar_mar) $dan_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_mar<$dan_tar_mar) $dan_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_dan_actual>$Q1_dan_target) $Q1_dan_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_dan_actual==0) $Q1_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_dan_actual==$Q1_dan_target) $Q1_dan_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_dan_actual<$Q1_dan_target) $Q1_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_apr>$dan_tar_apr) $dan_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_apr==0) $dan_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_apr==$dan_tar_apr) $dan_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_apr<$dan_tar_apr) $dan_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_may>$dan_tar_may) $dan_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_may==0) $dan_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_may==$dan_tar_may) $dan_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_may<$dan_tar_may) $dan_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_jun>$dan_tar_jun) $dan_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_jun==0) $dan_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_jun==$dan_tar_jun) $dan_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_jun<$dan_tar_jun) $dan_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_dan_actual>$Q2_dan_target) $Q2_dan_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_dan_actual==0) $Q2_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_dan_actual==$Q2_dan_target) $Q2_dan_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_dan_actual<$Q2_dan_target) $Q2_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_jul>$dan_tar_jul) $dan_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_jul==0) $dan_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_jul==$dan_tar_jul) $dan_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_jul<$dan_tar_jul) $dan_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_aug>$dan_tar_aug) $dan_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_aug==0) $dan_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_aug==$dan_tar_aug) $dan_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_aug<$dan_tar_aug) $dan_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_sep>$dan_tar_sep) $dan_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_sep==0) $dan_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_sep==$dan_tar_sep) $dan_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_sep<$dan_tar_sep) $dan_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_dan_actual>$Q3_dan_target) $Q3_dan_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_dan_actual==0) $Q3_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_dan_actual==$Q3_dan_target) $Q3_dan_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_dan_actual<$Q3_dan_target) $Q3_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_oct>$dan_tar_oct) $dan_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_oct==0) $dan_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_oct==$dan_tar_oct) $dan_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_oct<$dan_tar_oct) $dan_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_nov>$dan_tar_nov) $dan_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_nov==0) $dan_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_nov==$dan_tar_nov) $dan_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_nov<$dan_tar_nov) $dan_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($dan_act_dec>$dan_tar_dec) $dan_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($dan_act_dec==0) $dan_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($dan_act_dec==$dan_tar_dec) $dan_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($dan_act_dec<$dan_tar_dec) $dan_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_dan_actual>$Q4_dan_target) $Q4_dan_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_dan_actual==0) $Q4_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_dan_actual==$Q4_dan_target) $Q4_dan_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_dan_actual<$Q4_dan_target) $Q4_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)>($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)==0) $YTD_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)==($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)<($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)) $YTD_dan_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_nonf_actual_cell_color = $Q2_nonf_actual_cell_color = $Q3_nonf_actual_cell_color = $Q4_nonf_actual_cell_color = $YTD_nonf_actual_cell_color = '';
$nonf_act_jan_cell_color = $nonf_act_feb_cell_color = $nonf_act_mar_cell_color = $nonf_act_apr_cell_color = $nonf_act_may_cell_color = $nonf_act_jun_cell_color = $nonf_act_jul_cell_color = $nonf_act_aug_cell_color = $nonf_act_sep_cell_color = $nonf_act_oct_cell_color = $nonf_act_nov_cell_color = $nonf_act_dec_cell_color = '';
if ($nonf_act_jan>$nonf_tar_jan) $nonf_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_jan==0) $nonf_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_jan==$nonf_tar_jan) $nonf_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_jan<$nonf_tar_jan) $nonf_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_feb>$nonf_tar_feb) $nonf_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_feb==0) $nonf_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_feb==$nonf_tar_feb) $nonf_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_feb<$nonf_tar_feb) $nonf_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_mar>$nonf_tar_mar) $nonf_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_mar==0) $nonf_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_mar==$nonf_tar_mar) $nonf_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_mar<$nonf_tar_mar) $nonf_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_nonf_actual>$Q1_nonf_target) $Q1_nonf_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_nonf_actual==0) $Q1_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_nonf_actual==$Q1_nonf_target) $Q1_nonf_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_nonf_actual<$Q1_nonf_target) $Q1_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_apr>$nonf_tar_apr) $nonf_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_apr==0) $nonf_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_apr==$nonf_tar_apr) $nonf_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_apr<$nonf_tar_apr) $nonf_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_may>$nonf_tar_may) $nonf_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_may==0) $nonf_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_may==$nonf_tar_may) $nonf_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_may<$nonf_tar_may) $nonf_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_jun>$nonf_tar_jun) $nonf_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_jun==0) $nonf_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_jun==$nonf_tar_jun) $nonf_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_jun<$nonf_tar_jun) $nonf_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_nonf_actual>$Q2_nonf_target) $Q2_nonf_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_nonf_actual==0) $Q2_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_nonf_actual==$Q2_nonf_target) $Q2_nonf_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_nonf_actual<$Q2_nonf_target) $Q2_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_jul>$nonf_tar_jul) $nonf_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_jul==0) $nonf_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_jul==$nonf_tar_jul) $nonf_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_jul<$nonf_tar_jul) $nonf_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_aug>$nonf_tar_aug) $nonf_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_aug==0) $nonf_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_aug==$nonf_tar_aug) $nonf_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_aug<$nonf_tar_aug) $nonf_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_sep>$nonf_tar_sep) $nonf_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_sep==0) $nonf_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_sep==$nonf_tar_sep) $nonf_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_sep<$nonf_tar_sep) $nonf_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_nonf_actual>$Q3_nonf_target) $Q3_nonf_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_nonf_actual==0) $Q3_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_nonf_actual==$Q3_nonf_target) $Q3_nonf_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_nonf_actual<$Q3_nonf_target) $Q3_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_oct>$nonf_tar_oct) $nonf_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_oct==0) $nonf_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_oct==$nonf_tar_oct) $nonf_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_oct<$nonf_tar_oct) $nonf_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_nov>$nonf_tar_nov) $nonf_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_nov==0) $nonf_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_nov==$nonf_tar_nov) $nonf_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_nov<$nonf_tar_nov) $nonf_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($nonf_act_dec>$nonf_tar_dec) $nonf_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($nonf_act_dec==0) $nonf_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($nonf_act_dec==$nonf_tar_dec) $nonf_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($nonf_act_dec<$nonf_tar_dec) $nonf_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_nonf_actual>$Q4_nonf_target) $Q4_nonf_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_nonf_actual==0) $Q4_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_nonf_actual==$Q4_nonf_target) $Q4_nonf_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_nonf_actual<$Q4_nonf_target) $Q4_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)>($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)==0) $YTD_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)==($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)<($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)) $YTD_nonf_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_gas_actual_cell_color = $Q2_gas_actual_cell_color = $Q3_gas_actual_cell_color = $Q4_gas_actual_cell_color = $YTD_gas_actual_cell_color = '';
$gas_act_jan_cell_color = $gas_act_feb_cell_color = $gas_act_mar_cell_color = $gas_act_apr_cell_color = $gas_act_may_cell_color = $gas_act_jun_cell_color = $gas_act_jul_cell_color = $gas_act_aug_cell_color = $gas_act_sep_cell_color = $gas_act_oct_cell_color = $gas_act_nov_cell_color = $gas_act_dec_cell_color = '';
if ($gas_act_jan>$gas_tar_jan) $gas_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_jan==0) $gas_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_jan==$gas_tar_jan) $gas_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_jan<$gas_tar_jan) $gas_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_feb>$gas_tar_feb) $gas_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_feb==0) $gas_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_feb==$gas_tar_feb) $gas_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_feb<$gas_tar_feb) $gas_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_mar>$gas_tar_mar) $gas_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_mar==0) $gas_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_mar==$gas_tar_mar) $gas_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_mar<$gas_tar_mar) $gas_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_gas_actual>$Q1_gas_target) $Q1_gas_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_gas_actual==0) $Q1_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_gas_actual==$Q1_gas_target) $Q1_gas_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_gas_actual<$Q1_gas_target) $Q1_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_apr>$gas_tar_apr) $gas_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_apr==0) $gas_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_apr==$gas_tar_apr) $gas_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_apr<$gas_tar_apr) $gas_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_may>$gas_tar_may) $gas_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_may==0) $gas_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_may==$gas_tar_may) $gas_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_may<$gas_tar_may) $gas_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_jun>$gas_tar_jun) $gas_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_jun==0) $gas_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_jun==$gas_tar_jun) $gas_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_jun<$gas_tar_jun) $gas_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_gas_actual>$Q2_gas_target) $Q2_gas_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_gas_actual==0) $Q2_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_gas_actual==$Q2_gas_target) $Q2_gas_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_gas_actual<$Q2_gas_target) $Q2_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_jul>$gas_tar_jul) $gas_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_jul==0) $gas_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_jul==$gas_tar_jul) $gas_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_jul<$gas_tar_jul) $gas_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_aug>$gas_tar_aug) $gas_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_aug==0) $gas_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_aug==$gas_tar_aug) $gas_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_aug<$gas_tar_aug) $gas_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_sep>$gas_tar_sep) $gas_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_sep==0) $gas_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_sep==$gas_tar_sep) $gas_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_sep<$gas_tar_sep) $gas_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_gas_actual>$Q3_gas_target) $Q3_gas_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_gas_actual==0) $Q3_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_gas_actual==$Q3_gas_target) $Q3_gas_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_gas_actual<$Q3_gas_target) $Q3_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_oct>$gas_tar_oct) $gas_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_oct==0) $gas_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_oct==$gas_tar_oct) $gas_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_oct<$gas_tar_oct) $gas_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_nov>$gas_tar_nov) $gas_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_nov==0) $gas_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_nov==$gas_tar_nov) $gas_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_nov<$gas_tar_nov) $gas_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($gas_act_dec>$gas_tar_dec) $gas_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($gas_act_dec==0) $gas_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($gas_act_dec==$gas_tar_dec) $gas_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($gas_act_dec<$gas_tar_dec) $gas_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_gas_actual>$Q4_gas_target) $Q4_gas_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_gas_actual==0) $Q4_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_gas_actual==$Q4_gas_target) $Q4_gas_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_gas_actual<$Q4_gas_target) $Q4_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)>($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)==0) $YTD_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)==($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)<($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)) $YTD_gas_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_ridd_actual_cell_color = $Q2_ridd_actual_cell_color = $Q3_ridd_actual_cell_color = $Q4_ridd_actual_cell_color = $YTD_ridd_actual_cell_color = '';
$ridd_act_jan_cell_color = $ridd_act_feb_cell_color = $ridd_act_mar_cell_color = $ridd_act_apr_cell_color = $ridd_act_may_cell_color = $ridd_act_jun_cell_color = $ridd_act_jul_cell_color = $ridd_act_aug_cell_color = $ridd_act_sep_cell_color = $ridd_act_oct_cell_color = $ridd_act_nov_cell_color = $ridd_act_dec_cell_color = '';
if ($ridd_act_jan>$ridd_tar_jan) $ridd_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_jan==0) $ridd_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_jan==$ridd_tar_jan) $ridd_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_jan<$ridd_tar_jan) $ridd_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_feb>$ridd_tar_feb) $ridd_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_feb==0) $ridd_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_feb==$ridd_tar_feb) $ridd_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_feb<$ridd_tar_feb) $ridd_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_mar>$ridd_tar_mar) $ridd_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_mar==0) $ridd_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_mar==$ridd_tar_mar) $ridd_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_mar<$ridd_tar_mar) $ridd_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_ridd_actual>$Q1_ridd_target) $Q1_ridd_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_ridd_actual==0) $Q1_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_ridd_actual==$Q1_ridd_target) $Q1_ridd_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_ridd_actual<$Q1_ridd_target) $Q1_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_apr>$ridd_tar_apr) $ridd_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_apr==0) $ridd_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_apr==$ridd_tar_apr) $ridd_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_apr<$ridd_tar_apr) $ridd_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_may>$ridd_tar_may) $ridd_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_may==0) $ridd_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_may==$ridd_tar_may) $ridd_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_may<$ridd_tar_may) $ridd_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_jun>$ridd_tar_jun) $ridd_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_jun==0) $ridd_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_jun==$ridd_tar_jun) $ridd_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_jun<$ridd_tar_jun) $ridd_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_ridd_actual>$Q2_ridd_target) $Q2_ridd_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_ridd_actual==0) $Q2_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_ridd_actual==$Q2_ridd_target) $Q2_ridd_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_ridd_actual<$Q2_ridd_target) $Q2_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_jul>$ridd_tar_jul) $ridd_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_jul==0) $ridd_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_jul==$ridd_tar_jul) $ridd_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_jul<$ridd_tar_jul) $ridd_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_aug>$ridd_tar_aug) $ridd_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_aug==0) $ridd_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_aug==$ridd_tar_aug) $ridd_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_aug<$ridd_tar_aug) $ridd_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_sep>$ridd_tar_sep) $ridd_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_sep==0) $ridd_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_sep==$ridd_tar_sep) $ridd_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_sep<$ridd_tar_sep) $ridd_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_ridd_actual>$Q3_ridd_target) $Q3_ridd_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_ridd_actual==0) $Q3_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_ridd_actual==$Q3_ridd_target) $Q3_ridd_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_ridd_actual<$Q3_ridd_target) $Q3_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_oct>$ridd_tar_oct) $ridd_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_oct==0) $ridd_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_oct==$ridd_tar_oct) $ridd_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_oct<$ridd_tar_oct) $ridd_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_nov>$ridd_tar_nov) $ridd_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_nov==0) $ridd_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_nov==$ridd_tar_nov) $ridd_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_nov<$ridd_tar_nov) $ridd_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($ridd_act_dec>$ridd_tar_dec) $ridd_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($ridd_act_dec==0) $ridd_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($ridd_act_dec==$ridd_tar_dec) $ridd_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($ridd_act_dec<$ridd_tar_dec) $ridd_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_ridd_actual>$Q4_ridd_target) $Q4_ridd_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_ridd_actual==0) $Q4_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_ridd_actual==$Q4_ridd_target) $Q4_ridd_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_ridd_actual<$Q4_ridd_target) $Q4_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)>($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)==0) $YTD_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)==($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)<($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)) $YTD_ridd_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_medi_actual_cell_color = $Q2_medi_actual_cell_color = $Q3_medi_actual_cell_color = $Q4_medi_actual_cell_color = $YTD_medi_actual_cell_color = '';
$medi_act_jan_cell_color = $medi_act_feb_cell_color = $medi_act_mar_cell_color = $medi_act_apr_cell_color = $medi_act_may_cell_color = $medi_act_jun_cell_color = $medi_act_jul_cell_color = $medi_act_aug_cell_color = $medi_act_sep_cell_color = $medi_act_oct_cell_color = $medi_act_nov_cell_color = $medi_act_dec_cell_color = '';
if ($medi_act_jan>$medi_tar_jan) $medi_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_jan==0) $medi_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_jan==$medi_tar_jan) $medi_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_jan<$medi_tar_jan) $medi_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_feb>$medi_tar_feb) $medi_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_feb==0) $medi_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_feb==$medi_tar_feb) $medi_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_feb<$medi_tar_feb) $medi_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_mar>$medi_tar_mar) $medi_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_mar==0) $medi_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_mar==$medi_tar_mar) $medi_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_mar<$medi_tar_mar) $medi_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_medi_actual>$Q1_medi_target) $Q1_medi_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_medi_actual==0) $Q1_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_medi_actual==$Q1_medi_target) $Q1_medi_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_medi_actual<$Q1_medi_target) $Q1_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_apr>$medi_tar_apr) $medi_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_apr==0) $medi_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_apr==$medi_tar_apr) $medi_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_apr<$medi_tar_apr) $medi_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_may>$medi_tar_may) $medi_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_may==0) $medi_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_may==$medi_tar_may) $medi_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_may<$medi_tar_may) $medi_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_jun>$medi_tar_jun) $medi_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_jun==0) $medi_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_jun==$medi_tar_jun) $medi_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_jun<$medi_tar_jun) $medi_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_medi_actual>$Q2_medi_target) $Q2_medi_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_medi_actual==0) $Q2_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_medi_actual==$Q2_medi_target) $Q2_medi_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_medi_actual<$Q2_medi_target) $Q2_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_jul>$medi_tar_jul) $medi_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_jul==0) $medi_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_jul==$medi_tar_jul) $medi_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_jul<$medi_tar_jul) $medi_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_aug>$medi_tar_aug) $medi_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_aug==0) $medi_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_aug==$medi_tar_aug) $medi_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_aug<$medi_tar_aug) $medi_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_sep>$medi_tar_sep) $medi_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_sep==0) $medi_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_sep==$medi_tar_sep) $medi_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_sep<$medi_tar_sep) $medi_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_medi_actual>$Q3_medi_target) $Q3_medi_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_medi_actual==0) $Q3_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_medi_actual==$Q3_medi_target) $Q3_medi_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_medi_actual<$Q3_medi_target) $Q3_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_oct>$medi_tar_oct) $medi_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_oct==0) $medi_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_oct==$medi_tar_oct) $medi_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_oct<$medi_tar_oct) $medi_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_nov>$medi_tar_nov) $medi_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_nov==0) $medi_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_nov==$medi_tar_nov) $medi_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_nov<$medi_tar_nov) $medi_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($medi_act_dec>$medi_tar_dec) $medi_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($medi_act_dec==0) $medi_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($medi_act_dec==$medi_tar_dec) $medi_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($medi_act_dec<$medi_tar_dec) $medi_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_medi_actual>$Q4_medi_target) $Q4_medi_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_medi_actual==0) $Q4_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_medi_actual==$Q4_medi_target) $Q4_medi_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_medi_actual<$Q4_medi_target) $Q4_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)>($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)==0) $YTD_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)==($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)<($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)) $YTD_medi_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_mino_actual_cell_color = $Q2_mino_actual_cell_color = $Q3_mino_actual_cell_color = $Q4_mino_actual_cell_color = $YTD_mino_actual_cell_color = '';
$mino_act_jan_cell_color = $mino_act_feb_cell_color = $mino_act_mar_cell_color = $mino_act_apr_cell_color = $mino_act_may_cell_color = $mino_act_jun_cell_color = $mino_act_jul_cell_color = $mino_act_aug_cell_color = $mino_act_sep_cell_color = $mino_act_oct_cell_color = $mino_act_nov_cell_color = $mino_act_dec_cell_color = '';
if ($mino_act_jan>$mino_tar_jan) $mino_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_jan==0) $mino_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_jan==$mino_tar_jan) $mino_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_jan<$mino_tar_jan) $mino_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_feb>$mino_tar_feb) $mino_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_feb==0) $mino_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_feb==$mino_tar_feb) $mino_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_feb<$mino_tar_feb) $mino_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_mar>$mino_tar_mar) $mino_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_mar==0) $mino_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_mar==$mino_tar_mar) $mino_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_mar<$mino_tar_mar) $mino_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_mino_actual>$Q1_mino_target) $Q1_mino_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_mino_actual==0) $Q1_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_mino_actual==$Q1_mino_target) $Q1_mino_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_mino_actual<$Q1_mino_target) $Q1_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_apr>$mino_tar_apr) $mino_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_apr==0) $mino_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_apr==$mino_tar_apr) $mino_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_apr<$mino_tar_apr) $mino_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_may>$mino_tar_may) $mino_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_may==0) $mino_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_may==$mino_tar_may) $mino_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_may<$mino_tar_may) $mino_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_jun>$mino_tar_jun) $mino_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_jun==0) $mino_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_jun==$mino_tar_jun) $mino_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_jun<$mino_tar_jun) $mino_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_mino_actual>$Q2_mino_target) $Q2_mino_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_mino_actual==0) $Q2_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_mino_actual==$Q2_mino_target) $Q2_mino_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_mino_actual<$Q2_mino_target) $Q2_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_jul>$mino_tar_jul) $mino_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_jul==0) $mino_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_jul==$mino_tar_jul) $mino_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_jul<$mino_tar_jul) $mino_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_aug>$mino_tar_aug) $mino_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_aug==0) $mino_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_aug==$mino_tar_aug) $mino_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_aug<$mino_tar_aug) $mino_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_sep>$mino_tar_sep) $mino_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_sep==0) $mino_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_sep==$mino_tar_sep) $mino_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_sep<$mino_tar_sep) $mino_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_mino_actual>$Q3_mino_target) $Q3_mino_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_mino_actual==0) $Q3_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_mino_actual==$Q3_mino_target) $Q3_mino_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_mino_actual<$Q3_mino_target) $Q3_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_oct>$mino_tar_oct) $mino_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_oct==0) $mino_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_oct==$mino_tar_oct) $mino_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_oct<$mino_tar_oct) $mino_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_nov>$mino_tar_nov) $mino_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_nov==0) $mino_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_nov==$mino_tar_nov) $mino_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_nov<$mino_tar_nov) $mino_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($mino_act_dec>$mino_tar_dec) $mino_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($mino_act_dec==0) $mino_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($mino_act_dec==$mino_tar_dec) $mino_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($mino_act_dec<$mino_tar_dec) $mino_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_mino_actual>$Q4_mino_target) $Q4_mino_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_mino_actual==0) $Q4_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_mino_actual==$Q4_mino_target) $Q4_mino_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_mino_actual<$Q4_mino_target) $Q4_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)>($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)==0) $YTD_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)==($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)<($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)) $YTD_mino_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_lost_actual_cell_color = $Q2_lost_actual_cell_color = $Q3_lost_actual_cell_color = $Q4_lost_actual_cell_color = $YTD_lost_actual_cell_color = '';
$lost_act_jan_cell_color = $lost_act_feb_cell_color = $lost_act_mar_cell_color = $lost_act_apr_cell_color = $lost_act_may_cell_color = $lost_act_jun_cell_color = $lost_act_jul_cell_color = $lost_act_aug_cell_color = $lost_act_sep_cell_color = $lost_act_oct_cell_color = $lost_act_nov_cell_color = $lost_act_dec_cell_color = '';
if ($lost_act_jan>$lost_tar_jan) $lost_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_jan==0) $lost_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_jan==$lost_tar_jan) $lost_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_jan<$lost_tar_jan) $lost_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_feb>$lost_tar_feb) $lost_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_feb==0) $lost_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_feb==$lost_tar_feb) $lost_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_feb<$lost_tar_feb) $lost_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_mar>$lost_tar_mar) $lost_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_mar==0) $lost_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_mar==$lost_tar_mar) $lost_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_mar<$lost_tar_mar) $lost_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_lost_actual>$Q1_lost_target) $Q1_lost_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_lost_actual==0) $Q1_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_lost_actual==$Q1_lost_target) $Q1_lost_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_lost_actual<$Q1_lost_target) $Q1_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_apr>$lost_tar_apr) $lost_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_apr==0) $lost_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_apr==$lost_tar_apr) $lost_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_apr<$lost_tar_apr) $lost_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_may>$lost_tar_may) $lost_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_may==0) $lost_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_may==$lost_tar_may) $lost_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_may<$lost_tar_may) $lost_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_jun>$lost_tar_jun) $lost_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_jun==0) $lost_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_jun==$lost_tar_jun) $lost_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_jun<$lost_tar_jun) $lost_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_lost_actual>$Q2_lost_target) $Q2_lost_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_lost_actual==0) $Q2_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_lost_actual==$Q2_lost_target) $Q2_lost_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_lost_actual<$Q2_lost_target) $Q2_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_jul>$lost_tar_jul) $lost_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_jul==0) $lost_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_jul==$lost_tar_jul) $lost_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_jul<$lost_tar_jul) $lost_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_aug>$lost_tar_aug) $lost_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_aug==0) $lost_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_aug==$lost_tar_aug) $lost_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_aug<$lost_tar_aug) $lost_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_sep>$lost_tar_sep) $lost_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_sep==0) $lost_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_sep==$lost_tar_sep) $lost_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_sep<$lost_tar_sep) $lost_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_lost_actual>$Q3_lost_target) $Q3_lost_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_lost_actual==0) $Q3_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_lost_actual==$Q3_lost_target) $Q3_lost_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_lost_actual<$Q3_lost_target) $Q3_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_oct>$lost_tar_oct) $lost_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_oct==0) $lost_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_oct==$lost_tar_oct) $lost_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_oct<$lost_tar_oct) $lost_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_nov>$lost_tar_nov) $lost_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_nov==0) $lost_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_nov==$lost_tar_nov) $lost_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_nov<$lost_tar_nov) $lost_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($lost_act_dec>$lost_tar_dec) $lost_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($lost_act_dec==0) $lost_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($lost_act_dec==$lost_tar_dec) $lost_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($lost_act_dec<$lost_tar_dec) $lost_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_lost_actual>$Q4_lost_target) $Q4_lost_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_lost_actual==0) $Q4_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_lost_actual==$Q4_lost_target) $Q4_lost_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_lost_actual<$Q4_lost_target) $Q4_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)>($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)==0) $YTD_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)==($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)<($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)) $YTD_lost_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_inci_actual_cell_color = $Q2_inci_actual_cell_color = $Q3_inci_actual_cell_color = $Q4_inci_actual_cell_color = $YTD_inci_actual_cell_color = '';
$inci_act_jan_cell_color = $inci_act_feb_cell_color = $inci_act_mar_cell_color = $inci_act_apr_cell_color = $inci_act_may_cell_color = $inci_act_jun_cell_color = $inci_act_jul_cell_color = $inci_act_aug_cell_color = $inci_act_sep_cell_color = $inci_act_oct_cell_color = $inci_act_nov_cell_color = $inci_act_dec_cell_color = '';
if ($inci_act_jan>$inci_tar_jan) $inci_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_jan==0) $inci_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_jan==$inci_tar_jan) $inci_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_jan<$inci_tar_jan) $inci_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_feb>$inci_tar_feb) $inci_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_feb==0) $inci_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_feb==$inci_tar_feb) $inci_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_feb<$inci_tar_feb) $inci_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_mar>$inci_tar_mar) $inci_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_mar==0) $inci_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_mar==$inci_tar_mar) $inci_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_mar<$inci_tar_mar) $inci_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_inci_actual>$Q1_inci_target) $Q1_inci_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_inci_actual==0) $Q1_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q1_inci_actual==$Q1_inci_target) $Q1_inci_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_inci_actual<$Q1_inci_target) $Q1_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_apr>$inci_tar_apr) $inci_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_apr==0) $inci_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_apr==$inci_tar_apr) $inci_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_apr<$inci_tar_apr) $inci_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_may>$inci_tar_may) $inci_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_may==0) $inci_act_may_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_may==$inci_tar_may) $inci_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_may<$inci_tar_may) $inci_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_jun>$inci_tar_jun) $inci_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_jun==0) $inci_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_jun==$inci_tar_jun) $inci_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_jun<$inci_tar_jun) $inci_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_inci_actual>$Q2_inci_target) $Q2_inci_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_inci_actual==0) $Q2_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q2_inci_actual==$Q2_inci_target) $Q2_inci_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_inci_actual<$Q2_inci_target) $Q2_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_jul>$inci_tar_jul) $inci_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_jul==0) $inci_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_jul==$inci_tar_jul) $inci_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_jul<$inci_tar_jul) $inci_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_aug>$inci_tar_aug) $inci_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_aug==0) $inci_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_aug==$inci_tar_aug) $inci_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_aug<$inci_tar_aug) $inci_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_sep>$inci_tar_sep) $inci_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_sep==0) $inci_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_sep==$inci_tar_sep) $inci_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_sep<$inci_tar_sep) $inci_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_inci_actual>$Q3_inci_target) $Q3_inci_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_inci_actual==0) $Q3_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q3_inci_actual==$Q3_inci_target) $Q3_inci_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_inci_actual<$Q3_inci_target) $Q3_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_oct>$inci_tar_oct) $inci_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_oct==0) $inci_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_oct==$inci_tar_oct) $inci_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_oct<$inci_tar_oct) $inci_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_nov>$inci_tar_nov) $inci_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_nov==0) $inci_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_nov==$inci_tar_nov) $inci_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_nov<$inci_tar_nov) $inci_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($inci_act_dec>$inci_tar_dec) $inci_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($inci_act_dec==0) $inci_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($inci_act_dec==$inci_tar_dec) $inci_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($inci_act_dec<$inci_tar_dec) $inci_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_inci_actual>$Q4_inci_target) $Q4_inci_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_inci_actual==0) $Q4_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif ($Q4_inci_actual==$Q4_inci_target) $Q4_inci_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_inci_actual<$Q4_inci_target) $Q4_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)>($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)==0) $YTD_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)==($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)<($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)) $YTD_inci_actual_cell_color=' style="background-color: #9fe8b6;" ';





$Q1_haz_actual_cell_color = $Q2_haz_actual_cell_color = $Q3_haz_actual_cell_color = $Q4_haz_actual_cell_color = $YTD_haz_actual_cell_color = '';
$haz_act_jan_cell_color = $haz_act_feb_cell_color = $haz_act_mar_cell_color = $haz_act_apr_cell_color = $haz_act_may_cell_color = $haz_act_jun_cell_color = $haz_act_jul_cell_color = $haz_act_aug_cell_color = $haz_act_sep_cell_color = $haz_act_oct_cell_color = $haz_act_nov_cell_color = $haz_act_dec_cell_color = '';
if ($haz_act_jan<$haz_tar_jan) $haz_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_jan==$haz_tar_jan) $haz_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_jan>$haz_tar_jan) $haz_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_feb<$haz_tar_feb) $haz_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_feb==$haz_tar_feb) $haz_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_feb>$haz_tar_feb) $haz_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_mar<$haz_tar_mar) $haz_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_mar==$haz_tar_mar) $haz_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_mar>$haz_tar_mar) $haz_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_haz_actual<$Q1_haz_target) $Q1_haz_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_haz_actual==$Q1_haz_target) $Q1_haz_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_haz_actual>$Q1_haz_target) $Q1_haz_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_apr<$haz_tar_apr) $haz_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_apr==$haz_tar_apr) $haz_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_apr>$haz_tar_apr) $haz_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_may<$haz_tar_may) $haz_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_may==$haz_tar_may) $haz_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_may>$haz_tar_may) $haz_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_jun<$haz_tar_jun) $haz_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_jun==$haz_tar_jun) $haz_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_jun>$haz_tar_jun) $haz_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_haz_actual<$Q2_haz_target) $Q2_haz_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_haz_actual==$Q2_haz_target) $Q2_haz_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_haz_actual>$Q2_haz_target) $Q2_haz_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_jul<$haz_tar_jul) $haz_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_jul==$haz_tar_jul) $haz_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_jul>$haz_tar_jul) $haz_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_aug<$haz_tar_aug) $haz_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_aug==$haz_tar_aug) $haz_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_aug>$haz_tar_aug) $haz_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_sep<$haz_tar_sep) $haz_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_sep==$haz_tar_sep) $haz_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_sep>$haz_tar_sep) $haz_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_haz_actual<$Q3_haz_target) $Q3_haz_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_haz_actual==$Q3_haz_target) $Q3_haz_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_haz_actual>$Q3_haz_target) $Q3_haz_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_oct<$haz_tar_oct) $haz_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_oct==$haz_tar_oct) $haz_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_oct>$haz_tar_oct) $haz_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_nov<$haz_tar_nov) $haz_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_nov==$haz_tar_nov) $haz_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_nov>$haz_tar_nov) $haz_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($haz_act_dec<$haz_tar_dec) $haz_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($haz_act_dec==$haz_tar_dec) $haz_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haz_act_dec>$haz_tar_dec) $haz_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_haz_actual<$Q4_haz_target) $Q4_haz_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_haz_actual==$Q4_haz_target) $Q4_haz_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_haz_actual>$Q4_haz_target) $Q4_haz_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)<($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)==($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)>($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)) $YTD_haz_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_near_actual_cell_color = $Q2_near_actual_cell_color = $Q3_near_actual_cell_color = $Q4_near_actual_cell_color = $YTD_near_actual_cell_color = '';
$near_act_jan_cell_color = $near_act_feb_cell_color = $near_act_mar_cell_color = $near_act_apr_cell_color = $near_act_may_cell_color = $near_act_jun_cell_color = $near_act_jul_cell_color = $near_act_aug_cell_color = $near_act_sep_cell_color = $near_act_oct_cell_color = $near_act_nov_cell_color = $near_act_dec_cell_color = '';
if ($near_act_jan<$near_tar_jan) $near_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_jan==$near_tar_jan) $near_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_jan>$near_tar_jan) $near_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_feb<$near_tar_feb) $near_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_feb==$near_tar_feb) $near_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_feb>$near_tar_feb) $near_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_mar<$near_tar_mar) $near_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_mar==$near_tar_mar) $near_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_mar>$near_tar_mar) $near_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_near_actual<$Q1_near_target) $Q1_near_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_near_actual==$Q1_near_target) $Q1_near_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_near_actual>$Q1_near_target) $Q1_near_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_apr<$near_tar_apr) $near_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_apr==$near_tar_apr) $near_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_apr>$near_tar_apr) $near_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_may<$near_tar_may) $near_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_may==$near_tar_may) $near_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_may>$near_tar_may) $near_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_jun<$near_tar_jun) $near_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_jun==$near_tar_jun) $near_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_jun>$near_tar_jun) $near_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_near_actual<$Q2_near_target) $Q2_near_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_near_actual==$Q2_near_target) $Q2_near_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_near_actual>$Q2_near_target) $Q2_near_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_jul<$near_tar_jul) $near_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_jul==$near_tar_jul) $near_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_jul>$near_tar_jul) $near_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_aug<$near_tar_aug) $near_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_aug==$near_tar_aug) $near_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_aug>$near_tar_aug) $near_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_sep<$near_tar_sep) $near_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_sep==$near_tar_sep) $near_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_sep>$near_tar_sep) $near_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_near_actual<$Q3_near_target) $Q3_near_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_near_actual==$Q3_near_target) $Q3_near_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_near_actual>$Q3_near_target) $Q3_near_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_oct<$near_tar_oct) $near_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_oct==$near_tar_oct) $near_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_oct>$near_tar_oct) $near_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_nov<$near_tar_nov) $near_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_nov==$near_tar_nov) $near_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_nov>$near_tar_nov) $near_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($near_act_dec<$near_tar_dec) $near_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($near_act_dec==$near_tar_dec) $near_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($near_act_dec>$near_tar_dec) $near_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_near_actual<$Q4_near_target) $Q4_near_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_near_actual==$Q4_near_target) $Q4_near_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_near_actual>$Q4_near_target) $Q4_near_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)<($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)==($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)>($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)) $YTD_near_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_haznea_actual_cell_color = $Q2_haznea_actual_cell_color = $Q3_haznea_actual_cell_color = $Q4_haznea_actual_cell_color = $YTD_haznea_actual_cell_color = '';
$haznea_act_jan_cell_color = $haznea_act_feb_cell_color = $haznea_act_mar_cell_color = $haznea_act_apr_cell_color = $haznea_act_may_cell_color = $haznea_act_jun_cell_color = $haznea_act_jul_cell_color = $haznea_act_aug_cell_color = $haznea_act_sep_cell_color = $haznea_act_oct_cell_color = $haznea_act_nov_cell_color = $haznea_act_dec_cell_color = '';
if ($haznea_act_jan<$haznea_tar_jan) $haznea_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_jan==$haznea_tar_jan) $haznea_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_jan>$haznea_tar_jan) $haznea_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_feb<$haznea_tar_feb) $haznea_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_feb==$haznea_tar_feb) $haznea_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_feb>$haznea_tar_feb) $haznea_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_mar<$haznea_tar_mar) $haznea_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_mar==$haznea_tar_mar) $haznea_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_mar>$haznea_tar_mar) $haznea_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_haznea_actual<$Q1_haznea_target) $Q1_haznea_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_haznea_actual==$Q1_haznea_target) $Q1_haznea_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_haznea_actual>$Q1_haznea_target) $Q1_haznea_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_apr<$haznea_tar_apr) $haznea_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_apr==$haznea_tar_apr) $haznea_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_apr>$haznea_tar_apr) $haznea_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_may<$haznea_tar_may) $haznea_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_may==$haznea_tar_may) $haznea_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_may>$haznea_tar_may) $haznea_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_jun<$haznea_tar_jun) $haznea_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_jun==$haznea_tar_jun) $haznea_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_jun>$haznea_tar_jun) $haznea_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_haznea_actual<$Q2_haznea_target) $Q2_haznea_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_haznea_actual==$Q2_haznea_target) $Q2_haznea_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_haznea_actual>$Q2_haznea_target) $Q2_haznea_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_jul<$haznea_tar_jul) $haznea_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_jul==$haznea_tar_jul) $haznea_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_jul>$haznea_tar_jul) $haznea_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_aug<$haznea_tar_aug) $haznea_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_aug==$haznea_tar_aug) $haznea_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_aug>$haznea_tar_aug) $haznea_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_sep<$haznea_tar_sep) $haznea_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_sep==$haznea_tar_sep) $haznea_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_sep>$haznea_tar_sep) $haznea_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_haznea_actual<$Q3_haznea_target) $Q3_haznea_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_haznea_actual==$Q3_haznea_target) $Q3_haznea_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_haznea_actual>$Q3_haznea_target) $Q3_haznea_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_oct<$haznea_tar_oct) $haznea_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_oct==$haznea_tar_oct) $haznea_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_oct>$haznea_tar_oct) $haznea_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_nov<$haznea_tar_nov) $haznea_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_nov==$haznea_tar_nov) $haznea_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_nov>$haznea_tar_nov) $haznea_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($haznea_act_dec<$haznea_tar_dec) $haznea_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($haznea_act_dec==$haznea_tar_dec) $haznea_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($haznea_act_dec>$haznea_tar_dec) $haznea_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_haznea_actual<$Q4_haznea_target) $Q4_haznea_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_haznea_actual==$Q4_haznea_target) $Q4_haznea_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_haznea_actual>$Q4_haznea_target) $Q4_haznea_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)<($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)==($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)>($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)) $YTD_haznea_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_tosa_actual_cell_color = $Q2_tosa_actual_cell_color = $Q3_tosa_actual_cell_color = $Q4_tosa_actual_cell_color = $YTD_tosa_actual_cell_color = '';
$tosa_act_jan_cell_color = $tosa_act_feb_cell_color = $tosa_act_mar_cell_color = $tosa_act_apr_cell_color = $tosa_act_may_cell_color = $tosa_act_jun_cell_color = $tosa_act_jul_cell_color = $tosa_act_aug_cell_color = $tosa_act_sep_cell_color = $tosa_act_oct_cell_color = $tosa_act_nov_cell_color = $tosa_act_dec_cell_color = '';
if ($tosa_act_jan<$tosa_tar_jan) $tosa_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_jan==$tosa_tar_jan) $tosa_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_jan>$tosa_tar_jan) $tosa_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_feb<$tosa_tar_feb) $tosa_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_feb==$tosa_tar_feb) $tosa_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_feb>$tosa_tar_feb) $tosa_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_mar<$tosa_tar_mar) $tosa_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_mar==$tosa_tar_mar) $tosa_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_mar>$tosa_tar_mar) $tosa_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_tosa_actual<$Q1_tosa_target) $Q1_tosa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_tosa_actual==$Q1_tosa_target) $Q1_tosa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_tosa_actual>$Q1_tosa_target) $Q1_tosa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_apr<$tosa_tar_apr) $tosa_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_apr==$tosa_tar_apr) $tosa_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_apr>$tosa_tar_apr) $tosa_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_may<$tosa_tar_may) $tosa_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_may==$tosa_tar_may) $tosa_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_may>$tosa_tar_may) $tosa_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_jun<$tosa_tar_jun) $tosa_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_jun==$tosa_tar_jun) $tosa_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_jun>$tosa_tar_jun) $tosa_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_tosa_actual<$Q2_tosa_target) $Q2_tosa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_tosa_actual==$Q2_tosa_target) $Q2_tosa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_tosa_actual>$Q2_tosa_target) $Q2_tosa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_jul<$tosa_tar_jul) $tosa_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_jul==$tosa_tar_jul) $tosa_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_jul>$tosa_tar_jul) $tosa_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_aug<$tosa_tar_aug) $tosa_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_aug==$tosa_tar_aug) $tosa_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_aug>$tosa_tar_aug) $tosa_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_sep<$tosa_tar_sep) $tosa_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_sep==$tosa_tar_sep) $tosa_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_sep>$tosa_tar_sep) $tosa_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_tosa_actual<$Q3_tosa_target) $Q3_tosa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_tosa_actual==$Q3_tosa_target) $Q3_tosa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_tosa_actual>$Q3_tosa_target) $Q3_tosa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_oct<$tosa_tar_oct) $tosa_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_oct==$tosa_tar_oct) $tosa_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_oct>$tosa_tar_oct) $tosa_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_nov<$tosa_tar_nov) $tosa_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_nov==$tosa_tar_nov) $tosa_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_nov>$tosa_tar_nov) $tosa_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($tosa_act_dec<$tosa_tar_dec) $tosa_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($tosa_act_dec==$tosa_tar_dec) $tosa_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($tosa_act_dec>$tosa_tar_dec) $tosa_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_tosa_actual<$Q4_tosa_target) $Q4_tosa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_tosa_actual==$Q4_tosa_target) $Q4_tosa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_tosa_actual>$Q4_tosa_target) $Q4_tosa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)<($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)==($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)>($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)) $YTD_tosa_actual_cell_color=' style="background-color: #9fe8b6;" ';

$Q1_numa_actual_cell_color = $Q2_numa_actual_cell_color = $Q3_numa_actual_cell_color = $Q4_numa_actual_cell_color = $YTD_numa_actual_cell_color = '';
$numa_act_jan_cell_color = $numa_act_feb_cell_color = $numa_act_mar_cell_color = $numa_act_apr_cell_color = $numa_act_may_cell_color = $numa_act_jun_cell_color = $numa_act_jul_cell_color = $numa_act_aug_cell_color = $numa_act_sep_cell_color = $numa_act_oct_cell_color = $numa_act_nov_cell_color = $numa_act_dec_cell_color = '';
if ($numa_act_jan<$siau_tar_jan) $numa_act_jan_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_jan==$siau_tar_jan) $numa_act_jan_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_jan>$siau_tar_jan) $numa_act_jan_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_feb<$siau_tar_feb) $numa_act_feb_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_feb==$siau_tar_feb) $numa_act_feb_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_feb>$siau_tar_feb) $numa_act_feb_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_mar<$siau_tar_mar) $numa_act_mar_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_mar==$siau_tar_mar) $numa_act_mar_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_mar>$siau_tar_mar) $numa_act_mar_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q1_numa_actual<$Q1_siau_target) $Q1_numa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q1_numa_actual==$Q1_siau_target) $Q1_numa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q1_numa_actual>$Q1_siau_target) $Q1_numa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_apr<$siau_tar_apr) $numa_act_apr_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_apr==$siau_tar_apr) $numa_act_apr_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_apr>$siau_tar_apr) $numa_act_apr_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_may<$siau_tar_may) $numa_act_may_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_may==$siau_tar_may) $numa_act_may_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_may>$siau_tar_may) $numa_act_may_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_jun<$siau_tar_jun) $numa_act_jun_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_jun==$siau_tar_jun) $numa_act_jun_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_jun>$siau_tar_jun) $numa_act_jun_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q2_numa_actual<$Q2_siau_target) $Q2_numa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q2_numa_actual==$Q2_siau_target) $Q2_numa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q2_numa_actual>$Q2_siau_target) $Q2_numa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_jul<$siau_tar_jul) $numa_act_jul_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_jul==$siau_tar_jul) $numa_act_jul_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_jul>$siau_tar_jul) $numa_act_jul_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_aug<$siau_tar_aug) $numa_act_aug_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_aug==$siau_tar_aug) $numa_act_aug_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_aug>$siau_tar_aug) $numa_act_aug_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_sep<$siau_tar_sep) $numa_act_sep_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_sep==$siau_tar_sep) $numa_act_sep_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_sep>$siau_tar_sep) $numa_act_sep_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q3_numa_actual<$Q3_siau_target) $Q3_numa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q3_numa_actual==$Q3_siau_target) $Q3_numa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q3_numa_actual>$Q3_siau_target) $Q3_numa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_oct<$siau_tar_oct) $numa_act_oct_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_oct==$siau_tar_oct) $numa_act_oct_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_oct>$siau_tar_oct) $numa_act_oct_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_nov<$siau_tar_nov) $numa_act_nov_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_nov==$siau_tar_nov) $numa_act_nov_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_nov>$siau_tar_nov) $numa_act_nov_cell_color=' style="background-color: #9fe8b6;" ';
if ($numa_act_dec<$siau_tar_dec) $numa_act_dec_cell_color=' style="background-color: #c75151;" ';
elseif ($numa_act_dec==$siau_tar_dec) $numa_act_dec_cell_color=' style="background-color: #FFBF00;" ';
elseif ($numa_act_dec>$siau_tar_dec) $numa_act_dec_cell_color=' style="background-color: #9fe8b6;" ';
if ($Q4_numa_actual<$Q4_siau_target) $Q4_numa_actual_cell_color=' style="background-color: #c75151;" ';
elseif ($Q4_numa_actual==$Q4_siau_target) $Q4_numa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif ($Q4_numa_actual>$Q4_siau_target) $Q4_numa_actual_cell_color=' style="background-color: #9fe8b6;" ';
if (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)<($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=' style="background-color: #c75151;" ';
elseif (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)==($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=' style="background-color: #FFBF00;" ';
elseif (($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)>($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)) $YTD_numa_actual_cell_color=' style="background-color: #9fe8b6;" ';

ob_start();
?>
    <style type="text/css">
        table { border-collapse:collapse; page-break-after:always;}
        td{font-size: 9px;}
        th{font-size: 9px;}
        .b { text-align:center }
        .e { text-align:center }
        .f { text-align:right }
        .n { text-align:right }
        .s { text-align:left }
        td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style1 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style1 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style2 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style2 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style3 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style3 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style4 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style4 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style5 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style5 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style6 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style6 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style7 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style7 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:#A5A5A5 }
        th.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:#A5A5A5 }
        td.style9 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000;  background-color:#A5A5A5 }
        th.style9 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000;  background-color:#A5A5A5 }
        td.style10 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style10 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style11 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style11 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style12 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style12 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style13 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style13 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #c75151; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style14 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style14 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #c75151; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style15 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style15 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style16 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style16 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style17 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style17 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style18 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style18 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style19 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style19 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style20 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style20 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style21 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style21 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style22 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style22 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style23 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style23 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style24 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style24 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style25 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style26 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style28 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style30 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style30 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style31 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style31 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style32 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style32 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style34 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style34 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style36 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style36 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }

        td.style37 { vertical-align:middle; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:1.1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style37 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style38 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style38 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style39 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style39 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:1px solid #c75151; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style40 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style40 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:1px solid #c75151; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style27 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style27 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style29 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style29 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style52 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style52 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style53 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1.1px solid #000000; color:#000000;  background-color:white }
        th.style53 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }

        td.style41 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:1.1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style41 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style42 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style42 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style43 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style43 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style44 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style44 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style45 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style45 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:none #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style46 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style46 { vertical-align:middle; text-align:center; border-bottom:1px solid #c75151; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style47 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style47 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style48 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style48 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style49 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style49 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style50 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style50 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style51 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style51 { vertical-align:bottom; border-bottom:none #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style54 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style55 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style56 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style56 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style59 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style59 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style60 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style60 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style61 { vertical-align:middle; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style61 { vertical-align:middle; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style62 { vertical-align:middle; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style62 { vertical-align:middle; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style63 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style63 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style64 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style64 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }

        td.style93 { vertical-align:bottom; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style93 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style65 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style65 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style66 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style66 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style35 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style35 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style33 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style33 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:none #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style57 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style57 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style58 { vertical-align:middle; text-align:center; border-bottom:1.1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style58 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }

        td.style67 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style67 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style68 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style68 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style69 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style69 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style70 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style70 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style71 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style71 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style72 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style72 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style73 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style74 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style74 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style75 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style75 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:none #000000; border-right:.4px solid #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style76 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style76 { vertical-align:bottom; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style77 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style77 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style78 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style78 { vertical-align:middle; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style79 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style79 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style80 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style80 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style81 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style81 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style82 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:none #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        td.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:white }
        th.style83 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style84 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style84 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style85 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        th.style85 { vertical-align:bottom; border-bottom:1px solid #000000; border-top:none #000000; border-left:1px solid #000000; border-right:none #000000; font-weight:bold; color:#000000;  background-color:white }
        td.style86 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style86 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:none #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style87 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        th.style87 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #c75151; border-left:1px solid #c75151; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style88 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:none #000000; border-right:2px solid #000000; color:#000000;  background-color:white }
        th.style88 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #c75151; border-left:none #000000; border-right:1px solid #c75151; color:#000000;  background-color:white }
        td.style89 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1.1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style89 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        td.style90 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:.4px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        th.style90 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:.4px solid #000000; color:#000000;  background-color:#A5A5A5 }
        td.style91 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style91 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:1px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }
        td.style92 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:none #000000; color:#000000;  background-color:white }
        th.style92 { vertical-align:bottom; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:1px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }

        td.style94 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:2px solid #000000; border-left:.4px solid #000000; border-right:1.1px solid #000000; color:#000000;  background-color:white }
        td.style95 { vertical-align:middle; text-align:center; border-bottom:.4px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1.1px solid #000000; color:#000000;  background-color:white }
        td.style96 { vertical-align:middle; text-align:center; border-bottom:1px solid #000000; border-top:.4px solid #000000; border-left:.4px solid #000000; border-right:1px solid #000000; color:#000000;  background-color:white }

        td.tar-act{font-size: 7px;}

        table.sheet0 tr { height:15pt }
        table.sheet0 tr.row4 { height:15pt }
        table.sheet0 tr.row12 { height:15pt }
        table.sheet0 tr.row13 { height:30pt }
        table.sheet0 tr.row15 { height:15pt }
        table.sheet0 tr.row18 { height:14.5pt }
        table.sheet0 tr.row19 { height:15pt }
        table.sheet0 tr.row23 { height:15pt }
        table.sheet0 tr.row28 { height:15pt }
        table.sheet0 tr.row29 { height:29.5pt }
        table.sheet0 tr.row30 { height:15pt }
        table.sheet0 tr.row33 { height:15pt }
    </style>

    <table border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
        <tr class="row1">
            <td class="column0 style70 s style70" rowspan="3" style="width: 90px;">Lagging Indicators</td>
            <td class="column1 style71 s style74" colspan="8" style="width: 161px;">Quarter 1</td>
            <td class="column9 style71 s style75" colspan="8" style="width: 161px;">Quarter 2</td>
            <td class="column17 style71 s style75" colspan="8" style="width: 161px;">Quarter 3</td>
            <td class="column25 style71 s style72" colspan="8" style="width: 161px;">Quarter 4</td>
            <td class="column33 style1"></td>
            <td class="column34 style2"></td>
        </tr>
        <tr class="row2">
            <td class="column1 style67 n style67" colspan="2">Jan <br> <?=$filterData['year']?></td>
            <td class="column3 style67 n style67" colspan="2">Feb <br> <?=$filterData['year']?></td>
            <td class="column5 style67 n style76" colspan="2">Mar <br> <?=$filterData['year']?></td>
            <td class="column7 style3 s">Q1</td>
            <td class="column8 style4 s">Q1</td>
            <td class="column9 style69 n style67" colspan="2">Apr <br> <?=$filterData['year']?></td>
            <td class="column11 style67 n style67" colspan="2">May <br> <?=$filterData['year']?></td>
            <td class="column13 style67 n style67" colspan="2">Jun <br> <?=$filterData['year']?></td>
            <td class="column15 style4 s">Q2</td>
            <td class="column16 style4 s">Q2</td>
            <td class="column17 style67 n style67" colspan="2">Jul <br> <?=$filterData['year']?></td>
            <td class="column19 style67 n style67" colspan="2">Aug <br> <?=$filterData['year']?></td>
            <td class="column21 style67 n style67" colspan="2">Sep <br> <?=$filterData['year']?></td>
            <td class="column23 style4 s">Q3</td>
            <td class="column24 style4 s">Q3</td>
            <td class="column25 style67 n style67" colspan="2">Oct <br> <?=$filterData['year']?></td>
            <td class="column27 style67 n style67" colspan="2">Nov <br> <?=$filterData['year']?></td>
            <td class="column29 style67 n style67" colspan="2">Dec <br> <?=$filterData['year']?></td>
            <td class="column31 style4 s">Q4</td>
            <td class="column32 style4 s">Q4</td>
            <td class="column33 style68 s style68" colspan="2">YTD</td>
        </tr>
        <tr class="row3">
            <td class="column1 style6 s tar-act">Tar</td>
            <td class="column2 style6 s tar-act">Act</td>
            <td class="column3 style6 s tar-act">Tar</td>
            <td class="column4 style6 s tar-act">Act</td>
            <td class="column5 style6 s tar-act">Tar</td>
            <td class="column6 style1 s tar-act">Act</td>
            <td class="column7 style7 s tar-act">Tar</td>
            <td class="column8 style5 s tar-act">Act</td>
            <td class="column9 style2 s tar-act">Tar</td>
            <td class="column10 style6 s tar-act">Act</td>
            <td class="column11 style6 s tar-act">Tar</td>
            <td class="column12 style6 s tar-act">Act</td>
            <td class="column13 style6 s tar-act">Tar</td>
            <td class="column14 style6 s tar-act">Act</td>
            <td class="column15 style7 s tar-act">Tar</td>
            <td class="column16 style5 s tar-act">Act</td>
            <td class="column17 style6 s tar-act">Tar</td>
            <td class="column18 style6 s tar-act">Act</td>
            <td class="column19 style6 s tar-act">Tar</td>
            <td class="column20 style6 s tar-act">Act</td>
            <td class="column21 style6 s tar-act">Tar</td>
            <td class="column22 style6 s tar-act">Act</td>
            <td class="column23 style7 s tar-act">Tar</td>
            <td class="column24 style5 s tar-act">Act</td>
            <td class="column25 style6 s tar-act">Tar</td>
            <td class="column26 style6 s tar-act">Act</td>
            <td class="column27 style6 s tar-act">Tar</td>
            <td class="column28 style6 s tar-act">Act</td>
            <td class="column29 style6 s tar-act">Tar</td>
            <td class="column30 style6 s tar-act">Act</td>
            <td class="column31 style7 s tar-act">Tar</td>
            <td class="column32 style5 s tar-act">Act</td>
            <td class="column33 style56 s tar-act">Tar</td>
            <td class="column34 style56 s tar-act">Act</td>
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
            <td class="column0 style41 s">Fatalities</td>
            <td class="column1 style10 n"><?=$fat_tar_jan?></td>
            <td class="column2 style12 n" <?=$fat_act_jan_cell_color?>><?=$fat_act_jan?></td>
            <td class="column3 style15 n"><?=$fat_tar_feb?></td>
            <td class="column4 style12 n" <?=$fat_act_feb_cell_color?>><?=$fat_act_feb?></td>
            <td class="column5 style10 n"><?=$fat_tar_mar?></td>
            <td class="column6 style11 n" <?=$fat_act_mar_cell_color?>><?=$fat_act_mar?></td>
            <td class="column7 style13 f"><?=$Q1_fat_target?></td>
            <td class="column8 style14 f" <?=$Q1_fat_actual_cell_color?>><?=$Q1_fat_actual?></td>
            <td class="column9 style15 n"><?=$fat_tar_apr?></td>
            <td class="column10 style12 n" <?=$fat_act_apr_cell_color?>><?=$fat_act_apr?></td>
            <td class="column11 style10 n"><?=$fat_tar_may?></td>
            <td class="column12 style12 n" <?=$fat_act_may_cell_color?>><?=$fat_act_may?></td>
            <td class="column13 style10 n"><?=$fat_tar_jun?></td>
            <td class="column14 style11 n" <?=$fat_act_jun_cell_color?>><?=$fat_act_jun?></td>
            <td class="column15 style13 f"><?=$Q2_fat_target?></td>
            <td class="column16 style14 f" <?=$Q2_fat_actual_cell_color?>><?=$Q2_fat_actual?></td>
            <td class="column17 style15 n"><?=$fat_tar_jul?></td>
            <td class="column18 style12 n" <?=$fat_act_jul_cell_color?>><?=$fat_act_jul?></td>
            <td class="column19 style10 n"><?=$fat_tar_aug?></td>
            <td class="column20 style12 n" <?=$fat_act_aug_cell_color?>><?=$fat_act_aug?></td>
            <td class="column21 style10 n"><?=$fat_tar_sep?></td>
            <td class="column22 style11 n" <?=$fat_act_sep_cell_color?>><?=$fat_act_sep?></td>
            <td class="column23 style13 f"><?=$Q3_fat_target?></td>
            <td class="column24 style14 f" <?=$Q3_fat_actual_cell_color?>><?=$Q3_fat_actual?></td>
            <td class="column25 style15 n"><?=$fat_tar_oct?></td>
            <td class="column26 style12 n" <?=$fat_act_oct_cell_color?>><?=$fat_act_oct?></td>
            <td class="column27 style10 n"><?=$fat_tar_nov?></td>
            <td class="column28 style12 n" <?=$fat_act_nov_cell_color?>><?=$fat_act_nov?></td>
            <td class="column29 style10 n"><?=$fat_tar_dec?></td>
            <td class="column30 style11 n" <?=$fat_act_dec_cell_color?>><?=$fat_act_dec?></td>
            <td class="column31 style13 f"><?=$Q4_fat_target?></td>
            <td class="column32 style14 f" <?=$Q4_fat_actual_cell_color?>><?=$Q4_fat_actual?></td>
            <td class="column33 style15 f"><?=($Q1_fat_target+$Q2_fat_target+$Q3_fat_target+$Q4_fat_target)?></td>
            <td class="column34 style94 f" <?=$YTD_fat_actual_cell_color?>><?=($Q1_fat_actual+$Q2_fat_actual+$Q3_fat_actual+$Q4_fat_actual)?></td>
        </tr>
        <tr class="row6">
            <td class="column0 style42 s">Specific Injuries</td>
            <td class="column1 style16 n"><?=$spe_tar_jan?></td>
            <td class="column2 style18 n" <?=$spe_act_jan_cell_color?>><?=$spe_act_jan?></td>
            <td class="column3 style21 n"><?=$spe_tar_feb?></td>
            <td class="column4 style18 n" <?=$spe_act_feb_cell_color?>><?=$spe_act_feb?></td>
            <td class="column5 style16 n"><?=$spe_tar_mar?></td>
            <td class="column6 style17 n" <?=$spe_act_mar_cell_color?>><?=$spe_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_spe_target?></td>
            <td class="column8 style20 f" <?=$Q1_spe_actual_cell_color?>><?=$Q1_spe_actual?></td>
            <td class="column9 style21 n"><?=$spe_tar_apr?></td>
            <td class="column10 style18 n" <?=$spe_act_apr_cell_color?>><?=$spe_act_apr?></td>
            <td class="column11 style16 n"><?=$spe_tar_may?></td>
            <td class="column12 style18 n" <?=$spe_act_may_cell_color?>><?=$spe_act_may?></td>
            <td class="column13 style16 n"><?=$spe_tar_jun?></td>
            <td class="column14 style17 n" <?=$spe_act_jun_cell_color?>><?=$spe_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_spe_target?></td>
            <td class="column16 style20 f" <?=$Q2_spe_actual_cell_color?>><?=$Q2_spe_actual?></td>
            <td class="column17 style21 n"><?=$spe_tar_jul?></td>
            <td class="column18 style18 n" <?=$spe_act_jul_cell_color?>><?=$spe_act_jul?></td>
            <td class="column19 style16 n"><?=$spe_tar_aug?></td>
            <td class="column20 style18 n" <?=$spe_act_aug_cell_color?>><?=$spe_act_aug?></td>
            <td class="column21 style16 n"><?=$spe_tar_sep?></td>
            <td class="column22 style17 n" <?=$spe_act_sep_cell_color?>><?=$spe_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_spe_target?></td>
            <td class="column24 style20 f" <?=$Q3_spe_actual_cell_color?>><?=$Q3_spe_actual?></td>
            <td class="column25 style21 n"><?=$spe_tar_oct?></td>
            <td class="column26 style18 n" <?=$spe_act_oct_cell_color?>><?=$spe_act_oct?></td>
            <td class="column27 style16 n"><?=$spe_tar_nov?></td>
            <td class="column28 style18 n" <?=$spe_act_nov_cell_color?>><?=$spe_act_nov?></td>
            <td class="column29 style16 n"><?=$spe_tar_dec?></td>
            <td class="column30 style17 n" <?=$spe_act_dec_cell_color?>><?=$spe_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_spe_target?></td>
            <td class="column32 style20 f" <?=$Q4_spe_actual_cell_color?>><?=$Q4_spe_actual?></td>
            <td class="column33 style21 f"><?=($Q1_spe_target+$Q2_spe_target+$Q3_spe_target+$Q4_spe_target)?></td>
            <td class="column34 style95 f" <?=$YTD_spe_actual_cell_color?>><?=($Q1_spe_actual+$Q2_spe_actual+$Q3_spe_actual+$Q4_spe_actual)?></td>
        </tr>
        <tr class="row7">
            <td class="column0 style42 s">Over 7 day injury</td>
            <td class="column1 style16 n"><?=$day7_tar_jan?></td>
            <td class="column2 style18 n" <?=$day7_act_jan_cell_color?>><?=$day7_act_jan?></td>
            <td class="column3 style21 n"><?=$day7_tar_feb?></td>
            <td class="column4 style18 n" <?=$day7_act_feb_cell_color?>><?=$day7_act_feb?></td>
            <td class="column5 style16 n"><?=$day7_tar_mar?></td>
            <td class="column6 style17 n" <?=$day7_act_mar_cell_color?>><?=$day7_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_7day_target?></td>
            <td class="column8 style20 f" <?=$Q1_7day_actual_cell_color?>><?=$Q1_7day_actual?></td>
            <td class="column9 style21 n"><?=$day7_tar_apr?></td>
            <td class="column10 style18 n" <?=$day7_act_apr_cell_color?>><?=$day7_act_apr?></td>
            <td class="column11 style16 n"><?=$day7_tar_may?></td>
            <td class="column12 style18 n" <?=$day7_act_may_cell_color?>><?=$day7_act_may?></td>
            <td class="column13 style16 n"><?=$day7_tar_jun?></td>
            <td class="column14 style17 n" <?=$day7_act_jun_cell_color?>><?=$day7_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_7day_target?></td>
            <td class="column16 style20 f" <?=$Q2_7day_actual_cell_color?>><?=$Q2_7day_actual?></td>
            <td class="column17 style21 n"><?=$day7_tar_jul?></td>
            <td class="column18 style18 n" <?=$day7_act_jul_cell_color?>><?=$day7_act_jul?></td>
            <td class="column19 style16 n"><?=$day7_tar_aug?></td>
            <td class="column20 style18 n" <?=$day7_act_aug_cell_color?>><?=$day7_act_aug?></td>
            <td class="column21 style16 n"><?=$day7_tar_sep?></td>
            <td class="column22 style17 n" <?=$day7_act_sep_cell_color?>><?=$day7_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_7day_target?></td>
            <td class="column24 style20 f" <?=$Q3_7day_actual_cell_color?>><?=$Q3_7day_actual?></td>
            <td class="column25 style21 n"><?=$day7_tar_oct?></td>
            <td class="column26 style18 n" <?=$day7_act_oct_cell_color?>><?=$day7_act_oct?></td>
            <td class="column27 style16 n"><?=$day7_tar_nov?></td>
            <td class="column28 style18 n" <?=$day7_act_nov_cell_color?>><?=$day7_act_nov?></td>
            <td class="column29 style16 n"><?=$day7_tar_dec?></td>
            <td class="column30 style17 n" <?=$day7_act_dec_cell_color?>><?=$day7_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_7day_target?></td>
            <td class="column32 style20 f" <?=$Q4_7day_actual_cell_color?>><?=$Q4_7day_actual?></td>
            <td class="column33 style21 f"><?=($Q1_7day_target+$Q2_7day_target+$Q3_7day_target+$Q4_7day_target)?></td>
            <td class="column34 style95 f" <?=$YTD_7day_actual_cell_color?>><?=($Q1_7day_actual+$Q2_7day_actual+$Q3_7day_actual+$Q4_7day_actual)?></td>
        </tr>
        <tr class="row8">
            <td class="column0 style42 s">Occupational Diseases</td>
            <td class="column1 style16 n"><?=$occu_tar_jan?></td>
            <td class="column2 style18 n" <?=$occu_act_jan_cell_color?>><?=$occu_act_jan?></td>
            <td class="column3 style21 n"><?=$occu_tar_feb?></td>
            <td class="column4 style18 n" <?=$occu_act_feb_cell_color?>><?=$occu_act_feb?></td>
            <td class="column5 style16 n"><?=$occu_tar_mar?></td>
            <td class="column6 style17 n" <?=$occu_act_mar_cell_color?>><?=$occu_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_occu_target?></td>
            <td class="column8 style20 f" <?=$Q1_occu_actual_cell_color?>><?=$Q1_occu_actual?></td>
            <td class="column9 style21 n"><?=$occu_tar_apr?></td>
            <td class="column10 style18 n" <?=$occu_act_apr_cell_color?>><?=$occu_act_apr?></td>
            <td class="column11 style16 n"><?=$occu_tar_may?></td>
            <td class="column12 style18 n" <?=$occu_act_may_cell_color?>><?=$occu_act_may?></td>
            <td class="column13 style16 n"><?=$occu_tar_jun?></td>
            <td class="column14 style17 n" <?=$occu_act_jun_cell_color?>><?=$occu_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_occu_target?></td>
            <td class="column16 style20 f" <?=$Q2_occu_actual_cell_color?>><?=$Q2_occu_actual?></td>
            <td class="column17 style21 n"><?=$occu_tar_jul?></td>
            <td class="column18 style18 n" <?=$occu_act_jul_cell_color?>><?=$occu_act_jul?></td>
            <td class="column19 style16 n"><?=$occu_tar_aug?></td>
            <td class="column20 style18 n" <?=$occu_act_aug_cell_color?>><?=$occu_act_aug?></td>
            <td class="column21 style16 n"><?=$occu_tar_sep?></td>
            <td class="column22 style17 n" <?=$occu_act_sep_cell_color?>><?=$occu_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_occu_target?></td>
            <td class="column24 style20 f" <?=$Q3_occu_actual_cell_color?>><?=$Q3_occu_actual?></td>
            <td class="column25 style21 n"><?=$occu_tar_oct?></td>
            <td class="column26 style18 n" <?=$occu_act_oct_cell_color?>><?=$occu_act_oct?></td>
            <td class="column27 style16 n"><?=$occu_tar_nov?></td>
            <td class="column28 style18 n" <?=$occu_act_nov_cell_color?>><?=$occu_act_nov?></td>
            <td class="column29 style16 n"><?=$occu_tar_dec?></td>
            <td class="column30 style17 n" <?=$occu_act_dec_cell_color?>><?=$occu_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_occu_target?></td>
            <td class="column32 style20 f" <?=$Q4_occu_actual_cell_color?>><?=$Q4_occu_actual?></td>
            <td class="column33 style21 f"><?=($Q1_occu_target+$Q2_occu_target+$Q3_occu_target+$Q4_occu_target)?></td>
            <td class="column34 style95 f" <?=$YTD_occu_actual_cell_color?>><?=($Q1_occu_actual+$Q2_occu_actual+$Q3_occu_actual+$Q4_occu_actual)?></td>
        </tr>
        <tr class="row9">
            <td class="column0 style42 s">Dangerous Occurrences</td>
            <td class="column1 style16 n"><?=$dan_tar_jan?></td>
            <td class="column2 style18 n" <?=$dan_act_jan_cell_color?>><?=$dan_act_jan?></td>
            <td class="column3 style21 n"><?=$dan_tar_feb?></td>
            <td class="column4 style18 n" <?=$dan_act_feb_cell_color?>><?=$dan_act_feb?></td>
            <td class="column5 style16 n"><?=$dan_tar_mar?></td>
            <td class="column6 style17 n" <?=$dan_act_mar_cell_color?>><?=$dan_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_dan_target?></td>
            <td class="column8 style20 f" <?=$Q1_dan_actual_cell_color?>><?=$Q1_dan_actual?></td>
            <td class="column9 style21 n"><?=$dan_tar_apr?></td>
            <td class="column10 style18 n" <?=$dan_act_apr_cell_color?>><?=$dan_act_apr?></td>
            <td class="column11 style16 n"><?=$dan_tar_may?></td>
            <td class="column12 style18 n" <?=$dan_act_may_cell_color?>><?=$dan_act_may?></td>
            <td class="column13 style16 n"><?=$dan_tar_jun?></td>
            <td class="column14 style17 n" <?=$dan_act_jun_cell_color?>><?=$dan_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_dan_target?></td>
            <td class="column16 style20 f" <?=$Q2_dan_actual_cell_color?>><?=$Q2_dan_actual?></td>
            <td class="column17 style21 n"><?=$dan_tar_jul?></td>
            <td class="column18 style18 n" <?=$dan_act_jul_cell_color?>><?=$dan_act_jul?></td>
            <td class="column19 style16 n"><?=$dan_tar_aug?></td>
            <td class="column20 style18 n" <?=$dan_act_aug_cell_color?>><?=$dan_act_aug?></td>
            <td class="column21 style16 n"><?=$dan_tar_sep?></td>
            <td class="column22 style17 n" <?=$dan_act_sep_cell_color?>><?=$dan_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_dan_target?></td>
            <td class="column24 style20 f" <?=$Q3_dan_actual_cell_color?>><?=$Q3_dan_actual?></td>
            <td class="column25 style21 n"><?=$dan_tar_oct?></td>
            <td class="column26 style18 n" <?=$dan_act_oct_cell_color?>><?=$dan_act_oct?></td>
            <td class="column27 style16 n"><?=$dan_tar_nov?></td>
            <td class="column28 style18 n" <?=$dan_act_nov_cell_color?>><?=$dan_act_nov?></td>
            <td class="column29 style16 n"><?=$dan_tar_dec?></td>
            <td class="column30 style17 n" <?=$dan_act_dec_cell_color?>><?=$dan_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_dan_target?></td>
            <td class="column32 style20 f" <?=$Q4_dan_actual_cell_color?>><?=$Q4_dan_actual?></td>
            <td class="column33 style21 f"><?=($Q1_dan_target+$Q2_dan_target+$Q3_dan_target+$Q4_dan_target)?></td>
            <td class="column34 style95 f" <?=$YTD_dan_actual_cell_color?>><?=($Q1_dan_actual+$Q2_dan_actual+$Q3_dan_actual+$Q4_dan_actual)?></td>
        </tr>
        <tr class="row10">
            <td class="column0 style42 s">Non fatal accidents to non workers</td>
            <td class="column1 style16 n"><?=$nonf_tar_jan?></td>
            <td class="column2 style18 n" <?=$nonf_act_jan_cell_color?>><?=$nonf_act_jan?></td>
            <td class="column3 style21 n"><?=$nonf_tar_feb?></td>
            <td class="column4 style18 n" <?=$nonf_act_feb_cell_color?>><?=$nonf_act_feb?></td>
            <td class="column5 style16 n"><?=$nonf_tar_mar?></td>
            <td class="column6 style17 n" <?=$nonf_act_mar_cell_color?>><?=$nonf_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_nonf_target?></td>
            <td class="column8 style20 f" <?=$Q1_nonf_actual_cell_color?>><?=$Q1_nonf_actual?></td>
            <td class="column9 style21 n"><?=$nonf_tar_apr?></td>
            <td class="column10 style18 n" <?=$nonf_act_apr_cell_color?>><?=$nonf_act_apr?></td>
            <td class="column11 style16 n"><?=$nonf_tar_may?></td>
            <td class="column12 style18 n" <?=$nonf_act_may_cell_color?>><?=$nonf_act_may?></td>
            <td class="column13 style16 n"><?=$nonf_tar_jun?></td>
            <td class="column14 style17 n" <?=$nonf_act_jun_cell_color?>><?=$nonf_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_nonf_target?></td>
            <td class="column16 style20 f" <?=$Q2_nonf_actual_cell_color?>><?=$Q2_nonf_actual?></td>
            <td class="column17 style21 n"><?=$nonf_tar_jul?></td>
            <td class="column18 style18 n" <?=$nonf_act_jul_cell_color?>><?=$nonf_act_jul?></td>
            <td class="column19 style16 n"><?=$nonf_tar_aug?></td>
            <td class="column20 style18 n" <?=$nonf_act_aug_cell_color?>><?=$nonf_act_aug?></td>
            <td class="column21 style16 n"><?=$nonf_tar_sep?></td>
            <td class="column22 style17 n" <?=$nonf_act_sep_cell_color?>><?=$nonf_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_nonf_target?></td>
            <td class="column24 style20 f" <?=$Q3_nonf_actual_cell_color?>><?=$Q3_nonf_actual?></td>
            <td class="column25 style21 n"><?=$nonf_tar_oct?></td>
            <td class="column26 style18 n" <?=$nonf_act_oct_cell_color?>><?=$nonf_act_oct?></td>
            <td class="column27 style16 n"><?=$nonf_tar_nov?></td>
            <td class="column28 style18 n" <?=$nonf_act_nov_cell_color?>><?=$nonf_act_nov?></td>
            <td class="column29 style16 n"><?=$nonf_tar_dec?></td>
            <td class="column30 style17 n" <?=$nonf_act_dec_cell_color?>><?=$nonf_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_nonf_target?></td>
            <td class="column32 style20 f" <?=$Q4_nonf_actual_cell_color?>><?=$Q4_nonf_actual?></td>
            <td class="column33 style21 f"><?=($Q1_nonf_target+$Q2_nonf_target+$Q3_nonf_target+$Q4_nonf_target)?></td>
            <td class="column34 style95 f" <?=$YTD_nonf_actual_cell_color?>><?=($Q1_nonf_actual+$Q2_nonf_actual+$Q3_nonf_actual+$Q4_nonf_actual)?></td>
        </tr>
        <tr class="row11">
            <td class="column0 style42 s">Gas Incident</td>
            <td class="column1 style16 n"><?=$gas_tar_jan?></td>
            <td class="column2 style18 n" <?=$gas_act_jan_cell_color?>><?=$gas_act_jan?></td>
            <td class="column3 style21 n"><?=$gas_tar_feb?></td>
            <td class="column4 style18 n" <?=$gas_act_feb_cell_color?>><?=$gas_act_feb?></td>
            <td class="column5 style16 n"><?=$gas_tar_mar?></td>
            <td class="column6 style17 n" <?=$gas_act_mar_cell_color?>><?=$gas_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_gas_target?></td>
            <td class="column8 style20 f" <?=$Q1_gas_actual_cell_color?>><?=$Q1_gas_actual?></td>
            <td class="column9 style21 n"><?=$gas_tar_apr?></td>
            <td class="column10 style18 n" <?=$gas_act_apr_cell_color?>><?=$gas_act_apr?></td>
            <td class="column11 style16 n"><?=$gas_tar_may?></td>
            <td class="column12 style18 n" <?=$gas_act_may_cell_color?>><?=$gas_act_may?></td>
            <td class="column13 style16 n"><?=$gas_tar_jun?></td>
            <td class="column14 style17 n" <?=$gas_act_jun_cell_color?>><?=$gas_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_gas_target?></td>
            <td class="column16 style20 f" <?=$Q2_gas_actual_cell_color?>><?=$Q2_gas_actual?></td>
            <td class="column17 style21 n"><?=$gas_tar_jul?></td>
            <td class="column18 style18 n" <?=$gas_act_jul_cell_color?>><?=$gas_act_jul?></td>
            <td class="column19 style16 n"><?=$gas_tar_aug?></td>
            <td class="column20 style18 n" <?=$gas_act_aug_cell_color?>><?=$gas_act_aug?></td>
            <td class="column21 style16 n"><?=$gas_tar_sep?></td>
            <td class="column22 style17 n" <?=$gas_act_sep_cell_color?>><?=$gas_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_gas_target?></td>
            <td class="column24 style20 f" <?=$Q3_gas_actual_cell_color?>><?=$Q3_gas_actual?></td>
            <td class="column25 style21 n"><?=$gas_tar_oct?></td>
            <td class="column26 style18 n" <?=$gas_act_oct_cell_color?>><?=$gas_act_oct?></td>
            <td class="column27 style16 n"><?=$gas_tar_nov?></td>
            <td class="column28 style18 n" <?=$gas_act_nov_cell_color?>><?=$gas_act_nov?></td>
            <td class="column29 style16 n"><?=$gas_tar_dec?></td>
            <td class="column30 style17 n" <?=$gas_act_dec_cell_color?>><?=$gas_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_gas_target?></td>
            <td class="column32 style20 f" <?=$Q4_gas_actual_cell_color?>><?=$Q4_gas_actual?></td>
            <td class="column33 style21 f"><?=($Q1_gas_target+$Q2_gas_target+$Q3_gas_target+$Q4_gas_target)?></td>
            <td class="column34 style95 f" <?=$YTD_gas_actual_cell_color?>><?=($Q1_gas_actual+$Q2_gas_actual+$Q3_gas_actual+$Q4_gas_actual)?></td>
        </tr>
        <tr class="row12">
            <td class="column0 style85 s">Total RIDDOR Report</td>
            <td class="column1 style81 n"><?=$ridd_tar_jan?></td>
            <td class="column2 style83 n" <?=$ridd_act_jan_cell_color?>><?=$ridd_act_jan?></td>
            <td class="column3 style82 n"><?=$ridd_tar_feb?></td>
            <td class="column4 style83 n" <?=$ridd_act_feb_cell_color?>><?=$ridd_act_feb?></td>
            <td class="column5 style82 n"><?=$ridd_tar_mar?></td>
            <td class="column6 style86 n" <?=$ridd_act_mar_cell_color?>><?=$ridd_act_mar?></td>
            <td class="column7 style48 f"><?=$Q1_ridd_target?></td>
            <td class="column8 style22 f" <?=$Q1_ridd_actual_cell_color?>><?=$Q1_ridd_actual?></td>
            <td class="column9 style82 n"><?=$ridd_tar_apr?></td>
            <td class="column10 style83 n" <?=$ridd_act_apr_cell_color?>><?=$ridd_act_apr?></td>
            <td class="column11 style81 n"><?=$ridd_tar_may?></td>
            <td class="column12 style83 n" <?=$ridd_act_may_cell_color?>><?=$ridd_act_may?></td>
            <td class="column13 style81 n"><?=$ridd_tar_jun?></td>
            <td class="column14 style86 n" <?=$ridd_act_jun_cell_color?>><?=$ridd_act_jun?></td>
            <td class="column15 style77 f"><?=$Q2_ridd_target?></td>
            <td class="column16 style78 f" <?=$Q2_ridd_actual_cell_color?>><?=$Q2_ridd_actual?></td>
            <td class="column17 style82 n"><?=$ridd_tar_jul?></td>
            <td class="column18 style83 n" <?=$ridd_act_jul_cell_color?>><?=$ridd_act_jul?></td>
            <td class="column19 style81 n"><?=$ridd_tar_aug?></td>
            <td class="column20 style83 n" <?=$ridd_act_aug_cell_color?>><?=$ridd_act_aug?></td>
            <td class="column21 style81 n"><?=$ridd_tar_sep?></td>
            <td class="column22 style86 n" <?=$ridd_act_sep_cell_color?>><?=$ridd_act_sep?></td>
            <td class="column23 style45 f"><?=$Q3_ridd_target?></td>
            <td class="column24 style46 f" <?=$Q3_ridd_actual_cell_color?>><?=$Q3_ridd_actual?></td>
            <td class="column25 style82 n"><?=$ridd_tar_oct?></td>
            <td class="column26 style83 n" <?=$ridd_act_oct_cell_color?>><?=$ridd_act_oct?></td>
            <td class="column27 style81 n"><?=$ridd_tar_nov?></td>
            <td class="column28 style83 n" <?=$ridd_act_nov_cell_color?>><?=$ridd_act_nov?></td>
            <td class="column29 style81 n"><?=$ridd_tar_dec?></td>
            <td class="column30 style86 n" <?=$ridd_act_dec_cell_color?>><?=$ridd_act_dec?></td>
            <td class="column31 style45 f"><?=$Q4_ridd_target?></td>
            <td class="column32 style46 f" <?=$Q4_ridd_actual_cell_color?>><?=$Q4_ridd_actual?></td>
            <td class="column33 style30 f"><?=($Q1_ridd_target+$Q2_ridd_target+$Q3_ridd_target+$Q4_ridd_target)?></td>
            <td class="column34 style26 f" <?=$YTD_ridd_actual_cell_color?>><?=($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual)?></td>
        </tr>
        <tr class="row13">
            <td class="column0 style50 s">No of medical treatment over first aid</td>
            <td class="column1 style16 n"><?=$medi_tar_jan?></td>
            <td class="column2 style18 n" <?=$medi_act_jan_cell_color?>><?=$medi_act_jan?></td>
            <td class="column3 style21 n"><?=$medi_tar_feb?></td>
            <td class="column4 style18 n" <?=$medi_act_feb_cell_color?>><?=$medi_act_feb?></td>
            <td class="column5 style16 n"><?=$medi_tar_mar?></td>
            <td class="column6 style17 n" <?=$medi_act_mar_cell_color?>><?=$medi_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_medi_target?></td>
            <td class="column8 style20 f" <?=$Q1_medi_actual_cell_color?>><?=$Q1_medi_actual?></td>
            <td class="column9 style21 n"><?=$medi_tar_apr?></td>
            <td class="column10 style18 n" <?=$medi_act_apr_cell_color?>><?=$medi_act_apr?></td>
            <td class="column11 style16 n"><?=$medi_tar_may?></td>
            <td class="column12 style18 n" <?=$medi_act_may_cell_color?>><?=$medi_act_may?></td>
            <td class="column13 style16 n"><?=$medi_tar_jun?></td>
            <td class="column14 style17 n" <?=$medi_act_jun_cell_color?>><?=$medi_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_medi_target?></td>
            <td class="column16 style20 f" <?=$Q2_medi_actual_cell_color?>><?=$Q2_medi_actual?></td>
            <td class="column17 style21 n"><?=$medi_tar_jul?></td>
            <td class="column18 style18 n" <?=$medi_act_jul_cell_color?>><?=$medi_act_jul?></td>
            <td class="column19 style16 n"><?=$medi_tar_aug?></td>
            <td class="column20 style18 n" <?=$medi_act_aug_cell_color?>><?=$medi_act_aug?></td>
            <td class="column21 style16 n"><?=$medi_tar_sep?></td>
            <td class="column22 style17 n" <?=$medi_act_sep_cell_color?>><?=$medi_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_medi_target?></td>
            <td class="column24 style20 f" <?=$Q3_medi_actual_cell_color?>><?=$Q3_medi_actual?></td>
            <td class="column25 style21 n"><?=$medi_tar_oct?></td>
            <td class="column26 style18 n" <?=$medi_act_oct_cell_color?>><?=$medi_act_oct?></td>
            <td class="column27 style16 n"><?=$medi_tar_nov?></td>
            <td class="column28 style18 n" <?=$medi_act_nov_cell_color?>><?=$medi_act_nov?></td>
            <td class="column29 style16 n"><?=$medi_tar_dec?></td>
            <td class="column30 style17 n" <?=$medi_act_dec_cell_color?>><?=$medi_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_medi_target?></td>
            <td class="column32 style20 f" <?=$Q4_medi_actual_cell_color?>><?=$Q4_medi_actual?></td>
            <td class="column33 style21 f"><?=($Q1_medi_target+$Q2_medi_target+$Q3_medi_target+$Q4_medi_target)?></td>
            <td class="column34 style95 f" <?=$YTD_medi_actual_cell_color?>><?=($Q1_medi_actual+$Q2_medi_actual+$Q3_medi_actual+$Q4_medi_actual)?></td>
        </tr>
        <tr class="row14">
            <td class="column0 style42 s">No of minor injuries</td>
            <td class="column1 style16 n"><?=$mino_tar_jan?></td>
            <td class="column2 style18 n" <?=$mino_act_jan_cell_color?>><?=$mino_act_jan?></td>
            <td class="column3 style21 n"><?=$mino_tar_feb?></td>
            <td class="column4 style18 n" <?=$mino_act_feb_cell_color?>><?=$mino_act_feb?></td>
            <td class="column5 style16 n"><?=$mino_tar_mar?></td>
            <td class="column6 style17 n" <?=$mino_act_mar_cell_color?>><?=$mino_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_mino_target?></td>
            <td class="column8 style20 f" <?=$Q1_mino_actual_cell_color?>><?=$Q1_mino_actual?></td>
            <td class="column9 style21 n"><?=$mino_tar_apr?></td>
            <td class="column10 style18 n" <?=$mino_act_apr_cell_color?>><?=$mino_act_apr?></td>
            <td class="column11 style16 n"><?=$mino_tar_may?></td>
            <td class="column12 style18 n" <?=$mino_act_may_cell_color?>><?=$mino_act_may?></td>
            <td class="column13 style16 n"><?=$mino_tar_jun?></td>
            <td class="column14 style17 n" <?=$mino_act_jun_cell_color?>><?=$mino_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_mino_target?></td>
            <td class="column16 style20 f" <?=$Q2_mino_actual_cell_color?>><?=$Q2_mino_actual?></td>
            <td class="column17 style21 n"><?=$mino_tar_jul?></td>
            <td class="column18 style18 n" <?=$mino_act_jul_cell_color?>><?=$mino_act_jul?></td>
            <td class="column19 style16 n"><?=$mino_tar_aug?></td>
            <td class="column20 style18 n" <?=$mino_act_aug_cell_color?>><?=$mino_act_aug?></td>
            <td class="column21 style16 n"><?=$mino_tar_sep?></td>
            <td class="column22 style17 n" <?=$mino_act_sep_cell_color?>><?=$mino_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_mino_target?></td>
            <td class="column24 style20 f" <?=$Q3_mino_actual_cell_color?>><?=$Q3_mino_actual?></td>
            <td class="column25 style21 n"><?=$mino_tar_oct?></td>
            <td class="column26 style18 n" <?=$mino_act_oct_cell_color?>><?=$mino_act_oct?></td>
            <td class="column27 style16 n"><?=$mino_tar_nov?></td>
            <td class="column28 style18 n" <?=$mino_act_nov_cell_color?>><?=$mino_act_nov?></td>
            <td class="column29 style16 n"><?=$mino_tar_dec?></td>
            <td class="column30 style17 n" <?=$mino_act_dec_cell_color?>><?=$mino_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_mino_target?></td>
            <td class="column32 style20 f" <?=$Q4_mino_actual_cell_color?>><?=$Q4_mino_actual?></td>
            <td class="column33 style21 f"><?=($Q1_mino_target+$Q2_mino_target+$Q3_mino_target+$Q4_mino_target)?></td>
            <td class="column34 style95 f" <?=$YTD_mino_actual_cell_color?>><?=($Q1_mino_actual+$Q2_mino_actual+$Q3_mino_actual+$Q4_mino_actual)?></td>
        </tr>
        <tr class="row15">
            <td class="column0 style51 s">Total lost days</td>
            <td class="column1 style23 n"><?=$lost_tar_jan?></td>
            <td class="column2 style24 n" <?=$lost_act_jan_cell_color?>><?=$lost_act_jan?></td>
            <td class="column3 style23 n"><?=$lost_tar_feb?></td>
            <td class="column4 style24 n" <?=$lost_act_feb_cell_color?>><?=$lost_act_feb?></td>
            <td class="column5 style23 n"><?=$lost_tar_mar?></td>
            <td class="column6 style47 n" <?=$lost_act_mar_cell_color?>><?=$lost_act_mar?></td>
            <td class="column7 style48 f"><?=$Q1_lost_target?></td>
            <td class="column8 style22 f" <?=$Q1_lost_actual_cell_color?>><?=$Q1_lost_actual?></td>
            <td class="column9 style23 n"><?=$lost_tar_apr?></td>
            <td class="column10 style24 n" <?=$lost_act_apr_cell_color?>><?=$lost_act_apr?></td>
            <td class="column11 style23 n"><?=$lost_tar_may?></td>
            <td class="column12 style24 n" <?=$lost_act_may_cell_color?>><?=$lost_act_may?></td>
            <td class="column13 style23 n"><?=$lost_tar_jun?></td>
            <td class="column14 style47 n" <?=$lost_act_jun_cell_color?>><?=$lost_act_jun?></td>
            <td class="column15 style48 f"><?=$Q2_lost_target?></td>
            <td class="column16 style22 f" <?=$Q2_lost_actual_cell_color?>><?=$Q2_lost_actual?></td>
            <td class="column17 style23 n"><?=$lost_tar_jul?></td>
            <td class="column18 style24 n" <?=$lost_act_jul_cell_color?>><?=$lost_act_jul?></td>
            <td class="column19 style23 n"><?=$lost_tar_aug?></td>
            <td class="column20 style24 n" <?=$lost_act_aug_cell_color?>><?=$lost_act_aug?></td>
            <td class="column21 style23 n"><?=$lost_tar_sep?></td>
            <td class="column22 style47 n" <?=$lost_act_sep_cell_color?>><?=$lost_act_sep?></td>
            <td class="column23 style48 f"><?=$Q3_lost_target?></td>
            <td class="column24 style22 f" <?=$Q3_lost_actual_cell_color?>><?=$Q3_lost_actual?></td>
            <td class="column25 style23 n"><?=$lost_tar_oct?></td>
            <td class="column26 style24 n" <?=$lost_act_oct_cell_color?>><?=$lost_act_oct?></td>
            <td class="column27 style23 n"><?=$lost_tar_nov?></td>
            <td class="column28 style24 n" <?=$lost_act_nov_cell_color?>><?=$lost_act_nov?></td>
            <td class="column29 style23 n"><?=$lost_tar_dec?></td>
            <td class="column30 style47 n" <?=$lost_act_dec_cell_color?>><?=$lost_act_dec?></td>
            <td class="column31 style48 f"><?=$Q4_lost_target?></td>
            <td class="column32 style22 f" <?=$Q4_lost_actual_cell_color?>><?=$Q4_lost_actual?></td>
            <td class="column33 style23 f"><?=($Q1_lost_target+$Q2_lost_target+$Q3_lost_target+$Q4_lost_target)?></td>
            <td class="column34 style26 f" <?=$YTD_lost_actual_cell_color?>><?=($Q1_lost_actual+$Q2_lost_actual+$Q3_lost_actual+$Q4_lost_actual)?></td>
        </tr>
        <tr class="row16">
            <td class="column0 style61 s">Hazard Identification</td>
            <td class="column1 style16 n"><?=$haz_tar_jan?></td>
            <td class="column2 style18 n" <?=$haz_act_jan_cell_color?>><?=$haz_act_jan?></td>
            <td class="column3 style21 n"><?=$haz_tar_feb?></td>
            <td class="column4 style18 n" <?=$haz_act_feb_cell_color?>><?=$haz_act_feb?></td>
            <td class="column5 style16 n"><?=$haz_tar_mar?></td>
            <td class="column6 style17 n" <?=$haz_act_mar_cell_color?>><?=$haz_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_haz_target?></td>
            <td class="column8 style20 f" <?=$Q1_haz_actual_cell_color?>><?=$Q1_haz_actual?></td>
            <td class="column9 style21 n"><?=$haz_tar_apr?></td>
            <td class="column10 style18 n" <?=$haz_act_apr_cell_color?>><?=$haz_act_apr?></td>
            <td class="column11 style16 n"><?=$haz_tar_may?></td>
            <td class="column12 style18 n" <?=$haz_act_may_cell_color?>><?=$haz_act_may?></td>
            <td class="column13 style16 n"><?=$haz_tar_jun?></td>
            <td class="column14 style17 n" <?=$haz_act_jun_cell_color?>><?=$haz_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_haz_target?></td>
            <td class="column16 style20 f" <?=$Q2_haz_actual_cell_color?>><?=$Q2_haz_actual?></td>
            <td class="column17 style21 n"><?=$haz_tar_jul?></td>
            <td class="column18 style18 n" <?=$haz_act_jul_cell_color?>><?=$haz_act_jul?></td>
            <td class="column19 style16 n"><?=$haz_tar_aug?></td>
            <td class="column20 style18 n" <?=$haz_act_aug_cell_color?>><?=$haz_act_aug?></td>
            <td class="column21 style16 n"><?=$haz_tar_sep?></td>
            <td class="column22 style17 n" <?=$haz_act_sep_cell_color?>><?=$haz_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_haz_target?></td>
            <td class="column24 style20 f" <?=$Q3_haz_actual_cell_color?>><?=$Q3_haz_actual?></td>
            <td class="column25 style21 n"><?=$haz_tar_oct?></td>
            <td class="column26 style18 n" <?=$haz_act_oct_cell_color?>><?=$haz_act_oct?></td>
            <td class="column27 style16 n"><?=$haz_tar_nov?></td>
            <td class="column28 style18 n" <?=$haz_act_nov_cell_color?>><?=$haz_act_nov?></td>
            <td class="column29 style16 n"><?=$haz_tar_dec?></td>
            <td class="column30 style17 n" <?=$haz_act_dec_cell_color?>><?=$haz_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_haz_target?></td>
            <td class="column32 style20 f" <?=$Q4_haz_actual_cell_color?>><?=$Q4_haz_actual?></td>
            <td class="column33 style21 f"><?=($Q1_haz_target+$Q2_haz_target+$Q3_haz_target+$Q4_haz_target)?></td>
            <td class="column34 style95 f" <?=$YTD_haz_actual_cell_color?>><?=($Q1_haz_actual+$Q2_haz_actual+$Q3_haz_actual+$Q4_haz_actual)?></td>
        </tr>
        <tr class="row17">
            <td class="column0 style62 s">Near Misses</td>
            <td class="column1 style16 n"><?=$near_tar_jan?></td>
            <td class="column2 style18 n" <?=$near_act_jan_cell_color?>><?=$near_act_jan?></td>
            <td class="column3 style16 n"><?=$near_tar_feb?></td>
            <td class="column4 style18 n" <?=$near_act_feb_cell_color?>><?=$near_act_feb?></td>
            <td class="column5 style16 n"><?=$near_tar_mar?></td>
            <td class="column6 style17 n" <?=$near_act_mar_cell_color?>><?=$near_act_mar?></td>
            <td class="column7 style19 f"><?=$Q1_near_target?></td>
            <td class="column8 style20 f" <?=$Q1_near_actual_cell_color?>><?=$Q1_near_actual?></td>
            <td class="column9 style21 n"><?=$near_tar_apr?></td>
            <td class="column10 style18 n" <?=$near_act_apr_cell_color?>><?=$near_act_apr?></td>
            <td class="column11 style16 n"><?=$near_tar_may?></td>
            <td class="column12 style18 n" <?=$near_act_may_cell_color?>><?=$near_act_may?></td>
            <td class="column13 style16 n"><?=$near_tar_jun?></td>
            <td class="column14 style17 n" <?=$near_act_jun_cell_color?>><?=$near_act_jun?></td>
            <td class="column15 style19 f"><?=$Q2_near_target?></td>
            <td class="column16 style20 f" <?=$Q2_near_actual_cell_color?>><?=$Q2_near_actual?></td>
            <td class="column17 style21 n"><?=$near_tar_jul?></td>
            <td class="column18 style18 n" <?=$near_act_jul_cell_color?>><?=$near_act_jul?></td>
            <td class="column19 style16 n"><?=$near_tar_aug?></td>
            <td class="column20 style17 n" <?=$near_act_aug_cell_color?>><?=$near_act_aug?></td>
            <td class="column21 style16 n"><?=$near_tar_sep?></td>
            <td class="column22 style17 n" <?=$near_act_sep_cell_color?>><?=$near_act_sep?></td>
            <td class="column23 style19 f"><?=$Q3_near_target?></td>
            <td class="column24 style20 f" <?=$Q3_near_actual_cell_color?>><?=$Q3_near_actual?></td>
            <td class="column25 style21 n"><?=$near_tar_oct?></td>
            <td class="column26 style18 n" <?=$near_act_oct_cell_color?>><?=$near_act_oct?></td>
            <td class="column27 style16 n"><?=$near_tar_nov?></td>
            <td class="column28 style18 n" <?=$near_act_nov_cell_color?>><?=$near_act_nov?></td>
            <td class="column29 style16 n"><?=$near_tar_dec?></td>
            <td class="column30 style17 n" <?=$near_act_dec_cell_color?>><?=$near_act_dec?></td>
            <td class="column31 style19 f"><?=$Q4_near_target?></td>
            <td class="column32 style20 f" <?=$Q4_near_actual_cell_color?>><?=$Q4_near_actual?></td>
            <td class="column33 style21 f"><?=($Q1_near_target+$Q2_near_target+$Q3_near_target+$Q4_near_target)?></td>
            <td class="column34 style95 f" <?=$YTD_near_actual_cell_color?>><?=($Q1_near_actual+$Q2_near_actual+$Q3_near_actual+$Q4_near_actual)?></td>
        </tr>
        <tr class="row18">
            <td class="column0 style84 s">Hazards Identified / Near Misses Total</td>
            <td class="column1 style25 n"><?=$haznea_tar_jan?></td>
            <td class="column2 style28 n" <?=$haznea_act_jan_cell_color?>><?=$haznea_act_jan?></td>
            <td class="column3 style49 n"><?=$haznea_tar_feb?></td>
            <td class="column4 style28 n" <?=$haznea_act_feb_cell_color?>><?=$haznea_act_feb?></td>
            <td class="column5 style49 n"><?=$haznea_tar_mar?></td>
            <td class="column6 style73 n" <?=$haznea_act_mar_cell_color?>><?=$haznea_act_mar?></td>
            <td class="column7 style48 f"><?=$Q1_haznea_target?></td>
            <td class="column8 style22 f" <?=$Q1_haznea_actual_cell_color?>><?=$Q1_haznea_actual?></td>
            <td class="column9 style49 n"><?=$haznea_tar_apr?></td>
            <td class="column10 style28 n" <?=$haznea_act_apr_cell_color?>><?=$haznea_act_apr?></td>
            <td class="column11 style25 n"><?=$haznea_tar_may?></td>
            <td class="column12 style28 n" <?=$haznea_act_may_cell_color?>><?=$haznea_act_may?></td>
            <td class="column13 style25 n"><?=$haznea_tar_jun?></td>
            <td class="column14 style73 n" <?=$haznea_act_jun_cell_color?>><?=$haznea_act_jun?></td>
            <td class="column15 style48 f"><?=$Q2_haznea_target?></td>
            <td class="column16 style22 f" <?=$Q2_haznea_actual_cell_color?>><?=$Q2_haznea_actual?></td>
            <td class="column17 style49 n"><?=$haznea_tar_jul?></td>
            <td class="column18 style28 n" <?=$haznea_act_jul_cell_color?>><?=$haznea_act_jul?></td>
            <td class="column19 style25 n"><?=$haznea_tar_aug?></td>
            <td class="column20 style28 n" <?=$haznea_act_aug_cell_color?>><?=$haznea_act_aug?></td>
            <td class="column21 style25 n"><?=$haznea_tar_sep?></td>
            <td class="column22 style73 n" <?=$haznea_act_sep_cell_color?>><?=$haznea_act_sep?></td>
            <td class="column23 style48 f"><?=$Q3_near_target?></td>
            <td class="column24 style22 f" <?=$Q3_haznea_actual_cell_color?>><?=$Q3_haznea_actual?></td>
            <td class="column25 style49 n"><?=$haznea_tar_oct?></td>
            <td class="column26 style28 n" <?=$haznea_act_oct_cell_color?>><?=$haznea_act_oct?></td>
            <td class="column27 style25 n"><?=$haznea_tar_nov?></td>
            <td class="column28 style28 n" <?=$haznea_act_nov_cell_color?>><?=$haznea_act_nov?></td>
            <td class="column29 style25 n"><?=$haznea_tar_dec?></td>
            <td class="column30 style73 n" <?=$haznea_act_dec_cell_color?>><?=$haznea_act_dec?></td>
            <td class="column31 style48 f"><?=$Q4_haznea_target?></td>
            <td class="column32 style22 f" <?=$Q4_haznea_actual_cell_color?>><?=$Q4_haznea_actual?></td>
            <td class="column33 style49 f"><?=($Q1_haznea_target+$Q2_haznea_target+$Q3_haznea_target+$Q4_haznea_target)?></td>
            <td class="column34 style26 f" <?=$YTD_haznea_actual_cell_color?>><?=($Q1_haznea_actual+$Q2_haznea_actual+$Q3_haznea_actual+$Q4_haznea_actual)?></td>
        </tr>
        <tr class="row19">
            <td class="column0 style80 s">Incidents</td>
            <td class="column1 style81 n"><?=$inci_tar_jan?></td>
            <td class="column2 style83 n" <?=$inci_act_jan_cell_color?>><?=$inci_act_jan?></td>
            <td class="column3 style82 n"><?=$inci_tar_feb?></td>
            <td class="column4 style83 n" <?=$inci_act_feb_cell_color?>><?=$inci_act_feb?></td>
            <td class="column5 style82 n"><?=$inci_tar_mar?></td>
            <td class="column6 style86 n" <?=$inci_act_mar_cell_color?>><?=$inci_act_mar?></td>
            <td class="column7 style48 f"><?=$Q1_inci_target?></td>
            <td class="column8 style22 f" <?=$Q1_inci_actual_cell_color?>><?=$Q1_inci_actual?></td>
            <td class="column9 style82 n"><?=$inci_tar_apr?></td>
            <td class="column10 style83 n" <?=$inci_act_apr_cell_color?>><?=$inci_act_apr?></td>
            <td class="column11 style81 n"><?=$inci_tar_may?></td>
            <td class="column12 style83 n" <?=$inci_act_may_cell_color?>><?=$inci_act_may?></td>
            <td class="column13 style81 n"><?=$inci_tar_jun?></td>
            <td class="column14 style86 n" <?=$inci_act_jun_cell_color?>><?=$inci_act_jun?></td>
            <td class="column15 style48 f"><?=$Q2_inci_target?></td>
            <td class="column16 style22 f" <?=$Q2_inci_actual_cell_color?>><?=$Q2_inci_actual?></td>
            <td class="column17 style82 n"><?=$inci_tar_jul?></td>
            <td class="column18 style83 n" <?=$inci_act_jul_cell_color?>><?=$inci_act_jul?></td>
            <td class="column19 style81 n"><?=$inci_tar_aug?></td>
            <td class="column20 style83 n" <?=$inci_act_aug_cell_color?>><?=$inci_act_aug?></td>
            <td class="column21 style81 n"><?=$inci_tar_sep?></td>
            <td class="column22 style86 n" <?=$inci_act_sep_cell_color?>><?=$inci_act_sep?></td>
            <td class="column23 style48 f"><?=$Q3_inci_target?></td>
            <td class="column24 style22 f" <?=$Q3_inci_actual_cell_color?>><?=$Q3_inci_actual?></td>
            <td class="column25 style82 n"><?=$inci_tar_oct?></td>
            <td class="column26 style83 n" <?=$inci_act_oct_cell_color?>><?=$inci_act_oct?></td>
            <td class="column27 style81 n"><?=$inci_tar_nov?></td>
            <td class="column28 style83 n" <?=$inci_act_nov_cell_color?>><?=$inci_act_nov?></td>
            <td class="column29 style81 n"><?=$inci_tar_dec?></td>
            <td class="column30 style86 n" <?=$inci_act_dec_cell_color?>><?=$inci_act_dec?></td>
            <td class="column31 style48 f"><?=$Q4_inci_target?></td>
            <td class="column32 style22 f" <?=$Q4_inci_actual_cell_color?>><?=$Q4_inci_actual?></td>
            <td class="column33 style82 f"><?=($Q1_inci_target+$Q2_inci_target+$Q3_inci_target+$Q4_inci_target)?></td>
            <td class="column34 style26 f" <?=$YTD_inci_actual_cell_color?>><?=($Q1_inci_actual+$Q2_inci_actual+$Q3_inci_actual+$Q4_inci_actual)?></td>
        </tr>
        <tr class="row20">
            <td class="column0 style91 s">Avg. No of employees</td>
            <td class="column1 style90"></td>
            <td class="column2 style18 n"><?=$empl_act_jan?></td>
            <td class="column3 style63"></td>
            <td class="column4 style18 n"><?=$empl_act_feb?></td>
            <td class="column5 style63"></td>
            <td class="column6 style87 n"><?=$empl_act_mar?></td>
            <td class="column7 style31"></td>
            <td class="column8 style32 f"><?=$Q1_empl_actual?></td>
            <td class="column9 style63"></td>
            <td class="column10 style18 n"><?=$empl_act_apr?></td>
            <td class="column11 style63"></td>
            <td class="column12 style18 n"><?=$empl_act_may?></td>
            <td class="column13 style63"></td>
            <td class="column14 style87 n"><?=$empl_act_jun?></td>
            <td class="column15 style31"></td>
            <td class="column16 style32 f"><?=$Q2_empl_actual?></td>
            <td class="column17 style63"></td>
            <td class="column18 style18 n"><?=$empl_act_jul?></td>
            <td class="column19 style63"></td>
            <td class="column20 style18 n"><?=$empl_act_aug?></td>
            <td class="column21 style63"></td>
            <td class="column22 style87 n"><?=$empl_act_sep?></td>
            <td class="column23 style31"></td>
            <td class="column24 style32 f"><?=$Q3_empl_actual?></td>
            <td class="column25 style63"></td>
            <td class="column26 style18 n"><?=$empl_act_oct?></td>
            <td class="column27 style63"></td>
            <td class="column28 style18 n"><?=$empl_act_nov?></td>
            <td class="column29 style63"></td>
            <td class="column30 style87 n"><?=$empl_act_dec?></td>
            <td class="column31 style31"></td>
            <td class="column32 style32 f"><?=$Q4_empl_actual?></td>
            <td class="column33 style63"></td>
            <td class="column34 style95 f"><?=($Q1_empl_actual+$Q2_empl_actual+$Q3_empl_actual+$Q4_empl_actual)?></td>
        </tr>
        <tr class="row21">
            <td class="column0 style92 s">Total hours worked</td>
            <td class="column1 style64"></td>
            <td class="column2 style43 n"><?=$wor_act_jan?></td>
            <td class="column3 style64"></td>
            <td class="column4 style43 n"><?=$wor_act_feb?></td>
            <td class="column5 style64"></td>
            <td class="column6 style44 n"><?=$wor_act_mar?></td>
            <td class="column7 style31"></td>
            <td class="column8 style32 f"><?=$Q1_wor_actual?></td>
            <td class="column9 style36"></td>
            <td class="column10 style43 n"><?=$wor_act_apr?></td>
            <td class="column11 style64"></td>
            <td class="column12 style43 n"><?=$wor_act_may?></td>
            <td class="column13 style64"></td>
            <td class="column14 style44 n"><?=$wor_act_jun?></td>
            <td class="column15 style31"></td>
            <td class="column16 style32 f"><?=$Q2_wor_actual?></td>
            <td class="column17 style36"></td>
            <td class="column18 style43 n"><?=$wor_act_jul?></td>
            <td class="column19 style64"></td>
            <td class="column20 style43 n"><?=$wor_act_aug?></td>
            <td class="column21 style64"></td>
            <td class="column22 style44 n"><?=$wor_act_sep?></td>
            <td class="column23 style31"></td>
            <td class="column24 style32 f"><?=$Q3_wor_actual?></td>
            <td class="column25 style36"></td>
            <td class="column26 style43 n"><?=$wor_act_oct?></td>
            <td class="column27 style64"></td>
            <td class="column28 style43 n"><?=$wor_act_nov?></td>
            <td class="column29 style64"></td>
            <td class="column30 style44 n"><?=$wor_act_dec?></td>
            <td class="column31 style31"></td>
            <td class="column32 style32 f"><?=$Q4_wor_actual?></td>
            <td class="column33 style36"></td>
            <td class="column34 style95 f"><?=($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual)?></td>
        </tr>
        <tr class="row22">
            <td class="column0 style92 s">Non reportable Injury Rate</td>
            <td class="column1 style64"></td>
            <td class="column2 style43 f"><?=(is_nan(((($medi_act_jan+$mino_act_jan) * 100000)/$wor_act_jan))?0:(is_infinite((($medi_act_jan+$mino_act_jan) * 100000)/$wor_act_jan)?0:round((($medi_act_jan+$mino_act_jan) * 100000)/$wor_act_jan)))?></td>
            <td class="column3 style64"></td>
            <td class="column4 style43 f"><?=(is_nan(((($medi_act_feb+$mino_act_feb) * 100000)/$wor_act_feb))?0:(is_infinite((($medi_act_feb+$mino_act_feb) * 100000)/$wor_act_feb)?0:round((($medi_act_feb+$mino_act_feb) * 100000)/$wor_act_feb)))?></td>
            <td class="column5 style64"></td>
            <td class="column6 style44 f"><?=(is_nan(((($medi_act_mar+$mino_act_mar) * 100000)/$wor_act_mar))?0:(is_infinite((($medi_act_mar+$mino_act_mar) * 100000)/$wor_act_mar)?0:round((($medi_act_mar+$mino_act_mar) * 100000)/$wor_act_mar)))?></td>
            <td class="column7 style31"></td>
            <td class="column8 style32 f"><?=(is_nan(((($Q1_medi_actual+$Q1_mino_actual) * 100000)/$Q1_wor_actual))?0:(is_infinite((($Q1_medi_actual+$Q1_mino_actual) * 100000)/$Q1_wor_actual)?0:round((($Q1_medi_actual+$Q1_mino_actual) * 100000)/$Q1_wor_actual)))?></td>
            <td class="column9 style36"></td>
            <td class="column10 style43 f"><?=(is_nan(((($medi_act_apr+$mino_act_apr) * 100000)/$wor_act_apr))?0:(is_infinite((($medi_act_apr+$mino_act_apr) * 100000)/$wor_act_apr)?0:round((($medi_act_apr+$mino_act_apr) * 100000)/$wor_act_apr)))?></td>
            <td class="column11 style64"></td>
            <td class="column12 style43 f"><?=(is_nan(((($medi_act_may+$mino_act_may) * 100000)/$wor_act_may))?0:(is_infinite((($medi_act_may+$mino_act_may) * 100000)/$wor_act_may)?0:round((($medi_act_may+$mino_act_may) * 100000)/$wor_act_may)))?></td>
            <td class="column13 style64"></td>
            <td class="column14 style44 f"><?=(is_nan(((($medi_act_jun+$mino_act_jun) * 100000)/$wor_act_jun))?0:(is_infinite((($medi_act_jun+$mino_act_jun) * 100000)/$wor_act_jun)?0:round((($medi_act_jun+$mino_act_jun) * 100000)/$wor_act_jun)))?></td>
            <td class="column15 style31"></td>
            <td class="column16 style32 f"><?=(is_nan(((($Q2_medi_actual+$Q2_mino_actual) * 100000)/$Q2_wor_actual))?0:(is_infinite((($Q2_medi_actual+$Q2_mino_actual) * 100000)/$Q2_wor_actual)?0:round((($Q2_medi_actual+$Q2_mino_actual) * 100000)/$Q2_wor_actual)))?></td>
            <td class="column17 style36"></td>
            <td class="column18 style43 f"><?=(is_nan(((($medi_act_jul+$mino_act_jul) * 100000)/$wor_act_jul))?0:(is_infinite((($medi_act_jul+$mino_act_jul) * 100000)/$wor_act_jul)?0:round((($medi_act_jul+$mino_act_jul) * 100000)/$wor_act_jul)))?></td>
            <td class="column19 style64"></td>
            <td class="column20 style43 f"><?=(is_nan(((($medi_act_aug+$mino_act_aug) * 100000)/$wor_act_aug))?0:(is_infinite((($medi_act_aug+$mino_act_aug) * 100000)/$wor_act_aug)?0:round((($medi_act_aug+$mino_act_aug) * 100000)/$wor_act_aug)))?></td>
            <td class="column21 style64"></td>
            <td class="column22 style44 f"><?=(is_nan(((($medi_act_sep+$mino_act_sep) * 100000)/$wor_act_sep))?0:(is_infinite((($medi_act_sep+$mino_act_sep) * 100000)/$wor_act_sep)?0:round((($medi_act_sep+$mino_act_sep) * 100000)/$wor_act_sep)))?></td>
            <td class="column23 style31"></td>
            <td class="column24 style32 f"><?=(is_nan(((($Q3_medi_actual+$Q3_mino_actual) * 100000)/$Q3_wor_actual))?0:(is_infinite((($Q3_medi_actual+$Q3_mino_actual) * 100000)/$Q3_wor_actual)?0:round((($Q3_medi_actual+$Q3_mino_actual) * 100000)/$Q3_wor_actual)))?></td>
            <td class="column25 style36"></td>
            <td class="column26 style43 f"><?=(is_nan(((($medi_act_oct+$mino_act_oct) * 100000)/$wor_act_oct))?0:(is_infinite((($medi_act_oct+$mino_act_oct) * 100000)/$wor_act_oct)?0:round((($medi_act_oct+$mino_act_oct) * 100000)/$wor_act_oct)))?></td>
            <td class="column27 style64"></td>
            <td class="column28 style43 f"><?=(is_nan(((($medi_act_nov+$mino_act_nov) * 100000)/$wor_act_nov))?0:(is_infinite((($medi_act_nov+$mino_act_nov) * 100000)/$wor_act_nov)?0:round((($medi_act_nov+$mino_act_nov) * 100000)/$wor_act_nov)))?></td>
            <td class="column29 style64"></td>
            <td class="column30 style44 f"><?=(is_nan(((($medi_act_dec+$mino_act_dec) * 100000)/$wor_act_dec))?0:(is_infinite((($medi_act_dec+$mino_act_dec) * 100000)/$wor_act_dec)?0:round((($medi_act_dec+$mino_act_dec) * 100000)/$wor_act_dec)))?></td>
            <td class="column31 style31"></td>
            <td class="column32 style32 f"><?=(is_nan(((($Q4_medi_actual+$Q4_mino_actual) * 100000)/$Q4_wor_actual))?0:(is_infinite((($Q4_medi_actual+$Q4_mino_actual) * 100000)/$Q4_wor_actual)?0:round((($Q4_medi_actual+$Q4_mino_actual) * 100000)/$Q4_wor_actual)))?></td>
            <td class="column33 style36"></td>
            <td class="column34 style95 f"><?=(is_nan((($Q1_non_reportable+$Q2_non_reportable+$Q3_non_reportable+$Q4_non_reportable) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual))?0:round((($Q1_non_reportable+$Q2_non_reportable+$Q3_non_reportable+$Q4_non_reportable) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual),2))?></td>
        </tr>
        <tr class="row23">
            <td class="column0 style93 s">Accident Frequency Rates (AFR)</td>
            <td class="column1 style66"></td>
            <td class="column2 style65 f"><?=(is_nan((($ridd_act_jan * 100000)/$wor_act_jan))?0:(is_infinite(($ridd_act_jan * 100000)/$wor_act_jan)?0:round(($ridd_act_jan * 100000)/$wor_act_jan)))?></td>
            <td class="column3 style66"></td>
            <td class="column4 style65 f"><?=(is_nan((($ridd_act_feb * 100000)/$wor_act_feb))?0:(is_infinite(($ridd_act_feb * 100000)/$wor_act_feb)?0:round(($ridd_act_feb * 100000)/$wor_act_feb)))?></td>
            <td class="column5 style66"></td>
            <td class="column6 style35 f"><?=(is_nan((($ridd_act_mar * 100000)/$wor_act_mar))?0:(is_infinite(($ridd_act_mar * 100000)/$wor_act_mar)?0:round(($ridd_act_mar * 100000)/$wor_act_mar)))?></td>
            <td class="column7 style33"></td>
            <td class="column8 style57 f"><?=(is_nan((($Q1_ridd_actual * 100000)/$Q1_wor_actual))?0:(is_infinite((($Q1_ridd_actual * 100000)/$Q1_wor_actual))?0:round(($Q1_ridd_actual * 100000)/$Q1_wor_actual)))?></td>
            <td class="column9 style66"></td>
            <td class="column10 style65 f"><?=(is_nan((($ridd_act_apr * 100000)/$wor_act_apr))?0:(is_infinite(($ridd_act_apr * 100000)/$wor_act_apr)?0:round(($ridd_act_apr * 100000)/$wor_act_apr)))?></td>
            <td class="column11 style66"></td>
            <td class="column12 style65 f"><?=(is_nan((($ridd_act_may * 100000)/$wor_act_may))?0:(is_infinite(($ridd_act_may * 100000)/$wor_act_may)?0:round(($ridd_act_may * 100000)/$wor_act_may)))?></td>
            <td class="column13 style66"></td>
            <td class="column14 style35 f"><?=(is_nan((($ridd_act_jun * 100000)/$wor_act_jun))?0:(is_infinite(($ridd_act_jun * 100000)/$wor_act_jun)?0:round(($ridd_act_jun * 100000)/$wor_act_jun)))?></td>
            <td class="column15 style33"></td>
            <td class="column16 style57 f"><?=(is_nan((($Q2_ridd_actual * 100000)/$Q2_wor_actual))?0:(is_infinite((($Q2_ridd_actual * 100000)/$Q2_wor_actual))?0:round(($Q2_ridd_actual * 100000)/$Q2_wor_actual)))?></td>
            <td class="column17 style66"></td>
            <td class="column18 style65 f"><?=(is_nan((($ridd_act_jul * 100000)/$wor_act_jul))?0:(is_infinite(($ridd_act_jul * 100000)/$wor_act_jul)?0:round(($ridd_act_jul * 100000)/$wor_act_jul)))?></td>
            <td class="column19 style66"></td>
            <td class="column20 style65 f"><?=(is_nan((($ridd_act_aug * 100000)/$wor_act_aug))?0:(is_infinite(($ridd_act_aug * 100000)/$wor_act_aug)?0:round(($ridd_act_aug * 100000)/$wor_act_aug)))?></td>
            <td class="column21 style66"></td>
            <td class="column22 style35 f"><?=(is_nan((($ridd_act_sep * 100000)/$wor_act_sep))?0:(is_infinite(($ridd_act_sep * 100000)/$wor_act_sep)?0:round(($ridd_act_sep * 100000)/$wor_act_sep)))?></td>
            <td class="column23 style33"></td>
            <td class="column24 style57 f"><?=(is_nan((($Q3_ridd_actual * 100000)/$Q3_wor_actual))?0:(is_infinite((($Q3_ridd_actual * 100000)/$Q3_wor_actual))?0:round(($Q3_ridd_actual * 100000)/$Q3_wor_actual)))?></td>
            <td class="column25 style66"></td>
            <td class="column26 style65 f"><?=(is_nan((($ridd_act_oct * 100000)/$wor_act_oct))?0:(is_infinite(($ridd_act_oct * 100000)/$wor_act_oct)?0:round(($ridd_act_oct * 100000)/$wor_act_oct)))?></td>
            <td class="column27 style66"></td>
            <td class="column28 style65 f"><?=(is_nan((($ridd_act_nov * 100000)/$wor_act_nov))?0:(is_infinite(($ridd_act_nov * 100000)/$wor_act_nov)?0:round(($ridd_act_nov * 100000)/$wor_act_nov)))?></td>
            <td class="column29 style66"></td>
            <td class="column30 style35 f"><?=(is_nan((($ridd_act_dec * 100000)/$wor_act_dec))?0:(is_infinite(($ridd_act_dec * 100000)/$wor_act_dec)?0:round(($ridd_act_dec * 100000)/$wor_act_dec)))?></td>
            <td class="column31 style33"></td>
            <td class="column32 style57 f"><?=(is_nan((($Q4_ridd_actual * 100000)/$Q4_wor_actual))?0:(is_infinite((($Q4_ridd_actual * 100000)/$Q4_wor_actual))?0:round(($Q4_ridd_actual * 100000)/$Q4_wor_actual)))?></td>
            <td class="column33 style66"></td>
            <td class="column34 style58 f"><?=(is_nan(((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual)))?0:(is_infinite((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual))?0:round((($Q1_ridd_actual+$Q2_ridd_actual+$Q3_ridd_actual+$Q4_ridd_actual) * 100000)/($Q1_wor_actual+$Q2_wor_actual+$Q3_wor_actual+$Q4_wor_actual))))?></td>
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
            <td class="column1 style67 n style67" colspan="2">Jan <br> <?=$filterData['year']?></td>
            <td class="column3 style67 n style67" colspan="2">Feb <br> <?=$filterData['year']?></td>
            <td class="column5 style67 n style76" colspan="2">Mar <br> <?=$filterData['year']?></td>
            <td class="column7 style3 s">Q1</td>
            <td class="column8 style4 s">Q1</td>
            <td class="column9 style69 n style67" colspan="2">Apr <br> <?=$filterData['year']?></td>
            <td class="column11 style67 n style67" colspan="2">May <br> <?=$filterData['year']?></td>
            <td class="column13 style67 n style67" colspan="2">Jun <br> <?=$filterData['year']?></td>
            <td class="column15 style4 s">Q2</td>
            <td class="column16 style4 s">Q2</td>
            <td class="column17 style67 n style67" colspan="2">Jul <br> <?=$filterData['year']?></td>
            <td class="column19 style67 n style67" colspan="2">Aug <br> <?=$filterData['year']?></td>
            <td class="column21 style67 n style67" colspan="2">Sep <br> <?=$filterData['year']?></td>
            <td class="column23 style4 s">Q3</td>
            <td class="column24 style4 s">Q3</td>
            <td class="column25 style67 n style67" colspan="2">Oct <br> <?=$filterData['year']?></td>
            <td class="column27 style67 n style67" colspan="2">Nov <br> <?=$filterData['year']?></td>
            <td class="column29 style67 n style67" colspan="2">Dec <br> <?=$filterData['year']?></td>
            <td class="column31 style4 s">Q4</td>
            <td class="column32 style4 s">Q4</td>
            <td class="column33 style68 s style68" colspan="2">YTD</td>
        </tr>
        <tr class="row27">
            <td class="column1 style6 s tar-act">Tar</td>
            <td class="column2 style6 s tar-act">Act</td>
            <td class="column3 style6 s tar-act">Tar</td>
            <td class="column4 style6 s tar-act">Act</td>
            <td class="column5 style6 s tar-act">Tar</td>
            <td class="column6 style1 s tar-act">Act</td>
            <td class="column7 style7 s tar-act">Tar</td>
            <td class="column8 style5 s tar-act">Act</td>
            <td class="column9 style2 s tar-act">Tar</td>
            <td class="column10 style6 s tar-act">Act</td>
            <td class="column11 style6 s tar-act">Tar</td>
            <td class="column12 style6 s tar-act">Act</td>
            <td class="column13 style6 s tar-act">Tar</td>
            <td class="column14 style6 s tar-act">Act</td>
            <td class="column15 style7 s tar-act">Tar</td>
            <td class="column16 style5 s tar-act">Act</td>
            <td class="column17 style6 s tar-act">Tar</td>
            <td class="column18 style6 s tar-act">Act</td>
            <td class="column19 style6 s tar-act">Tar</td>
            <td class="column20 style6 s tar-act">Act</td>
            <td class="column21 style6 s tar-act">Tar</td>
            <td class="column22 style6 s tar-act">Act</td>
            <td class="column23 style7 s tar-act">Tar</td>
            <td class="column24 style5 s tar-act">Act</td>
            <td class="column25 style6 s tar-act">Tar</td>
            <td class="column26 style6 s tar-act">Act</td>
            <td class="column27 style6 s tar-act">Tar</td>
            <td class="column28 style6 s tar-act">Act</td>
            <td class="column29 style6 s tar-act">Tar</td>
            <td class="column30 style6 s tar-act">Act</td>
            <td class="column31 style7 s tar-act">Tar</td>
            <td class="column32 style5 s tar-act">Act</td>
            <td class="column33 style6 s tar-act">Tar</td>
            <td class="column34 style6 s tar-act">Act</td>
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
            <td class="column0 style37 s">Toolbox Talks / Safety Briefings delivered</td>
            <td class="column1 style38 n"><?=$tosa_tar_jan?></td>
            <td class="column2 style39 n" <?=$tosa_act_jan_cell_color?>><?=$tosa_act_jan?></td>
            <td class="column3 style40 n"><?=$tosa_tar_feb?></td>
            <td class="column4 style39 n" <?=$tosa_act_feb_cell_color?>><?=$tosa_act_feb?></td>
            <td class="column5 style38 n"><?=$tosa_tar_mar?></td>
            <td class="column6 style27 n" <?=$tosa_act_mar_cell_color?>><?=$tosa_act_mar?></td>
            <td class="column7 style29 n"><?=$Q1_tosa_target?></td>
            <td class="column8 style52 n" <?=$Q1_tosa_actual_cell_color?>><?=$Q1_tosa_actual?></td>
            <td class="column9 style40 n"><?=$tosa_tar_apr?></td>
            <td class="column10 style39 n" <?=$tosa_act_apr_cell_color?>><?=$tosa_act_apr?></td>
            <td class="column11 style38 n"><?=$tosa_tar_may?></td>
            <td class="column12 style39 n" <?=$tosa_act_may_cell_color?>><?=$tosa_act_may?></td>
            <td class="column13 style38 n"><?=$tosa_tar_jun?></td>
            <td class="column14 style27 n" <?=$tosa_act_jun_cell_color?>><?=$tosa_act_jun?></td>
            <td class="column15 style29 n"><?=$Q2_tosa_target?></td>
            <td class="column16 style52 n" <?=$Q2_tosa_actual_cell_color?>><?=$Q2_tosa_actual?></td>
            <td class="column17 style40 n"><?=$tosa_tar_jul?></td>
            <td class="column18 style39 n" <?=$tosa_act_jul_cell_color?>><?=$tosa_act_jul?></td>
            <td class="column19 style38 n"><?=$tosa_tar_aug?></td>
            <td class="column20 style39 n" <?=$tosa_act_aug_cell_color?>><?=$tosa_act_aug?></td>
            <td class="column21 style38 n"><?=$tosa_tar_sep?></td>
            <td class="column22 style27 n" <?=$tosa_act_sep_cell_color?>><?=$tosa_act_sep?></td>
            <td class="column23 style29 n"><?=$Q3_tosa_target?></td>
            <td class="column24 style52 n" <?=$Q3_tosa_actual_cell_color?>><?=$Q3_tosa_actual?></td>
            <td class="column25 style40 n"><?=$tosa_tar_oct?></td>
            <td class="column26 style39 n" <?=$tosa_act_oct_cell_color?>><?=$tosa_act_oct?></td>
            <td class="column27 style38 n"><?=$tosa_tar_nov?></td>
            <td class="column28 style39 n" <?=$tosa_act_nov_cell_color?>><?=$tosa_act_nov?></td>
            <td class="column29 style38 n"><?=$tosa_tar_dec?></td>
            <td class="column30 style27 n" <?=$tosa_act_dec_cell_color?>><?=$tosa_act_dec?></td>
            <td class="column31 style29 n"><?=$Q4_tosa_target?></td>
            <td class="column32 style52 n" <?=$Q4_tosa_actual_cell_color?>><?=$Q4_tosa_actual?></td>
            <td class="column33 style40 n"><?=($Q1_tosa_target+$Q2_tosa_target+$Q3_tosa_target+$Q4_tosa_target)?></td>
            <td class="column34 style53 n" <?=$YTD_tosa_actual_cell_color?>><?=($Q1_tosa_actual+$Q2_tosa_actual+$Q3_tosa_actual+$Q4_tosa_actual)?></td>
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
            <td class="column0 style41 s">No of Site Audits</td>
            <td class="column1 style10 n"><?=$siau_tar_jan?></td>
            <td class="column2 style12 n" <?=$numa_act_jan_cell_color?>><?=$numa_act_jan?></td>
            <td class="column3 style15 n"><?=$siau_tar_feb?></td>
            <td class="column4 style12 n" <?=$numa_act_feb_cell_color?>><?=$numa_act_feb?></td>
            <td class="column5 style10 n"><?=$siau_tar_mar?></td>
            <td class="column6 style11 n" <?=$numa_act_mar_cell_color?>><?=$numa_act_mar?></td>
            <td class="column7 style13 n"><?=$Q1_siau_target?></td>
            <td class="column8 style14 n" <?=$Q1_numa_actual_cell_color?>><?=$Q1_numa_actual?></td>
            <td class="column9 style15 n"><?=$siau_tar_apr?></td>
            <td class="column10 style12 n" <?=$numa_act_apr_cell_color?>><?=$numa_act_apr?></td>
            <td class="column11 style10 n"><?=$siau_tar_may?></td>
            <td class="column12 style12 n" <?=$numa_act_may_cell_color?>><?=$numa_act_may?></td>
            <td class="column13 style10 n"><?=$siau_tar_jun?></td>
            <td class="column14 style11 n" <?=$numa_act_jun_cell_color?>><?=$numa_act_jun?></td>
            <td class="column15 style13 n"><?=$Q2_siau_target?></td>
            <td class="column16 style14 n" <?=$Q2_numa_actual_cell_color?>><?=$Q2_numa_actual?></td>
            <td class="column17 style15 n"><?=$siau_tar_jul?></td>
            <td class="column18 style12 n" <?=$numa_act_jul_cell_color?>><?=$numa_act_jul?></td>
            <td class="column19 style10 n"><?=$siau_tar_aug?></td>
            <td class="column20 style12 n" <?=$numa_act_aug_cell_color?>><?=$numa_act_aug?></td>
            <td class="column21 style10 n"><?=$siau_tar_sep?></td>
            <td class="column22 style11 n" <?=$numa_act_sep_cell_color?>><?=$numa_act_sep?></td>
            <td class="column23 style13 n"><?=$Q3_siau_target?></td>
            <td class="column24 style14 n" <?=$Q3_numa_actual_cell_color?>><?=$Q3_numa_actual?></td>
            <td class="column25 style15 n"><?=$siau_tar_oct?></td>
            <td class="column26 style12 n" <?=$numa_act_oct_cell_color?>><?=$numa_act_oct?></td>
            <td class="column27 style10 n"><?=$siau_tar_nov?></td>
            <td class="column28 style12 n" <?=$numa_act_nov_cell_color?>><?=$numa_act_nov?></td>
            <td class="column29 style10 n"><?=$siau_tar_dec?></td>
            <td class="column30 style11 n" <?=$numa_act_dec_cell_color?>><?=$numa_act_dec?></td>
            <td class="column31 style13 n"><?=$Q4_siau_target?></td>
            <td class="column32 style14 n" <?=$Q4_numa_actual_cell_color?>><?=$Q4_numa_actual?></td>
            <td class="column33 style15 n"><?=($Q1_siau_target+$Q2_siau_target+$Q3_siau_target+$Q4_siau_target)?></td>
            <td class="column34 style94 n" <?=$YTD_numa_actual_cell_color?>><?=($Q1_numa_actual+$Q2_numa_actual+$Q3_numa_actual+$Q4_numa_actual)?></td>
        </tr>
        <tr class="row32">
            <td class="column0 style89 s">Audit Recommendations</td>
            <td class="column1 style64"></td>
            <td class="column2 style18 n"><?=$audr_act_jan?></td>
            <td class="column3 style64"></td>
            <td class="column4 style18 n"><?=$audr_act_feb?></td>
            <td class="column5 style64"></td>
            <td class="column6 style17 n"><?=$audr_act_mar?></td>
            <td class="column7 style34"></td>
            <td class="column8 style20 n"><?=$Q1_audr_actual?></td>
            <td class="column9 style36"></td>
            <td class="column10 style18 n"><?=$audr_act_apr?></td>
            <td class="column11 style64"></td>
            <td class="column12 style18 n"><?=$audr_act_may?></td>
            <td class="column13 style64"></td>
            <td class="column14 style17 n"><?=$audr_act_jun?></td>
            <td class="column15 style34"></td>
            <td class="column16 style20 n"><?=$Q2_audr_actual?></td>
            <td class="column17 style36"></td>
            <td class="column18 style17 n"><?=$audr_act_jul?></td>
            <td class="column19 style64"></td>
            <td class="column20 style18 n"><?=$audr_act_aug?></td>
            <td class="column21 style64"></td>
            <td class="column22 style17 n"><?=$audr_act_sep?></td>
            <td class="column23 style34"></td>
            <td class="column24 style20 n"><?=$Q3_audr_actual?></td>
            <td class="column25 style17"></td>
            <td class="column26 style18 n"><?=$audr_act_oct?></td>
            <td class="column27 style17"></td>
            <td class="column28 style18 n"><?=$audr_act_nov?></td>
            <td class="column29 style17"></td>
            <td class="column30 style17 n"><?=$audr_act_dec?></td>
            <td class="column31 style34"></td>
            <td class="column32 style20 n"><?=$Q4_audr_actual?></td>
            <td class="column33 style36"></td>
            <td class="column34 style95 n"><?=($Q1_audr_actual+$Q2_audr_actual+$Q3_audr_actual+$Q4_audr_actual)?></td>
        </tr>
        <tr class="row33">
            <td class="column0 style93 s">Outstanding Recommendations</td>
            <td class="column1 style66"></td>
            <td class="column2 style65 n"><?=$outr_act_jan?></td>
            <td class="column3 style66"></td>
            <td class="column4 style65 n"><?=$outr_act_feb?></td>
            <td class="column5 style66"></td>
            <td class="column6 style35 n"><?=$outr_act_mar?></td>
            <td class="column7 style33"></td>
            <td class="column8 style57 n"><?=$Q1_outr_actual?></td>
            <td class="column9 style66"></td>
            <td class="column10 style65 n"><?=$outr_act_apr?></td>
            <td class="column11 style66"></td>
            <td class="column12 style65 n"><?=$outr_act_may?></td>
            <td class="column13 style66"></td>
            <td class="column14 style35 n"><?=$outr_act_jun?></td>
            <td class="column15 style33"></td>
            <td class="column16 style57 n"><?=$Q2_outr_actual?></td>
            <td class="column17 style66"></td>
            <td class="column18 style65 n"><?=$outr_act_jul?></td>
            <td class="column19 style66"></td>
            <td class="column20 style65 n"><?=$outr_act_aug?></td>
            <td class="column21 style66"></td>
            <td class="column22 style35 n"><?=$outr_act_sep?></td>
            <td class="column23 style33"></td>
            <td class="column24 style57 n"><?=$Q3_outr_actual?></td>
            <td class="column25 style66"></td>
            <td class="column26 style65 n"><?=$outr_act_oct?></td>
            <td class="column27 style66"></td>
            <td class="column28 style65 n"><?=$outr_act_nov?></td>
            <td class="column29 style66"></td>
            <td class="column30 style35 n"><?=$outr_act_dec?></td>
            <td class="column31 style33"></td>
            <td class="column32 style57 n"><?=$Q4_outr_actual?></td>
            <td class="column33 style66"></td>
            <td class="column34 style58 n"><?=($Q1_outr_actual+$Q2_outr_actual+$Q3_outr_actual+$Q4_outr_actual)?></td>
        </tr>
    </table>

<?php
$html = ob_get_contents();
ob_clean();
global $SESSION;
$SESSION->pdf_html_data = $html;
//echo $html;
?>