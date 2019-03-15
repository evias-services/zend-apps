<style type="text/css">
#maps-container {
    width: 490px;
    margin: 25px auto;
}

.content_item fieldset {
    width: 300px;
    float: left;
}

p.address {
    font-size: 13pt;
}
</style>

<div class="content_item">
    <h1><?php echo $this->translate("access_h1"); ?></h1> 

    <div class="content_container">
        <p class="address tBold"><?php echo $this->translate("access_address"); ?></p>
    </div>

    <div class="content_container">
        <p class="address tBold"><?php echo $this->translate("access_opening"); ?></p>
    </div>

    <div class="clear"></div>

    <div id="maps-container">
        <h3><?php echo $this->translate("contact_maps"); ?></h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5061.997148524336!2d6.033135104896187!3d50.62714329724032!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c085b608addcad%3A0xc46b7a835ef6c90!2sBergstra%C3%9Fe+44%2C+4700+Eupen!5e0!3m2!1sfr!2sbe!4v1410215025738" width="480" height="433" frameborder="0" scrolling="no" style="border:0"></iframe>
    </div>
</div>