<?php class wpSEO_Media{private static function _sanitize($str){if(empty($str)){return;}$str=seems_utf8($str)? mb_strtolower($str, 'UTF-8'): strtolower($str); $str=preg_replace(array('/[àáâãå]/u', '/[ä]/u', '/[èéêë]/u', '/[ìíîïı]/u', '/[ðòóôõø]/u', '/[öœ]/u', '/[ùúû]/u', '/[ü]/u', '/[çć]/u', '/[þđ]/u', '/[ñ]/u', '/[şš]/u', '/[ß]/u', '/[ýÿ]/u', '/[ğ]/u', '/[ž]/u'), array('a', 'ae', 'e', 'i', 'o', 'oe', 'u', 'ue', 'c', 'd', 'n', 's', 'ss', 'y', 'g', 'z'), $str); $str=sanitize_title_with_dashes($str); return $str;}public static function rename($post, $attach){if(empty($_REQUEST['save'])){return $post;}if(empty($attach['post_title'])or empty($post['post_name'])){return $post;}$old=array(); $new=array(); $id=$post['ID']; $title=$attach['post_title']; $sanitize=sanitize_title($title); if(empty($sanitize)or $post['post_name']==$sanitize or preg_match('/^' .preg_quote($sanitize). '-[0-9]{1,}$/', $post['post_name'])){return $post;}$title=self::_sanitize($title); if(wpSEO_Options::get('misc_attachment_limit')){$title=implode('-', array_filter(explode('-', $title), create_function('$v', 'return strlen($v)> 3;')));}if(empty($title)){return $post;}$old['file']=get_attached_file($id); $old['name']=basename($old['file']); $old['ext']=pathinfo($old['name'], PATHINFO_EXTENSION); $old['short']=pathinfo($old['name'], PATHINFO_FILENAME); $old['dir']=dirname($old['file']). DIRECTORY_SEPARATOR; $new['dir']=$old['dir']; $new['ext']=$old['ext']; $new['name']=wp_unique_filename($new['dir'], sprintf('%s.%s', $title, $new['ext'])); $new['short']=pathinfo($new['name'], PATHINFO_FILENAME); $new['file']=sprintf('%s%s', $new['dir'], $new['name']); if(file_exists($new['file'])){return $post;}if(rename($old['file'], $new['file'])===false){return $post;}$post['post_name']=$sanitize; $post['guid']=sprintf('%s%s%s', dirname($post['guid']), DIRECTORY_SEPARATOR, $new['name']); $old['meta']=wp_get_attachment_metadata($id); $new['meta']=$old['meta']; $new['meta']['file']=$new['file']; if(!empty($old['meta']['sizes'])){foreach($old['meta']['sizes'] as $size=> $data){$new['meta']['sizes'][$size]['file']=str_replace($old['short']. '-', $new['short']. '-', $data['file']); @rename(sprintf('%s%s', $old['dir'], $old['meta']['sizes'][$size]['file']), sprintf('%s%s', $new['dir'], $new['meta']['sizes'][$size]['file']));}}wp_update_attachment_metadata($id, $new['meta']); update_attached_file($id, $new['file']); return $post;}public static function complete(){if(empty($_POST['attachments'])or !is_array($_POST['attachments'])){return;}foreach($_POST['attachments'] as $id=> $attach){if(isset($attach['image_alt'])&& empty($attach['image_alt'])&& !empty($attach['post_title'])&& strcmp($attach['image_alt'], $attach['post_title'])!=0){$_POST['attachments'][$id]['image_alt']=$attach['post_title'];}}return true;}}