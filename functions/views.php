<?php

function selectList($resultSet, $fields, $value, $default)
{
    $return = "<option value='' selected disabled>$default</option>";
    foreach ($resultSet as $row) {
        $cod = $row[$fields[0]];
        $content = $row[$fields[1]];
        $return .= "<option value='$cod'";
        $return .= $value == $cod ? " Selected " : "";
        $return .= "> $content </option>";
    }
    return $return;
}
