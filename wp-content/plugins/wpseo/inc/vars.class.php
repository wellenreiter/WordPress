<?php class wpSEO_Vars{private static $_vars; public function __construct(){self::$_vars=array('plugin_lang'=> array(''=> 'Auto', 'en_EN'=> 'English', 'de_DE'=> 'Deutsch'), 'custom_fields'=> array('_wpseo_edit_title', '_wpseo_edit_description', '_wpseo_edit_keywords', '_wpseo_edit_robots', '_wpseo_edit_canonical', '_wpseo_edit_redirect', '_wpseo_edit_ignore'), 'custom_meta'=> array('title', 'desc', 'keys', 'robots', 'canonical'), 'misc_order'=> array('title'=> 'Pagetitle', 'desc'=> 'Description', 'keys'=> 'Keywords'), 'title_format'=> array(1=> 'Uppercase', 2=> 'Lowercase'), 'speed_nocheck'=> array(0=> array('Include meta data automatically, replace existing tags', 'Recommended setting. Avoids duplicates within meta tags'), 1=> array('Include meta data automatically, keep existing tags', "Faster execution, since it doesn't look for duplicates"), 2=> array('Trigger output of the meta data in your template manually', 'Fastest. Trigger function via hook at desired spot')), 'group_items'=> array('home'=> 'Startpage', 'single'=> 'Posts', 'page'=> 'Pages', 'posttype'=> 'Custom post types', 'attachment'=> 'Attachments', 'category'=> 'Categories', 'search'=> 'Search', 'tagging'=> 'Tags', 'author'=> 'Authors', 'tax'=> 'Taxonomies', 'archive'=> 'Remaining pages'), 'meta_title'=> array('home'=> array('blog'=> 'Site Title', 'title'=> 'Tagline/Title', 'area'=> 'Text Field'), 'single'=> array('blog'=> 'Site Title', 'title'=> 'Title', 'tag'=> 'Tags', 'category'=> 'Category', 'author'=> 'Author', 'area'=> 'Text Field'), 'page'=> array('blog'=> 'Site Title', 'title'=> 'Title', 'author'=> 'Author', 'parent'=> 'Parent Title', 'area'=> 'Text Field'), 'posttype'=> array('blog'=> 'Site Title', 'title'=> 'Title', 'label'=> 'Label', 'tag'=> 'Tags', 'category'=> 'Category', 'tax'=> 'Taxonomy', 'author'=> 'Author', 'area'=> 'Text Field'), 'attachment'=> array('blog'=> 'Site Title', 'title'=> 'Title', 'parent'=> 'Post Title', 'author'=> 'Author', 'area'=> 'Text Field'), 'category'=> array('blog'=> 'Site Title', 'title'=> 'Name', 'desc'=> 'Description', 'short'=> 'Short description', 'pager'=> 'Page Number', 'area'=> 'Text Field'), 'search'=> array('blog'=> 'Site Title', 'title'=> 'Search Titel', 'pager'=> 'Page Number', 'area'=> 'Text Field'), 'tagging'=> array('blog'=> 'Site Title', 'title'=> 'Name', 'desc'=> 'Description', 'short'=> 'Short description', 'pager'=> 'Page Number', 'area'=> 'Text Field'), 'author'=> array('blog'=> 'Site Title', 'title'=> 'Name', 'desc'=> 'Biographical Info', 'pager'=> 'Page Number', 'area'=> 'Text Field'), 'tax'=> array('blog'=> 'Site Title', 'title'=> 'Name', 'desc'=> 'Description', 'short'=> 'Short description', 'pager'=> 'Page Number', 'area'=> 'Text Field'), 'archive'=> array('blog'=> 'Site Title', 'title'=> 'Template Title', 'pager'=> 'Page Number', 'area'=> 'Text Field')), 'meta_desc'=> array('home'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts'), 'single'=> array(1=> 'Title of the current post', 2=> 'Excerpt of the current post', 3=> 'Optional excerpt while writing the post'), 'page'=> array(1=> 'Title of the current post', 2=> 'Excerpt of the current post'), 'posttype'=> array(1=> 'Title of the current custom post type', 2=> 'Excerpt of the current custom post type', 3=> 'Optional excerpt while writing the post'), 'attachment'=> array(1=> 'Attachment title', 2=> 'Attachment title + Post title', 3=> 'Title of the current post', 4=> 'Excerpt of the current post'), 'category'=> array(1=> 'Category description', 2=> 'Titles of all listed posts', 3=> 'Short description'), 'search'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts'), 'tagging'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts', 3=> 'Tag description', 4=> 'Short description'), 'author'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts', 3=> 'Biographical info from profile'), 'tax'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts', 3=> 'Taxonomy description', 4=> 'Short description'), 'archive'=> array(1=> 'Excerpt of the first post', 2=> 'Titles of all listed posts')), 'meta_robots'=> array(1=> 'index, follow', 2=> 'index, nofollow', 6=> 'index', 4=> 'noindex, follow', 5=> 'noindex, nofollow', 3=> 'noindex'));}public static function get($key, $sub=''){if(empty(self::$_vars[$key])){return '';}$value=self::$_vars[$key]; if(empty($sub)or empty($value[$sub])){return $value;}return $value[$sub];}}new wpSEO_Vars();