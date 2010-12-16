<?php
/**
 * @package sfUserVoicePlugin
 *
 * @author zdanozdan <tomasz[at]mikran[dot]pl>
 * @version 1.0.1
 *
 	
 /**
 * Returns an image link to use the lightbox function for 1 image.
 *
 * @param string $culture   culture to pass to uservoice
 *
 */

function add_user_voice($culture = null)
{
  $lang = isset($culture) ? $culture : sfConfig::get('app_sf_user_voice_plugin_lang');

  $detailedDescription = sprintf(<<<EOF

  var uservoiceOptions = {
    key: '%s',
    host: '%s', 
    forum: '%s',
    lang: '%s',
    showTab: %s,  
    /* optional */
    alignment: '%s',
    background_color:'#%s', 
    text_color: '%s',
    hover_color: '#%s',
  };

  function _loadUserVoice() {
    var s = document.createElement('script');
    s.src = ("https:" == document.location.protocol ? "https://" : "http://") + "cdn.uservoice.com/javascripts/widgets/tab.js";
    document.getElementsByTagName('head')[0].appendChild(s);
  }
  _loadSuper = window.onload;
  window.onload = (typeof window.onload != 'function') ? _loadUserVoice : function() { _loadSuper(); _loadUserVoice(); };

EOF
				 ,sfConfig::get('app_sf_user_voice_plugin_key'),
				 sfConfig::get('app_sf_user_voice_plugin_host'),
				 sfConfig::get('app_sf_user_voice_plugin_forum'),
				 $lang,
				 sfConfig::get('app_sf_user_voice_plugin_show_tab'),
				 sfConfig::get('app_sf_user_voice_plugin_alignment'),
				 sfConfig::get('app_sf_user_voice_plugin_background_color'),
				 sfConfig::get('app_sf_user_voice_plugin_text_color'),
				 sfConfig::get('app_sf_user_voice_plugin_hover_color')
				 );

  echo javascript_tag($detailedDescription);
}