<?php

require_once __DIR__ . '/../../utils/validations.php';

function isInvalidTitle($title)
{
  return !preg_match('/^([a-zA-Zà-úÀ-Ú]|\s)+$/', $title) || !is_string($title);
}

function isInvalidPortions($portions)
{
  $portions_value = intval($portions);

  return !(intval($portions) && $portions_value > 0 && is_numeric($portions));
}

function isInvalidPreparationTime($preparation_time)
{
  $preparation_time_value = intval($preparation_time);

  return !(intval($preparation_time) && $preparation_time_value > 0 && is_numeric($preparation_time));
}

function isInvalidCategory($category)
{
  return !preg_match('/^([a-zA-Zà-úÀ-Ú]|\s)+$/', $category) || !is_string($category);
}