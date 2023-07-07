<?php

function removeUnnecessarySpaces($string)
{
  return preg_replace('/\\s\\s+/', ' ', $string);
}