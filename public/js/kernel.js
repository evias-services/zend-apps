if (typeof evias == 'undefined')
	var evias = {};

evias.kernel = {};

evias.kernel.UI = {

	initialize: function()
	{
        this.initNavigation();
        this.initBackToTop();
        this.initMessaging();

        $(".nyromodal").nyroModal();

        $.nmFilters({basic: {
            beforeShowCont : function(nm)
            {
            	$(nm.elts.cont).css("z-index", "2");
            },
            close: function(nm)
            {
            }
        }});
	},

	initMessaging: function()
	{
		$(".msg").click(function(e)
		{
			e.preventDefault();
			$(this).fadeOut("slow");
			return false;
		});
	},

	initBackToTop : function()
	{
		$("#back-to-top").click(function()
		{
			window.scrollTo(0,0);
		});
	},

	initNavigation: function()
	{
		$("#banner-logo").on({
			click: function()
			{
				window.location.href="/#start";
			},
			dblclick: function()
			{
				window.location.href="/back-office";
			}
		});

		$("#navigation ul li").click(function(e)
		{
			e.preventDefault();

			$("#navigation ul li.selected").removeClass("selected");
			$(this).addClass("selected");
			window.location.href = $(this).find("a").attr("href");
		});

		$("#navigation ul li a").click(function()
		{
			$("#navigation ul li.selected").removeClass("selected");
			$(this).parent("li").addClass("selected");
		});
	},

	initTimePickers: function()
	{
        if (typeof $(".datepicker") != "undefined") {
            $('.datepicker').datepicker({
            	dateFormat: "dd/mm/yy"
            });
        }

        if (typeof $(".timepicker") != "undefined") {
            $('.timepicker').timepicker({
                showAnim: "fadeIn",
                duration: 200
            });
        }
	}

};

evias.kernel.Data = {

	initializeObjects : function()
	{
		$("button.create-object").click(function(e)
		{
			e.preventDefault();

			var elm_table = $("table.objects");
			var mvc_ctrl  = elm_table.attr("data-type");

			$.nmManual("/back-office/" + mvc_ctrl + "/edit", {});
			return false;
		});

		$("tr.object td").each(function()
		{
			var elm_td 		= $(this);
			var elm_tr 		= $(this).parents("tr");
			var elm_table 	= elm_tr.parents("table.objects");

			var mvc_ctrl = elm_table.attr("data-type");
			var mvc_obj  = elm_tr.attr("data-id");

			elm_td.off("click");
			if (! elm_td.hasClass("actions")) {
				elm_td.click(function(e)
				{
					$.nmManual("/back-office/" + mvc_ctrl + "/edit/oid/" + mvc_obj, {});
					return false;
				});
			}
		});

		$("ul.object-actions li").click(function(e)
		{
			e.preventDefault();

			if ($(this).hasClass("delete")
				&& ! confirm($("#txt-confirm-delete").text()))
				return false;

			var elm_row    = $(this).parents("tr");
			var action_url = $(this).attr("data-url");

			$.ajax({
				url: action_url,
				type: "post",
				success: function(data, status, xhr)
				{
					console.log(data);
					elm_row.remove();
				}
			});

			return false;
		});
	},

	initializeEditor: function()
	{
		$("#object-editor input.text").each(function()
		{
			var elm_input = $(this);
			var elm_empty = $("#" + $(this).attr("rel"));

			elm_input.on({
				click : function()
				{
					if ($(this).val() == elm_empty.text())
						$(this).val('');

					return false;
				},
				blur: function()
				{
					if (! $(this).val().length)
						$(this).val(elm_empty.text());
				},
				focusin: function()
				{
					if ($(this).val() == elm_empty.text())
						$(this).val('');

					return false;
				},
				focusout: function()
				{
					if (! $(this).val().length)
						$(this).val(elm_empty.text());
				}
			});
		})
	},

    initializeAutoComplete: function()
    {
        var elms = $(".ajax-search-field");
        if (typeof elms == "undefined")
            return false;

        $(".ajax-search-field").each(function(e)
        {
            var _url         = $(this).attr("ajax-url");

            if (typeof _url == "undefined") {
                console.log("Missing 'ajax-url' attribute on ajax-search-field element.");
                return ;
            }

            $(this).autocomplete({
                minLength: 2,
                source: _url,
                select: function(event, ui) {},
                response: function(event, items) {
                	console.log(items);
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item)
            {
                /* overload autocomplete._renderItem to display custom
                   list of items. */
                if (typeof item.desc != 'undefined' && item.desc.length > 0)
	                return $("<li>")
	                  .append("<a>" + item.label + "<br />" + item.desc + "</a>")
	                  .appendTo(ul);
	            else
	            	return $("<li>")
	                  .append("<a>" + item.label + "</a>")
	                  .appendTo(ul);
            };
        });
    }
}
