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

.contact form p input {
    margin-left: 20px;
    box-shadow: 5px 5px 2px #888;
    font-weight: bold;
    width: 200px;
}

.contact form p textarea {
    margin-left: 20px;
    box-shadow: 5px 5px 2px #888;
    font-weight: bold;
    min-height: 50px;
    width: 200px;
}

.contact {
    border: 3px solid #888;
    border-radius: 15px;
    padding: 15px;
}

.contact h3 {
    text-align: center;
    text-decoration: underline;
}
</style>

<div class="content_item">
    <h1><?php echo $this->translate("contact_h1"); ?></h1>
    <div class="contact content_container">
        <h3><?php echo $this->translate("contact_h3"); ?></h3>
        <form action="" method="post">
        <p>
            <label><?php echo $this->translate("contact_label_name"); ?> :</label><br />
            <input type="text" name="contact[name]" />
        </p>
        <p>
            <label><?php echo $this->translate("contact_label_email"); ?> : <span class="tRed">*</span></label><br />
            <input type="text" name="contact[email]" />
        </p>
        <p>
            <label><?php echo $this->translate("contact_label_subject"); ?> :</label><br />
            <input type="text" name="contact[subject]" />
        </p>
        <p>
            <label><?php echo $this->translate("contact_label_message"); ?> : <span class="tRed">*</span></label><br />
            <textarea name="contact[message]"></textarea>
        </p>
        <p>
            <input type="submit" value="<?php echo $this->translate("contact_label_submit"); ?>" />
        </p>
        <p>
            <span class="small"><?php echo $this->translate("contact_legend"); ?></span>
        </p>
        </form>
    </div>

    <div class="clear"></div>

</div>