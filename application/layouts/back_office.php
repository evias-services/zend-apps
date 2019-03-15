<!DOCTYPE html>
<html>
    <head>
        <link rel="icon"
               type="image/vnd.microsoft.icon"
               href="/favicon.ico" />
        <?php echo $this->headTitle(); ?>
        <?php echo $this->headMeta(); ?>
        <link href="/css/back_office.css"
               rel="stylesheet"
               type="text/css"
               media="screen,projection" />
        <link href="/css/jquery.css"
               rel="stylesheet"
               type="text/css"
               media="screen,projection" />
        <link href="/css/nyroModal.css"
               rel="stylesheet"
               type="text/css"
               media="screen,projection" />

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/js/jquery-nyroModal.js"></script>
        <script type="text/javascript" src="/js/jquery-timepicker.js"></script>
        <script type="text/javascript" src="/js/kernel.js"></script>

        <script type="text/javascript">
        $(document).ready(function()
        {
            evias.kernel.UI.initialize();
        });
        </script>
  </head>
    <body>
        <div id="header">
            <div id="banner-container-75">
              <a href="/">
                <div id="lang-selector">
                <?php
                $request_uri     = Zend_Controller_Front::getInstance()->getRequest()->getServer("REQUEST_URI");

                if ((bool) preg_match("/.*?language[\/=](de|fr|en).*?/", $request_uri))
                  $request_uri = preg_replace("/(.*?)([\/\?]language[\/=](de|fr|en)).*?/", "$1", $request_uri);

                $french_url = $request_uri . "?language=fr";
                $german_url = $request_uri . "?language=de";

                $french_sel = eApp_Translator::getCurrentLanguage() == "fr" ? " class='selected'" : "";
                $german_sel = eApp_Translator::getCurrentLanguage() == "de" ? " class='selected'" : "";
                ?>
                  <ul>
                    <li<?php echo $french_sel; ?>><a href="<?php echo $french_url; ?>"><img src="/images/flag_france_48x32.png" alt="Français" /></a></li>
                    <li<?php echo $german_sel; ?>><a href="<?php echo $german_url; ?>"><img src="/images/flag_germany_48x32.png" alt="Deutsch" /></a></li>
                  </ul>
                </div>

                <div id="banner-iron-75"></div>
                <div id="banner-mike-75"></div>
                <div class="clear"></div>
              </a>
            </div>
            <div id="navigation">
                <?php
                $sel_news      = ((bool) preg_match("/^\/back\-office\/news.*?/", $request_uri)) ? " class='selected'" : "";
                $sel_dashboard = (!$sel_news) ? " class='selected'" : "";
                ?>
                <ul>
                <?php if (Zend_Auth::getInstance()->hasIdentity()) : ?>
                    <li<?php echo $sel_dashboard; ?>><a href="/back-office/"><?php echo $this->translate("menu_link_dashboard"); ?></a></li>
                    <li<?php echo $sel_news; ?>><a href="/back-office/news"><?php echo $this->translate("menu_link_news"); ?></a></li>
                    <li><a href="/"><?php echo $this->translate("menu_link_website"); ?></a></li>
                <?php endif; ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>

        <div id="content">
            <div id="start" style="height: 100px;"></div>
            <div class="clear"></div>

            <div id="messaging">
                <?php echo $this->messaging($this->messages, $this->errors, $this->warnings); ?>
            </div>

            <div id="current_page_content">
              <?php echo $this->layout()->content; ?>
            </div>
        </div>

        <div id="footer">
            <img id="back-to-top" src="/images/go-top.png" alt="Back to Top" title="Retour en haut de la page" />

            <div id="bottom-links">
                <div class="column">
                    <h4>Links</h4>
                    <ul>
                        <li><a target="_blank" href="https://www.facebook.com/evias">eVias on Facebook</a>
                        <li><a target="_blank" href="https://www.facebook.com/evias">eVias on Facebook</a>
                        <li><a target="_blank" href="https://www.facebook.com/evias">eVias on Facebook</a>
                        <li><a target="_blank" href="https://www.facebook.com/evias">eVias on Facebook</a>
                    </ul>
                </div>
                <div class="column">
                    <h4>Features</h4>
                    <ul>
                        <li><a target="_blank" href="http://www.evias.be">eVias Website Creation</a>
                        <li><a target="_blank" href="http://www.nyromodal.com">nyroModal Library</a>
                        <li><a target="_blank" href="http://www.jquery.com">jQuery Library</a>
                        <li><a target="_blank" href="http://www.zend-framework.com">Zend Framework</a>
                    </ul>
                </div>
                <div class="clear"></div>
            </div>

            <div id="copyright"><p>Copyright <a href="/back-office">&copy;</a> 2014-2015 <a href="http://www.evias.be">eVias</a>, All Rights Reserved &reg;&nbsp;&nbsp;-&nbsp;You can contact us <a href="mailto:service@evias.be">here</a> at any time.<?php if(Zend_Auth::getInstance()->hasIdentity()) echo " - <a href='/back-office/auth/logout'>Logout</a>"; ?></p></div>
        </div>
    </body>
</html>