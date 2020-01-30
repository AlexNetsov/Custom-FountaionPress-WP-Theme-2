jQuery(document).ready( function() {
   
   // Remove term
   jQuery(".current-topics").on( 'click', 'a.selected-term', function(e) {
      e.preventDefault();
      jQuery('.ajax-loader').show();
      
      $(this).remove();
      
      var query_vars = jQuery('.query-vars').html();
	  var filter_action = 'remove';
	  var taxonomy = jQuery('.query-vars').attr("taxonomy");
      var clicked_term = jQuery(this).attr('term-id');
      var term_posts_to_display = jQuery('.query-vars').attr("term-posts-to-display");
      var post_type = jQuery('.post-type').html();
      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : archieveFilters.ajaxurl,
         data : {action: "archieve_filters_callback", query_vars: query_vars, filter_action: filter_action, taxonomy: taxonomy, clicked_term: clicked_term, term_posts_to_display: term_posts_to_display, post_type: post_type},
         success: function(response) {
            if(response.type == "success") {
	            jQuery('.query-vars').html(response.query_vars);
				jQuery('.all-topics-row').html(response.not_selected_terms_html);
				jQuery('.articles-container .single-post-ingrid').each(function(){
					jQuery(this).remove();
				});
				jQuery('.articles-container').append(response.term_posts);
				jQuery(".view-all-button").show();
            }
            else {
               console.log("Ajax failed");
            }
         }
      });   

   });
   
   // Add term
   jQuery(".all-topics-row").on('click', 'a.not-selected-term', function(e) {
      e.preventDefault();
      jQuery('.ajax-loader').show();
      
      $(this).remove();
      
      var query_vars = jQuery('.query-vars').html();
	  var filter_action = 'add';
	  var taxonomy = jQuery('.query-vars').attr("taxonomy");
      var clicked_term = +jQuery(this).attr('term-id');
      var term_posts_to_display = jQuery('.query-vars').attr("term-posts-to-display");
      var post_type = jQuery('.post-type').html();

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : archieveFilters.ajaxurl,
         data : {action: "archieve_filters_callback", query_vars: query_vars, filter_action: filter_action, taxonomy: taxonomy, clicked_term: clicked_term, term_posts_to_display: term_posts_to_display, post_type: post_type},
         success: function(response) {
            if(response.type == "success") {
				jQuery('.query-vars').html(response.query_vars);
				jQuery('.current-topics').append(response.added_term_html);
				jQuery('.articles-container .single-post-ingrid').each(function(){
					jQuery(this).remove();
				});
				jQuery('.articles-container').append(response.term_posts);
				jQuery(".view-all-button").show();
            }
            else {
               console.log("Ajax failed");
            }
         }
      });   

   });
   
   // Load more posts
   jQuery(".view-all-button").click(function(e) {
      e.preventDefault();
      jQuery('.ajax-loader').show();
      
      $(this).hide();
      
      var query_vars = jQuery('.query-vars').html();
	  var filter_action = 'load_more';
	  var taxonomy = jQuery('.query-vars').attr("taxonomy");
      var clicked_term = +jQuery(this).attr('term-id');
      var term_posts_to_display = jQuery('.query-vars').attr("term-posts-to-display");
      var post_type = jQuery('.post-type').html();

      jQuery.ajax({
         type : "post",
         dataType : "json",
         url : archieveFilters.ajaxurl,
         data : {action: "archieve_filters_callback", query_vars: query_vars, filter_action: filter_action, taxonomy: taxonomy, clicked_term: clicked_term, term_posts_to_display: term_posts_to_display, post_type: post_type},
         success: function(response) {
            if(response.type == "success") {
				jQuery('.articles-container .single-post-ingrid').each(function(){
					jQuery(this).remove();
				});
				jQuery('.articles-container').append(response.term_posts);
            }
            else {
               console.log("Ajax failed");
            }
         }
      });   

   });
   
});
jQuery( document ).ajaxComplete(function() {
  jQuery('.ajax-loader').hide();
});