<?php class wpSEO_Transients{public static function get($key, $callback){if(empty($key)or empty($callback)){return false;}$transients=self::_all(); if(!empty($transients)&& array_key_exists($key, $transients)){return $transients[$key];}return self::_update($key, $callback);}public static function delete($keys){if(empty($keys)){return false;}if(!is_array($keys)){$keys=array($keys);}$cache=wp_cache_get('wpseo'); $cache['transient']=self::_all(); foreach($keys as $key){unset($cache['transient'][$key]);}set_transient('wpseo', $cache['transient'], 60*60*24); wp_cache_set('wpseo', $cache);}private static function _update($key, $callback){if(empty($key)or empty($callback)or !is_callable($callback)){return false;}if(($response=call_user_func($callback))===false){return false;}$cache=wp_cache_get('wpseo'); $cache['transient']=self::_all(); $cache['transient'][$key]=$response; set_transient('wpseo', $cache['transient'], 60*60*24); wp_cache_set('wpseo', $cache); return $response;}private static function _all(){$cache=wp_cache_get('wpseo'); if(empty($cache['transient'])){$cache['transient']=get_transient('wpseo'); wp_cache_set('wpseo', $cache);}return(array)$cache['transient'];}}