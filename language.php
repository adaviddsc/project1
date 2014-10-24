<?php
class Language {
    /**
     * List of translations
     *
     * @var array
     */
    var $language   = array();
    /**
     * List of loaded language files
     *
     * @var array
     */
    var $is_loaded  = array();
 
    public function __construct()
    {
        //echo "load language class\n";
    }
    public function load($langfile = '')
    {
        // 載入 language 檔案到 array()
        $langfile = str_replace('.php', '', $langfile);
 
	    $langfile .= '.php';
	 
	    if (in_array($langfile, $this->is_loaded, TRUE))
	    {
	        return;
	    }

	 
	    // Determine where the language file is and load it
	    if (file_exists('language/'.$langfile))
	    {
	        include('language/'.$langfile);
            
	    }
	 
	    if ( ! isset($lang))
	    {
	        return;
	    }
	 
	    $this->is_loaded[] = $langfile;
	    $this->language = array_merge($this->language, $lang);
	    unset($lang);
	 
	    return TRUE;
    }
 
    public function line($line = '')
    {
        // 讀取 language list
        $value = ($line == '' OR ! isset($this->language[$line])) ? FALSE : $this->language[$line];
    	return $value;
    }
}

?>