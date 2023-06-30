<?php

function isEmpty($input)
{
  return !$input;
}

function isInvalidName($name)
{
  return !preg_match('/^([a-zA-Zà-úÀ-Ú]|\s)+$/', $name) || !is_string($name);
}

function isInvalidEmail($email)
{
  return !filter_var($email, FILTER_VALIDATE_EMAIL) || !is_string($email);
}

function isInvalidPassword($password)
{
  return (strlen($password) < 8) || !is_string($password);
}

function ifPasswordAndPasswordConfirmationDoNotMatch($password, $confirm_password)
{
  return !($password === $confirm_password) || isInvalidPassword($password);
}