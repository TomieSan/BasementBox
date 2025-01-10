<?php
function build_sort_option($name, $criteria, $direction, $isDefault = false)
{
  $value = url()->current().'?'.http_build_query(array_merge(request()->except('page'), ['criteria'=>$criteria, 'direction'=>$direction]));
  $showAsDefault = !(request()->has($criteria) && request()->has($direction)) && $isDefault;
  $sortMatches = (request('criteria') === $criteria && request('direction') === $direction);
  $selectState = ($showAsDefault || $sortMatches) ? 'selected' : '';
  return sprintf("<option value='%s' %s>%s</option>\n", $value, $selectState, $name);
}