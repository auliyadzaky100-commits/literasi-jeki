( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['plugin-section'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );


function plotofrontpagesectionsscroll( ploto_section_id ){
    var navigation_id = "dt_slider";

    var $contents = jQuery('#customize-preview iframe').contents();

    switch ( ploto_section_id ) {
        case 'accordion-section-information_options':
        navigation_id = "dt_information";
        break;
		
		case 'accordion-section-why_choose_options':
        navigation_id = "dt_choose";
        break;
		
		case 'accordion-section-service_options':
        navigation_id = "dt_service";
        break;
		
		case 'accordion-section-cta_options':
        navigation_id = "dt_cta";
        break;
		
		case 'accordion-section-faq_options':
        navigation_id = "dt_faq";
        break;
		
		case 'accordion-section-blog_options':
        navigation_id = "dt_post";
        break;
		
    }

    if( $contents.find('#'+navigation_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + navigation_id ).offset().top
        }, 1000);
    }
}



 jQuery('body').on('click', '#sub-accordion-panel-ploto_frontpage_options .control-subsection .accordion-section-title', function(event) {
        var ploto_section_id = jQuery(this).parent('.control-subsection').attr('id');
        plotofrontpagesectionsscroll( ploto_section_id );
});