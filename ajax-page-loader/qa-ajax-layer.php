<?php
class qa_html_theme_layer extends qa_html_theme_base
{
	var $plugin_directory;
	var $plugin_url;
	function qa_html_theme_layer($template, $content, $rooturl, $request)
	{
		global $qa_layers;
		$this->plugin_directory = $qa_layers['APL - Ajax Layer']['directory'];
		$this->plugin_url = $qa_layers['APL - Ajax Layer']['urltoroot'];
		qa_html_theme_base::qa_html_theme_base($template, $content, $rooturl, $request);
	}
	
    function html()
    {
        if (isset($_REQUEST['apl_ajax_html'])) {
            return;
        } else {
			qa_html_theme_base::html();
        }
    }
    function head_script()
    {
		$plugin_url = qa_opt('site_url') . $this->plugin_url;
		// element container
		$container = qa_opt('apl_container');
		if(empty($container))
			$container = '.qa-body-wrapper';
			
        $this->output('<script> apl_url = "' . $plugin_url . '"; apl_container = "'. $container .'"; apl_home_url = "'. qa_opt('site_url') .'";</script>');

		qa_html_theme_base::head_script();
        
		$this->output('<script type="text/javascript" src="' . $plugin_url . 'main.js"></script>');
    }
}
