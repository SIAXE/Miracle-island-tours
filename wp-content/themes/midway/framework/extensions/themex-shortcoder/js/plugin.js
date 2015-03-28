(function ()
{
	//create shortcoder plugin
	tinymce.create("tinymce.plugins.themexShortcoder",
	{
		init: function ( ed, url )
		{
			ed.addCommand("tmkPopup", function ( a, params )
			{
				var popup = params.identifier;
				
				//load thickbox popup
				tb_show("Insert Shortcode", themexUri+"extensions/themex-shortcoder/popup.php?popup=" + popup + "&width=" + 800);
			});
		},
		createControl: function ( btn, e )
		{
			if ( btn == "themex_button" )
			{	
				var a = this;
					
				//add button
				btn = e.createMenuButton("themex_button",
				{
					title: "Insert Shortcode",
					image: themexUri+"extensions/themex-shortcoder/images/icon.png",
					icons: false
				});
				
				//add dropdown
				btn.onRenderMenu.add(function (c, b)
				{
					a.addWithPopup( b, "Block", "block" );
					a.addWithPopup( b, "Button", "button" );
					a.addWithPopup( b, "Columns", "column" );
					a.addWithPopup( b, "Contact Form", "contact_form" );
					a.addWithPopup( b, "Galleries", "galleries" );
					a.addWithPopup( b, "Google Map", "map" );
					a.addWithPopup( b, "Image", "image" );
					a.addWithPopup( b, "Itinerary", "itinerary" );
					a.addWithPopup( b, "Posts", "posts" );
					a.addWithPopup( b, "Search Form", "search_form" );					
					a.addWithPopup( b, "Sidebar", "sidebar" );
					a.addWithPopup( b, "Testimonials", "testimonials" );
					a.addWithPopup( b, "Tabs", "tabs" );
					a.addWithPopup( b, "Title", "title" );
					a.addWithPopup( b, "Toggle", "toggle" );
					a.addWithPopup( b, "Tours", "tours" );
				});
				
				return btn;
			}
			
			return null;
		},
		addWithPopup: function ( ed, title, id ) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand("tmkPopup", false, {
						title: title,
						identifier: id
					})
				}
			})
		},
		addImmediate: function ( ed, title, sc) {
			ed.add({
				title: title,
				onclick: function () {
					tinyMCE.activeEditor.execCommand( "mceInsertContent", false, sc )
				}
			})
		},
		getInfo: function () {
			return {
				longname: 'Themex Shortcodes',
				version: "1.0"
			}
		}
	});
	
	//add shortcoder plugin
	tinymce.PluginManager.add("themexShortcoder", tinymce.plugins.themexShortcoder);
})();