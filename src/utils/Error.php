<?php
namespace utils;

class Error
{
  static public $ERROR_TYPES = [
    'ERR_EMPTY_NAME' => false,
    'ERR_EMPTY_EMAIL' => false,
    'ERR_EMPTY_PASSWORD' => false,
    'ERR_EMPTY_CONFIRM_PASSWORD' => false,
    'ERR_INVALID_NAME' => false,
    'ERR_INVALID_EMAIL' => false,
    'ERR_INVALID_PASSWORD' => false,
    'ERR_INVALID_CONFIRM_PASSWORD' => false,
    'ERR_ALL_FIELDS_EMPTY' => false,
    'ERR_EMAIL_ALREADY_REGISTERED' => false,
    'ERR_REGISTRATION_FAILED' => false,
    'ERR_LOGIN_FAILED' => false,
    'ERR_INCORRECT_EMAIL_OR_PASSWORD' => false,
    'ERROR_UPDATING_USER' => false
  ];

  static public $ERROR_MSG = [
    'ERR_EMPTY_NAME' => 'The name cannot be empty.',
    'ERR_EMPTY_EMAIL' => 'The email cannot be empty.',
    'ERR_EMPTY_PASSWORD' => 'The password cannot be empty.',
    'ERR_EMPTY_CONFIRM_PASSWORD' => 'The confirm password cannot be empty.',
    'ERR_INVALID_NAME' => 'Only letters and spaces.',
    'ERR_INVALID_EMAIL' => 'Invalid email format.',
    'ERR_INVALID_PASSWORD' => 'The password must have at least 8 characters.',
    'ERR_INVALID_CONFIRM_PASSWORD' => 'Password confirmation is incorrect.',
    'ERR_ALL_FIELDS_EMPTY' => 'All fields are mandatory.',
    'ERR_EMAIL_ALREADY_REGISTERED' => 'This email is already registered on the platform.',
    'ERR_REGISTRATION_FAILED' => 'Failed to register user.',
    'ERR_LOGIN_FAILED' => 'Login failed.',
    'ERR_INCORRECT_EMAIL_OR_PASSWORD' => 'Invalid email or password.',
    'ERROR_UPDATING_USER' => 'Error updating profile.'
  ];

  static public function setError($errorType, $state)
  {
    self::$ERROR_TYPES[$errorType] = $state;
  }

  static public function clearErrors()
  {
    foreach (self::$ERROR_TYPES as $error => $state) {
      $state = false;
    }
  }
}