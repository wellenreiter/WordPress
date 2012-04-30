<?php class wpSEO_Meta{public static function init(){if(wpSEO_Feedback::get('critical')){return;}$types=get_post_types(array('show_ui'=> true), 'names'); if(empty($types)){return;}foreach($types as $type){add_meta_box('wpseo_edit_box', 'wpSEO', array('wpSEO_Meta', 'show'), $type);}add_action('admin_print_styles', array('wpSEO_Meta', 'add_css')); add_action('admin_print_scripts', array('wpSEO_Meta', 'add_js'));}public static function add_css(){$options=wpSEO_Options::get(); wp_register_style('wpseo_meta', wpSEO::plugin_url('css/meta.css')); wp_enqueue_style('wpseo_meta'); if($options['title_suggest'] or $options['desc_suggest'] or $options['key_suggest']){wp_register_style('wpseo_suggest', wpSEO::plugin_url('css/suggest.css')); wp_enqueue_style('wpseo_suggest');}}public static function add_js(){$options=wpSEO_Options::get(); wp_register_script('wpseo_meta', wpSEO::plugin_url('js/meta.js'), array('jquery')); wp_enqueue_script('wpseo_meta'); if($options['title_suggest'] or $options['desc_suggest'] or $options['key_suggest']){wp_register_script('wpseo_suggest', wpSEO::plugin_url('js/suggest.js'), array('jquery')); wp_enqueue_script('wpseo_suggest'); $items=array('title'=> '#_wpseo_edit_title', 'desc'=> '#_wpseo_edit_description', 'key'=> '#_wpseo_edit_keywords'); if(!$options['title_suggest']){unset($items['title']);}if(!$options['desc_suggest']){unset($items['desc']);}if(!$options['key_suggest']){unset($items['key']);}wp_localize_script('wpseo_suggest', 'wpseo_vars', array('lang'=> wpSEO_Base::get_lang(), 'items'=> implode(', ', $items)));}}public static function update($id){if(empty($_POST['_wpseo_nonce'])){return $id;}if(wpSEO_Feedback::get('critical')){return $id;}if(!wp_verify_nonce($_POST['_wpseo_nonce'], WPSEO_BASE)){return $id;}if($_POST['post_ID'] !=$id){return $id;}if(empty($_POST['post_type'])or !in_array($_POST['post_type'], array('post', 'page'))){if(($_POST['post_type']=='page' && !current_user_can('edit_page', $id))or($_POST['post_type']=='post' && !current_user_can('edit_post', $id))){return $id;}}foreach(wpSEO_Vars::get('custom_fields')as $field){$current=self::get($field, $id); if(empty($_POST[$field])){$future='';}else{$future=$_POST[$field]; if(in_array($field, array('_wpseo_edit_canonical', '_wpseo_edit_redirect'))){$future=esc_url_raw($future);}else{$future=sanitize_text_field($future); $future=trim($future, ', ');}}if(!empty($future)&& !empty($current)&& $future !=$current){update_post_meta($id, $field, $future);}else if(empty($future)&& !empty($current)){delete_post_meta($id, $field);}else if(!empty($future)&& empty($current)){add_post_meta($id, $field, $future, true);}}return $id;}public static function delete($id){if(empty($id)){return;}foreach(wpSEO_Vars::get('custom_fields')as $field){delete_post_meta((int)$id, $field);}}public static function get($field, $id=null){return get_post_meta(self::id($id), $field, true);}public static function id($id=null){if(!empty($id)){return(int)$id;}if(!empty($GLOBALS['post']->ID)){return(int)$GLOBALS['post']->ID;}return(int)$GLOBALS['wp_query']->get_queried_object_id();}public static function show(){wp_nonce_field(WPSEO_BASE, '_wpseo_nonce'); $options=wpSEO_Options::get(); if($options['title_manually']){?>			<table>				<tr>					<th>						<div>							<strong><?php esc_html_e('Please note the limit', 'wpseo')?></strong>							<span><?php esc_html_e('Words', 'wpseo')?>: <span>0</span> / <?php esc_html_e('Chars', 'wpseo')?>: <span title="<?php esc_attr_e('Recommended', 'wpseo')?>">60</span> - <span title="<?php esc_attr_e('Typed', 'wpseo')?>">0</span> = <span title="<?php esc_attr_e('Left', 'wpseo')?>">60</span></span>							<label for="_wpseo_edit_title"><?php esc_html_e('Title', 'wpseo')?></label>						</div>					</th>				</tr>				<tr>					<td>						<input type="text" name="_wpseo_edit_title" id="_wpseo_edit_title" value="<?php echo esc_attr(self::get('_wpseo_edit_title'))?>" autocomplete="off" />					</td>				</tr>			</table>		<?php }?>		<?php  if($options['desc_manually']){?>			<table>				<tr>					<th>						<div>							<strong><?php esc_html_e('Please note the limit', 'wpseo')?></strong>							<span><?php esc_html_e('Words', 'wpseo')?>: <span>0</span> / <?php esc_html_e('Chars', 'wpseo')?>: <span title="<?php esc_attr_e('Recommended', 'wpseo')?>">140</span> - <span title="<?php esc_attr_e('Typed', 'wpseo')?>">0</span> = <span title="<?php esc_attr_e('Left', 'wpseo')?>">140</span></span>							<label for="_wpseo_edit_description"><?php esc_html_e('Description', 'wpseo')?></label>						</div>					</th>				</tr>				<tr>					<td>						<input type="text" name="_wpseo_edit_description" id="_wpseo_edit_description" value="<?php echo esc_attr(self::get('_wpseo_edit_description'))?>" autocomplete="off" />					</td>				</tr>			</table>		<?php }?>		<?php  if($options['key_manually']){?>			<table>				<tr>					<th>						<div>							<strong><?php esc_html_e('Please note the limit', 'wpseo')?></strong>							<span><?php esc_html_e('Words', 'wpseo')?>: <span>0</span> / <?php esc_html_e('Chars', 'wpseo')?>: <span title="<?php esc_attr_e('Recommended', 'wpseo')?>">70</span> - <span title="<?php esc_attr_e('Typed', 'wpseo')?>">0</span> = <span title="<?php esc_attr_e('Left', 'wpseo')?>">70</span></span>							<label for="_wpseo_edit_keywords"><?php esc_html_e('Keywords', 'wpseo')?></label>						</div>					</th>				</tr>				<tr>					<td>						<input type="text" name="_wpseo_edit_keywords" id="_wpseo_edit_keywords" value="<?php echo esc_attr(self::get('_wpseo_edit_keywords'))?>" autocomplete="off" />					</td>				</tr>			</table>		<?php }?>		<?php  if($options['noindex_manually']){?>			<table>				<tr>					<th>						<label for="_wpseo_edit_robots"><?php esc_html_e('Robots', 'wpseo')?></label>					</th>				</tr>				<tr>					<td>						<select name="_wpseo_edit_robots">							<option value=""></option>							<?php foreach(wpSEO_Vars::get('meta_robots')as $k=> $v){?>								<option value="<?php echo esc_attr($k)?>" <?php selected(self::get('_wpseo_edit_robots'), $k)?>><?php echo esc_html($v)?></option>							<?php }?>						</select>					</td>				</tr>			</table>		<?php }?>		<?php  if($options['canonical_manually']){?>			<table>				<tr>					<th>						<label for="_wpseo_edit_canonical"><?php esc_html_e('Canonical URL', 'wpseo')?></label>					</th>				</tr>				<tr>					<td>						<input type="text" name="_wpseo_edit_canonical" id="_wpseo_edit_canonical" value="<?php echo esc_url(self::get('_wpseo_edit_canonical'))?>" />					</td>				</tr>			</table>		<?php }?>		<?php  if($options['redirect_manually']){?>			<table>				<tr>					<th>						<label for="_wpseo_edit_redirect"><?php esc_html_e('Redirect URL', 'wpseo')?></label>					</th>				</tr>				<tr>					<td>						<input type="text" name="_wpseo_edit_redirect" id="_wpseo_edit_redirect" value="<?php echo esc_url(self::get('_wpseo_edit_redirect'))?>" />					</td>				</tr>			</table>		<?php }?>		<?php  if($options['ignore_manually']){?>			<table>				<tr>					<td class="ignore">						<input type="checkbox" name="_wpseo_edit_ignore" id="_wpseo_edit_ignore" value="1" <?php checked(self::get('_wpseo_edit_ignore'), 1)?> />					</td>					<th>						<label for="_wpseo_edit_ignore"><?php esc_html_e('No optimization', 'wpseo')?></label>					</th>				</tr>			</table>		<?php }}public static function add_columns($columns){$options=wpSEO_Options::get(); if($options['title_column']){$columns['wpseo_title']=esc_html__('Title');}if($options['desc_column']){$columns['wpseo_desc']=esc_html__('Description');}if($options['key_column']){$columns['wpseo_keywords']=esc_html__('Keywords');}if($options['robots_column']){$columns['wpseo_robots']=esc_html__('Robots');}if($options['canonical_column']){$columns['wpseo_canonical']=esc_html__('Canonical URL');}if($options['redirect_column']){$columns['wpseo_redirect']=esc_html__('Redirect URL');}if($options['ignore_column']){$columns['wpseo_ignore']=esc_html__('Blacklist');}return $columns;}public static function show_columns($column){switch($column){case 'wpseo_title': if(self::get('_wpseo_edit_title')){echo esc_html(self::get('_wpseo_edit_title'));}break; case 'wpseo_desc': if(self::get('_wpseo_edit_description')){echo esc_html(self::get('_wpseo_edit_description'));}break; case 'wpseo_keywords': if(self::get('_wpseo_edit_keywords')){echo esc_html(self::get('_wpseo_edit_keywords'));}break; case 'wpseo_robots': if(self::get('_wpseo_edit_robots')){echo esc_html(wpSEO_Vars::get('meta_robots', self::get('_wpseo_edit_robots')));}break; case 'wpseo_canonical': if(self::get('_wpseo_edit_canonical')){echo make_clickable(esc_url(self::get('_wpseo_edit_canonical')));}break; case 'wpseo_redirect': if(self::get('_wpseo_edit_redirect')){echo make_clickable(esc_url(self::get('_wpseo_edit_redirect')));}break; case 'wpseo_ignore': if(self::get('_wpseo_edit_ignore')){echo '+';}break; default: break;}}}