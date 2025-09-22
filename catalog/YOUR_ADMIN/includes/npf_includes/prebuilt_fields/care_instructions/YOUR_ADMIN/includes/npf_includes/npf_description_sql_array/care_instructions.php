<?php

$sql_data_array['care_instructions'] = isset($_POST['care_instructions'][$language_id]) ? zen_db_prepare_input($_POST['care_instructions'][$language_id]) : '';
