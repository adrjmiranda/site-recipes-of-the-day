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
    'ERROR_UPDATING_USER' => false,
    'ERR_UPDATE_PROFILE_IMAGE' => false,
    'ERR_INVALID_IMAGE_TYPE' => false,
    // add recipe form
    'ERR_EMPTY_TITLE' => false,
    'ERR_EMPTY_PORTIONS' => false,
    'ERR_EMPTY_PREPARATION_TIME' => false,
    'ERR_EMPTY_CATEGORY' => false,
    'ERR_EMPTY_INGREDIENTS' => false,
    'ERR_EMPTY_METHOD_PREPARATION' => false,
    'ERR_EMPTY_TIPS' => false,
    'ERR_TOO_LARGE_IMAGE' => false,
    'ERR_FILURE_TO_ADD_RECIPE' => false
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
    'ERROR_UPDATING_USER' => 'Error updating profile.',
    'ERR_UPDATE_PROFILE_IMAGE' => 'Error updating image.',
    'ERR_INVALID_IMAGE_TYPE' => 'Only jpeg, jpg or png images allowed.',
    // add recipe form
    'ERR_EMPTY_TITLE' => 'The title cannot be empty.',
    'ERR_EMPTY_PORTIONS' => 'Portions cannot be empty.',
    'ERR_EMPTY_PREPARATION_TIME' => 'The preparation time cannot be empty.',
    'ERR_EMPTY_CATEGORY' => 'The preparation time cannot be empty.',
    'ERR_EMPTY_INGREDIENTS' => 'Ingredients cannot be empty.',
    'ERR_EMPTY_METHOD_PREPARATION' => 'You need to add a brewing method.',
    'ERR_EMPTY_TIPS' => 'You need to add the preparation tips.',
    'ERR_TOO_LARGE_IMAGE' => 'The image must be a maximum of 2MB in size.',
    'ERR_FILURE_TO_ADD_RECIPE' => 'It was not possible to add the recipe to the bank, check the data and try again.'
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