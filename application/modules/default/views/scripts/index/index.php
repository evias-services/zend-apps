
<div id="accueil">
  <h2><?php echo $this->translate("h2_title_welcome"); ?></h2>
  <div class="left-side">
    <p><?php echo $this->translate("p_leftcolumn_welcome_1"); ?></p>
    <p><?php echo $this->translate("p_leftcolumn_welcome_2"); ?></p>
    <p><?php echo $this->translate("p_leftcolumn_welcome_3"); ?></p>
    <p><?php echo $this->translate("p_leftcolumn_welcome_4"); ?></p>
    <p><?php echo $this->translate("p_leftcolumn_welcome_5"); ?></p>
  </div>
  <div class="infos-list">
    <ul>
      <?php foreach (eApp_Model_News::getLastTen() as $news) : ?>
      <li><div class="date"><?php echo date("d.m.Y", strtotime($news->date_news)); ?></div><div class="news-text"><?php echo $news->title; ?></div><div class="clear"></div></li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="clear"></div>
</div>
<div class="clear"></div>
